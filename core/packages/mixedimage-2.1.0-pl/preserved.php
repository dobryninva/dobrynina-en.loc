<?php return array (
  '4b02654a49e6f5b932b8bae1d102f365' => 
  array (
    'criteria' => 
    array (
      'name' => 'mixedimage',
    ),
    'object' => 
    array (
      'name' => 'mixedimage',
      'path' => '{core_path}components/mixedimage/',
      'assets_path' => '',
    ),
  ),
  '2d107fcddff426dbed2624e8fdb6d98d' => 
  array (
    'criteria' => 
    array (
      'name' => 'mixedImage',
    ),
    'object' => 
    array (
      'id' => 48,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'mixedImage',
      'description' => 'mixedImage 2.0.9-beta plugin for MODx Revolution',
      'editor_type' => 0,
      'category' => 0,
      'cache_type' => 0,
      'plugincode' => '$corePath = $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/mixedimage/\';
$assetsUrl = $modx->getOption(\'assets_url\',null,MODX_ASSETS_URL).\'components/mixedimage/\';

$modx->lexicon->load(\'mixedimage:default\');

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tv/input/\');
        break;
    case \'OnTVOutputRenderList\':
        $modx->event->output($corePath.\'elements/tv/output/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/input/options/\');
        break;
    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/properties/\');
        break;
    case \'OnDocFormPrerender\':
    case \'OnManagerPageBeforeRender\':
        $modx->regClientStartupScript($assetsUrl.\'js/mgr/mixedimage.js\');
        $modx->regClientCSS($assetsUrl.\'css/mgr/mixedimage.css\');
        $modx->controller->addLexiconTopic(\'mixedimage:default\');
        break;
    case \'OnMODXInit\':
    case \'OnLoadWebDocument\':
        $mTypes = $modx->getOption(\'manipulatable_url_tv_output_types\',null,\'image,file\').\',mixedimage\';
        $modx->setOption(\'manipulatable_url_tv_output_types\', $mTypes);
        break;
}',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '$corePath = $modx->getOption(\'core_path\',null,MODX_CORE_PATH).\'components/mixedimage/\';
$assetsUrl = $modx->getOption(\'assets_url\',null,MODX_ASSETS_URL).\'components/mixedimage/\';

$modx->lexicon->load(\'mixedimage:default\');

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath.\'elements/tv/input/\');
        break;
    case \'OnTVOutputRenderList\':
        $modx->event->output($corePath.\'elements/tv/output/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/input/options/\');
        break;
    case \'OnTVOutputRenderPropertiesList\':
        $modx->event->output($corePath.\'elements/tv/properties/\');
        break;
    case \'OnDocFormPrerender\':
    case \'OnManagerPageBeforeRender\':
        $modx->regClientStartupScript($assetsUrl.\'js/mgr/mixedimage.js\');
        $modx->regClientCSS($assetsUrl.\'css/mgr/mixedimage.css\');
        $modx->controller->addLexiconTopic(\'mixedimage:default\');
        break;
    case \'OnMODXInit\':
    case \'OnLoadWebDocument\':
        $mTypes = $modx->getOption(\'manipulatable_url_tv_output_types\',null,\'image,file\').\',mixedimage\';
        $modx->setOption(\'manipulatable_url_tv_output_types\', $mTypes);
        break;
}',
    ),
  ),
  'b067c97d25cc07ca1101d62dd4acfedb' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '68b1b7fd1ac48d18365fa6e5cdfb7f2f' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '1b88ae2cdb52edd2ee856ebfd3c5e58b' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '02bbcaa2bd7306ea8c44b0b99859991f' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVOutputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVOutputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '940263cf072538c3f8fdca512665c421' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVOutputRenderPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnTVOutputRenderPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '3f2a2c49b20d3dc192e66f9f347767b5' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnMODXInit',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnMODXInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'cc656069ba7ca2b5e869c1407d32f33d' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnLoadWebDocument',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnLoadWebDocument',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '6471827a4258b1897a9c82acab95de0a' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 48,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 48,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '379138aaa6f49cb02bd6e5b8dcd4b42a' => 
  array (
    'criteria' => 
    array (
      'key' => 'mixedimage.translit',
    ),
    'object' => 
    array (
      'key' => 'mixedimage.translit',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'mixedimage',
      'area' => 'Default',
      'editedon' => '2020-10-27 16:46:55',
    ),
  ),
  '7054bb51e02c4b0852336ed0a17eb3f3' => 
  array (
    'criteria' => 
    array (
      'key' => 'mixedimage.check_resid',
    ),
    'object' => 
    array (
      'key' => 'mixedimage.check_resid',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'mixedimage',
      'area' => 'Default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'd4eb8fee93ba044478ca70b8816a9f2c' => 
  array (
    'criteria' => 
    array (
      'key' => 'mixedimage.random_lenght',
    ),
    'object' => 
    array (
      'key' => 'mixedimage.random_lenght',
      'value' => '6',
      'xtype' => 'textfield',
      'namespace' => 'mixedimage',
      'area' => 'Default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
);