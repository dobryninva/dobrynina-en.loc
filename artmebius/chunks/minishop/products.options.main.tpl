{foreach $options as $option_key => $option}
  {set $option_value = ($option.value is array) ? ($option.value | join : ', ') : $option.value}
  {if $option.type in ['checkbox','combo-boolean']}
    {set $option_value = ($option_value == 1) ? 'есть' : 'нет'}
  {/if}
  <div class="prds_props_main_item">
    <div class="prds_props_main_item_title">{$option.caption}:</div>
    <div class="prds_props_main_item_value">{$option_value} {$option.measure_unit}</div>
  </div>
{/foreach}
{*
$option = Array
(
  [id] => 2
  [key] => availability
  [caption] => Наличие
  [description] =>
  [measure_unit] =>
  [category] => 84
  [type] => checkbox
  [properties] =>
  [product_id] => 38
  [value] => Array
      (
          [0] => 1
      )
  [category_name] => Характеристики
)
*}