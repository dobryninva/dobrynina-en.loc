<?php

class eshoplogistic3OrderPrintProcessor extends modProcessor {

    public function process()
    {
        if($order_id = $this->getProperty('order_id')) {

            if ($order = $this->modx->getObject('msOrder', $order_id)) {

                $properties = $order->get('properties');

                if (empty($properties['eshoplogistic3_data']['service']['code']) || empty($properties['eshoplogistic3_data']['order']['id'])) {
                    return $this->failure($this->modx->lexicon('eshoplogistic3_order_status_unload_fail'));
                }

                $result = ['message' => ''];

                $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

                $query_data = [
                    'action' => 'print',
                    'service' => $properties['eshoplogistic3_data']['service']['code'],
                    'format' => $this->modx->getOption('eshoplogistic3_sdek_order_print_format') ?? 'A4',
                    'order_id' => $properties['eshoplogistic3_data']['order']['id']
                ];

                if ($client = $this->eshoplogistic3->ApiQuery('delivery/order', $query_data)) {

                    #$this->modx->log(1, print_r($client, 1));

                    if (!empty($client['data'])) {

                        $result['message'] = $client['data']['status']['description'] ?? '';

                        if (!empty($client['data']['url'])) {

                            $properties['eshoplogistic3_data']['order']['print'] = $client['data']['url'];
                            $order->set('properties', $properties);
                            $order->save();

                            $result['message'] .= '<br>Ссылка: <a href="' . $client['data']['url'] . '" target="_blank">' . $client['data']['url'] . '</a>';
                        }

                        return $this->modx->toJSON([
                            'success' => true,
                            'result' => $result
                        ]);
                    }
                }
            }
        }

        return $this->failure($this->modx->lexicon('eshoplogistic3_data_fail'));
    }

}

return 'eshoplogistic3OrderPrintProcessor';
