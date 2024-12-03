<?php
if (file_exists(dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php')) {
    /** @noinspection PhpIncludeInspection */
    require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/config.core.php';
} else {
    require_once dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/config.core.php';
}
/** @noinspection PhpIncludeInspection */
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
/** @noinspection PhpIncludeInspection */
require_once MODX_CONNECTORS_PATH . 'index.php';
/** @var eshoplogistic3 $eshoplogistic3 */
$eshoplogistic3 = $modx->getService('eshoplogistic3', 'eshoplogistic3', MODX_CORE_PATH . 'components/eshoplogistic3/model/eshoplogistic3/');
$modx->lexicon->load('eshoplogistic3:default');

// handle request
$corePath = $modx->getOption('eshoplogistic3_core_path', null, $modx->getOption('core_path') . 'components/eshoplogistic3/');
$path = $modx->getOption('processorsPath', $eshoplogistic3->config, $corePath . 'processors/');
$modx->getRequest();

/** @var modConnectorRequest $request */
$request = $modx->request;
$request->handleRequest([
    'processors_path' => $path,
    'location' => '',
]);