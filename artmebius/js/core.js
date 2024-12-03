// #extend

function gethash(){
  return window.location.hash.replace("#","");
}

function sleep(ms) {
  ms += new Date().getTime();
  while (new Date() < ms){}
}

function setCookie(name, value, seconds){
  if (typeof(seconds) != 'undefined') {
    var date = new Date();
    date.setTime(date.getTime() + (seconds*1000));
    var expires = "; expires=" + date.toGMTString();
  }else{
    var expires = "";
  }
  var temp_cookie = name+"="+value+expires+"; path=/";
  document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name){
  name = name + "=";
  var carray = document.cookie.split(';');
  for(var i=0;i < carray.length;i++){
    var c = carray[i];
    while (c.charAt(0)==' ') c = c.substring(1,c.length);
    if (c.indexOf(name) == 0) return unescape(c.substring(name.length,c.length));
  }
  return null;
}

function delCookie(name){
  setCookie(name, "", -1);
}

function isInteger(n) {
  return (n^0)===n;
}

function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function compareNumeric(a, b) {
  if (a > b) return 1;
  if (a < b) return -1;
}

// .format(0, 3, ' ', '.')
Number.prototype.format = function(n, x, s, c) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
      num = this.toFixed(Math.max(0, ~~n));

  return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
};

// уникальный массив
function unique(arr) {
  var obj = {};
  for (var i = 0; i < arr.length; i++) {
    var str = arr[i];
    obj[str] = true; // запомнить строку в виде свойства объекта
  }
  return Object.keys(obj); // или собрать ключи перебором для IE8-
}

// поиск элемента(позиции) в массиве
if ([].indexOf) {
  var find = function(array, value) {
    return array.indexOf(value);
  }
} else {
  var find = function(array, value) {
    for (var i = 0; i < array.length; i++) {
      if (array[i] === value) return i;
    }
    return -1;
  }
}



// #functions

function show_message(title, message) {
  $('#modal_message_html').html(message);
  $('#modal_message_label').text(title);
  $('#modal_message').modal('show');
}


function acl(){let e='<a style="text-decoration:none;" href="'+document.location.href+'">.</a>',t=window.getSelection(),n=t.toString(),o=document.getElementsByTagName("body")[0],l=document.createElement("div");l.style.position="absolute",l.style.left="-99999px",o.appendChild(l),n=n.replace(/\./g,e),l.innerHTML=n,t.selectAllChildren(l),window.setTimeout((function(){o.removeChild(l)}),0)}


$.fn.scrollShowHide = function() {
  let $this = this,
      minScrollTop = $this.outerHeight(),
      lastScrollTop = minScrollTop; // 0
  $(window).scroll({passive:true},function() {
    if ($(document).width() <= 751) {
      var st = window.pageYOffset || document.documentElement.scrollTop;
      if (st > lastScrollTop){
        // downscroll code:
        if ($this.is(':visible') && $this.hasClass('fixed')) {
          $this.slideUp('300');
        }
        if ($this.is(':visible') && $this.hasClass('fixed-bottom')) {
          $this.slideDown('300');
        }
      } else {
        // upscroll code:
        if (!$this.is(':visible') && $this.hasClass('fixed')) {
          $this.slideDown('300');
        }
        if (!$this.is(':visible') && $this.hasClass('fixed-bottom')) {
          $this.slideUp('300');
        }
      }
      lastScrollTop = st <= minScrollTop ? minScrollTop : st; // For Mobile or negative scrolling
    }
  });
}


$.fn.scrollToTop = function(threshold) {
  threshold = (threshold !== undefined) ? threshold : 100;
  let $this = this;
  $(window).scroll({passive:true},function() {
    if ($(this).scrollTop() > threshold) {
      $this.stop(true,false).fadeIn('slow');
    } else {
      $this.stop(true,false).fadeOut('fast');
    }
  });
  $this.click(function(e) {
    e.preventDefault();
    $('html, body').animate({
      scrollTop: 0
    }, 'slow')
  });
}


$.fn.scrollToTarget = function(speed, top_offset) {
  speed = (speed !== undefined) ? speed : 500;
  top_offset = (top_offset !== undefined) ? top_offset : 0;
  this.click(function(e) {
    e.preventDefault();
    let target = ($(this).data('target')) ? $(this).data('target') : $(this).attr('href'),
        position = $(target).offset(),
        position_top = 0,
        fixedP = $('.fixed:visible').first().css('position'),
        cur_offset = top_offset;
    if (fixedP == 'fixed') {
      cur_offset = (cur_offset < $('.fixed:visible').first().outerHeight()) ? $('.fixed:visible').first().outerHeight() : cur_offset;
    }
    position_top = (position.top > cur_offset) ? position.top - cur_offset : position.top;
    if (typeof scrollToTargetBeforeCallback == 'function') scrollToTargetBeforeCallback();
    $('html, body').stop(true).animate({
      scrollTop: position_top + 1
    }, speed);
  });
}


function scrollToAncor(link, top_offset){ // d?
  top_offset = (top_offset !== undefined) ? top_offset : 0;
  $(link).on('click', function (e) {
    e.preventDefault();
    let target = ($(this).data('target')) ? $(this).data('target') : $(this).attr('href'),
        position = $(target).offset(),
        position_top = 0,
        hdrP = $('#hdr').css('position'),
        cur_offset = top_offset;
    if (hdrP == 'fixed') {
      cur_offset = (cur_offset < $('#hdr').outerHeight()) ? $('#hdr').outerHeight() : cur_offset;
    }
    position_top = (position.top > cur_offset) ? position.top - cur_offset : position.top;
    $('html, body').stop().animate({
      scrollTop: position_top + 1
    }, 500);
  });
}


