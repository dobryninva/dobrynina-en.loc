{var $key = $table ~ $delimeter ~ $filter}
<div class="filter-option__item">
  <div class="filter-option__checkbox-wrap custom-control custom-checkbox">
    <input class="filter-option__checkbox custom-control-input" type="checkbox" name="{$filter_key}" id="mse2_{$key}_{$idx}" value="{$value}" {$checked} {$disabled}/>
    <label class="filter-option__label custom-control-label" for="mse2_{$key}_{$idx}">
      <span class="filter-option__label-text">{$title}</span><span class="filter-option__label-sup">{$num}</span>
    </label>
  </div>
</div>