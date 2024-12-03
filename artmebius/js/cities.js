var ip;
var chosenCity;
var prevTpl;
getIP();

function renderTemplate(city, q)
{
  var q = (q == "undefined" || q == "null") ? 0 : q;

  if (q)
  {
    jQuery('#artmebius-city').html('<a id="choose-city" data-target="#cities_choose" data-toggle="modal" href="javascript:void(0)" onClick="showCities();"><i class="fa fa-caret-down"></i> <span class="choosen-city">' + city + '?</span></a> <a id="city-yes" class="city_confirm" href="javascript:void(0);" onClick="cityYes();"><span>Верно!</span></a>');
  }
  else
  {
    jQuery('#artmebius-city').html('<a id="choose-city" href="javascript:void(0)" onClick="showCities();" data-target="#cities_choose" data-toggle="modal"><i class="fa fa-caret-down"></i> <span class="choosen-city">' + city + '</span></a>');
  }
}

function init(){
  var geolocation = ymaps.geolocation;

  if (geolocation)
  {
    chosenCity = geolocation.city;
    renderTemplate(geolocation.city, 1);
  }
  else
  {
    chosenCity = 'Город установить не удалось';
    renderTemplate(geolocation.city);
  }
}

function getIP()
{
  jQuery.ajax({
    url: '/artmebius/snippets/ajax.php',
    type: "POST",
    dataType: "html",
    data: {
        action: "getIP",
        method: "geoIp"
    },
    success: function(data){
      ip = data;
      checkUserIP(ip);
    }
  });
}

function checkUserIP(ip)
{
  jQuery.ajax({
    url: '/artmebius/snippets/ajax.php',
    type: "POST",
    dataType: "html",
    data: {
      action: "checkIP",
      ip: ip,
      method: 'geoIp'
    },
    success: function(data){
      if (data === '')
      {
        ymaps.ready(init);
      }
      else{
        renderTemplate(data);
      }
    }
  });
}

function cityYes(city)
{
  if(!city){city = chosenCity;}
  jQuery.ajax({
    url: '/artmebius/snippets/ajax.php',
    type: "POST",
    dataType: "html",
    data: {
      action: "insert-city",
      location: chosenCity,
      userip: ip,
      method: 'geoIp'
    },
    success: function(data){
      renderTemplate(chosenCity);
    }
  });
}

function chooseCity(city)
{
  chosenCity = city;
  jQuery.ajax({
    url: '/artmebius/snippets/ajax.php',
    type: "POST",
    dataType: "html",
    data: { action: "choose-city", location: chosenCity, userip: ip, method: 'geoIp' },
    success: function(data){
      renderTemplate(chosenCity);
      jQuery('#artmebius-city').removeClass('active-city-list').addClass('unactive-city-list');
    }
  });
  $('#cities_choose').modal('hide');
}

