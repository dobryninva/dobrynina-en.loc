<?php
class Order {

    public object $modx;
    public object $ms2;

    private string $log_message_prefix = 'eshoplogistic3: ошибка создания заказа из виджета. ';

    private array $raw_order_data;
    private array $offers;
    private array $user_data;
    private array $order_data = [
        'user_id' => 0,
        'delivery_cost' => 0,
        'createdon' => '',
        'num' => '',
        'delivery' => 0,
        'payment' => 0,
        'status' => 1,
        'properties' => [],
        'context' => '',
        'weight' => 0,
        'cost' => 0,
        'cart_cost' => 0,
        'order_comment' => '' // пока такого поля в виджете нет
    ];
    private array $errors = [];
    private array $response = [
        'success' => false,
        'message' => ''
    ];


    function __construct(object $modx)
    {
        $this->modx = $modx;
    }


    public function Process(array $order_data) : array
    {
        $this->raw_order_data = $order_data;
        if($this->checkSecret()) {
            if($this->Validate()) {
                if($this->createOrder()) {
                    $this->response['success'] = true;
                    $this->response['message'] = str_replace('{num}', $this->order_data['num'], trim($this->modx->getOption('eshoplogistic3_message_order_success')));
                }
            }
            else {
                $this->modx->log(1, $this->log_message_prefix.'Ошибки в полученных данных: '.print_r($this->errors,1));
                $this->modx->log(1, $this->log_message_prefix.'Полученные данные: '.print_r($this->raw_order_data,1));
            }
        }
        return $this->response;
    }


    private function createOrder() : bool
    {
        if($this->ms2Init()) {

            $this->ms2->order->clean();

            $this->getPayment();

            $this->order_data['createdon'] = date('Y-m-d H:i:s');
            $this->order_data['num'] = trim($this->modx->getOption('eshoplogistic3_order_prefix')).$this->ms2->order->getNewOrderNum();

            foreach(['receiver' => '', 'email' => '', 'phone' => ''] as $k => $v) {
                $value = $this->user_data[$k] ?? '';
                $this->ms2->order->add($k, $value);
            }

            $this->order_data['user_id'] = $this->ms2->getCustomerId();

            $order = $this->modx->newObject('msOrder');
            $order->fromArray($this->order_data);

            $order_products = [];
            foreach ($this->offers as $offer) {
                $order_product = $this->modx->newObject('msOrderProduct');
                $order_product->fromArray($offer);
                $order_products[] = $order_product;
            }
            $order->addMany($order_products);

            $response = $this->ms2->invokeEvent('msOnBeforeCreateOrder', [
                'msOrder' => $order,
                'order' => $this->ms2->order
            ]);

            if (!$response['success']) {
                $this->modx->log(1, $this->log_message_prefix.'Minishop2 msOnBeforeCreateOrder error: '.$response['message']);
                return false;
            }

            #адрес
            $text_address = '';
            if(!empty($this->raw_order_data['delivery']['type'])) {
                if($this->raw_order_data['delivery']['type'] == 'door') {
                    $text_address = $this->raw_order_data['delivery']['address'] ?? '';
                }
            }

            $city = '';
            if(!empty($this->raw_order_data['settlement']['name'])) {
                $city = $this->raw_order_data['settlement']['name'];
                if(!empty($this->raw_order_data['settlement']['type'])) {
                    $city = $this->raw_order_data['settlement']['type'].' '.$city;
                }
            }

            $address = $this->modx->newObject('msOrderAddress');
            $address->fromArray(array_merge(['createdon' => $this->order_data['createdon']], [
                'city' => $city,
                'country' => $this->raw_order_data['settlement']['country'] ?? '',
                'region' => $this->raw_order_data['settlement']['region'] ?? '',
                'text_address' => $text_address
            ]));
            $order->addOne($address);

            if ($order->save()) {
                $this->ms2->invokeEvent('msOnCreateOrder', [
                    'msOrder' => $order,
                    'order' => $this->ms2->order,
                    'esl_mode_widget' => 1
                ]);
                $this->ms2->order->clean();
                $this->ms2->changeOrderStatus($order->get('id'), 1);

                #$this->modx->log(1, print_r($this->raw_order_data,1));

                if (!empty($this->raw_order_data['delivery'])) {
                    $eshoplogistic3 = $this->modx->getService('eshoplogistic3');
                    $eshoplogistic3->setEslData($order, $this->prepareEslData());
                }

                return true;
            }
            else {
                $this->modx->log(1, $this->log_message_prefix.'Ошибка создания заказа Minishop2');
            }
        }
        else {
            $this->modx->log(1, $this->log_message_prefix.'Ошибка инициализации Minishop2');
        }

        return false;
    }


