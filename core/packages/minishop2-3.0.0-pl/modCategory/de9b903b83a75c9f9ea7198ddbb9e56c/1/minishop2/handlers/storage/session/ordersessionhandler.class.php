<?php

class OrderSessionHandler
{
    protected $modx;
    protected $ctx = 'web';
    protected $ms2;

    public function __construct(modX $modx, miniShop2 $ms2)
    {
        $this->modx = $modx;
        $this->ms2 = $ms2;
    }

    public function setContext($ctx)
    {
        $this->ctx = $ctx;
    }

    public function get()
    {
        return $_SESSION['minishop2']['order'];
    }

    public function add($key, $value = '')
    {
        $_SESSION['minishop2']['order'][$key] = $value;
        return $this->get();
    }

    public function remove($key)
    {
        unset($_SESSION['minishop2']['order'][$key]);
        return $this->get();
    }

    public function clean()
    {
        unset($_SESSION['minishop2']['order']);
        return $this->get();
    }

    public function getForSubmit($data)
    {
        $order = $this->get();
        $createdon = date('Y-m-d H:i:s');
        /** @var msOrder $msOrder */
        $msOrder = $this->modx->newObject('msOrder');
        $msOrder->fromArray(array(
            'user_id' => $data['user_id'],
            'createdon' => $createdon,
            'num' => $data['num'],
            'delivery' => $order['delivery'],
            'payment' => $order['payment'],
            'cart_cost' => $data['cart_cost'],
            'weight' => $data['cart_status']['total_weight'],
            'delivery_cost' => $data['delivery_cost'],
            'cost' => $data['cart_cost'] + $data['delivery_cost'],
            'status' => 0,
            'context' => $this->ctx,
        ));

        // Adding address
        /** @var msOrderAddress $address */
        $address = $this->modx->newObject('msOrderAddress');
        $address->fromArray(array_merge($order, array(
            'user_id' => $data['user_id'],
            'createdon' => $createdon,
        )));
        $msOrder->addOne($address);

        // Adding products
        $cart = $this->ms2->cart->get();
        $products = array();
        foreach ($cart as $v) {
            if ($tmp = $this->modx->getObject('msProduct', array('id' => $v['id']))) {
                $name = $tmp->get('pagetitle');
            } else {
                $name = '';
            }
            /** @var msOrderProduct $product */
            $product = $this->modx->newObject('msOrderProduct');
            $product->fromArray(array_merge($v, array(
                'product_id' => $v['id'],
                'name' => $name,
                'cost' => $v['price'] * $v['count'],
            )));
            $products[] = $product;
        }
        $msOrder->addMany($products);
        return $msOrder;
    }
}
