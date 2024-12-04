<?php

/**
* img_size
*
* @version v.1.1a
*
* @example
* {$image | img_size : "attr"}
* или для картинки после ресайза по одной стороне
* {set $image_resize = 'phpthumbon' | snippet : ['input' => $image, 'options' => '&h=240'] | replace : '/assets' : 'assets'}
* {$image_resize | img_size : "attr_width, attr_height"}
*
* @var string $input - обязательное, путь до картинки
* @var string $options - необязательное, параметры, определяющие что возвращаем: attr, attr_width, width, attr_height, height; по-умолчанию - attr
*
* @return string возвращает $output
*/

if (empty($input)) return;

$output = '';
$tmp = array();

$isSVG = (substr($input, -4) == '.svg') ? 1 : 0;

if (!$isSVG) {

  list($width, $height, $type, $attr) = getimagesize(MODX_BASE_PATH.$input);
  $attr_width = 'width="'.$width.'"';
  $attr_height = 'height="'.$height.'"';

} else {

  if (file_exists(MODX_BASE_PATH.$input)) {
    $svg = simplexml_load_file(MODX_BASE_PATH.$input);
    $svg_attrs = $svg->attributes();
    list($x, $y, $width, $height) = explode(' ', (string)$svg_attrs->viewBox);
    $attr_width = 'width="'.$width.'"';
    $attr_height = 'height="'.$height.'"';
    $attr = $attr_width . ' ' . $attr_height;
  }

}

if (!empty($options)) {
  $options = array_map('trim', explode(',', $options));
  foreach ($options as $k => $option) {
    if (isset($$option)) {
      $tmp[] = $$option;
    }
  }
  $output = implode(' ', $tmp);

  return $output;

} else {

  return $attr;

}
return;
