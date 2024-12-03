<?php
/**
* [[haveParent? &fid=`7` &toPlaceholder=`in_catalog`]]
* fenom:
* {'haveParent' | snippet : ['fid'=>7, 'toPlaceholder'=>'in_catalog']}
*
* &fid - id родителя, которые ищем, обязательное
* &id, &yes, &no - необязательные
* возвращает 0|1, в зависимости от того, есть ли у текущего ресурса (или id) в родителях ресурс с указанным id (fid)
*/

$fid = $modx->getOption('fid', $scriptProperties, '');
if (empty($fid)) return;

$id = $modx->getOption('id', $scriptProperties, $modx->resource->get('id'));
$yes = $modx->getOption('yes', $scriptProperties, 1);
$no = $modx->getOption('no', $scriptProperties, 0);
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, '');
$result = '';
$pids = $modx->getParentIds($id, 10, array('context' => 'web'));
$result = (in_array($fid,$pids)) ? $yes : $no;
if($toPlaceholder){
  $modx->setPlaceholder($toPlaceholder,$result);
  $result = '';
}
return $result;