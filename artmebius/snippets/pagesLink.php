<?php
/**
* [[!pagesLink? &url=`[[*uri]]` &limit=`10` &active=`1`]]
* &active - принимает 0|1, делает ссылку активной (для совпадения с сортировкой товаров по умолчанию)
*/

$url = $modx->getOption('url', $scriptProperties, '');
$limit = $modx->getOption('limit', $scriptProperties, '');
$active = $modx->getOption('active', $scriptProperties, 0);
$class = '';

$caption = ($caption != '') ? $caption : $limit;

if ($_GET['limit'] == $limit){
  $active = 1;
}
if ($_GET['limit'] && $_GET['limit'] != $limit){
  $active = 0;
}

if ($active){
  $class.= ' active';
}

$output = '<a onclick="tmFilters.upd_sorting(this); return false;" data-limit="'.$limit.'" class="link_pages'.$class.'" href="'.$url.'?'.$q.'limit='.$limit.'"><span class="wrap_val">'.$caption.'</span></a>';

return $output;