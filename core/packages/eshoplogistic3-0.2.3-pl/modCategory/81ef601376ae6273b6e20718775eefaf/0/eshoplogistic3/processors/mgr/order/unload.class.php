<?php

class eshoplogistic3OrderUnloadProcessor extends modProcessor {

    private object $order;
    public object $eshoplogistic3;
    private array $order_data;
    private array $received_data;
    private string $service_code;
    private array $errors = [];
    private array $response_errors = [];
    private string $fail_message = '';


    public function process()
    {
        $properties = $this->getProperties();
        $this->fail_message = $this->modx->lexicon('eshoplogistic3_delivery_fail');

        if(is_array($properties)) {
            if(!empty($properties['data'])) {
                if($received_data = json_decode($properties['data'], 1)) {
                    if(is_array($received_data)) {
                        $this->received_data = $received_data;
                    }
                }
            }
        }

        if(count($this->received_data) == 0) {
            return $this->failure($this->fail_message);
        }

        if (!empty($properties['order_id'])) {
            if (!$order = $this->modx->getObject('msOrder', (int)$properties['order_id'])) {
                $this->errors[] = 'order_id';
            }
            else {
                $this->order = $order;
                $this->order_data = $order->toArray();
                if(empty($_SESSION['esl_places'][$order->id])) {
                    $this->errors[] = 'places';
                }
            }
        }
        else {
            $this->errors[] = 'order_id';
        }

        $common_data = $this->getCommonData();

        if(!empty($this->service_code)) {

            $query_data = array_merge(
                $common_data,
                $this->getOrderData(),
                $this->getSenderData(),
                $this->getReceiverData(),
                $this->getPlaces(),
                $this->getComplement(),
                $this->getDelivery()
            );

            if(count($this->errors) == 0) {

                $nfd = $this->modx->invokeEvent('eshoplogistic3BeforeUnloadOrder', [
                    'order' => $order,
                    'query_data' => $query_data
                ]);

                if(!empty($nfd)) {
                    if(is_array($nfd)) {
                        foreach($nfd as $odata) {
                            if(!empty($odata['query_data'])) {
                                $query_data = $odata['query_data'];
                                break;
                            }
                        }
                    }
                }

                #$this->modx->log(1, print_r($query_data, 1));

                $state = false;
                $response_data = $_order_data = [];
                $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');
                if ($client = $this->eshoplogistic3->ApiQuery('delivery/order', $query_data)) {

                    $response_data = $client;

                    if (!empty($client['data']['order']['id'])) {

                        # для СДЭКа необходимо проверять дополнительно по статусу, т.к. наличие идентификатора заказа не значит, что он отобразится в ЛК СДЭКа
                        $check = true;
                        if($query_data['service'] == 'sdek') {
                            $check = $this->checkSDEK($client['data']['order']['id']);
                        }

                        if($check) {
                            $state = true;
                            $_order_data = [
                                'id' => $client['data']['order']['id'],
                                'state' => $client['data']['state']
                            ];

                            if (!empty($client['data']['order']['label'])) {
                                $_order_data['print'] = $client['data']['order']['label'];
                            }
                        }
                    }
                    else {
                        if(!empty($client['errors'])) {
                            $this->getErrors($client['errors']);
                        } else {
                            $this->fail_message = $client['http_status_message'];
                        }
                    }

                }

                $this->modx->invokeEvent('eshoplogistic3UnloadOrder', [
                    'query_data' => $query_data,
                    'order' => $order,
                    'response' => [
                        'state' => $state,
                        'data' => $response_data
                    ]
                ]);

                if($state) {
                    return $this->response(true, $_order_data);
                }
            }
        }

        return $this->response(false);
    }




