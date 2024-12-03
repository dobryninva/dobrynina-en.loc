<?php return array (
  '0b3dfdf901526c7c6268cafec2027efe' => 
  array (
    'criteria' => 
    array (
      'name' => 'moddevtools',
    ),
    'object' => 
    array (
      'name' => 'moddevtools',
      'path' => '{core_path}components/moddevtools/',
      'assets_path' => '{base_path}extras/modDevTools/assets/components/moddevtools/',
    ),
  ),
  'c4bba538f41907b08d5b82f024925539' => 
  array (
    'criteria' => 
    array (
      'key' => 'moddevtools_virtual_chunks',
    ),
    'object' => 
    array (
      'key' => 'moddevtools_virtual_chunks',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'moddevtools',
      'area' => 'moddevtools_main',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '5327f4bb2e29baf1a0c4806313e3f2e3' => 
  array (
    'criteria' => 
    array (
      'key' => 'moddevtools_debug',
    ),
    'object' => 
    array (
      'key' => 'moddevtools_debug',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'moddevtools',
      'area' => 'moddevtools_main',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'c6407e7f11c7505a26902cb3a132bda8' => 
  array (
    'criteria' => 
    array (
      'namespace' => 'moddevtools',
      'controller' => 'index',
    ),
    'object' => 
    array (
      'id' => 6,
      'namespace' => 'moddevtools',
      'controller' => 'index',
      'haslayout' => 1,
      'lang_topics' => 'moddevtools:default',
      'assets' => '',
      'help_url' => '',
    ),
  ),
  '90890c141e166ba83ae4e38b24a308dc' => 
  array (
    'criteria' => 
    array (
      'text' => 'moddevtools',
    ),
    'object' => 
    array (
      'text' => 'moddevtools',
      'parent' => 'components',
      'action' => '6',
      'description' => 'moddevtools_menu_desc',
      'icon' => 'images/icons/plugin.gif',
      'menuindex' => 0,
      'params' => '',
      'handler' => '',
      'permissions' => 'view_chunk,view_template',
      'namespace' => 'core',
    ),
  ),
  '933ea435e1939a70c88c59781cfd82a4' => 
  array (
    'criteria' => 
    array (
      'category' => 'modDevTools',
    ),
    'object' => 
    array (
      'id' => 28,
      'parent' => 0,
      'category' => 'modDevTools',
      'rank' => 0,
    ),
  ),
  '28324e02a6d71c9141ff91a415a68fcd' => 
  array (
    'criteria' => 
    array (
      'name' => 'modDevTools',
    ),
    'object' => 
    array (
      'id' => 8,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'modDevTools',
      'description' => '',
      'editor_type' => 0,
      'category' => 28,
      'cache_type' => 0,
      'plugincode' => '/**
 * modDevTools
 *
 * Copyright 2014 by Vitaly Kireev <kireevvit@gmail.com>
 *
 * @package moddevtools
 *
 * @var modX $modx
 * @var int $id
 * @var string $mode
 */

/**
 * @var modx $modx
 */
$path = $modx->getOption(\'moddevtools_core_path\',null,$modx->getOption(\'core_path\').\'components/moddevtools/\').\'model/moddevtools/\';
/**
 * @var modDevTools $devTools
 */
$devTools = $modx->getService(\'devTools\',\'modDevTools\',$path);
$eventName = $modx->event->name;

switch($eventName) {
    case \'OnDocFormSave\':
        $devTools->debug(\'Start OnDocFormSave\');
        $devTools->parseContent($resource);
        break;
    case \'OnTempFormSave\':
        $devTools->debug(\'Start OnTempFormSave\');
        $devTools->parseContent($template);
        break;
    case \'OnTVFormSave\':

        break;
    case \'OnChunkFormSave\':
        $devTools->debug(\'Start OnChunkFormSave\');
        $devTools->parseContent($chunk);

        $parent = $modx->getOption(\'parent\', $_REQUEST);
        $link_type = $modx->getOption(\'link_type\', $_REQUEST);
        $devTools->parseParent($parent, $link_type);
        break;
    case \'OnSnipFormSave\':

        break;
    /* Add tabs */
    case \'OnDocFormPrerender\':
        if ($modx->event->name == \'OnDocFormPrerender\') {
            $devTools->getBreadCrumbs($scriptProperties);
            $devTools->showTemplate($scriptProperties);
            return;
        }
        break;

    case \'OnTempFormPrerender\':
        if ($mode == modSystemEvent::MODE_UPD) {
            $result = $devTools->outputTab(\'Template\');
        }
        break;

    case \'OnTVFormPrerender\':
        break;


    case \'OnChunkFormPrerender\':
        if ($mode == modSystemEvent::MODE_UPD) {
            $result = $devTools->outputTab(\'Chunk\');
        }
        break;

    case \'OnSnipFormPrerender\':
        if ($mode == modSystemEvent::MODE_UPD) {
            $result = $devTools->outputTab(\'Snippet\');
        }
        break;


}

if (isset($result) && $result === true)
    return;
elseif (isset($result)) {
    $modx->log(modX::LOG_LEVEL_ERROR,\'[modDevTools] An error occured. Event: \'.$eventName.\' - Error: \'.($result === false) ? \'undefined error\' : $result);
    return;
}',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/moddevtools/elements/plugins/plugin.moddevtools.php',
      'content' => '/**
 * modDevTools
 *
 * Copyright 2014 by Vitaly Kireev <kireevvit@gmail.com>
 *
 * @package moddevtools
 *
 * @var modX $modx
 * @var int $id
 * @var string $mode
 */

/**
 * @var modx $modx
 */
$path = $modx->getOption(\'moddevtools_core_path\',null,$modx->getOption(\'core_path\').\'components/moddevtools/\').\'model/moddevtools/\';
/**
 * @var modDevTools $devTools
 */
$devTools = $modx->getService(\'devTools\',\'modDevTools\',$path);
$eventName = $modx->event->name;

switch($eventName) {
    case \'OnDocFormSave\':
        $devTools->debug(\'Start OnDocFormSave\');
        $devTools->parseContent($resource);
        break;
    case \'OnTempFormSave\':
        $devTools->debug(\'Start OnTempFormSave\');
        $devTools->parseContent($template);
        break;
    case \'OnTVFormSave\':

        break;
    case \'OnChunkFormSave\':
        $devTools->debug(\'Start OnChunkFormSave\');
        $devTools->parseContent($chunk);

        $parent = $modx->getOption(\'parent\', $_REQUEST);
        $link_type = $modx->getOption(\'link_type\', $_REQUEST);
        $devTools->parseParent($parent, $link_type);
        break;
    case \'OnSnipFormSave\':

        break;
    /* Add tabs */
    case \'OnDocFormPrerender\':
        if ($modx->event->name == \'OnDocFormPrerender\') {
            $devTools->getBreadCrumbs($scriptProperties);
            $devTools->showTemplate($scriptProperties);
            return;
        }
        break;

    case \'OnTempFormPrerender\':
        if ($mode == modSystemEvent::MODE_UPD) {
            $result = $devTools->outputTab(\'Template\');
        }
        break;

    case \'OnTVFormPrerender\':
        break;


    case \'OnChunkFormPrerender\':
        if ($mode == modSystemEvent::MODE_UPD) {
            $result = $devTools->outputTab(\'Chunk\');
        }
        break;

    case \'OnSnipFormPrerender\':
        if ($mode == modSystemEvent::MODE_UPD) {
            $result = $devTools->outputTab(\'Snippet\');
        }
        break;


}

if (isset($result) && $result === true)
    return;
elseif (isset($result)) {
    $modx->log(modX::LOG_LEVEL_ERROR,\'[modDevTools] An error occured. Event: \'.$eventName.\' - Error: \'.($result === false) ? \'undefined error\' : $result);
    return;
}',
    ),
  ),
  '0f1cb3ecfd44b15fd0c3c98e2164c145' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 8,
      'event' => 'OnTempFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 8,
      'event' => 'OnTempFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '80dcf50ea6d7a4185adb99edf276c2b1' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 8,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 8,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'b098b19dc60fb33df0c50d09eef1a876' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 8,
      'event' => 'OnChunkFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 8,
      'event' => 'OnChunkFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '1a2e15134c39ed95a6c78c93386fde07' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 8,
      'event' => 'OnSnipFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 8,
      'event' => 'OnSnipFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'f76e3cb3c158b5c261748ff1f7c3c3a6' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 8,
      'event' => 'OnTempFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 8,
      'event' => 'OnTempFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '58cff1b167f734691cab075d715ed456' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 8,
      'event' => 'OnDocFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 8,
      'event' => 'OnDocFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'dccb80cc4e478e41dd1e8180b8030148' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 8,
      'event' => 'OnChunkFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 8,
      'event' => 'OnChunkFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);