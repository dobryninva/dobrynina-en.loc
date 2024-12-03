var kit = {
  get id(){
    return $('#product .prdt_block').attr('data-id');
  },
  price : 0,
  get discount(){
    let discount = 0;
    $.ajax({
      type: 'POST',
      url: '/artmebius/snippets/ajax.php',
      data: {'id':kit.id,'action':'get_discount'},
      success: function(data){
        discount = data;
        return data;
      },
      dataType: 'text',
      async:false
    });
    return discount;
  },
  get color(){
    return $('.prod_kit').attr('data-color');
  },
  get tkan(){
    return $('.prod_kit').attr('data-tkan');
  },
  init : function() {
    $('.kit_row').each(function(index, el) {
      let $kit_row = $(this),
          kit_row_id = $kit_row.find('[name="shk-id"]').val(),
          $kit_torg = $kit_row.find('.kit_torg'),
          $option = $kit_torg.first().find('[name="kit-option"]'),
          have_field = $option.attr('data-have-field'),
          have_color = $option.attr('data-have-color'),
          have_tkan = $option.attr('data-have-tkan'),
          option_value = $option.val(),
          option_title = $option.attr('data-title'),
          option_alias = $option.attr('data-alias'),
          option_price = $option.attr('data-price');
      // console.log($kit_row,$kit_torg,$option,option_value,option_title,option_price, have_field, have_color);

      $option.prop('checked', true);

      // torg
      if (option_title != 'товар') {
        if (!$kit_row.find('form').find('.torg-option-' + option_alias).length && have_field == 1) {
          let input = '<input class="torg-option-' + option_alias + '" type="hidden" name="torg-option[]" value="'+ option_title + '__' + option_value + '" />';
          $kit_row.find('form').append(input);
        }

        if (!$kit_row.find('form').find('.torg-option-color').length && have_color == 1) {
          let input = '<input class="torg-option-color" type="hidden" name="torg-option[]" value="цвет__' + kit.color + '" />';
          $kit_row.find('form').append(input);
        }

        if (!$kit_row.find('form').find('.torg-option-tkan').length && have_tkan == 1) {
          let input = '<input class="torg-option-tkan" type="hidden" name="torg-option[]" value="ткань__' + kit.tkan + '" />';
          $kit_row.find('form').append(input);
        }

        if (!$kit_row.find('form').find('.torg-price').length) {
          let input = '<input class="torg-price" type="hidden" name="torg-price" value="' + option_price + '" />';
          $kit_row.find('form').append(input);
        }
      }

      // kit
      if (!$('#shk-form').find('.kit-option-' + kit_row_id).length) {
        let input = '',
            str_value = option_title + '__' + option_value + '__' + kit_row_id,
            qty = $kit_row.find('[name="qty"]') ? $kit_row.find('[name="qty"]').val() : 0;
            str_value += (qty > 0) ? '__' + qty : '';
        input = '<input class="kit-option-' + kit_row_id + '" type="hidden" name="kit-option[]" value="' + str_value + '" />';
        // if (option_title != 'товар') {
        //   input = '<input class="kit-option-' + kit_row_id + '" type="hidden" name="kit-option[]" value="' + option_title + '__' + option_value + '__' + kit_row_id + '" />';
        // } else {
        //   input = '<input class="kit-option-' + kit_row_id + '" type="hidden" name="kit-option[]" value="' + option_title + '__' + option_value + '" />';
        // }
        $('#shk-form').append(input);
      }

    });

    if (!$('#shk-form').find('.kit-option-color').length && kit.color) {
      let input = '<input class="kit-option-color" type="hidden" name="kit-option[]" value="цвет__'+ kit.color + '" />';
      $('#shk-form').append(input);
    }

    if (!$('#shk-form').find('.kit-option-tkan').length && kit.tkan) {
      let input = '<input class="kit-option-tkan" type="hidden" name="kit-option[]" value="ткань__'+ kit.tkan + '" />';
      $('#shk-form').append(input);
    }

    kit.price_total();

  },

  price_total : function(){
    let price = 0,
        discount = kit.discount;
    $('.kit_row').each(function(index, el) {
      let item_price = 0,
          item_count = ($(this).find('[name="qty"]').length) ? parseInt($(this).find('[name="qty"]').val()) : 1;
      item_price = parseInt($(this).find('[name="kit-option"]:checked').attr('data-price'));
      price += item_price * item_count;
    });
    if (typeof discount != 'undefined' && discount > 0) {
      price = price * (1 - discount / 100);
    }
    $('#shk-form .shk-price').text(price.format(0, 3, ' ', '.'));
    if (!$('#shk-form').find('.kit-price').length) {
      let input = '<input class="kit-price" type="hidden" name="kit-price" value="'+ price + '" />';
      $('#shk-form').append(input);
    } else {
      $('#shk-form .kit-price').val(price);
    }
    return kit.price = price;
  }
}

kit.init();

$('[name="kit-option"]').change(function(e) {
  let $option = $(this),
      $kit_row = $(this).parents('.kit_row'),
      kit_row_id = $kit_row.find('[name="shk-id"]').val(),
      option_value = $option.val(),
      option_title = $option.attr('data-title'),
      option_alias = $option.attr('data-alias'),
      option_price = $option.attr('data-price');
  // console.log($option,$kit_row,option_value,option_title,option_price);
  $kit_row.find('.torg-option-' + option_alias).val(option_title + '__' + option_value);
  $kit_row.find('.torg-price').val(option_price);
  $('#product .kit-option-' + kit_row_id).val(option_title + '__' + option_value + '__' + kit_row_id);
  kit.price_total();
});

$('.kit_torg').click(function(e) {
  $(this).find('[name="kit-option"]').prop('checked', true).change();
});