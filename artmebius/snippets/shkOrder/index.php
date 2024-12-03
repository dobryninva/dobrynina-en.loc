<?php
$output = '';
$user = $modx->getUser();

$orders = $modx->getCollection('shk_order', array(
    'userid' => $user->get('id')
));

krsort($orders);
$statuses = $modx->getObject('shk_config', array(
    'setting' => 'statuses'
));
$statuses = json_decode($statuses->get('value'));
$arrStatuses = array();
foreach ($statuses as $key => $obj) {
    $arrStatuses[$obj->id] = $obj->label;
}

foreach($orders as $id => $order){
    $contacts = unserialize($order->get('contacts'));
    $order = $order->toArray();
    $order['status'] = $arrStatuses[$order['status']];
    if(isset($contacts['shoppingList'])){
        $order['price'] = '-';
        $order['currency'] = '';
    }
    $output .= $modx->parseChunk($rowTpl, $order);
}

?>