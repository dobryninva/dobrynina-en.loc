<?php
// get_slaves

/**
* v.1.0
*
* {'get_slaves' | snippet : ['id'=>$rid, 'link'=>1]}
*
* &id - id master-ресурса, обязательное, по-умолчанию id текущей страницы
* &link - id связи из настроек минишопа, обязательное
* &include_self - включать ли id master-ресурса в результат, обязательное, по-умолчанию - 1
*
* возвращает список id связанных ресурсов, включая master-ресурс (опционально)
*/

$output = '';
$ids = $errors = array();
$id = $modx->getOption('id', $scriptProperties, $modx->resource->id);
$link = $modx->getOption('link', $scriptProperties, '');
$include_self = $modx->getOption('include_self', $scriptProperties, 1);

$pdoTools = $modx->getService('pdoTools');

if (empty($link)) {
  $errors[] = 'Не установлен - &link - id связи из настроек минишопа';
}

if (empty($errors)) {

  $q = $modx->newQuery('msProductLink', array(
    'link' => $link,
    'master' => $id
  ));
  $q->select('slave');
  if ($q->prepare() && $q->stmt->execute()) {
    $ids = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
    if ($include_self) $ids[] = $id;
    $output = implode(',', $ids);
  }

} // empty($errors)

if (!empty($errors)) {
  if (empty($tpl_errors)) {
    $tpl_errors = '@INLINE <div class="alert alert-danger" role="alert">{$error}</div>';
  }
  foreach ($errors as $e => $error) {
    $output .= $pdoTools->getChunk($tpl_errors, array('error' => $error));
  }
}

return $output;