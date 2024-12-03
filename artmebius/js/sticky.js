var Sticky = window.Sticky || {};

Sticky = (function() {

  var instanceUid = 0;

  function Sticky(element, settings) {

    var _ = this, dataSettings;

    _.defaults = {
      indent: 0,
      mobileFirst: false,
      respondTo: 'window',
      responsive: null,
    };

    _.initials = {
      $sticker_under: null,
      currentIndent: 0,
      paused: false,
      unsticked: false
    };

    $.extend(_, _.initials);

    _.activeBreakpoint = null;
    _.breakpoints = [];
    _.breakpointSettings = [];
    _.$sticker = $(element);
    _.windowWidth = 0;

    dataSettings = $(element).data('sticky') || {};

    _.options = $.extend({}, _.defaults, settings, dataSettings);

    _.currentIndent = _.options.indent;

    _.originalSettings = _.options;

    _.instanceUid = instanceUid++;

    _.registerBreakpoints();
    _.init(true);

  }

  return Sticky;

}());

Sticky.prototype.init = function(creation) {

  var _ = this;

  if (!$(_.$sticker).hasClass('sticky-initialized')) {

    $(_.$sticker).addClass('sticky-initialized');

    _.buildOut();
    _.initializeEvents();
    _.checkResponsive(true);

  }

  if (creation) {
    _.$sticker.trigger('init', [_]);
  }

};

Sticky.prototype.buildOut = function() {

  var _ = this;

  if (!_.$sticker.next('.under_fixed').length){
    _.$sticker.after('<div class="under_fixed" style="height: ' + _.$sticker.outerHeight() + 'px;"></div>');
  }

  _.$sticker_under =_.$sticker.next('.under_fixed');

  _.position_check();

};

Sticky.prototype.sticker_under_upd = function() {

  var _ = this;

  if (!_.paused) {
    if (_.$sticker.hasClass('fixed')) _.$sticker.removeClass('fixed');
    _.$sticker_under.height(_.$sticker.outerHeight());
  }

};

Sticky.prototype.position_check = function(indent) {

  var _ = this;

  if (!_.paused) {

    if (typeof indent == 'undefined') {
      indent = _.currentIndent;
    }
    let scroll_top = $(window).scrollTop();

    if (!_.$sticker.hasClass('fixed')) {
      let position = _.$sticker.offset(),
          fixpoint = position.top + indent;
      if (scroll_top > fixpoint) {
        _.$sticker.addClass('fixed');
        // if (typeof onFixedCallback == 'function') onFixedCallback(_.$sticker);
      }
    } else {
      let position = _.$sticker_under.offset(),
          fixpoint = position.top + indent;
      if (scroll_top <= fixpoint) {
        _.$sticker.removeClass('fixed');
        // if (typeof onUnFixedCallback == 'function') onUnFixedCallback(_.$sticker);
      }
    }

  }

};

Sticky.prototype.initializeEvents = function() {

  var _ = this;

  $(window).on('resize.sticky.sticky-' + _.instanceUid, $.proxy(_.resize, _));
  $(window).on('scroll.sticky.sticky-' + _.instanceUid, $.proxy(_.scroll, _));
  $(window).on('load.sticky.sticky-' + _.instanceUid, $.proxy(_.load, _));

};

Sticky.prototype.checkResponsive = function(initial, forceUpdate) {

  var _ = this,
    breakpoint, targetBreakpoint, respondToWidth, triggerBreakpoint = false;
  var stickerWidth = _.$sticker.width();
  var windowWidth = window.innerWidth || $(window).width();

  if (_.respondTo === 'window') {
    respondToWidth = windowWidth;
  } else if (_.respondTo === 'sticker') {
    respondToWidth = stickerWidth;
  } else if (_.respondTo === 'min') {
    respondToWidth = Math.min(windowWidth, stickerWidth);
  }

  if ( _.options.responsive &&
    _.options.responsive.length &&
    _.options.responsive !== null) {

    targetBreakpoint = null;

    for (breakpoint in _.breakpoints) {
      if (_.breakpoints.hasOwnProperty(breakpoint)) {
        if (_.originalSettings.mobileFirst === false) {
          if (respondToWidth < _.breakpoints[breakpoint]) {
            targetBreakpoint = _.breakpoints[breakpoint];
          }
        } else {
          if (respondToWidth > _.breakpoints[breakpoint]) {
            targetBreakpoint = _.breakpoints[breakpoint];
          }
        }
      }
    }

    if (targetBreakpoint !== null) {
      if (_.activeBreakpoint !== null) {
        if (targetBreakpoint !== _.activeBreakpoint || forceUpdate) {
          _.activeBreakpoint = targetBreakpoint;
          if (_.breakpointSettings[targetBreakpoint] === 'unsticky') {
            _.unsticky(targetBreakpoint);
          } else if (_.breakpointSettings[targetBreakpoint] === 'paused') {
            _.pause(targetBreakpoint);
          } else {
            _.options = $.extend({}, _.originalSettings, _.breakpointSettings[targetBreakpoint]);
            _.paused = false;
            _.currentIndent = _.options.indent;
            _.sticker_under_upd();
            _.position_check();
          }
          triggerBreakpoint = targetBreakpoint;
        }
      } else {
        _.activeBreakpoint = targetBreakpoint;
        if (_.breakpointSettings[targetBreakpoint] === 'unsticky') {
          _.unsticky(targetBreakpoint);
        }  else if (_.breakpointSettings[targetBreakpoint] === 'paused') {
          _.pause(targetBreakpoint);
        } else {
          _.options = $.extend({}, _.originalSettings, _.breakpointSettings[targetBreakpoint]);
          _.paused = false;
          _.currentIndent = _.options.indent;
          _.sticker_under_upd();
          _.position_check();
        }
        triggerBreakpoint = targetBreakpoint;
      }
    } else {
      if (_.activeBreakpoint !== null) {
        _.activeBreakpoint = null;
        _.options = _.originalSettings;
        _.paused = false;
        _.currentIndent = _.options.indent;
        _.sticker_under_upd();
        _.position_check();
        triggerBreakpoint = targetBreakpoint;
      }
    }

    // only trigger breakpoints during an actual break. not on initialize.
    if( !initial && triggerBreakpoint !== false ) {
      _.$sticker.trigger('breakpoint', [_, triggerBreakpoint]);
    }
  }

};

