<?php
/**
* v.1
*
* [[getRoot]]
* fenom:
* {'getRoot' | snippet}
*
* &id - id ресурса, корень которого ищем, по умолчанию текущий ресурс
* &toPlaceholder - необязательные
*
* возвращает id корневого раздела или 0, если мы в корневом ресурсе
*/

$id = $modx->getOption('id', $scriptProperties, $modx->resource->get('id'));
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, '');

$pids = $modx->getParentIds($id, 10, array('context' => 'web'));
$result = (count($pids) >= 2) ? $pids[count($pids) - 2] : 0;

if($toPlaceholder){
  $modx->setPlaceholder($toPlaceholder, $result);
  $result = '';
}

return $result;