function slide_toggle_any(button, target, speed) {
  $(button).click(function(e) {
    e.preventDefault();
    $(target).stop(true, false).slideToggle(speed);
  });
}


$.fn.animated_counter = function(time, threshold) {
  time = (time !== undefined) ? time : 2;
  threshold = (threshold !== undefined) ? threshold : 100;
  let $this = this,
      stop = 0;
  $this.find('[data-ani-num]').text('0');
  function counter_handler() {
    let offset_top = $this.find('[data-ani-num]').first().offset().top,
        scroll_top = $(window).scrollTop()+$(window).height();
    if ((offset_top < scroll_top - threshold) && !stop) {
      $this.find('[data-ani-num]').each(function(index, el) {
        let i = 0,
	          $counter = $(this),
	          num = parseInt($counter.data('ani-num')),
	          time_ms = 1000 * time,
	          step_count = (num >= 10000) ? 500 : ((num >= 1000) ? 50 : 1),
	          step_timer = time_ms*step_count/num;
        let int = setInterval(function() {
        	let format = $counter.data('format');
          if (i <= num) {
          	if (typeof format != 'undefined') {
              $counter.text(i.format(0, format, ' ', '.'));
          	} else {
              $counter.text(i);
          	}
          } else {
          	if (typeof format != 'undefined') {
              $counter.text(num.format(0, format, ' ', '.'));
          	} else {
              $counter.text(num);
          	}
            clearInterval(int);
          }
          i += step_count;
        }, step_timer);
        stop = 1;
      });
    }
  }
  counter_handler();
  $(window).scroll({passive:true},counter_handler);
}


// $.fn.spoiler = function(lh, rows = 5, hb = 1, text_in = 'Показать всё описание', text_out = 'Свернуть описание') {
$.fn.spoiler = function(lh, rows, hb, text_in, text_out) {
  if (!this.length || this.hasClass('spoilered')) return;
  rows = (rows !== undefined) ? rows : 5;
  hb = (hb !== undefined) ? hb : 1;
  text_in = (text_in !== undefined) ? text_in : 'Показать всё описание';
  text_out = (text_out !== undefined) ? text_out : 'Свернуть описание';
  // console.log(lh, rows, hb, text_in, text_out);
  let maxH = lh * rows,
      curH = this.outerHeight(),
      btn = '<div class="btn_spoiler_wrap"><span class="btn-spoiler">' + text_in + '</span></div>';
  if (curH > maxH) {
    this.addClass('spoiler_in spoilered').css({
      'height': maxH + 'px',
      'overflow': 'hidden'
    }).after(btn);
    $btn_spoiler = this.next().children();
  }
  if (typeof $btn_spoiler != 'undefined') {
    // $('body').on('click', '.btn-spoiler', function(e) {
    $btn_spoiler.on('click', function(e) {
      e.preventDefault();
      let $btn = $(this),
          $spoiler_text = $(this).parent().prev();
      if ($spoiler_text.hasClass('spoiler_in')) {
        if (hb) {
          $btn.hide();
        }
        $spoiler_text.animate({'height': curH + 'px'},
          'fast', function() {
          $(this).removeClass('spoiler_in').addClass('spoiler_out').css('height', 'auto');
            $btn.text(text_out);
        });
        return;
      }
      if ($spoiler_text.hasClass('spoiler_out')) {
        $spoiler_text.animate({'height': maxH + 'px'},
          'fast', function() {
          $(this).removeClass('spoiler_out').addClass('spoiler_in');
          $btn.text(text_in);
        });
        return;
      }
    });
  }
}


// spoiler_elems old
$.fn.spoiler_elems = function(count_elems, show_all, hide_button, text_in, text_out) {
  if (!this.length) return;

  count_elems = (count_elems !== undefined) ? count_elems : 5;
  show_all = (show_all !== undefined) ? show_all : 1;
  hide_button = (hide_button !== undefined) ? hide_button : 1;
  text_in = (text_in !== undefined) ? text_in : 'Показать ещё';
  text_out = (text_out !== undefined) ? text_out : 'Скрыть';
  let btn = '<div class="btn-spoiler-wrap"><span class="btn-spoiler">' + text_in + '</span></div>',
      $target = this,
      $parents = $target.parent();

  $parents.each(function(index, parent) {
    let $spoilered = $(parent).children().eq(count_elems-1).nextAll();
    if ($spoilered.hasClass('spoilered')) return;
    $spoilered.addClass('spoilered').hide().last().after(btn);
    let $btn_spoiler = $spoilered.last().next().find('.btn-spoiler');
    if (typeof $btn_spoiler != 'undefined') {
      $btn_spoiler.on('click', function(e) {
        e.preventDefault();
        let $btn = $(this),
            $wrap = $(this).parent();
            // console.log($spoilered);
        if ($spoilered.length > 0) {
          if (show_all) {
            $spoilered.slice(0).removeClass('spoilered').show();
            $spoilered = $spoilered.slice($spoilered.length);
          } else {
            $spoilered.slice(0, count_elems).removeClass('spoilered').show();
            $spoilered = $spoilered.slice(count_elems-1);
          }
          if (!$spoilered.length) {
            $btn.text(text_out);
            if (hide_button) $wrap.hide();
          }
        } else {
          $spoilered = $(parent).children().eq(count_elems-1).nextAll().not($wrap).addClass('spoilered').hide();
          $btn.text(text_in);
        }
      });
    }
  });
}

