<?php


class msSetInCartMsOnBeforeAddToCart extends msSetInCartPlugin
{
    public function run()
    {
          
        /** @var  msCartHandler $cart */
        $cart = $this->modx->getOption('cart', $this->scriptProperties);
        /** @var  msProduct $product */
        $product = $this->modx->getOption('product', $this->scriptProperties);
        $options = $this->modx->getOption('options', $this->scriptProperties);
        $count = $this->modx->getOption('count', $this->scriptProperties);
        $exclude = (bool)$this->modx->getOption('mssetincart_exclude', $options);
        if ($exclude) {
            $this->modx->event->returnedValues = $this->modx->Event->returnedValues;
            return;
        }

        $data = $this->modx->getOption('mssetincart_data', $_REQUEST);
        $set = $this->modx->getOption('mssetincart_set', $_REQUEST);
        $rid = (string)$product->get('id');
        if ($set != $rid) {
            $this->modx->event->returnedValues = $this->modx->Event->returnedValues;
            return;
        }

        $returned = (array)$this->modx->getPlaceholder('_returned_price');
        if (isset($returned['id']) AND $returned['id'] == $rid) {
            $tmp = $this->modx->getOption('msoptionsprice_options', $returned);
            if (is_array($tmp)) {
                $options = array_merge($options, $tmp);
            }
        }

        /*if (empty($data) OR empty($set)) {
            if (isset($returned['id']) AND $returned['id'] == $rid) {
                $options = (array)$this->modx->getOption('msoptionsprice_options', $returned, array(), true);
            }
            $this->modx->event->returnedValues['options'] = $options;

            return;
        }*/

        $items = &$cart->config['cart'];

        $data = $this->msSetInCart->getSetData($data);

        $products = $this->modx->getOption('product', $data, array(), true);
        if (empty($products)) {
            $this->modx->event->returnedValues['options'] = $options;
            return;
        }

        $master = $this->modx->getOption($rid, $products, array(), true);

        $sets = $this->modx->getOption('sets', $data, array(), true);
        $setCart = $this->modx->getOption('cart', $sets, array(), true);
        $setOption = $this->modx->getOption('option', $sets, array(), true);
        $setCart = $this->modx->getOption($rid, $setCart, array(), true);
        $setOption = $this->modx->getOption($rid, $setOption, array(), true);

        /* set remove key */
        $removeOptions = array_merge($options, array(
            'mssetincart_remove'  => true,
            'mssetincart_exclude' => true,
        ));
        $response = $cart->add($rid, $count, $removeOptions);
        if ($this->msSetInCart->miniShop2->config['json_response']) {
            $response = json_decode($response, true);
        }
        if (!$response['success']) {
            return;
        }

        /* add master */
        $response = $cart->add($rid, $count, array(
            'mssetincart_exclude' => true,
            'mssetincart_hash'    => sha1(serialize(array_merge($options, $setCart, $setOption)))
        ));
        if ($this->msSetInCart->miniShop2->config['json_response']) {
            $response = json_decode($response, true);
        }
        if (!$response['success']) {
            return;
        }
        $tmpData = $this->modx->getOption('data', $response);
        $masterKey = $this->modx->getOption('key', $tmpData);
        $masterItem = &$items[$masterKey];


        /* set start price, weight */
        $masterItem['price'] = $master['price'];
        $masterItem['weight'] = $master['weight'];


        /* process cart */
        $cartSlave = array();
        if (!empty($setCart)) {
            /* add slave */
            foreach ($setCart as $row) {

                $itemId = $this->modx->getOption('id', $row);
                $itemCount = $this->modx->getOption('count', $row);
                $itemOptions = $this->modx->getOption('options', $row);
                $itemRemove = $this->modx->getOption('mssetincart_remove', $row);

                $response = $cart->add($itemId, $itemCount, array(
                    'mssetincart_exclude' => true,
                    'mssetincart_hash'    => sha1(serialize($itemOptions))
                ));
                if ($this->msSetInCart->miniShop2->config['json_response']) {
                    $response = json_decode($response, true);
                }
                if (!$response['success']) {
                    continue;
                }

                $tmpData = $this->modx->getOption('data', $response);
                $tmpKey = $this->modx->getOption('key', $tmpData);

                $item = &$items[$tmpKey];
                $tmpCount = $item['count'];

                $item = array_merge($item, $row, array('count' => $tmpCount));

                if (!empty($itemRemove)) {
                    $item['options'] = array_merge((array)$item['options'], array(
                        'mssetincart' => array(
                            'master'     => $rid,
                            'master_key' => $masterKey
                        )
                    ));

                    $cartSlave[] = $tmpKey;
                }
            }
        }


        /* process option */
        $optionSlave = array();
        if (!empty($setOption)) {
            /* add slave */
            foreach ($setOption as $row) {
                $itemCost = $this->modx->getOption('cost', $row);
                $itemMass = $this->modx->getOption('mass', $row);

                $masterItem['price'] += $itemCost;
                $masterItem['weight'] += $itemMass;

                $optionSlave[] = $row;
            }
        }

        $masterItem['options'] = array_merge($options, array(
            'mssetincart' => array(
                'cart'         => $setCart,
                'option'       => $setOption,
                'cart_slave'   => $cartSlave,
                'option_slave' => $optionSlave,
            ),
        ));


        /* set remove key */
        $this->modx->event->returnedValues['options'] = $removeOptions;
    }
}