<?php
/**
 * FormIt hook for Shopkeeper 3.x
 */

//ini_set('display_errors',1);
//error_reporting(E_ALL);

$output = false;

if(!defined('SHOPKEEPER_PATH')){
  define('SHOPKEEPER_PATH', MODX_CORE_PATH."components/shopkeeper3/");
}

require_once SHOPKEEPER_PATH . "model/shopkeeper.class.php";

$modx->addPackage( 'shopkeeper3', SHOPKEEPER_PATH . 'model/' );

//shopkeeper settings
$contacts_fields = array();
$response = $modx->runProcessor('getsettings',
  array( 'settings' => array('contacts_fields') ),
  array( 'processors_path' => $modx->getOption( 'core_path' ) . 'components/shopkeeper3/processors/mgr/' )
);
if ($response->isError()) {
  echo $response->getMessage();
}
if($result = $response->getResponse()){
  $temp_arr = !empty( $result['object']['contacts_fields'] ) ? $result['object']['contacts_fields'] : array();
  if( !empty( $temp_arr ) ){
    foreach( $temp_arr as $opt ){
      $contacts_fields[$opt['name']] = $opt;
    }
  }
}

$userId = $modx->getLoginUserID( $modx->context->key );
if( !$userId ) $userId = 0;

//Контактные данные
$contacts = array();
$allFormFields = $hook->getValues();

// поля в форме должны совпадать с полями в настройках контактных данных шопкипера чтобы цикл работал
foreach( $allFormFields as $key => $val ){
  if( in_array( $key, array_keys( $contacts_fields ) ) ){
    $temp_arr = array(
      'name' => $contacts_fields[$key]['name'],
      'value' => $val,
      'label' => $contacts_fields[$key]['label']
    );
    array_push( $contacts, $temp_arr );
  }
}
// иначе вручную подставляем поля из формы
if(!$contacts){
  $contacts = array(
    array(
      'name' => 'fullname',
      'value' => $allFormFields['opf_name'],
      'label' => 'Полное имя',
    ),
    array(
      'name' => 'email',
      'value' => $allFormFields['opf_email'],
      'label' => 'Эл.почта'
    ),
    array(
      'name' => 'phone',
      'value' => $allFormFields['opf_phone'],
      'label' => 'Телефон'
    ),
    array(
      'name' => 'address',
      'value' => $allFormFields['opf_address'],
      'label' => 'Адрес'
    ),
    array(
      'name' => 'message',
      'value' => $allFormFields['opf_mess'],
      'label' => 'Сообщение к заказу'
    ),
  );
}
$contacts = json_encode( $contacts );

$emailField = $modx->getOption( 'fiarToField', $hook->config, 'email' );
$phoneField = $modx->getOption( 'phoneField', $hook->config, 'phone' );

if(isset($allFormFields['opf_name'])){
  $emailField = 'opf_email';
  $phoneField = 'opf_phone';
}

//Сохраняем данные заказа
$order = $modx->newObject('shk_order');
$insert_data = array(
  'contacts' => $contacts,
  'options' => '',
  'price' => $allFormFields['opf_price'], // Shopkeeper::$price_total, // ???
  'currency' => $modx->getOption( 'shk3.currency', null, 'руб.' ), // $shopCart->config['currency'], // ???
  'date' => strftime('%Y-%m-%d %H:%M:%S'),
  'sentdate' => strftime('%Y-%m-%d %H:%M:%S'),
  'note' => $allFormFields['opf_mess'],
  'email' => isset( $allFormFields[$emailField] ) ? $allFormFields[$emailField] : '',
  'delivery' => '', // $delivery_name,
  'delivery_price' => 0, // $delivery_price,
  'payment' => '', // isset( $allFormFields[$paymentField] ) ? $allFormFields[$paymentField] : '',
  'tracking_num' => '',
  'phone' => isset( $allFormFields[$phoneField] ) ? $allFormFields[$phoneField] : '',
  'status' => $modx->getOption( 'shk3.first_status', null, '1' )
);
if( $userId ){
  $insert_data['userid'] = $userId;
}

$order->fromArray($insert_data);
$saved = $order->save();

//Сохраняем товары заказа
if( $saved ){

  $insert_data = array(
    'p_id' => $allFormFields['opf_rid'],
    'order_id' => $order->id,
    'name' => $allFormFields['opf_title'],
    'price' => $allFormFields['opf_price'],
    'count' => 1, //$p_data['count'],
    'class_name' => 'modResource', // $p_data['className'],
    'package_name' => '', // $p_data['packageName'],
    'data' => '', // $fields_data_str,
    'options' => '' // $options
  );

  $purchase = $modx->newObject('shk_purchases');
  $purchase->fromArray( $insert_data );
  $purchase->save();

} // if( $saved )

$modx->invokeEvent( 'OnSHKChangeStatus', array( 'order_ids' => array( $order->id ), 'status' => $order->status ) );

$hook->setValues(array(
  'orderID' => $order->get('id'),
  'orderDate' => $order->get('date'),
  'orderPrice' => $order->get('price'),
  'orderCurrency' => $modx->getOption( 'shk3.currency', null, 'руб.' ), //$shopCart->config['currency'],
  'orderOutputData' => '' // $orderOutputData
));

if( $saved ){
  $output = true;
} else {
  $hook->addError( 'error_message', 'Заказ не сохранён' );
  $output = false;
}

return $output;