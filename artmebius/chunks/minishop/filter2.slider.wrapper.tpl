<fieldset class="filter-option filter-option_slider with_slider" id="mse2_{$table ~ $delimeter ~ $filter}">
  <div class="filter-option__head">
    <span class="filter-option__title">{$filter | filter_item_caption_get : $table}</span>
    <span class="filter-option__icon fal fa-plus"></span>
  </div>
  <div class="filter-option__body">
    <div class="filter-option__slider mse2_number_slider"></div>
    <div class="filter-option__numbers mse2_number_inputs row">
      {$rows}
    </div>
  </div>
</fieldset>