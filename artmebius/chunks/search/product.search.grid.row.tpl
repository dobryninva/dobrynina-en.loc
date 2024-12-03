{set $preview_width = 'prds_preview_width' | option}
{set $preview_height = 'prds_preview_height' | option}
{set $preview_zc = 'prds_preview_zc' | option}
{set $watermark = 'prds_preview_wm' | option}
{set $img_cats_params = '&w=294&h=297&zc=0&far=1'}
{set $img_dir = 'images/'}
{if $image}
  {if $template in [10,21]}
    {set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'~$watermark}
  {else}
    {set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
  {/if}
  {if $img_dir | in : $image}
    {set $image = $image}
  {else}
    {set $image = $img_dir ~ $image}
  {/if}
{else}
  {set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
{/if}

{if $template in [9,15]}
<div class="tiles_col col-xs-12 col-sm-e-6 col-md-6 col-lg-4 col-xl-4">
  <div class="prds_block ctlg_block sr_block align-content-xs-start">
    <div class="prds_block_top">

      <div class="item_preview_wrap">
        <a class="item_preview_link" href="{$id | url}" {$link_attributes}>
          <span class="item_preview">
            <img class="item_img" src="{$image | phpthumbon : $img_params}" alt="{$pagetitle | clean : 'qq'}" />
          </span>
        </a>
      </div>

    </div>
    <div class="prds_block_btm">

      <div class="m_inner">
        <div class="item_title_wrap">
          <a class="item_title_link" href="{$id | url}" {$link_attributes}>
            {if $template == 9}<span class="item_title">{$menutitle ?: $pagetitle}</span>{/if}
            {if $template == 15}<span class="item_title">{$pagetitle}</span>{/if}
          </a>
        </div>
      </div>

    </div>
  </div>
</div>
{/if}

{* {if $template in [9]}
  <div class="tiles_col col-sxs-1 col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-3">
    <div class="ctgs_block ctlg_block{$class_key == 'modWebLink' ? ' item_block_link' : ''}">
      <a class="item_link" href="{$link}" title="{$pagetitle | clean : 'qq'}" {$link_attributes}>
        <span class="item_preview"><img src="{$image | phpthumbon : $img_cats_params}" alt="{$pagetitle | clean : 'qq'}" class="item_img"></span>
        <span class="item_title">{$menutitle ?: $pagetitle}</span>
      </a>
    </div>
  </div>
{/if} *}

{if $template in [10,21]}
<div class="tiles_col col-xs-12 col-sm-e-6 col-md-6 col-lg-4 col-xl-4">
  {if $label}
    {set $labels = $label | split : '||'}
    {set $labels_arr = 'getLabels' | snippet}
  {/if}
  {if $discount}
    {set $labels_arr['discount'] = '-'~$discount~'%'}
  {/if}

  {set $tp_props = ['image','price','old_price','label','ean']}
  {if $migx_torg | len}
    {if $migx_torg | is_array}
      {set $torg_migx = $migx_torg}
    {else}
      {set $torg_migx = $migx_torg | fromJSON}
    {/if}
    {* сниппет prds_tp писался под более раннюю структуру migx_torg *}
    {* {set $colors = 'prds_tp' | snippet : ['arTp' => $torg_migx, 'field' => 'цвет', 'img_params' => $img_params]} *}
    {if $colors | len}
      {set $colors_json = $colors | toJSON}
      {set $colors_keys = $colors | array_keys}
    {/if}
  {/if}

  <div class="prds_block ctlg_block shk-item" data-id="{$id}">
    <div class="prds_block_top">

      <div class="item_preview_wrap">
        <a class="item_preview_link" href="{$id | url}" {$link_attributes}>
          <span class="item_preview">
            {foreach $labels as $label}
              <span class="item_label {$label}_label" data-label="{$label}"><span>{$labels_arr[$label]}</span></span>
            {/foreach}
            <img class="item_img" src="{$image | phpthumbon : $img_params}" alt="{$pagetitle | clean : 'qq'}" />
          </span>
        </a>
        <div class="item_favorite{$id | in_favorite : ' active|| inactive'}" onclick="return favorite.set({$id}, this)">
          <span class="item_favorite_icon favorite_icon control_icon"></span>
        </div>
        <div class="item_compare{$id | in_compare : ' active|| inactive'}" onclick="return shkCompare.toCompare({$id},{$parent},this)">
          <span class="item_compare_icon compare_icon control_icon"></span>
        </div>
      </div>

    </div>
    <div class="prds_block_btm">

      <div class="item_title_wrap">
        <a class="item_title_link" href="{$id | url}" {$link_attributes}>
          <span class="item_title">{$menutitle ?: $pagetitle}</span>
        </a>
      </div>
      <div class="item_prices">
        {if $old_price}
        <div class="old_price"><span class="price_value">{$old_price | num_format}</span> <span class="price_currency">{'shk3.currency' | option}</span></div>
        {/if}
        <div class="cur_price">Цена: <span class="price_value shk-price">{$price | num_format}</span> <span class="price_currency">{'shk3.currency' | option}</span></div>
      </div>

      <div class="item_shopping">

        <div class="item_controls">
          <form action="{$_modx->resource.id | url}" method="post" class="orderSubmitForm">
            <div class="item_buy_wrap">
              {if ($migx_torg || $template in [21])}
              <a class="btn-btm btn-more" href="{$id | url}" {$link_attributes}>Подробнее...</a>
              {else}
              <button class="btn-btm btn-buy-" type="submit"><span class="icon-shopping-basket"></span> Купить</button>
              {/if}
            </div>
            <div class="item_order_wrap">
              <a class="btn-main btn-order" href="javascript:void(0);" data-toggle="modal" data-target="#orderProduct" data-rid="{$id}" data-pagetitle="{$pagetitle | clean : 'qq'}">Купить в один клик</a>
            </div>
            {if $class_key == 'modSymLink'}
            <input type="hidden" name="shk-id" value="{$content}" />
            {else}
            <input type="hidden" name="shk-id" value="{$id}" />
            {/if}
            <input type="hidden" name="shk-name" value="{$pagetitle | clean : 'qq'}" />
          </form>
        </div>

      </div>

    </div>
  </div>
</div>
{/if}
