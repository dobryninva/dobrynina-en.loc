<?php

/** @var array $scriptProperties */
/** @var msSetInCart $msSetInCart */
$corePath = $modx->getOption('mssetincart_core_path', null,
    $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/mssetincart/');
if (!$msSetInCart = $modx->getService('mssetincart', 'msSetInCart', $corePath . 'model/mssetincart/',
    array('core_path' => $corePath))
) {
    return;
}

$className = 'mssetincart' . $modx->event->name;
$modx->loadClass('msSetInCartPlugin', $msSetInCart->getOption('modelPath') . 'mssetincart/systems/', true,
    true);
$modx->loadClass($className, $msSetInCart->getOption('modelPath') . 'mssetincart/systems/', true, true);
if (class_exists($className)) {
    /** @var msSetInCartPlugin $handler */
    $handler = new $className($modx, $scriptProperties);
    $handler->run();
}
return;