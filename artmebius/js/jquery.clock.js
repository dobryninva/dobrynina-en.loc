function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(selector, endtime) {
  var clock = $(selector);
  clock.each(function(){
    var dayDiv = $(this).find('.day');
    var hoursDiv = $(this).find('.hours');
    var minutesDiv = $(this).find('.minutes');
    var secondsDiv = $(this).find('.seconds');

    function updateClock() {
      var t = getTimeRemaining(endtime);
      //dayDiv.innerHTML = t.days;
      dayDiv.text(('0' + t.days).slice(-2));
      hoursDiv.text(('0' + t.hours).slice(-2));
      minutesDiv.text(('0' + t.minutes).slice(-2));
      secondsDiv.text(('0' + t.seconds).slice(-2));

      if (t.total <= 0) {
        clearInterval(timeinterval);
        clock.hide();
      }
    }

    updateClock();
    var timeinterval = setInterval(updateClock, 1000);
  });
}