<?php
if (!function_exists('dd')){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
  }
}

// dd($torgs);
// [0] => Array
// (
//     [MIGX_id] => 2
//     [image] => catalog/krovat-ka-800.26-valensia-1.jpg
//     [vybor1] => цвет
//     [value1] => Валенсия
//     [vybor2] => размер
//     [value2] => 1602 x 2090
//     [price] => 26196
//     [old_price] => 40877
//     [ean] =>
//     [label] => 0
//     [images] =>
// )

$have_color = 0;
$have_value = 0;
$color_title = '';
$color_value = '';
$arColors = array();

if (is_array($torgs) && count($torgs) > 0) {

  foreach ($torgs as $k => $tp) {

    if (strtolower($tp['vybor1']) == 'цвет') {
      $color_title = 'vybor1';
      $color_value = 'value1';
      $have_color = 1;
    } elseif (strtolower($tp['vybor2']) == 'цвет') {
      $color_title = 'vybor2';
      $color_value = 'value2';
      $have_color = 1;
    } else {
      $have_color = 0;
    }

    if ($have_color) {

      // if (!empty($tp[$color_value])) {
      //   $arColors[strtolower($tp[$color_value])]['color'] = $tp[$color_value];
      //   $arColors[strtolower($tp[$color_value])]['size'] = $tp[$color_value];
      // }

    }
  }

}
