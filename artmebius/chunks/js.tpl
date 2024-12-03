{* for dev *}
<script src="/artmebius/js/modernizr.min.js"></script>
<script src="/artmebius/js/jquery.min.js"></script>
<script src="/artmebius/js/jquery.touchSwipe.min.js"></script>
<script src="/artmebius/js/jquery.fancybox.min.js"></script>
<script src="/artmebius/js/jquery.maskedinput.min.js"></script>
<script src="/artmebius/js/jquery.viewportchecker.min.js"></script>
<script src="/artmebius/js/core.js"></script>
<script src="/artmebius/js/bootstrap.pack.min.js"></script>
<script src="/artmebius/js/slick.min.js"></script>
<script src="/artmebius/js/sticky.min.js"></script>
{* // adds
<script src="/artmebius/js/bs-cfi.min.js"></script>
<script src="/artmebius/js/popper.min.js"></script>
<script src="/artmebius/js/favorite.min.js"></script>
<script src="/artmebius/js/ajaxRouter/index.min.js"></script>
<script src="/artmebius/js/comparison.min.js"></script>
<script src="/artmebius/js/compare.min.js"></script>
<script src="/artmebius/js/cityReplacer.min.js"></script>
<script src="https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU&aipkey=b22b3ab6-ee8f-4fdd-aa31-f626abc5d15f"></script>
<script src="/artmebius/js/cities.min.js"></script>
*}

