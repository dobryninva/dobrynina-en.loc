{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 1} *}
  {var $ids = '!mSearch2' | snippet : [
    'returnIds' => 1,
    'limit' => 0,
  ]}
  {set $products_params = [
    'element'            => 'msProductsExt',
    'resources'          =>$ids,
    'parents'            => 7,
    'depth'              => 10,
    'limit'              => 'prds_limit' | option,
    'sortby'             => 'prds_sortby' | option,
    'sortdir'            => 'prds_sortdir' | option,
    'where'              =>'{"template:IN":[10]}',

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
{/block}

{block 'page'}
<div id="page" class="page-inner page-search{$page_class}">
{/block}

{block 'main'}
  <main class="search search_main{$content_class ?: ' catalog_main'}">
    <div id="search_result" class="content search_result">

      <h1 class="page-header">{$h1 ?: $pagetitle}</h1>

      {if $ids}
        <div id="products">
          <div class="ajax_rows">
            {'!pdoPage' | snippet : $products_params}
          </div>
          <div id="pages">
            {'page.nav' | placeholder}
          </div>
        </div>
      {else}
        <p>По вашему запросу ничего не найдено. Попробуйте ввести похожие по смыслу слова, чтобы получить лучший результат.</p>
      {/if}

      {if $content != ''}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}{/block}