function showCities(){
  prevTpl = jQuery('#artmebius-city').clone(1);
  var u_list;
  var cities = [
  '<span>А</span>',
  'Абакан',
  'Альметьевск',
  'Анадырь',
  'Анапа',
  'Ангарск',
  'Апатиты',
  'Армавир',
  'Арзамаз',
  'Арск',
  'Архангельск',
  'Астрахань',
  'Ачинск',
  '<span>Б</span>',
  'Балаково',
  'Балахна',
  'Балашиха',
  'Барнаул',
  '<b>Белгород</b>',
  'Белогорск',
  'Бердск',
  'Березники',
  'Бийск',
  'Биробиджан',
  'Благовещенск',
  'Братск',
  'Брянск',
  'Бугульма',
  '<span>В</span>',
  'Великие Луки',
  'Великий Новгород',
  'Владивосток',
  'Владикавказ',
  'Владимир',
  '<b>Волгоград</b>',
  'Волгодонск',
  'Волжский',
  'Вологда',
  'Волхов',
  'Воркута',
  '<b>Воронеж</b>',
  'Воскресенск',
  'Всеволожск',
  'Выборг',
  'Выкса',
  '<span>Г</span>',
  'Гатчина',
  'Глазов',
  'Горно-Алтайск',
  'Городец',
  'Грозный',
  '<span>Д</span>',
  'Дзержинск',
  'Димитровград',
  'Дмитров',
  'Долгопрудный',
  'Дубна',
  '<span>Е</span>',
  'Евпатория',
  'Ейск',
  '<b>Екатеринбург</b>',
  'Ессентуки',
  '<span>Ж</span>',
  'Железнодорожный',
  'Жигулевск',
  'Жуковский',
  '<span>З</span>',
  'Зеленоград',
  '<span>И</span>',
  '<b>Иваново</b>',
  'Ивантеевка',
  '<b>Ижевск</b>',
  'Иркутск',
  'Ишим',
  'Йошкар-Ола',
  '<span>К</span>',
  '<b>Казань</b>',
  'Калининград',
  'Калуга',
  'Каменск-Уральский',
  'Каменск-Шахтинский',
  'Камышин',
  'Кемерово',
  'Керчь',
  'Кириши',
  '<b>Киров</b>',
  'Кисловодск',
  'Климовск',
  'Ковров',
  'Коломна',
  'Комсомольск-на-Амуре',
  'Кондопога',
  'Королёв',
  'Кострома',
  'Красногорск',
  '<b>Краснодар</b>',
  '<b>Красноярск</b>',
  'Кстово',
  'Курган',
  'Курск',
  'Кызыл',
  '<span>Л</span>',
  '<b>Липецк</b>',
  '<span>М</span>',
  'Магадан',
  '<b>Магнитогорск</b>',
  'Майкоп',
  'Махачкала',
  'Междуреченск',
  'Миасс',
  'Минеральные Воды',
  'Минусинск',
  'Можайск',
  '<b>Москва</b>',
  'Мурманск',
  'Муром',
  '<span>Н</span>',
  '<b>Набережные Челны</b>',
  'Назрань',
  'Нальчик',
  'Находка',
  'Невинномысск',
  'Нефтекамск',
  'Нефтеюганск',
  'Нижневартовск',
  'Нижнекамск',
  '<b>Нижний Новгород</b>',
  '<b>Нижний Тагил</b>',
  'Новокузнецк',
  'Новомосковск',
  '<b>Новороссийск</b>',
  '<b>Новосибирск</b>',
  'Новочебоксарск',
  'Новочеркасск',
  'Новый Уренгой',
  'Норильск',
  'Ноябрьск',
  '<span>О</span>',
  'Обнинск',
  'Озерск',
  '<b>Омск</b>',
  'Орел',
  'Оренбург',
  'Орехово-Зуево',
  'Орск',
  '<span>П</span>',
  '<b>Пенза</b>',
  'Первоуральск',
  '<b>Пермь</b>',
  'Петрозаводск',
  'Петропавловск-Камчатский',
  'Подольск',
  'Псков',
  'Пущино',
  '<b>Пятигорск</b>',
  '<span>Р</span>',
  'Раменское',
  '<b>Ростов-на-Дону</b>',
  'Рыбинск',
  'Рязань',
  '<span>С</span>',
  'Салават',
  'Салехард',
  '<b>Самара</b>',
  '<b>Санкт-Петербург</b>',
  'Саранск',
  'Сарапул',
  '<b>Саратов</b>',
  'Саров',
  'Сатка',
  'Севастополь',
  'Северодвинск',
  'Северск',
  'Сергиев Посад',
  'Серпухов',
  'Симферополь',
  'Смоленск',
  'Сортавала',
  'Сочи',
  '<b>Ставрополь</b>',
  'Старый Оскол',
  'Стерлитамак',
  'Сургут',
  'Сызрань',
  'Сыктывкар',
  '<span>Т</span>',
  'Таганрог',
  'Тамбов',
  'Тверь',
  'Тихвин',
  'Тобольск',
  '<b>Тольятти</b>',
  'Томск',
  'Туапсе',
  '<b>Тула</b>',
  'Тутаев',
  'Тында',
  '<b>Тюмень</b>',
  '<span>У</span>',
  'Улан-Удэ',
  '<b>Ульяновск</b>',
  'Усинск',
  'Уссурийск',
  'Усть-Илимск',
  '<b>Уфа</b>',
  'Ухта',
  '<span>Ф</span>',
  'Феодосия',
  'Фрязино',
  '<span>Х</span>',
  'Хабаровск',
  'Ханты-Мансийск',
  '<span>Ч</span>',
  '<b>Чебоксары</b>',
  '<b>Челябинск</b>',
  'Череповец',
  'Черкесск',
  'Черноголовка',
  'Чита',
  '<span>Ш</span>',
  'Шахты',
  'Щелково',
  '<span>Э</span>',
  'Элиста',
  'Энгельс',
  '<span>Ю</span>',
  'Южно-Сахалинск',
  '<span>Я</span>',
  'Якутск',
  'Ялта',
  '<b>Ярославль</b>'];
  u_list = '<ul class="artmebius-city-list">';
  var sstr = '';
  for(i = 0; i < cities.length; i++)
  {
    sstr = cities[i][0] + cities[i][1];
    if (sstr == '<s')
    {
      u_list = u_list + '<li>' + cities[i] + '</li>';
    }
    else
    {
      u_list = u_list + '<li><a id="city-yes" href="javascript:void(0)" onClick="chooseCity(\'' + cities[i] +'\')">' + cities[i] + '</a></li>';
    }
  }
  u_list = u_list + '</ul>';
  jQuery('#cities_modal').html(u_list).removeClass('unactive-city-list').addClass('active-city-list');
}

function closeCities()
{
  jQuery('#artmebius-city').fadeOut('300', function() {
    jQuery(this).replaceWith(prevTpl);
  });
}