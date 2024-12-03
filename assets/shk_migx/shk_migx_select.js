jQuery(document).ready(function(){

	function setAttrsActive(opts){
		jQuery.each(opts, function(opt_n,opt_v){
			var opt_chk = jQuery('#opt_'+opt_n+' option:selected').data('value');
			var flag = false;
			// проверяем находится ли выбранная опция в списке доступных
			jQuery.each(opt_v, function(i,v){
				if(v==opt_chk){
					flag = true;
				}
			});
			jQuery.each(opt_v, function(i,v){
				jQuery('.attr_option.attr_'+opt_n+'_'+v).each(function(){
					// селектим первую из доступных опций
					if(i==0 && flag==false) {
						jQuery(this).prop('selected',true);
					}
					jQuery(this).addClass('attr_active');
				});
			});
		});
	}
	function getSelectedAttrsKey(){
		var inp_key = "";
		jQuery('.attr_field').each(function(i){
			if(i!=0) inp_key += "__";
			var inp_chk = jQuery(this).find('select'),
				inp_name = inp_chk.attr('name'),
				inp_value = inp_chk.find('option:selected').data('value');
			inp_key += inp_name+"_"+inp_value;
		});
		console.log("--"+inp_key);
		return inp_key;
	}
	function updateProductInfo(option){
		var th = jQuery(option),
			opt_name = th.attr('name'),
			opt_val = th.find('option:selected').data('value');

		jQuery('.attr_field option').removeClass('attr_active');
		jQuery(th).find('option:selected').addClass('attr_active');

		if(jQuery('.attr_field').length > 1){
			var opt_checked = crossOptionValues[opt_name][opt_val];
			setAttrsActive(opt_checked);
		}
		
		newPrice = crossOptionMap[getSelectedAttrsKey()].price;
		if(newPrice){
			jQuery('.shk-price').text(newPrice);
		}
	}
	function changeProductImage(){
		// image
		var opt_current_img = jQuery('.img_thumb[data-opt_image='+getSelectedAttrsKey()+']').eq(1);
		console.log(opt_current_img.attr('index'));
		if(opt_current_img.length){
			var slideIndex = opt_current_img.attr('index');
	        jQuery('.prdt_full_imgs').slickGoTo( (slideIndex) );
	        jQuery('.prdt_thumb_imgs').slickGoTo((slideIndex) );
		};
	}


	if(jQuery('.attr_field').length > 1){
		var attr_default = jQuery('.attr_field:first select').attr('name');
		setAttrsActive(crossOptionValues[attr_default][0]);
	}

	var newPrice = crossOptionMap[getSelectedAttrsKey()].price;
	if(newPrice){
		jQuery('.shk-price').text(newPrice);
	}

	jQuery('.attr_field select').on('change',function(){
		updateProductInfo(jQuery(this));
		changeProductImage();
	});

	// add images to product slider
	for (opt_key in crossOptionMap) {
		if(crossOptionMap[opt_key].image){
			var opt_prw = crossOptionMap[opt_key].preview;
			var opt_img = "/images/"+crossOptionMap[opt_key].image;
			jQuery("#prdt_full_imgs").prepend("<div data-opt_image='"+opt_key+"'><a class='full_img lightbox' href='"+opt_img+"'><img alt='' src='"+opt_prw+"' /></a></div>");
			jQuery("#prdt_thumb_imgs").prepend("<div data-opt_image='"+opt_key+"' class='img_thumb'><span class='img_thumb_wrapper'><img alt='' src='"+opt_prw+"' /></span></div>");
		}
	}
	initLightBox();

	jQuery('#prdt_thumb_imgs .img_thumb').on('click',function(){
		// var opt_data jQuery(this).data('opt_image');
		if(jQuery(this)[0].hasAttribute('data-opt_image')){
			var opt_active = jQuery(this).data('opt_image').split("_");
			var opt_select = jQuery('select[name='+opt_active[0]+']');
			if(opt_select.length){
				opt_select.val(opt_active[0]+'__'+opt_active[1]).change();
			}
		}
	});
});