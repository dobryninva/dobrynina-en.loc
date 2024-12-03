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

var obj_labels = {
  label_10: {title:'-10%' ,class_name:'discount_label_10'},
  label_20: {title:'-20%' ,class_name:'discount_label_20'},
  label_sale: {title:'Акция' ,class_name:'sale_label'},
  label_new: {title:'Новинка' ,class_name:'new_label'},
  label_hit: {title:'Хит' ,class_name:'hit_label'},
}

function label_update(labels) {
  let arr_labels = labels.split(','),
      output = '';
  if (arr_labels.length > 0) {
    arr_labels.forEach(function(label) {
      let label_cur = 'label_' + label,
          label_span = '<span class="item_label ' + obj_labels[label_cur].class_name + '"></span>';
      output += label_span;
    });
  }
  $('#product .prdt_imgs').find('.item_label').remove();
  $('.prdt_full_imgs_wrap').prepend(output);
}

var shkMigx = {
  config : {
    'full' : '#prdt_full_imgs',// '#item_images_full',
    'thumb' : '#prdt_thumb_imgs',// '#item_images_thumb',
  },

  label : null,

  images_full : null,
  images_thumb : null,
  images_added : 0,

  countResult : {},

  init : function(){

    // сохраняем оригинальную метку товара (поддерживает множественный выбор)
    if ($('#product .prdt_imgs').find('.item_label').length > 0) {
      let labels = [];
      $('#product .prdt_imgs').find('.item_label').each(function(index, el) {
        labels.push($(el).attr('data-label'));
      });
      shkMigx.label = labels.toString();
    }

    shkMigx.setAvail();

    $('#product').on('change', '.attr_field input[type=radio]', function() {
      shkMigx.setAvail($(this));
    });

    $(shkMigx.config.thumb).find('.img_thumb').on('click',function(){
      // console.log($(this));
      if($(this)[0].hasAttribute('data-opt-images')){
        let opts_names = $(this).data('opt-images'),
            arr_opts_names = opts_names.split(','),
            key_active = arr_opts_names[0],
            opts_active = key_active.split('__');
        // console.log(opts_names,key_active,key_active,opts_active);
        opts_active.forEach(function(item){
          let opt = item.split('_'),
              $input = $('input[name="'+opt[0]+'"][data-value="'+opt[1]+'"]'),
              $parent_label = $input.parent('label');
          $input.prop('checked',true).change();
          $parent_label.addClass('attr_active').parents('.attr_options_wrap').find('label').not($parent_label).removeClass('attr_active');
        });
        // shkMigx.setOptions(key_active);
      }
    });

  },



  setAvail : function(opt){
    if (typeof opt == 'undefined') {
      opt = $('#opt_value1 .attr_option').first().find('input');
    }

    let activeOpt = opt.attr('name'),
        activeVal = opt.data('value'),
        focusKey = activeOpt+'_'+activeVal;

    $('#product').find('.attr_option').removeClass('attr_avail');

    for(key in crossOptionMap){
      let keySegments = key.split('__');
      if (keySegments.includes(focusKey)) {
        for(let i = 0; i < keySegments.length; i++){
          if (keySegments[i] == focusKey) {
            $('.attr_'+focusKey).siblings().addClass('attr_avail');
          }
          $('.attr_'+keySegments[i]).addClass('attr_avail');
        }
      }
    }

    // если выбранные опции не доступны, сбрасываем
    let currentKey = shkMigx.getActiveKey();
    if (typeof crossOptionMap[currentKey] == 'undefined') {
      for(key in crossOptionMap){
        let keySegments = key.split('__');
        if (keySegments.includes(focusKey)) {
          shkMigx.setOptions(key);
          break;
        }
      }
    }
    else {
      shkMigx.setOptions(currentKey);
    }
  },



  setOptions : function(key){
    key = key || Object.keys(crossOptionMap)[0];
    let valuesKey = key.split('__');
// console.log(valuesKey);
    if (valuesKey.length) {
      for(let i = 0; i < valuesKey.length; i++){
        $('#product').find('.attr_'+valuesKey[i]).each(function(){
          let $label = $(this),
              tv_title = $label.parents('.attr_field').find('.attr_label').attr('data-title'),
              tv_value = $label.attr('data-value');
          // $(this).addClass('attr_active').siblings().removeClass('attr_active');
          $label.addClass('attr_active').parents('.attr_options_wrap').find('label').not($label).removeClass('attr_active');

          // в ТП цвет показать активное значение рядом с заголовком
          if($(this).find('img').length){
            $('#currentColor').remove();
            let previewTitle = $(this).find('img').attr('title');
            if (previewTitle) {
              $(this).parents('.attr_field').find('.attr_label').append('<span id="currentColor">'+previewTitle+'</span>');
            }
          }

          let radio = $(this).find('input[type=radio]');
          radio.prop('checked',true);
          if (!$label.parents('form').find('.torg-option-' + i).length) {
            let input = '<input class="torg-option-' + i + '" type="hidden" name="torg-option[]" value="'+ tv_title + '__' + tv_value + '" />';
            $label.parents('form').append(input);
          } else {
            let $input = $label.parents('form').find('.torg-option-' + i);
            $input.val(tv_title + '__' + tv_value);
          }
          // if (!$label.parents('form').find('[name="torg-option-' + i + '"]').length) {
          //   let input = '<input type="hidden" name="torg-option-' + i +'" value="'+ tv_title + '__' + tv_value + '" />';
          //   $label.parents('form').append(input);
          // } else {
          //   let $input = $label.parents('form').find('[name="torg-option-' + i + '"]');
          //   $input.val(tv_title + '__' + tv_value);
          // }
        });
      }
      shkMigx.updateProduct(key);
    }
  },



  updateProduct : function(key){
    key = key || Object.keys(crossOptionMap)[0];
    if (typeof crossOptionMap[key] != 'undefined') {

      if (typeof crossOptionMap[key].price != 'undefined' && crossOptionMap[key].price) {
        $('#shk-form').find('#productPrice').text(parseInt(crossOptionMap[key].price).format(0, 3, ' ', '.'));
        if (!$('#shk-form').find('[name="torg-price"]').length) {
          let input = '<input class="torg-price" type="hidden" name="torg-price" value="' + (parseInt(crossOptionMap[key].price)) + '" />';
          $('#shk-form').append(input);
        } else {
          $('#shk-form').find('[name="torg-price"]').val(parseInt(crossOptionMap[key].price));
        }
      }

      if (typeof crossOptionMap[key].old_price != 'undefined' && crossOptionMap[key].old_price) {
        $('#product').find("#productPriceOld").text(parseInt(crossOptionMap[key].old_price).format(0, 3, ' ', '.'));
      }

      if (typeof crossOptionMap[key].label != 'undefined' && crossOptionMap[key].label) {
        label_update(crossOptionMap[key].label);
      // } else if (shkMigx.label !== null){ // если нужна оригинальная метка товара
      //   label_update(shkMigx.label);
      } else {
        $('#product .prdt_imgs').find('.item_label').remove();
      }

      if ($('#product').find('.img_thumb').length === 1) {
        prdtSliderThumb.slick('unslick');
      }

      // console.log(crossOptionMap[key]);

      // доп. картинки торгового предложения
      if((typeof crossOptionMap[key].image != 'undefined' && crossOptionMap[key].image) || (typeof crossOptionMap[key].addit_images_orig != 'undefined' && crossOptionMap[key].addit_images_orig)){

        prdtSliderFull.slick('unslick');
        prdtSliderThumb.slick('unslick');
        initialSlideFull = 0;
        initialSlideThumb = 0;

        if (shkMigx.images_full == null) {
          shkMigx.images_full = $(shkMigx.config.full).html();
        }
        if (shkMigx.images_thumb == null) {
          shkMigx.images_thumb = $(shkMigx.config.thumb).html();
        }

        $(shkMigx.config.full).html('');
        $(shkMigx.config.thumb).html('');

        if (shkMigx.images_full != null) {
          $(shkMigx.config.full).html(shkMigx.images_full);
        }
        if (shkMigx.images_thumb != null) {
          $(shkMigx.config.thumb).html(shkMigx.images_thumb);
        }

        // основная картинка торгового предложения
        if (typeof crossOptionMap[key].full != 'undefined') {
           $(shkMigx.config.full).append('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+crossOptionMap[key].full+'"><img src="'+crossOptionMap[key].full+'" alt="" /></a></div>');
           initialSlideFull++;
        }
        if (typeof crossOptionMap[key].thumb != 'undefined') {
          $(shkMigx.config.thumb).append('<div data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+crossOptionMap[key].thumb+'" alt=""></span></div>');
          initialSlideThumb++;
        }

        // доп. картинки
        $.map(crossOptionMap[key].addit_images_orig,function (orig, i) {
          $(shkMigx.config.full).append('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+orig+'"><img src="'+crossOptionMap[key].addit_images_detail[i]+'" alt="" /></a></div>');
          if (Object.keys(crossOptionMap[key].addit_images_orig).length > 0) { // 0 - есди + основная, 1 - только доп. картинки
            $(shkMigx.config.thumb).append('<div data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+crossOptionMap[key].addit_images_preview[i]+'" alt=""></span></div>');
          }
          initialSlideFull++;
          initialSlideThumb++;
        });

// console.log(initialSlideFull,initialSlideThumb);
        // fullImgOptions.initialSlide = initialSlideFull;
        // thumbImgOptions.initialSlide = initialSlideThumb;
        // $(element).slick('slickSetOption', 'speed', 5000, true);
        $(shkMigx.config.full).slick(fullImgOptions);
        $(shkMigx.config.thumb).slick(thumbImgOptions);
        shkMigx.images_added = 1;

      } else { // основные картинки торгового предложения

        // if (!shkMigx.images_added) {
        //   shkMigx.updateImages();
        //   shkMigx.images_added = 1;
        // }

      }

      // shkMigx.showActiveImage();

    } // if (typeof crossOptionMap[key] != 'undefined')

  },



  updateImages : function(){
    let imagesThumbs = [],
      fullArr = [],
      thumbArr = [],
      thumbKeys = {};

    for (key in crossOptionMap) {
      if (!thumbKeys.hasOwnProperty(crossOptionMap[key].image)) {
        if (thumbKeys[crossOptionMap[key].image] === undefined) {
          thumbKeys[crossOptionMap[key].image] = [];
        }
      }
      thumbKeys[crossOptionMap[key].image].push(key);
    }

    for (key in crossOptionMap) {
      if(crossOptionMap[key].image){
        let opt_img = '/images/'+crossOptionMap[key].image,
            opt_img_full = crossOptionMap[key].full,
            opt_img_thumb = crossOptionMap[key].thumb,
            opt_img_key = '';
        if(imagesThumbs.length == 0 || $.inArray(opt_img,imagesThumbs) < 0){
          opt_img_key = thumbKeys[crossOptionMap[key].image].toString();
          fullArr.push('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+opt_img+'"><img src="'+opt_img_full+'" alt="" /></a></div>');
          thumbArr.push('<div data-opt-images="'+opt_img_key+'" data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+opt_img_thumb+'" alt=""></span></div>');
          imagesThumbs.push(opt_img);
        }
      }
    }

    if(imagesThumbs.length){

      prdtSliderFull.slick('unslick');
      prdtSliderThumb.slick('unslick');

      let fullHtml  = $(shkMigx.config.full).html(),
          thumbHtml = $(shkMigx.config.thumb).html();

      // $(shkMigx.config.full).html('');
      // $(shkMigx.config.thumb).html('');

      for (k in fullArr) {
        $(shkMigx.config.full).append(fullArr[k]);
      }
      for (k in thumbArr) {
        $(shkMigx.config.thumb).append(thumbArr[k]);
      }
      // $(shkMigx.config.full).append(fullHtml).slick(fullImgOptions);
      // $(shkMigx.config.thumb).append(thumbHtml).slick(thumbImgOptions);

      $(shkMigx.config.full).slick(fullImgOptions);
      $(shkMigx.config.thumb).slick(thumbImgOptions);

    }
  },



  showActiveImage : function(){
    let activeKeys = shkMigx.getActiveKey();
    if (activeKeys.length) {

      // let opt_current_img = $('.img_thumb[data-opt-image='+activeKeys+']');
      let opt_current_img = $('.img_thumb[data-opt-images*='+activeKeys+']');

      if(opt_current_img.length){
        let slideIndex = (opt_current_img.length > 1) ? $(opt_current_img[0]).parents('.slick-slide').data('slick-index') : $(opt_current_img).parents('.slick-slide').data('slick-index');
        $(shkMigx.config.full).slick('slickGoTo', slideIndex );
        $(shkMigx.config.thumb).slick('slickGoTo', slideIndex );
        //
        $(shkMigx.config.thumb).find('.slick-slide[data-slick-index="'+slideIndex+'"]').find('.img_thumb_inner').addClass('active');
        $(shkMigx.config.thumb).find('.slick-slide[data-slick-index="'+slideIndex+'"]').siblings().find('.img_thumb_inner').removeClass('active');
      };
    }
  },



  getActiveKey : function(){
    let key = [];
    $('#product').find('.attr_option input:checked').each(function(){
        let row = $(this).attr('name') + '_' + $(this).data('value');
        key.push(row);
    });
    if (key.length) {
        return key.join('__');
    }
    else {
        return key;
    }
  },
}

if (typeof crossOptionMap != 'undefined' && Object.keys(crossOptionMap).length) {
  shkMigx.init();
}
