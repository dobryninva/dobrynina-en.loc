{foreach $options as $option_key => $option}
  {($option.value is array) ? ($option.value | join : ', ') : $option.value}
{/foreach}
{* v1 +
  {($option.value is array) ? ($option.value | join : ', ') : $option.value}
*}
{* v2 -
  {set $value = ($option.value is array) ? ($option.value | join : ', ') : $option.value}
  {$value | setPlaceholder : $option_key}
*}