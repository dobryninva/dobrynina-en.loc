<?php

class eshoplogistic3AdditionalProcessor extends modProcessor
{
    private array $service_additional = [];
    private array $additional = [];
    private string $service;
    public int $order_id;

    public function process()
    {
        $properties = $this->getProperties();

        foreach(['order_id', 'service'] as $field) {
            if(empty($properties[$field])) {
                return $this->modx->toJSON([
                    'success' => false
                ]);
            }
        }

        $this->service = trim($properties['service']);
        $this->order_id = trim($properties['order_id']);

        $mode = $properties['mode'] ?? 'list';

        $this->getServiceAdditional();

        $this->additional = $_SESSION['esl_additional'][$this->order_id] ?? [];

        //$this->modx->log(1, print_r($_SESSION['esl_additional'], 1));

        switch ($mode) {

            case 'get':
                return $this->modx->toJSON([
                    'success' => true,
                    'object' => $this->getAdditional()
                ]);

            case 'create':
                $this->createAdditional();
                return $this->modx->toJSON([
                    'success' => true,
                    'message' => '',
                    'total' => 0,
                    'data' => [],
                    'object' => $this->createAdditional()
                ]);

            case 'update':
                return $this->modx->toJSON([
                    'success' => true,
                    'message' => '',
                    'total' => 0,
                    'data' => [],
                    'object' => $this->updateAdditional()
                ]);

            case 'remove':
                $this->removeAdditional();
                return $this->modx->toJSON([
                    'success' => true,
                    'message' => '',
                    'total' => 0,
                    'data' => [],
                    'object' => []
                ]);

            case 'list_item':
                $type = $properties['type'] ?? '';
                return $this->modx->toJSON([
                    'success' => true,
                    'total' => 1,
                    'results' => $this->getAdditionalItems($type)
                ]);

            case 'list_type':
                return $this->modx->toJSON([
                    'success' => true,
                    'total' => 1,
                    'results' => $this->getAdditionalTypes()
                ]);

            default:
                $this->prepareItems();
                return $this->modx->toJSON([
                    'success' => true,
                    'total' => 1,
                    'results' => $this->additional
                ]);
        }
    }




    private function getAdditional() : array
    {
        if($id = $this->getProperty('id')) {
            foreach ($this->additional as $additional) {
                if($id == $additional['code']) {
                    $additional['name'] = $this->getName($additional['code']);
                    return $additional;
                }
            }
        }
        return [];
    }




    private function updateAdditional() : array
    {
        if($code = trim($this->getProperty('code'))) {
            if($count = trim($this->getProperty('count'))) {
                foreach ($this->additional as $k => $v) {
                    if ($code == $v['code']) {
                        $this->additional[$k]['count'] = $count;
                        $_SESSION['esl_additional'][$this->order_id] = $this->additional;
                        return $this->additional[$k];
                    }
                }
            }
        }
        return [];
    }




    private function removeAdditional() : void
    {
        if($ids = trim($this->getProperty('ids'))) {
            if($ids = json_decode($ids, 1)) {
                foreach ($this->additional as $k => $place) {
                    if(in_array($place['code'], $ids)) {
                        unset($this->additional[$k]);
                    }
                }
            }
        }
        $_SESSION['esl_additional'][$this->order_id] = $this->additional;
    }



    private function createAdditional() : array
    {
        $additional = [];
        foreach(['type', 'code', 'count'] as $field) {
            if($value = trim($this->getProperty($field))) {
                $additional[$field] = $value;
            }
        }

        if(count($additional) == 3) {

            $isset = false;
            foreach($this->additional as $k => $item) {
                if($item['code'] == $additional['code']) {
                    $this->additional[$k] = $additional;
                    $isset = true;
                    break;
                }
            }

            if(!$isset) {
                $this->additional[] = $additional;
            }

            $_SESSION['esl_additional'][$this->order_id] = $this->additional;

            return $additional;
        }

        return [];
    }



    private function getName(string $code) : string
    {
        $name = '';
        foreach ($this->service_additional as $type => $items) {
            foreach ($items as $item) {
                if($item['code'] == $code) {
                    $name = $item['name'];
                    break;
                }
            }
        }
        return $name;
    }



    private function getServiceAdditional() : void
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        $cache_key = md5('additional'.$this->service);
        $cache_data = $this->eshoplogistic3->Cache($cache_key);

        if(!empty($cache_data)) {
            $this->service_additional = $cache_data;
        }
        else {
            if ($client = $this->eshoplogistic3->ApiQuery('service/additional', ['service' => $this->service])) {
                if (!empty($client['data'])) {
                    foreach ($client['data'] as $type => $item) {
                        foreach($item as $code => $name) {
                            $this->service_additional[$type][] = [
                                'code' => $code,
                                'name' => $name
                            ];
                        }
                    }
                    if(count($this->service_additional) > 0) {
                        $this->eshoplogistic3->Cache($cache_key, 'create', $this->service_additional);
                    }
                }
            }
        }
    }



    private function getAdditionalTypes() : array
    {
        $list = [];
        $types = array_keys($this->service_additional);
        foreach ($types as $type) {
            $list[] = [
                'code' => $type,
                'name' => $this->modx->lexicon('eshoplogistic3_additional_type_'.$type)
            ];
        }
        return $list;
    }



    private function getAdditionalItems(string $filter_type = '') : array
    {
        $list = [];
        foreach ($this->service_additional as $type => $items) {
            if(!empty($filter_type)) {
                if($filter_type != $type) {
                    continue;
                }
            }
            foreach ($items as $item) {
                $list[] = [
                    'code' => $item['code'],
                    'name' => $item['name']
                ];
            }
        }
        return $list;
    }



    private function prepareItems() : void
    {
        $actions = [
            [
                'cls' => '',
                'icon' => 'icon icon-edit',
                'title' => $this->modx->lexicon('eshoplogistic3_additional_update'),
                'action' => 'updateItem',
                'button' => true,
                'menu' => true
            ], [
                'cls' => '',
                'icon' => 'icon icon-trash-o action-red',
                'title' => $this->modx->lexicon('eshoplogistic3_additional_remove'),
                'multiple' => $this->modx->lexicon('eshoplogistic3_additionals_remove'),
                'action' => 'removeItem',
                'button' => true,
                'menu' => true
            ]
        ];

        foreach ($this->additional as $k => $item) {
            $this->additional[$k]['type'] = $this->modx->lexicon('eshoplogistic3_additional_type_'.$item['type']);
            $this->additional[$k]['name'] = $this->getName($this->additional[$k]['code']);
            $this->additional[$k]['actions'] = $actions;
        }
    }

}

return 'eshoplogistic3AdditionalProcessor';