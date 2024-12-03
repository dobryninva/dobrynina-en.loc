<?php
/**
* v.1.1b
*
* [[linked_articles? &cat_id=`7`]]
* fenom:
* {'linked_articles' | snippet}
* {'linked_articles' | snippet : ['cat_id'=>7]}
*
* &cat_id - обязательное, id категории для которой ищем связи, по-умолчанию текущая категория
*
* возвращает строку, список id статей (через запятую), в которых выбрана категория cat_id
*/

$cat_id = $modx->getOption('cat_id', $scriptProperties, $modx->resource->id);
$linked_categories_tv_id = 102; // изменить при переносе
if (!$cat_id) return;

$q = $modx->newQuery('modTemplateVarResource');
$q->select(array('contentid','value'));
$q->where(array('tmplvarid' => $linked_categories_tv_id));
$q->sortby('contentid', 'ASC');
$q->prepare();
if($q->stmt && $q->stmt->execute()){
  $rows = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!$rows) return;

$values_arr = $result_arr = array();
foreach ($rows as $r => $row) {
  $values_arr = explode('||', $row['value']);
  if (in_array($cat_id, $values_arr)) {
    $result_arr[] = $row['contentid'];
  }
}

return (!empty($result_arr)) ? implode(',', $result_arr) : '';