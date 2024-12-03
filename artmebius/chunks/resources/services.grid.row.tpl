{set $image_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
{set $noimage_params = '&w='~$preview_width~'&h='~$preview_height~'&zc=0&far=1'}
{if $_pls['tv.image_services']}
  {set $isSVG = ('.svg' in $_pls['tv.image_services']) ? 1 : 0}
  {set $image = ($isSVG) ? $_pls['tv.image_services'] : ($_pls['tv.image_services'] | phpthumbon : $image_params)}
{else}
  {set $image = $_pls['tv.image_services'] | phpthumbon : $noimage_params}
{/if}
{* bg *}
{set $bg_params = '&w='~$bg_width~'&h='~$bg_height~'&zc='~$bg_zc~'&far=1'}
{if $_pls['tv.bg_services']}
  {set $bg_image = $_pls['tv.bg_services'] | phpthumbon : $bg_params}
  {set $bg_html = 'style="background-image: url('~$bg_image~');"'}
{/if}
{* title *}
{set $title = $menutitle ?: $pagetitle}
{set $title_len = $title | len}
{set $title_rows = ($title_len / 25) | ceil}
{set $title_truncate = ($title_length != '') ? $title_length : 100}
{* intro *}
{set $intro = $introtext ?: ($content | notags)}
{set $intro_truncate_arr = ['1'=>'80','2'=>'50','3'=>'25']}
{set $intro_truncate = $intro_truncate_arr[$title_rows]}
{* price *}
{set $price = $_pls['tv.price']}
<div class="col-auto">
  <div class="services_item" {$bg_html}>
    <div class="services_item_inner">

      <div class="services_item_title">
        <a class="services_item_title_link" href="{$id | url}" {$link_attributes}>
          <span class="services_item_title_link_image">
            <img src="{$image}" width="{$preview_width}" height="{$preview_height}" alt="{$pagetitle | clean : 'qq'}" loading="lazy" />
          </span>
          <span class="services_item_title_link_text">{$title | truncate : $title_truncate : '...'}</span>
        </a>
      </div>
      {if $show_intro}{/if}
      <div class="services_item_intro d-flex align-items-center justify-content-between">
        <div class="services_item_intro_text">{$intro | truncate : $intro_truncate : '...'}</div>
        <div class="services_item_more"><a class="services_item_more_link" href="{$id | url}" {$link_attributes}><i class="fal fa-plus"></i></a></div>
      </div>
      {if $price}
      <div class="services_item_price tac">
        <span class="services_item_price_value">{$price | num_format}</span> <span class="services_item_price_currency">руб.</span>
      </div>
      {/if}
      <div class="services_item_controls tac">
        <a href="{$id | url}" class="btn btn-main btn-h-red" data-toggle="modal" data-target="#modal_services_order" data-rid="{$id}" data-pagetitle="{$pagetitle}" data-price="{$price}">Заказать</a>
      </div>

    </div>
  </div>
</div>