Sticky.prototype.registerBreakpoints = function() {

  var _ = this, breakpoint, currentBreakpoint, l,
    responsiveSettings = _.options.responsive || null;

  if ( $.type(responsiveSettings) === 'array' && responsiveSettings.length ) {

    _.respondTo = _.options.respondTo || 'window';

    for ( breakpoint in responsiveSettings ) {

      l = _.breakpoints.length-1;

      if (responsiveSettings.hasOwnProperty(breakpoint)) {
        currentBreakpoint = responsiveSettings[breakpoint].breakpoint;

        // loop through the breakpoints and cut out any existing
        // ones with the same breakpoint number, we don't want dupes.
        while( l >= 0 ) {
          if( _.breakpoints[l] && _.breakpoints[l] === currentBreakpoint ) {
            _.breakpoints.splice(l,1);
          }
          l--;
        }

        _.breakpoints.push(currentBreakpoint);
        _.breakpointSettings[currentBreakpoint] = responsiveSettings[breakpoint].settings;

      }

    }

    _.breakpoints.sort(function(a, b) {
      return ( _.options.mobileFirst ) ? a-b : b-a;
    });

  }

};

Sticky.prototype.resize = function() {

  var _ = this;

  if ($(window).width() !== _.windowWidth) {
    clearTimeout(_.windowDelay);
    _.windowDelay = window.setTimeout(function() {
      _.windowWidth = $(window).width();
      _.checkResponsive();
      if( !_.unsticked ) {
        _.sticker_under_upd();
        _.position_check();
      }
    }, 50);
  }

};

Sticky.prototype.scroll = function() {

  var _ = this;

  if( !_.unsticked ) {
    _.position_check();
  }
};

Sticky.prototype.load = function() {

  var _ = this;

  if( !_.unsticked ) {
    _.sticker_under_upd();
    _.position_check(); // tt
  }

};

Sticky.prototype.unsticky = function(fromBreakpoint) {

  var _ = this;

  _.$sticker.trigger('unsticky', [_, fromBreakpoint]);
  _.destroy();

};

Sticky.prototype.pause = function(fromBreakpoint) {

  var _ = this;

  _.$sticker.removeClass('fixed');
  _.$sticker.trigger('paused', [_, fromBreakpoint]);
  _.paused = true;

};

Sticky.prototype.destroy = function(refresh) {

  var _ = this;

  _.cleanUpEvents();

  if (_.$sticker_under) {
    _.$sticker_under.remove();
  }

  _.$sticker.removeClass('sticky-initialized fixed');
  _.unsticked = true;

  if(!refresh) {
    _.$sticker.trigger('destroy', [_]);
  }

};

Sticky.prototype.cleanUpEvents = function() {

  var _ = this;

  $(window).off('resize.sticky.sticky-' + _.instanceUid, _.resize);
  $(window).off('scroll.sticky.sticky-' + _.instanceUid, _.scroll);
  $(window).off('load.sticky.sticky-' + _.instanceUid, _.load);

};

$.fn.sticky = function() {
var _ = this,
  opt = arguments[0],
  args = Array.prototype.slice.call(arguments, 1),
  l = _.length,
  i,
  ret;
  for (i = 0; i < l; i++) {
    if (typeof opt == 'object' || typeof opt == 'undefined')
        _[i].sticky = new Sticky(_[i], opt);
    else
        ret = _[i].sticky[opt].apply(_[i].sticky, args);
    if (typeof ret != 'undefined') return ret;
  }
  return _;
};