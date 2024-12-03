<?php
/**
* @version v.1.5
*
* @example
* {'ms_options_get' | snippet : ['sortby_name' => 'Частота ультразвука,Ультразвуковой доплеровский датчик,Точность частоты измерений']}
*
* @var string $format - обязательное, задаёт как форматировать строку в плейсхолдерах, по умолчанию - filter [compare, comma, for_json]
* @var string $sortby_name - необязательное, задаёт порядок вывода опций в фильтре, все неуказанные опции будут выводиться ниже
* @var string $sortby_key - необязательное, задаёт порядок вывода опций в фильтре, все неуказанные опции будут выводиться ниже
* @var string $exclude - необязательное, список опций минишопа через запятую, которые хотим исключить из результата
*
* @var string $exclude_global - опции, которые нужно исключить из фильтра, заданные в конфигураторе
* @var string $include_global - опции, которые нужно оставить в фильтре (и только их), заданные в конфигураторе
* @var boolean $is_ms_category - проверка, что мы находимся в категории минишопа, чтобы сократить выборку до опций привязанных к этой категории
*
* @return сниппет возвращает массив, где:
* result_arr.options - основной список опций минишопа (в выбранном формате - $format);
* result_arr.aliases - дополнительный список алиасов опций минишопа для фильтра;
*/

$sortby_name = $modx->getOption('sortby_name', $scriptProperties, '');
$format = $modx->getOption('format', $scriptProperties, 'filter');
$exclude = $modx->getOption('exclude', $scriptProperties, '');
$exclude_arr = $include_arr = $where_arr = $result_arr = array();

if ($format == 'filter') {
  $include_global = $modx->getOption('ms_options_include_global');
  $exclude_global = $modx->getOption('ms_options_exclude_global');
  if (!empty($include_global)) {
    $include_arr = array_merge($include_arr, array_map('trim', explode(',', $include_global)));
  }
  if (!empty($exclude_global)) {
    $exclude_arr = array_merge($exclude_arr, array_map('trim', explode(',', $exclude_global)));
  }
}

// исключаем опции для конкретной категории
if (!empty($exclude)) {
  if (!empty($include_arr)) {
    $include_arr = array_diff($include_arr, array_map('trim', explode(',', $exclude)));
  } elseif (!empty($exclude_arr)) {
    $exclude_arr = array_merge($exclude_arr, array_map('trim', explode(',', $exclude)));
  }
}

if ($format == 'compare') {
  if (!empty($include)) {
    $include_arr = array_map('trim', explode(',', $include));
  }
  if (!empty($exclude)) {
    $exclude_arr = array_map('trim', explode(',', $exclude));
  }
}

$is_ms_category = ($modx->resource->class_key == 'msCategory') ? 1 : 0;

if (!empty($sortby_name)) {
  $sortby_name_arr = array_map('trim', explode('||', $sortby_name));
  foreach ($sortby_name_arr as $k => $name) {
    $sortby_name_arr[$k] = (strpos($name, '"') === false) ? '"'.$name.'"' : $name;
  }
  $sortby_name_arr = array_reverse($sortby_name_arr);
  $sortby_name = implode(',', $sortby_name_arr);
}

if (!empty($sortby_key)) {
  $sortby_key_arr = array_map('trim', explode(',', $sortby_key));
  foreach ($sortby_key_arr as $k => $key) {
    $sortby_key_arr[$k] = (strpos($key, '"') === false) ? '"'.$key.'"' : $key;
  }
  $sortby_key = implode(',', $sortby_key_arr);
}

// query
$q = $modx->newQuery('msOption');
$q->setClassAlias('options');
$q->select(array('options.key','options.caption','options.measure_unit','options.type','options.description'));

if ($is_ms_category) {
  $q->innerJoin('msCategoryOption','category_options','options.id=category_options.option_id');
  $where_arr['category_options.category_id'] = $modx->resource->id;
}

if (!empty($include_arr)) {
  $where_arr['options.key:IN'] = $include_arr;
} elseif (!empty($exclude_arr)) {
  $where_arr['options.key:NOT IN'] = $exclude_arr;
}

$q->where($where_arr);

if (!empty($sortby_name)) {
  $q->sortby('FIELD(options.caption, ' . $sortby_name . ')', 'DESC');
} elseif (!empty($sortby_key)) {
  $q->sortby('FIELD(options.key, ' . $sortby_key . ')', 'ASC');
} else {
  $q->sortby('FIELD(options.type, "numberfield","combo-multiple","combobox","combo-options","combo-boolean","checkbox","datefield","textarea","textfield")');
}

$q->prepare();

if($q->stmt && $q->stmt->execute()){
  $rows = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
}
if (!$rows) return;

$filter_arr = $aliases_arr = array();
$filter_str = $aliases_str = $type = '';
foreach ($rows as $r => $row) {
  // type
  if (substr($row['description'],0,1) == ':') {
    $type = $row['description'];
  }
  else {
    switch ($row['type']) {
      case 'checkbox':
      case 'combo-boolean':
        $type = ':have'; // :boolean
        break;

      case 'numberfield':
        $type = ':number';
        break;

      case 'datefield': // ?
        $type = ':year'; // year month day
        break;

      default:
        $type = '';
        break;
    }
  }
  // format
  switch ($format) {
    case 'comma':
      $filter_arr[] = $row['key'];
      break;

    case 'for_json':
      $filter_arr[] = '"'.$row['key'].'"';
      break;

    case 'compare':
      $filter_arr[] = '"option.'.$row['key'].'"';
      break;

    case 'filter':
    default:
      $filter_arr[] = 'msoption|'.$row['key'].$type;
      $aliases_arr[]= 'msoption|'.$row['key'].'=='.$row['key'];
      break;
  }
}

if (!empty($filter_arr)) {
  $result_arr['options'] = implode(',', $filter_arr);
}

if (!empty($aliases_arr)) {
  $result_arr['aliases'] = implode(',', $aliases_arr);
}

return $result_arr;