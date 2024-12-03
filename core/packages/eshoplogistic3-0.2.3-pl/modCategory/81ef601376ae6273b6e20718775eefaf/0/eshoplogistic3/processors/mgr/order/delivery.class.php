<?php
class eshoplogistic3DeliveryProcessor extends modProcessor {

    public $permission = '';

    public function process()
    {
        $errors = [];

        $properties = $this->getProperties();

        $errors_message = $this->modx->lexicon('eshoplogistic3_delivery_edit_field_error');

        if(!empty($properties['data']) && !empty($properties['settlement'])) {
            if ($_data = json_decode($properties['data'], 1)) {
                if (is_array($_data)) {
                    if ($_settlement = json_decode($properties['settlement'], 1)) {
                        if (is_array($_settlement)) {

                            $data = $_data;
                            $data['settlement'] = $_settlement;

                            if (!empty($properties['order_id'])) {
                                if (!$order = $this->modx->getObject('msOrder', (int)$properties['order_id'])) {
                                    $errors[] = $this->modx->lexicon('eshoplogistic3_delivery_edit_data_error');
                                }
                            }
                        }
                    }
                }
            }
        }

        if(!isset($data)) {
            $errors[] = $this->modx->lexicon('eshoplogistic3_delivery_edit_data_error');
        }
        else {
            if (empty($data['service']['code'])) {
                $errors[] = $this->modx->lexicon('eshoplogistic3_delivery_edit_data_error');
            }
            elseif (empty($data['settlement']['name'])) {
                $errors[] = str_replace('{field}', $this->modx->lexicon('eshoplogistic3_delivery_edit_settlement'), $errors_message);
            }
            else {
                if (empty($data['price']['value'])) {
                    $errors[] = str_replace('{field}', $this->modx->lexicon('eshoplogistic3_delivery_edit_price'), $errors_message);
                }
            }
        }

        if(count($errors) == 0) {

            if($address = $this->modx->getObject('msOrderAddress', ['order_id' => $order->id])) {
                $address->set('region', $data['settlement']['region'] ?? '');
                $address->set('city', $data['settlement']['name']);
                $address->save();
            }

            $order->set('delivery_cost', $data['price']['value']);
            $order->set('cost', $data['price']['value'] + $order->get('cart_cost'));
            $order->save();

            $eshoplogistic3 = $this->modx->getService('eshoplogistic3');
            $eshoplogistic3->setEslData($order, $data);

            return $this->modx->toJSON([
                'success' => true,
                'message' => $this->modx->lexicon('eshoplogistic3_order_edit_success_message')
            ]);
        }
        else {
            return $this->modx->toJSON([
                'success' => false,
                'message' => implode('<br>', $errors)
            ]);
        }
    }

}

return 'eshoplogistic3DeliveryProcessor';
