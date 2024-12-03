<?php
$tpl_link = $modx->getOption('tpl_link', $scriptProperties, '');
$pid = $modx->getOption('parent', $scriptProperties, '');
$output = '';
$active_letter = ($_REQUEST['let']) ? urldecode($_REQUEST['let']) : '';

if ($modx->getOption('pdotools_fenom_parser')) {
  $modx->getService('pdoTools');
}

if(!$docs = $modx->getCollection('modResource', array(
  'template' => 10,
  'published' => 1,
  'deleted' => 0,
  'class_key' => 'modDocument'
))){return;}

$arABC = array();
foreach($docs as $doc){
  $title = mb_strtolower($doc->get('pagetitle'), 'UTF-8');
  $arABC[] = mb_substr($title, 0, 1, 'UTF-8');
}
$arABC = array_unique($arABC);
sort($arABC);

foreach($arABC as $value){
  $active = ($value == $active_letter) ? 'active' : '';
  if ($modx->pdoTools) {
    $output .= $modx->pdoTools->getChunk($tpl_link, array('letter' => $value, 'active' => $active));
  } else {
    $output .= $modx->getChunk($tpl_link, array('letter' => $value, 'active' => $active));
  }
}
return $output;