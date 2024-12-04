<?php  return '
$funs = $modx->getService(\'funs\', \'functions\', MODX_BASE_PATH.\'artmebius/snippets/model/\');

// указываем шаблоны в которых используется сниппет, в формате: \'название_сниппета\' => [массив id шаблонов];
$config = [
  // \'print_price_table\' => [25, 26],
  // \'linked\' => [25, 26],
  // \'print_selects_services\' => [25, 26]
];

// указываем id и/или шаблоны ресурсов, из которых сниппет собирает данные, в формате: \'название_сниппета\' => [\'ids\' => [массив id ресурсов], \'tpls\' => [массив id шаблонов]];
$config_related = [
  // \'print_price_table\' => [
  //   \'ids\' => [1]
  // ],
  // \'linked\' => [
  //   \'tpls\' => [29]
  // ],
  // \'print_selects_services\' => [
  //   \'tpls\' => [29]
  // ],
];

$eventName = $modx->event->name;
switch($eventName) {

  case \'OnDocFormSave\':
    if (!empty($config)) {
      foreach ($config as $snippet => $tpls) {
        if (in_array($resource->template, $tpls)) {
          // $path = MODX_CORE_PATH.\'cache/artmebius/\'.$snippet.\'/\'.$id.\'.cache.php\';
          // if (file_exists($path)) {
          //   unlink($path);
          // }
          $path = MODX_CORE_PATH.\'cache/artmebius/\'.$snippet.\'/\'.$id.\'/\';
          if (is_dir($path)) {
            $funs->clear_dir($path);
          }
        }
      }
    }

    if (!empty($config_related)) {
      foreach ($config_related as $snippet => $options) {
        foreach ($options as $type => $values) {

          switch ($type) {
            case \'ids\':
              if (in_array($id, $values)) {
                $path = MODX_CORE_PATH.\'cache/artmebius/\'.$snippet.\'/\';
                if (is_dir($path)) {
                  $funs->clear_dir($path);
                }
              }
              break;

            case \'tpls\':
              if (in_array($resource->template, $values)) {
                $path = MODX_CORE_PATH.\'cache/artmebius/\'.$snippet.\'/\';
                if (is_dir($path)) {
                  $funs->clear_dir($path);
                }
              }
              break;
          }
        }
      }
    }
  break;

  case \'OnSiteRefresh\':
    $path = MODX_CORE_PATH.\'cache/artmebius/\';
    if (is_dir($path)) {
      $funs->clear_dir($path);
    }
    break;
}
return;
';