// spoiler_elems new
const spoiler_elems = {
  init: function(elems, hide_button, button_first, button_new_line ,text_in, text_out){
    if (!$(elems).length) return;
    let _ = this;
    hide_button = (hide_button !== undefined) ? hide_button : 1;
    button_first = (button_first !== undefined) ? button_first : 0;
    button_new_line = (button_new_line !== undefined) ? button_new_line : 0;
    text_in = (text_in !== undefined) ? text_in : 'Показать ещё';
    text_out = (text_out !== undefined) ? text_out : 'Скрыть';

    _.build(elems, hide_button, button_first, button_new_line, text_in, text_out);

    $(window).resize(function(e) {
      _.destroy(elems);
      _.build(elems, hide_button, button_first, button_new_line, text_in, text_out);
    });

  }, // init
  build: function(elems, hide_button, button_first, button_new_line, text_in, text_out){
    let $elems = $(elems);
    let btn_class = $elems.first().attr('class');
    let btn = '<span class="' + btn_class + ' btn-spoiler btn-spoiler-open"><span>' + text_in + '</span></span>';
    let offset = $elems.first().offset();
    let count = 0;
    let diff = (button_new_line) ? 1 : 2;
    let spoiler_need = 0;
    $elems.each(function(i, el) {
      let el_offset = $(el).offset();
      if (el_offset.top == offset.top) {
        count++;
      } else {
        spoiler_need = 1;
      }
    });

    if (spoiler_need) {
      let $spoilered = $elems.eq(count-diff).nextAll();
      $spoilered.addClass('spoilered').hide(); // .last().after(btn);
      let $btn_spoiler;
      if (button_first) {
        $elems.first().before(btn);
        $btn_spoiler = $elems.first().prev();
      } else {
        $spoilered.last().after(btn);
        $btn_spoiler = $spoilered.last().next();
      }

      if (typeof $btn_spoiler != 'undefined') {
        $btn_spoiler.on('click', function(e) {
          e.preventDefault();
          let $btn = $(this);
          $btn.parents('.spoiler_prepare').removeClass('spoiler_prepare');
          if ($spoilered.length > 0) {
            $spoilered.removeClass('spoilered').show();
            $spoilered = $spoilered.slice($spoilered.length);
            $btn.toggleClass('btn-spoiler-open btn-spoiler-close').children().text(text_out);
            if (hide_button) $btn.hide();
          } else {
            $spoilered = $elems.eq(count-diff).nextAll().not($btn).addClass('spoilered').hide();
            $btn.toggleClass('btn-spoiler-open btn-spoiler-close').children().text(text_in);
          }
        });
      }
    }
  }, // build
  destroy: function(elems){
    let $elems = $(elems);
    $elems.filter('.spoilered').removeClass('spoilered').show();
    $elems.siblings('.btn-spoiler').remove();
  }
}


// #paralax_bg
function paralax_bg(selector, threshold) {
	threshold = (threshold !== undefined) ? threshold : 100;
  let elems = document.querySelectorAll(selector);
  		body = document.body,
      startX = -threshold,
      startY = -threshold,
      w = document.documentElement.offsetWidth,
      h = document.documentElement.offsetHeight;
  body.addEventListener('mousemove', function(evt){
    let posX = Math.round(evt.clientX / w * startX);
    let posY = Math.round(evt.clientY / h * startY);
    elems.forEach((elem) => {
    	let elemX, elemY;
    	if (typeof elem.dataset.posX != 'undefined' && typeof elem.dataset.posY != 'undefined') {
    		elemX = elem.dataset.posX;
    		elemY = elem.dataset.posY;
    	} else {
    		elem.dataset.posX = elemX = window.getComputedStyle(elem,null).backgroundPositionX;
    		elem.dataset.posY = elemY = window.getComputedStyle(elem,null).backgroundPositionY;
    	}
    	elem.style.backgroundPosition = `calc(${elemX} + ${posX}px) calc(${elemY} + ${posY}px)`;
		});
  });
}


// #inits

function slider_init(selector, params){
  $(selector).slick(params);
}

const fancybox_params = {
  buttons: [
    'print',
    'zoom',
    //'share',
    'slideShow',
    //'fullScreen',
    //'download',
    'thumbs',
    'close'
  ],
  lang: 'ru',
  i18n: {
    ru: {
      CLOSE: 'Закрыть',
      NEXT: 'Вперёд',
      PREV: 'Назад',
      ERROR: 'Ошибка загрузки. <br/> Повторите запрос позднее.',
      PLAY_START: 'Начать слайд-шоу',
      PLAY_STOP: 'Приостановить слайд-шоу',
      FULL_SCREEN: 'На полный экран',
      THUMBS: 'Миниатюры',
      DOWNLOAD: 'Скачать',
      SHARE: 'Поделиться',
      ZOOM: 'Увеличить'
    },
  },
  thumbs: {
    autoStart: true
  },
};

function fancybox_init(params){
  $('a.lightbox').fancybox(params);
}

function table_responsive_init(parent) {
  parent = (parent !== undefined) ? parent : 'body';
  $(parent).find('table').each(function() {
    if (!$(this).hasClass('table-sticky') && !$(this).parent().hasClass('table-responsive') && !$(this).parent().hasClass('table-responsive-sm') && !$(this).parent().hasClass('table-responsive-md') && !$(this).parent().hasClass('table-responsive-lg') && !$(this).parent().hasClass('table-responsive-xl')){
      $(this).wrap('<div class="table-responsive"></div>');
    }


  });
}