    private function checkSDEK(string $order_id) : bool
    {
        $fail_message = '';

        if ($client = $this->eshoplogistic3->ApiQuery('delivery/order', [
            'action' => 'get',
            'service' => 'sdek',
            'order_id' => $order_id
        ])) {

            if(isset($client['data']['state']['service_status']['code'])) {
                if($client['data']['state']['service_status']['code'] == 'INVALID') {
                    if(!empty($client['data']['state']['errors'])) {
                        $this->getErrors($client['data']['state']['errors']);
                        foreach ($this->response_errors as $k => $v) {
                            if($v == 'Подходящий пункт выдачи не найден') {
                                $this->response_errors[$k] = $v.'. Требуется правильно указать «Код терминала приёма грузов» в настройках модуля';
                            }
                        }
                        $fail_message = implode(PHP_EOL, $this->response_errors);
                    } else {
                        $fail_message = 'Заказ содержит некорректные данные';
                    }
                }
                else {
                    return true;
                }
            }
        }

        $this->fail_message = 'Ошибка подтверждения выгрузки заказа в СДЭК:'.PHP_EOL.$fail_message;

        return false;
    }





    private function getErrors(array $data) : void
    {
        foreach ($data as $item) {
            if(is_array($item)) {
                $this->getErrors($item);
            }
            else {
                $this->response_errors[] = $item;
            }
        }
    }


    private function getCommonData() : array
    {
        $key = $this->modx->getOption('eshoplogistic3_api_key');
        if(empty($key)) {
            $this->errors[] = 'key';
        }
        $service_code = $this->order_data['properties']['eshoplogistic3_data']['service']['code'] ?? '';
        if(empty($service_code)) {
            $this->errors[] = 'service';
        }
        else {
            $this->service_code = $service_code;
        }

        return [
            'key' => $key,
            'action' => 'create',
            'service' => $service_code,
            'cms' => 'modx revolution'
        ];
    }


    private function getOrderData() : array
    {
        $data = [
            'order' => [
                'id' => $this->order_data['num'], //$this->order_data['id'],
                'comment' => $this->received_data['comment'] ?? ''
            ]
        ];

        if($this->service_code == 'sdek') {
            $data['order']['type'] = $this->modx->getOption('eshoplogistic3_sdek_order_type');
        }

        return $data;
    }


    private function getSenderData() : array
    {
        $data = [];
        foreach (['company', 'name', 'email', 'phone'] as $item) {
            $value = $this->modx->getOption('eshoplogistic3_sender_'.$item);
            if(empty($value)) {
                $this->errors[] = 'sender_'.$item;
            }
            else {
                $data['sender'][$item] = $value;
            }
        }

        if(!empty($this->received_data['counterparty'])) {
            $data['sender']['requester'] = $this->received_data['counterparty'];
        }

        if(!empty($this->received_data['contact'])) {
            $data['sender']['counterparty'] = $this->received_data['contact'];
        }

        return $data;
    }


    private function getReceiverData() : array
    {
        $data = [];
        foreach (['name', 'phone'] as $item) {
            $value = $this->received_data['receiver-'.$item] ?? '';
            if(empty($value)) {
                $this->errors[] = 'receiver_'.$item;
            }
            else {
                $data['receiver'][$item] = $value;
            }
        }

        return $data;
    }


    private function getPlaces() : array
    {
        $data['places'] = [];
        $vat_rate = $this->modx->getOption('eshoplogistic3_place_vat_rate');

        foreach ($_SESSION['esl_places'][$this->order_data['id']] as $place) {

            foreach (['article', 'count', 'weight', 'length', 'width', 'height'] as $item) {
                if(empty($place[$item])) {
                    $error = 'place';
                }
            }

            $dimensions = [];
            foreach (['length', 'width', 'height'] as $item) {
                if(!empty($place[$item])) {
                    $dimensions[] = $place[$item];
                }
            }
            $place['dimensions'] = implode('*', $dimensions);

            if(isset($error)) {
                $this->errors[] = $error;
            }

            $place['vat_rate'] = $vat_rate;

            if($ms_product = $this->modx->getObject('msProductData', $place['article'])) {
                if(!empty($ms_product->article)) {
                    $place['article'] = $ms_product->article;
                }
            }

            $data['places'][] = $place;
        }

        return $data;
    }


