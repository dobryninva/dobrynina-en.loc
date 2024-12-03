<?php
/**
* group_ids_by_parent
*
* @version v.1.0
*
* @example
* {'group_ids_by_parent' | snippet : ['ids'=>'1,2,3', 'toPlaceholder'=>'place']}
*
* @var string $ids - список id ресурсов через запятую или массив, обязательное
* @var string $toPlaceholder - описание, необязательные
*
* @return array возвращает $output - массив id разбитый на группы по родителю или устанавливает плейсхолдеры в $toPlaceholder
*/

$output = '';
$result = $errors = array();
$ids = $modx->getOption('ids', $scriptProperties, '');

if (empty($ids)) return;

if (!is_array($ids)) {
  $ids = array_map('trim', explode(',', $ids));
}

$doc_id = $modx->resource->id;

$pdoTools = $modx->getService('pdoTools');

$q = $modx->newQuery('modResource');
$q->setClassAlias('resource');
$q->select('parents.pagetitle, GROUP_CONCAT(resource.id)');
$q->leftJoin('modResource', 'parents', 'resource.parent = parents.id');
$q->where(array(
  'resource.id:IN' => $ids
));
$q->sortby('parents.pagetitle', 'ASC');
$q->groupby('parents.pagetitle');
$q->prepare();
if($q->stmt && $q->stmt->execute()){
  $output = $q->stmt->fetchAll(PDO::FETCH_KEY_PAIR);
}

return $output;