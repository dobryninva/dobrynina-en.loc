<?php
if ($modx->context->get('key') == 'mgr') {
    return;
}

if (!function_exists("rrmdir")) {
  function rrmdir($dir) {
    if (is_dir($dir)) {
      $objects = scandir($dir);
      foreach ($objects as $object) {
        if ($object != "." && $object != "..") {
          if (filetype($dir . "/" . $object) == "dir") {
            rrmdir($dir . "/" . $object);
          } else {
            unlink($dir . "/" . $object);
          }
        }
      }
      reset($objects);
      rmdir($dir);
    }
  }
}

switch ($modx->event->name) {
  // case 'OnWebPagePrerender':
  case 'OnMODXInit':
    // print '<pre>';
    // print_r($modx);
    // print '</pre>';

    $template = $_REQUEST['template'];
    $color = $_REQUEST['color'];
    if (!empty($template)){

      $cm = $modx->getCacheManager();
      $cacheDir = $cm->getCachePath();
      $cacheDir = rtrim($cacheDir, '/\\');
      $files = scandir($cacheDir);

      foreach ($files as $file) {
        if ($file == '.' || $file == '..') {
          continue;
        }
        if (is_dir($cacheDir . '/' . $file)) {
          if ($file == 'logs') {
            continue;
          }
          rrmdir($cacheDir . '/' . $file);
        } else {
          unlink($cacheDir . '/' . $file);
        }
      }

      $modx->setOption('site_template',$template);

      $q = $modx->newQuery('modSystemSetting');
      $q->command('update');
      $q->set(array(
        'value' => $template
      ));
      $q->where(array(
        'key' => 'site_template'
      ));
      $q->prepare();
      // $stroka =  $q->toSQL(). "\n\n";
      $q->stmt->execute();


      $modx->setOption('site_color',$color);

      $q = $modx->newQuery('modSystemSetting');
      $q->command('update');
      $q->set(array(
        'value' => $color
      ));
      $q->where(array(
        'key' => 'site_color'
      ));
      $q->prepare();
      // $stroka =  $q->toSQL(). "\n\n";
      $q->stmt->execute();

      // $stroka = print_r($template, true) . "\n\n";
      // $artm_log = MODX_BASE_PATH . 'assets/temp.log';
      // file_put_contents($artm_log, $stroka, FILE_APPEND | LOCK_EX);
      // exit;

    }

  break;
}