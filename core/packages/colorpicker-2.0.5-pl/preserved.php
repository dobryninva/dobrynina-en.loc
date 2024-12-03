<?php return array (
  '1286f4c2faf04a6a8375f7f43a324963' => 
  array (
    'criteria' => 
    array (
      'name' => 'colorpicker',
    ),
    'object' => 
    array (
      'name' => 'colorpicker',
      'path' => '{core_path}components/colorpicker/',
      'assets_path' => '{assets_path}components/colorpicker/',
    ),
  ),
  '6575fd72448840d03987c6596a18d230' => 
  array (
    'criteria' => 
    array (
      'key' => 'colorpicker.debug',
    ),
    'object' => 
    array (
      'key' => 'colorpicker.debug',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'colorpicker',
      'area' => 'system',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '8ca268f553ecbf57d5ed675bb77fc65e' => 
  array (
    'criteria' => 
    array (
      'category' => 'ColorPicker',
    ),
    'object' => 
    array (
      'id' => 89,
      'parent' => 0,
      'category' => 'ColorPicker',
      'rank' => 0,
    ),
  ),
  'fe78d6660abdded1a69f5193bd910eb6' => 
  array (
    'criteria' => 
    array (
      'name' => 'ColorPicker',
    ),
    'object' => 
    array (
      'id' => 45,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'ColorPicker',
      'description' => 'ColorPicker runtime hooks - registers custom TV input & output types and includes javascripts on document edit pages.',
      'editor_type' => 0,
      'category' => 89,
      'cache_type' => 0,
      'plugincode' => '/**
 * ColorPicker Runtime Hooks
 *
 * @package colorpicker
 * @subpackage plugin
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$className = \'TreehillStudio\\ColorPicker\\Plugins\\Events\\\\\' . $modx->event->name;

$corePath = $modx->getOption(\'colorpicker.core_path\', null, $modx->getOption(\'core_path\') . \'components/colorpicker/\');
/** @var ColorPicker $colorpicker */
$colorpicker = $modx->getService(\'colorpicker\', \'ColorPicker\', $corePath . \'model/colorpicker/\', [
    \'core_path\' => $corePath
]);

if ($colorpicker) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. \' could not be initialized!\', \'\', \'ColorPicker Plugin\');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. \' was not found!\', \'\', \'ColorPicker Plugin\');
    }
}

return;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * ColorPicker Runtime Hooks
 *
 * @package colorpicker
 * @subpackage plugin
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$className = \'TreehillStudio\\ColorPicker\\Plugins\\Events\\\\\' . $modx->event->name;

$corePath = $modx->getOption(\'colorpicker.core_path\', null, $modx->getOption(\'core_path\') . \'components/colorpicker/\');
/** @var ColorPicker $colorpicker */
$colorpicker = $modx->getService(\'colorpicker\', \'ColorPicker\', $corePath . \'model/colorpicker/\', [
    \'core_path\' => $corePath
]);

if ($colorpicker) {
    if (class_exists($className)) {
        $handler = new $className($modx, $scriptProperties);
        if (get_class($handler) == $className) {
            $handler->run();
        } else {
            $modx->log(xPDO::LOG_LEVEL_ERROR, $className. \' could not be initialized!\', \'\', \'ColorPicker Plugin\');
        }
    } else {
        $modx->log(xPDO::LOG_LEVEL_ERROR, $className. \' was not found!\', \'\', \'ColorPicker Plugin\');
    }
}

return;',
    ),
  ),
  '6377add1afc49fbda294dd2ee2f01074' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 45,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 45,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'fc91685a560b19d0f6fd7626227bd1d0' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'f67cc9788808b5db89a727d2de748cc1' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'a0e18c647c5a2e56021adf58e05b97f5' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVOutputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVOutputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'eb9b3086d2e66aebfcb14f4838a5bb8c' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVOutputRenderPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 45,
      'event' => 'OnTVOutputRenderPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);