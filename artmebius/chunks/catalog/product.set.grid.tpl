{set $currency = 'ctlg_currency' | option}
{* labels *}
{set $labels_config_arr = 'getLabels' | snippet}
{set $labels_options = '!msProductOptions' | snippet : [
  'onlyOptions' =>'prod_label',
  'product'     =>$id,
  'return'      =>'data',
]}
{if $labels_options.prod_label.value is array}
  {set $labels_active_arr = $labels_options.prod_label.value}
  {foreach $labels_config_arr as $label_key => $label_title}
    {if $label_title in $labels_active_arr}
      {set $labels_arr[$label_key] = $label_title}
    {/if}
  {/foreach}
{/if}
{if $price && $old_price}
  {set $discount = (100 - ($data.price * 100 / $data.old_price)) | round}
  {set $labels_arr['discount'] = '-'~$discount~'%'}
{/if}
{if $labels_arr}
  {set $labels_html}
    {foreach $labels_arr as $label_key => $label_title}
      <span class="label_block label_{$label_key}" data-label="{$label_key}"><span>{$label_title}</span></span>
    {/foreach}
  {/set}
{/if}
<div class="prds_set_wrap">
  <div class="row row-cols-1 row-cols-lg-4">

    {* основной товар (master) *}
    <div class="tiles_col col">
      <div class="prds_set">

        <div class="prds_set_preview">
          {if $labels_html}<span class="prds_set_labels labels_wrap">{$labels_html}</span>{/if}
          <a href="{$id | url}" class="prds_set_preview_link">
            <span class="prds_set_preview_link_image">
              {if $medium}
                {* <img class="prds_set_preview_link_img" src="{$image | phpthumbon : '&w=77&h=27&zc=0&far=1'}" width="77" height="27" alt="{$pagetitle | clean : 'qq'}" /> *}
                <img class="prds_set_preview_link_img" src="{$medium}" {$medium | img_size : 'attr'} alt="{$pagetitle | clean : 'qq'}" loading="lazy"/>
              {else}
              {set $noimage = ('assets_url' | option) ~ 'components/phpthumbon/noimage-512.png'}
                <img class="prds_set_preview_link_img" src="{$noimage | phpthumbon : '&w=390&h=288&zc=0&far=1&bg=ffffff'}" {$thumb | img_size : 'attr'} alt="{$pagetitle | clean : 'qq'}" loading="lazy"/>
              {/if}
            </span>
          </a>
        </div>

        {set $comments_rating = 'get_comments_rating' | snippet : ['rid'=>$id]}
        <div class="prds_set_rating">
          {if $comments_rating['count'] > 0}
          <a href="{$id|url}#prdt_reviews" class="prds_set_rating_link stars_rating_link">
          {else}
          <span class="prds_set_rating_link stars_rating_link">
          {/if}
            <span class="stars_rating" title="Средняя оценка: {$comments_rating['average_star']}">
              <span class="stars_rating_default"></span>
              <span class="stars_rating_active" style="width: {$comments_rating['average']}%;"></span>
            </span>
            <span class="stars_rating_count">({$comments_rating['count']})</span>
          {if $comments_rating['count'] > 0}</a>{else}</span>{/if}
        </div>

        <div class="prds_set_title">
          <a href="{$id | url}" class="prds_set_title_link">
            <span class="prds_set_title_link_text">{$pagetitle}</span>
          </a>
        </div>

      </div>
    </div>

    {* товары комплекта (slaves) *}
    {'!msSetInCart.set' | snippet : [
      'sortby'         => 'quantity',
      'master'         => $id,
      'link'           => 3,
      'setActive'      => 1,
      'setMode'        => 'cart',
      'setInput'       => 'hidden',
      'sortby'         => 'parent',
      'sortdir'        => 'ASC',
      'setRemoveSlave' => 1,
      'includeThumbs'  => 'medium',
      'tpl'            => 'product.set.grid.row'
    ] | clean}

    {* стоимость комплекта *}
    <div class="tiles_col col">
      {set $set_price = '!get_set_price' | snippet : ['link' => 3, 'master'=>$id]}
      <div class="prds_set prds_set_prices">
        <div class="prds_set_prices_inner">
          <div class="prds_set_price">
            <span class="prds_set_price_title">Цена:</span>
            <span class="prds_set_price_value mssetincart-cost mssetincart-{$id}">{($set_price['price']+$data.price) | num_format}</span>
            <span class="prds_set_price_currency">{$currency}</span>
          </div>
          {if $set_price['old_price'] > $set_price['price']}
            <div class="prds_set_old_price">
              <span class="prds_set_old_price_value mssetincart-old-cost mssetincart-{$id}">{($set_price['old_price']+$data.price) | num_format}</span>
              <span class="prds_set_old_price_currency">{$currency}</span>
            </div>
          {/if}
          <div class="prds_set_controls">
            <form id="ms2_form_set" class="ms2_form" action="{$id | url}" method="post" autocomplete="off">
              <input type="hidden" name="id" value="{$id}" />
              <input type="hidden" name="count" value="1"/>
              <input type="hidden" name="mssetincart_set" value="{$id}">
              <button class="btn btn-yellow btn-lg" type="submit" name="ms2_action" value="cart/add"><span class="orderSubmit">Купить комплект</span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>