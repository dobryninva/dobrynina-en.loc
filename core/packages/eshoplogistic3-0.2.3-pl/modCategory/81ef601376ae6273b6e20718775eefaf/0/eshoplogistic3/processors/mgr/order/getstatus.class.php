<?php

class eshoplogistic3OrderGetStatusProcessor extends modProcessor {

    public function process()
    {
        $this->modx->lexicon->load('eshoplogistic3:default');

        if($order_id = $this->getProperty('order_id')) {
            if ($order = $this->modx->getObject('msOrder', $order_id)) {

                $properties = $order->get('properties');

                if (!empty($properties['eshoplogistic3_data']['service']['code']) && !empty($properties['eshoplogistic3_data']['order']['id'])) {

                    $query_data = [
                        'action' => 'get',
                        'service' => $properties['eshoplogistic3_data']['service']['code'],
                        'order_id' => $properties['eshoplogistic3_data']['order']['id']
                    ];

                    $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

                    if ($client = $this->eshoplogistic3->ApiQuery('delivery/order', $query_data)) {

                        #$this->modx->log(1, print_r($client,1));

                        if (!empty($client['data']['state']['status']['code'])) {

                            $result = [
                                'order_number' => $client['data']['state']['number'] ?? '',
                                'order_state' => $client['data']['state']['status']['description'],
                                'order_state_code' => $client['data']['state']['status']['code'],
                                'order_cost' => $client['data']['state']['cost'] ?? '',
                                'order_tracking' => $client['data']['state']['tracking'] ?? ''
                            ];

                            $old_status = $properties['eshoplogistic3_data']['order']['state']['status']['description'];

                            $properties['eshoplogistic3_data']['order']['state'] = [
                                'status' => [
                                    'code' => $client['data']['state']['status']['code'],
                                    'description' => $client['data']['state']['status']['description'] ?? '',
                                ],
                                'service_status' => [
                                    'code' => $client['data']['state']['service_status']['code'] ?? '',
                                    'description' => $client['data']['state']['service_status']['description'] ?? '',
                                ]
                            ];

                            if(!empty($client['data']['state']['number'])) {
                                $properties['eshoplogistic3_data']['order']['number'] = (string)$client['data']['state']['number'];
                            }

                            if(!empty($client['data']['state']['cost'])) {
                                $properties['eshoplogistic3_data']['order']['cost'] = (string)$client['data']['state']['cost'];
                            }

                            if(!empty($client['data']['state']['tracking'])) {
                                $properties['eshoplogistic3_data']['order']['tracking'] = $client['data']['state']['tracking'];
                            }

                            if(!empty($client['data']['state']['print'])) {
                                $properties['eshoplogistic3_data']['order']['print'] = $client['data']['state']['print'];
                            }


                            $order->set('properties', $properties);
                            $order->save();

                            if($properties['eshoplogistic3_data']['order']['state']['status']['code'] == $client['data']['state']['status']['code']) {
                                $result['message'] = $this->modx->lexicon('eshoplogistic3_order_status_message_not_change');
                            }
                            else {
                                $result['message'] = str_replace(
                                    ['{old}', '{new}'],
                                    [$old_status, $client['data']['state']['status']['description']],
                                    $this->modx->lexicon('eshoplogistic3_order_status_message_change'));
                            }


                            $this->modx->invokeEvent('eshoplogistic3OnGetOrderStatus', [
                                'status' => [
                                    'old' => $properties['eshoplogistic3_data']['order']['state']['status']['code'],
                                    'new' => $client['data']['state']['status']['code']
                                ],
                                'order' => $order,
                                'response' => $client
                            ]);

                            return $this->modx->toJSON([
                                'success' => true,
                                'result' => $result
                            ]);
                        }
                        else {

                            $errors = [];

                            if(!empty($client['errors'])) {
                                $errors = $this->getErrors($client['errors']);
                            }

                            if(count($errors) > 0) {
                                $message = [];
                                $message[] = $this->modx->lexicon('eshoplogistic3_order_status_errors') . ': ';

                                foreach ($errors as $k => $error) {
                                    $message[] = ($k+1) . '. ' . $error;
                                }

                                return $this->failure(implode('<br>', $message));
                            }
                        }
                    }
                }
                else {
                    return $this->failure($this->modx->lexicon('eshoplogistic3_order_status_unload_fail'));
                }
            }
        }

        return $this->failure($this->modx->lexicon('eshoplogistic3_data_fail'));
    }



    private function getErrors(array $data) : array
    {
        $errors = [];

        foreach ($data as $item) {
            if(is_array($item)) {
                $this->getErrors($item);
            }
            else {
                $errors[] = $item;
            }
        }

        return $errors;
    }
}

return 'eshoplogistic3OrderGetStatusProcessor';
