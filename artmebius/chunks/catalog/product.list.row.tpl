{set $currency = 'shk3.currency' | option}
{* image *}
{if $image}
  {set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'~$watermark}
{else}
  {set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc=0&far=1'}
{/if}
{* availability *}
{set $availability = '!msProductOptions' | snippet : [
  'tpl'=>'ms2.product.option',
  'product'=>$id,
  'onlyOptions'=>'product_availability'
]}
{* labels *}
{set $labels_config_arr = 'getLabels' | snippet}
{set $labels_options = '!msProductOptions' | snippet : [
  'onlyOptions'=>'product_label',
  'product'=>$id,
  'return'=>'data',
]}
{if $labels_options.label.value is array}
  {set $labels_active_arr = $labels_options.label.value}
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
      <span class="label_block label_{$label_key}" data-label="{$label_key}"><span>{$label_title}</span></span>
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
<div class="prds_item ms2_product shk-item row" data-id="{$id}">
  <div class="col-sm-5 col-md-4 col-lg-3">

    <div class="favorite_compare_group">
      <div class="prds_item_compare">
        {'!addComparison' | snippet : [
          'list_id'=> 19,
          'id'=>$id,
          'tpl'=>'comparison.add'
        ]}
      </div>
      <div class="prds_item_favorite item_favorite favorite_elem{$id | in_favorite : ' active|| inactive'}" onclick="return favorite.set({$id}, this);" title="Избранное">
        <span class="prds_item_favorite_icon favorite_icon fal fa-heart"></span>
      </div>
    </div>

    {if $labels_html}<span class="prds_item_labels labels_wrap">{$labels_html}</span>{/if}

    <div class="prds_item_preview">
      <a class="prds_item_preview_link prds_item_link" href="{$id | url}" {$link_attributes}>
        <span class="prds_item_preview_link_image">
          <img class="prds_item_img" src="{$image | phpthumbon : $img_params}" width="{$preview_width}" height="{$preview_height}" alt="{$pagetitle | clean : 'qq'}" />
        </span>
      </a>
    </div>

  </div>
  <div class="col-sm-7 col-md-5 col-lg-6">

    <div class="prds_item_info">

      {if $introtext}
      <div class="prds_item_intro">
        {$introtext | truncate : 150}
      </div>
      {/if}

      {if $vendor_name}
      <div class="prds_item_brand">
        {if $vendor_resource != 0}
          <a class="prds_item_brand_link" href="{$vendor_resource | url}">{$vendor_name}</a>
        {else}
          <span class="prds_item_brand_link">{$vendor_name}</span>
        {/if}
      </div>
      {/if}

      <div class="prds_item_available {$availability ? 'available_yes' : 'available_no'}">
        {if $availability == 1}
          <i class="fas fa-circle"></i> В наличии
        {else}
          <i class="fas fa-circle"></i> Под заказ
        {/if}
      </div>

    </div>

  </div>
  <div class="col-sm-12 col-md-3 col-lg-3">

    <div class="prds_item_shopping">

      <div class="prds_item_prices">
        {if $old_price}
        <div class="prds_item_price_old">
          <span class="prds_item_price_old_value">{$old_price | num_format}</span>
          <span class="prds_item_price_old_currency price_currency">{$currency}</span>
        </div>
        {/if}
        <div class="prds_item_price{($old_price) ? ' price_with_discount' : ''}">
          <span class="prds_item_price_title">Цена</span>
          {if $price}
            <span class="prds_item_price_value price_value">{$price | num_format}</span> <span class="prds_item_price_currency price_currency">{$currency}</span>
          {else}
            <span class="prds_item_price_value price_value">по запросу</span>
          {/if}
        </div>
      </div>

      <form class="prds_item_form ms2_form" action="{$_modx->resource.id | url}" method="post">
        <div class="prds_item_controls">
          <div class="prds_item_buy">
            {if $availability == 1}
              <button class="btn btn-main btn-buy w-100" type="submit" name="ms2_action" value="cart/add">Купить</button>
            {else}
              <a class="btn btn-main btn-more w-100" href="{$id | url}" {$link_attributes}>Подробнее...</a>
            {/if}
          </div>
          <div class="prds_item_order">
            <a class="btn-order btn btn-link" href="javascript:void(0);" data-toggle="modal" data-target="#modal_order_product" data-rid="{$id}" data-pagetitle="{$pagetitle | clean : 'qq'}">Купить в 1 клик</a>
          </div>
          <input type="hidden" name="id" value="{($class_key == 'modSymLink') ? $content : $id}" />
          <input type="hidden" name="count" value="1">
          {* <input type="hidden" name="options" value="[]"> *}
        </div>
      </form>

    </div>

  </div>
</div>