    private function prepareEslData(): array
    {
        $data = [];

        if(!empty($this->raw_order_data['settlement']['name'])) {
            $data['settlement'] = [
                'name' => $this->raw_order_data['settlement']['name'],
                'fias' => $this->raw_order_data['settlement']['fias'] ?? '',
                'region' => $this->raw_order_data['settlement']['region'] ?? ''
            ];
        }

        if(!empty($this->raw_order_data['delivery']['code'])) {
            $data['service'] = [
                'code' => $this->raw_order_data['delivery']['code'],
                'name' => $this->raw_order_data['delivery']['name'] ?? ''
            ];
        }

        if(!empty($this->raw_order_data['delivery']['data']['tariff']['code'])) {
            $data['tariff'] = [
                'code' => $this->raw_order_data['delivery']['data']['tariff']['code'],
                'name' => $this->raw_order_data['delivery']['data']['tariff']['name'] ?? ''
            ];
        }

        $data['type'] = $this->raw_order_data['delivery']['type'] ?? 'door';

        if(isset($this->raw_order_data['delivery']['data']['price']['value'])) {
            $data['price'] = [
                'value' => $this->raw_order_data['delivery']['data']['price']['value'],
                'unit' => $this->raw_order_data['delivery']['data']['price']['unit'] ?? ''
            ];
            if(isset($this->raw_order_data['delivery']['data']['price']['base'])) {
                $data['price']['base'] = $this->raw_order_data['delivery']['data']['price']['base'];
            }
        }

        if(isset($this->raw_order_data['delivery']['data']['time']['value'])) {
            $data['time'] = [
                'value' => $this->raw_order_data['delivery']['data']['time']['value'],
                'unit' => $this->raw_order_data['delivery']['data']['time']['unit'] ?? '',
                'text' => $this->raw_order_data['delivery']['data']['time']['text'] ?? ''
            ];
        }

        if(isset($this->raw_order_data['delivery']['pvz']['code'])) {
            $data['terminal'] = [
                'code' => $this->raw_order_data['delivery']['pvz']['code'],
                'name' => $this->raw_order_data['delivery']['pvz']['name'] ?? '',
                'address' => $this->raw_order_data['delivery']['pvz']['address'] ?? '',
                'phones' => $this->raw_order_data['delivery']['pvz']['phones'] ?? '',
                'workTime' => $this->raw_order_data['delivery']['pvz']['workTime'] ?? '',
                'lon' => $this->raw_order_data['delivery']['pvz']['lon'] ?? '',
                'lat' => $this->raw_order_data['delivery']['pvz']['lat'] ?? '',
                'is_postamat' => $this->raw_order_data['delivery']['pvz']['is_postamat'] ?? 0
            ];
        }

        if(isset($this->raw_order_data['delivery']['data']['comment'])) {
            $data['comments'] = [
                'type' => $this->raw_order_data['delivery']['data']['comment']
            ];
        }

        return $data;
    }



