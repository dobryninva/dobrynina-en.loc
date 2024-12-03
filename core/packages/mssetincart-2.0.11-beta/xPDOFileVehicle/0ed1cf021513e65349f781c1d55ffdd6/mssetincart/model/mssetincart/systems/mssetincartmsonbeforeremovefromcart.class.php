<?php


class msSetInCartMsOnBeforeRemoveFromCart extends msSetInCartPlugin
{
    public function run()
    {
        /** @var  msCartHandler $cart */
        $cart = $this->modx->getOption('cart', $this->scriptProperties);
        $key = $this->modx->getOption('key', $this->scriptProperties);
        
        $items = &$cart->config['cart'];
        $item = $items[$key];
        $options = $item['options'];

        $data = $this->modx->getOption('mssetincart', $options, array(), true);
        $cartSlave = $this->modx->getOption('cart_slave', $data, array(), true);
        foreach ($cartSlave as $slaveKey) {
            $response = $cart->remove($slaveKey);
        }

        return;
    }
}