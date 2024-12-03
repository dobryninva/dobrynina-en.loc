$('.ctgs_slider').slick({
  autoHeight     : true,
  infinite       : false,
  accessibility  : false,
  fade           : false,
  autoplay       : false, // or true
  autoplaySpeed  : 15000,
  speed          : 500,
  slidesToShow   : 1,
  slidesToScroll : 1,
  cssEase        : 'ease-out',
  dots           : true,
  dotsClass      : 'ctrl-dots dots-gray-active-green dots-small-active-big',
  arrows         : false,
  zIndex         : 500,
  useTransform   : true,
  draggable      : false,
  mobileFirst    : true,
  responsive: [
    {
      breakpoint: 479,
      settings: {
        slidesToShow : 2,
        slidesToScroll : 2,
      }
    },
    {
      breakpoint: 639,
      settings: {
        slidesToShow   : 2,
        slidesToScroll : 2,
      }
    },
    {
      breakpoint: 767,
      settings: {
        slidesToShow   : 3,
        slidesToScroll : 3,
      }
    },
    {
      breakpoint: 1023,
      settings: {
        slidesToShow: 4,
        slidesToScroll : 1,
      }
    },
    {
      breakpoint: 1279,
      settings: {
        slidesToShow: 5,
        slidesToScroll : 1,
      }
    }
  ]
});
