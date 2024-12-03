tmFilters.init();
var filter_ext = {
  upd_sorting: function(elem){
    var link = jQuery(elem),
        sortby_val = link.data('sortby'),
        sortdir_val = link.data('sortdir'),
        limit_val = link.data('limit');

    if (typeof sortby_val != 'undefined') {
      this.setFormValue('sortby', sortby_val);
    }

    if (typeof sortdir_val != 'undefined'){
      var new_dir = (sortdir_val == 'ASC') ? 'DESC' : 'ASC';
      if (!link.hasClass('active')){
        this.setFormValue('sortdir', sortdir_val);
      } else {
        this.setFormValue('sortdir', new_dir);
        link.data('sortdir', new_dir);
        link.find('.fa').toggleClass('fa-sort-amount-asc fa-sort-amount-desc');
      }
    }

    if (typeof limit_val != 'undefined'){
      this.setFormValue('limit', limit_val);
    }

    this.sorted = true;
    this.switchPage(1, false);
    this.pushState();

    if (!link.hasClass('active')){
      link.addClass('active').siblings('a').removeClass('active');
    }
  },
  upd_abc_filter: function(elem){
    var link = jQuery(elem),
      fl = link.data('letter');
    this.setFormValue('f_first_letter', fl);
    this.filtered = true;
    this.filtersSubmit();
    if (!link.hasClass('active')){
      link.addClass('active').siblings('a').removeClass('active');
    }
  },
  resetExt: function(){
    jQuery('.abc_filter a').removeClass('active');
  }
}
jQuery.extend(tmFilters, filter_ext);