{* for production *}
{*
{'MinifyX' | snippet : [
  'minifyJs'   => 1,
  'registerJs' => 'print',
  'jsSources'  =>'/artmebius/js/modernizr.min.js,
                  /artmebius/js/jquery.min.js,
                  /artmebius/js/jquery.touchSwipe.min.js,
                  /artmebius/js/jquery.fancybox.min.js,
                  /artmebius/js/jquery.maskedinput.min.js,
                  /artmebius/js/jquery.viewportchecker.min.js,
                  /artmebius/js/core.js,
                  /artmebius/js/bootstrap.pack.min.js,
                  /artmebius/js/slick.min.js,
                  /artmebius/js/sticky.min.js,
                  '
]}*}
{* // adds for MinifyX
                  /artmebius/js/bs-cfi.min.js,
                  /artmebius/js/popper.min.js,
                  /artmebius/js/ajaxRouter/index.min.js,
                  /artmebius/js/ajaxRouter/index.min.js,
                  /artmebius/js/favorite.min.js,
                  /artmebius/js/comparison.min.js,
                  /artmebius/js/compare.min.js,
                  /artmebius/js/cityReplacer.min.js,
                  https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU&aipkey=b22b3ab6-ee8f-4fdd-aa31-f626abc5d15f,
                  /artmebius/js/cities.min.js,
*}
<script>

  $('[name="phone"]').mask('+7(999)999-99-99',{ placeholder: '_' });
  $('[name="mcb_phone"]').mask('+7(999)999-99-99',{ placeholder: '_' });
  $('[name="ocb_phone"]').mask('+7(999)999-99-99',{ placeholder: '_' });
  $('[name="opf_phone"]').mask('+7(999)999-99-99',{ placeholder: '_' });
  $('[name="sof_phone"]').mask('+7(999)999-99-99',{ placeholder: '_' });


  function subscribe_form_submit(form) {
    let action = $(form).attr('action'),
        data = $(form).serialize();
    if (typeof subscribe_params != 'undefined') {
      data += '&subscribe_params=' + encodeURIComponent(JSON.stringify(subscribe_params));
    }
    $.ajax({
      url: '/artmebius/snippets/ajax.php',
      type: 'POST',
      data: data,
      beforeSend: function(a,b){
        let $email = $(form).find('[name="email"]');
        if ($email.val() == '') {
          $email.addClass('error');
          return false; // fail
        } else {
          $email.removeClass('error');
        }
      }
    })
    .done(function(response) {
      if ($(response).is('.subscribe__form')) {
        $('.subscribe').html(response);
      }
    })
    // .fail(function(response) {})
  }

  $('body').on('submit', '.subscribe__form', function(e) {
    e.preventDefault();
    captcha_exec(this, 'subscribe', subscribe_form_submit);
  });

  // $('.hdr_menu_catalog_switcher').on('click', function(e) {
  //   e.preventDefault();
  //   $.ajax({
  //     url: '/artmebius/snippets/ajax.php',
  //     type: 'POST',
  //     data: {
  //       action: 'get_catalog_menu'
  //     },
  //   })
  //   .done(function(data) {
  //     backdrop.build(data,'left','ajax','<div class="backdrop_mdl backdrop_catalog_menu"></div>','Каталог');
  //     backdrop.show('left','ajax');
  //     $('.backdrop_catalog_menu').find('.menu_vert_slide .parent > a').each(function(i, el) {
  //       $(el).next('ul').prepend('<li class="menu_item"><span class="menu_link menu_link_back">' + $(el).text() + '</span></li>');
  //     });
  //   })
  //   .fail(function(data) {
  //     console.log("error", data);
  //   });
  // });

  let hdr_sticky_params = {
    indent  : 0,
    mobileFirst : true,
    // responsive: [
    //   {
    //     breakpoint: 768,
    //     settings: {
    //       indent: 91
    //       // indent: $('.hdr_logo').outerHeight(true)
    //     }
    //   },
    // or
    //   {
    //     breakpoint: 768,
    //     settings: 'unsticky'
    //   },
    // ]
  }
  // $('.hdr__top').sticky(hdr_sticky_params);
  // $('.hdr__top').scrollShowHide();


  // for product|quick
  let full_images_slider = thumb_images_slider = '';
  let full_images_slider_params = thumb_images_slider_params = {};

  // function tabClickCallback($tab_active) {
  //   prdtSliderFull.slick('refresh');
  //   prdtSliderThumb.slick('refresh');
  // }

  function show_quick_view(url) {
    $.ajax({
      url: url,
      type: 'POST',
      dataType: 'html',
      data: { action: 'quick'},
    })
    .done(function(data) {

      $('#modal_quick_view').modal('show');
      $('#modal_quick_view_html').html(data);
      // $('#modal_quick_view_label').text(title);

      // подрубаем минишоп
      $('#modal_quick_view').find(msOptionsPrice.Product.form).trigger('change');

      // подрубаем слайдер для галереи
      setTimeout(function(){
        prdtSliderFull.slick('refresh');
        prdtSliderThumb.slick('refresh');
      }, 500);

    })
    .fail(function(data) {
      console.log("error", data);
    });
  }

  $('body').on('click', '.prds_item_quick_btn', function(e) {
    e.preventDefault();
    let $product = $(this).parents('.ms2_product'),
        url = $product.find('.ms2_product_link').attr('href');
    show_quick_view(url);
  });

  $('#modal_quick_view').on('hidden.bs.modal', function (e) {
    $('#modal_quick_view_html').empty();
  });


  // modal_order_product
  $('#modal_order_product').on('show.bs.modal', function (e) {
    let button = $(e.relatedTarget),
        title = button.data('pagetitle'),
        rid = button.data('rid'),
        title_ext = '',
        modal = $(this),
        price = $('[data-id="'+rid+'"]').first().find('.price_value').text();

    if (isNumeric(price.replace(' ',''))) {
      price = price.replace(' ','');
    }

    modal.find('#opf_title').val(title + title_ext);
    modal.find('[name="opf_rid"]').val(rid);
    modal.find('[name="opf_price"]').val(price);
  });


  // modal_services_order
  $('#modal_services_order').on('show.bs.modal', function (e) {
    let button = $(e.relatedTarget),
        modal = $(this),
        title = button.data('pagetitle'),
        rid   = button.data('rid'),
        price = button.data('price'),
        title_ext = '';

    modal.find('[name="sof_service"]').val(title);
    modal.find('[name="sof_rid"]').val(rid);
    modal.find('[name="sof_price"]').val(price);
  });

  function init_vc() {
    if ($(document).width() > 1000){ // 751 1007
      $('.ani-fi').not('.op-0, .op-1').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeIn',
        offset: 75
      });
      $('.ani-fiu').not('.op-0, .op-1').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInUp',
        offset: 75
      });
      $('.ani-fiub').not('.op-0, .op-1').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInUpBig',
        offset: 75
      });
      $('.ani-fid').not('.op-0, .op-1').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInDown',
        offset: 75
      });
      $('.ani-fidb').not('.op-0, .op-1').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInDownBig',
        offset: 75
      });
      $('.ani-fir').not('.op-0, .op-1').wrap('<div class="ovh"></div>').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInRight',
        offset: 75,
        callbackFunction: function(elem, action){
          elem.unwrap();
        },
      });
      $('.ani-firb').not('.op-0, .op-1').wrap('<div class="ovh"></div>').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInRightBig',
        offset: 75,
        callbackFunction: function(elem, action){
          elem.unwrap();
        },
      });
      $('.ani-fil').not('.op-0, .op-1').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInLeft',
        offset: 75
      });
      $('.ani-filb').not('.op-0, .op-1').addClass('op-0').viewportChecker({
        classToAdd: 'op-1 animated fadeInLeftBig',
        offset: 75
      });
    }
  }

  init_vc();

  // count for minishop
  function key_num_change(value,code) {
    if (code == 38 || code == 107) {
      if (!value) {
        value = 1;
      } else {
        value++;
      }
    }
    if (code == 40 || code == 109) {
      if (!value) { value = 1; }
      if (value > 1) value--;
    }
    return value;
  }

  $('body').on('keyup', '[name="count"]', function(e) {
    let count = this.value,
        key_code = e.which ? e.which : e.keyCode;
    count = count.replace(/[^\d]+/g,'');
    count = key_num_change(count, key_code);
    $(this).val(count).change();
    // this.value = count;
  });
  $('body').on('click', '.count_minus', function(e) {
    e.preventDefault();
    e.stopPropagation();
    let count = $(this).parents('.count_wrap').find('[name="count"]').val();
    count = (count > 1) ? count - 1 : count;
    $(this).parents('.count_wrap').find('[name="count"]').val(count).change();
  });
  $('body').on('click', '.count_plus', function(e) {
    e.preventDefault();
    e.stopPropagation();
    let count = $(this).parents('.count_wrap').find('[name="count"]').val();
    ++count;
    $(this).parents('.count_wrap').find('[name="count"]').val(count).change();
  });

  // function backdropBuildCallback($content) {
  //   if ($content.hasClass('backdrop_menu')) {}
  //   if ($content.hasClass('backdrop_contacts')) {}
  // }

  function captcha_exec(form, captcha_action, ajax_cb){
    grecaptcha.execute({ action: captcha_action })
      .then(function(token){
        if (token){
          $(form).find('[name="token"]').val(token);
          $(form).find('[name="action"]').val(captcha_action);
          if (ajax_cb !== undefined) {
            ajax_cb(form);
          }
        }
      });
  }

  function get_scripts(){
    // $.getScript('//code-ya.jivosite.com/widget/cbIatny8oQ');
    $.getScript('https://www.google.com/recaptcha/api.js?render=explicit&hl={'cultureKey'|option}', function(){
      grecaptcha.ready(function(){
        grecaptcha.render('recaptcha_badge', {
          'sitekey': '{"recaptcha.v3.site_key"|option}',
          'badge': 'bottomleft',
          'size': 'invisible'
        });
      });
      $(document).trigger('recaptcha_load');
    });
  }

  function page_resize() {
    if ($(document).width() < 768) {
      //
    } else {
      //
    }
  }

  page_resize();

  // events

  // добавить в сравнение
  $('.comparison-go').click(function(e) {
    let count = parseInt($(this).find('.comparison-total').text());
    if (count < 2) {
      e.preventDefault();
      show_message('Внимание!', 'Для сравнения необходимо выбрать минимум 2 товара!');
    }
  });

  // добавить в избранное
  $('.hdr_favorite_link').click(function(e) {
    let count = parseInt($(this).find('.favorite_count').text());
    if (count == 0) {
      e.preventDefault();
      show_message('Внимание!', 'У Вас пока нет товаров в Избранном!');
    }
  });

  function fvtOnToFavoriteCheckClicked(id,elem){
    let $elem = $(elem);
    if (!$elem.hasClass('active')){
      $elem.find('.prdt_favorite_text').text('Убрать из избранного');
    } else {
      $elem.find('.prdt_favorite_text').text('В избранное');
    }
  }

  $('.history_back_link').click(function(e) {
    window.history.back();
  });

  $('body').on('click', '.search_tip_more', function(e) {
    e.preventDefault();
    $('form.msearch2').submit();
    return false;
  });

  $('.form-control').focus(function(e) {
    if ($(this).hasClass('error')) {
      $(this).removeClass('error');
    }
    if ($(this).parents('.form-group').hasClass('has-error')) {
      $(this).removeClass('error').parents('.form-group.has-error').removeClass('has-error').find('.error').empty();
    }
    // if ($(this).hasClass('error')) {
    //   $(this).parents('.form-group.has-error').find('div.error').empty();
    // }
  });
  $('.custom-control-input').on('change', function(e) {
    if ($(this).parents('.form-group').hasClass('has-error')) {
      $(this).removeClass('error').parents('.form-group.has-error').removeClass('has-error').find('.error').empty();
    }
    // if ($(this).hasClass('error')) {
    //   $(this).parents('.form-group.has-error').find('div.error').empty();
    // }
  });

  $('.custom-file-input').change(function(e) {
		let $this = $(this),
		    label = '',
	      comma = '',
	      error_message = '',
	      size = 0,
	      files = this.files;
	      // console.log(files);

	  for (let i = 0; i < files.length; i++) {
	  	size += files[i]['size'];
	    comma = (i + 1 == files.length) ? '' : ', ';
	    label += files[i]['name'] + comma;
	  }

	  if (typeof $this.data('max-size') != 'undefined' && size > $this.data('max-size')) {
	  	error_message = (files.length > 1) ?
	  		'<span style="color:#ff0000;">Размер файлов не должен превышать ' + print_file_size($this.data('max-size')) + '!</span>' :
	  		'<span style="color:#ff0000;">Размер файла не должен превышать ' + print_file_size($this.data('max-size')) + '!</span>';
	  }

	  if (typeof $this.data('max-count') != 'undefined' && files.length > $this.data('max-count')) {
			error_message = '<span style="color:#ff0000;">Количество файлов не должно превышать ' + $this.data('max-count') + '!</span>';
	  }

	  if (error_message) {
	  	$this.prev('.custom-file-label').html(error_message);
	  	return false;
	  }

	  $this.prev('.custom-file-label').text(label);
	});

  // dropdown fix
  // $('.dropright').on('hide.bs.dropdown', function() {
  //   $(this).find('.dropdown-menu').removeAttr('style');
  // });

  $(document).ready(function () {
    // bsCustomFileInput.init('.custom-file-input');
  })

  $(window).on('load', function(){
    setTimeout(get_scripts, 3000);
  });

  $(window).resize(function(e) {
    page_resize();
  });
</script>