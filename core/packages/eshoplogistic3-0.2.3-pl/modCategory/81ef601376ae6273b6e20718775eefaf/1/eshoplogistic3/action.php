<?php
$ext_query = false;
if(!empty($_GET['hash'])) {
    if(!empty($_POST['method'])) {
        $ext_query = true;
    }
    else {
        # данные могут приёти в сыром виде (отправка заказа из виджета), поэтому проверим
        $raw = file_get_contents("php://input");
        if(stripos($raw, 'widget/send')) {
            $_POST['raw'] = $raw;
            $_POST['method'] = 'widget/send';
            $ext_query = true;
        }
    }
}
else {
    if(empty($_POST['secret'])) {
        if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest') {
            die;
        }
    }
}

define('MODX_API_MODE', true);
require_once dirname(__FILE__, 4) . '/index.php';

if($ext_query) {
    if(!empty($_SESSION['widget_hash'])) {
        if ($_SESSION['widget_hash'] != $_GET['hash']) {
            die;
        }
    }
    else {
        die;
    }
}

$modx->getService('error','error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');

$eshoplogistic3 = $modx->getService('eshoplogistic3', 'eshoplogistic3', $modx->getOption('eshoplogistic3_core_path', null,
    $modx->getOption('core_path') . 'components/eshoplogistic3/') . 'model/eshoplogistic3/'
);
		
if ($modx->error->hasError() OR !($eshoplogistic3 instanceof eshoplogistic3)) {
    @session_write_close();
    die('Error');
}

$response = $modx->runProcessor('action', $_REQUEST, [
    'processors_path' => $eshoplogistic3->config['processorsPath'] . 'web/'
]);

@session_write_close();

if(preg_match('/http_status":(\d{3})/', $response->response, $mts)) {
    if($mts[1] != 200) {
        http_response_code($mts[1]);
    }
}
exit($response->response);