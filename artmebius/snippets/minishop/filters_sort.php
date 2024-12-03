<?php
/**
*
* filters_sort
*
* @version v.1.0
*
* @example
* {set $filters = 'filters_sort' | snippet : [
*   'filters' => $filters,
*   'order'   => 'price, material, width, height, lenght'
* ]}
*
* @var string $filters - список опций filters для mFilter2, обязательное
* @var string $order - новый порядок опций для сортировки, обязательное
*
* @return string возвращает отсортированный $filters; если $order пустой возвращает исходный $filters
*/

$filters = $modx->getOption('filters', $scriptProperties, '');
$order = $modx->getOption('order', $scriptProperties, '');

if (empty($filters) || empty($order)) return $filters;

$options_sorted_default = array_map('trim', explode(',', $filters));
$options_sorting_order = array_map('trim', explode(',', $order));

// массив опций фильтра для будущей сортировки
foreach ($options_sorted_default as $key => $option) {
  $key_option = $option;
  $dt = stripos($key_option, ':');
  if ($dt !== false) {
    $key_option = substr($key_option, 0, $dt);
  }
  $vl = stripos($key_option, '|');
  if ($vl !== false) {
    $key_option = substr($key_option, $vl+1);
  }
  $options_sorted_default[$key_option] = $option;
  unset($options_sorted_default[$key]);
}

// опции фильтра текущей категории
$options_keys =array_keys($options_sorted_default);

// убираем из сортировки опции которых нет в текущей категории
$options_sorting_order = array_intersect($options_sorting_order, $options_keys);

// находим опции, которые не сортируем
$options_keys_unsorted = array_diff($options_keys, $options_sorting_order);

// новый порядок сортировки
$options_sorting_order = array_merge($options_sorting_order, $options_keys_unsorted);

// сортируем опции фильтра
$options_sorted = array();
foreach ($options_sorting_order as $key => $option) {
  $options_sorted[$key] = $options_sorted_default[$option];
}

return implode(',', $options_sorted);