<?php
/* prds_tp_field
*
*/
if (!function_exists('dd')){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
  }
}
if (!function_exists('mb_ucfirst')){
  function mb_ucfirst($text) {
    return mb_strtoupper(mb_substr($text, 0, 1)) . mb_substr($text, 1);
  }
}

$have_field = 0;
$have_value = 0;
$field_title = '';
$field_value = '';
// $img_params = '&w='.$preview_width.'&h='.$preview_height.'&zc='.$preview_zc.'&far=1';
$arFields = $arResult = $arKeys = array();

if (empty($field)) return;
$field = mb_strtolower($field);

if (is_array($arTp) && count($arTp) > 0) {

  foreach ($arTp as $k => $tp) {

    if (mb_strtolower($tp['vybor1']) == $field) {
      $field_title = 'vybor1';
      $field_value = 'value1';
      $have_field = 1;
    } elseif (mb_strtolower($tp['vybor2']) == $field) {
      $field_title = 'vybor2';
      $field_value = 'value2';
      $have_field = 1;
    } else {
      $have_field = 0;
    }

    if ($have_field) {

      if (!empty($tp[$field_value])) {
        $alias = $modx->filterPathSegment(mb_strtolower($tp[$field_value]));
        $arFields[$alias][$tp['MIGX_id']]['value'] = mb_ucfirst(mb_strtolower($tp[$field_value]));
        // $arFields[$alias][$tp['MIGX_id']]['price'] = $tp['price'];
        $arFields[$alias][$tp['MIGX_id']]['price'] = $modx->runSnippet('num_format', array('input'=>$tp['price']));
        // $arFields[$alias][$tp['MIGX_id']]['old_price'] = $tp['old_price'];
        $arFields[$alias][$tp['MIGX_id']]['old_price'] = $modx->runSnippet('num_format', array('input'=>$tp['old_price']));
        $arFields[$alias][$tp['MIGX_id']]['ean'] = $tp['ean'];
        if (!empty($tp['image'])) {
          $arFields[$alias][$tp['MIGX_id']]['image'] = '/images/'.$tp['image'];
          $arFields[$alias][$tp['MIGX_id']]['image_thumb'] = $modx->runSnippet('phpthumbon', array('input'=>'/images/'.$tp['image'], 'options'=>$img_params));
        } else {
          $arFields[$alias][$tp['MIGX_id']]['image'] = '';
          $arFields[$alias][$tp['MIGX_id']]['image_thumb'] = '';
        }
      }

    }

  } // end foreach ($arTp as $k => $tp)

  if (count($arFields) > 0) {

    foreach ($arFields as $k => $arField) {
      if (count($arField) > 1) {
        $minPrice = 0;
        $minId = 0;
        foreach ($arField as $i => $field_row) { // valensiya
          if ($field_row['price'] < $minPrice || $minPrice == 0) {
            $minPrice = $field_row['price'];
            $minId = $i;
          }
        }
        $arResult[$k] = $arField[$minId];
        // можем заполнить пустые значения из остальных тп
        foreach ($arField as $i => $field_row) {
          if (empty($arResult[$k]['image']) && !empty($field_row['image'])) {
            $arResult[$k]['image'] = $field_row['image'];
            $arResult[$k]['image_thumb'] = $field_row['image_thumb'];
          }
        }
      } else {
        // $arResult[$k] = $arField[array_key_first($arField)]; // php 7.3.0+
        $arKeys = array_keys($arField);
        $arResult[$k] = $arField[$arKeys[0]];
      }
    } // end foreach ($arFields as $k => $arField)

  }

  // return $arFields;
  return $arResult;

} else return;