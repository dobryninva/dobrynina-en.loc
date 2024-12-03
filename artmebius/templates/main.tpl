{extends 'template:base'}

{block 'vars'}
  {parent}
  {set $slider_main_arr = $_modx->resource.slider_main | fromJSON}
  {set $advantages_arr = $_modx->resource.advantages | fromJSON}
  {* params *}
  {set $products_main_params = [
    'parents'          => 7,
    'depth'            => 10,
    'limit'            => 4,
    'where'            => '{"template:IN":[10]}',
    'sortby'           => 'RAND()',
    'sortdir'          => 'ASC',
    'tplWrapper'       => 'product.grid.wrapper',
    'tpl'              => 'product.grid.row',
    'wrapIfEmpty'      => 0,
    'includeThumbs'    => 'medium',

    'cssWrapper'       => ''

    'items_per_row_xl' => 4,
    'items_per_row_lg' => 4,
    'items_per_row_md' => 2,
    'items_per_row_sm' => 2,
    'items_per_row_xs' => 1,

    'preview_width'    => 320,
    'preview_height'   => 240,
    'preview_zc'       => 0,
    'watermark'        => $prds_watermark,
  ]}
  {set $articles_main_params = [
    'select'           => '{"modResource":"id,parent,template,menuindex,pagetitle,menutitle,link_attributes,publishedon,introtext,content"}',
    'depth'            => 0,
    'hideContainers'   => 1,
    'showHidden'       => 1,
    'limit'            => 4,
    'sortby'           => 'menuindex',
    'sortdir'          => 'ASC',
    'processTVs'       => 0,
    'useWeblinkUrl'    => 1,
    'frontend_css'     => '',
    'tplWrapper'       =>'resource.grid.wrapper',
    'tpl'              =>'resource.grid.row',

    'cssWrapper'       => ''

    'show_title'       => 1,
    'show_date'        => 0,
    'show_preview'     => 1,
    'show_intro'       => 1,
    'show_more'        => 0,
    'title_length'     => 50,
    'intro_length'     => 200,

    'items_per_row_xl' => 4,
    'items_per_row_lg' => 4,
    'items_per_row_md' => 2,
    'items_per_row_sm' => 2,
    'items_per_row_xs' => 2,

    'preview_width'    => 320,
    'preview_height'   => 240,
    'preview_zc'       => 0,
  ]}
{/block}

{block 'page'}
<div class="page page_main">
{/block}

{block 'page_sect_wrap'}
  <div id="page__sect-wrap" class="page__sect-wrap">
{/block}

