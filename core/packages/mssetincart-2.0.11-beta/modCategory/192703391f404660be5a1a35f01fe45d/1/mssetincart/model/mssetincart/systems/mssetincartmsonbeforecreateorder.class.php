<?php


class msSetInCartMsOnBeforeCreateOrder extends msSetInCartPlugin
{
    public function run()
    {
        /** @var  msOrderHandler $order */
        $order = $this->modx->getOption('order', $this->scriptProperties);
        /** @var  msOrder $msOrder */
        $msOrder = $this->modx->getOption('msOrder', $this->scriptProperties);
        if (!$msOrder) {
            return;
        }

        $tplInfo = $this->msSetInCart->getOption('tpl_order_info', null);
        if (empty($tplInfo)) {
            return;
        }

        $comment = trim($msOrder->get('comment'));
        if (!empty($comment)) {
            $comment = array($comment);
        } else {
            $comment = array();
        }

        /** @var msOrderProduct[] $products */
        $products = $msOrder->getMany('Products');
        foreach ($products as $product) {
            $options = $product->get('options');
            $data = $this->modx->getOption('mssetincart', $options, array(), true);
            if (empty($data)) {
                continue;
            }

            $info = $this->msSetInCart->miniShop2->pdoTools->getChunk($tplInfo, $data);
            if (!empty($info)) {
                $comment[] = $info;
            }
        }

        $comment = $this->msSetInCart->cleanAndImplode($comment, PHP_EOL);
        $msOrder->set('comment', $comment);

        return;
    }
}