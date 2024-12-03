{set $price_num = $price | clean : 'num' | int}
{set $old_price_num = $old_price | clean : 'num' | int}
{set $currency = 'cfg_currency' | option}
{* image *}
{if $image}
  {set $image_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1&bg=ffffff'~$watermark}
{else}
  {set $image_params = '&w='~$preview_width~'&h='~$preview_height~'&zc=0&far=1'}
{/if}
{* main_properties *}
{set $main_properties_comma = 'prds_main_properties' | option}
{set $prdt_props_main_html = 'msProductOptions' | snippet : [
  'onlyOptions' => $main_properties_comma,
  'product'     =>$id,
  'tpl'         => 'ms2.prds.options.main',
]}{* 'ms2.prds.options.main fix *}
{* availability *}
{set $availability = '!msProductOptions' | snippet : [
  'onlyOptions' =>'prod_availability',
  'product'     =>$id,
  'tpl'         =>'ms2.product.option',
] | clean}
{* labels *}
{set $labels_config_arr = 'getLabels' | snippet}
{set $labels_options = '!msProductOptions' | snippet : [
  'onlyOptions' =>'prod_label',
  'product'     =>$id,
  'return'      =>'data'
]}
{if $labels_options.product_label.value is array}
  {set $labels_active_arr = $labels_options.product_label.value}
  {foreach $labels_config_arr as $label_key => $label_title}
    {if $label_title in $labels_active_arr}
      {set $labels_arr[$label_key] = $label_title}
    {/if}
  {/foreach}
{/if}
{if $price && $old_price}
  {set $discount = (100 - ($price | toInt* 100 / $old_price | toInt)) | round}
  {set $labels_arr['discount'] = '-'~$discount~'%'}
{/if}
{if $labels_arr}
  {set $labels_html}
    {foreach $labels_arr as $label_key => $label_title}
      <span class="labels__item labels__item_{$label_key}" data-label="{$label_key}"><span class="labels__text">{$label_title}</span></span>
    {/foreach}
  {/set}
{/if}
{* vendors *}
{set $vendor = $_pls['vendor']}
{set $vendor_name = $_pls['vendor.name']}
{set $vendor_country = $_pls['vendor.country']}
{set $vendor_logo = $_pls['vendor.logo']}
{set $vendor_resource = $_pls['vendor.resource']}
{* tpl *}
<div class="products-grid__col grid_col col-auto">
  <div class="products-grid-item products-grid__item ms2_product" data-id="{$id}">
    <div class="products-grid-item__top">

      <div class="products-grid-item__favorite-compare">
        <div class="products-grid-item__compare">
          {'!addComparison' | snippet : [
            'list_id'=> 19,
            'id'=>$id,
            'tpl'=>'comparison.add'
          ]}
        </div>
        <div class="products-grid-item__favorite favorite-item{$id | in_favorite : ' active|| inactive'}" onclick="return favorite.set({$id}, this);" title="Избранное">
          <span class="products-grid-item__favorite-icon fal fa-heart"></span>
        </div>
      </div>

      {if $labels_html}<span class="products-grid-item__labels labels">{$labels_html}</span>{/if}

      <div class="products-grid-item__preview">
        <a class="products-grid-item__preview-link products-grid-item__link" href="{$id | url}" {$link_attributes}>
          <span class="products-grid-item__preview-img-wrap">
            <img class="products-grid-item__preview-img" src="{$image | phpthumbon : $image_params}" width="{$preview_width}" height="{$preview_height}" alt="{$pagetitle | clean : 'qq'}" loading="lazy">
          </span>
          <span class="products-grid-item__title">{$menutitle ?: $pagetitle}</span>
        </a>
      </div>

    </div>
    <div class="products-grid-item__btm">

      {if $introtext}
      <div class="products-grid-item__intro">
        {$introtext | truncate : 150}
      </div>
      {/if}

      <div class="products-grid-item__prices">
        {if $old_price}
        <div class="products-grid-item__price-old">
          <span class="products-grid-item__price-old-value">{$old_price | num_format}</span>
          <span class="products-grid-item__price-old-currency price-currency">{$currency}</span>
        </div>
        {/if}
        <div class="products-grid-item__price{($old_price) ? ' products-grid-item__price_discount price-discount' : ''}">
          <span class="products-grid-item__price-title">Цена</span>
          {if $price}
            <span class="products-grid-item__price-value price-value">{$price | num_format}</span> <span class="products-grid-item__price_currency price_currency">{$currency}</span>
          {else}
            <span class="products-grid-item__price-value price-value">по запросу</span>
          {/if}
        </div>
      </div>

      {if $vendor_name}
      <div class="products-grid-item__brand">
        {if $vendor_resource != 0}
          <a class="products-grid-item__brand-link" href="{$vendor_resource | url}">{$vendor_name}</a>
        {else}
          <span class="products-grid-item__brand-link">{$vendor_name}</span>
        {/if}
      </div>
      {/if}

      <div class="products-grid-item__available {($availability in list [1, 'true']) ? 'available_yes' : 'available_no'}">
        {if ($availability in list [1, 'true'])}
          <i class="fas fa-circle"></i> В наличии
        {else}
          <i class="fas fa-circle"></i> Под заказ
        {/if}
      </div>

      <form class="products-grid-item__form ms2_form" action="{$_modx->resource.id | url}" method="post">
        <div class="products-grid-item__controls">
          <div class="products-grid-item__buy">
            {if ($availability in list [1, 'true'])}
              <button class="products-grid-item__buy-btn btn btn-main btn-buy w-100" type="submit" name="ms2_action" value="cart/add">Купить</button>
            {else}
              <a class="products-grid-item__more-btn btn btn-main btn-more w-100" href="{$id | url}" {$link_attributes}>Подробнее...</a>
            {/if}
          </div>
          <div class="products-grid-item__order">
            <a class="products-grid-item__order-btn btn btn-link btn-order" href="javascript:void(0);" data-toggle="modal" data-target="#modal_order_product" data-rid="{$id}" data-pagetitle="{$pagetitle | clean : 'qq'}">Купить в 1 клик</a>
          </div>
          <input type="hidden" name="id" value="{($class_key == 'modSymLink') ? $content : $id}">
          <input type="hidden" name="count" value="1">
          {* <input type="hidden" name="options" value="[]"> *}
        </div>
      </form>

    </div>

  </div>
</div>