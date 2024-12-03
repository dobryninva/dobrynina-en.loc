<?php
/**
* [[!sortLink? &url=`[[*uri]]` &field=`pagetitle` &caption=`по названию` &dir=`asc` &active=`1`]]
* &dir - принимает asc|desc
* &active - принимает 0|1, делает ссылку активной (для совпадения с сортировкой товаров по умолчанию)
*/

$url = $modx->getOption('url', $scriptProperties, '');
$field = $modx->getOption('field', $scriptProperties, '');
$caption = $modx->getOption('caption', $scriptProperties, '');
$dir = $modx->getOption('dir', $scriptProperties, 'asc');
$active = $modx->getOption('active', $scriptProperties, 0);
$class = '';

if ($_GET['sortby'] == $field){
  $active = 1;
}
if ($_GET['sortby'] && $_GET['sortby'] != $field){
  $active = 0;
}
if ($_GET['sortdir']){
  $dir = $_GET['sortdir'];
}

if ($active){
  $class.= ' active';
  $new_dir = ($dir == 'asc') ? 'desc' : 'asc';
} else {
  $new_dir = $dir;
}
  $fa_sfx = ($dir == 'asc') ? 'asc' : 'desc'; // change if needed 'down' : 'up' or etc.
  $fa_dir = 'fa-sort-amount-'.$dir;
  $output = '<a class="link_sort'.$class.'" onclick="tmFilters.upd_sorting(this); return false;" data-sortby="'.$field.'" data-sortdir="'.$new_dir.'" href="'.$url.'?'.$q.'sortby='.$field.'&sortdir='.$new_dir.'"><span class="wrap_val">'.$caption.'</span> <span class="fa '.$fa_dir.'"></span></a>';

return $output;