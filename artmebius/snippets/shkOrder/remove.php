<?php

$output = '';

if(isset($_GET['action']) && $_GET['action'] == 'remove'){
    $id = (integer) $_GET['id'];
    $modx->query('update modx_shopkeeper3_orders set status = \'4\' where id = '.$id.';');
    echo 'update modx_shopkeeper3_orders set status = \'4\' where id = '.$id.';';
    $output .= 'Заказ отменен';
}

return $output;