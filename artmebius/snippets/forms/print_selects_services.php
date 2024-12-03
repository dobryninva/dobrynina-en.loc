<?php
/**
* print_selects_services
*
* @version v.1.0
*
* @example
* {'print_selects_services' | snippet : ['res_id'=>7]}
*
* @var string $res_id - id ресурса, относительно которого рисуем селекты услуг и/или специалистов, обязательное
*
* @return string возвращает $output, в котором селекты услуг и/или специалистов, в зависимости от уровня вложенности ресурса
*/

$output = '';
$res_id = $modx->getOption('res_id', $scriptProperties, $modx->resource->id);
$funs = $modx->getService('funs', 'functions', MODX_BASE_PATH.'artmebius/snippets/model/');

$cache_dir = 'artmebius/print_selects_services/'.$res_id;
$cache_key = $res_id;
$cache_options = array(xPDO::OPT_CACHE_KEY => $cache_dir, xPDO::OPT_CACHE_EXPIRES => 0);
$cache_path = MODX_CORE_PATH.'cache/'.$cache_dir.'/'.$cache_key.'.cache.php';

$cache_check = file_exists($cache_path);
if (!$cache_check || !$modx->getOption('cache_resource')){

  $pids = $modx->getParentIds($res_id, 10, array('context' => 'web'));
  $pids = array_reverse($pids);
  $kids = $funs->db_select_all('modResource', 'id, pagetitle, menutitle, template', ['parent' => $res_id]);

  $tpl_option = '@INLINE <option value="{$id}">{$menutitle ?: $pagetitle}</option>';

  $tpl_select = '@INLINE <div class="col_form_section col_dynamic col-md-3">
    <div class="form-group">
      <select class="sof_{$name} form-control form-control-lg" id="sof_{$name}_{$id}" name="sof_{$name}" {$disabled}>
        {$options}
      </select>
    </div>
  </div>';
  //<label class="form-label" for="sof_{$name}_{$id}">{$label}:</label>

  $select_id = 0;

  // parents
  if (count($pids)) {
    foreach ($pids as $lev => $pid) {
      if ($pid == 0) continue;
      $select_id = $lev;
      $select_disabled = 'disabled';
      $parent = $funs->db_select('modResource', 'id, pagetitle, menutitle', ['id' => $pid]);
      $option = $funs->pdoTools->getChunk($tpl_option, ['id' => $parent['id'], 'pagetitle' => $parent['pagetitle'], 'menutitle' => $parent['menutitle']]);
      if ($lev == 1) {
        $select_name = 'section';
        $select_label = 'Раздел';
      } elseif ($lev >= 2) {
        $select_name = ($parent['template'] == 25) ? 'category' : 'service';
        $select_label = ($parent['template'] == 25) ? 'Категория' : (($lev >= 3) ? $parent['pagetitle'] : 'Услуга');
      }
      $output .= $funs->pdoTools->getChunk($tpl_select, [
        'id'       => $select_id,
        'name'     => $select_name,
        'label'    => $select_label,
        'disabled' => $select_disabled,
        'options'  => $option
      ]);
    }
  }

  // current
  ++$select_id;
  $option = $funs->pdoTools->getChunk($tpl_option, ['id' => $res_id, 'pagetitle' => $modx->resource->pagetitle, 'menutitle' => $modx->resource->menutitle]);
  $select_name = ($modx->resource->template == 25) ? 'category' : 'service';
  $select_label = ($select_id >= 3) ? ($modx->resource->menutitle ?: $modx->resource->pagetitle) : 'Услуга';
  $select_disabled = 'disabled';
  $output .= $funs->pdoTools->getChunk($tpl_select, [
    'id'       => $select_id,
    'name'     => $select_name,
    'label'    => $select_label,
    'disabled' => $select_disabled,
    'options'  => $option
  ]);

  // kids
  ++$select_id;
  if (count($kids)) {
    $options = '<option value="">Выберите услугу</option>';
    foreach ($kids as $k => $kid) {
      $options .= $funs->pdoTools->getChunk($tpl_option, ['id' => $kid['id'], 'pagetitle' => $kid['pagetitle'], 'menutitle' => $kid['menutitle']]);
    }
    $select_name = 'service'; // tt template ???
    $select_label = ($select_id >= 3) ? ($modx->resource->menutitle ?: $modx->resource->pagetitle) : 'Услуга';
  } else {
    $services_specialists_ids = $modx->runSnippet('linked', ['res_id' => $res_id, 'tv_ids' => '119, 120, 121, 122, 123']);
    $services_specialists_arr = $funs->db_select_all('modResource', 'id, pagetitle', ['id:IN' => explode(',', $services_specialists_ids)]);
    $options = '<option value="">Выберите специалиста</option>';
    foreach ($services_specialists_arr as $key => $placeholders) {
      $options .= $funs->pdoTools->getChunk($tpl_option, $placeholders);
    }
    $select_name = 'specialist';
    $select_label = 'Специалист';
  }
  $select_disabled = '';
  $output .= $funs->pdoTools->getChunk($tpl_select, [
    'id'       => $select_id,
    'name'     => $select_name,
    'label'    => $select_label,
    'disabled' => $select_disabled,
    'options'  => $options
  ]);

  $modx->cacheManager->set($cache_key, $output, 0, $cache_options);
} else {
  $output = $modx->cacheManager->get($cache_key, $cache_options);
}

return $output;