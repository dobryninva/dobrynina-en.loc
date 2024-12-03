{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
	{* ########### Главные категории ########### *}
  {set $categories_view = $_modx->resource.categories_view}
  {set $categories_params = [
		'select'           => '{"modResource":"id,parent,template,menuindex,pagetitle,menutitle,link_attributes,introtext,content"}',
		'parents'          => $id,
		'depth'            => 0,
		'hideContainers'   => 0,
		'showHidden'       => 1,
		'limit'            => 0,
		'where'            => '{"template:IN":[9]}',
		'sortby'           => 'menuindex',
		'sortdir'          => 'ASC',
		'includeTVs'       => 'image_category',
		'useWeblinkUrl'    => 1,
		'frontend_css'     => '',
		'cssWrapper'       => '',

		'items_per_row_xl' => 'ctgs_per_row_xl' | option,
		'items_per_row_lg' => 'ctgs_per_row_lg' | option,
		'items_per_row_md' => 'ctgs_per_row_md' | option,
		'items_per_row_sm' => 'ctgs_per_row_sm' | option,
		'items_per_row_xs' => 'ctgs_per_row_xs' | option,

		'preview_width'    => 'ctgs_preview_width' | option,
		'preview_height'   => 'ctgs_preview_height' | option,
		'preview_zc'       => 'ctgs_preview_zc' | option,
  ]}
  {switch $categories_view}
    {case 'grid'}
      {set $categories_view_params = ['tplWrapper'=>'category.grid.wrapper','tpl'=>'category.grid.row']}
    {case 'list'}
      {set $categories_view_params = ['tplWrapper'=>'category.list.wrapper','tpl'=>'category.list.row']}
    {case 'main'}
      {set $categories_view_params = ['tplWrapper'=>'category.main.wrapper','tpl'=>'category.main.row']}
    {case 'slider'}
      {set $categories_view_params = ['tplWrapper'=>'category.slider.wrapper','tpl'=>'category.slider.row']}
  {/switch}
  {set $categories_params = array_merge($categories_params,$categories_view_params)}
{/block}


{block 'page'}
<div class="page page_inner page_category{$page_class}">
{/block}


{block 'main'}
  <main class="category-detail category-detail_main {$content_class|before:' '}">

    <h1 class="category-detail__header page-header">{$h1 ?: $pagetitle}</h1>

    {* ########### Главные категории ########### *}
    <div class="category-detail__categories-grid">
      {'pdoResources' | snippet : $categories_params}
    </div>

    {if $content?}
	    <div class="category-detail__content page-desc">{$content | imageSlimExt : "phpthumbon=q=90"}</div>
    {/if}

  </main>
{/block}


{block 'js'}
  {if $categories_view == 'slider'}
    <script src="/artmebius/js/catalog/categories_slider.min.js"></script>
  {/if}
{/block}