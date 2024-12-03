{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
  {'brand_fields_get' | snippet}
  {set $brand_name = 'brand.name' | placeholder}
  {set $brand_resource = 'brand.resource' | placeholder}
  {set $brand_country = 'brand.country' | placeholder}
  {set $brand_logo = 'brand.logo' | placeholder}
  {set $brand_address = 'brand.address' | placeholder}
  {set $brand_phone = 'brand.phone' | placeholder}
  {set $brand_fax = 'brand.fax' | placeholder}
  {set $brand_email = 'brand.email' | placeholder}
  {set $brand_description = 'brand.description' | placeholder}
  {set $brand_properties = 'brand.properties' | placeholder}
  {* prds *}
  {set $prds_preview_width  = 'prds_preview_width' | option}
  {set $prds_preview_height = 'prds_preview_height' | option}
  {set $prds_preview_zc     = 'prds_preview_zc' | option}
  {set $prds_watermark      = 'prds_preview_wm' | option}
  {set $brand_products_params = [
    'element'            => 'msProductsExt',
    'parents'            => 7,
    'depth'              => 10,
    'limit'              => 12,
    'sortby'             => 'menuindex',
    'sortdir'            => 'ASC',
    'where'              => '{"Vendor.name": "'~($brand_name | replace : '"' : '\"')~'"}',
    'tpl'                => 'product.grid.row',
    'tplWrapper'         => 'product.grid.wrapper',

    'ajaxMode'           => 'default',
    'ajaxElemWrapper'    => '#brand_prods_wrapper',
    'ajaxElemRows'       => '#brand_prods_wrapper .brand_prods',
    'ajaxElemPagination' => '#brand_prods_wrapper #pages',
    'ajaxElemLink'       => '#brand_prods_wrapper #pages a',

    'items_per_row_xl'   => 3,
    'items_per_row_lg'   => 3,
    'items_per_row_md'   => 2,
    'items_per_row_sm'   => 2,
    'items_per_row_xs'   => 1,

    'preview_width'      => $prds_preview_width,
    'preview_height'     => $prds_preview_height,
    'preview_zc'         => $prds_preview_zc,
    'watermark'          => $prds_watermark,

    'tplPageFirst'       =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-double-left"></span></a></li>',
    'tplPageFirstEmpty'  =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-double-left"></span></a></li>',
    'tplPageLast'        =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-double-right"></span></a></li>',
    'tplPageLastEmpty'   =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-double-right"></span></a></li>',
    'tplPageNext'        =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-right"></span></a></li>',
    'tplPageNextEmpty'   =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-right"></span></a></li>',
    'tplPagePrev'        =>'@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-left"></a></li>',
    'tplPagePrevEmpty'   =>'@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-left"></a></li>'
  ]}
{/block}

{block 'page'}
<div id="page" class="page-inner page-brand{$page_class}">
{/block}

{block 'main'}
  <main class="brands{$content_class ?: ' brands_main'}">
    <div id="brand_detail" class="content brand_catalog">

      <h1 class="page-header">{$h1 ?: $pagetitle}</h1>

      <div id="brand_prods_wrapper">
        <div id="brand_prods" class="brand_prods">
          {'!pdoPage' | snippet : $brand_products_params}
        </div>
        <div id="pages">
          {'page.nav' | placeholder}
        </div>
      </div>

      {if $content}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}{/block}