function embed_responsive_init(parent, ar) {
  ar = (ar !== undefined) ? ar : 0;
  let embedClass = (ar) ? 'embed-responsive embed-responsive-4by3' : 'embed-responsive embed-responsive-16by9';
  $(parent).find('iframe, embed, object').each(function() {
    // if (!$(this).parent().is('.embed-responsive')){
    if (!$(this).parent().hasClass('embed-responsive')){
      $(this).wrap('<div class="embed_wrap"><div class="'+ embedClass +'"></div></div>');
    }
  });
}



// #menu

$('body').on('click', '.menu_vert_slide .parent .menu__link', function(e) {
  let $this = $(this);
  if ($this.next('ul').length) {
    e.preventDefault();
    $this.parent().toggleClass('opened closed').siblings('li.opened').toggleClass('opened closed');
    let deep = $this.parents('li.parent').length;
    // $this.parents('.menu_vert_slide').animate({'left': (-100 * deep) + '%'}, 300);
    $this.parents('.backdrop_mdl').animate({'left': (-100 * deep) + '%'}, 300);
    $('.backdrop_content').animate({scrollTop: 0}, 300);
  }
});
$('body').on('click', '.menu_vert_slide .menu__link_back', function(e) {
  let $this = $(this);
  e.preventDefault();
  let deep = $this.parents('li.parent').length - 1;
  // $this.parents('.menu_vert_slide').animate({'left': (-100 * deep) + '%'}, 300, function(){
  $this.parents('.backdrop_mdl').animate({'left': (-100 * deep) + '%'}, 300, function(){
    $this.parents('li.opened').first().toggleClass('opened closed');
  });
});

$('body').on('click', '.menu_accord .parent .menu__link', function(e) {
  if ($(this).next('ul').length) {
    e.preventDefault();
    $(this).parent().toggleClass('opened closed').siblings('li').children('ul:visible').stop(true,false).slideToggle(300).parent().toggleClass('opened closed');
    $(this).next('ul').stop(true,false).slideToggle(300);
  }
});

$('body').on('click', '.menu_accord_mobile .parent .menu__link', function(e) {
  if ($(document).width() <= 751) {
    if ($(this).next('ul').length) {
      e.preventDefault();
      $(this).parent().toggleClass('opened closed').siblings('li').children('ul:visible').stop(true,false).slideToggle(300).parent().toggleClass('opened closed');
      $(this).next('ul').stop(true,false).slideToggle(300);
    }
  }
});

$('body').on('click', '.menu_accord_tablet .parent .menu__link', function(e) {
  if ($(document).width() <= 1007) {
    if ($(this).next('ul').length) {
      e.preventDefault();
      $(this).parent().toggleClass('opened closed').siblings('li').children('ul:visible').stop(true,false).slideToggle(300).parent().toggleClass('opened closed');
      $(this).next('ul').stop(true,false).slideToggle(300);
    }
  }
});

$('body').on('click', '.menu_accord_tablet_icon .parent .menu__link-icon', function(e) {
	let $link = $(this).parent('.menu__link');
  if ($(document).width() <= 1007) {
    if ($link.next('ul').length) {
      e.preventDefault();
      $link.parent().toggleClass('opened').siblings('li').children('ul:visible').stop(true,false).slideToggle(300).parent().removeClass('opened');
      $link.next('ul').stop(true,false).slideToggle(300);
    }
  }
});

$('body').on('click', '.menu_toggle .menu__link', function(e) {
  if ($(this).next('ul').length) {
    e.preventDefault();
    $(this).parent().toggleClass('opened closed');
    $(this).next('ul').stop(true,false).slideToggle(300);
  }
});
function menu_toggle_upd() {
  $('.menu_toggle .menu__link').each(function(index, el) {
    if ($(this).next('ul').length) {
      $(this).next('ul').is(':visible') ? $(this).parent().removeClass('closed').addClass('opened') : $(this).parent().removeClass('opened').addClass('closed');
    }
  });
}

function menu_sides_init(target){
  let menu = $(target).find('ul').first(),
      liChilds = menu.children('li'),
      countChilds = liChilds.length;
  if (countChilds >= 0){
    let half = countChilds / 2;
    liChilds.each(function(index, el){
      let dirClass = (index < half) ? 'to_left' : 'to_right';
      $(el).addClass(dirClass);
    });
  }
}

function menu_levels_init(target) {
  $(target).find('.menu').children('li').each(function(index, el) {
    $(el).find('li').each(function(index, li) {
      let str_class = $(li).attr('class'),
          new_class = 'has_level' + str_class[str_class.indexOf('level') + 5];
      if (!$(el).hasClass(new_class)) {
        $(el).addClass(new_class);
      }
    });
  });
}



