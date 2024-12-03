<?php
/*
Выводит заказы пользователя
*/

@date_default_timezone_set('Europe/Moscow');
@setlocale (LC_ALL, 'ru_RU.UTF-8');

$output = '';

$usergroup = $modx->getOption('usergroup',$scriptProperties,'Пользователи');
$limit = 0;
$start = 0;

$user = $modx->user;
$user_id = $modx->user->get('id');
$profile = $user->getOne('Profile');
// var_dump($user);
if(!$profile || !$user->isMember($usergroup)) return $output;

require_once MODX_CORE_PATH.'components/shopkeeper3/model/shopkeeper.class.php';

$SHKmanager = new Shopkeeper($modx);

// $SHKmanager->getModConfig();
$SHKmanager->config['orderDataTpl'] = $modx->getOption('orderDataTpl',$scriptProperties,'@FILE orderData.tpl');
$SHKmanager->config['orderDataWrapper'] = $modx->getOption('orderDataWrapper',$scriptProperties,'@FILE orderDataWrapper.tpl');
$SHKmanager->config['additDataTpl'] = $modx->getOption('additDataTpl',$scriptProperties,'@FILE additData.tpl');

$modelpath = $modx->getOption('core_path') . 'components/shopkeeper3/model/';
$modx->addPackage( 'shopkeeper3', $modelpath );

$statuses = $SHKmanager->getConfig('statuses');
foreach ($statuses['statuses'] as $st) {
  $SHKmanager->config['statuses'][$st['id']] = $st;
}

$c = $modx->newQuery('shk_order');
$c->where(array('userid:=' => $user_id));
$count = $modx->getCount('shk_order',$c);
$c->sortby('date','DESC');
if ($limit) $c->limit($limit,$start);

$orders = $modx->getCollection('shk_order', $c);

//Повтор заказа
/*if(isset($_GET['action']) && $_GET['action']=='repeat'){

  $order_id = isset($_GET['id']) ? trim($_GET['id']) : 0;
  if($order_id){

    $order = $modx->getObject('shk_order',array('id'=>$order_id, 'userid' => $user_id));
    if($order){

      $new_order = $modx->newObject('shk_order');
      $new_order->fromArray($order->toArray());
      $new_order->set('status',0);
      $new_order->set('date',strftime('%Y-%m-%d %H:%M:%S'));
      $new_order->save();

    }
    $modx->sendRedirect($modx->makeUrl($modx->resource->get('id')));
    exit;

  }

}*/

//Вывод заказов
if($count>0){

  $index = 0;
  foreach($orders as $order){

    $purchases = unserialize($order->get('content'));
    $addit_params = unserialize($order->get('addit'));
    $date = $order->get('date');
    $allowed = $order->get('allowed');

    $orderData = $SHKmanager->getOrderData($order->id);

    //Get order
    $order_data = array();
    $response = $modx->runProcessor('getorder',
      array(
        'order_id' => $order->id,
        'date_format' => 'H:i:s d/m/Y'
      ),
      array('processors_path' => $modx->getOption('core_path') . 'components/shopkeeper3/processors/mgr/')
    );
    if( !$response->isError() && $result = $response->getResponse()){
      $order_data = $result['object'];
    }

    $order_items = '<div class="table-responsive"><table class="order_table">';
      $order_items .= '<tr class="order_table_row">';
        $order_items .= '<th class="order_table_id"></th>';
        $order_items .= '<th class="order_table_title">Наименование</th>';
        $order_items .= '<th class="order_table_price">Цена</th>';
        $order_items .= '<th class="order_table_quantity">Кол-во</th>';
      $order_items .= '</tr>';
      foreach ($order_data['purchases'] as $item) {
        $options_html = '';
        if (!empty($item['options'])) {
          foreach ($item['options'] as $option) {
            $options_html .= '<div class="order_table_torg">' . $option[0] . '</div>';
          }
        }
        $price_format = $modx->runSnippet('num_format', array('input'=>$item['price']));
        $order_items .= '<tr class="order_table_row">';
          $order_items .= '<td class="order_table_id"><i class="fa fa-tag"></i></td>';
          $order_items .= '<td class="order_table_title"><a href="' . $item['uri'] . '">' . $item['name'] . '</a>' . $options_html . '</td>';
          $order_items .= '<td class="order_table_price">'.$price_format.' '.$order->currency.'</td>';
          $order_items .= '<td class="order_table_quantity">'.$item['count'].'</td>';
        $order_items .= '</tr>';
      }
    $order_items .= '</table></div>';

    $chunkArr = array(
      'index' => $index,
      'orderID' => $order->get('id'),
      'date' => $date,
      'status_id' => $order->get('status'),
      'price_total' => $order->price,
      'currency' => $order->currency,
      'delivery' => $order->delivery,
      'payment' => $order->payment,
      'status' => isset($SHKmanager->config['statuses'][$order->status]) ? $SHKmanager->config['statuses'][$order->status]['label'] : '',
      'order_items' => $order_items,
    );

    $output .= $modx->getChunk($SHKmanager->config['orderDataTpl'], $chunkArr);

    $index++;

  }

}
else {
  $output = "История заказов пуста";
}
return  $modx->getChunk($SHKmanager->config['orderDataWrapper'], array('output' => $output));