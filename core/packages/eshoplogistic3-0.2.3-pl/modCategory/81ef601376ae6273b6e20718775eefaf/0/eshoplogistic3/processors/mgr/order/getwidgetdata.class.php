<?php

class eshoplogistic3GetWidgetDataProcessor extends modProcessor {

    public $permission = '';

    public function process()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        $key = $this->modx->getOption('eshoplogistic3_manager_widget_key');
        if(empty($key)) {
            return $this->failure($this->modx->lexicon('eshoplogistic3_err_widget_key'));
        }

        if($order_id = $this->getProperty('order_id')) {

            $offers = [];

            $q = $this->modx->newQuery('msOrderProduct', ['order_id' => $order_id]);
            foreach($this->modx->getIterator('msOrderProduct', $q) as $product) {
                $id = $product->get('product_id');
                $offer = $this->eshoplogistic3->getOffers('product', $id);
                if(!empty($offer[$id]['count'])) {
                    $offer[$id]['count'] = $product->get('count');
                    $offers[] = $offer[$id];
                }
            }

            return $this->modx->toJSON([
                'success' => true,
                'key' => $key,
                'offers' => json_encode($offers)
            ]);

        }

        return $this->failure($this->modx->lexicon('eshoplogistic3_err_info'));
    }

}

return 'eshoplogistic3GetWidgetDataProcessor';