// #tabs
const tabs = {
  init: function(activate, parent_tabs, parent_contents){
    parent_tabs = (parent_tabs !== undefined) ? parent_tabs : '.tabs';
    parent_contents = (parent_contents !== undefined) ? parent_contents : parent_tabs;
    let tabs_titles = parent_tabs + ' .tabs__title';
    let tabs_contents = parent_contents + ' .tabs__content';
    // if (activate && $(tabs_titles).is(':visible')){
    if (activate){
      $(tabs_titles + ',' + tabs_contents).removeClass('active');
      let tab_active = ($(tabs_titles).not('.disabled').first().attr('href') !== undefined) ? $(tabs_titles).first().addClass('active').attr('href') : $(tabs_titles).first().addClass('active').data('target');
      $(tab_active).addClass('active').siblings('.tabs__content').hide();
    }
    $(parent_tabs).addClass('tabs_' + $(tabs_titles).length);
    let anc = gethash();
    if (anc != '') {
      anc = '#' + anc;
      $(tabs_titles).each(function(){
        if (anc == $(this).attr('href') || anc == $(this).data('target')) {
          $(tabs_titles + ',' + tabs_contents).removeClass('active');
          $(this).addClass('active');
          $(anc).addClass('active').fadeIn().siblings('.tabs__content').hide();
        }
      });
    }
    $(tabs_titles).click(function(e){
      e.preventDefault();
      if (!$(this).hasClass('active') && !$(this).hasClass('disabled')){
        $(tabs_titles + ',' + tabs_contents).removeClass('active');
        $(this).addClass('active');
        tab_active = ($(this).attr('href') !== undefined) ? $(this).attr('href') : $(this).data('target');
        $(tab_active).addClass('active').fadeIn().siblings('.tabs__content').hide();

        if(typeof tabClickCallback == 'function') tabClickCallback($(tab_active));
      }
    });
  },
  active: function(target, parent_tabs, parent_contents) {
    parent_tabs = (parent_tabs !== undefined) ? parent_tabs : '.tabs';
    parent_contents = (parent_contents !== undefined) ? parent_contents : parent_tabs;
    let tab_target = '.tabs__title[data-target="' + target + '"]',
        tabs_titles = parent_tabs + ' .tabs__title',
        tabs_contents = parent_contents + ' .tabs__content';
    $(tabs_titles + ',' + tabs_contents).removeClass('active');
    $(tab_target).addClass('active');
    $(target).addClass('active').fadeIn().siblings('.tabs__content').hide();
  }
}


// #qiuz
const quiz = {
  init: function(){
    let _ = this;
    $('.quiz-form').not('.quiz-initialized').each(function(index, qf) {
      let $quiz = $(qf),
          quiz_count = $quiz.find('.quiz-form__page').length;

      // build
      $quiz.addClass('quiz-initialized');
      $quiz.find('.quiz-form__page').first().addClass('active visited').siblings('.quiz-form__page').hide();

      let quiz_form_step_class_sfx = '';
      for (var i = 1; i <= quiz_count; i++) {
        // quiz_form_step_class_sfx = (i == 1) ? ' active visited' : '';
        // quiz_form_step_class_sfx += (i == quiz_count) ? ' last' : '';
        $quiz.find('.quiz-form__steps').append('<div class="quiz-form__step'+quiz_form_step_class_sfx+'" data-page="'+i+'"><div class="quiz-form__step-btn">'+i+'</div></div>');
      }

      // handlers
      $quiz.find('.quiz-form__step').click(function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        if ($quiz.find('.quiz-form__page').eq((page - 2)).hasClass('visited') || page == 1) {
          _.set_active($quiz,(page));
        }
      });

      $quiz.find('.quiz-form__prev').click(function(e) {
        e.preventDefault();
        let page = _.get_active($quiz);
        if (page > 1) {
          _.set_active($quiz,(page-1));
        }
      });

      $quiz.find('.quiz-form__next').click(function(e) {
        e.preventDefault();
        let page = _.get_active($quiz);
        if (page < quiz_count) {
          _.set_active($quiz,(page+1));
        }
      });

      // actions
      _.set_active($quiz, 1);
    });
  },
  get_active: function($quiz){
    let active = $quiz.find('.quiz-form__page.active').index() + 1;
    // console.log('get_active ' + active);
    return active;
  },
  set_active: function($quiz, page){
    // console.log('set_active ' + page);
    $quiz.find('.quiz-form__page').eq((page - 1)).show().addClass('active').siblings('.quiz-form__page').removeClass('active').hide();
    if (!$quiz.find('.quiz-form__page').eq((page - 1)).hasClass('visited')) {
      $quiz.find('.quiz-form__page').eq((page - 1)).addClass('visited');
    }

    $quiz.find('.quiz-form__step').eq((page - 1)).addClass('active').siblings('.quiz-form__step').removeClass('active');
    if (!$quiz.find('.quiz-form__step').eq((page - 1)).hasClass('visited')) {
      $quiz.find('.quiz-form__step').eq((page - 1)).addClass('visited');
    }

    if (page == 1) {
      $quiz.find('.quiz-form__prev').addClass('disabled');
    } else {
      $quiz.find('.quiz-form__prev').removeClass('disabled');
    }

    if (page == $quiz.find('.quiz-form__page').length) {
      $quiz.find('.quiz-form__next').addClass('disabled');//.hide();
      $quiz.find('.quiz-form__submit').show();
    } else {
      $quiz.find('.quiz-form__next').removeClass('disabled');//.show();
      $quiz.find('.quiz-form__submit').hide();
    }

    return;
  }
}
quiz.init();


