<?php
/**
 * msOneClickOrderSave
 */

// ini_set('display_errors',1);
// error_reporting(E_ALL);

$isTest = $fields['test'] ?: 0; // тестовый режим
$output = false;
$fields = $hook->getValues();

if (!$isTest) {

  $miniShop2 = $modx->getService('miniShop2');
  $miniShop2->initialize('web', array('json_response' => true));

  // delivery и payment настраиваются в зависимости от того, какие поля присутствуют в форме, по умолчанию: наличными + самовывоз
  $data = [
    'receiver'   => $fields['opf_name'],
    'phone'      => $fields['opf_phone'],
    'email'      => $fields['opf_email'],
    'comment'    => $fields['opf_mess'],
    'delivery'   => 1, // $fields['opf_delivery'],
    'payment'    => 1, // $fields['payment'],
    'ms2_action' => 'order/submit',
    'ctx'        => 'web',
    // 'properties'  => json_encode([
    //   'delivery'      => $_POST['opf_delivery']
    // ]),
  ];

  $_SESSION['minishop2']['cart'] = [[
    'id'     => $fields['opf_rid'],
    'price'  => $fields['opf_price'],
    'weight' => 0,
    'count'  => 1,
    'ctx'    => 'web',
  ]];

  // сохраняем заказ
  $response = $miniShop2->order->submit($data);

  if(!empty($response)){
    $response = json_decode($response);
    // добавляем значения для последующих хуков
    $hook->setValues(array(
      'orderID' => $response->data->msorder,
      'orderPrice' => $fields['opf_price']
    ));
    $output = $response->success;
  }

  return $output;

} else {

  $test_time = date('his');
  $test_order_id = $fields['opf_rid'].$test_time;

  $hook->setValues(array(
    'orderID'    => $test_order_id,
    'orderPrice' => $fields['opf_price']
  ));

  return true;

}