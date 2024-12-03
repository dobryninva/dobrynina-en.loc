<?php
/**
* v.1.0
*
* fenom:
* {$filter | filter_item_caption_get : $table}
*
* возвращает caption
*/

$tables = [
  'tv'       =>'modTemplateVar',
  'msoption' =>'msOption',
  // 'resource' =>'modResource',
  'resource' => [
    'parent-categories' => 'Категория',
    'parent-parents'    => 'Категории',
  ],
  // 'ms'       =>'msProductData',
  'ms' => [
    'price'   => 'Цена',
    'weight'  => 'Вес',
    'article' => 'Артикул',
    'vendor'  => 'Производитель',
    'made_in' => 'Страна',
    'color'   => 'Цвет',
    'size'    => 'Размер',
    'tags'    => 'Тэги',
  ],
  // 'msvendor' =>'msVendor',
  'msvendor' => [
    'name'     => 'Производитель',
    'country'  => 'Страна',
  ],
];

switch ($options) {
  case 'tv':
    $q = $modx->newQuery('modTemplateVar');
    $q->select(array('caption'));
    $q->where(array(
      'name' => $input,
    ));
    $q->prepare();
    if($q->stmt && $q->stmt->execute()){
      $caption = $q->stmt->fetchColumn();
    }
    return (!empty($caption)) ? $caption : $modx->lexicon("mse2_filter_ms_{$input}");
    break;

  case 'msoption':
    $q = $modx->newQuery('msOption');
    $q->select(array('caption'));
    $q->where(array(
      'key' => $input,
    ));
    $q->prepare();
    if($q->stmt && $q->stmt->execute()){
      $caption = $q->stmt->fetchColumn();
    }
    return (!empty($caption)) ? $caption : $modx->lexicon("mse2_filter_ms_{$input}");
    break;

  case 'resource':
  case 'ms':
  case 'msvendor':
    return (!empty($tables[$options][$input])) ? $tables[$options][$input] : $modx->lexicon("mse2_filter_ms_{$input}");
    break;

  default:
    return $modx->lexicon("mse2_filter_ms_{$input}");
    break;
}