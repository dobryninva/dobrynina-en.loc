var searchTips = function(val){
  var functo = {
    getTipsto: function(e, self) {
      this.clearto();
      this.timeoutID = setTimeout(function(){
        getTips(e, self);
      }, 300);
    },
    clearto: function() {
      clearTimeout(this.timeoutID);
      delete this.timeoutID;
    }
  };

  $('#search').keyup(function(e){
    functo.getTipsto(e, this);
  });

  $('#search').focus(function(e){
    if ($('#sf_tips').length){
      $('#sf_tips').fadeIn('fast');
    }else{
      getTips(e, this);
    }
  });

  $('#search').blur(function(e){
    functo.clearto();
  });

  $('body').on('click','#search',false);
  $('body').on('click',function(){
    $('#sf_tips').hide();
  });

  function getTips(e, self){
    $.ajax({
      method : 'POST',
      url : '/ajax.html',
      data : {
        method : 'searchTips',
        search : $(e.target).val()
      },
      success : function(data){
        if(data != 'none'){
          if (!$('#sf_tips').length){
            $('.search_form .search_form_inner').append(data);
            $('#sf_tips').fadeIn('fast');
          }else{
            $('#sf_tips').remove();
            $('.search_form .search_form_inner').append(data).find('#sf_tips').show();
          }
          if ($('#sf_tips .sf_tips_item').not('.sf_tips_button').length >= 10) $('#sf_tips .sf_tips_button').show();
        }else{
          $('#sf_tips').fadeOut('fast', function(){
            $(this).remove();
          });
        }
      },
      error : function(err){
        console.log(err, ' ajaxRouter: request error');
      }
    });
    val = $(e.target).val();
  }
};
searchTips(null);