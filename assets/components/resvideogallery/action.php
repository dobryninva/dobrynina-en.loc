<?php
header('Content-Type: application/json; charset=UTF-8');
define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';

$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');

/** @var Rvg $rvg */
$rvg = $modx->getService('resvideogallery', 'Rvg', $modx->getOption('resvideogallery.core_path', null, $modx->getOption('core_path') . 'components/resvideogallery/') . 'model/resvideogallery/', array());

if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
    $modx->sendRedirect($modx->makeUrl($modx->getOption('site_start'), '', '', 'full'));
} elseif (!empty($_REQUEST['controller'])) {
    $out = array('success' => false);
    $dataType = isset($_REQUEST['data_type']) ? $_REQUEST['data_type'] : 'json';
    if ($controller = $rvg->loadController(ucfirst($_REQUEST['controller']))) {
        unset($_REQUEST['controller']);
        $out = $controller->run($_REQUEST);
    } else {
        $out['message'] = 'invalid load controller';
    }
    echo $dataType == 'json' ? $modx->toJSON($out) : $out;
}
@session_write_close();