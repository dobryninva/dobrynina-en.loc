{extends 'template:base'}

{block 'vars'}
  {parent}
  {* Настройки отображения *}
  {set $show_sidebar = 0}
  {set $currency = 'shk3.currency' | option}
  {set $price_num = $price | clean : 'num' | int}
  {set $old_price_num = $old_price | clean : 'num' | int}
  {* catalog *}
  {set $set_price = '!get_set_price' | snippet}
  {* images *}
  {set $images_html = 'msGallery' | snippet : [
    'tpl' => 'catalog.product.images'
  ]}
  {* labels *}
  {set $labels_config_arr = 'getLabels' | snippet}
  {set $labels_options = '!msProductOptions' | snippet : [
    'onlyOptions' => 'label',
    'product'     => $id,
    'return'      => 'data',
  ]}
  {if $labels_options.label.value is array}
    {set $labels_active_arr = $labels_options.label.value}
    {foreach $labels_config_arr as $label_key => $label_title}
      {if $label_key in $labels_active_arr}
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
        <span class="label_block label_{$label_key}" data-label="{$label_key}"><span>{$label_title}</span></span>
      {/foreach}
    {/set}
  {/if}
  {* vendor *}
  {set $vendor = $_pls['vendor']}
  {set $vendor_name = $_pls['vendor.name']}
  {set $vendor_country = $_pls['vendor.country']}
  {set $vendor_logo = $_pls['vendor.logo']}
  {set $vendor_resource = $_pls['vendor.resource']}
  {* options *}
    {set $prdt_props_html = '!msProductOptions' | snippet : [
    'tpl'         => 'ms2.product.options',
    'onlyOptions' =>'tolshhina-mm,tolshhina-stenyi-mm,tolshhina-stenyi-sm,tolshhina-polotna-korobki-mm,tolshhina-stali-polotna-korobki-mm,tolshhina-stali-koroba-mm,vyisota-proema-sm,vyisota-proema-mm,shirina-proema-sm,shirina-proema-mm,shirina-nalichnika,massa-netto-kg,razmer-mm,obem-kubm,kolichestvo-klyuchej,vid,tip,stil,color_groups,colors,glasses,baget,otkryivanie,tip-korobki,razmer-proema-v-svetu-sm,vremya-fiksaczii-vremya-polnogo-otverzhdeniya,obem-ballona-litrov,massa-brutto-kg,marka,strana-proizvodstva,kol-vo-v-upakovke-sht,temperatura-primeneniya-c,vyixod-gotovoj-penyi-litrov,model,tip-ustanovki,diametr-mm,zamki,ispolnenie,material-kromki,kol-vo-v-upakovke-pallete,forma-rozetki,seriya,zapiranie,material-korpusa,material-klyucha,primenenie,klass,vrezka,nomer,osobennosti-125,otdelka-123,baget-124,tip-112'
  ]}
  {set $prdt_props_text_html = '!msProductOptions' | snippet : [
    'tpl'         => 'ms2.product.options.text',
    'onlyOptions' =>'opisanie,sootvetstvie-ral,osobennosti_text,osobennosti,steklo,material,otdelka,komplektuyushhie,snoska,otdelka-snaruzhi,otdelka-vnutri,okraska,regulirovka,uplotnenie,uplotnitel,uteplenie-polotna,uteplenie-korobki,usilenie,kreplenie,kachestvo,marka-stali,vnimanie,upakovka'
  ]}
  {set $accessory_properties = 'accessory_properties' | option}
  {set $prdt_accessory_props_text_html = '!msProductOptions' | snippet : [
    'tpl'         => 'ms2.product.options.text',
    'onlyOptions' => $accessory_properties
  ]}
  {* singleOptions *}
  {set $opisanie = '!msProductOptions' | snippet : [
    'tpl'=>'ms2.product.option',
    'onlyOptions'=>'opisanie'
  ] | clean}
  {set $kollekcziya = '!msProductOptions' | snippet : [
    'tpl'=>'ms2.product.option',
    'onlyOptions'=>'kollekcziya'
  ] | clean}
  {set $title = '!msProductOptions' | snippet : [
    'tpl'         =>'ms2.product.option',
    'onlyOptions' =>'title'
  ] | clean}
  {set $availability = '!msProductOptions' | snippet : [
    'tpl'=>'ms2.product.option',
    'onlyOptions'=>'availability'
  ]}
  {* widgets *}
  {set $reviews_html = '!pdoPage@reviews_ajax' | snippet}
  {set $product_set_html = '!msSetInCart.set' | snippet : [
    'sortby'        => 'quantity',
    'sortbyOptions' => 'quantity:integer',
    'sortdir'       => 'DESC',
    'link'          => 3,
    'setActive'     => 0,
    'setMode'       => 'cart',
    'setInput'      => 'checkbox',
    'tpl'           => 'product.set.table'
  ] | clean}
  {set $product_torg_html = '!msOptionsPrice.option' | snippet : [
    'options'     => 'komplektacziya,kolichestvo-poloten,variant-ispolneniya,vrezka,otkryivanie,razmer,razmer-polotna,nomer',
    'tpl'         => 'ms2.torg.options.radio',
    'sortOptions' => 'razmer-polotna:SORT_ASC',

    'constraintOptions' => [
      'kolichestvo-poloten' => ['komplektacziya'],
      'variant-ispolneniya' => ['komplektacziya','kolichestvo-poloten'],
      'vrezka'              => ['komplektacziya'],
      'razmer-polotna'      => ['komplektacziya','kolichestvo-poloten','variant-ispolneniya','otkryivanie'],
      'razmer'              => ['otkryivanie'],
      'otkryivanie'         => ['komplektacziya','razmer-polotna'],
    ],
  ] | clean}
  {set $colors_sort = 'get_colors_sort' | snippet}
  {set $products_slaves_color_ids = 'get_slaves' | snippet : ['id'=>$rid, 'link'=>1]}
  {if ($products_slaves_color_ids | split : "," | count) > 1}
    {set $products_slaves_color_html = 'msProductsExt' | snippet : [
      'resources'     => $products_slaves_color_ids,
      'parents'       => 0,
      'limit'         => 0,
      'sortby'        => 'FIELD(colors, ' ~ $colors_sort ~ ')',
      'sortbyOptions' => 'colors',
      'sortdir'       => 'ASC',
      'tpl'           => 'product.slave.color.row',
    ]}
  {/if}
  {set $products_slaves_glass_ids = 'get_slaves' | snippet : ['id'=>$rid, 'link'=>2]}
  {if ($products_slaves_glass_ids | split : "," | count) > 1}
    {set $products_slaves_glass_html = 'msProductsExt' | snippet : [
      'resources' => $products_slaves_glass_ids,
      'parents'   => 0,
      'limit'     => 0,
      'sortby'    => 'menuindex',
      'sortdir'   => 'ASC',
      'tpl'       => 'product.slave.glass.row',
    ]}
  {/if}

  {* уставить нужный вариант доставки и оплаты *}
  {set $delivery_payment_html = 'prdt_delivery_payment' | option}
  {set $delivery_html = 'prdt_delivery' | option}
  {set $payment_html = 'prdt_payment' | option}
{/block}
{* tpl *}
{block 'page'}
<div id="page" class="page-inner page-product{$page_class}">
{/block}

