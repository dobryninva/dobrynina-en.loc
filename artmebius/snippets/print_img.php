<?php
/**
* print_img
*
* @version v.1.0a
*
* @example
* {'print_img' | snippet : ['src'=>'/this/is/the/way.jpg', 'toPlaceholder'=>'place']}
*
* @var string $src - ПРАВИЛЬНЫЙ путь до изображения, необязательное
* @var string $thumb - параметры для phpthumbon, необязательное, по умолчанию качество 90%
* @var string $alt - alt изображения, необязательное, но обязательное
* @var string $id - id изображения, необязательное
* @var string $class - class изображения, необязательное
* @var string $attrs - дополнительные атрибуты изображения, через двойные кавычки (например, data-hint="текст"), необязательное
* @var string $lazy - добавлять атрибут loading="lazy", необязательное, по умолчанию добавляет
* @var string $toPlaceholder - описание, необязательные
*
* @return array возвращает $output или устанавливает плейсхолдеры в $toPlaceholder
*
* В: для чего этот сниппет?
* О: сниппет рисует тег img, учитывая svg, с отрезайзенным изображением, с атрибутами width и height полученными автоматически, с alt очищенным от двойных кавычек (всё для СЕО)
*
*/

$output = '';
$result = [];
$tpl = $modx->getOption('tpl', $scriptProperties, '');
$src = $modx->getOption('src', $scriptProperties, '');
$alt = $modx->getOption('alt', $scriptProperties, '');
$id = $modx->getOption('id', $scriptProperties, '');
$class = $modx->getOption('class', $scriptProperties, '');
$attrs = $modx->getOption('attrs', $scriptProperties, '');
$thumb = $modx->getOption('thumb', $scriptProperties, '&q=90');
$lazy = $modx->getOption('lazy', $scriptProperties, 1);
$site_url = MODX_URL_SCHEME.MODX_HTTP_HOST;

if (strpos($src, '.') === false) return;
if (!empty($alt)) $result['alt'] = str_replace('"', "'", $alt);
if (!empty($id)) $result['id'] = $id;
if (!empty($class)) $result['class'] = $class;
if (!empty($lazy)) $result['lazy'] = $lazy;

$pdoTools = $modx->getService('pdoTools');

if (empty($tpl)) {
  $tpl = '@INLINE <img src="{$src}"{if $alt?} alt="{$alt}"{/if}{if $id?} id="{$id}"{/if}{if $class?} class="{$class}"{/if}{if $lazy} loading="lazy"{/if} {$attrs}>';
}

$isSVG = (substr($src, -4) == '.svg') ? 1 : 0;

// если НЕ svg - ресайзим по параметрам, иначе оставляем svg как есть
if (!$isSVG) {
  $result['src'] = $modx->runSnippet('phpthumbon', [
    'input' => $src,
    'options' => $thumb
  ]);
  $result['src'] = (strpos($result['src'], $site_url) === false) ? $site_url.$result['src'] : $result['src'];
}else{
  $result['src'] = $src;
}

// ищем ширину и высоту в параметрах ресайза
$attr_width = '';
$attr_height = '';
$thumb_params = explode('&', $thumb);
foreach ($thumb_params as $pair) {
  if (!empty($pair)) {
    list($key, $val) = explode('=', $pair);
    if ($key == 'w' && !empty($val)) $attr_width = 'width="'.$val.'"';
    if ($key == 'h' && !empty($val)) $attr_height = 'height="'.$val.'"';
  }
}

// если ресайз был только по одной стороне или вообще без сторон - получаем размеры из подрезанного изображения
if (empty($attr_width) || empty($attr_height)) {
  $result['attrs'] = $modx->runSnippet('img_size', [
    'input' => $result['src'],
    'options' => 'attr'
  ]);
} else {
  $result['attrs'] = $attr_width . ' ' . $attr_height;
}

if (!empty($attrs)) $result['attrs'] .= ' '.$attrs;

$output = $pdoTools->getChunk($tpl, $result);

if($toPlaceholder){
  $modx->setPlaceholder($toPlaceholder, $output);
  $output = '';
}

return $output;