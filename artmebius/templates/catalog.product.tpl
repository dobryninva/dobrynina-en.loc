{extends 'template:base'}

{block 'vars'}
  {parent}
  {* Настройки отображения *}
  {set $show_sidebar = 0}
  {set $currency = 'cfg_currency' | option}
  {set $price_num = $price | clean : 'num' | int}
  {set $old_price_num = $old_price | clean : 'num' | int}
  {* ########### Картинки ########### *}
  {* для разметки og *}
  {set $og_image = 'msGallery' | snippet : [
    'where'=>'{"rank":0, "parent":0}',
    'tpl'=>'@INLINE {if ($files)}{$files[0]["url"]}{/if}'
  ]}
  {* $image[0]['medium'] - small || medium || big || url *}
  {set $image = 'msGalleryExt' | snippet : [
    'where'=>'{"rank":0, "parent":0}',
    'return' => 'data'
  ]}
  {* галерея *}
  {set $images_html = 'msGallery' | snippet : [
    'tpl' => 'catalog.product.images'
  ]}
  {* ########### Метки товара ########### *}
  {set $labels_config_arr = 'getLabels' | snippet}
  {set $labels_options = '!msProductOptions' | snippet : [
    'onlyOptions' => 'prod_label',
    'product'     => $id,
    'return'      => 'data',
  ]}
  {if $labels_options.product_label.value is array}
    {set $labels_active_arr = $labels_options.product_label.value}
    {foreach $labels_config_arr as $label_key => $label_title}
      {if $label_title in $labels_active_arr}
        {set $labels_arr[$label_key] = $label_title}
      {/if}
    {/foreach}
  {/if}
  {if $price && $old_price}
    {set $discount = (100 - ($price_num * 100 / $old_price_num)) | round}
    {set $labels_arr['discount'] = '-'~$discount~'%'}
  {/if}
  {if $labels_arr}
    {set $labels_html}
      {foreach $labels_arr as $label_key => $label_title}
      	<span class="labels__item labels__item_{$label_key}" data-label="{$label_key}"><span class="labels__text">{$label_title}</span></span>
      {/foreach}
    {/set}
  {/if}
  {* ########### Производители ########### *}
  {set $vendor = $_pls['vendor']}
  {set $vendor_name = $_pls['vendor.name']}
  {set $vendor_country = $_pls['vendor.country']}
  {set $vendor_logo = $_pls['vendor.logo']}
  {set $vendor_resource = $_pls['vendor.resource']}
  {* ########### Опции ########### *}
  {set $main_properties_comma = 'prdt_main_properties' | option}{* fix main_properties *}
  {set $prdt_props_main_html = 'msProductOptions' | snippet : [
		'tpl'         => 'ms2.product.options.main',
		'onlyOptions' => $main_properties_comma
  ] | clean}
  {set $prdt_props_html = 'msProductOptions' | snippet : [
		'tpl'           => 'ms2.product.options',
		'ignoreOptions' => 'prod_availability'
  ] | clean}
  {*
  'ignoreGroups' => 'Каталог',
  'sortGroups'   => 'Двигатель,Трансмиссия,Коробка передач,Шины и параметры колес,Электрооборудование,Тормоза,Основные',
  *}
  {set $availability = 'msProductOptions' | snippet : [
    'tpl'         =>'ms2.product.option',
    'onlyOptions' =>'prod_availability'
  ] | clean}
  {* ########### Информация об доставке и оплате из конфигуратора ########### *}
  {set $delivery_payment_html = 'prdt_delivery_payment' | option}
  {set $delivery_html = 'prdt_delivery' | option}
  {set $payment_html = 'prdt_payment' | option}
  {* ########### Общие параметры для виджетов товаров ########### *}
  {set $products_params = [
    'parents'          => 7,
    'depth'            => 10,
    'limit'            => $prds_limit,
    'where'            => '{"template:IN":[10]}',
    'sortby'           => 'menuindex',
    'sortdir'          => 'ASC',
    'tpl'              => 'product.grid.row',
    'tplWrapper'       => 'product.grid.wrapper',
    'cssWrapper'       => '',
    'wrapIfEmpty'      => 0,

    'items_per_row_xl' => 4,
    'items_per_row_lg' => 3,
    'items_per_row_md' => 2,
    'items_per_row_sm' => 2,
    'items_per_row_xs' => 1,

    'includeThumbs'    => 'medium',
    'preview_width'    => $prds_preview_width,
    'preview_height'   => $prds_preview_height,
    'preview_zc'       => $prds_preview_zc,
    'watermark'        => $prds_watermark,
  ]}
{/block}


{block 'page'}
<div class="page page_inner page_product{$page_class}">
{/block}


{block 'main'}
	<main id="msProduct" class="product-detail{$content_class|before:' '}" itemscope itemtype="http://schema.org/Product" data-id="{$id}">

		<h1 class="product-detail__header page-header" itemprop="name">{$h1 ?: $pagetitle}</h1>

    <form id="ms2_form" class="product-detail__form ms2_form" action="{$id | url}" method="post" autocomplete="off">

      <div class="product-detail__row row">
        <div class="product-detail__col product-detail__col_images col-sm-12 col-md-12 col-lg-7">

          <div id="product-detail__images" class="product-detail__images">

            {if $labels_html}<span class="product-detail__labels labels">{$labels_html}</span>{/if}

            {$images_html}

          </div>{* prdt_imgs *}

        </div>{* prdt_col *}
        <div class="product-detail__col product-detail__col_right col-sm-12 col-md-12 col-lg-5">

          <div class="product-detail__prices">
            {if $old_price}
              <div class="product-detail__price-old">
                <span class="product-detail__price-old-value">{$old_price | num_format}</span>
                <span class="product-detail__price-old-currency">{$currency}</span>
              </div>
            {/if}

            <div class="product-detail__price{($old_price) ? ' product-detail__price_discount price-discount' : ''}" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
              <meta itemprop="category" content="{$parent | resource : 'pagetitle'}">
              {* <meta itemprop="offerCount" content="1"> *}
              <meta itemprop="price" content="{$price | replace : ' ' : '' }">
              {* <meta itemprop="lowPrice" content="{$price | replace : ' ' : '' }"> *}
              <meta itemprop="priceCurrency" content="RUB">
              {if ($availability in list [1, 'true'])}
	              <meta itemprop="availability" content="InStock">
              {else}
	              <meta itemprop="availability" content="PreOrder">{* OutOfStock *}
              {/if}
              <link itemprop="url" href="{$id | url}">
              <span class="product-detail__price-title">Цена</span>
              {if $price}
                <span class="product-detail__price-value price-value">{$price | num_format}</span> <span class="product-detail__price-currency">{$currency}</span>
              {else}
                <span class="product-detail__price-value price-value-empty">по запросу</span>
              {/if}
            </div>
          </div>

          <div class="product-detail__available {($availability in list [1, 'true']) ? 'product-detail__available_y' : 'product-detail__available_n'}">
            {if ($availability in list [1, 'true'])}
              <i class="product-detail__available-icon fas fa-circle"></i> В наличии
            {else}
              <i class="product-detail__available-icon fas fa-circle"></i> Под заказ
            {/if}
          </div>

          <div class="product-detail__controls">

            {if ($availability in list [1, 'true'])}
              <div class="product-detail__buy">
                <button class="product-detail__buy-btn btn btn-main" type="submit" name="ms2_action" value="cart/add">
                	<span class="product-detail__buy-btn-text orderSubmit">Купить</span>
                </button>
              </div>

              <div class="product-detail__count count-wrap">
                <button class="btn btn-outline btn-h-cyan count-wrap__btn count-wrap__btn_minus" type="button"><i class="ti-minus"></i></button>
                <input type="text" name="count" id="product_price" class="form-control count-wrap__input" value="1"/>
                <button class="btn btn-outline btn-h-cyan count-wrap__btn count-wrap__btn_plus" type="button"><i class="ti-plus"></i></button>
              </div>
            {else}
              <div class="product-detail__not-available btn btn-outline disabled w-100">Нет в наличии</div>
              {*
              <div class="product-detail__order">
                <a class="product-detail__order-btn btn btn-main btn-lg btn-wide bd-rs-0" href="javascript:void(0);" data-toggle="modal" data-target="#modal_order_product" data-rid="{$id}" data-pagetitle="{$pagetitle | clean : 'qq'}" title="Запросить коммерческое предложение">Запросить КП</a>
              </div>
              *}
            {/if}

          </div>

          <div class="product-detail__favorite-compare">
            {'!addComparison' | snippet : [
              'list_id' => 19,
              'id'      =>$id,
              'tpl'     =>'product.detail.comparison.add'
            ]}

            <div class="product-detail__favorite favorite-item{$id | in_favorite : ' active|| inactive'}" onclick="return favorite.set({$id}, this)">
              <span class="product-detail__favorite-link">
                <i class="product-detail__favorite-icon favorite_icon fal fa-heart"></i>
                <span class="product-detail__favorite-text">{$id | in_favorite : 'Убрать из избранного||Добавить в избранное'}</span>
              </span>
            </div>
          </div>

          {if $vendor_name?}
	          <div class="product-detail__brand">
	            <div class="product-detail__brand-title">Производитель</div>
	            {if $vendor_resource != 0}
	              <a class="product-detail__brand-link" href="{$vendor_resource | url}">{$vendor_name}</a>
	            {else}
	              <span class="product-detail__brand-link">{$vendor_name}</span>
	            {/if}
	          </div>
          {/if}

          {if $prdt_props_main_html?}
            <div class="product-detail__props-main d-none d-md-block">
              <div class="product-detail__props-title">Характеристики</div>
              <div class="product-detail__props-items">
                {$prdt_props_main_html}
                <div class="product-detail__props-item props-item">
                  <a class="product-detail__props-link props-item__link" href="#prdt_props">Все характеристики <i class="fal fa-chevron-circle-right"></i></a>
                </div>
              </div>
            </div>
          {/if}

          {* ########### Поделиться (яндекс) ########### *}
          {*
          <div class="product-detail__share">
            <div class="product-detail__share-title">Поделиться</div>
            <script src="https://yastatic.net/share2/share.js" async></script>
            <div class="product-detail__share-items ya-share2" data-bare data-curtain data-color-scheme="whiteblack" data-services="vkontakte,facebook,twitter"></div>
          </div>
          *}

        </div>{* prdt_col *}
      </div>{* prdt_row *}

      <input type="hidden" name="id" value="{$rid}" />
    </form>

    <div class="product-detail__tabs tabs tabs_main tabs_md-">
      <div class="tabs__titles d-none d-md-flex">
        {if $content}
	        <div class="tabs__title" data-target="#prdt_desc">Описание</div>
        {/if}
        {if $prdt_props_html}
	        <div class="tabs__title" data-target="#prdt_props">Характеристики</div>
        {/if}
        {if $delivery_payment_html}
	        <div class="tabs__title" data-target="#prdt_delivery_payment">Доставка и оплата</div>
        {/if}
      </div>

      <div class="tabs__contents">
        {if $content}
	        <div class="tabs__title-mob page-header-xs d-md-none" data-toggle="on" data-toggle-activate="1" data-toggle-effect="accord">Описание <i class="tabs__title-mob-icon fal toogle-icon d-md-none"></i></div>
	        <div id="prdt_desc" class="tabs__content">
	          <div class="product-detail__content page-desc" itemprop="description">{$content | imageSlim}</div>
	        </div>
        {/if}
        {if $prdt_props_html}
	        <div class="tabs__title-mob page-header-xs d-md-none" data-toggle="on" data-toggle-activate="1" data-toggle-effect="accord">Характеристики <i class="tabs__title-mob-icon fal toogle-icon d-md-none"></i></div>
	        <div id="prdt_props" class="tabs__content">
	          <div class="product-detail__props">{$prdt_props_html}</div>
	        </div>
        {/if}
        {if $delivery_payment_html}
	        <div class="tabs__title-mob page-header-xs d-md-none" data-toggle="on" data-toggle-activate="1" data-toggle-effect="accord">Доставка и оплата <i class="tabs__title-mob-icon fal toogle-icon d-md-none"></i></div>
	        <div id="prdt_delivery_payment" class="tabs__content">
	        	<div class="product-detail__delivery-payment">
		          {$delivery_payment_html}
	        	</div>
	        </div>
        {/if}
      </div>
    </div>
  </main>
{/block}


{block 'widgets_after_main'}

	{* ########### Похожие товары ########### *}
  {set $products_siblings_html = '!msProductsExt' | snippet : array_merge($products_params,[
		'sortby'     => 'RAND()',
		'where'      =>'{"template":10,"id:!=":'~$id~'}',
		'parents'    => $parent,
		'depth'      => 0,
		'cssWrapper' => 'products-grid_siblings products-grid_slider slider_height_auto'
  ])}
  {if $products_siblings_html?}
    <div class="page__header page__header_siblings page-header">Похожие товары</div>
    {$products_siblings_html}
  {/if}

  {* ########### Рекомендованные товары (через связь) ########### *}
  {set $products_recommended_html = 'msProductsExt' | snippet : array_merge($products_params,[
		'parents'    => 0,
		'limit'      => 0,
		'sortby'     => 'pagetitle',
		'link'       => 1,
		'master'     => $id,
		'cssWrapper' => 'products-grid_recommended'
  ])}
  {if $products_recommended_html?}
    <div class="page__header page__header_recommended page-header">Рекомендованные товары</div>
    {$products_recommended_html}
  {/if}

{/block}

{block 'js'}
  <script>
    full_images_slider_params = {
      initialSlide   : 0,
      slidesToShow   : 1,
      slidesToScroll : 1,
      arrows         : false,
      fade           : true,
      draggable      : false,
      adaptiveHeight : false,
      waitForAnimate : false,
      asNavFor       : '.product-detail__images-thumbs'
    };
    thumb_images_slider_params = {
      infinite       : false,
      initialSlide   : 0,
      slidesToShow   : 2,
      slidesToScroll : 1,
      dots           : false,
      centerMode     : false,
      centerPadding  : '0px',
      focusOnSelect  : true,//false,
      arrows         : true,
      prevArrow      : '<span class="ctrl-abs ctrl-md ctrl-icon ctrl-angle ctrl-prev"></span>',
      nextArrow      : '<span class="ctrl-abs ctrl-md ctrl-icon ctrl-angle ctrl-next"></span>',
      speed          : 300,
      useTransform   : true,
      draggable      : false,
      asNavFor       : '.product-detail__images-full',
      mobileFirst    : true,
      responsive: [
        {
          breakpoint: 479,
          settings: {
            slidesToShow: 2,
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 3,
          }
        },
        {
          breakpoint: 1023,
          settings: {
            slidesToShow: 4
          }
        },
        {
          breakpoint: 1279,
          settings: {
            slidesToShow: 4
          }
        }
      ]
    };

    full_images_slider = $('.product-detail__images-full').slick(full_images_slider_params);
    thumb_images_slider = $('.product-detail__images-thumbs').slick(thumb_images_slider_params);

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
	    prevArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-prev"></span>',
	    nextArrow      : '<span class="ctrl-b ctrl-md ctrl-icon ctrl-angle ctrl-next"></span>',
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
	      $('.products-grid_slider>.row').slick(products_slider_params);
	    } else {}
	  }
	  tpl_resize();

	  $(window).resize(function(e) {
	    tpl_resize();
	  });
  </script>
{/block}