// #backdrop
// data-backdrop="click" data-target=".menu" data-wrapper="backdrop_menu" data-title="Меню" data-type="self|clone" data-side="left|right"
// defaults: type=clone, side=left
const backdrop = {
  target: null,
  wrapper: null,
  title: null,
  type: null,
  side: null,
  media: null,
  init: function(){
    let _ = this;
    $('body').on('click', '[data-backdrop="click"]', function(e) {
      e.preventDefault();
      e.stopPropagation();
      if ($('body').find('.backdrop_content').length) {
        backdrop.destroy();
      }

	    let $this = $(this);
	    _.media = (typeof $this.data('media') != 'undefined') ? $this.data('media') : 'all';
	    if (!_.media_check()) return;
	    _.target = $this.data('target');
	    _.wrapper = (typeof $this.data('wrapper') != 'undefined') ? '<div class="backdrop_mdl ' + $this.data('wrapper') + '"></div>' : '';
	    _.title = (typeof $this.data('title') != 'undefined') ? $this.data('title') : '';
	    _.type = (typeof $this.data('type') != 'undefined') ? $this.data('type') : 'clone';
	    // _.side = (typeof $this.data('side') != 'undefined') ? $this.data('side') : 'left';
	    _.side = ($(document).width() <= 1263) ? ( (typeof $this.data('side') != 'undefined') ? $this.data('side') : 'left' ) : 'fade';
	    let $content = (typeof _.target != 'undefined') ? $(_.target) : $this.next();

	    $this.toggleClass('active backdrop_close');

	    _.build($content, _.side, _.type, _.wrapper, _.title);
	    _.show(_.side, _.type);
    });
    $('body').on('click', '.backdrop_close,.backdrop', function(e) {
      let direction = (_.side != null) ? _.side : ($('.backdrop_content').hasClass('right_side') ? 'right' : 'left');
      e.preventDefault();
      _.close(direction);
    });
    $('body').on('keyup', function(e) {
      let key_code = e.which ? e.which : e.keyCode;
      let direction = (_.side != null) ? _.side : ($('.backdrop_content').hasClass('right_side') ? 'right' : 'left');
      if ($('body').find('.backdrop_content').length && key_code == 27) {
        _.close(direction);
      }
    });
  },
  media_check:function(){
  	let _ = this;
  	let docW = document.body.clientWidth;
  	switch(_.media){
	  	case 'all':
		  	return true;
  			break;
	  	case 'xld':
		  	return (docW < 1536) ? true : false;
  			break;
	  	case 'lgd':
		  	return (docW < 1280) ? true : false;
  			break;
	  	case 'mdd':
		  	return (docW < 1024) ? true : false;
  			break;
	  	case 'smd':
		  	return (docW < 768) ? true : false;
  			break;
	  	case 'xsd':
		  	return (docW < 480) ? true : false;
  			break;
  	}
  },
  swipe_init:function(){
    let _ = this;
    $('.backdrop_content').swipe({
      swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
        if (!$(event.target).hasClass('ui-slider-handle')) {
          if ($('.backdrop_content').length) {
            if ($('.backdrop_content').hasClass('left_side') && direction == 'left') {
              _.close(direction);
            }
            if ($('.backdrop_content').hasClass('right_side') && direction == 'right') {
              _.close(direction);
            }
          }
        }
      },
      threshold: 20,
      allowPageScroll: 'vertical',
    });
  },
  build: function($content, side, type, wrapper, title){
    let _ = this;
    if (!$('body').find('.backdrop_content').length) {
      let backdrop_title = (title != '') ? '<div class="backdrop_title">' + title + '<span class="backdrop_close fal fa-times"></span></div>' : '<span class="backdrop_close fal fa-times"></span>' ;
      $('body').append('<div class="backdrop"></div><div class="backdrop_content ' + side + '_side">' + backdrop_title + '<div class="backdrop_content_inner"></div></div>');
      switch(type){
        case 'ajax':
          $inner = $('body').find('.backdrop_content_inner').prepend($content).wrapInner(wrapper);
          break;
        case 'self':
          $content.before('<div class="backdrop_placeholder"></div>');
          $inner = $('body').find('.backdrop_content_inner').prepend($content).wrapInner(wrapper);
          break;
        default:
        case 'clone':
          $inner = $('body').find('.backdrop_content_inner').prepend($content.clone(true, true)).wrapInner(wrapper);
          break;
      }
      _.swipe_init();
      if (typeof backdropBuildCallback == 'function') backdropBuildCallback($inner.children());
    }
  },
  show: function(side, type){
    switch(side){
      case 'right':
        $('body').find('.backdrop_content').animate({'right': '0'}, 300);
        break;
      case 'left':
      default:
        $('body').find('.backdrop_content').animate({'left': '0'}, 300);
        break;
      case 'fade':
        $('body').find('.backdrop_content').fadeIn(300);
        break;
    }
    $('body').addClass('backdroped');
  },
  close: function(direction){
    if (typeof backdropBeforeCloseCallback == 'function') backdropBeforeCloseCallback();
    switch(direction){
      case 'left':
        $('body').find('.backdrop_content').animate({'left': '-300'}, 300, function() {
          backdrop.destroy();
        });
        break;
      case 'right':
        $('body').find('.backdrop_content').animate({'right': '-300'}, 300, function() {
          backdrop.destroy();
        });
        break;
      case 'fade':
        $('body').find('.backdrop_content').fadeOut(300, function() {
          backdrop.destroy();
        });
        break;
    }
  },
  destroy: function(){
    let _ = this,
        type = (_.type != null) ? _.type : 'clone';
    if (typeof backdropBeforeDestroyCallback == 'function') backdropBeforeDestroyCallback();
    switch(type){
      case 'self':
        if ($('.backdrop_content_inner').find('.backdrop_mdl')) {
          $('.backdrop_content_inner').find('.backdrop_mdl').children().insertAfter('.backdrop_placeholder');
        } else {
          $('.backdrop_content_inner').children().insertAfter('.backdrop_placeholder');
        }
        $('.backdrop_placeholder').remove();
        $('body').removeClass('backdroped').find('.backdrop, .backdrop_content').remove();
        break;
      case 'clone':
      default:
        $('body').removeClass('backdroped').find('.backdrop, .backdrop_content').remove();
        break;
    }
    $('[data-backdrop="click"]').removeClass('active backdrop_close');
    if (typeof backdropDestroyCallback == 'function') backdropDestroyCallback();
    _.target = null;
    _.wrapper = null;
    _.title = null;
    _.type = null;
    _.side = null;
    _.media = null;
  }
}



