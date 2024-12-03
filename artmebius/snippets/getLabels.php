<?php
$labels_arr = array();
$label_values = $modx->getOption('label_values');
$label_values_arr = array_map('trim', explode('||', $label_values));
foreach ($label_values_arr as $label_value) {
  if ($label_value) {
    $label_value_arr = array_map('trim', explode('==', $label_value));
    $labels_arr[$label_value_arr[1]] = $label_value_arr[0];
  }
}
return $labels_arr;