<?php
if (!interface_exists('msDeliveryInterface')) {
   $msDir = dirname(__FILE__,3);
    $paths = [
        '/handlers/msdeliveryhandler.class.php',
        '/model/minishop2/msdeliveryhandler.class.php'
    ];
    foreach($paths as $path) {
        if(file_exists($msDir.$path)) {
            if (!class_exists('msDeliveryInterface')) {
                require_once $msDir.$path;
                break;
            }
        }
    }
}

class eShopLogisticHandler extends msDeliveryHandler implements msDeliveryInterface
{

    public function getCost(msOrderInterface $order, msDelivery $delivery, $cost = 0.0)
    {
        $order_data = $order->get();

        if(!empty($order_data['order_id'])){
            $msOrder = $this->modx->getObject('msOrder', $order_data['order_id']);
            $properties = $msOrder->get('properties');
            $esl_data = $properties['eshoplogistic3_data'] ?? [];
        }
        else {
            if (!empty($order_data['eshoplogistic3_data'])) {
                $esl_data = json_decode($order_data['eshoplogistic3_data'], 1);
            }
        }

        if(isset($esl_data['price']['value'])) {
            $delivery_price = (double)$esl_data['price']['value'];
            if (!empty($delivery_price)) {
                $cost += $delivery_price;
            }
        }

        return parent::getCost($order, $delivery, $cost);
    }

}