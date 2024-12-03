<?php
/** @noinspection PhpIncludeInspection */
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var SEOroom $SEOroom */
$SEOroom = $modx->getService('seoroom', 'SEOroom', $modx->getOption('seoroom_core_path', null, $modx->getOption('core_path') . 'components/seoroom/') . 'model/seoroom/');
$modx->lexicon->load('seoroom:default');

// handle request
$corePath = $modx->getOption('seoroom_core_path', null, $modx->getOption('core_path') . 'components/seoroom/');
$path = $modx->getOption('processorsPath', $SEOroom->config, $corePath . 'processors/');
$modx->request->handleRequest(array(
	'processors_path' => $path,
	'location' => '',
));