{block 'sect_before_main'}
  {* ########### slider_main ########### *}
  {if $slider_main_arr?}
  <section class="page__sect page__sect_slider d-none d-md-block">
    <div class="slider-main">
      <div class="slider-main__items slider_before">
        {foreach $slider_main_arr as $slide index=$idx}
        <div class="slider-main__item" data-idx="{$idx}">
          <div class="slider-main__bg" data-bglazy="{($img_dir~$slide.image) | phpthumbon : '&w=1920&h=630&zc=1&far=1&q=95'}">
            {if $slide.link?}
              {set $slide_url = ($slide.url | ematch : '/^\d+/') ? ($slide.url | url) : $slide.url}
              <a  class="slider-main__link-abs"
                  href="{$slide_url}"
                  {if '.pdf' in string $slide_url}target="_blank"{/if}
                  {if $slide_url | ematch : '/^#/'}data-target="{$slide_url}" data-toggle="modal" rel="nofollow" {/if}
              ></a>
            {/if}
            <div class="slider-main__container container">
              <div class="slider-main__info">
                {if $slide.title?}
                  <div class="slider-main__title">{'title2rows' | snippet : ['title' => $slide.title, 'bfr' => 1]}</div>
                {/if}
                {if $slide.desc?}
                  <div class="slider-main__desc">{$slide.desc}</div>
                {/if}
              </div>
            </div>
          </div>
        </div>
        {/foreach}
        {* если в поле ссылки есть # значит это ссылка на всплывающую форму; для ссылки-слайда нужно изменить проверку на добавление data-target="{$slide_url}" data-toggle="modal"
        {if $slide.url?}
          <div class="slider-main__btn-wrap">
            {if $slide_url | ematch : '/^#/'}
              <span class="slider-main__btn btn btn-main" data-target="{$slide_url}" data-toggle="modal">{$slide.btn_text}</span>
            {else}
              <a class="slider-main__btn btn btn-main" href="{$slide_url}" {if '.pdf' in string $slide_url}target="_blank"{/if}>{$slide.btn_text}</a>
            {/if}
          </div>
        {/if}
        *}
      </div>
    </div>
  </section>
  {/if}

  {* ########### Категории на главной ########### *}
  <section class="page__sect sect-cats-main sect-xs-3">
    <div class="container">
      <div class="page__header page-header">Каталог</div>
      {'pdoResources' | snippet : [
        'select'           => '{"modResource":"id,pagetitle,menutitle,link_attributes,class_key"}',
        'parents'          => 7,
        'depth'            => 0,
        'hideContainers'   => 0,
        'showHidden'       => 1,
        'limit'            => 0,
        'where'            => '{"template:IN":[9]}',
        'sortby'           => 'menuindex',
        'sortdir'          => 'ASC',
        'includeTVs'       => 'image_category',
        'useWeblinkUrl'    => 1,
        'tplWrapper'       => 'category.main.wrapper',
        'tpl'              => 'category.main.row',
        'frontend_css'     => '',

        'items_per_row_xs' => 2,
        'items_per_row_sm' => 2,
        'items_per_row_md' => 4,
        'items_per_row_lg' => 4,
        'items_per_row_xl' => 4,

        'preview_width'    => 320,
        'preview_height'   => 240,
        'preview_zc'       => 0,
      ]}
    </div>
  </section>

  {* ########### Товары: общие параметры + товары с метками ########### *}
  <section class="page__sect sect-xs-3">
    <div class="container">
      {set $products_hit_html = '!msProductsExt' | snippet : array_merge($products_main_params,[
        'optionFilters' =>'{"prod_label:IN":["Хит"]}',
        'cssWrapper'    => 'products-grid_hit products-grid_slider slider_height_auto'
      ])}
      {if $products_hit_html?}
        <div class="page__header page__header_hit page-header">Хиты</div>
        {$products_hit_html}
      {/if}
      {set $products_new_html = '!msProductsExt' | snippet : array_merge($products_main_params,[
        'optionFilters' =>'{"prod_label:IN":["Новинка"]}',
        'cssWrapper'    => 'products-grid_new products-grid_slider slider_height_auto'
      ])}
      {if $products_new_html?}
        <div class="page__header page__header_new page-header">Новинки</div>
        {$products_new_html}
      {/if}
      {set $products_sale_html = '!msProductsExt' | snippet : array_merge($products_main_params,[
        'optionFilters' =>'{"prod_label:IN":["Акция"]}',
        'cssWrapper'    => 'products-grid_sale products-grid_slider slider_height_auto'
      ])}
      {if $products_sale_html?}
        <div class="page__header page__header_sale page-header">Акция</div>
        {$products_sale_html}
      {/if}
    </div>
  </section>

  {* ########### Преимущества ########### *}
  {if $advantages_arr?}
  <section class="page__sect sect-xs-3">
    <div class="container">
      {if $advantages_arr?}
      <div class="advantages advantages_grid">
        <div class="advantages__items row row-cols-xs-1 row-cols-sm-3 row-cols-md-3 row-cols-lg-3 row-cols-xl-3">
          {foreach $advantages_arr as $item index=$idx}
            {set $advantage_image = ('.svg' in $item.icon) ? ($img_dir~$item.icon) : (($img_dir ~ $item.icon) | phpthumbon : '&w=70&h=70&zc=0&far=1')}
            <div class="advantages__col col-auto">
              <div class="advantage advantages__item">
                <div class="advantage__img-wrap">
                  <img class="advantage__img" src="{$advantage_image}" width="70" height="70" alt="{$item.title | notags | clean : 'qq'}" loading="lazy">
                </div>
                <div class="advantage__icon-wrap"><i class="advantage__icon fa fa-plus"></i></div>
                <div class="advantage__idx">0{$idx+1}</div>
                <div class="advantage__title">{$item.title}</div>
                <div class="advantage__desc">{$item.desc | nl2br}</div>
              </div>
            </div>
          {/foreach}
        </div>
      </div>
      {/if}
    </div>
  </section>
  {/if}

  {* ########### Бренды: слайдер ########### *}
  {set $brands_html = 'pdoResources' | snippet : [
    'class'            => 'msVendor',
    'select'           => '{"msVendor":"id,name,resource,country,logo"}',
    'sortby'           => 'id',
    'sortdir'          => 'ASC',
    'tplWrapper'       => '@INLINE <div class="row slider_before_multi slider_height_auto">{$output}</div>',
    'tpl'              => 'brand.grid.row',
    'items_per_row_xl' => 6,
    'items_per_row_lg' => 4,
    'items_per_row_md' => 3,
    'items_per_row_sm' => 2,
    'items_per_row_xs' => 1,
  ]}
  {if $brands_html?}
  <section class="page__sect sect-xs-3">
    <div class="container">
      <div class="page__header page__header_brands page-header">Бренды</div>
      <div class="brands-grid brands-grid_slider slider_height_auto">
        <div class="brands-grid__items row slider_before_multi">
          {$brands_html}
        </div>
      </div>
    </div>
  </section>
  {/if}

  {* ########### Новости ########### *}
  {set $news_html = 'pdoResources' | snippet : array_merge($articles_main_params,[
    'parents'    => 23,
    'includeTVs' => 'image'
    'cssWrapper' => 'articles-grid_slider slider_height_auto'
  ])}
  {if $news_html?}
  <section class="page__sect sect-xs-3">
    <div class="container">
      <div class="page__header page__header_news page-header">Новости>
      {$news_html}
      <div class="page__more more more_news">
        <a class="more__link" href="{23|url}">Смотреть все</a>
      </div>
    </div>
  </section>
  {/if}

  {* ########### Отзывы: из ресурса 27 || из товаров, если убрать resources ########### *}
  {set $reviews_html = '!getComments' | snippet : [
    'resources' => 27,
    'tpl'       => 'comments.grid.row',
    'limit'     => 10
  ]}
  {if $reviews_html?}
  <section class="page__sect page__sect_reviews sect-xs-3">
    <div class="container">
      <div class="page__header page__header_reviews page-header">Бренды</div>
      <div class="reviews-grid reviews-grid_slider slider_height_auto">
        <div class="reviews-grid__items row row-cols-xs-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-3 slider_before_multi">
          {$reviews_html}
        </div>
      </div>
    </div>
  </section>
  {/if}
{/block}

{block 'top'}{/block}

{block 'breadcrumbs'}{/block}

{block 'widgets_before_main'}{/block}

{block 'main'}
  <div class="page__sect page__sect_main container">
    <main class="article">
      {if $show_title == 1}<h1 class="article__header page-header">{$h1 ?: $pagetitle}</h1>{/if}
      <div class="article__content page-desc">{$content | imageSlimExt : "phpthumbon=q=90"}</div>
    </main>
  </div>
{/block}

{block 'widgets_after_main'}{/block}

{block 'bottom'}{/block}

{block 'sect_after_main'}
  {include 'consultation'}
{/block}


{block 'js'}
{* <script src="/artmebius/js/catalog/categories_slider.min.js"></script> *}
<script>

  // tabs.init(1, '.tabs_main');

  // sliders
  const main_slider_params = {
    infinite      : true,
    lazyLoad      : 'ondemand',
    accessibility : false,
    fade          : true,
    autoplay      : false, // true
    autoplaySpeed : 10000,
    speed         : 500,
    pauseOnHover  : false,
    dots          : true,
    dotsClass     : 'ctrl-dots dots-black-active-accent dots-small-active-big',
    arrows        : false,
    zIndex        : 500,
    useTransform  : true,
    draggable     : false
  };
  $('.slider-main__items').slick(main_slider_params);

  const products_slider_params = {
    autoHeight     : true,
    infinite       : false,
    accessibility  : false,
    fade           : false,
    autoplay       : false, // true ?
    autoplaySpeed  : 15000,
    speed          : 500,
    slidesToShow   : 1,
    slidesToScroll : 1,
    cssEase        : 'ease-out',
    dots           : true,
    dotsClass      : 'ctrl-dots dots-black-active-accent dots-small-active-big',
    arrows         : false,
    prevArrow      : '<span class="ctrl-b ctrl-round ctrl-icon ctrl-angle ctrl-prev ctrl-abs"></span>',
    nextArrow      : '<span class="ctrl-b ctrl-round ctrl-icon ctrl-angle ctrl-next ctrl-abs"></span>',
    zIndex         : 500,
    useTransform   : true,
    draggable      : false,
    mobileFirst    : true,
    responsive: [
      {
        breakpoint: 479,
        settings: {
          slidesToShow : 2,
          slidesToScroll : 2,
        }
      },
      {
        breakpoint: 639,
        settings: {
          slidesToShow   : 2,
          slidesToScroll : 2,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow   : 3,
          slidesToScroll : 3,
        }
      },
      {
        breakpoint: 1023,
        settings: {
          slidesToShow   : 4,
          slidesToScroll : 4,
          // arrows         : true,
          // dots           : false,
        }
      },
      {
        breakpoint: 1279,
        settings: {
          slidesToShow   : 4,
          slidesToScroll : 1,
          arrows         : true,
          dots           : false,
        }
      },
    ]
  };
  $('.products-grid_slider .row').slick(products_slider_params);

  const brands_slider_params = {
    autoHeight     : true,
    infinite       : false,
    accessibility  : false,
    fade           : false,
    autoplay       : false,
    autoplaySpeed  : 10000,
    speed          : 500,
    slidesToShow   : 1,
    slidesToScroll : 1,
    cssEase        : 'ease-out',
    dots           : true,
    dotsClass      : 'ctrl-dots dots-black-active-accent dots-small-active-big',
    arrows         : false,
    prevArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-prev ctrl-abs"></span>',
    nextArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-next ctrl-abs"></span>',
    zIndex         : 500,
    useTransform   : true,
    draggable      : false,
    mobileFirst    : true,
    responsive: [
      {
        breakpoint: 480,
        settings: {
          slidesToShow   : 2,
          slidesToScroll : 2,
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToShow   : 3,
          slidesToScroll : 3,
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow   : 4,
          slidesToScroll : 4,
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow   : 5,
          slidesToScroll : 5,
        }
      },
      {
        breakpoint: 1280,
        settings: {
          dots           : false,
          arrows         : true,
          slidesToShow   : 6,
          slidesToScroll : 6,
        }
      }
    ]
  };
  $('.brands-grid_slider .row').slick(brands_slider_params);

  const reviews_slider = {
    // infinite       :false,
    autoHeight     : true,
    accessibility  : false,
    fade           : false,
    autoplay       : false, // true
    autoplaySpeed  : 10000,
    speed          : 500,
    slidesToShow   : 1,
    slidesToScroll : 1,
    pauseOnHover   : true,
    dots           : true,
    dotsClass      : 'ctrl-dots dots-black-active-accent dots-small-active-big',
    arrows         : false,
    prevArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-prev ctrl-abs"></span>',
    nextArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-next ctrl-abs"></span>',
    // appendArrows   : '.reviews_slider .reviews_nav',
    zIndex         : 500,
    useTransform   : true,
    draggable      : false,
    mobileFirst    : true,
    responsive: [
      {
        breakpoint: 639,
        settings: {
          slidesToShow   : 2,
          slidesToScroll : 2,
        }
      },
      {
        breakpoint: 767,
        settings: {
          slidesToShow   : 2,
          slidesToScroll : 2,
        }
      },
      {
        breakpoint: 1023,
        settings: {
          slidesToShow   : 3,
          slidesToScroll : 3,
        }
      },
      {
        breakpoint: 1279,
        settings: {
          dots           : false,
          arrows         : true,
          slidesToShow   : 3,
          slidesToScroll : 3,
        }
      }
    ]
  };
  $('.reviews-grid_slider .row').slick(reviews_slider);

  const articles_slider_params = {
    autoHeight     : true,
    infinite       : false,
    accessibility  : false,
    fade           : false,
    autoplay       : false, // true ?
    autoplaySpeed  : 15000,
    speed          : 500,
    slidesToShow   : 1,
    slidesToScroll : 1,
    cssEase        : 'ease-out',
    dots           : true,
    dotsClass      : 'ctrl-dots dots-black-active-accent dots-small-active-big',
    arrows         : false,
    prevArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-prev"></span>',
    nextArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-next"></span>',
    // appendArrows   : '.articles-grid_slider .row',
    zIndex         : 500,
    useTransform   : true,
    draggable      : false,
    mobileFirst    : true,
    responsive: [
      {
        breakpoint: 479,
        settings: {
          slidesToShow : 2,
          slidesToScroll : 2,
        }
      },
      {
        breakpoint: 639,
        settings: {
          slidesToShow   : 2,
          slidesToScroll : 2,
        }
      },
      {
        breakpoint: 767,
        settings: 'unslick'
      }
    ]
  };

  function tpl_resize() {
    if ($(document).width() < 768) {
      $('.articles-grid_slider .row').slick(articles_slider_params);
    } else {}
  }
  tpl_resize();

  $(window).resize(function(e) {
    tpl_resize();
  });
</script>
{/block}