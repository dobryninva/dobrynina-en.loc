<?php

class eshoplogistic3UnloadPlacesProcessor extends modProcessor
{

    public int $order_id;
    private array $places = [];
    private object $eshoplogistic3;

    private array $service_settings = [];



    public function process()
    {
        $order_id = $this->getProperty('order_id');

        if(!$order_id) {
            return $this->modx->toJSON([
                'success' => false
            ]);
        }
        else {
            $this->order_id = $order_id;
        }

        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        $this->getServiceSettings();

        #unset($_SESSION['esl_places']);
        #$properties = $this->getProperties();
        #$this->modx->log(1 , print_r($properties,1));

        if(!$mode = $this->getProperty('mode')) {
            $mode = 'list';
        }

        $this->getPlaces();

        switch ($mode) {

            case 'get':
                return $this->modx->toJSON([
                    'success' => true,
                    'object' => $this->getPlace()
                ]);

            case 'create':
                return $this->modx->toJSON([
                    'success' => true,
                    'message' => '',
                    'total' => 0,
                    'data' => [],
                    'object' => $this->createPlace()
                ]);

            case 'update':
                return $this->modx->toJSON([
                    'success' => true,
                    'message' => '',
                    'total' => 0,
                    'data' => [],
                    'object' => $this->updatePlace()
                ]);

            case 'remove':
                $this->removePlaces();
                return $this->modx->toJSON([
                    'success' => true,
                    'message' => '',
                    'total' => 0,
                    'data' => [],
                    'object' => []
                ]);

            default:
                $this->preparePlaces();
                return $this->modx->toJSON([
                    'success' => true,
                    'total' => 1,
                    'results' => $this->places
                ]);
        }

    }



    private function removePlaces() : void
    {
        if($ids = trim($this->getProperty('ids'))) {
            if($ids = json_decode($ids, 1)) {
                foreach ($this->places as $k => $place) {
                    if(in_array($place['article'], $ids)) {
                        unset($this->places[$k]);
                    }
                }
            }
        }
        $_SESSION['esl_places'][$this->order_id] = $this->places;
    }



    private function createPlace() : array
    {
        $place = [];
        foreach(['article', 'name', 'price', 'count', 'weight', 'length', 'width', 'height'] as $field) {
            if($value = trim($this->getProperty($field))) {
                $place[$field] = $value;
            }
        }

        if(count($place) == 8) {
            $this->places[] = $place;
            $_SESSION['esl_places'][$this->order_id] = $this->places;
            return $place;
        }

        return [];
    }



    private function updatePlace() : array
    {
        if($article = trim($this->getProperty('article'))) {
            foreach ($this->places as $k => $place) {
                if($article == $place['article']) {

                    foreach ($this->places[$k] as $field => $value) {
                        if($new_value = trim($this->getProperty($field))) {
                            $this->places[$k][$field] = $new_value;
                        }
                    }
                    $_SESSION['esl_places'][$this->order_id] = $this->places;
                    return $this->places[$k];
                }
            }
        }
        return [];
    }



    private function getPlace() : array
    {
        if($id = $this->getProperty('id')) {
            foreach ($this->places as $place) {
                if($id == $place['article']) {
                    return $place;
                }
            }
        }
        return [];
    }



    private function getPlaces() : void
    {
        $this->places = $_SESSION['esl_places'][$this->order_id] ?? [];

        if(count($this->places) == 0 && $this->modx->getOption('eshoplogistic3_take_places_from_order') == 1) {
            $this->getPlacesFromOrder();
            $_SESSION['esl_places'][$this->order_id] = $this->places;
        }
    }



    private function getPlacesFromOrder() : void
    {
        $q = $this->modx->newQuery('msOrderProduct', ['order_id' => $this->order_id]);
        foreach ($this->modx->getIterator('msOrderProduct', $q) as $product) {
            $id = $product->get('product_id');

            $place = $this->eshoplogistic3->getOffers('product', $id);

            foreach(['length', 'width', 'height'] as $item) {
                if(empty($place[$id][$item])) {
                    $place[$id][$item] = 0;
                }
            }

            $place[$id] = $this->getPlaceCargoParams($place[$id]);

            $place[$id]['count'] = $product->count;
            $place[$id]['price'] = $product->price;

            $this->places[] = $place[$id];
        }
    }



