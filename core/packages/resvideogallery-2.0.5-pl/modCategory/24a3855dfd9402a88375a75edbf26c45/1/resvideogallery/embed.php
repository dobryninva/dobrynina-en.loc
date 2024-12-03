<?php

$id = empty($_GET['id']) ? 0 : intval($_GET['id']);
if (!$id) exit();

define('MODX_API_MODE', true);
require_once dirname(dirname(dirname(dirname(__FILE__)))) . '/index.php';

$modx->getService('error', 'error.modError');
$modx->setLogLevel(modX::LOG_LEVEL_ERROR);
$modx->setLogTarget('FILE');

/** @var Rvg $rvg */
$rvg = $modx->getService('resvideogallery', 'Rvg');
echo  $rvg->getEmbedCodeById($id);
