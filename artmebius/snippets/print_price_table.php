<?php
/**
* print_price_table
*
* @version v.1.0
*
* @example
* {'print_price_table' | snippet}
*
* @var string $tpl_row - чанк строки "таблицы", необязательные
* @var string $tpl_wrapper - чанк обёртка "таблицы", необязательные
*
* @return string возвращает $output, в котором таблицы, получившиеся из выбора отдельных строк общей таблицы прайс-листа (Главная->Услуги->Таблицы цен)
*/

$output = '';
$result = array();

$pdoTools = $modx->getService('pdoTools');
$funs = $modx->getService('funs', 'functions', MODX_BASE_PATH.'artmebius/snippets/model/');
$show_table_name = $modx->getOption('show_table_name', $scriptProperties, 1);

$doc_id = $modx->resource->id;
$cache_dir = 'artmebius/print_price_table/'.$doc_id;
$cache_key = $doc_id;
$cache_options = array(xPDO::OPT_CACHE_KEY => $cache_dir, xPDO::OPT_CACHE_EXPIRES => 0);
$cache_path = MODX_CORE_PATH.'cache/'.$cache_dir.'/'.$cache_key.'.cache.php';

$cache_check = file_exists($cache_path);
if (!$cache_check || !$modx->getOption('cache_resource')){

  $selected = $modx->resource->getTVValue('price_list_custom');
  if (empty($selected)) {
    return false;
  } else {
    $selected_arr = array_map('trim', explode('||', $selected));
    $selected_groups = array();
    foreach ($selected_arr as $value) {
      $tmp = array_map('trim', explode('-', $value));
      $selected_groups[$tmp[0]][] = $tmp[1];
    }
  }

  $price_tables = $funs->db_select('modTemplateVarResource', 'value', array('contentid' => 1, 'tmplvarid' => 117), 'column'); // 117 - price_tables
  if (empty($price_tables)) {
    return false;
  } else {
    $price_tables_arr = array_column(json_decode($price_tables, true), null, 'MIGX_id');
    foreach ($price_tables_arr as $table_id => $table) {
      $tmp_table = array_column(json_decode($table['table'], true), null, 'MIGX_id');
      $price_tables_arr[$table_id]['table'] = $tmp_table;
    }
  }

  foreach ($selected_groups as $table_id => $rows) {
    $result[$table_id]['table_name'] = $price_tables_arr[$table_id]['table_title'];
    foreach ($rows as $row_id) {
      $result[$table_id]['table_rows'][$row_id]['title'] = $price_tables_arr[$table_id]['table'][$row_id]['title'];
      $result[$table_id]['table_rows'][$row_id]['price'] = $price_tables_arr[$table_id]['table'][$row_id]['price'];
    }
  }

  if (empty($tpl_row)) {
    $tpl_row = '@INLINE <tr><td class="td-title">{$title}</td><td class="td-price">{if $price}{$price | num_format} руб.{/if}</td></tr>';
  }
  if (empty($tpl_wrapper)) {
    $tpl_wrapper = '@INLINE <table class="table">{if $show_table_name}<tr><th colspan="2" class="tac">{$table_name}</th></tr>{/if}<tr><th>Наименование услуги</th><th>Цена</th></tr>{$table_rows}</table>';
  }

  foreach ($result as $table_id => $table) {
    $output_row = '';
    foreach ($table['table_rows'] as $row) {
      $output_row .= $pdoTools->getChunk($tpl_row, $row);
    }
    $output .= $pdoTools->getChunk($tpl_wrapper, array('table_name' => $table['table_name'], 'table_rows' => $output_row, 'show_table_name' => $show_table_name));
  }

  $modx->cacheManager->set($cache_key, $output, 0, $cache_options);

} else {

  $output = $modx->cacheManager->get($cache_key, $cache_options);
}

return $output;