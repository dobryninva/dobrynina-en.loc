<?php
/**
* color_yiq
*
* @version v.1.0
*
* @example
* {'color_yiq' | snippet : ['color'=>'f1f1f1']}
*
* @var string $color - цвет в hex, обязательное
*
* @return string возвращает dark|white, в зависимости от яркости цвета
*/

$color = $modx->getOption('color', $scriptProperties, '');

if (empty($color)) return false;

$threshold = 150;

if (!function_exists(hexToRgb)) {
  function hexToRgb($hex, $alpha = false) {
    $hex      = str_replace('#', '', $hex);
    $length   = strlen($hex);
    $rgb['r'] = hexdec($length == 6 ? substr($hex, 0, 2) : ($length == 3 ? str_repeat(substr($hex, 0, 1), 2) : 0));
    $rgb['g'] = hexdec($length == 6 ? substr($hex, 2, 2) : ($length == 3 ? str_repeat(substr($hex, 1, 1), 2) : 0));
    $rgb['b'] = hexdec($length == 6 ? substr($hex, 4, 2) : ($length == 3 ? str_repeat(substr($hex, 2, 1), 2) : 0));
    if ( $alpha ) {
      $rgb['a'] = $alpha;
    }
    return $rgb;
  }
}

$color_arr = hexToRgb($color);
$yiq = (($color_arr['r'] * 299) + ($color_arr['g'] * 587) + ($color_arr['b'] * 114)) / 1000;

return ($yiq >= $threshold) ? 'dark' : 'white';