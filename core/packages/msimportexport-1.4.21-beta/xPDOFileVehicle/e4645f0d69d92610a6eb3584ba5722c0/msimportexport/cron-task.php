#!/usr/bin/env php
<?php
define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';
require_once dirname(__FILE__) . '/model/msimportexport/msie.class.php';

$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');

$modelPath = $modx->getOption('msimportexport.core_path', null, $modx->getOption('core_path') . 'components/msimportexport/') . 'model/';
$modx->addPackage('msimportexport', $modelPath);

if (isset($argv[1]) && is_numeric($argv[1])) {
    if ($task = $modx->getObject('MsieCron', $argv[1])) {
        if(!$task->run()) {
            $modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] CRON-TASK: ID ' . $argv[1] .' return error');
        }
    } else {
        $modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] CRON-TASK: Not find job ID ' . $argv[1]);
    }

} else {
    $modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] CRON-TASK: Incorrect params');
}