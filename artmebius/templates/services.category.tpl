{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 1} *}
  {* services *}
  {set $services_categories_params = [
    'select'           => '{"modResource":"id,pagetitle,menutitle,introtext,content,link_attributes,class_key"}',
    'parents'          => $id,
    'depth'            => 0,
    'hideContainers'   => 0,
    'showHidden'       => 1,
    'limit'            => 0,
    'where'            => '{"template:IN":[24,25]}',
    'sortby'           => 'menuindex',
    'sortdir'          => 'ASC',
    'includeTVs'       => 'image_services,bg_services',
    'useWeblinkUrl'    => 1,
    'tplWrapper'       => 'services.grid.wrapper',
    'tpl'              => 'services.grid.row',
    'frontend_css'     => '',

    'items_per_row_xl' => 4,
    'items_per_row_lg' => 4,
    'items_per_row_md' => 2,
    'items_per_row_sm' => 2,
    'items_per_row_xs' => 1,

    'preview_width'    => 320,
    'preview_height'   => 240,
    'preview_zc'       => 1,

    'bg_width'         => 360,
    'bg_height'        => 290,
    'bg_zc'            => 1,
  ]}
  {set $services_categories_html = 'pdoResources' | snippet : $services_categories_params}
  {set $services_params = [
    'select'           => '{"modResource":"id,pagetitle,menutitle,introtext,content,link_attributes,class_key"}',
    'parents'          => $id,
    'depth'            => 0,
    'hideContainers'   => 0,
    'showHidden'       => 1,
    'limit'            => 0,
    'where'            => '{"template:IN":[26]}',
    'sortby'           => 'menuindex',
    'sortdir'          => 'ASC',
    'includeTVs'       => 'image_services,bg_services,price',
    'useWeblinkUrl'    => 1,
    'tplWrapper'       => 'services.grid.wrapper',
    'tpl'              => 'services.grid.row',
    'frontend_css'     => '',

    'items_per_row_xl' => 4,
    'items_per_row_lg' => 4,
    'items_per_row_md' => 3,
    'items_per_row_sm' => 2,
    'items_per_row_xs' => 1,

    'preview_width'    => 320,
    'preview_height'   => 240,
    'preview_zc'       => 1,

    'bg_width'         => 360,
    'bg_height'        => 290,
    'bg_zc'            => 1,
  ]}
{/block}

{block 'page'}
<div id="page" class="page page_inner page_services">
{/block}

{block 'main'}
  <main class="services {$content_class ?: ' services_main'}">
    <div id="services" class="content">

      <h1 class="page-header">{$h1 ?: $pagetitle}</h1>

      {if $services_categories_html}
        <div class="services_categories">{$services_categories_html}</div>
      {/if}

      <div id="services_wrapper">
        <div id="services_list" class="services_list">
          {'!pdoPage' | snippet : $services_params}
        </div>
        <div id="pages">
          {'page.nav' | placeholder}
        </div>
      </div>

      {if ($.get.page < 2 && $content != '')}
        <div class="page-content">{$content | imageSlimExt : "phpthumbon=q=90"}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}{/block}