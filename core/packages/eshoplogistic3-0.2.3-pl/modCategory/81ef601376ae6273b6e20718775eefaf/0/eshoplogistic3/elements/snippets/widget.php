<?php
if (!$eshoplogistic3 = $modx->getService('eshoplogistic3', 'eshoplogistic3', $modx->getOption('eshoplogistic3_core_path', null,
        $modx->getOption('core_path') . 'components/eshoplogistic3/') . 'model/eshoplogistic3/', $scriptProperties)
) {
    return 'Could not load eshoplogistic3 class!';
}

$pdo = $modx->getService('pdoTools');

$eshoplogistic3->initialize('web');

$tpl = $modx->getOption('tpl', $scriptProperties, 'tpl.eshoplogistic3.widgetBlock');
$widget_key = $modx->getOption('widget_key', $scriptProperties, '');
$product_id = $modx->getOption('product_id', $scriptProperties,  $modx->resource->get('id'));
$options = $modx->getOption('options', $scriptProperties,  '');

$data = array_merge(
    $eshoplogistic3->initWidget($product_id, array_map('trim', explode(',', $options))),
    ['widget_key' => $widget_key]
);

return $pdo->getChunk($tpl, $data);