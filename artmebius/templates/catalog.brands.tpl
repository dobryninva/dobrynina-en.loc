{extends 'template:base'}

{block 'vars'}
  {parent}
  {set $show_sidebar = 0}
{/block}

{block 'page'}
<div id="page" class="page-inner page-brands{$page_class}">
{/block}

{block 'main'}
  <main class="brands{$content_class ?: ' brands_main'}">
    <div id="brands_catalog" class="content brands_catalog">

      <h1 class="page-header">{$h1 ?: $pagetitle}</h1>

      {'pdoResources' | snippet : [
        'class'            => 'msVendor',
        'select'           => '{"msVendor":"id,name,resource,country,logo"}',
        'sortby'           => 'id',
        'sortdir'          => 'ASC',
        'tplWrapper'       => 'brand.grid.wrapper',
        'tpl'              => 'brand.grid.row',

        'items_per_row_xl' => 6,
        'items_per_row_lg' => 4,
        'items_per_row_md' => 3,
        'items_per_row_sm' => 2,
        'items_per_row_xs' => 1,

        'preview_width'    => 200,
        'preview_height'   => 100,
        'preview_zc'       => 0,
      ]}

      {if $content}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}{/block}