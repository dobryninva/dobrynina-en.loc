<?php

/** @var array $scriptProperties */
$corePath = $modx->getOption('mssetincart_core_path', null,
    $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/mssetincart/');
/** @var msSetInCart $msSetInCart */
$msSetInCart = $modx->getService('mssetincart', 'msSetInCart', $corePath . 'model/mssetincart/',
    array('core_path' => $corePath));
if (!$msSetInCart) {
    return 'Could not load msSetInCart class!';
}

$msSetInCart->initialize($modx->context->key, $scriptProperties);
$msSetInCart->loadResourceJsCss($scriptProperties);