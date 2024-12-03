<?php
class OrderUnload {

    public object $modx;
    private object $order;
    private array $order_data;
    private string $service_code;
    private array $query_data;
    public object $eshoplogistic3;

    private string $log_message_prefix = 'eshoplogistic3: ошибка автоматической выгрузки заказа';

    private array $errors = [];
    private array $response_errors;


    function __construct(object $modx, object $order)
    {
        $this->modx = $modx;
        $this->order = $order;
        $this->order_data = $order->toArray();
        $this->modx->lexicon->load('eshoplogistic3:default');
        $this->log_message_prefix .= ' # '.$order->id;
    }



    public function Process() : void
    {
        $this->setCommonData();
        if(!empty($this->service_code)) {
            $this->setOrderData();
            $this->setSenderData();
            $this->setReceiverData();
            $this->setPlaces();
            # допуслуги
            #$this->setComplement();
            $this->setDelivery();
        }

        #$this->modx->log(1, print_r($this->query_data,1));

        if(count($this->errors) > 0) {
            $message = $this->log_message_prefix.PHP_EOL;
            foreach ($this->errors as $error) {
                $message .= $error.PHP_EOL;
            }
            $this->modx->log(1, $message);
            return;
        }

        $state = false;
        $response_data = [];
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');
        if ($client = $this->eshoplogistic3->ApiQuery('delivery/order', $this->query_data)) {

            #$this->modx->log(1, print_r($client, 1));

            $response_data = $client;

            if (!empty($client['data']['order']['id'])) {

                # для СДЭКа необходимо проверять дополнительно по статусу, т.к. наличие идентификатора заказа не значит, что он отобразится в ЛК СДЭКа
                $check = true;
                if($this->query_data['service'] == 'sdek') {
                    $check = $this->checkSDEK($client['data']['order']['id']);
                }

                if($check) {
                    $state = true;
                    $_order_data = [
                        'id' => $client['data']['order']['id'],
                        'state' => $client['data']['state']
                    ];

                    if(!empty($client['data']['order']['label'])) {
                        $_order_data['print'] = $client['data']['order']['label'];
                    }

                    $properties = $this->order->get('properties');
                    if(!isset($properties['eshoplogistic3_data'])) {
                        $properties['eshoplogistic3_data'] = [];
                    }

                    $properties['eshoplogistic3_data']['order'] = $_order_data;
                    $this->order->set('properties', $properties);

                    $new_status = (int)$this->modx->getOption('eshoplogistic3_unloading_order_end_status');
                    if($new_status != 0) {
                        $miniShop2 = $this->modx->getService('miniShop2');
                        $miniShop2->changeOrderStatus($this->order->id, $new_status);
                    }

                    $this->order->save();
                }
            }
            else {
                $message = $this->log_message_prefix.PHP_EOL;
                if(!empty($client['errors'])) {
                    $this->getErrors($client['errors']);
                    $message .= implode(PHP_EOL, $this->response_errors);
                }
                $this->modx->log(1, $message);
            }
        }

        $this->modx->invokeEvent('eshoplogistic3UnloadOrder', [
            'query_data' => $this->query_data,
            'order' => $this->order,
            'response' => [
                'state' => $state,
                'data' => $response_data
            ]
        ]);
    }





