<?php

class eshoplogistic3CounterpartiesProcessor extends modProcessor
{

    public function process()
    {
        $counterparties = [];

        $properties = $this->getProperties();
        if(!empty($properties['service'])) {

            $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

            $query_data = [
                'service' => $properties['service']
            ];

            $type = $properties['type'] ?? 'counterparties';

            $cache_key = md5($type.json_encode($query_data));
            $cache_data = $this->eshoplogistic3->Cache($cache_key);

            if(!empty($cache_data)) {
                $counterparties = $cache_data;
            }
            else {
                if ($client = $this->eshoplogistic3->ApiQuery('service/counterparties', $query_data)) {
                    if (!empty($client['data'][$type])) {

                        foreach ($client['data'][$type] as $v) {
                            $counterparties[] = [
                                'code' => ($type == 'counterparties') ? $v['uid'] : $v['id'],
                                'name' => $v['name']
                            ];
                        }

                        if(count($counterparties) > 0) {
                            $this->eshoplogistic3->Cache($cache_key, 'create', $counterparties);
                        }
                    }
                }
            }
        }

        $total = count($counterparties);

        # взять дефолтного отправителя из настроек
        if($properties['service'] == 'delline' && $type == 'contacts' && $total == 0) {
            $counterparties[] = [
                'code' => $this->modx->getOption('eshoplogistic3_delline_contact_id'),
                'name' => $this->modx->getOption('eshoplogistic3_delline_contact_name')
            ];
        }

        $limit = $properties['limit'] ?? 10;
        $start = $properties['start'] ?? 0;

        if($total > 0) {
           $counterparties = array_slice($counterparties, $start, $limit);
        }

        return $this->modx->toJSON([
            'success' => true,
            'total' => $total,
            'results' => $counterparties
        ]);
    }

}

return 'eshoplogistic3CounterpartiesProcessor';