{block 'widgets_before_main'}{include 'breadcrumbs'}{/block}

{block 'main'}
  <main class="catalog{$content_class ?: ' catalog_main'}">
    <div id="msProduct" class="content prdt_detail shk-item" itemscope itemtype="http://schema.org/Product" data-id="{$id}">

        <div class="prdt_row row">
          <div class="prdt_col col_imgs col-sm-12 col-md-12 col-lg-12 col-xl-5">

            <div id="prdt_imgs" class="prdt_imgs sticky-top">

                {if $labels_html}<span class="prdt_imgs_labels labels_wrap">{$labels_html}</span>{/if}

                {$images_html}

            </div>{* prdt_imgs *}

          </div>{* prdt_col *}
          <div class="prdt_col col_right col-sm-12 col-md-12 col-lg-12 col-xl-6">

            <form id="ms2_form" class="ms2_form msoptionsprice-product mssetincart-product" action="{$id | url}" method="post" autocomplete="off">

              <div class="prdt_ean"><span class="prdt_ean_title">Артикул:</span><span class="prdt_ean_value msoptionsprice-article msoptionsprice-{$id}">{$article ?: '-'}</span></div>

              <h1 class="prdt_title page-header" itemprop="name" title="{$rid}">{$title} <span class="prdt_title_kollekcziya">{$kollekcziya}</span></h1>

              {if $opisanie}
              <div class="prdt_introtext">{$opisanie}</div>
              {/if}

              {if $products_slaves_color_html}
                <div class="prdt_slaves prdt_slaves_color">
                  <div class="prdt_slaves_title prdt_slaves_color_title">Цвет:</div>
                  <div class="prdt_slaves_color_wrapper d-flex align-items-center flex-wrap">{$products_slaves_color_html}</div>
                </div>
              {/if}

              {if $products_slaves_glass_html}
                <div class="prdt_slaves prdt_glass_color">
                  <div class="prdt_slaves_title prdt_glass_color_title">Стекло:</div>
                  <div class="prdt_glass_color_wrapper d-flex align-items-center flex-wrap">{$products_slaves_glass_html}</div>
                </div>
              {/if}

              {if $product_torg_html}
              <div class="prdt_torgs">
                {$product_torg_html}
              </div>
              {/if}

              {if $product_set_html}
              <div class="prdt_sub_title">Комплектация:</div>
              {/if}

              <div class="prdt_prices">

                <div class="prdt_price_type prdt_price_options active{($old_price) ? ' price_with_discount' : ''}">
                  <span class="prdt_price_title">Цена:</span>
                  {if $price}
                    <span class="prdt_price_value prdt_price_options_value {* msoptionsprice-cost msoptionsprice-{$rid} mssetincart-cost mssetincart-{$rid}*}" data-price="{$price_num}">{$price | num_format}</span> <span class="prdt_price_currency">{$currency}</span>
                  {else}
                    <span class="prdt_price_value prdt_price_options_value">по запросу</span>
                  {/if}
                  <div class="prdt_price_old">
                    <span class="prdt_price_old_value msoptionsprice-old-cost msoptionsprice-{$rid}">{$old_price | num_format}</span>
                    <span class="prdt_price_old_currency">{$currency}</span>
                  </div>
                </div>

                {if $product_set_html}
                <div class="prdt_price_type prdt_price_set">
                  <span class="prdt_price_set_title prdt_price_title">За комплект:</span>
                  <span class="prdt_price_set_value {*msoptionsprice-cost msoptionsprice-{$rid} mssetincart-cost mssetincart-{$rid}*}">{($set_price+$price_num) | num_format}</span>
                  <span class="prdt_price_currency">{$currency}</span>
                </div>
                {/if}

              </div>

              <div class="prdt_controls">

                <div class="prdt_count count_wrap">
                  <button class="btn btn-outline btn-h-cyan count_btn count_minus" type="button"><i class="fal fa-minus"></i></button>
                  <input type="text" name="count" {* id="product_price" *} class="form-control count_input" value="1"/>
                  <button class="btn btn-outline btn-h-cyan count_btn count_plus" type="button"><i class="fal fa-plus"></i></button>
                </div>

                <div class="prdt_buy">
                  <button class="btn btn-main btn-buy btn-wide" type="submit" name="ms2_action" value="cart/add"><i class="icon-shopping-basket"></i><span class="orderSubmit">Купить</span></button>
                </div>
                {*
                {if $availability == 1}
                {else}
                  <div class="prdt_not_availability btn btn-outline disabled">Нет в наличии</div>
                  <div class="prdt_order">
                    <a class="btn btn-order btn-main btn-lg btn-wide bd-rs-0" href="javascript:void(0);" data-toggle="modal" data-target="#modal_order_product" data-rid="{$id}" data-pagetitle="{$pagetitle | clean : 'qq'}" title="Запросить коммерческое предложение">Запросить КП</a>
                  </div>
                {/if}
                *}

                <div class="prdt_favorite item_favorite{$id | in_favorite : ' active|| inactive'}" onclick="return favorite.set({$id}, this)">
                  <span class="prdt_favorite_btn btn btn-gray btn-bd-gray btn-bdrs-0 btn-wide-">
                    <span class="prdt_favorite_icon favorite_icon">
                      <svg version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12" height="15" viewBox="0 0 14 18" class="prds_item_favorite_icon_svg">
                        <path d="M13.277,15.188c-0.398,0-0.721,0.314-0.721,0.703c0,0.196-0.068,0.36-0.203,0.49c-0.141,0.136-0.346,0.214-0.546,0.213
                          c-0.197-0.003-0.358-0.068-0.49-0.2l-3.8-3.807C7.381,12.452,7.194,12.376,7,12.376c-0.195,0-0.382,0.076-0.518,0.212l-3.801,3.807
                          c-0.131,0.131-0.292,0.197-0.493,0.2c-0.202,0.004-0.406-0.075-0.546-0.209c-0.133-0.126-0.199-0.288-0.199-0.482V2.813
                          c0-0.775,0.647-1.406,1.443-1.406h8.227c0.796,0,1.443,0.631,1.443,1.406v9.598c0,0.388,0.322,0.704,0.721,0.704
                          c0.399,0,0.723-0.315,0.723-0.704V2.813C14,1.262,12.705,0,11.113,0H2.887C1.295,0,0,1.262,0,2.813v13.091
                          C0,16.473,0.225,17,0.631,17.389c0.407,0.39,0.969,0.612,1.545,0.612c0.013,0,0.025,0,0.038,0c0.584-0.01,1.104-0.227,1.503-0.626
                          L7,14.087l3.283,3.288c0.401,0.402,0.923,0.619,1.506,0.626c0.586,0.006,1.163-0.218,1.579-0.618C13.775,16.99,14,16.461,14,15.892
                          C14,15.503,13.677,15.188,13.277,15.188z"></path>
                      </svg>
                    </span>
                    <span class="prdt_favorite_text">{$id | in_favorite : 'Убрать из избранного||В избранное'}</span>
                  </span>
                </div>

              </div>

              <input type="hidden" name="id" value="{$rid}" />
              <input type="hidden" name="mssetincart_set" value="{$rid}">
            </form>

            <div class="prdt_accord">
              {if $content || $prdt_props_text_html}
                <div class="prdt_accord_item">
                  <div class="prdt_accord_item_title" data-toggle="on" data-toggle-effect="accord" data-toggle-parent=".prdt_accord" data-toggle-activate="1">
                    <span class="prdt_accord_item_title_text"><i class="fal fa-file-alt"></i> Описание</span><i class="prdt_accord_item_title_icon fal toogle-icon"></i>
                  </div>
                  <div class="prdt_accord_item_content" style="display: none;">
                    {if $content}
                    <div class="page-desc" itemprop="description">{$content | imageSlim}</div>
                    {/if}
                    {if $prdt_props_text_html}
                    <div class="prdt_props_text">{$prdt_props_text_html}</div>
                    {/if}
                  </div>
                </div>
              {/if}

              {if $prdt_props_html}
                <div class="prdt_accord_item">
                  <div class="prdt_accord_item_title" data-toggle="on" data-toggle-effect="accord" data-toggle-parent=".prdt_accord" data-toggle-activate="1">
                    <span class="prdt_accord_item_title_text"><i class="fal fa-sliders-h"></i> Характеристики</span><i class="prdt_accord_item_title_icon fal toogle-icon"></i>
                  </div>
                  <div class="prdt_accord_item_content" style="display: none;">
                    <div class="prdt_props">{$prdt_props_html}</div>
                  </div>
                </div>
              {/if}

              {if $prdt_accessory_props_text_html}
              <div class="prdt_accord_item">
                <div class="prdt_accord_item_title" data-toggle="on" data-toggle-effect="accord" data-toggle-parent=".prdt_accord" data-toggle-activate="1">
                  <span class="prdt_accord_item_title_text"><i class="fal fa-key"></i> Фурнитура </span><i class="prdt_accord_item_title_icon fal toogle-icon"></i>
                </div>
                <div class="prdt_accord_item_content" style="display: none;">
                  <div class="prdt_props_text">{$prdt_accessory_props_text_html}</div>
                </div>
              </div>
              {/if}

              {if $product_set_html}
              <div class="prdt_accord_item">
                <div class="prdt_accord_item_title prdt_accessories_title" data-toggle="on" data-toggle-effect="accord" data-toggle-parent=".prdt_accord" data-toggle-activate="1">
                  <span class="prdt_accord_item_title_text"><i class="fal fa-cog"></i> Комплектующие</span><i class="prdt_accord_item_title_icon fal toogle-icon"></i>
                </div>
                <div class="prdt_accord_item_content" style="display: none;">
                  <div class="prdt_set">
                    {$product_set_html}
                    <div style="margin-top: 9px;font-style: italic;">Комплектующие с количеством 0 не попадут в заказ!</div>
                  </div>
                </div>
              </div>
              {/if}

              {if ('reviews' | placeholder)}
              <div class="prdt_accord_item">
                <div class="prdt_accord_item_title" data-toggle="on" data-toggle-effect="accord" data-toggle-parent=".prdt_accord" data-toggle-activate="1">
                  <span class="prdt_accord_item_title_text"><i class="fal fa-comments"></i> Отзывы ({'reviews.total' | placeholder})</span><i class="prdt_accord_item_title_icon fal toogle-icon"></i>
                </div>
                <div class="prdt_accord_item_content" style="display: {$.get.reviews ? 'block' : 'none'};">
                  <div id="reviews_wrapper" class="prdt_reviews reviews_wrapper reviews_main">
                    <div id="reviews_list" class="reviews_list items_list">
                      {'reviews' | placeholder}
                    </div>
                    <div id="pages">{'reviews.nav' | placeholder}</div>
                  </div>
                </div>
              </div>
              {/if}
            </div>
            {* Наличие
            <div class="prdt_available {$availability ? 'available_yes' : 'available_no'}">
              {if $availability}
                <i class="fas fa-circle"></i> В наличии
              {else}
                <i class="fas fa-circle"></i> Под заказ
              {/if}
            </div>
            *}
            {* Бренд
            {if $vendor_name}
            <div class="prdt_brand">
              <div class="prdt_brand_title">Производитель</div>
              {if $vendor_resource != 0}
                <a class="prdt_brand_link" href="{$vendor_resource | url}">{$vendor_name}</a>
              {else}
                <span class="prdt_brand_link">{$vendor_name}</span>
              {/if}
            </div>
            {/if}
            *}
          </div>{* prdt_col *}
        </div>{* prdt_row *}
    </div>{* prdt_detail *}

  </main>
{/block}