    private function Validate() : bool
    {
        # проверка наличия данных покупателя
        if(!empty($this->raw_order_data['receiver']['email'])) {
            if (filter_var($this->raw_order_data['receiver']['email'], FILTER_VALIDATE_EMAIL)) {
                $this->user_data = [
                    'receiver' => $this->raw_order_data['receiver']['name'] ?? 'unknown',
                    'email' => $this->raw_order_data['receiver']['email'],
                    'phone' => $this->raw_order_data['receiver']['phone'] ?? ''
                ];
            }
            else {
                $this->errors[] = 'Не верно указан электронный адрес покупателя';
            }
        }
        else {
            $this->errors[] = 'Не указан электронный адрес покупателя';
        }

        # определим тип доставки
        if($delivery = $this->modx->getObject('msDelivery', ['class' => 'eShopLogisticHandler'])) {
            $this->order_data['delivery'] = $delivery->id;
            $this->order_data['delivery_cost'] = $this->raw_order_data['delivery']['data']['price']['value'] ?? 0;
        }
        else {
            $this->errors[] = 'Не определён тип доставки';
        }

        # проверка товаров
        if(!empty($this->raw_order_data['offers'])) {
            if(is_array($this->raw_order_data['offers'])) {
                foreach ($this->raw_order_data['offers'] as $offer) {
                    if(!empty($offer['article'])) {
                        if ($product = $this->modx->getObject('msProduct', (int)$offer['article'])) {

                            $weight = $offer['weight'] ?? $product->get('weight');
                            $price = $offer['price'] ?? $product->get('price');
                            $count = $offer['count'] ?? 1;

                            $this->order_data['weight'] += $weight * $count;
                            $this->order_data['cart_cost'] += $price * $count;

                            $item = [
                                'product_id' => $product->id,
                                'name' => $product->pagetitle,
                                'count' => (int)$count,
                                'price' => $price,
                                'weight' => $weight,
                                'cost' => $price * $count
                            ];

                            # определим опции
                            if(!empty($offer['options'])) {
                                if(is_array($offer['options'])) {
                                    foreach ($offer['options'] as $key => $data) {
                                        if(!empty($data['value'])) {
                                            $item['options'][$key] = $data['value'];
                                        }
                                    }
                                }
                            }

                            $this->offers[] = $item;
                        }
                    }
                }
                $this->order_data['cost'] = $this->order_data['cart_cost'] + $this->order_data['delivery_cost'];
            }
        }

        if(empty($this->offers)) {
            $this->errors[] = 'Отсутствуют или не определены товарные позиции';
        }


        if(count($this->errors) > 0) {
            return false;
        }

        return true;
    }


    private function checkSecret() : bool
    {
        if(!empty($this->raw_order_data['secret'])) {
            $keys = explode(',', $this->modx->getOption('eshoplogistic3_widget_secrets'));
            if(is_array($keys)){
                $keys = array_map('trim', $keys);
                foreach($keys as $key) {
                    if($this->raw_order_data['secret'] == $key) {
                        return true;
                    }
                }
            }
        }
        $this->modx->log(1, $this->log_message_prefix.'Не определён секретный ключ виджета.');
        return false;
    }


    private function ms2Init() : bool
    {
        if(is_dir($this->modx->getOption('core_path').'components/minishop2/model/minishop2/')) {
            $this->ms2 = $this->modx->getService('miniShop2');
            if ($this->ms2 instanceof miniShop2) {
                $this->order_data['context'] = $this->modx->context->key ?? 'web';
                $this->ms2->initialize($this->order_data['context'], ['json_response' => true]);
                return true;
            }
        }
        return false;
    }


    private function getPayment() : void
    {
        $id = 0;

        if(!empty($this->raw_order_data['payment']['key'])) {
            $payment_key = 'eshoplogistic3_payment_'.$this->raw_order_data['payment']['key'];
            $q = $this->modx->newQuery('modSystemSetting', ['key:LIKE' => 'eshoplogistic3_payment_%']);
            foreach ($this->modx->getIterator('modSystemSetting', $q) as $item) {
                if ($payment_key == $item->key) {
                    $payment_value = $item->value . '<br>';
                }
            }
            if (!empty($payment_value)) {
                $ids = explode(',', $payment_value);
                $id = $ids[0];
            }
        }

        $this->order_data['payment'] = $id;
    }

}