function spotdrop_init() {
  $('body').on('click', '[data-spotdrop="click"]', function(e) {
    e.preventDefault();
    parent = $(this).data('parent');
    $parent = (typeof parent != 'undefined') ? $(this).parents(parent) : $(this).parent();
    $parent.addClass('spotdrop');
  });
  $('body').on('click', '[data-spotdrop="focus"]', function(e) {
    e.preventDefault();
    parent = $(this).data('parent');
    $parent = (typeof parent != 'undefined') ? $(this).parents(parent) : $(this).parent();
    $parent.addClass('spotdrop');
  });
}


// #toggle
function toggle_class_upd() {
  $('[data-toggle]').each(function(i, el) {
    let $this = $(this),
        params = $this.data(),
        $target = (typeof params.toggleTarget != 'undefined') ? $(params.toggleTarget) : $this.next(),
        set_active = (typeof params.toggleActivate != 'undefined') ? params.toggleActivate : 0,
        class_active = (typeof params.toggleClass != 'undefined') ? params.toggleClass : 'active',
        class_target_active = (typeof params.toggleTargetClass != 'undefined') ? params.toggleTargetClass : '';

    if (set_active == 1) {
      $target.is(':visible') ? $this.addClass(class_active) : $this.removeClass(class_active);
      if ($target.is(':visible') && class_target_active != '') {
        $target.addClass(class_target_active);
      }
    }
  });
}

// data-toggle="on" data-toggle-target="" data-toggle-activate="" data-toggle-class="" data-toggle-target-class="" data-toggle-effect=""
$('body').on('click', '[data-toggle]', function(e) {
  e.preventDefault();
  let $this = $(this),
      params = $this.data(),
      $target = (typeof params.toggleTarget != 'undefined') ? $(params.toggleTarget) : $this.next(),
      set_active = (typeof params.toggleActivate != 'undefined') ? params.toggleActivate : 0,
      class_active = (typeof params.toggleClass != 'undefined') ? params.toggleClass : 'active',
      class_target_active = (typeof params.toggleTargetClass != 'undefined') ? params.toggleTargetClass : '',
      effect = params.toggleEffect;

  if (params.toggle == 'off') return false;
  if (params.media == 'md' && $(document).width() >= 768) return false;
  if (params.media == 'lg' && $(document).width() >= 1024) return false;
  if (params.media == 'lx' && $(document).width() >= 1280) return false;

  if (params.toggle == 'on') {
    switch(effect){
      case 'accord':
        $this.parents(params.toggleParent).find('[data-toggle-effect="accord"]:visible').not($this).each(function(index, el) {
          let target_accord = $(this).data('toggle-target'),
              $target_accord = (typeof target_accord != 'undefined') ? $(target_accord) : $(this).next();
          $(this).removeClass(class_active);
          if (class_target_active != '') {
            $target_accord.removeClass(class_target_active);
          }
          if ($target_accord.is(':visible')) {
            $target_accord.stop(true, false).slideUp(300);
          }
        });
        $target.stop(true, false).slideToggle(300, function(){
          if ($target.is(':visible') && $(document).width() <= 751) {
            let offset_top = $this.offset().top;
            // можно поменять отступ с учётом фиксированных элементов
            // if ($('.hdr-xs-btm').hasClass('fixed')) {
            //   offset_top -= $('.hdr-xs-btm').outerHeight();
            // }
            $('html, body').stop(true).animate({
              scrollTop: offset_top
            }, 300);
          }
        });
        break;
      case 'opacity':
				if (set_active == 1) {
					if ($this.hasClass(class_active)) {
						$target.stop(true, false).css('opacity', '0');
					} else {
						$target.stop(true, false).css('opacity', '1');
					}
				} else {
	      	let op = $target.stop(true, false).css('opacity');
	      	if (op == 0) {
	      		// $target.animate({'opacity': 1}, 'fast');
	      		$target.stop(true, false).css('opacity', '1');
	      	} else {
	      		// $target.animate({'opacity': 0}, 'fast');
	      		$target.stop(true, false).css('opacity', '0');
	      	}
				}
        break;
      case 'slide':
        $target.stop(true, false).slideToggle('fast');
        break;
      case 'fade':
        $target.stop(true, false).fadeToggle('fast');
        break;
      default:
        $target.toggle();
        break;
    }
  }

  if (set_active == 1) {
    $this.toggleClass(class_active);
    if (class_target_active != '') {
      $target.toggleClass(class_target_active);
    }
  }

  if (typeof toggleClickCallback == 'function') toggleClickCallback($this, $target);
});


