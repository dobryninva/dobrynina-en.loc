{var $key = $table ~ $delimeter ~ $filter}
<div class="filter-option__numbers-col col-md-6">
  <label class="filter-option__label" for="mse2_{$key}_{$idx}">
  	{* <span class="filter-option__label-text">{$title}</span> *}
    <input type="text" name="{$filter_key}" id="mse2_{$key}_{$idx}" value="{$value}" data-current-value="{$current_value}" class="filter-option__numbers-input form-control"/>
  </label>
</div>