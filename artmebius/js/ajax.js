// jQuery('#quickView').on('show.bs.modal', function (event) {
//   var button = jQuery(event.relatedTarget);
//       rid = button.data('id');
//       action = 'quickView',
//       modal = jQuery(this),
//       modal_title = modal.find('.modal-title'),
//       modal_body = modal.find('.modal-body');
//       modal_body.addClass('preloading');
//   jQuery.ajax({
//     url: '/artmebius/snippets/ajax.php',
//     type: 'POST',
//     dataType: 'html',
//     data: {action: action, id:rid},
//     success: function(data, textStatus, xhr) {
//       var result = JSON.parse(data);
//       console.log(result);

//       modal_title.find('.prdt_pagetitle').text(result.title);

//       modal_body.find('.item_label').removeClass('sale_label new_label hit_label');
//       switch(result.label){
//         case 'sale':
//           modal_body.find('.item_label').show().addClass('sale_label').text('sale');
//         break;
//         case 'new':
//           modal_body.find('.item_label').show().addClass('new_label').text('new');
//         break;
//         case 'hit':
//           modal_body.find('.item_label').show().addClass('hit_label').text('hit');
//         break;
//         default:
//           modal_body.find('.item_label').hide();
//         break;
//       }
//       modal_body.find('.prdt_full_imgs').find('img').attr('src', result.image_resize);
//       modal_body.find('.prdt_full_imgs').find('.full_img').attr('href', result.image);

//       modal_body.find('.shk-price').text(result.price);
//       if (result.old_price != '') {
//         modal_body.find('.old_price').show();
//         modal_body.find('.old_price_value').text(result.old_price);
//       } else {
//         modal_body.find('.old_price').hide();
//       }
//       if (result.availability == 1) {
//         modal_body.find('.available').show();
//         modal_body.find('.not_available').hide();
//       } else {
//         modal_body.find('.available').hide();
//         modal_body.find('.not_available').show();
//       }
//       modal_body.find('.prop_ean').find('.props_value').text(result.ean);
//       modal_body.find('.prop_manufacturer').find('.props_value').text(result.manufacturer);
//       modal_body.find('.prdt_desc').html(result.desc);
//       modal_body.find('[name="shk-name"]').val(result.title);
//       modal_body.find('[name="shk-id"]').val(result.id);

//       modal_body.removeClass('preloading');
//     },
//     error: function(xhr, textStatus, errorThrown) {
//       console.log('ajax error');
//     }
//   });
// });

// jQuery('.products_labels .view_switchers').each(function(index, el) {
//   jQuery(this).find('a').on('click', function(event) {
//     event.preventDefault();
//     var action = jQuery(this).data('action'),
//         label = jQuery(this).data('label'),
//         mdl_body = jQuery(this).parents('.products_labels').find('.mdl_body');
//     mdl_body.addClass('preloading');
//     // jQuery(this).addClass('active').siblings('a').removeClass('active');

//     jQuery.ajax({
//       url: '/artmebius/snippets/ajax.php',
//       type: 'POST',
//       dataType: 'html',
//       data: {action: action, label:label},
//       success: function(data, textStatus, xhr) {
//         var result = JSON.parse(data);
//         mdl_body.removeClass('preloading').children().replaceWith(result);
//         if (action == 'grid'){
//           if (label == 'sale') {
//             update_height_cols('.products_sale', '.item_title');
//             slider_init('.products_sale .row', products_sale_params);
//           }
//           if (label == 'hit') {
//             update_height_cols('.products_hit', '.item_title');
//             slider_init('.products_hit .row', products_hit_params);
//           }
//         }
//       },
//       error: function(xhr, textStatus, errorThrown) {
//         console.log('ajax error');
//       }
//     });

//   });
// });

// // offers_sect
// // products
// jQuery('.offers_sect .view_switchers a').on('click', function(event){
//   event.preventDefault();
//   var action = jQuery(this).data('action'),
//       label = jQuery(this).data('label');
//   jQuery('#products').addClass('preloading');

//   jQuery(this).addClass('active').siblings('a').removeClass('active');

//   var view = (action == 'grid') ? 1 : 2;
//   var date = new Date();
//   date.setTime(date.getTime() + (7*24*60*60*1000));//7 days
//   var expires = "; expires=" + date.toGMTString();
//   document.cookie = "tm_view="+view+expires+"; path=/";//set cookie

//   jQuery.ajax({
//     url: '/artmebius/snippets/ajax.php',
//     type: 'POST',
//     dataType: 'html',
//     data: {action: action, label:label},
//     success: function(data, textStatus, xhr) {
//       var result = JSON.parse(data);
//       jQuery('#products').removeClass('preloading').children().replaceWith(result);
//     },
//     error: function(xhr, textStatus, errorThrown) {
//       console.log('ajax error');
//     }
//   });
// });

// function getTips(e, self){
//   jQuery.ajax({
//     method : 'POST',
//     url : '/artmebius/snippets/ajax.php',
//     data : {
//       action: 'search',
//       search : jQuery(e.target).val()
//     },
//     success : function(data){
//       console.log('success');
//       if(data != 'none'){
//         if (!jQuery('#sfTips').length){
//           jQuery('.search_form form').append(data);
//           jQuery('#sfTips').fadeIn('fast');
//         }else{
//           jQuery('#sfTips').remove();
//           jQuery('.search_form form').append(data).find('#sfTips').show();
//         }
//         if (jQuery('#sfTips .sf_tips_item').length >= 10) jQuery('#sfTips .moreSearchResults').show();
//       }else{
//         jQuery('#sfTips').fadeOut('fast', function(){
//           jQuery(this).remove();
//         });
//       }
//     },
//     error : function(err){
//       console.log(err, ' ajaxRouter: request error');
//     }
//   });
//   val = jQuery(e.target).val();
// }

// var functo = {
//   getTipsto: function(e, self) {
//     this.clearto();
//     this.timeoutID = setTimeout(function(){
//       getTips(e, self);
//     }, 300);
//   },
//   clearto: function() {
//     clearTimeout(this.timeoutID);
//     delete this.timeoutID;
//   }
// };

// jQuery('#search').keyup(function(e){
//   functo.getTipsto(e, this);
// });

// jQuery('#search').focus(function(e){
//   if (jQuery('#sfTips').length){
//     jQuery('#sfTips').fadeIn('fast');
//   }else{
//     getTips(e, this);
//   }
// });

// jQuery('#search').blur(function(e){
//   functo.clearto();
// });

// jQuery('body').on('click','#search',false);
// jQuery('body').on('click',function(){
//   jQuery('#sfTips').hide();
// });