    private function getPlaceCargoParams(array $place) : array
    {
        /* Варианты учёта дефолтных ВГХ - $service_settings['default_cargo_params']['variant']
            variant = 0 - вес и габариты из запроса (по умолчанию),
            variant = 1 - вес и габариты, указанные в настройках,
            variant = 2 - вес из запроса, габариты указанные в настройках,
            variant = 3 - габариты из запроса, вес указанный в настройках
        */

        $setting_default_weight = $this->modx->getOption('eshoplogistic3_order_default_weight');
        if(!empty($setting_default_weight)) {
            $default_weight = (int)$setting_default_weight;
            if($default_weight != 0) {
                $place['weight'] = $default_weight;
            }
        }

        $setting_default_dimensions = $this->modx->getOption('eshoplogistic3_order_default_dimensions');
        if(!empty($setting_default_dimensions)) {
            $default_dimensions = explode('*', $setting_default_dimensions);
            foreach ($default_dimensions as $k => $v) {
                $default_dimensions[$k] = (int)$v;
            }
            foreach(['length', 'width', 'height'] as $k => $v) {
                if(!empty($default_dimensions[$k])) {
                    $place[$v] = $default_dimensions[$k];
                }
            }
        }



        if(!empty($this->service_settings['default_cargo_params']['variant'])) {

            $weight = $this->service_settings['default_cargo_params']['weight'] ?? 0;
            $dimensions = $this->service_settings['default_cargo_params']['dimensions'] ?? [];

            switch ($this->service_settings['default_cargo_params']['variant']) {
                case 1:
                    if(empty($place['weight']) && $weight != 0) {
                        $place['weight'] = $weight;
                    }
                    foreach(['length', 'width', 'height'] as $item) {
                        if(empty($place[$item]) && !empty($dimensions[$item])) {
                            $place[$item] = $dimensions[$item];
                        }
                    }
                    break;

                case 2:
                    foreach(['length', 'width', 'height'] as $item) {
                        if(empty($place[$item]) && !empty($dimensions[$item])) {
                            $place[$item] = $dimensions[$item];
                        }
                    }
                    break;

                case 3:
                    if($weight != 0) {
                        $place['weight'] = $weight;
                    }
                    break;
            }
        }

        return $place;
    }


    private function getServiceSettings() : void
    {
        $service_code = null;

        if($order = $this->modx->getObject('msOrder', $this->order_id)) {
            if($properties = json_decode($order->properties, 1)) {
                if(is_array($properties)) {
                    if(!empty($properties['eshoplogistic3_data']['service']['name'])) {
                        $service_code = $properties['eshoplogistic3_data']['service']['code'];
                    }
                }
            }
        }

        if(!empty($service_code)) {
            if(file_exists($this->eshoplogistic3->deliveries_config_file)) {
                if($str = file_get_contents($this->eshoplogistic3->deliveries_config_file)) {
                    if($data = json_decode($str, 1)) {
                        if(is_array($data)) {
                            foreach ($data as $item) {
                                if($item['code'] == $service_code && !empty($item['settings'])) {
                                    $this->service_settings = $item['settings'];
                                }
                            }
                        }
                    }
                }
            }
        }
    }


    private function preparePlaces() : void
    {
        $actions = [
            [
                'cls' => '',
                'icon' => 'icon icon-edit',
                'title' => $this->modx->lexicon('eshoplogistic3_place_update'),
                'action' => 'updateItem',
                'button' => true,
                'menu' => true
            ], [
                'cls' => '',
                'icon' => 'icon icon-trash-o action-red',
                'title' => $this->modx->lexicon('eshoplogistic3_place_remove'),
                'multiple' => $this->modx->lexicon('eshoplogistic3_places_remove'),
                'action' => 'removeItem',
                'button' => true,
                'menu' => true
            ]
        ];
        foreach ($this->places as $k => $palace) {
            $this->places[$k]['actions'] = $actions;
        }
    }

}

return 'eshoplogistic3UnloadPlacesProcessor';