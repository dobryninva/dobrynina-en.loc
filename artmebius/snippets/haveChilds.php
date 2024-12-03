<?php
/**
* [[haveChilds? &id=`[[*id]]` &templates=`10,11` &yes=`1` &no=`0` &toPlaceholder=`have_prds`]]
* fenom:
* {'haveChilds' | snippet : ['templates'=>[10,11], 'toPlaceholder'=>'have_prds']}
*
* &templates - id шаблонов ресурсов которые ищем, обязательное (через запятую или массивом)
* &id, &yes, &no - необязательные
* возвращает 0|1, в зависимости от того, есть ли у текущего ресурса (или id) потомки с указанным шаблоном
*/

$templates = $modx->getOption('templates', $scriptProperties, '');
if (empty($templates)) return;
$templates = (is_array($templates)) ? $templates : explode(',',$templates);

$id = $modx->getOption('id', $scriptProperties, $modx->resource->get('id'));
$yes = $modx->getOption('yes', $scriptProperties, 1);
$no = $modx->getOption('no', $scriptProperties, 0);
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, '');
$result = '';
$result = $modx->getCount('modResource', array(
    'parent' => $id,
    'published' => 1,
    'deleted' => 0,
    'template:IN' => $templates,
));
$result = ($result > 0) ? $yes : $no;
if($toPlaceholder){
  $modx->setPlaceholder($toPlaceholder,$result);
  $result = '';
}
return $result;