    private function getComplement() : array
    {
        $data['complement'] = [];
        if(!empty($_SESSION['esl_additional'][$this->order_data['id']])) {
            foreach ($_SESSION['esl_additional'][$this->order_data['id']] as $item) {
                $data['complement'][$item['code']] = $item['count'];
            }
        }
        return $data;
    }


    private function getDelivery() : array
    {
        $type = $this->received_data['delivery_type'] ?? '';
        if(empty($type)) {
            $this->errors[] = 'type';
        }
        $payment = $this->received_data['payment_type'] ?? '';
        if(empty($payment)) {
            $this->errors[] = 'payment';
        }
        $cost = $this->received_data['esl-unload-price'] ?? '';
        if(empty($cost)) {
            $this->errors[] = 'cost';
        }

        $data['delivery'] = [
            'type' => $type,
            'payment' => $payment,
            'cost' => $cost
        ];

        $pick_up = !empty($this->received_data['pick_up']);
        $data['delivery']['location_from'] = [
            'pick_up' => $pick_up,
            'terminal' => $this->received_data['sender-terminal'] ?? ''
        ];

        # забот груза ТК
        if($pick_up) {
            $data['delivery']['location_from']['address'] = [
                'region' => $this->received_data['sender-region'] ?? '',
                'city' => $this->received_data['sender-city'] ?? '',
                'street' => $this->received_data['sender-street'] ?? '',
                'house' => $this->received_data['sender-house'] ?? '',
                'room' => $this->received_data['sender-room'] ?? '',
            ];
        }

        $data['delivery']['location_to'] = [
            'terminal' => $this->received_data['terminal-code'] ?? '',
            'address' => [
                'region' => $this->received_data['receiver-region'] ?? '',
                'city' => $this->received_data['receiver-city'] ?? '',
                'street' => $this->received_data['receiver-street'] ?? '',
                'house' => $this->received_data['receiver-house'] ?? '',
                'room' => $this->received_data['receiver-room'] ?? '',
            ]
        ];


        if($this->service_code == 'postrf') {
            $data['delivery']['location_from']['address']['index'] = $this->received_data['sender-index'] ?? '';
            $data['delivery']['location_to']['address']['index'] = $this->received_data['receiver-index'] ?? '';
        }

        if(!empty($this->received_data['tariff'])) {
            $data['delivery']['tariff'] = $this->received_data['tariff'];
        }

        if(!empty($this->received_data['produce_date'])) {
            $data['delivery']['produce_date'] = $this->received_data['produce_date'];
        }

        return  $data;
    }


    private function response(bool $state, array $data = []) : array
    {
        if($state) {
            $properties = $this->order_data['properties'];
            $properties['eshoplogistic3_data']['order'] = $data;
            $this->order->set('properties', $properties);
            $this->order->save();
            return $this->success(str_replace(['{id}', '{state}'], [$data['id'], $data['state']['status']['description']], $this->modx->lexicon('eshoplogistic3_order_unload_data')));
        }

        if(count($this->errors) > 0 || count($this->response_errors) > 0) {

            $message = [];
            $message[] = $this->modx->lexicon('eshoplogistic3_unload_errors_title').': ';
            $num = 0;

            foreach ($this->errors as $error) {
                $num += 1;
                $message[] = $num . '. ' . $this->modx->lexicon('eshoplogistic3_unload_error_' . $error);
            }
            foreach ($this->response_errors as $error) {
                $num += 1;
                $message[] = $num . '. ' . $error;
            }

            return $this->failure(implode('<br>', $message));

        }

        return $this->failure($this->fail_message);
    }

}

return 'eshoplogistic3OrderUnloadProcessor';