// swiper handlers
function swiper_init(target, params) {
  let _swiper = document.querySelector(target).swiper;
  if (typeof _swiper == 'undefined') {
    let _on = {
      on: {
        init: function () {
          if (this.params.createElements == true && this.enabled == true) {
            // wrap .swiper
            let swiper_div = document.createElement('div');
            swiper_div.className = 'swiper';
            this.wrapperEl.replaceWith(swiper_div);
            swiper_div.append(this.wrapperEl);
            // wrap .swiper-wrapper
            if (this.params.wrapperClass != 'swiper-wrapper') {
              this.wrapperEl.classList.add('swiper-wrapper');
            }
            // slides add classes
            this.slides.forEach(slideEl => {
              slideEl.classList.add('swiper-slide');
            });
          }
        },
        breakpoint: function (swiper, breakpointParams) {
          // console.log(swiper.currentBreakpoint,swiper);
          if (breakpointParams.unswipe == true) {
            unswipe(swiper)
          }
          if (breakpointParams.reswipe == true) {
            reswipe(swiper);
          }
          if (typeof breakpointParams.navigation != 'undefined') {
            if (typeof breakpointParams.navigation.moveTo != 'undefined') {
              // console.log(document.querySelector(breakpointParams.navigation.moveTo));
              // console.log(swiper.navigation.nextEl);
              if (swiper.navigation.prevEl !== null && swiper.navigation.nextEl !== null) {
                document.querySelector(breakpointParams.navigation.moveTo).prepend(swiper.navigation.nextEl[0], swiper.navigation.prevEl[0]);
              }
            }
          }
        },
      }
    };
    Object.assign(params, _on);
    _swiper = new Swiper(target, params);
  }
}
function reswipe(swiper) {
  if (swiper.params.createElements == true && swiper.enabled == false) {
    // wrap .swiper-wrapper
    if (swiper.params.wrapperClass == 'swiper-wrapper') {
      if (!swiper.hostEl.querySelector('.swiper-wrapper')) {
        swiper.hostEl.append(swiper.wrapperEl);
        swiper.hostEl.querySelectorAll('.'+swiper.params.slideClass).forEach(slideEl => {
          swiper.wrapperEl.append(slideEl);
        });
      }
    } else {
      swiper.wrapperEl.classList.add('swiper-wrapper');
    }
    // wrap .swiper
    let swiper_div = document.createElement('div');
    swiper_div.className = 'swiper';
    swiper.wrapperEl.replaceWith(swiper_div);
    swiper_div.append(swiper.wrapperEl);
    // slides add classes
    swiper.hostEl.querySelectorAll('.'+swiper.params.slideClass).forEach(slideEl => {
      slideEl.classList.add('swiper-slide');
    });
    // enable
    swiper.enable();
    swiper.updateActiveIndex(0);
  }
}
function unswipe(swiper) {
  if (swiper.params.createElements == true && swiper.enabled == true) {
    // unwrap .swiper
    if (swiper.hostEl.querySelector('.swiper')) {
      swiper.hostEl.querySelector('.swiper').replaceWith(...swiper.hostEl.querySelector('.swiper').childNodes);
    }
    // unwrap .swiper-wrapper
    if (swiper.params.wrapperClass == 'swiper-wrapper') {
      swiper.wrapperEl.replaceWith(...swiper.wrapperEl.childNodes);
    } else {
      swiper.wrapperEl.classList.remove('swiper-wrapper');
    }
    // clean slides
    let slides = swiper.slides.length ? swiper.slides : swiper.hostEl.querySelectorAll('.'+swiper.params.slideClass);
    if (slides && slides.length) {
      slides.forEach(slideEl => {
        slideEl.classList.remove(swiper.params.slideVisibleClass, swiper.params.slideActiveClass, swiper.params.slideNextClass, swiper.params.slidePrevClass, 'swiper-slide', 'swiper-slide-active');
        slideEl.removeAttribute('style');
        slideEl.removeAttribute('data-swiper-slide-index');
      });
    }
    // disable
    swiper.disable();
  }
}


// #handscustom

function print_file_size(number) {
  if (number < 1024) {
    return `${number} B`;
  } else if (number >= 1024 && number < 1048576) {
    return `${(number / 1024).toFixed(0)} KB`;
  } else if (number >= 1048576) {
    return `${(number / 1048576).toFixed(0)} MB`;
  }
}

function custom_height_fix(target, from){
  $(target).height($(from).outerHeight());
}


// #ajax

function get_prod_data(prod_id) {
  let result;
  $.ajax({
    url: '/artmebius/snippets/ajax.php',
    type: 'POST',
    dataType: 'json',
    async: false,
    data: {
      action: 'get_prod_data',
      id: prod_id
    }
  })
  .done(function(data) {
    result = data;
  })
  .fail(function() {
    result = 'error';
  });

  return result;
}

$('.ajaxbox').on('click', function(e) {
  e.preventDefault();
  $.ajax({
    url: '/artmebius/snippets/ajax.php',
    type: 'POST',
    data: {
      action: 'get_gallery_album',
      album: $(this).data('album')
    },
  })
  .done(function(data) {
    $.fancybox.open(
      $(data).filter('.lightbox'),
      fancybox_params
    );
  })
  .fail(function(data) {
    console.log("error", data);
  });
});


// #scripts

let url = document.location.href;
if (url.indexOf('contacts') == -1){
  document.oncopy=acl;
}

if ($('.prdt_tabs').length) {
  tabs.init(1, '.prdt_tabs');
}

fancybox_init(fancybox_params);
// toggle_class_upd(); // -> base.tpl
menu_toggle_upd();
backdrop.init();
table_responsive_init();

$('.go2top').scrollToTop();

// #events

$('body').on('click', '.spotdrop > *', function(e) {
  e.stopPropagation();
});
$('body').on('click', function(e) {
  $('.spotdrop').removeClass('spotdrop');
});

$(window).resize(function() {
  toggle_class_upd();
  menu_toggle_upd();
});

// key_code log
// $('body').on('keyup', function(e) {
//   let key_code = e.which ? e.which : e.keyCode;
//   console.log(key_code);
// });
