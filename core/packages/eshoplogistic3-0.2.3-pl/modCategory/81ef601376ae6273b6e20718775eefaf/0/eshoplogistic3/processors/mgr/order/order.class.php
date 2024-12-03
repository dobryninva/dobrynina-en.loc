<?php

class eshoplogistic3OrderProcessor extends modProcessor {

    public $permission = '';


    public function process()
    {
        $data = [
            'price' => '',
            'base_price' => '',
            'time' => '',
            'service' => [],
            'mode' => '',
            'address' => ''
        ];

        if($order_id = $this->getProperty('order_id')) {
            if($order = $this->modx->getObject('msOrder', $order_id)) {

                $properties = $order->get('properties');

                # фикс для заказов, сдланных ранее обновления версии 0.1.2
                if(!empty($properties['esl']['service']['code'])) {
                    $properties['eshoplogistic3_data'] = $properties['esl'];
                    unset($properties['esl']);
                    $order->set('properties', $properties);
                    $order->save();
                }

                if(!empty($properties['eshoplogistic3_data']['service']['code'])) {

                    $this->modx->lexicon->load('eshoplogistic3:default');

                    $time = $properties['eshoplogistic3_data']['time']['value'] ?? '';
                    if(!empty($properties['eshoplogistic3_data']['time']['unit'])) {
                        $time = $time.' '.$properties['eshoplogistic3_data']['time']['unit'];
                    }

                    $mode = $type = '';
                    if(!empty($properties['eshoplogistic3_data']['type'])) {
                        $type = $properties['eshoplogistic3_data']['type'];
                        $mode = $this->modx->lexicon('eshoplogistic3_delivery_type_'.$properties['eshoplogistic3_data']['type']);
                    }

                    $terminal = [
                        'name' => '',
                        'code' => '',
                        'address' => '',
                        'text' => ''
                    ];
                    if(!empty($properties['eshoplogistic3_data']['terminal']['address'])) {
                        $terminal['text'] = $properties['eshoplogistic3_data']['terminal']['address'];
                        $terminal['address'] = $properties['eshoplogistic3_data']['terminal']['address'];
                        if(!empty($properties['eshoplogistic3_data']['terminal']['code'])) {
                            $terminal['text'] .= ', код: '.$properties['eshoplogistic3_data']['terminal']['code'];
                            $terminal['code'] = $properties['eshoplogistic3_data']['terminal']['code'];
                        }
                        if(!empty($properties['eshoplogistic3_data']['terminal']['name'])) {
                            $terminal['text'] .= ', название: '.$properties['eshoplogistic3_data']['terminal']['name'];
                            $terminal['name'] = $properties['eshoplogistic3_data']['terminal']['name'];
                        }
                    }

                    $user = $order->getOne('User');
                    $profile = $user->getOne('Profile');
                    $address = $order->getOne('Address');

                    $phone = $address->phone;
                    if(empty($phone)) {
                        $phone = $profile->mobilephone ?? $profile->phone;
                    }
					
					
					$index = $address->index;
                    if(empty($index) && !empty($terminal['code']) && $properties['eshoplogistic3_data']['service']['code'] == 'postrf') {
                        if(preg_match('/-(\d{6,})$/', $terminal['code'], $mts)) {
                            if(!empty($mts[1])) {
                                $index = $mts[1];
                            }
                        }
                    }

                    $data = [
                        'allow_unload' => (bool)$this->modx->getOption('eshoplogistic3_allow_unloading_orders'),
                        'pick_up' => (bool)$this->modx->getOption('eshoplogistic3_'.$properties['eshoplogistic3_data']['service']['code'].'_pick_up'),
                        'price' => $properties['eshoplogistic3_data']['price']['value'] ?? '',
                        'base_price' => $properties['eshoplogistic3_data']['price']['base'] ?? '',
                        'time' => $time,
                        'service' => [
                            'code' => $properties['eshoplogistic3_data']['service']['code'],
                            'name' => $properties['eshoplogistic3_data']['service']['name'] ?? ''
                        ],
                        'type' => $type,
                        'mode' => $mode,
                        'terminal' => $terminal,
                        'receiver' => [
                            'name' => $address->receiver ?? $profile->fullname,
                            'email' => $address->email ?? $profile->email,
                            'phone' => $phone,
                            'address' => [
                                'region' => $address->region,
                                'city' => $address->city,
                                'street' => $address->street,
                                'house' => $address->building,
                                'room' => $address->room,
								'index' => $index
                            ]
                        ],
                        'sender' => [
                            'address' => [
                                'region' => $this->modx->getOption('eshoplogistic3_sender_region') ?? '',
                                'city' => $this->modx->getOption('eshoplogistic3_sender_city') ?? '',
                                'street' => $this->modx->getOption('eshoplogistic3_sender_street') ?? '',
                                'house' => $this->modx->getOption('eshoplogistic3_sender_house') ?? '',
                                'room' => $this->modx->getOption('eshoplogistic3_sender_room') ?? '',
								'index' => $this->modx->getOption('eshoplogistic3_sender_index') ?? ''
                            ],
                            'terminal' => $this->modx->getOption('eshoplogistic3_'.$properties['eshoplogistic3_data']['service']['code'].'_pick_up_terminal') ?? ''
                        ]
                    ];


                    if(!empty($properties['eshoplogistic3_data']['tariff'])) {
                        $data['tariff'] = $properties['eshoplogistic3_data']['tariff'];
                    }

                    if($properties['eshoplogistic3_data']['service']['code'] == 'sdek') {
                        $data['order_type'] = $this->modx->getOption('eshoplogistic3_sdek_order_type');
                    }

                    if($properties['eshoplogistic3_data']['service']['code'] == 'boxberry') {
                        $data['boxberry_order_type'] = (int)$this->modx->getOption('eshoplogistic3_boxberry_order_type');
                        $data['boxberry_packing_type'] = (int)$this->modx->getOption('eshoplogistic3_boxberry_order_packing_type');
                    }

                    $data['order_id'] = $properties['eshoplogistic3_data']['order']['id'] ?? '-';
                    $data['order_number'] = $properties['eshoplogistic3_data']['order']['number'] ?? '-';
                    $data['order_state'] = $properties['eshoplogistic3_data']['order']['state']['status']['description'] ?? $this->modx->lexicon('eshoplogistic3_delivery_order_no');
                    $data['order_state_code'] = $properties['eshoplogistic3_data']['order']['state']['status']['code'] ?? '-';
                    $data['order_cost'] = $properties['eshoplogistic3_data']['order']['cost'] ?? '';
                    $data['order_tracking'] = $properties['eshoplogistic3_data']['order']['tracking'] ?? '';

                    $order_config = $this->getDeliveriesConfig($properties['eshoplogistic3_data']['service']['code']);

                    $data['order'] = [
                        'create' => $order_config['create'] ?? 0,
                        'print' => $order_config['print'] ?? 0
                    ];

                    if(empty($properties['eshoplogistic3_data']['order']['id'])) {
                        $data['order']['print'] = 0;
                    }
                }
            }
        }


        return $this->modx->toJSON([
            'success' => true,
            'delivery' => $data
        ]);
    }



    private function getDeliveriesConfig(string $service_code) : array
    {
        $config = [];

        $eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        if(!file_exists($eshoplogistic3->deliveries_config_file)) {
            if($client = $eshoplogistic3->ApiQuery('delivery/services')) {
                if (!empty($client['data'])) {
                    file_put_contents($eshoplogistic3->deliveries_config_file, json_encode($client['data']));
                }
            }
        }

        if(file_exists($eshoplogistic3->deliveries_config_file)) {
            if($str = file_get_contents($eshoplogistic3->deliveries_config_file)) {
                if($data = json_decode($str,1)) {
                    if(is_array($data)) {
                        foreach ($data as $item) {
                            if($item['code'] == $service_code && !empty($item['properties']['order'])) {
                                return $item['properties']['order'];
                            }
                        }
                    }
                }
            }
        }

        return $config;
    }

}

return 'eshoplogistic3OrderProcessor';
