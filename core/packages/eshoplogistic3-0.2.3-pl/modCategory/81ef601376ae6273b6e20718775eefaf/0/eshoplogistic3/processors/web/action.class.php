<?php

class eShopLogistic3ActionProcessor extends modProcessor
{

    public function process() : string
	{
        $out = [];
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        # запросы из виджетов
        if(!empty($_POST['method'])) {
            $query_data = @$_POST;
            unset($query_data['method']);

            $cache_key = md5($_POST['method'].json_encode($query_data));
            $cache_data = $this->eshoplogistic3->Cache($cache_key);

            if(!empty($cache_data)) {
                $out = $cache_data;
            }
            else {
                $raw = ($_POST['method'] == 'widget/send') ? $_POST['raw'] : '';

                if ($request = $this->eshoplogistic3->ApiQuery(trim($_POST['method']), $query_data, $raw)) {
                    if (!empty($request)) {
                        if (is_array($request)) {
                            if(!empty($request['http_status'])) {
                                if($request['http_status'] == 200) {
                                    if (!in_array($_POST['method'], ['widget/client', 'widget/send'])) {
                                        $this->eshoplogistic3->Cache($cache_key, 'create', $request);
                                    }
                                }
                            }
                            $out = $request;
                        }
                    }
                }
            }
        }
        # пришёл заказ из виджета
        elseif (!empty($_POST['secret'])) {
            $out = $this->eshoplogistic3->createOrder(@$_POST);
        }
        # запросы с фронта (оформление заказа в корзине)
        else {
            if (!empty($_POST['action'])) {

                switch ($_POST['action']) {

                    case 'search':
                        if (!empty($_POST['target'])) {
                            $out = $this->getSettlementList($_POST['target']);
                        }
                        break;

                    case 'geo':
                        $out = $this->getSettlement();
                        /*if(empty($out['fias'])) {
                            $_POST['target'] = 'Москва';
                            $out = $this->getSettlement();
                        }*/
                        break;

                    case 'offers':
                        $out = $this->getOffers();
                        break;

                    case 'settlement':
                        $this->setSettlement();
                        break;

                    case 'delivery':
                        $out = $this->setDeliveryData();
                }
            }
        }

        return $this->modx->toJSON($out);
    }



    private function setDeliveryData(): array
    {
        $info = '';

        if(!empty($_POST['data'])) {
            if($data = json_decode($_POST['data'], 1)) {
                if(is_array($data)) {
                    if(!empty($data['event'])) {

                        $event = $data['event'];
                        unset($data['event']);

                        $miniShop2 = $this->modx->getService('miniShop2');
                        $miniShop2->initialize($this->modx->context->key);
                        $ms2_config = $miniShop2->order->config;

                        $msOrder = null;
                        if(!empty($ms2_config['order']['order_id'])) {
                            $msOrder = $this->modx->getObject('msOrder', $ms2_config['order']['order_id']);
                            $properties = $msOrder->get('properties');
                        }

                        switch ($event) {

                            case 'onAllServicesLoaded':
                                if(!empty($msOrder)) {
                                    if(!empty($properties['eshoplogistic3_data'])) {
                                        #$data = $properties['eshoplogistic3_data'];
                                        unset($properties['eshoplogistic3_data']);
                                        $msOrder->set('properties', $properties);
                                        $msOrder->save();
                                    }
                                }
                                else {
                                    $miniShop2->order->remove('eshoplogistic3_data');
                                }
                                break;

                            case 'onSelectedService':
                                if(!empty($data['delivery_id'])) {
                                    $delivery_id = $data['delivery_id'];
                                    unset($data['delivery_id']);
                                    $miniShop2->order->add('delivery', $delivery_id);

                                    # заказ хранится в БД
                                    if(!empty($msOrder)) {
                                        $properties['eshoplogistic3_data'] = $data;
                                        $msOrder->set('properties',$properties);
                                        $msOrder->save();
                                    }
                                    # заказ в сессии
                                    else {
                                        $miniShop2->order->add('eshoplogistic3_data', json_encode($data));
                                    }
                                }

                        }

                        $chunk = $this->modx->getOption('eshoplogistic3_chunk_info');
                        if (!empty($chunk)) {
                            $info = $this->eshoplogistic3->pdoTools->getChunk($chunk, ['data' => $data]);
                        } else {
                            $this->modx->log(1, 'eShopLogistic3: не указан чанк для вывода информации: eshoplogistic3_chunk_info');
                        }

                    }
                }
            }
        }

        return ['info' => $info];
    }


    private function getOffers() : array
    {
        return $this->eshoplogistic3->getOffers();
    }


    private function getSettlement() : array
    {
        $out = [];

        if(!empty($_POST['target'])) {

            $params = [
                'target' => trim($_POST['target'])
            ];

            if(!empty($_POST['region'])) {
                $params['region'] = trim($_POST['region']);
            }

            if($result = $this->eshoplogistic3->ApiQuery('locality/search', $params)) {
                if(!empty($result['data'][0]['fias'])) {
                    return [
                        'name' => $result['data'][0]['type'].' '.$result['data'][0]['name'],
                        'region' => $result['data'][0]['region'],
                        'fias' => $result['data'][0]['fias'],
                        'services' => $result['data'][0]['services']
                    ];
                }
            }
        }


        if($settlement = $this->eshoplogistic3->ApiQuery('locality/geo', ['ip' => $_SERVER['REMOTE_ADDR']])) {
            if(!empty($settlement['data']['fias'])) {
                $out = [
                    'name' => $settlement['data']['type'].' '.$settlement['data']['name'],
                    'region' => $settlement['data']['region'],
                    'fias' => $settlement['data']['fias'],
                    'services' => $settlement['data']['services']
                ];
            }
        }

        return $out;
    }


    private function getSettlementList(string $target) : array
    {
        $settlements = $this->eshoplogistic3->ApiQuery('locality/search', ['target' => $target]);

        $regions = [];

        if(!empty($settlements['data'])) {
            if(is_array($settlements['data'])) {
                foreach($settlements['data'] as $settlement) {

                    $region = (!empty($settlement['region'])) ? $settlement['region'] : $settlement['country'];

                    if(!isset($regions[$region])) {
                        $regions[$region] = [];
                    }

                    $regions[$region][] = [
                        'rank' => $settlement['rank'],
                        'name' => $settlement['name'],
                        'region' => $region,
                        'type' => $settlement['type'],
                        'fias' => $settlement['fias'],
                        'services' => $settlement['services']
                    ];
                }
            }
        }

        return $regions;
    }
	
}

return 'eShopLogistic3ActionProcessor';
