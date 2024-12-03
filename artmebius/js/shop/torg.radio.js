if (!Array.prototype.includes) {
  Object.defineProperty(Array.prototype, 'includes', {
    value: function(searchElement, fromIndex) {
      if (this == null) {
        throw new TypeError('"this" is null or not defined');
      }
      var o = Object(this);
      var len = o.length >>> 0;
      if (len === 0) {
        return false;
      }
      var n = fromIndex | 0;
      var k = Math.max(n >= 0 ? n : len - Math.abs(n), 0);
      function sameValueZero(x, y) {
        return x === y || (typeof x === 'number' && typeof y === 'number' && isNaN(x) && isNaN(y));
      }
      while (k < len) {
        if (sameValueZero(o[k], searchElement)) {
          return true;
        }
        k++;
      }
      return false;
    }
  });
}

var labels_obj = {
  label_10: {title:'-10%' ,class_name:'discount_label_10'},
  label_20: {title:'-20%' ,class_name:'discount_label_20'},
  label_sale: {title:'Акция' ,class_name:'sale_label'},
  label_new: {title:'Новинка' ,class_name:'new_label'},
  label_hit: {title:'Хит' ,class_name:'hit_label'},
}

var torg = {
  config : {
    'full'  : '.prdt_full_imgs',// '#item_images_full',
    'thumb' : '.prdt_thumb_imgs',// '#item_images_thumb',
    'prod'  : '.shk-item',
  },

  prid: null,
  prod: null,
  get prods(){
    return $('.shk-item[data-id="'+torg.prid+'"]'); // this.config.prod
  },
  curr: null,

  label : null,

  images_full : null,
  images_thumb : null,
  images_added : 0,

  countResult : {},

  init : function(prid){

    torg.prid = prid;

    // $(torg.config.thumb).find('.img_thumb').on('click',function(){ // re
    //   torg.prid = $(this).parents('.shk-item').data('id');
    //   torg.curr = $(this).parents('.shk-item');
    //   if($(this)[0].hasAttribute('data-opt-images')){
    //     let opts_names = $(this).data('opt-images'),
    //         arr_opts_names = opts_names.split(','),
    //         key_active = arr_opts_names[0],
    //         opts_active = key_active.split('__');
    //     opts_active.forEach(function(item){
    //       let opt = item.split('_'),
    //           $input = $('input[name="'+opt[0]+'"][data-value="'+opt[1]+'"]'),
    //           $parent_label = $input.parent('label');
    //       $input.prop('checked',true).change();
    //       $parent_label.addClass('attr_active').parents('.attr_options_wrap').find('label').not($parent_label).removeClass('attr_active');
    //     });
    //     // torg.setOptions(key_active);
    //   }
    // });

    // init
    torg.prods.each(function(index, el) {
      let key = torg.initOptions($(this));
      $(this).parents('#product').length ? torg.updateProductPage($(this), key) : torg.updateProductPreview($(this), key);
    });

    // change
    torg.prods.on('change', '.attr_tp input[type=radio]', function(e) {
      let input_focus = $(this),
          $prod = input_focus.parents('.shk-item');
      torg.prid = input_focus.parents('.shk-item').data('id');
      let key = torg.changeOptions(input_focus);
      $prod.parents('#product').length ? torg.updateProductPage($prod, key) : torg.updateProductPreview($prod, key);
    });

  },

  initOptions : function($prod){
    let key_focus = key_active = $prod.find('.attr_field:first').find('.attr_option:first').addClass('attr_active').find('input').prop('checked',true).val();

    if ($prod.find('.attr_field').length > 1) {
      for(key_tp in crossOptionMaps[torg.prid]){
        if (key_tp.indexOf(key_focus) != -1) {
          key_active = key_tp;
          break;
        }
      }
    }

    torg.setActive($prod,key_active);
    torg.setAvailable($prod,key_focus,key_active,'dependent');

    return key_active;
  },

  changeOptions: function($input){
    let key_focus = $input.val(),
        key_active = torg.getActive($input),
        $prod = $input.parents('.shk-item');

    key_active = torg.checkActive(key_focus,key_active);
    torg.setActive($prod,key_active);
    torg.setAvailable($prod,key_focus,key_active,'dependent');

    return key_active;
  },

  // проверяем, есть ли ключ в ТП, если нет ищем первый подходящий
  // возвращает ключ
  checkActive: function(key_focus,key_active){
    let key_ok = 0;

    // ищем key_active в тп
    for(key_tp in crossOptionMaps[torg.prid]){
      if (key_tp.indexOf(key_active) != -1) {
        key_ok = 1;
        break;
      }
    }

    if (!key_ok) {
      // ищем первый подходящий key_focus в тп
      for(key_tp in crossOptionMaps[torg.prid]){
        if (key_tp.indexOf(key_focus) != -1) {
          key_active = key_tp;
          break;
        }
      }
    }

    return key_active;
  },

  setActive: function($prod,key_active){
    let key_arr = key_active.split('__');
    $prod.find('.attr_option').removeClass('attr_active');
    for(let i = 0; i < key_arr.length; i++){
      $prod.find('.attr_'+key_arr[i]).addClass('attr_active').find('input').prop('checked',true);

      // в ТП цвет показать активное значение рядом с заголовком // tt ? re
      // if($prod.find('.attr_'+key_arr[i]).find('img').length){
      //   $prod.find('.attr_'+key_arr[i]).parents('.attr_field').find('.attr_label').find('.current_field_value').remove();
      //   let previewTitle = $prod.find('.attr_'+key_arr[i]).find('img').attr('alt');
      //   if (previewTitle) {
      //     $prod.find('.attr_'+key_arr[i]).parents('.attr_field').find('.attr_label').append('<span class="current_field_value">'+previewTitle+'</span>');
      //   }
      // }
    }

    if (!$prod.find('form').find('.torg-id').length) {
      let input = '<input class="torg-id" type="hidden" name="torg-id" value="' + crossOptionMaps[torg.prid][key_active].torg_id + '" />';
      $prod.find('form').append(input);
    } else {
      let $input = $prod.find('form').find('.torg-id');
      $input.val(crossOptionMaps[torg.prid][key_active].torg_id);
    }

  },

  setAvailable: function($prod,key_focus,key_active,type_available){
    // console.log(key_active.indexOf(key_focus)); // 0 || 10

    if (typeof type_available == 'undefined') {
      type_available = 'dependent'; // dependent || first_main
    }
    if (type_available == 'dependent') {
      let availables = 0,
          focus_in = 0;
      $prod.find('.attr_field').each(function(i) {
        if ($(this).find('.attr_option.attr_available').length > availables) {
          availables = $(this).find('.attr_option.attr_available').length;
          focus_in = i;
        }
      });
      if (key_focus != key_active.split('__')[focus_in] && $prod.find('.attr_'+key_focus).hasClass('attr_available')) return;
    }

    if (type_available == 'first_main') {
      key_focus = key_active.split('__')[0];
    }

    $prod.find('.attr_option').removeClass('attr_available');
    $prod.find('.attr_'+key_focus).parents('.attr_field').find('.attr_option').addClass('attr_available');

    for(key_tp in crossOptionMaps[torg.prid]){
      if (key_tp.indexOf(key_focus) != -1) {
        let key_arr = key_tp.split('__');
        for(let i = 0; i < key_arr.length; i++){
          if (key_arr[i] != key_focus) {
            $prod.find('.attr_'+key_arr[i]).addClass('attr_available');
          }
        }
      }
    }

  },

  getActive : function($input){
    let key = '',
        prod = $input.parents('.shk-item');
    // attr_field_value1
    if (prod.find('.attr_field_value1 .attr_option input:checked').length) {
      key = prod.find('.attr_field_value1 .attr_option input:checked').val();
    }
    // attr_field_value2
    if (prod.find('.attr_field_value2 .attr_option input:checked').length) {
      key += '__' + prod.find('.attr_field_value2 .attr_option input:checked').val();
    }
    return key;
  },

  updateProductPage : function($prod, key){
    if (typeof crossOptionMaps[torg.prid][key] != 'undefined') {
      torg.updatePrice($prod, key);
      torg.updateLabels($prod, key);
      torg.updateProps($prod, key);
      torg.updateImagesProduct($prod, key);
      // torg.updateStores($prod, key);
    }
  },

  updateProductPreview : function($prod, key){
    if (typeof crossOptionMaps[torg.prid][key] != 'undefined') {
      torg.updatePrice($prod, key);
      torg.updateLabels($prod, key);
      torg.updateImagesPreviews($prod, key);
    }
  },

  // updateStores : function($prod, key){
  //   if (typeof crossOptionMaps[torg.prid][key].stores != 'undefined') {
  //     if (typeof $prod.parents('#product').find('[data-target="#stores"]').attr('style') != 'undefined') {
  //       $prod.parents('#product').find('[data-target="#stores"]').removeAttr('style');
  //       // $prod.parents('#product').find('[data-target="#stores"]').show();
  //       if (!$prod.parents('#product').find('[data-target="#stores"]').prev('li').length) {
  //         tab_active('#stores', '.prdt_tabs');
  //       }
  //     }
  //     $prod.parents('#product').find('.prdt_stores').html(crossOptionMaps[torg.prid][key].stores);
  //   }
  // },

  updatePrice : function($prod, key){
    // price
    if (typeof crossOptionMaps[torg.prid][key].price != 'undefined' && crossOptionMaps[torg.prid][key].price) {
      $prod.find('.cur_price .price_value').text(parseInt(crossOptionMaps[torg.prid][key].price).format(0, 3, ' ', '.'));
    }

    // old_price
    if (typeof crossOptionMaps[torg.prid][key].old_price != 'undefined' && crossOptionMaps[torg.prid][key].old_price && (crossOptionMaps[torg.prid][key].old_price != crossOptionMaps[torg.prid][key].price)) {
      if (!$prod.find('.old_price').length) {
        $prod.find('.prdt_prices').prepend('<div class="old_price"><span class="price_value"></span><span class="price_currency">₽</span></div>');
      }
      $prod.find('.old_price').show();
      $prod.find('.old_price .price_value').text(parseInt(crossOptionMaps[torg.prid][key].old_price).format(0, 3, ' ', '.'));
    } else {
      $prod.find('.old_price').hide();
    }
  },

  updateLabels : function($prod, key){
    // labels
    let prod_type = ($prod.parents('#product').length) ? 'page' : 'preview';
    if (typeof crossOptionMaps[torg.prid][key].label != 'undefined' && crossOptionMaps[torg.prid][key].label) {
      let labels_arr = crossOptionMaps[torg.prid][key].label.split(','),
          labels_html = '';

      labels_arr.forEach(function(label) {
        let label_cur = 'label_' + label,
            label_span = '<span class="item_label ' + labels_obj[label_cur].class_name + '">' + labels_obj[label_cur].title + '</span>';
        labels_html += label_span;
      });

      $prod.find('.item_label').not('.discount_label').remove();
      if (prod_type == 'page') {
        if (!$prod.find('.labels_wrap').length) {
          $prod.find('.prdt_imgs').prepend('<span class="labels_wrap"></span>');
        }
      } else if (prod_type == 'preview') {
        if (!$prod.find('.labels_wrap').length) {
          $prod.find('.item_preview_link').prepend('<span class="labels_wrap"></span>');
        }
      }
      $prod.find('.labels_wrap').prepend(labels_html);
    } else {
      $prod.find('.item_label').not('.discount_label').remove();
    }

    // discount
    if (typeof crossOptionMaps[torg.prid][key].discount != 'undefined' && crossOptionMaps[torg.prid][key].discount) {
      let discount_label = '<span class="item_label discount_label">-' + crossOptionMaps[torg.prid][key].discount + '%</span>';

      $prod.find('.discount_label').remove();
      if (prod_type == 'page') {
        if (!$prod.find('.labels_wrap').length) {
          $prod.find('.prdt_imgs').prepend('<span class="labels_wrap"></span>');
        }
      } else if (prod_type == 'preview') {
        if (!$prod.find('.labels_wrap').length) {
          $prod.find('.item_preview_link').prepend('<span class="labels_wrap"></span>');
        }
      }
      $prod.find('.labels_wrap').append(discount_label); // .text('-' + crossOptionMaps[torg.prid][key].discount + '%');
    } else {
      $prod.find('.discount_label').remove();
    }
  },

  updateProps : function($prod, key){
    // props
    if (typeof crossOptionMaps[torg.prid][key].props != 'undefined' && crossOptionMaps[torg.prid][key].props) {
      prod.find('.prdt_props_full tbody').html(crossOptionMaps[torg.prid][key].props);
    }

    // props main
    if (typeof crossOptionMaps[torg.prid][key].props_main != 'undefined' && crossOptionMaps[torg.prid][key].props_main) {
      prod.find('.prdt_props_main tbody').html(crossOptionMaps[torg.prid][key].props_main);
    }
  },

  updateImagesProduct : function($prod, key){
    let h1 = $('h1.page-title').text();

    // доп. картинки торгового предложения
    if((typeof crossOptionMaps[torg.prid][key].image != 'undefined' && crossOptionMaps[torg.prid][key].image) || (typeof crossOptionMaps[torg.prid][key].images != 'undefined' && crossOptionMaps[torg.prid][key].images)){

      // деслайдезируем
      $(torg.config.full).slick('unslick');
      $(torg.config.thumb).slick('unslick');

      // сохраняем оригинал и доп.картинки
      if (torg.images_full == null) {
        torg.images_full = $(torg.config.full).html();
      }
      if (torg.images_thumb == null) {
        torg.images_thumb = $(torg.config.thumb).html();
      }

      // удаляем старые картинки
      $(torg.config.full).html('');
      $(torg.config.thumb).html('');

      // добавляем основную картинку торгового предложения к большим изображениям
      if (typeof crossOptionMaps[torg.prid][key].image_full != 'undefined') {
         $(torg.config.full).append('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+crossOptionMaps[torg.prid][key].image+'" title="'+h1+'"><img src="'+crossOptionMaps[torg.prid][key].image_full+'" alt="" /></a></div>');
      }

      // если есть доп. картинки
      if (typeof crossOptionMaps[torg.prid][key].images != 'undefined' && Object.keys(crossOptionMaps[torg.prid][key].images).length) {

        // добавляем контейнер для тумб если нету
        if (!$(torg.config.thumb).length) {
          $prod.find('.prdt_imgs').append('<div id="prdt_thumb_imgs" class="prdt_thumb_imgs slider_before_multi"></div>');
        }

        // добавляем основную картинку торгового предложения к тумбам
        if (typeof crossOptionMaps[torg.prid][key].image_thumb != 'undefined') {
          $(torg.config.thumb).append('<div data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+crossOptionMaps[torg.prid][key].image_thumb+'" alt=""></span></div>');
          // initialSlideThumb++;
        }

        // добавляем доп. картинки
        $.map(crossOptionMaps[torg.prid][key].images,function (image, i) {
          // к большим изображениям
          $(torg.config.full).append('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+image+'"><img src="'+crossOptionMaps[torg.prid][key].images_full[i]+'" alt="" /></a></div>');
          // к тумбам
          if (Object.keys(crossOptionMaps[torg.prid][key].images).length > 0) { // 0: с основной картинкой, 1: - только доп. картинки
            $(torg.config.thumb).append('<div data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+crossOptionMaps[torg.prid][key].images_thumb[i]+'" alt=""></span></div>');
          }
        });

      }

      $(torg.config.full).slick(fullImgOptions);
      $(torg.config.thumb).slick(thumbImgOptions);
      if (!$(torg.config.thumb).find('.img_thumb_inner.active').length) {
        $(torg.config.thumb).find('.slick-current').find('.img_thumb_inner').addClass('active');
      }
      torg.images_added = 1;

    } else {

      if (torg.images_added) {
        // восстанавливаем оригинал и доп.картинки
        if (torg.images_full != null) {
          $(torg.config.full).slick('unslick');
          $(torg.config.full).html('');
          $(torg.config.full).html(torg.images_full).slick(fullImgOptions);
          $(torg.config.full).slick(fullImgOptions);
        }
        if (torg.images_thumb != null) {
          $(torg.config.thumb).slick('unslick');
          $(torg.config.thumb).html('');
          $(torg.config.thumb).html(torg.images_thumb).slick(thumbImgOptions);
          $(torg.config.thumb).slick(thumbImgOptions);
        }
        torg.images_added = 0;
      }

    }

  },

  updateImagesPreviews : function($prod, key){
    // меняем превью на основную картинку торгового предложения
    if (typeof crossOptionMaps[torg.prid][key].image_preview != 'undefined' || typeof crossOptionMaps[torg.prid][key].image_preview != null) {
      $prod.find('.item_preview').html('<img src="'+crossOptionMaps[torg.prid][key].image_preview+'" alt="" />');
    }
  },

  // updateProd : function($prod, key){},

  showActiveImage : function(){ // re
    let activeKeys = torg.getActiveKey();
    if (activeKeys.length) {

      // let opt_current_img = $('.img_thumb[data-opt-image='+activeKeys+']');
      let opt_current_img = $('.img_thumb[data-opt-images*='+activeKeys+']');

      if(opt_current_img.length){
        let slideIndex = (opt_current_img.length > 1) ? $(opt_current_img[0]).parents('.slick-slide').data('slick-index') : $(opt_current_img).parents('.slick-slide').data('slick-index');
        $(torg.config.full).slick('slickGoTo', slideIndex );
        $(torg.config.thumb).slick('slickGoTo', slideIndex );
        //
        $(torg.config.thumb).find('.slick-slide[data-slick-index="'+slideIndex+'"]').find('.img_thumb_inner').addClass('active');
        $(torg.config.thumb).find('.slick-slide[data-slick-index="'+slideIndex+'"]').siblings().find('.img_thumb_inner').removeClass('active');
      };
    }
  },

} // torg

if (typeof crossOptionMaps != 'undefined' && Object.keys(crossOptionMaps).length) {
  // console.log('crossOptionMaps',crossOptionMaps);
  for (let key in crossOptionMaps) {
    torg.init(key);
  }
}