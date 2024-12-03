Number.prototype.format = function(n, x, s, c) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
    num = this.toFixed(Math.max(0, ~~n));

  return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

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

var labels = {
  label_10: {title:'-10%' ,class_name:'discount_label_10'},
  label_20: {title:'-20%' ,class_name:'discount_label_20'},
  label_sale: {title:'Акция' ,class_name:'sale_label'},
  label_new: {title:'Новинка' ,class_name:'new_label'},
  label_hit: {title:'Хит продаж' ,class_name:'hit_label'},
}

function label_update(label) {
  let label_cur = 'label_' + label,
  label_span = '<span class="item_label ' + labels[label_cur].class_name + '">' + labels[label_cur].title + '</span>';
  $('#product').find('.item_label').remove();
  $('#prdt_imgs').prepend(label_span);
}

var shkMigx = {
  config : {
    'full' : '#prdt_full_imgs',// '#item_images_full',
    'thumb' : '#prdt_thumb_imgs',// '#item_images_thumb',
  },

  label : '',

  images_added : 0,

  countResult : {},

  init : function(){
    console.log('init()');

    if ($('#product').find('.item_label').length > 0) {
      // console.log(shkMigx.label);
      shkMigx.label = $('#product').find('.item_label').attr('data-label');
      console.log(shkMigx.label);
    }

    shkMigx.setOptions();
    shkMigx.setAvail();
    shkMigx.showActiveImage();

    // $('#product').find('.attr_field input[type=radio]').on('change',function(){
    $('#product').find('.attr_field select').on('change',function(){
      var opt = $(this).find('option:selected');
      shkMigx.setAttr();
      setTimeout(function(){
        shkMigx.setAvail(opt);
      },10); // ?

      shkMigx.showActiveImage();
    });

  },

  setOptions : function(key){
    console.log('setOptions()', key);
    var key = key || Object.keys(crossOptionMap)[0];
    valuesKey = key.split("__");
    if (valuesKey.length) {
      for(var i = 0; i < valuesKey.length; i++){
        var valSegment = valuesKey[i].split("_");
        $('#product').find('.attr_'+valuesKey[i]).each(function(){
          $(this).addClass('attr_active').prop('selected',true)
            .siblings().removeClass('attr_active');

            // смотреть https://fir-stil.ru/
            // в ТП цвет показать активное значение рядом с заголовком
            // if($(this).find('img').length){
            //   $('#currentColor').remove();
            //   var previewTitle = $(this).find('img').attr('title');
            //   if (previewTitle) {
            //     $(this).parents('.attr_field').find('.attr_label').append('<span id="currentColor">'+previewTitle+'</span>');
            //   }
            // }

          // var radio = $(this).find('input[type=radio]');
          // radio.prop('checked',true);
        });
      }
      shkMigx.updateProduct(key);
      shkMigx.showActiveImage();
    }
  },

  updateProduct : function(key){
    console.log('updateProduct()', key);
    var key = key || Object.keys(crossOptionMap)[0];
    if (typeof crossOptionMap[key] != 'undefined') {
// productPrice - done
      if (typeof crossOptionMap[key].price != 'undefined' && crossOptionMap[key].price) {
        $('#product').find('#productPrice').text(parseInt(crossOptionMap[key].price).format(0, 3, ' ', '.'));
      }
//

// label
      // if (crossOptionMap[key].label.length > 0 && crossOptionMap[key].label) {
      if (typeof crossOptionMap[key].label != 'undefined' && crossOptionMap[key].label) {
        // $('#product').find("#productLabel").html("<span>" + crossOptionMap[key].label + "</span>");
        // if (typeof setLabelsClass == 'function') {
        //   setLabelsClass();
        // }
        label_update(crossOptionMap[key].label);
      } else if (shkMigx.label.length > 0){
        label_update(shkMigx.label);
      } else {
        $('#product').find('.item_label').remove();
      }
// label end

// productPriceOld - done
      if (typeof crossOptionMap[key].old_price != 'undefined' && crossOptionMap[key].old_price) {
        $('#product').find("#productPriceOld").text(parseInt(crossOptionMap[key].old_price).format(0, 3, ' ', '.'));
      }
//

// item_image_thumb prdt_thumb_imgs

      // if ($('#product').find('.item_image_thumb').length === 1) {
      //   prdtSliderThumb.slick('unslick');
      // }
      if ($('#product').find('.img_thumb').length === 1) {
        prdtSliderThumb.slick('unslick');
      }

      // доп. картинки торгового предложения
      if(typeof crossOptionMap[key].addit_images_orig != 'undefined' && crossOptionMap[key].addit_images_orig){

        prdtSliderFull.slick('unslick');
        prdtSliderThumb.slick('unslick');
        $(shkMigx.config.full).html('');
        $(shkMigx.config.thumb).html('');
        console.log('crossOptionMap ', crossOptionMap);
        $.map(crossOptionMap[key].addit_images_orig,function (orig, i) {
          // $(shkMigx.config.full).prepend("<div class='item_image_full'><a href='"+orig+"' class='lightbox' data-lightbox='product'><img src='"+crossOptionMap[key].addit_images_detail[i]+"' alt='' /></a></div>\r\n");
          $(shkMigx.config.full).prepend('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+orig+'"><img src="'+crossOptionMap[key].addit_images_detail[i]+'" alt="" /></a></div>');
          if (Object.keys(crossOptionMap[key].addit_images_orig).length > 0) { // 0 - есди + основная, 1 - только доп. картинки
            // $(shkMigx.config.thumb).prepend("<div class='item_image_thumb'><span><img src='"+crossOptionMap[key].addit_images_preview[i]+"' alt='' /></span></div>\r\n");
            $(shkMigx.config.thumb).prepend('<div data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+crossOptionMap[key].addit_images_preview[i]+'" alt=""></span></div>');
          }
        });

        // основная картинка торгового предложения
        if (typeof crossOptionMap[key].full != 'undefined') {
           $(shkMigx.config.full).prepend('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+crossOptionMap[key].full+'"><img src="'+crossOptionMap[key].full+'" alt="" /></a></div>');
        }
        if (typeof crossOptionMap[key].thumb != 'undefined') {
          $(shkMigx.config.thumb).prepend('<div data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+crossOptionMap[key].thumb+'" alt=""></span></div>');
        }

        $(shkMigx.config.full).slick(fullImgOptions);
        $(shkMigx.config.thumb).slick(thumbImgOptions);
        shkMigx.images_added = 1;
      }
      else {
        if (!shkMigx.images_added) {
          shkMigx.updateImages();
          shkMigx.images_added = 1;
        }
      }

    } // if (typeof crossOptionMap[key] != 'undefined')

    // initFancybox();
  },

  getActiveKey : function(){
    console.log('getActiveKey()');
    var key = [];
    // $('#product').find('.attr_select input:checked').each(function(){
    //   var row = $(this).attr('name') + "_" + $(this).data('value');
    //   key.push(row);
    // });
    // console.log($('#product').find('.attr_select option:selected'));
    $('#product').find('.attr_select option:selected').each(function(){
      var row = $(this).parent().attr('name') + "_" + $(this).data('value');
      key.push(row);
    });
    if (key.length) {
      return key.join("__");
    }
    else {
      return key;
    }
  },

  setAttr : function(){
    console.log('setAttr()');
    var key = shkMigx.getActiveKey();
    console.log('key: ',key);
    shkMigx.updateProduct(key);
  },

  setAvail : function(opt){
    console.log('setAvail()');
    if (typeof opt == 'undefined') {
      // opt = $('#opt_value1 .attr_option').first().find('input');
      opt = $('#opt_value1 .attr_select option:selected');
    }

    var activeOpt = opt.parent().attr('name'),
        activeVal = opt.data('value'),
        focusKey = activeOpt+"_"+activeVal;

    // $('#product').find('.attr_option').removeClass('attr_avail');
    $('#product').find('.attr_select').find('option').removeClass('attr_avail');

    if (Object.keys(conf_fields).length >= 2) {
      // $('#product').find('.attr_option').find('input').attr('disabled','disabled');
      $('#product').find('.attr_select').find('option').attr('disabled','disabled');
    }

    for(key in crossOptionMap){
      var keySegments = key.split("__");
      if (keySegments.includes(focusKey)) {
        for(var i = 0; i < keySegments.length; i++){
          if (keySegments[i] == focusKey) {
            // $('.attr_'+focusKey).siblings().addClass('attr_avail').find('input').removeAttr('disabled');
            $('.attr_'+focusKey).siblings().addClass('attr_avail').removeAttr('disabled');
          }
          // $('.attr_'+keySegments[i]).addClass('attr_avail').find('input').removeAttr('disabled');
          $('.attr_'+keySegments[i]).addClass('attr_avail').removeAttr('disabled');
        }
      }
    }

    // если выбранные опции не доступны, сбрасываем
    var currentKey = shkMigx.getActiveKey();
    console.log('currentKey', currentKey);
    if (typeof crossOptionMap[currentKey] == 'undefined') {
      for(key in crossOptionMap){
        var keySegments = key.split("__");
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

  showActiveImage : function(){
    console.log('showActiveImage()');
    // image
    var activeKeys = shkMigx.getActiveKey();
    console.log('key ',activeKeys);
    if (activeKeys.length) {

      // var opt_current_img = $('.item_image_thumb[data-opt-image='+activeKeys+']');
      var opt_current_img = $('.img_thumb[data-opt-image='+activeKeys+']'); // ?
      console.log('opt_current_img ',opt_current_img);

      if(opt_current_img.length){
        var slideIndex = (opt_current_img.length > 1) ? $(opt_current_img[0]).parents('.slick-slide').data('slick-index') : $(opt_current_img).parents('.slick-slide').data('slick-index');
        $(shkMigx.config.full).slick('slickGoTo', slideIndex );
        $(shkMigx.config.thumb).slick('slickGoTo', slideIndex );
      };
    }
  },

  updateImages : function(){
    console.log('updateImages()');
// '<div class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+orig+'"><img src="'+crossOptionMap[key].addit_images_detail[i]+'" alt="" /></a></div>'
// '<div class="img_thumb"><span class="img_thumb_inner"><img src="'+crossOptionMap[key].addit_images_preview[i]+'" alt=""></span></div>'
    var imagesThumbs = [],
      fullArr = [],
      thumbArr = [];
console.log('crossOptionMap ', crossOptionMap);
    for (key in crossOptionMap) {
      if(crossOptionMap[key].image){
        var opt_img = "/images/"+crossOptionMap[key].image;
        var opt_img_full = crossOptionMap[key].full;
        var opt_img_thumb = crossOptionMap[key].thumb;


        if(imagesThumbs.length ==0 || $.inArray(opt_img,imagesThumbs) < 0){
          // fullArr.push("<div data-opt-image='"+key+"' class='item_image_full'><a class='lightbox' data-fancybox='product' href='"+opt_img+"'><img src='"+opt_img_full+"' alt='' /></a></div>");
          // thumbArr.push("<div data-opt-image='"+key+"' class='item_image_thumb'><span><img src='"+opt_img_thumb+"' alt='' /></span></div>");
          fullArr.push('<div data-opt-image="'+key+'" class="full_img_slide"><a class="full_img lightbox" data-fancybox="prod" href="'+opt_img+'"><img src="'+opt_img_full+'" alt="" /></a></div>');
          thumbArr.push('<div data-opt-image="'+key+'" class="img_thumb"><span class="img_thumb_inner"><img src="'+opt_img_thumb+'" alt=""></span></div>');
          imagesThumbs.push(opt_img);
        }
      }
    }

    if(imagesThumbs.length){

      prdtSliderFull.slick('unslick');
      prdtSliderThumb.slick('unslick');

      var fullHtml  = $(shkMigx.config.full).html(),
        thumbHtml = $(shkMigx.config.thumb).html();

      $(shkMigx.config.full).html('');
      $(shkMigx.config.thumb).html('');

      for (k in fullArr) {
        $(shkMigx.config.full).append(fullArr[k]);
      }
      for (k in thumbArr) {
        $(shkMigx.config.thumb).append(thumbArr[k]);
      }
      $(shkMigx.config.full).append(fullHtml).slick(fullImgOptions);
      $(shkMigx.config.thumb).append(thumbHtml).slick(thumbImgOptions);

      $(shkMigx.config.thumb).find('.img_thumb').on('click',function(){
        if($(this)[0].hasAttribute('data-opt-image')){
          var opts_name = $(this).data('opt-image');
          var opts_active = opts_name.split("__");
          opts_active.forEach(function(param){
            var opt = param.split("_");
            var opt_checked = crossOptionValues[opt[0]][opt[1]];
            // $('input[name="'+opt[0]+'"][data-value="'+opt[1]+'"]').prop('checked',true)
            //   .parent('label').addClass('attr_active').siblings('label').removeClass('attr_active');
            $('select[name="'+opt[0]+'"] option[data-value="'+opt[1]+'"]').prop('selected',true).addClass('attr_active').siblings('label').removeClass('attr_active');
          })
          shkMigx.setOptions(opts_name);
        }
      });
    }
    // initFancybox();
  },

  // ниже смотреть https://fir-stil.ru/

  // resetCount : function(){
  //   $('.migx_torg_result').val('');
  //   $('.migx_count').removeClass('not_empty').val('');
  //   shkMigx.countResult = {};
  // },

  // initCount : function(){
  //   $('.migx_count').on('focus', function(){
  //     $(this).parents('.attr_option').find('input[type=radio]').prop('checked', true).change();
  //   });
  //   $('.migx_count').on('change keyup', function(){
  //     if ($(this).val() > 0) {
  //       $(this).addClass('not_empty');
  //     }
  //     shkMigx.countResult[shkMigx.getActiveKey()] = $(this).val();
  //   });
  // },

  // addToCart: function(button, product_id){
  //   if ($('.migx_count').length) {
  //     var success = false;
  //     $('.migx_count').each(function(){
  //       if($(this).val() > 0){
  //         success = true;
  //         return;
  //       }
  //     });
  //     if (!success) {
  //       SHK.showHelper( $('#product .shk-item button:submit'), '<div class="msg">Выберите количество добавляемых товаров</div>', true );
  //       $('#shk_buttons').hide();

  //       clearTimeout( SHK.timer );
  //       SHK.timer = setTimeout(
  //         function(){
  //           $('#shk_prodHelper').fadeOut(500,function(){
  //             $('#shk_prodHelper').remove();
  //           });
  //         }, 2000);

  //       return success;
  //     }
  //   }

  //   if (Object.keys(shkMigx.countResult).length == 0) {
  //     return true;
  //   }

  //   for (key in shkMigx.countResult){
  //     if (shkMigx.countResult[key] > 0) {
  //       var valuesKey = key.split("__"),
  //         product = {
  //           "shk-id" : product_id,
  //           "shk_action": "fill_cart",
  //           "count" : shkMigx.countResult[key]
  //         };
  //       if (valuesKey.length) {
  //         for(var i = 0; i < valuesKey.length; i++){
  //           var valSegment = valuesKey[i].split("_");
  //           product[valSegment[0]] = valSegment[0] + '__' + valSegment[1]
  //         }
  //       }
  //       SHK.ajaxRequest( product, false );
  //     }
  //   }

  //   SHK.showHelper( $('#product .shk-item button:submit'), '<div class="msg">Товары добавлены в корзину</div>', true );
  //   $('#shk_buttons').hide();

  //   clearTimeout( SHK.timer );
  //   SHK.timer = setTimeout(
  //     function(){
  //       $('#shk_prodHelper').fadeOut(500,function(){
  //         $('#shk_prodHelper').remove();
  //       });
  //     }, 2000);

  //   setTimeout(
  //     function(){
  //     SHK.refreshCart();
  //   },1000);

  //   return false;
  // }
}

// $(document).ready(function(){
  if (typeof crossOptionMap != 'undefined' && Object.keys(crossOptionMap).length) {
    shkMigx.init();
  }
// });
