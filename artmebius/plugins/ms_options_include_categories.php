<?php
$eventName = $modx->event->name;
switch($eventName) {
  case "OnDocFormSave":

    if ($resource->template == 9) {

      if (!function_exists('db_insert')){
        function db_insert($modx, $table, $data){
          $keys = array_keys($data);
          $fields = '`' . implode('`,`', $keys) . '`';
          $placeholders = substr(str_repeat('?,', count($keys)), 0, -1);
          $sql = "INSERT INTO {$table} ({$fields}) VALUES ({$placeholders});";
          $stmt = $modx->prepare($sql);
          if (!$stmt->execute(array_values($data))) {
            $modx->log(1, print_r($stmt->errorInfo(), true) . ' SQL: ' . $sql);
          }
        }
      }

      $cat_id = $resource->id;
      $db_prefix = $modx->config['table_prefix'];
      $db_table = $db_prefix.'ms2_category_options';
      $ms_options_arr = $ms_options_ids_arr = $ms_options_ids_included_arr = $ms_options_ids_not_included_arr = array();

      // получаем список опций, из конфигуратора
      $ms_options_str = $modx->getOption('ms_options_include_categories');
      if ($ms_options_str) {
        $ms_options_arr = array_map('trim', explode(',', $ms_options_str));
      }
      if (!$ms_options_arr) return;

      // получаем id опций, которые хотим включить
      $q = $modx->newQuery('msOption');
      $q->select(array('id'));
      $q->where(array(
        'key:IN' => $ms_options_arr,
      ));
      $q->prepare();
      if($q->stmt && $q->stmt->execute()){
        $ms_options_ids_arr = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
      }
      if (!$ms_options_ids_arr) return;

      // получаем id опций, которые уже включены
      $q = $modx->newQuery('msCategoryOption');
      $q->select(array('option_id'));
      $q->where(array(
        'category_id' => $cat_id
      ));
      $q->prepare();
      if($q->stmt && $q->stmt->execute()){
        $ms_options_ids_included_arr = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
      }

      // получаем id опций, которые хотим включить и они не включены
      $ms_options_ids_not_included_arr = array_diff($ms_options_ids_arr, $ms_options_ids_included_arr);

      if (count($ms_options_ids_not_included_arr)) {
        foreach ($ms_options_ids_not_included_arr as $o => $option_id) {
          $data_arr = array('option_id' => $option_id, 'category_id' => $cat_id, 'rank' => 0, 'active' => 1, 'required' => 0, 'value' => '');
          db_insert($modx, $db_table, $data_arr);
        }
      }

    }

    break;
}