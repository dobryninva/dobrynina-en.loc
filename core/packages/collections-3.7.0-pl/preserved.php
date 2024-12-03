<?php return array (
  '0708810684b0d8dfb4ca61dfcdabc601' => 
  array (
    'criteria' => 
    array (
      'name' => 'collections',
    ),
    'object' => 
    array (
      'name' => 'collections',
      'path' => '{core_path}components/collections/',
      'assets_path' => '{assets_path}components/collections/',
    ),
  ),
  'aad2a63500239d7790c75677c227edc1' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.mgr_date_format',
    ),
    'object' => 
    array (
      'key' => 'collections.mgr_date_format',
      'value' => 'M d',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '5a455e8670b070529ab1c7a573c90114' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.mgr_time_format',
    ),
    'object' => 
    array (
      'key' => 'collections.mgr_time_format',
      'value' => 'g:i a',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '3f6862afe49a827795e7b31be0a0c67c' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.mgr_datetime_format',
    ),
    'object' => 
    array (
      'key' => 'collections.mgr_datetime_format',
      'value' => 'M d, g:i a',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '232385fa305ae5cdc6a96fb3d2909c6a' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.user_js',
    ),
    'object' => 
    array (
      'key' => 'collections.user_js',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'a7c7cf0b23e424fa9585e48c0f6afa6e' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.user_css',
    ),
    'object' => 
    array (
      'key' => 'collections.user_css',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'be74cd2a752dc07bff6e1ac1b7c93406' => 
  array (
    'criteria' => 
    array (
      'key' => 'mgr_tree_icon_collectioncontainer',
    ),
    'object' => 
    array (
      'key' => 'mgr_tree_icon_collectioncontainer',
      'value' => 'collectioncontainer',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '6a3e80509677bdae76fdafc3091e6e26' => 
  array (
    'criteria' => 
    array (
      'key' => 'mgr_tree_icon_selectioncontainer',
    ),
    'object' => 
    array (
      'key' => 'mgr_tree_icon_selectioncontainer',
      'value' => 'selectioncontainer',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '8dbe2c3f67d75333fe279d9218ac68ec' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.renderer_image_path',
    ),
    'object' => 
    array (
      'key' => 'collections.renderer_image_path',
      'value' => 'images/',
      'xtype' => 'textfield',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '2016-03-15 10:23:34',
    ),
  ),
  '2ffc3c36ef3478886700dc3abb0cbb99' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.tree_tbar_collection',
    ),
    'object' => 
    array (
      'key' => 'collections.tree_tbar_collection',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '992bcbfd0667130e2eb5b535cc4dc940' => 
  array (
    'criteria' => 
    array (
      'key' => 'collections.tree_tbar_selection',
    ),
    'object' => 
    array (
      'key' => 'collections.tree_tbar_selection',
      'value' => '0',
      'xtype' => 'combo-boolean',
      'namespace' => 'collections',
      'area' => 'default',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '302f6cda26f4f09c033e654f12559081' => 
  array (
    'criteria' => 
    array (
      'category' => 'Collections',
    ),
    'object' => 
    array (
      'id' => 30,
      'parent' => 0,
      'category' => 'Collections',
      'rank' => 0,
    ),
  ),
  '048aa13f988a5ff3f4a24867381d57e8' => 
  array (
    'criteria' => 
    array (
      'name' => 'getSelections',
    ),
    'object' => 
    array (
      'id' => 48,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'getSelections',
      'description' => '',
      'editor_type' => 0,
      'category' => 30,
      'cache_type' => 0,
      'snippet' => '/**
 * getSelections
 *
 * DESCRIPTION
 *
 * This snippet is a helper for getResources call.
 * It will allows you to select all linked resources under specific Selection with a usage of getResources snippet.
 * Returns distinct list of linked Resources for given Selections
 *
 * getResources are required
 *
 * PROPERTIES:
 *
 * &sortdir                 string  optional    Direction of sorting by linked resource\'s menuindex. Default: ASC
 * &selections              string  optional    Comma separated list of Selection IDs for which should be retrieved linked resources. Default: empty string
 * &getResourcesSnippet     string  optional    Name of getResources snippet. Default: getResources
 * &excludeResources        string  optional    Comma separated list of Resources to exclude, even though they are in the Selection
 *
 * USAGE:
 *
 * [[getSelections? &selections=`1` &tpl=`rowTpl`]]
 * [[getSelections? &selections=`1` &tpl=`rowTpl` &sortby=`RAND()`]]
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$corePath = $modx->getOption(\'collections.core_path\', null, $modx->getOption(\'core_path\', null, MODX_CORE_PATH) . \'components/collections/\');

/** @var Collections $collections */
$collections = $modx->getService(
    \'collections\',
    \'Collections\',
    $corePath . \'model/collections/\',
    array(
        \'core_path\' => $corePath
    )
);
if (!($collections instanceof Collections)) return \'\';

$getResourcesSnippet = $modx->getOption(\'getResourcesSnippet\', $scriptProperties, \'getResources\');

$getResourcesExists = $modx->getCount(\'modSnippet\', array(\'name\' => $getResourcesSnippet));
if ($getResourcesExists == 0) return \'getResources not found\';

$sortDir = strtolower($modx->getOption(\'sortdir\', $scriptProperties, \'asc\'));
$selections = $modx->getOption(\'selections\', $scriptProperties, \'\');
$sortBy = $modx->getOption(\'sortby\', $scriptProperties, \'\');

$selections = $collections->explodeAndClean($selections);

if ($sortDir != \'asc\') {
    $sortDir = \'desc\';
}

$linkedResourcesQuery = $modx->newQuery(\'CollectionSelection\');

if (!empty($selections)) {
    $linkedResourcesQuery->where(array(
        \'collection:IN\' => $selections
    ));
}

if ($sortBy == \'\') {
    $linkedResourcesQuery->sortby(\'menuindex\', $sortDir);
}

$linkedResourcesQuery->select(array(
    \'resource\' => \'DISTINCT(resource)\'
));

$linkedResourcesQuery->prepare();

$linkedResourcesQuery->stmt->execute();

$linkedResources = $linkedResourcesQuery->stmt->fetchAll(PDO::FETCH_COLUMN, 0);

$excludedResources = $modx->getOption(\'excludeResources\', $scriptProperties, \'\');
$excludedResources = $collections->explodeAndClean($excludedResources);

if (!empty($excludedResources)) {
    $linkedResources = array_diff($linkedResources, $excludedResources);
}

$linkedResources = implode(\',\', $linkedResources);

$properties = $scriptProperties;
unset($properties[\'selections\']);

$properties[\'resources\'] = $linkedResources;
$properties[\'parents\'] = ($properties[\'getResourcesSnippet\'] == \'pdoResources\') ? 0 : -1;

if ($sortBy == \'\') {
    $properties[\'sortby\'] = \'FIELD(modResource.id, \' . $linkedResources . \' )\';
    $properties[\'sortdir\'] = \'asc\';
}

return $modx->runSnippet($getResourcesSnippet, $properties);',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * getSelections
 *
 * DESCRIPTION
 *
 * This snippet is a helper for getResources call.
 * It will allows you to select all linked resources under specific Selection with a usage of getResources snippet.
 * Returns distinct list of linked Resources for given Selections
 *
 * getResources are required
 *
 * PROPERTIES:
 *
 * &sortdir                 string  optional    Direction of sorting by linked resource\'s menuindex. Default: ASC
 * &selections              string  optional    Comma separated list of Selection IDs for which should be retrieved linked resources. Default: empty string
 * &getResourcesSnippet     string  optional    Name of getResources snippet. Default: getResources
 * &excludeResources        string  optional    Comma separated list of Resources to exclude, even though they are in the Selection
 *
 * USAGE:
 *
 * [[getSelections? &selections=`1` &tpl=`rowTpl`]]
 * [[getSelections? &selections=`1` &tpl=`rowTpl` &sortby=`RAND()`]]
 *
 * @var modX $modx
 * @var array $scriptProperties
 */

$corePath = $modx->getOption(\'collections.core_path\', null, $modx->getOption(\'core_path\', null, MODX_CORE_PATH) . \'components/collections/\');

/** @var Collections $collections */
$collections = $modx->getService(
    \'collections\',
    \'Collections\',
    $corePath . \'model/collections/\',
    array(
        \'core_path\' => $corePath
    )
);
if (!($collections instanceof Collections)) return \'\';

$getResourcesSnippet = $modx->getOption(\'getResourcesSnippet\', $scriptProperties, \'getResources\');

$getResourcesExists = $modx->getCount(\'modSnippet\', array(\'name\' => $getResourcesSnippet));
if ($getResourcesExists == 0) return \'getResources not found\';

$sortDir = strtolower($modx->getOption(\'sortdir\', $scriptProperties, \'asc\'));
$selections = $modx->getOption(\'selections\', $scriptProperties, \'\');
$sortBy = $modx->getOption(\'sortby\', $scriptProperties, \'\');

$selections = $collections->explodeAndClean($selections);

if ($sortDir != \'asc\') {
    $sortDir = \'desc\';
}

$linkedResourcesQuery = $modx->newQuery(\'CollectionSelection\');

if (!empty($selections)) {
    $linkedResourcesQuery->where(array(
        \'collection:IN\' => $selections
    ));
}

if ($sortBy == \'\') {
    $linkedResourcesQuery->sortby(\'menuindex\', $sortDir);
}

$linkedResourcesQuery->select(array(
    \'resource\' => \'DISTINCT(resource)\'
));

$linkedResourcesQuery->prepare();

$linkedResourcesQuery->stmt->execute();

$linkedResources = $linkedResourcesQuery->stmt->fetchAll(PDO::FETCH_COLUMN, 0);

$excludedResources = $modx->getOption(\'excludeResources\', $scriptProperties, \'\');
$excludedResources = $collections->explodeAndClean($excludedResources);

if (!empty($excludedResources)) {
    $linkedResources = array_diff($linkedResources, $excludedResources);
}

$linkedResources = implode(\',\', $linkedResources);

$properties = $scriptProperties;
unset($properties[\'selections\']);

$properties[\'resources\'] = $linkedResources;
$properties[\'parents\'] = ($properties[\'getResourcesSnippet\'] == \'pdoResources\') ? 0 : -1;

if ($sortBy == \'\') {
    $properties[\'sortby\'] = \'FIELD(modResource.id, \' . $linkedResources . \' )\';
    $properties[\'sortdir\'] = \'asc\';
}

return $modx->runSnippet($getResourcesSnippet, $properties);',
    ),
  ),
  '2145756bb9a563e66aa9b1aff8303b07' => 
  array (
    'criteria' => 
    array (
      'name' => 'Collections',
    ),
    'object' => 
    array (
      'id' => 9,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'Collections',
      'description' => '',
      'editor_type' => 0,
      'category' => 30,
      'cache_type' => 0,
      'plugincode' => '/**
 * Collections
 *
 * DESCRIPTION
 *
 * This plugin inject JS to handle proper working of close buttons in Resource\'s panel (OnDocFormPrerender)
 * This plugin handles setting proper show_in_tree parameter (OnBeforeDocFormSave, OnResourceSort)
 *
 * @var modX $modx
 * @var array $scriptProperties
 */
$corePath = $modx->getOption(\'collections.core_path\', null, $modx->getOption(\'core_path\', null, MODX_CORE_PATH) . \'components/collections/\');
/** @var Collections $collections */
$collections = $modx->getService(
    \'collections\',
    \'Collections\',
    $corePath . \'model/collections/\',
    array(
        \'core_path\' => $corePath
    )
);

$className = \'Collections\' . $modx->event->name;

$modx->loadClass(\'CollectionsPlugin\', $collections->getOption(\'modelPath\') . \'collections/events/\', true, true);
$modx->loadClass($className, $collections->getOption(\'modelPath\') . \'collections/events/\', true, true);

if (class_exists($className)) {
    /** @var CollectionsPlugin $handler */
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}

return;',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Collections
 *
 * DESCRIPTION
 *
 * This plugin inject JS to handle proper working of close buttons in Resource\'s panel (OnDocFormPrerender)
 * This plugin handles setting proper show_in_tree parameter (OnBeforeDocFormSave, OnResourceSort)
 *
 * @var modX $modx
 * @var array $scriptProperties
 */
$corePath = $modx->getOption(\'collections.core_path\', null, $modx->getOption(\'core_path\', null, MODX_CORE_PATH) . \'components/collections/\');
/** @var Collections $collections */
$collections = $modx->getService(
    \'collections\',
    \'Collections\',
    $corePath . \'model/collections/\',
    array(
        \'core_path\' => $corePath
    )
);

$className = \'Collections\' . $modx->event->name;

$modx->loadClass(\'CollectionsPlugin\', $collections->getOption(\'modelPath\') . \'collections/events/\', true, true);
$modx->loadClass($className, $collections->getOption(\'modelPath\') . \'collections/events/\', true, true);

if (class_exists($className)) {
    /** @var CollectionsPlugin $handler */
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}

return;',
    ),
  ),
  'afe424f721a00b87314f0dbc32519e20' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 9,
      'event' => 'OnManagerPageInit',
    ),
    'object' => 
    array (
      'pluginid' => 9,
      'event' => 'OnManagerPageInit',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '106a976fb2a14b8fab9221dce87002c4' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 9,
      'event' => 'OnBeforeDocFormSave',
    ),
    'object' => 
    array (
      'pluginid' => 9,
      'event' => 'OnBeforeDocFormSave',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'dc445129469bce5e7bf7daf78ddfae49' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 9,
      'event' => 'OnResourceBeforeSort',
    ),
    'object' => 
    array (
      'pluginid' => 9,
      'event' => 'OnResourceBeforeSort',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '4d4512be49843c80ffb444664b2f41b3' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 9,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 9,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '3897b9d914514cee2a9ea021645c0476' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 9,
      'event' => 'OnBeforeEmptyTrash',
    ),
    'object' => 
    array (
      'pluginid' => 9,
      'event' => 'OnBeforeEmptyTrash',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '2627a7fe9062e2a304ca44e114c4d941' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 9,
      'event' => 'OnDocFormRender',
    ),
    'object' => 
    array (
      'pluginid' => 9,
      'event' => 'OnDocFormRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '6a7a051612062f31f7a1f06e587e1daf' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 9,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 9,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'd461bf4226f6b1cd27d91bbe108fb396' => 
  array (
    'criteria' => 
    array (
      'text' => 'collections.menu.collection_templates',
    ),
    'object' => 
    array (
      'text' => 'collections.menu.collection_templates',
      'parent' => 'components',
      'action' => '7',
      'description' => 'collections.menu.collection_templates_desc',
      'icon' => '',
      'menuindex' => 0,
      'params' => '',
      'handler' => '',
      'permissions' => '',
      'namespace' => 'core',
    ),
  ),
);