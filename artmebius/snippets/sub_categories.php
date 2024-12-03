<?php
/**
* v.1.0b
*
* [[sub_categories? &cat_id=`7`]]
* fenom:
* {'sub_categories' | snippet}
* {'sub_categories' | snippet : ['cat_id'=>7]}
*
* &cat_id - обязательное, id категории для которой ищем связи, по-умолчанию текущая категория
*
* возвращает массив, поля элемента которого: title - menutitle или pagetitle категории; ids - список id подкатегорий
*/

$cat_id = $modx->getOption('cat_id', $scriptProperties, $modx->resource->get('id'));
$sub_categories_tv_id = 103; // подкатегории - изменить при переносе
if (!$cat_id) return;

$q = $modx->newQuery('modTemplateVarResource');
$q->setClassAlias('values');
$q->innerJoin('modResource','resources','values.contentid=resources.id');
$q->select(array('values.contentid','values.value','resources.pagetitle','resources.menutitle'));
$q->where(array(
  'values.tmplvarid' => $sub_categories_tv_id
));
$q->sortby('values.contentid', 'ASC');
$q->prepare();
if($q->stmt && $q->stmt->execute()){
  $rows = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!$rows) return;

foreach ($rows as $r => $row) {
  $values_arr = explode('||', $row['value']);
  // для текущей категории находим список выбранных "подкатегорий"
  if ($cat_id == $row['contentid']) {
    $result_arr[$row['contentid']]['title'] = ($row['menutitle'] != '') ? $row['menutitle'] : $row['pagetitle'];
    $result_arr[$row['contentid']]['ids'] = implode(',', $values_arr);
    break;
  } // для текущей "подкатегории" находим все категории, к которым она привязана и формируем массив из связей
  elseif (in_array($cat_id, $values_arr)) {
    $result_arr[$row['contentid']]['title'] = ($row['menutitle'] != '') ? $row['menutitle'] : $row['pagetitle'];
    $result_arr[$row['contentid']]['ids'] = implode(',', $values_arr);
  }
}

return $result_arr;