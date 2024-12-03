{foreach $options as $option_key => $option}
  {set $option_value = ($option.value is array) ? ($option.value | join : ', ') : $option.value}
  {if $option.type in ['checkbox','combo-boolean']}
    {set $option_value = ($option_value == 1) ? 'есть' : 'нет'}
  {/if}
  {if $option_value}
	  <div class="props-item">
	    <div class="props-item__title">{$option.caption}:</div>
	    <div class="props-item__value">{$option_value} {$option.measure_unit}</div>
	  </div>
  {/if}
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