{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 1} *}
{/block}

{block 'page'}
<div id="page" class="page-inner page-favorite{$page_class}">
{/block}

{block 'main'}
  {set $favorite_ids = 'favorite.items' | placeholder}
  {if $favorite_ids}
    {set $products_html = '!msProductsExt' | snippet : [
      'resources'        => $favorite_ids,
      'parents'          => 7,
      'depth'            => 10,
      'limit'            => 0,
      'sortby'           => 'prds_sortby' | option,
      'sortdir'          => 'prds_sortdir' | option,
      'tpl'              => 'product.grid.row',
      'tplWrapper'       => 'product.grid.wrapper',
      'wrapIfEmpty'      => 0,

      'items_per_row_xl' => 'prds_per_row_xl' | option,
      'items_per_row_lg' => 'prds_per_row_lg' | option,
      'items_per_row_md' => 'prds_per_row_md' | option,
      'items_per_row_sm' => 'prds_per_row_sm' | option,
      'items_per_row_xs' => 'prds_per_row_xs' | option,

      'preview_width'    => 'prds_preview_width' | option,
      'preview_height'   => 'prds_preview_height' | option,
      'preview_zc'       => 'prds_preview_zc' | option,
      'watermark'        => 'prds_watermark' | option,
    ]}
  {/if}
  <main class="catalog{$content_class ?: ' catalog_main'}">
    <div id="catalog_favorite" class="content catalog_favorite">

      <h1 class="page-header">{$pagetitle}</h1>

      {if $products_html}
        {include 'widget'
          mdl_class_sfx = ' catalog_main products_favorite'
          mdl_content   = $products_html
          mdl_show_more = 0
        }
      {else}
        <p>Вы пока не добавили товары в Избранное.</p>
      {/if}

      {if ($content != '')}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}{/block}