<?php
/**
* get_resources_data
*
* @version v.1.0b
*
* @example
* {set $data_arr = 'get_resources_data' | snippet : ['json'=>$tv_json, 'tvs_arr' => ['tv1_id' => 'tv1_name', 'tv2_id' => 'tv2_name']]}
*
* @var string $json - json строка, в которой содержится список ресурсов, т.е. имеется поле с id, обязательное
* @var arrat $tvs_arr - массив ТВшек, значения которых мы хоти получить, в формате 'tv_id'=>'tv_name', необязательные
* @var string $id_field - название поля, в котором содержится id ресурсов в json, по-умолчанию - link
*
* @return array возвращает $output - массив с данными ресурсов из json, включая поля ресурса, значения ТВ, поля товара минишопа, картинки минишопа
*/

$output = '';
$result = $errors = array();
$data_json = $modx->getOption('json', $scriptProperties, '');
$tvs_arr = $modx->getOption('tvs_arr', $scriptProperties, '');
$id_field = $modx->getOption('id_field', $scriptProperties, 'link');

if (empty($data_json)) return;

$pdoTools = $modx->getService('pdoTools');

// $miniShop2 = $modx->getService('miniShop2');
// $miniShop2->initialize($modx->context->key);

$funs = $modx->getService('funs', 'functions', MODX_BASE_PATH.'artmebius/snippets/model/');

$data_arr = json_decode($data_json, true);
$data_ids = [];
foreach ($data_arr as $key => $data) {
  if (isset($data[$id_field]) && !empty($data[$id_field])) $data_ids[] = $data[$id_field];
}

// if (!empty($tvs)) {
//   $tvs_arr = array_map('trim', explode(',', $tvs));
// }

if (!empty($data_ids)) {

  $q = $modx->newQuery('modResource');
  $q->setClassAlias('resource');
  // $q->leftJoin('msProductData','product','resource.id = product.id');
  // $q->leftJoin('msProductFile','image', array('resource.id = image.product_id', 'image.parent = 0'));
  $select = [
    'resource.id',
    'resource.pagetitle',
    // 'product.price',
    // 'product.old_price',
    // 'image.url as image'
  ];
  if (!empty($tvs_arr)) {
    foreach ($tvs_arr as $tv_id => $tv_name) {
      $q->leftJoin('modTemplateVarResource', $tv_name, array('resource.id = '.$tv_name.'.contentid', $tv_name.'.tmplvarid = '.$tv_id));
      $select[] = $tv_name.'.value as '.$tv_name.'_value';
    }
  }
  // $q->leftJoin('modTemplateVarResource', 'image_in_main_slider', array('resource.id = image_in_main_slider.contentid', 'image_in_main_slider.tmplvarid = 121'));
  // $q->leftJoin('modTemplateVarResource', 'bg_color_in_main_slider', array('resource.id = bg_color_in_main_slider.contentid', 'bg_color_in_main_slider.tmplvarid = 120'));
  $q->select($select);
  $q->where(array(
    'resource.id:IN' => $data_ids
  ));
  $q->sortby('id', 'DESC');
  $q->prepare();
  // $sql = $q->toSQL();
  // print $sql;
  if($q->stmt && $q->stmt->execute()){
    $data_raws = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
    $q->stmt->closeCursor();
  }
}

if (!empty($data_raws)) {
  $output = $funs->set_arr_key($data_raws, 'id');
}
// dd($output);

// $doc_id = $modx->resource->id;
// $cache_dir = 'artmebius/slider_main';
// $cache_options = array(xPDO::OPT_CACHE_KEY => $cache_dir, xPDO::OPT_CACHE_EXPIRES => 0);
// $cache_path = MODX_CORE_PATH.'cache/'.$cache_dir.'/'.$doc_id.'.cache.php';
// $cache_check = file_exists($cache_path);
// if (!$cache_check){

  //   if($toPlaceholder){
  //     $modx->setPlaceholder($toPlaceholder, $output);
  //     $output = '';
  //   }

  // } // empty($errors)

  // if (!empty($errors)) {
  //   if (empty($tpl_errors)) {
  //     $tpl_errors = '@INLINE <div class="alert alert-danger" role="alert">{$error}</div>';
  //   }
  //   foreach ($errors as $e => $error) {
  //     $output .= $pdoTools->getChunk($tpl_errors, array('error' => $error));
  //   }
  // }

//   $modx->cacheManager->set($doc_id, $output, 0, $cache_options);
// } else {
//   $output = $modx->cacheManager->get($doc_id, $cache_options);
// }

return $output;