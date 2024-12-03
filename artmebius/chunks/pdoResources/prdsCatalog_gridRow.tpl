{set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
<div class="tiles_col col-xs-{$grid_size / $items_per_row_xs} col-sm-{$grid_size / $items_per_row_sm} col-md-{$grid_size / $items_per_row_md} col-lg-{$grid_size / $items_per_row_lg} col-xl-{$grid_size / $items_per_row_xl}">
  <div class="prds_block ctlg_block shk-item">
    <div class="item_link_wrap">
      <a class="item_link" href="{$id | url}" {$link_attributes}>
        <span class="item_preview">
          {switch $_pls['tv.label']}
            {case 'sale'}
              <span class="item_label sale_label">акция</span>
            {case 'new'}
              <span class="item_label new_label">новинка</span>
            {case 'hit'}
              <span class="item_label hit_label">хит</span>
            {case default}
          {/switch}
          <img class="item_img" src="{$_pls['tv.image'] | phpthumbon : $img_params}" alt="{$pagetitle | cleanQuote}" />
        </span>
        <span class="item_title">{$menutitle ?: $pagetitle}</span>
      </a>
    </div>
    <div class="item_shopping">
      {if $_pls['tv.price']}
      <div class="item_prices">
        <div class="cur_price">Цена: {if $_pls['tv.old_price']}<span class="old_price"><span class="old_price_value">{$_pls['tv.old_price'] | num_format}</span></span>{/if} <span class="price_value shk-price">{$_pls['tv.price'] | num_format}</span> <span class="price_currency fa- fa-rub-">{'shk3.currency' | option}</span></div>
      </div>
      {/if}
      <div class="item_control row">
        <div class="col-xs-6 col-sm-6">
          <a class="btn btn-main btn-more" href="{$id | url}" {$link_attributes}>Подробнее</a>
        </div>
        <div class="col-xs-6 col-sm-6">
          <form action="{$_modx->resource.id | url}" method="post" class="orderSubmitForm">
            <button type="submit" class="btn btn-main btn-buy"><span class="fa fa-shopping-basket"></span> Купить</button>
            {if $class_key == 'modSymLink'}
            <input type="hidden" name="shk-id" value="{$content}" />
            {else}
            <input type="hidden" name="shk-id" value="{$id}" />
            {/if}
            <input type="hidden" name="shk-name" value="{$pagetitle | cleanQuote}" />
          </form>
          {* <a class="btn btn-main btn-order" href="javascript:void(0);" data-toggle="modal" data-target="#orderProduct" data-rid="{$id}" data-pagetitle="{$pagetitle | cleanQuote}">Заказать</a> *}
        </div>
      </div>
    </div>
  </div>
</div>