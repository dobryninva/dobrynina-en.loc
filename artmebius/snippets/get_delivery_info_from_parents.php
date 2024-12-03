<?php
/**
* get_delivery_info_from_parents
*
* @version v.1.0
*
* @example
* {'get_delivery_info_from_parents' | snippet}
*
* @return string возвращает $output, в котором значение ТВ delivery_info из первого родителя, у которого это поле заполнено, иначе поле prdt_delivery из конфигуратора
*/

$output = $modx->getOption('prdt_delivery');
$doc_id = $modx->resource->id;
$delivery_info_id = 122; // tv delivery_info

$pids = $modx->getParentIds($doc_id, 10, array('context' => 'web'));
if (!empty($pids)) {
  $q = $modx->newQuery('modTemplateVarResource');
  $q->select('contentid,value');
  $q->where(array(
    'tmplvarid' => $delivery_info_id,
    'contentid:IN' => $pids
  ));
  $q->prepare();
  if($q->stmt && $q->stmt->execute()){
    $id_values = $q->stmt->fetchAll(PDO::FETCH_KEY_PAIR);
    if (!empty($id_values)) {
      foreach ($pids as $pid) {
        if (isset($id_values[$pid]) && $id_values[$pid] != '') {
          $output = $id_values[$pid];
          break;
        }
      }
    }
  }
  $q->stmt->closeCursor();
}

return $output;
?>