var cities = {

  ip: '',
  city_chosen: '',
  city_default: "Нижний Новгород",
  city_domains: {
    "Нижний Новгород" :"domen.ru",
    // "Дзержинск"       :"dzerzhinsk.domen.ru",
    // "Санкт-Петербург" :"spb.domen.ru"
  },
  ymaps: undefined,

  get_ip: function(){
    let _ = this;

    $.ajax({
      url   : '/artmebius/snippets/ajax.php',
      type  : 'POST',
      async : false,
      dataType: 'json',
      data: {
        action: 'get_ip'
      }
    })
    .done(function(data) {
      // console.log('get_ip success');
      _.ip = data.ip;
    })
    .fail(function() {
      // console.log('get_ip error');
      _.ip = '';
    });

    return _.ip;
  },

  check_city_by_ip: function(){
    let _ = this,
        city = '';

    $.ajax({
      url   : '/artmebius/snippets/ajax.php',
      type  : 'POST',
      async : false,
      dataType: 'json',
      data: {
        action: 'check_city_by_ip',
        ip: _.ip
      }
    })
    .done(function(data) {
      // console.log('check_city_by_ip success');
      city = data.city;
    })
    .fail(function() {
      // console.log('check_city_by_ip error');
      // city = _.city_default; // d?
    });

    return city;
  },

  get_city_by_domain: function(){
    let _ = this,
        city = '';
    for (key in _.city_domains){
      if (window.location.host == _.city_domains[key]) {
        city = key;
      }
    }
    return city;
  },

  get_domain_by_city: function(city){
    let _ = this,
        domain = (typeof(_.city_domains[city] != 'undefined')) ? _.city_domains[city] : window.location.host;
    return domain;
  },

  proccess_city: function(city){
    // console.log('proccess_city: ', city);
    let _ = this,
        check = true;
    $.ajax({
      url   : '/artmebius/snippets/ajax.php',
      type  : 'POST',
      async : false,
      dataType: 'json',
      data: {
        action: 'proccess_city',
        ip: _.ip,
        city: city
      }
    })
    .done(function(data) {
      // console.log('proccess_city success', data);
      check = true;
    })
    .fail(function(data) {
      // console.log('proccess_city error', data);
      check = false;
    });

    return check;
  },

  set_cookie: function(city, seconds) {
    // console.log('set_cookie: ', city);
    seconds = (seconds === undefined) ? 2592000 : seconds; // 30 days 60*60*24*30 2592000
    setCookie('city_select', city, seconds);
    return true;
  },

  get_cookie: function() {
    let city_cookie = getCookie('city_select');
    return (city_cookie) ? city_cookie : false;
  },

  del_cookie: function() {
    delCookie('city_select');
    return true;
  },

  render_template: function(city){
    let _ = this;
    city = (typeof(city) == 'undefined') ? _.city_default : city;
    // console.log('render_template: ', city);

    $('.artmebius-city').html('<a id="choose-city" class="city_choose" href="javascript:void(0)" data-target="#cities_choose" data-toggle="modal"><i class="fa fa-map-marker-alt"></i> <span class="choosen-city">' + city + '</span></a>');
  },

  init: function(){
    let _ = this,
        city = '',
        city_db = '',
        city_cookie = _.get_cookie(), // get_cookie || get_storage
        city_domain = _.get_city_by_domain();

    _.get_ip();

    // если город не сохранён в куках
    if (!city_cookie) {

      city_db = _.check_city_by_ip();

      // но город и ip есть в базе
      if (city_db) {
        // console.log('init have city: ', city_db);
        _.set_cookie(city_db);
        _.render_template(city_db);
        if (_.get_domain_by_city(city_db) != window.location.host) {
          window.location.host = _.city_domains[city_db];
          return;
        }

      }  // и города и ip нет в базе
      else {
        // console.log('init haven\'t city');
        // console.log('city from domain: ', city_domain);

        $.ajax({
          async: false,
          url: 'https://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU',
          dataType: "script"
        })
        .done(function(data){
          ymaps.ready(function(){
            // console.log('city from geo: ', ymaps.geolocation.city);
            _.ymaps = ymaps;

            // если город по домену совпадает с городом по геолокации
            if (city_domain == ymaps.geolocation.city) {
              _.proccess_city(city_domain);
            } // иначе уточняем город, спрашивая у пользователя (верно? нет)
            else {
              // TODO: ask_city();return;
              _.proccess_city(city_domain); // заглушка
            }
            _.set_cookie(city_domain);
            _.render_template(city_domain);
          });
        });
      } // end if (city_db)

    } // если город сохранён в куках
    else {
      // console.log('city from cookie: ', city_cookie);

      // но не совпадает с городом текущего домена (после перехода на другой домен (сохранять куки для нового поддомена???))
      if (city_cookie != city_domain) {
        _.set_cookie(city_domain);
        _.render_template(city_domain);
      } // переходы внутри домена
      else {
        _.render_template(city_cookie);
      }

    } // if (!city_cookie)

  },

  choose_city: function(city){
    let _ = this,
        proccess = '';

    city = (typeof _.city_domains[city] != 'undefined') ? city : _.city_default;
    _.set_cookie(city); // ??? re
    // proccess = _.proccess_city(city);
    // if (proccess) {
    if (_.proccess_city(city)) {
      if (window.location.host != _.city_domains[city]) {
          window.location.host = _.city_domains[city];
      }
      // ???
      _.render_template(city);
      $('#cities_choose').modal('hide');
    }
  },

} // end cities

cities.init();

$('.artmebius-city-list span:not(".cities_letter")').on('click',function(){
  let city = $(this).text();
  cities.choose_city(city.trim());
});