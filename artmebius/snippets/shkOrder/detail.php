<?php
$id = (integer) $_GET['id'];
$order = $modx->query("SELECT * FROM ".$modx->config['table_prefix']."shopkeeper3_orders WHERE id = ".$id.";");
$statuses = $modx->query("SELECT * FROM ".$modx->config['table_prefix']."shopkeeper3_config WHERE id = 1;");

if(!is_object($order) && !is_object($statuses)) {
    return 'error';
}

$order = $order->fetch(PDO::FETCH_ASSOC);
$statuses = $statuses->fetch(PDO::FETCH_ASSOC);
$statuses = json_decode($statuses['value']);

foreach($order as $key => $val){
  $order['order.'.$key] = $val;
  unset($order[$key]);
}

foreach(json_decode($order['order.contacts']) as $key => $val){
  $order['order.contacts.'.$val->name.'.value'] = $val->value;
  $order['order.contacts.'.$val->name.'.label'] = $val->label;
}
unset($order['order.contacts']);

foreach ($statuses as $key => $obj){
	if ($obj->id == $order['order.status']){
		$order['order.status'] = $obj->label;
		break;
	}
}

if(isset($order['order.contacts.file'])){
    $order['order.contacts.isShoppingList'] = 1;
}

$modx->setPlaceholders($order);