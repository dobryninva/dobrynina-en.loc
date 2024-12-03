<?php
if (!$eshoplogistic3 = $modx->getService('eshoplogistic3', 'eshoplogistic3', $modx->getOption('eshoplogistic3_core_path', null,
        $modx->getOption('core_path') . 'components/eshoplogistic3/') . 'model/eshoplogistic3/', $scriptProperties)
) {
    return 'Could not load eshoplogistic3 class!';
}

$pdo = $modx->getService('pdoTools');

$eshoplogistic3->initialize('web');


$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl.eshoplogistic3.order');
$fias = $modx->getOption('fias', $scriptProperties, '');
$city = $modx->getOption('city', $scriptProperties, '');
$region = $modx->getOption('region', $scriptProperties, '');

$data = $eshoplogistic3->initCheckout($fias, $city, $region);

return $pdo->getChunk($tpl, $data);