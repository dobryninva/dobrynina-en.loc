<?php
if(!class_exists('msCartHandler')) {
  require_once dirname(dirname(dirname(__FILE__))) . '/model/minishop2/mscarthandler.class.php';
}
class msCartHandlerCustom extends msCartHandler implements msCartInterface{

  public function status($data = array())
  {
    $status = array(
      'total_count' => 0,
      'total_cost' => 0,
      'total_weight' => 0,
      'total_count_unique' => 0,
    );
    foreach ($this->cart as $item) {
      if (empty($item['ctx']) || $item['ctx'] == $this->ctx) {
        $status['total_count'] += $item['count'];
        $status['total_cost'] += $item['price'] * $item['count'];
        $status['total_weight'] += $item['weight'] * $item['count'];
        $status['total_count_unique']++;
      }
    }

    return array_merge($data, $status);
  }
}

/*
инструкция:

1.положить файл сюда:
core/components/minishop2/custom/cart/
(хотя можно куда угодно, но нужно будет поправить путь до {core_path}components/miniShop2/model/minishop2/mscarthandler.class.php в скрипте и до файла в шаге 2)

2.в консоле выполнить:
if ($miniShop2 = $modx->getService('miniShop2')) {
  $miniShop2->addService('cart', 'msCartHandlerCustom',
    '{core_path}components/miniShop2/custom/cart/mscarthandlercustom.class.php'
  );
}

3.системные настройки минишопа:
ms2_cart_handler_class - msCartHandlerCustom

4. в чанке миникорзины добавить
<span class="ms2_total_count_unique">{$total_count_unique}</span>

5. в js.tpl добавить:
$(document).ready(function() {
  miniShop2.Callbacks.Cart.add.response.success = function(response) {
    $('.ms2_total_count_unique').text(response.data['total_count_unique']);
  };
  miniShop2.Callbacks.Cart.change.response.success = function(response) {
    $('.ms2_total_count_unique').text(response.data['total_count_unique']);
  };
});

*/
?>