    private function checkSDEK(string $order_id) : bool
    {
        if ($client = $this->eshoplogistic3->ApiQuery('delivery/order', [
            'action' => 'get',
            'service' => 'sdek',
            'order_id' => $order_id
        ])) {

            if(isset($client['data']['state']['service_status']['code'])) {
                if($client['data']['state']['service_status']['code'] == 'INVALID') {
                    if(!empty($client['data']['state']['errors'])) {
                        $this->getErrors($client['data']['state']['errors']);
                        $this->modx->log(1, $this->log_message_prefix.PHP_EOL.implode(PHP_EOL, $this->response_errors));
                    } else {
                        $this->modx->log(1, $this->log_message_prefix.PHP_EOL.' Заказ содержит некорректные данные');
                    }
                }
                else {
                    return true;
                }
            }
        }


        $this->modx->log(1, $this->log_message_prefix.PHP_EOL.' Ошибка подтверждения выгрузки заказа в СДЭК');

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




    private function setDelivery() : void
    {
        $delivery_data = $this->order_data['properties']['eshoplogistic3_data'];

        $this->query_data['delivery'] = [
            'type' => $delivery_data['type'],
            'location_from' => [
                'pick_up' => 0
            ],
            'payment' => 'already_paid',
            'cost' => $this->order->cart_cost,
            'location_to' => [
                'terminal' => ''
            ]
        ];

        if ($this->modx->getOption('eshoplogistic3_delivery_pick_up')) {
            $this->query_data['delivery']['location_from']['pick_up'] = 1;
            foreach (['region', 'city', 'street', 'house', 'room'] as $item) {
                $value = $this->modx->getOption('eshoplogistic3_sender_'.$item);
                if(empty($value)) {
                    $this->errors[] = 'В системный настройках не указано значение параметра «' . $this->modx->lexicon('setting_eshoplogistic3_sender_'.$item) . '»';
                    return;
                }
                $this->query_data['delivery']['location_from']['address'][$item] = $value;
            }
        }
        else {
            $from_terminal = $this->modx->getOption('eshoplogistic3_'.$this->service_code.'_pick_up_terminal');
            if(isset($from_terminal)) {
                if (empty($from_terminal)) {
                    $this->errors[] = 'В системный настройках не указано значение параметра «' . $this->modx->lexicon('setting_eshoplogistic3_' . $this->service_code . '_pick_up_terminal') . '»';
                    return;
                }
                $this->query_data['delivery']['location_from']['terminal'] = $from_terminal;
            }
        }

        $payments = [
            'already_paid' => $this->modx->getOption('order_payment_already_paid'),
            'cash_on_receipt' => $this->modx->getOption('order_payment_cash_on_receipt'),
            'card_on_receipt' => $this->modx->getOption('order_payment_card_on_receipt')
        ];

        foreach ($payments as $k => $v) {
            if($this->order->payment == $v) {
                $this->query_data['delivery']['payment'] = $k;
                break;
            }
        }

        if($delivery_data['type'] == 'terminal') {
            $this->query_data['delivery']['location_to']['terminal'] = $delivery_data['terminal']['code'] ?? '';
        }
        else {
            $this->modx->lexicon->load('minishop2:default');
            $address = $this->order->getOne('Address');
            foreach (['region', 'city', 'street', 'house', 'room'] as $item) {

                if ($item == 'house') {
                    $value = $address->building;
                    $lx = $this->modx->lexicon('ms2_frontend_building');
                }
                else {
                    $value = $address->get($item);
                    $lx = $this->modx->lexicon('ms2_frontend_'.$item);
                }

                if(empty($value)) {
                    $this->errors[] = 'Не указано значение для адреса доставки «' . $lx . '»';
                    return;
                }
                $this->query_data['delivery']['location_to']['address'][$item] = $value;
            }
        }

        if($this->service_code == 'postrf') {
            $this->query_data['delivery']['tariff'] = $delivery_data['tariff']['code'];
            if($delivery_data['type'] == 'door') {
                if(empty($address->index)) {
                    $this->errors[] = 'Не указано значение для адреса доставки «Индекс»';
                    return;
                }
                $this->query_data['delivery']['location_to']['address']['index'] = $address->index;
            }
        }

        if($this->service_code == 'sdek') {
            $this->query_data['delivery']['tariff'] = $delivery_data['tariff']['code'];
        }

    }





    private function setPlaces() : void
    {
        $this->query_data['places'] = [];

        $setting_default_weight = $this->modx->getOption('eshoplogistic3_order_default_weight');
        if(!empty($setting_default_weight)) {
            $default_weight = (float)$setting_default_weight;
            if (empty($default_weight)) {
                $this->errors[] = 'В системный настройках не верно указано значение параметра «' . $this->modx->lexicon('setting_eshoplogistic3_order_default_weight') . '»';
                return;
            }
        }

        $setting_default_dimensions = $this->modx->getOption('eshoplogistic3_order_default_dimensions');
        if(!empty($setting_default_dimensions)) {
            $default_dimensions = explode('*', $setting_default_dimensions);
            foreach ($default_dimensions as $k => $v) {
                $value = (int)$v;
                if(empty($v)) {
                    $this->errors[] = 'В системный настройках не верно указано значение параметра «' . $this->modx->lexicon('setting_eshoplogistic3_order_default_dimensions') . '»';
                    return;
                }
                else {
                    $default_dimensions[$k] = $value;
                }
            }
        }

        $vat_rate = $this->modx->getOption('eshoplogistic3_place_vat_rate');

        $product_common_name = $this->modx->getOption('eshoplogistic3_order_product_common_name');
        if(!empty($product_common_name) &&!$this->modx->getOption('eshoplogistic3_order_apply_everyone')) {
            $this->query_data['places'][] = [
                'article' => rand(10, 100),
                'name' => $product_common_name,
                'count' => 1,
                'price' => $this->order->cart_cost,
                'weight' => $default_weight,
                'dimensions' => implode('*', $default_dimensions),
                'vat_rate' => $vat_rate
            ];
            return;
        }


        foreach ($this->order->getMany('Products') as $product) {

            $dimensions = '';
            if (!empty($default_dimensions)) {
                $dimensions = implode('*', $default_dimensions);
            } else {
                # предполагаем, что габариты могут быть в options
                if (!empty($product->options['dimensions'])) {
                    $dimensions = $product->options['dimensions'];
                }
            }

            $article = $product->product_id;

            if($ms_product = $this->modx->getObject('msProductData', $article)) {
                if(!empty($ms_product->article)) {
                    $article = $ms_product->article;
                }
            }

            $this->query_data['places'][] = [
                'article' => $article,
                'name' => $product->name,
                'count' => $product->count,
                'price' => $product->price,
                'weight' => $default_weight ?? $product->weight,
                'dimensions' => $dimensions,
                'vat_rate' => $vat_rate
            ];
        }
    }




    private function setReceiverData() : void
    {
        $this->query_data['receiver'] = [];

        if($user_profile = $this->order->getOne('UserProfile')) {
            $receiver = $user_profile->toArray();
        }

        if(empty($receiver['fullname'])) {
            $this->errors[] = 'Отсутствует имя получателя';
        }
        else {
            $this->query_data['receiver']['name'] = $receiver['fullname'];
        }

        $phone = $receiver['mobilephone'] ?? $receiver['phone'];

        if(empty($phone)) {
            $address = $this->order->getOne('Address');
            $phone = $address->phone;
        }

        if(empty($phone)) {
            $this->errors[] = 'Отсутствует номер телефона получателя';
        }
        else {
            $this->query_data['receiver']['phone'] = $phone;
        }

        # Байкал и Кит нужно указывать дополнительные данные - пока не ясно, где они будут храниться
        # Поэтому пока работать не будет
        switch ($this->service_code) {
            case 'kit':
                $additionally = [
                    'legal' => 'kit_legal',
                    'company' => 'kit_company',
                    'requisites#unp' => 'kit_requisites_unp',
                    'requisites#bin' => 'kit_requisites_bin',
                    'requisites#inn' => 'kit_requisites_inn',
                    'requisites#kpp' => 'kit_requisites_kpp'
                ];
                break;
            case 'baikal':
                $additionally = [
                    'legal' => 'baikal_legal',
                    'identity#type' => 'baikal_identity_type',
                    'identity#series' => 'baikal_identity_series',
                    'identity#number' => 'baikal_identity_number',
                    'requisites#inn' => 'baikal_requisites_inn',
                    'requisites#kpp' => 'baikal_requisites_kpp'
                ];
                break;

            default:
                $additionally = [];
        }

        foreach (array_merge($additionally) as $k => $v) {
            $value = ''; # - тут указать источник данных
            if (empty($value)) {
                $_lx = 'eshoplogistic3_receiver_' . $v;
                $this->errors[] = 'Отсутствует значение «' . $this->modx->lexicon($_lx) . '»';
            } else {
                if(strpos($k, '#')) {
                    $_k = explode('#', $k);
                    $this->query_data['receiver'][$_k[0]][$_k[1]] = $value;
                }
                else {
                    $this->query_data['receiver'][$k] = $value;
                }
            }
        }
    }




    private function setSenderData() : void
    {
        $this->query_data['sender'] = [];

        $settings = [
            'company' => 'sender_company',
            'name' => 'sender_name',
            'email' => 'sender_email',
            'phone' => 'sender_phone',
        ];

        switch ($this->service_code) {
            case 'delline':
                $additionally = [
                    'requester' => 'delline_sender_requester',
                    'counterparty' => 'delline_sender_counterparty'
                ];
                break;
            case 'kit':
                $additionally = [
                    'requester' => 'kit_sender_requester'
                ];
                break;
            case 'pecom':
                $additionally = [
                    'identity#type' => 'pecom_sender_identity_type',
                    'identity#series' => 'pecom_sender_identity_series',
                    'identity#number' => 'pecom_sender_identity_number',
                    'identity#date' => 'pecom_sender_identity_date'
                ];
                break;
            case 'baikal':
                $additionally = [
                    'legal' => 'baikal_sender_legal',
                    'identity#type' => 'baikal_sender_identity_type',
                    'identity#series' => 'baikal_sender_identity_series',
                    'identity#number' => 'baikal_sender_identity_number',
                    'requisites#inn' => 'sender_requisites_inn',
                    'requisites#kpp' => 'sender_requisites_kpp'
                ];
                break;

            default:
                $additionally = [];
        }

        foreach (array_merge($settings, $additionally) as $k => $v) {
            $value = $this->modx->getOption('eshoplogistic3_' . $v);
            if (empty($value)) {
                $setting = 'setting_eshoplogistic3_' . $v;
                $this->errors[] = 'В системный настройках не указан параметр «' . $this->modx->lexicon($setting) . '»';
            } else {
                if(strpos($k, '#')) {
                    $_k = explode('#', $k);
                    $this->query_data['sender'][$_k[0]][$_k[1]] = $value;
                }
                else {
                    $this->query_data['sender'][$k] = $value;
                }
            }
        }
    }




    private function setCommonData() : void
    {
        $key = $this->modx->getOption('eshoplogistic3_api_key');
        if(empty($key)) {
            $this->errors[] = 'В системный настройках не указан Ключ API eShopLogistic';
        }
        $service_code = $this->order_data['properties']['eshoplogistic3_data']['service']['code'] ?? '';
        if(empty($service_code)) {
            $this->errors[] = 'В рассчётных данных доставки отсутствует код службы';
        }
        else {
            $this->service_code = $service_code;
        }

        $this->query_data = [
            'key' => $key,
            'action' => 'create',
            'service' => $service_code,
            'cms' => 'modx revolution'
        ];
    }




    private function setOrderData() : void
    {
        $this->query_data['order'] = [
            'id' => $this->order_data['id'],
            'comment' => $this->received_data['comment'] ?? ''
        ];

        if($this->service_code == 'sdek') {
            $this->query_data['order']['type'] = $this->modx->getOption('eshoplogistic3_sdek_order_type');
        }

        if($this->service_code == 'boxberry') {
            $this->query_data['order']['type'] = $this->modx->getOption('eshoplogistic3_boxberry_order_type');
            $this->query_data['order']['packing_type'] = $this->modx->getOption('eshoplogistic3_boxberry_order_packing_type');
        }

    }
}