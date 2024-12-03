<?php
/**
* linked
*
* @version v.1.1
*
* @example
* {'linked' | snippet : ['tv_id'=>7]}
* {'linked' | snippet : ['tv_ids'=>'7,8,9']}
*
* @var string $res_id - id ресурса, обязательное, по умолчанию текущий ресурс
* @var string $tv_id - id ТВшки, одно из обязательных
* @var string $tv_ids - список id ТВшек через запятую, одно из обязательных (полезно для однотипных ТВшек, значения которых не пересекаются)
*
* @return array возвращает $output, в котором список id'шек через запятую.
* Для ресурса ($res_id), который БЫЛ ВЫБРАН в качестве одного из значений ТВшки ($tv_id) в других ресурсах вернутся id'ШКИ РЕСУРСОВ где он БЫЛ ВЫБРАН
* Для ресурса в котором была заполнена ТВшка вернутся выбранные значения
*/

$output = '';
$values_arr = $result_arr = $tv_ids_arr = $tmp_rows = [];
$res_id = $modx->getOption('res_id', $scriptProperties, $modx->resource->id);
$tv_id = $modx->getOption('tv_id', $scriptProperties, '');
$tv_ids = $modx->getOption('tv_ids', $scriptProperties, '');
if (!$tv_id && !$tv_ids) return false;
$funs = $modx->getService('funs', 'functions', MODX_BASE_PATH.'artmebius/snippets/model/');

$cache_dir = 'artmebius/linked/'.$res_id;
if ($tv_id) {
  $cache_key = $res_id.'-'.$tv_id;
} elseif ($tv_ids) {
  $tv_ids_arr = array_map('trim', explode(',', $tv_ids));
  $cache_key = $res_id . '-' . implode('-', $tv_ids_arr);
}
$cache_options = array(xPDO::OPT_CACHE_KEY => $cache_dir, xPDO::OPT_CACHE_EXPIRES => 0);
$cache_path = MODX_CORE_PATH.'cache/'.$cache_dir.'/'.$cache_key.'.cache.php';

$cache_check = file_exists($cache_path);
if (!$cache_check || !$modx->getOption('cache_resource')){

  if ($tv_id) {
    $where = ['tmplvarid' => $tv_id];
  } elseif ($tv_ids) {
    $where = ['tmplvarid:IN' => $tv_ids_arr];
  }
  // $rows = $funs->db_select_all('modTemplateVarResource', 'contentid, value', $where, 'pair'); // nw w tv_ids
  $rows = $funs->db_select_all('modTemplateVarResource', 'contentid, value', $where);
  if (!$rows) return false;
  foreach ($rows as $r => $row) {
    $tmp_rows[$row['contentid']][] = $row['value'];
  }
  foreach ($tmp_rows as $contentid => $values) {
    $values_arr = explode('||', implode('||', $values));
    if ($res_id == $contentid) {
      $result_arr = $values_arr;
      break;
    } elseif (in_array($res_id, $values_arr)) { //  && !in_array($contentid, $result_arr) ???
      $result_arr[] = $contentid;
    }
  }
  $output = implode(',', $result_arr);

  $modx->cacheManager->set($cache_key, $output, 0, $cache_options);
} else {
  $output = $modx->cacheManager->get($cache_key, $cache_options);
}

return $output;