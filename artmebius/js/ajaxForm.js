var AjaxForm = {

  initialize: function(afConfig) {
    if(!jQuery().ajaxForm) {
      document.write('<script src="'+afConfig.assetsUrl+'js/lib/jquery.form.min.js"><\/script>');
    }

    function formAjaxSubmit(form) {
      $(form).ajaxSubmit({
        dataType: 'json'
        ,data: {pageId: afConfig.pageId}
        ,url: afConfig.actionUrl
        ,beforeSerialize: function(form, options) {
          form.find(':submit').each(function() {
            if (!form.find('input[type="hidden"][name="' + $(this).attr('name') + '"]').length) {
              $(form).append(
                $('<input type="hidden">').attr({
                  name: $(this).attr('name'),
                  value: $(this).attr('value')
                })
              );
            }
          })
        }
        ,beforeSubmit: function(fields, form) {
          if (typeof(afValidated) != 'undefined' && afValidated == false) {
            return false;
          }
          form.find('div.error, span.error').html('');
          form.find('.error').removeClass('error');
          form.find('.has-error').removeClass('has-error');
          form.find('input,textarea,select,button').attr('disabled', true);
          return true;
        }
        ,success: function(response, status, xhr, form) {
          form.find('input,textarea,select,button').attr('disabled', false);
          response.form=form;
          $(document).trigger('af_complete', response);
          if (!response.success){
            if (response.data){
              var key, value;
              for (key in response.data) {
                if (response.data.hasOwnProperty(key)) {
                  value = response.data[key];
                  form.find('.error_' + key).html(value).addClass('error');
                  form.find('[name="' + key + '"],[name="' + key + '[]"]').addClass('error').parents('.form-group').addClass('has-error');
                }
              }
            }
          }else{
            /*response.message*/
            form.find('.error').removeClass('error');
            form[0].reset();
            var cusSucMes = jQuery(form[0]).next('.custom_success_message');
            jQuery(form[0]).remove();
            cusSucMes.fadeIn(300);
          }
        }
      });
    }

    function isRecaptcha(form) {
      let result = ($(form).find('[name="token"]').length) ? 1 : 0;
      return result;
    }

    // grecaptcha.ready(function(){
    //   $(afConfig.formSelector).each(function() {
    //     if (isRecaptcha(this)){
    //       captcha_exec(this, 'form_load');
    //     }
    //   });
    // });

    $(document).on('submit', afConfig.formSelector, function(e) {
      if (isRecaptcha(this)){
        captcha_exec(this, 'form_send', formAjaxSubmit);
      } else {
        formAjaxSubmit(this);
      }
      e.preventDefault();
      return false;
    });

    $(document).on('reset', afConfig.formSelector, function(e) {
      $(this).find('.error').html('');
    });
  }
};