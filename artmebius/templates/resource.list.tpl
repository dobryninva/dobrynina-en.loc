{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
  {* ########### Настройки отображения ########### *}
  {set $limit = ($_modx->resource.resources_per_page != '') ? $_modx->resource.resources_per_page : 12}
  {set $title_length = $_modx->resource.title_length ?: 200}
  {set $intro_length = $_modx->resource.intro_length ?: 200}
  {set $preview_width = $_modx->resource.preview_width ?: 390}
  {set $preview_height = $_modx->resource.preview_height ?: 292}
  {set $preview_zc = $_modx->resource.preview_zc ?: 1}
  {set $includeTVs = $_modx->resource.includeTVs ? $_modx->resource.includeTVs : 'image'}
  {* ########### Параметры списка ресурсов ########### *}
  {set $articles_params = [
    'select'             => '{"modResource":"id,parent,template,menuindex,class_key,pagetitle,menutitle,link_attributes,introtext,content,publishedon"}',
    'parents'            => $id,
    'depth'              => 0,
    'hideContainers'     => 1,
    'showHidden'         => 1,
    'limit'              => $limit,
    'sortby'             => $_modx->resource.sortby,
    'sortdir'            => $_modx->resource.sortdir,
    'includeTVs'         => $includeTVs,
    'processTVs'         => 1,
    'useWeblinkUrl'      => 1,
    'frontend_css'       => '',

    'ajaxMode'           => 'default',
    'ajaxElemWrapper'    => '#articles_wrapper',
    'ajaxElemRows'       => '#articles_wrapper #articles_list',
    'ajaxElemPagination' => '#articles_wrapper #pages',
    'ajaxElemLink'       => '#articles_wrapper #pages a',

    'items_class'        => $_modx->resource.items_class,
    'show_title'         => $_modx->resource.show_title,
    'title_length'       => $title_length,
    'show_date'          => $_modx->resource.show_date,
    'show_preview'       => $_modx->resource.show_preview,
    'show_intro'         => $_modx->resource.show_intro,
    'intro_length'       => $intro_length,
    'show_more'          => $_modx->resource.show_more,
    'items_per_row_xl'   => $items_per_row_xl,
    'items_per_row_lg'   => $items_per_row_lg,
    'items_per_row_md'   => $items_per_row_md,
    'items_per_row_sm'   => $items_per_row_sm,
    'items_per_row_xs'   => $items_per_row_xs,
    'preview_width'      => $preview_width,
    'preview_height'     => $preview_height,
    'preview_zc'         => $preview_zc,
  ]}
  {switch $_modx->resource.resources_view}
    {case 'grid'}
      {set $articles_view_params = ['tplWrapper'=>'resource.grid.wrapper','tpl'=>'resource.grid.row']}
    {case 'list'}
      {set $articles_view_params = ['tplWrapper'=>'resource.list.wrapper','tpl'=>'resource.list.row']}
    {case 'table'}
      {set $articles_view_params = ['tplWrapper'=>'resource.table.wrapper','tpl'=>'resource.table.row']}
  {/switch}
  {set $articles_params = array_merge($articles_params, $articles_view_params, $pagination_params)}
{/block}

{block 'page'}
<div class="page page_inner{($_modx->resource.page_class ?: 'page_articles')|before:' '}">
{/block}

{block 'main'}
  <main class="article{($_modx->resource.content_class ?: 'article_list')|before:' '} content">

    <h1 class="article__header page-header">{$h1 ?: $pagetitle}</h1>

    <div id="articles_wrapper">
      <div id="articles_list" class="article__articles-list">
        {'!pdoPage' | snippet : $articles_params}
      </div>
      <div id="pages" class="page__pagination">
        {'page.nav' | placeholder}
      </div>
    </div>

    {if ($.get.page < 2 && $content != '')}
      <div class="article__content page-desc">{$content | imageSlim}</div>
    {/if}
  </main>
{/block}

{block 'js'}
{if $_modx->resource.custom_script}
  {ignore}<script>$_modx->resource.custom_script</script>{/ignore}
{/if}
{/block}