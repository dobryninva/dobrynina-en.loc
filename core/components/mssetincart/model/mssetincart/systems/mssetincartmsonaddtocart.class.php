<?php


class msSetInCartMsOnAddToCart extends msSetInCartPlugin
{
    public function run()
    {
        /** @var  msCartHandler $cart */
        $cart = $this->modx->getOption('cart', $this->scriptProperties);
        $key = $this->modx->getOption('key', $this->scriptProperties);

        $data = $this->modx->getOption('mssetincart_data', $_REQUEST);
        if (empty($data)) {
            return;
        }

        $items = &$cart->config['cart'];
        $item = $items[$key];
        $options = $item['options'];

        if (isset($options['mssetincart_remove'])) {
            unset($items[$key]);
        }

        return;
    }
}