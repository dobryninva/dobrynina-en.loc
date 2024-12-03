{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
  {set $content_position = $_modx->resource.content_position}

  {set $where_options = 0}
  {set $where_arr = $_modx->resource.where | fromJSON}
  {if $_modx->resource.where_code}
    {set $where_json = $_modx->resource.where_code}
  {elseif $_modx->resource.where}
    {set $where_json = '{"template:IN":[10],'}
    {set $data_field_many = 0}
    {set $option_field_many = 0}
    {foreach $where_arr as $row index=$index first=$first last=$last}
      {if $first != 1}
        {if ($row.tv_data_field && $data_field_many)}{set $where_json = $where_json ~ ','}{/if}
        {if ($row.ms_option_field && $option_field_many)}{set $options_json = $options_json ~ ','}{/if}
      {/if}
      {if ($row.tv_data_field && !$data_field_many)}{set $data_field_many = 1}{/if}
      {if ($row.ms_option_field && !$option_field_many)}{set $option_field_many = 1}{/if}
      {switch $row.rule}
        {case ':LIKE'}
          {if $row.tv_data_field}{set $where_json = $where_json ~ '"' ~ $row.tv_data_field ~ $row.rule ~ '":"%' ~ $row.field_value ~ '%"'}{/if}
          {if $row.ms_option_field}{set $options_json = $options_json ~ '"' ~ $row.ms_option_field ~ $row.rule ~ '":"%' ~ $row.field_value ~ '%"'}{/if}
        {case ':IN'}
          {* {set $field_value_arr = $row.field_value | split : ','} *}
          {* {set $field_value_str = $field_value_arr | join : ','} *}
          {if $row.tv_data_field}{set $where_json = $where_json ~ '"' ~ $row.tv_data_field ~ $row.rule ~ '":[' ~ $row.field_value ~ ']'}{/if}
          {if $row.ms_option_field}{set $options_json = $options_json ~ '"' ~ $row.ms_option_field ~ $row.rule ~ '":[' ~ $row.field_value ~ ']'}{/if}
        {case default}
          {if $row.tv_data_field}{set $where_json = $where_json ~ '"' ~ $row.tv_data_field ~ $row.rule ~ '":"' ~ $row.field_value ~ '"'}{/if}
          {if $row.ms_option_field}{set $options_json = $options_json ~ '"' ~ $row.ms_option_field ~ $row.rule ~ '":"' ~ $row.field_value ~ '"'}{/if}
      {/switch}
    {/foreach}
    {set $where_json = $where_json ~ '}'}
    {if $options_json}{set $options_json = '{' ~ $options_json ~ '}'}{/if}
  {/if}

  {if $_modx->resource.sortby_parent}
    {set $sortby_parent_arr = $_modx->resource.sortby_parent | split : ','}
    {set $sortby_parent_arr = array_reverse($sortby_parent_arr)}
    {set $sortby_parent = $sortby_parent_arr | join : ','}
    {set $sortby = 'FIELD(modResource.parent, '~$sortby_parent~')'}
    {set $sortdir = 'DESC'}
  {else}
    {set $sortby = 'prds_sortby' | option}
    {set $sortdir = 'prds_sortdir' | option}
  {/if}
  {set $products_params = [
    'element'            => 'msProductsExt',
    'parents'            => 7,
    'depth'              => 10,
    'limit'              => 'prds_limit' | option,
    'sortby'             => $sortby,
    'sortdir'            => $sortdir,

    'tpl'                => 'product.grid.row',
    'tplWrapper'         => 'product.grid.wrapper',
    'wrapIfEmpty'        => 0,

    'ajaxMode'           => 'default',
    'ajaxElemWrapper'    => '#products',
    'ajaxElemRows'       => '#products .ajax_rows',
    'ajaxElemPagination' => '#products #pages',
    'ajaxElemLink'       => '#products #pages a',

    'items_per_row_xl'   => 'prds_per_row_xl' | option,
    'items_per_row_lg'   => 'prds_per_row_lg' | option,
    'items_per_row_md'   => 'prds_per_row_md' | option,
    'items_per_row_sm'   => 'prds_per_row_sm' | option,
    'items_per_row_xs'   => 'prds_per_row_xs' | option,
    'preview_width'      => 'prds_preview_width' | option,
    'preview_height'     => 'prds_preview_height' | option,
    'preview_zc'         => 'prds_preview_zc' | option,
    'watermark'          => 'prds_preview_wm' | option,

    'tplPageFirst'       =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-double-left"></span></a></li>',
    'tplPageFirstEmpty'  =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-double-left"></span></a></li>',
    'tplPageLast'        =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-double-right"></span></a></li>',
    'tplPageLastEmpty'   =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-double-right"></span></a></li>',
    'tplPageNext'        =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-right"></span></a></li>',
    'tplPageNextEmpty'   =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-right"></span></a></li>',
    'tplPagePrev'        =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-left"></a></li>',
    'tplPagePrevEmpty'   =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-left"></a></li>',
  ]}
  {if $where_json}
    {set $products_params = array_merge($products_params,['where'=>$where_json])}
    {set $where_options = 1}
  {/if}
  {if $options_json}
    {set $products_params = array_merge($products_params,['optionFilters'=>$options_json])}
    {set $where_options = 1}
  {/if}
{/block}

{block 'page'}
<div id="page" class="page-inner page-category page-offers{$page_class}">
{/block}

{block 'main'}
  <main class="catalog{$content_class ?: ' catalog_main'}">
    <div id="category" class="content category_catalog">

      <h1 class="page-header">{$h1 ?: $pagetitle}</h1>

      {if ($content != '' && $content_position == 'before')}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

      {if $where_options}
        <div id="products">
          <div class="ajax_rows">
            {'!pdoPage' | snippet : $products_params}
          </div>
          <div id="pages">
            {'page.nav' | placeholder}
          </div>
        </div>
      {/if}

      {if ($content != '' && $content_position == 'after')}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}{/block}
