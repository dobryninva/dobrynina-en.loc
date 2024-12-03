{var $key = $table ~ $delimeter ~ $filter}
{set $display = (($idx > 1) && $.get[$filter_key] == '') ? 'none' : 'flex'}
{set $spoiler_sfx = ($rows_count > 12) ? (($.get[$filter_key] == '') ? ' filter-option__body_spoiler' : ' filter-option__body_spoiler_deferred') : ''}
{set $rows_sxf = ($rows_count > 6) ? ' filter-option__body_columns' : ''}
<div class="filter-option" id="mse2_{$key}">
  <div class="filter-option__head">
    <span class="filter-option__title">{$filter | filter_item_caption_get : $table}</span>
    <span class="filter-option__icon fal fa-chevron-down"></span>
  </div>
  <div class="filter-option__body{$rows_sxf}{$spoiler_sfx}" style="display: {$display};">
    {$rows}
  </div>
</div>