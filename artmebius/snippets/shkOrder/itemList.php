<?php

$output = '';
$id = (integer) $_GET['id'];
$purchases = $modx->query("SELECT * FROM ".$modx->config['table_prefix']."shopkeeper3_purchases WHERE order_id = ".$id.";");
$arrPurchases = array();

$i = 0;
while ($row = $purchases->fetch(PDO::FETCH_ASSOC)) {
	$arrPurchases[$i]=$row;
	$arrPurchases[$i]['price_count'] = $arrPurchases[$i]['price']*$arrPurchases[$i]['count'];
	$i++;
}

$content = $arrPurchases;
$total = 0;

for($x = 0; $x < count($content); $x++){
    $output .= $modx->parseChunk($rowTpl, $content[$x]);
    $total += (integer) $content[$x]['price_count'];
}

$output .= $modx->parseChunk($rowTpl, array(
    'name' => 'Доставка: '.$delivery ,
    'price_count' => $delivery_price
));
$total += (integer) $delivery_price;

$output .= $modx->parseChunk($rowTpl, array(
    'name' => 'Итого',
    'price_count' => $total
));

return $output;