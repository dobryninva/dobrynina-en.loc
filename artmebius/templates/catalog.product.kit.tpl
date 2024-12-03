{extends 'template:base'}

{block 'wrap'}
<div id="wrap" class="page_inner page_product{$page_class}">
{/block}

{block 'main'}
  {set $kit = $_modx->resource.kit}
  {set $color_kit = $_modx->resource.color_kit}
  {set $tkan_kit = $_modx->resource.tkan_kit}
  {set $brand = $_modx->resource.brand}
  {set $ean = $_modx->resource.ean}
  {set $strana = $_modx->resource['pp_strana-proizvoditel']}
  {set $price = $_modx->resource.price}
  {set $old_price = $_modx->resource.old_price}
  {if $_modx->resource.label}
    {set $labels = $_modx->resource.label | split : '||'}
    {set $labels_arr = 'getLabels' | snippet}
  {/if}
  {set $discount = $_modx->resource.discount}
  {if $discount}
    {set $labels_arr['discount'] = '-'~$discount~'%';
  {/if}
  {set $prdt_image_width = 'prdt_image_width' | option}
  {set $prdt_image_height = 'prdt_image_height' | option}
  {set $prdt_image_zc = 'prdt_image_zc' | option}
  {set $watermark = 'prdt_image_wm' | option}
  {set $full_img_params = '&w='~$prdt_image_width~'&h='~$prdt_image_height~'&zc='~$prdt_image_zc~'&far=1'}
  {set $full_img_params_wm = $full_img_params~$watermark}
  {set $prdt_thumb_width = 'prdt_thumb_width' | option}
  {set $prdt_thumb_height = 'prdt_thumb_height' | option}
  {set $prdt_thumb_zc = 'prdt_thumb_zc' | option}
  {set $thumb_img_params = '&w='~$prdt_thumb_width~'&h='~$prdt_thumb_height~'&zc='~$prdt_thumb_zc~'&far=1'}

  {set $reviews_html = '!pdoPage@reviews_ajax' | snippet}
  {set $rating_average = (('ratingAverage' | placeholder) != '') ? ('ratingAverage' | placeholder) : 0}

  {set $recommended_products_ids = $_modx->resource.recommended_products}
  {set $recommended_products_html = '!pdoPage' | snippet : [
    'resources'          => $recommended_products_ids,
    'parents'            => 7,
    'depth'              => 10,
    'select'             => '{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key"}',
    'hideContainers'     => 1,
    'showHidden'         => 1,
    'where'              => ["template:IN" => [10]],
    'limit'              => 9,
    'sortby'             => 'prds_sortby' | option,
    'sortdir'            => 'prds_sortdir' | option,
    'includeTVs'         => 'prds_include_tvs' | option,
    'processTVs'         => 0,
    'useWeblinkUrl'      => 1,
    'tplWrapper'         => 'prdsShop_gridWrapper',
    'tpl'                => 'prdsShop_gridRow',
    'frontend_css'       => '',
    'tplPageWrapper'     => '@INLINE <div class="pagination_bottom"><ul class="pagination">{$first}{$prev}{$pages}{$next}{$last}</ul></div>',
    'ajaxMode'           => 'default',
    'ajaxElemWrapper'    => '#recommended_products',
    'ajaxElemRows'       => '#recommended_products .ajax_rows',
    'ajaxElemPagination' => '#recommended_products #pages',
    'ajaxElemLink'       => '#recommended_products #pages a'
  ]}

  <main class="catalog{$content_class ?: ' catalog_main'}">
    <div id="product" class="content prdt_detail prdt_kit" itemscope itemtype="http://schema.org/Product">

      <h1 class="page-header" itemprop="name">{$h1 ?: $pagetitle}</h1>

      <div class="shk-item" data-id="{$id}">
      <form id="shk-form" action="{$id | url}" method="post" autocomplete="off">

        <div class="prdt_row row">
          <div class="prdt_col col_imgs col-sm-12 col-md-12 col-lg-8">

            <div id="prdt_imgs" class="prdt_imgs">

              <div class="prdt_full_imgs_wrap">

                {foreach $labels as $label}
                  <span class="item_label {$label}_label" data-label="{$label}"><span>{$labels_arr[$label]}</span></span>
                {/foreach}
                {* {if $discount}
                  <span class="item_label discount_label" data-label="discount">-{$discount}%</span>
                {/if} *}

                <div id="prdt_full_imgs" class="prdt_full_imgs slider_before">
                  <div class="full_img_slide">
                    {if $image}
                      <a class="full_img lightbox" href="{($watermark) ? ($image | phpthumbon : $watermark) : $image}" title="{$pagetitle | clean : 'qq'}" data-fancybox="prod">
                        <img src="{$image | phpthumbon : $full_img_params_wm}" alt="{$pagetitle | clean : 'qq'}" />
                      </a>
                    {else}
                      <span class="full_img">
                        <img src="{$image | phpthumbon : $full_img_params}" alt="{$pagetitle | clean : 'qq'}" />
                      </span>
                    {/if}
                  </div>
                  {if $images}
                    {foreach $images as $img}
                      <div class="full_img_slide">
                        {if $img.img_src}
                          <a class="full_img lightbox" href="{($watermark) ? (($img_dir~$img.img_src) | phpthumbon : $watermark) : ($img_dir~$img.img_src)}" title="{$img.img_title ?: $pagetitle | clean : 'qq'}" data-fancybox="prod">
                            <img src="{($img_dir~$img.img_src) | phpthumbon : $full_img_params_wm}" alt="{$img.img_title ?: $pagetitle | clean : 'qq'}" />
                          </a>
                        {else}
                          <span class="full_img">
                            <img src="{$img.img_src | phpthumbon : $full_img_params}" alt="{$pagetitle | clean : 'qq'}" />
                          </span>
                        {/if}
                      </div>
                    {/foreach}
                  {/if}
                </div>
              </div>

              {if $images}
                <div id="prdt_thumb_imgs" class="prdt_thumb_imgs slider_before_multi">
                  <div class="img_thumb">
                    <span class="img_thumb_inner"><img itemprop="image" src="{$image | phpthumbon : $thumb_img_params}" alt="{$pagetitle | clean : 'qq'}"></span>
                  </div>
                  {foreach $images as $img}
                  <div class="img_thumb">
                    <span class="img_thumb_inner">
                      <img src="{($img_dir~$img.img_src) | phpthumbon : $thumb_img_params}" alt="{$img.img_title ?: $pagetitle | clean : 'qq'}">
                    </span>
                  </div>
                  {/foreach}
                </div>
              {/if}

            </div>{* prdt_imgs *}

          </div>{* prdt_col *}
          <div class="prdt_col col_right col-sm-12 col-md-12 col-lg-4">

            <div class="prdt_prices">
              {if ($old_price && $old_price != $price)}
                <div class="old_price">
                  <span id="productPriceOld" class="price_value">{$old_price | num_format}</span> <span class="price_currency">{'shk3.currency' | option}</span>
                </div>
              {/if}
              <div class="price cur_price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                <span class="cur_price_title">Цена:</span>
                <span id="productPrice" class="price_value shk-price">{$price | num_format}</span> <span class="price_currency">{'shk3.currency' | option}</span>
                <meta itemprop="price" content="{$price}">
                <meta itemprop="priceCurrency" content="RUB">
                <meta itemprop="availability" content="PreOrder">
                <link itemprop="url" href="{$id | url}">
              </div>
            </div>

            <div class="prdt_buttons">
              <div class="btn_buy_wrap">
                <button class="btn-buy" type="submit"><i class="icon-shopping-basket"></i><span class="orderSubmit">В корзину</span></button>
              </div>
              <div class="btn_order_wrap">
                <a class="btn-order" href="javascript:void(0);" data-toggle="modal" data-target="#orderProduct" data-rid="{$id}" data-pagetitle="{$pagetitle | clean : 'qq'}">Купить в один клик</a>
              </div>
            </div>

            <div class="prdt_compare_favorite d-xs-flex">
              <div class="prdt_favorite item_favorite{$id | in_favorite : ' active|| inactive'}" onclick="return favorite.set({$id}, this)">
                <span class="prdt_favorite_row">
                  <i class="prdt_favorite_icon control_icon favorite_icon"></i><span class="prdt_favorite_title link-dotted">{$id | in_favorite : 'В избранном||В избранное'}</span>
                </span>
              </div>
              {* <div class="prdt_compare item_compare{$id | in_compare : ' active|| inactive'}" onclick="return shkCompare.toCompare({$id},{$parent},this)">
                <span class="prdt_compare_row">
                  <i class="prdt_compare_icon control_icon compare_icon"></i><span class="prdt_compare_title">{$id | in_compare : 'В сравнении||Сравнить'}</span>
                </span>
              </div> *}
            </div>

            <div class="prdt_props">
              {if $ean}<div class="props_row"><div class="props_title">Модель:</div> <div class="props_value">{$ean}</div></div>{/if}
              {if $color_kit}<div class="props_row"><div class="props_title">Цвет:</div> <div class="props_value">{$color_kit}</div></div>{/if}
              {if $tkan_kit}<div class="props_row"><div class="props_title">Ткань:</div> <div class="props_value">{$tkan_kit}</div></div>{/if}
              {if $brand}<div class="props_row"><div class="props_title">Производитель:</div> <div class="props_value" itemprop="brand">{$brand}</div></div>{/if}
              {if $strana}<div class="props_row"><div class="props_title">Страна:</div> <div class="props_value">{$strana}</div></div>{/if}
            </div>

          </div>{* prdt_col *}
        </div>{* prdt_row *}

        <input type="hidden" name="shk-id" value="{$rid}" />
        <input type="hidden" name="shk-name" value="{$pagetitle | clean : 'qq'}" />
      </form>
      </div>{* shk-item *}

      <div class="tabs tabs_links prdt_tabs">

        <ul class="tabs_titles menu d-xs-none d-md-flex">
          {if $content}<li class="tab_title" data-target="#content">О товаре</li>{/if}
          {* {if $pp}<li class="tab_title" data-target="#products_properties">Характеристики</li>{/if} *}
          {* {if $properties_text}<li class="tab_title" data-target="#properties_text">Характеристики</li>{/if} *}
          <li class="tab_title with_count with_head" data-target="#reviews">Отзывы<span class="tab_count">{'reviews.total' | placeholder}</span><div class="tab_head"><div class="stars_wrap">
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="star"></div>
            <div class="stars_active" style="width: {$rating_average}%;">
              <div class="star active"></div>
              <div class="star active"></div>
              <div class="star active"></div>
              <div class="star active"></div>
              <div class="star active"></div>
            </div>
          </div></div></li>
          {if $recommended_products_ids}
            <li class="tab_title with_count" data-target="#recommended_products">С этим покупают<span class="tab_count">{'page.total' | placeholder}</span></li>
          {/if}
        </ul>

        <div class="tabs_content">

          {if $content}
            <div class="tab_content" id="content">
              <div class="xs-title d-md-none">Описание</div>
              <div class="page-desc" itemprop="description">{$content | imageSlim}</div>
            </div>
          {/if}

          {* {if $pp}
            <div class="tab_content" id="products_properties">
              <div class="xs-title d-md-none">Характеристики</div>
              <div class="prdt_props prdt_props_full" itemprop="description">
                {foreach $pp as $p => $prop}
                  <div class="props_row" data-idx="{$idx}">
                    <div class="props_title">{$prop.name}: </div>
                    <div class="props_value">{$prop.value}</div>
                  </div>
                {/foreach}
              </div>
            </div>
          {/if} *}

          {* {if $properties_text}
            <div class="tab_content" id="properties_text">
              <div class="xs-title d-md-none">Характеристики</div>
              {$properties_text}
            </div>
          {/if} *}

          <div class="tab_content reviews_main" id="reviews">
            <div class="xs-title d-xs-flex justify-content-xs-between align-items-center d-md-none">Отзывы
              <div class="stars_wrap d-xs-inline-block d-md-none">
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="star"></div>
                <div class="stars_active" style="width: {$rating_average}%;">
                  <div class="star active"></div>
                  <div class="star active"></div>
                  <div class="star active"></div>
                  <div class="star active"></div>
                  <div class="star active"></div>
                </div>
              </div>
            </div>
            <div id="reviews_wrapper" class="reviews_wrapper">
              <div id="reviews_list" class="reviews_list items_list">
                {$reviews_html}
              </div>
              <div id="pages">{'reviews.nav' | placeholder}</div>
            </div>
            {'commentFormPlaceholder' | placeholder}
          </div>

          {if $recommended_products_ids}
            <div class="tab_content recommended_products" id="recommended_products">
              <div class="xs-title d-md-none">С этим товаром покупают</div>
              <div class="ajax_rows">
                {$recommended_products_html}
              </div>
              <div id="pages">
                {'page.nav' | placeholder}
              </div>
            </div>
          {/if}

        </div>{* tabs_content *}
      </div>{* tabs *}

      <div class="prod_kit_wrap">
        <div class="prod_kit_switcher active">Скрыть состав</div>
        <div class="prod_kit" data-color="{$color_kit}" data-tkan="{$tkan_kit}" data-discount="{$discount}" style="display: block;">
          {'!kit_prepare' | snippet : ['kit'=>$kit, 'color_kit'=>$color_kit, 'tkan_kit'=>$tkan_kit, 'show_ext'=>1]}
        </div>
      </div>

      {* {if $_modx->user.id in [1,2]}
      <div class="test">
        {'kit_errors' | placeholder}
      </div>
      {/if} *}

    </div>{* prdt_kit *}
  </main>
{/block}

{block 'scripts_tpl'}
{include 'orderProduct_modal'}
  <script>
    function resp_kit_upd() {
      let winW = $(window).width();
      if (winW < 768) {
        $('.prod_kit_wrap').insertAfter('.prdt_block');
      } else {
        $('.prod_kit_wrap').insertAfter('.prdt_tabs');
      }
    }
    resp_kit_upd();

    $('#product').on('click', '[target="_blank"]', function(e) {
      let winW = $(window).width();
      if (winW < 768) {
        if (confirm('Ссылка откроется в новой вкладке, продолжить?')) {
          return true;
        } else {
          return false;
        }
      }
    });

    tabs_init(1, '.prdt_tabs');
    // $('.page-desc').spoiler(21,3,1);
    // $('.prdt_props').spoiler(22,3,1,'Все характеристики','Скрыть характеристики');

    $('#comment-form .star').hover(function() {
      $(this).addClass('hovered').prevUntil().addClass('hovered');
    }, function() {
      $(this).removeClass('hovered').prevUntil().removeClass('hovered');
    });
    $('[name="vote"]').on('change', function(e) {
      $(this).parent().nextUntil().removeClass('active');
      $(this).parent().addClass('active').prevUntil().addClass('active');
    });

    // for orderProduct_modal
    $('[name="opf_phone"]').mask('+7(999)999-99-99',{ placeholder: '_' });
    $('#orderProduct').on('show.bs.modal', function (event) {
      let button = $(event.relatedTarget),
          title = button.data('pagetitle'),
          title_ext = '',
          modal = $(this);
      if ($('[name="kit-option[]"]').length) {
        let arVals = [];
        $('[name="kit-option[]"]').each(function(index, el) {
          arVals.push($(this).val().split('__'));
        });
        title_ext = '\n';
        arVals.forEach(function(item, index, array) {
          let kit_title = '';
          if (typeof(item[2]) != 'undefined') {
            kit_title = $('.prod_kit').find('input[value="' + item[2] + '"]').parents('.kit_row').find('.kit_title').text().trim();
            title_ext += kit_title + ' (' + item[0] + ': ' + item[1] + ')\n';
          } else {
            title_ext += item[0] + ': ' + item[1] + '\n';
          }
        });
      }
      modal.find('#opf_title').val(title + title_ext);
      let price = $('#productPrice').text();
      modal.find('[name="opf_price"]').val(price.replace(' ',''));
    });

    $('.prod_kit_switcher').on('click', function(e) {
      e.preventDefault();
      if ($(this).hasClass('active')) {
        $(this).toggleClass('active').text('Показать состав');
      } else {
        $(this).toggleClass('active').text('Скрыть состав');
      }
      $(this).next('.prod_kit').stop(true, false).fadeToggle('fast');
    });

    slider_init('.ctgs_slider',ctgs_slider_params);
    var fullImgOptions = {
      slidesToShow   : 1,
      slidesToScroll : 1,
      arrows         : false,
      fade           : true,
      draggable      : false,
      adaptiveHeight : true,
      waitForAnimate : false
    }
    var thumbImgOptions = {
      infinite       : false,
      slidesToShow   : 4,
      slidesToScroll : 1,
      dots           : false,
      arrows         : true,
      centerMode     : false,
      centerPadding  : '0px',
      focusOnSelect  : false,
      prevArrow      : '<span class="btn-angle btn-top"></span>',
      nextArrow      : '<span class="btn-angle btn-btm"></span>',
      speed          : 300,
      useTransform   : true,
      draggable      : false,
      vertical: true,
      verticalSwiping: true,
      responsive: [
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
            vertical: false,
            verticalSwiping: false,
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2,
            vertical: false,
            verticalSwiping: false,
          }
        }
      ]
    }
    var attrColorOptions ={
      infinite       : false,
      slidesToShow   : 4,
      slidesToScroll : 1,
      dots           : false,
      arrows         : true,
      centerMode     : false,
      centerPadding  : '0px',
      focusOnSelect  : false,
      prevArrow      : '<span class="btn-angle btn-left"></span>',
      nextArrow      : '<span class="btn-angle btn-right"></span>',
      speed          : 300,
      useTransform   : true,
      draggable      : false,
      responsive: [
        {
          breakpoint: 1280,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3
          }
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 2
          }
        }
      ]
    }
    $('.prdt_thumb_imgs').on('init', function(e, slick){
      slick.$slides.first().find('.img_thumb_inner').addClass('active').parents('.slick-slide').siblings().find('.img_thumb_inner').removeClass('active');
    });
    var prdtSliderFull = $('.prdt_full_imgs').slick(fullImgOptions);
    var prdtSliderThumb = $('.prdt_thumb_imgs').slick(thumbImgOptions);
    $('.attr_field_color .attr_options_wrap').slick(attrColorOptions);
    $(document).on('click', '.img_thumb', function(e) {
      let slide = $(this).parents('.slick-slide'),
          ind = slide.data('slick-index');
      slide.find('.img_thumb_inner').addClass('active');
      slide.siblings().find('.img_thumb_inner').removeClass('active');
      $('.prdt_full_imgs').slick('slickGoTo', ind, false);
    });

    $(window).resize(function(e) {
      resp_kit_upd();
    });
  </script>
  <script src="/artmebius/js/shop/kit.radio.js"></script>
{/block}