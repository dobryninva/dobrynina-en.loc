<?php


class msSetInCartMsOnGetProductPrice extends msSetInCartPlugin
{
    public function run()
    {
        if ($this->modx->context->key == 'mgr') {
            return;
        }

        /** @var  msProduct $product */
        $product = $this->modx->getOption('product', $this->scriptProperties);
        if (
            !$product
            OR
            !($product instanceof xPDOObject)
        ) {
            return;
        }

        $rid = $product->get('id');
        $data = $this->modx->getOption('data', $this->scriptProperties, array(), true);
        $returned = (array)$this->modx->getPlaceholder('_returned_price');

        if (
            !$price = $this->modx->getOption('price', $returned)
            OR
            !isset($returned['id'])
            OR
            $returned['id'] != $rid
        ) {
            $price = $this->modx->getOption('price', $this->scriptProperties, 0, true);
        }

        if ($query = $this->getQueryLink($data)) {
            $cost = $this->msSetInCart->getCostByLink($rid, $price, $query, $this->isAjax);
            if ($cost !== false) {
                $price = $cost;
            }
        }

        $returned['id'] = $rid;
        $this->modx->event->returnedValues['price'] = $returned['price'] = $price;
        $this->modx->setPlaceholder('_returned_price', $returned);
    }
}