jQuery(document).ready(function(){

	function setAttrsAvail(opts){
		jQuery.each(opts, function(opt_n,opt_v){
			var opt_chk = jQuery('#opt_'+opt_n+' input:checked').data('value');
			// проверяем находится ли выбранная опция в списке доступных
			var flag = false;
			jQuery.each(opt_v, function(i,v){
				if(v==opt_chk){
					flag = true;
				}
			});
			jQuery.each(opt_v, function(i,v){
				jQuery('.attr_option.attr_'+opt_n+'_'+v).each(function(){
					// чекаем первую из доступных опций
					if(i==0 && flag==false) {
						jQuery(this).find('input').prop('checked',true)
							.parent('.attr_option').addClass('attr_active')
							.siblings().removeClass('attr_active');
					}
					jQuery(this).addClass('attr_avail');
				});
			});
		});
	}
	function setAttrsActive(opt_key){
		newPrice = crossOptionMap[opt_key].price;
		jQuery('.shk-price').text(newPrice);
	}
	function getSelectedAttrsKey(){
		var inp_key = "";
		jQuery('.attr_field').each(function(i){
			if(i!=0) inp_key += "__";
			var inp_chk = jQuery(this).find('input:checked'),
				inp_name = inp_chk.attr('name'),
				inp_value = inp_chk.data('value');
			inp_key += inp_name+"_"+inp_value;
		});
		return inp_key;
	}
	function updateProductInfo(option){
		var th = jQuery(option),
			opt_name = th.attr('name'),
			opt_val = th.data('value');

		jQuery('.attr_option').removeClass('attr_avail');
		jQuery(th).parents('.attr_option')
			.addClass('attr_avail')
			.addClass('attr_active').siblings().removeClass('attr_active');

		if(jQuery('.attr_field').length > 1){
			var opt_checked = crossOptionValues[opt_name][opt_val];
			setAttrsAvail(opt_checked);
		}
		// console.log(getSelectedAttrsKey());
		newPrice = crossOptionMap[getSelectedAttrsKey()].price;
		jQuery('.shk-price').text(newPrice);
	}

	function changeProductImage(){
		// image
		var opt_current_img = jQuery('.img_thumb[data-opt_image='+getSelectedAttrsKey()+']');
		// var opt_current_img = jQuery('.img_thumb[data-opt_image='+getSelectedAttrsKey()+']').eq(1);
		// console.log(getSelectedAttrsKey());
		console.log(opt_current_img);
		if(opt_current_img.length){
			var slideIndex = opt_current_img.attr('index');
	        jQuery('.prdt_full_imgs').slickGoTo( (slideIndex) );
	        jQuery('.prdt_thumb_imgs').slickGoTo((slideIndex) );
		};
	}

	if(jQuery('.attr_field').length > 1){
		var attr_default = jQuery('.attr_option:first').find('input').attr('name');
		setAttrsAvail(crossOptionValues[attr_default][0]);
	}
if(typeof(window['crossOptionMap']) != 'undefined'){
	//if(crossOptionMap) {
		console.log(getSelectedAttrsKey());
		var newPrice = crossOptionMap[getSelectedAttrsKey()].price;
		jQuery('.shk-price').text(newPrice);
	}

	jQuery('.attr_option input').on('change',function(){
		updateProductInfo(jQuery(this));
		changeProductImage();
	});
if(typeof(window['crossOptionMap']) != 'undefined'){
	// add images to product slider
	for (opt_key in crossOptionMap) {
		if(crossOptionMap[opt_key].image){
			var opt_img = "/images/"+crossOptionMap[opt_key].image;
			jQuery("#prdt_full_imgs").append("<div data-opt_image='"+opt_key+"'><a class='full_img lightbox' href='"+opt_img+"'><img alt='' src='"+opt_img+"' /></a></div>");
			jQuery("#prdt_thumb_imgs").append("<div data-opt_image='"+opt_key+"' class='img_thumb'><span class='img_thumb_wrapper'><img alt='' src='"+opt_img+"' /></span></div>");
		}
	}
}
	initLightBox();

	jQuery('#prdt_thumb_imgs .img_thumb').on('click',function(){
		// var opt_data jQuery(this).data('opt_image');
		if(jQuery(this)[0].hasAttribute('data-opt_image')){
			var opts_name = jQuery(this).data('opt_image');
			var opts_active = opts_name.split("__");
			opts_active.forEach(function(param,key){
				var opt = param.split("_");
				var opt_checked = crossOptionValues[opt[0]][opt[1]];
				$('input[name="'+opt[0]+'"][data-value="'+opt[1]+'"]').prop('checked',true)
					.parent('label').addClass('attr_active').siblings('label').removeClass('attr_active');
			})
			setAttrsActive(opts_name);
		}
	});

});