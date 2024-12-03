function favoriteHandler(){

  this.setCookie = function(name, value, seconds){
    if (typeof(seconds) != 'undefined') {
      var date = new Date();
      date.setTime(date.getTime() + (seconds*1000));
      var expires = "; expires=" + date.toGMTString();
    }else{
      var expires = "";
    }
    document.cookie = name+"="+value+expires+"; path=/";
  }

  this.getCookie = function(name){
    name = name + "=";
    var carray = document.cookie.split(';');
    for(var i=0;i < carray.length;i++){
      var c = carray[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(name) == 0) return unescape(c.substring(name.length,c.length));
    }
    return null;
  }

  this.deleteCookie = function(name){
    this.setCookie(name, "", -1);
  }

  this.set = function(id, element){
    var favoriteIds = this.getCookie('favoriteList')!=null ? this.getCookie('favoriteList') : '';
    var favoriteIds_arr = favoriteIds.length>0 ? favoriteIds.split(',') : new Array();
    var shk_item = '.shk-item[data-id="' + id + '"]';

    if(typeof(fvtOnToFavoriteCheckClicked)=='function') fvtOnToFavoriteCheckClicked(id,element);

    if(favoriteIds_arr.indexOf(id.toString())>-1) {
      favoriteIds_arr.splice(favoriteIds_arr.indexOf(id.toString()), 1);
      $(shk_item).find('.item_favorite').removeClass('active').addClass('inactive');
    }
    else {
      favoriteIds_arr.push(id.toString());
      $(shk_item).find('.item_favorite').addClass('active').removeClass('inactive');
    }

    if(favoriteIds_arr.length==0){
      this.deleteCookie('favoriteList');
    }else{
      this.setCookie('favoriteList', favoriteIds_arr.join(','), 365*60*60);
    }

    $('.favorite_count').text(favoriteIds_arr.length);
    if (favoriteIds_arr.length > 0) {
      if (!$('.hdr_favorite').hasClass('active')) {
        $('.hdr_favorite').addClass('active');
      }
    } else {
      $('.hdr_favorite').removeClass('active');
    }

    this.request('update');
  }

  this.request = function(task){
    console.log('request: ' + task);
    $.ajax({
      method: "POST",
      url: "/ajax.html",
      data: {
        method: "addToFavorite",
        task: task,
      },
      success: function (data, textStatus) {
        // console.log('success');
      }
    });
  }

  this.updateProducts = function(){
    var favoriteIds = this.getCookie('favoriteList')!=null ? this.getCookie('favoriteList') : '';
    var favoriteIds_arr = favoriteIds.length>0 ? favoriteIds.split(',') : new Array();

    if (favoriteIds_arr.length) {
      $.each(favoriteIds_arr, function(i, id){
        var shk_item = '.shk-item[data-id="' + id + '"]';
        $(shk_item).find('.item_favorite').addClass('active').removeClass('inactive');
      });
    }
  }

  // this.updateProducts();
}

var favorite = new favoriteHandler();