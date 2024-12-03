<?php
/**
* get_field_caption
*
* @version v.1.0
*
* @example
* {$filter | get_field_caption : $table}
* {$tv | get_field_caption : 'tv'}
*
* @var string $table - тип поля (tv, msoption, ms, msvendor), обязательное
*
* @return string возвращает $caption поля
*/

// $tables можно расширять вручную
$tables = [
  'resource' => [
    'parent-categories' => 'Категория',
    'parent-parents'    => 'Категории',
  ],
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