{block 'js'}
  <script>

    $(document).on('msoptionsprice_product_action', function (e, action, form, response) {
      if (action === 'modification/get' && response.success && response.data) {
        let mod = response.data.modification || {},
            options = response.data.options || {},
            action = '',
            id = Number($('.prdt_detail input[name="id"]').val());

        if (mod.rid == id) {
          $('.prdt_price_options_value').data('price', mod.price);
          calc_set_price();
          if (options.hasOwnProperty('komplektacziya')) {
            action = (options.komplektacziya == 'В сборе') ? 'options' : 'options/set';
          }
          switch(action){

            case 'options':
              if ($('.prdt_price_set').hasClass('active')) {
                $('.prds_set').find('[name="mssetincart_active[]"]').prop('checked', false).change();
              }
              $('.prdt_price_options').show().addClass('active').siblings('.prdt_price_type').hide().removeClass('active');
              break;

            case 'options/set':
              // $('.prdt_price').hide().removeClass('active').siblings('.prdt_price_type').show();
              $('.prdt_price_type').show();
              $('.prdt_price_options').addClass('active');
              break;

            default:
              break;
          }
        }
      }
    });

    $(document).on('mssetincart_action', function (e, action, data, response) {
      if (action ==='set/get' && response.success && response.data) {
        let prod = response.data.product || {},
            sets = response.data.sets || {},
            prod_price = prod_count = prod_sum = 0,
            id = Number($('.prdt_detail input[name="id"]').val());

        calc_set_price();
      }
    });

    // {* отключаем вкл/выкл комплектов *}
    $('body').on('click', '.prds_set form', function(e) {
      // if (!$(e.target).parents('.prds_set_count').length || !$(e.target).parents('.prds_btn_buy').length) { // for .btn-buy in future
      if (!$(e.target).parents('.prds_set_count').length) {
        e.stopPropagation();
        e.preventDefault();
        return false;
      }
    });

    $('body').on('click', '.prdt_price_type', function(e) {
      let $this = $(this);
      if (!$this.hasClass('active')) {
        $this.addClass('active').siblings().removeClass('active');
        let action = ($this.hasClass('prdt_price_set')) ? 'set' : 'options';

        switch(action){
          case 'set':
            if (!$('.prdt_accessories_title').hasClass('active')) {
              $('.prdt_accessories_title').click();
            }
            $('.prds_set').find('[name="mssetincart_active[]"]').prop('checked', true).change();
            break;

          case 'options':
            $('.prds_set').find('[name="mssetincart_active[]"]').prop('checked', false).change();
            break;
        }
      }
    });

    function calc_set_price() {
      let prod_price = prod_count = prod_sum = set_price = set_count = set_sum = result = 0;

      prod_price = Number($('.prdt_price_options_value').data('price'));
      prod_count = Number($('.prdt_count').find('input[name="count"]').val());
      prod_sum = prod_price * prod_count;
      $('.prds_set').each(function(i, el) {
        let $this = $(this);
        set_price = Number($this.find('.prds_set_price_value').text().replace(' ', ''));
        set_count = Number($this.find('.prds_set_count').find('input[name="count"]').val());
        set_sum += set_price * set_count;
      });

      result = prod_sum + set_sum;
      $('.prdt_price_options_value').text(prod_sum.format(0, 3, ' ', '.'));
      $('.prdt_price_set_value').text(result.format(0, 3, ' ', '.'));
      return;
    }

    tabs.init(1, '.prdt_tabs');

    fullImgOptions = {
      initialSlide   : 0,
      slidesToShow   : 1,
      slidesToScroll : 1,
      arrows         : false,
      // appendArrows   : '.prdt_imgs_full',
      // prevArrow      : '<span class="ctrl-ib ctrl-md ctrl-icon ctrl-angle ctrl-prev ctrl-abs"></span>',
      // nextArrow      : '<span class="ctrl-ib ctrl-md ctrl-icon ctrl-angle ctrl-next ctrl-abs"></span>',
      fade           : true,
      draggable      : false,
      adaptiveHeight : false,
      waitForAnimate : false,
      asNavFor       : '.prdt_imgs_thumb',
    }
    thumbImgOptions = {
      infinite       : false,
      initialSlide   : 0,
      slidesToShow   : 2,
      slidesToScroll : 1,
      dots           : false,
      centerMode     : false,
      centerPadding  : '0px',
      focusOnSelect  : true,//false,
      arrows         : false,
      // appendArrows   : '.prdt_imgs_thumb',
      // prevArrow      : '<span class="ctrl-ib ctrl-md ctrl-icon ctrl-angle ctrl-prev ctrl-abs"></span>',
      // nextArrow      : '<span class="ctrl-ib ctrl-md ctrl-icon ctrl-angle ctrl-next ctrl-abs"></span>',
      speed          : 300,
      useTransform   : true,
      draggable      : false,
      asNavFor       : '.prdt_imgs_full',
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
    }

    prdtSliderFull = $('.prdt_imgs_full').slick(fullImgOptions);
    prdtSliderThumb = $('.prdt_imgs_thumb').slick(thumbImgOptions);

    // msSetInCart in quick view
    if (typeof msSetInCart == 'undefined') {
      msSetInCartConfig={
        "actionUrl":"\/assets\/components\/mssetincart\/action.php",
        "miniShop2":{
          "version":"2.8.3-pl"
        },
        "ctx":"web"
      };
      $.getScript('/artmebius/js/shop/minishop.set.js');
    }

  </script>
{/block}