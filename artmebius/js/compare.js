
/*

Compare 1.0
Сравнение товаров

Andchir - http://modx-shopkeeper.ru/

*/

if (!Array.prototype.indexOf){
  Array.prototype.indexOf = function(elt /*, from*/){
    var len = this.length >>> 0;
    var from = Number(arguments[1]) || 0;
    from = (from < 0) ? Math.ceil(from) : Math.floor(from);
    if (from < 0) from += len;
    for (; from < len; from++){
      if (from in this && this[from] === elt) return from;
    }
    return -1;
  };
}


function compareHandler(){

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

  //преход на страницу сравнения
  this.toCompareLink = function(){
    if(typeof(this.getCookie('shkCompareIds'))!='string') this.setCookie('shkCompareIds', '', 365*60*60);
    var compareIds = this.getCookie('shkCompareIds')!=null ? this.getCookie('shkCompareIds') : '';
    var compareIds_arr = compareIds.length>0 ? compareIds.split(',') : new Array();
    if(compareIds_arr.length<=1){
      if(typeof(cmpOnToCompareLinkMinimum)=='function') cmpOnToCompareLinkMinimum();
      else alert('Для сравнения необходимо выбрать минимум 2 товара.');
      return false;
    }else{
      return true;
    }
  }

  //добавление и удаление ID товаров для сравнения
  this.toCompare = function(id,parentid,elem){

    var compareIds = this.getCookie('shkCompareIds')!=null ? this.getCookie('shkCompareIds') : '';
    var compareIds_arr = compareIds.length>0 ? compareIds.split(',') : new Array();
    var compareParentId = this.getCookie('shkCompareParent')!=null ? this.getCookie('shkCompareParent') : parentid;
    var output_arr = new Array();
    // все случаи этого товара на странице
    var shk_items_selector = '.shk-item[data-id="' + id + '"]',
        shk_items = document.querySelectorAll(shk_items_selector);

    if(typeof(cmpOnToCompareCheckClicked)=='function') cmpOnToCompareCheckClicked(id,parentid,elem);

    //добавляем ID в список для сравнения
    if (compareIds_arr.indexOf(id.toString())<0){

      // текущий товар
      // elem.classList.add('active');
      // elem.classList.remove('inactive');

      //все товары
      shk_items.forEach(function(item, i, arr) {
        item.querySelector('.item_compare').classList.add('active');
        item.querySelector('.item_compare').classList.remove('inactive');
      });

      //если добавляется товар из другой категории
      if(cmpr_config.onlyThisParentId!=false && compareParentId != parentid){
        if(typeof(cmpOnToCompareFromAnotherCategory)=='function'){
          var compareConfirm = cmpOnToCompareFromAnotherCategory();
        }else{
          var compareConfirm = confirm('Вы можете сравнивать товары одной категории.  При добавлении данного товара в список старые данные будут удалены.');
        }
        if(compareConfirm){
          this.setCookie('shkCompareIds', id, 365*60*60);
          this.setCookie('shkCompareParent', parentid, 365*60*60);
          window.location.reload();
          return true;
        }else{
          return false;
        }
      }

      //если число выбранных товаров превысило предел
      if(cmpr_config.limitProducts>0 && compareIds_arr.length==cmpr_config.limitProducts){
        if(typeof(cmpOnToCompareLimitReached)=='function') cmpOnToCompareLimitReached(cmpr_config.limitProducts);
        else alert('Вы можете выбрать '+cmpr_config.limitProducts+' позиции для сравнения.');
        return false;
      }

      //если ID уже есть в списке
      if(compareIds_arr.indexOf(id.toString())>-1) return true;

      //добавляем
      output_arr = compareIds_arr;
      output_arr.push(id.toString());

    //убираем ID из списка
    } else {

      // текущий товар
      // elem.classList.remove('active');
      // elem.classList.add('inactive');

      //все товары
      shk_items.forEach(function(item, i, arr) {
        item.querySelector('.item_compare').classList.remove('active');
        item.querySelector('.item_compare').classList.add('inactive');
      });

      for(var i=0;i<compareIds_arr.length;i++){
        if(compareIds_arr[i]!=id) output_arr.push(compareIds_arr[i]);
      }

    }

    if(output_arr.length==0){
      this.deleteCookie('shkCompareIds');
      this.deleteCookie('shkCompareParent');
    }else{
      this.setCookie('shkCompareIds', output_arr.join(','), 365*60*60);
      this.setCookie('shkCompareParent', parentid, 365*60*60);
    }

    //меняем число выбранных товаров на странце
    if(document.getElementById('skolko_vibrano')!=null) document.getElementById('skolko_vibrano').innerHTML = output_arr.length;
    if (output_arr.length > 0) {
      document.querySelector('.hdr_compare').classList.add('active');
      // if (!$('.hdr_compare').hasClass('active')) {
      //   $('.hdr_compare').addClass('active');
      // }
    } else {
      document.querySelector('.hdr_compare').classList.remove('active');
      // $('.hdr_compare').removeClass('active');
    }
    //скрываем или открываем ссылку на удаление ID выбранных товаров
    if(document.getElementById('sravnenie_otmena')!=null){
      if(output_arr.length==0) document.getElementById('sravnenie_otmena').style.display = 'none';
      else document.getElementById('sravnenie_otmena').style.display = 'inline';
    }

    return true;

  }

  this.updateProducts = function(){
    var compareIds = this.getCookie('shkCompareIds')!=null ? this.getCookie('shkCompareIds') : '';
    var compareIds_arr = compareIds.length>0 ? compareIds.split(',') : new Array();

    if (compareIds_arr.length) {
      // jQuery
      // $.each(compareIds_arr, function(i, id){
      // $('.shk-item[data-id='+id+']').find('.add_to_compare').addClass('active');
      // });

      // no jQuery
      compareIds_arr.forEach(function(id, i, arr){
        let shk_items_selector = '.shk-item[data-id="' + id + '"]',
            shk_items = document.querySelectorAll(shk_items_selector);
        shk_items.forEach(function(item, i, arr) {
          item.querySelector('.item_compare').classList.add('active');
          item.querySelector('.item_compare').classList.remove('inactive');
        });
      });
    }

  }

}

var shkCompare = new compareHandler();