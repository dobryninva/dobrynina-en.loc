<?php

class eshoplogistic3TariffProcessor extends modProcessor
{

    public function process()
    {
        $tariffs = [];

        $properties = $this->getProperties();
        if(!empty($properties['service'])) {

            $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

            $query_data = [
                'service' => $properties['service']
            ];

            if($properties['service'] == 'sdek') {
                if (!empty($properties['type'])) {
                    if($properties['type'] == 1) {
                        $query_data['mode'] = 'online_store';
                    }
                    else {
                        $query_data['mode'] = 'delivery';
                    }
                }
            }

            $cache_key = md5('tariffs'.json_encode($query_data));
            $cache_data = $this->eshoplogistic3->Cache($cache_key);

            if(!empty($cache_data)) {
                $tariffs = $cache_data;
            }
            else {
                if ($client = $this->eshoplogistic3->ApiQuery('service/tariffs', $query_data)) {
                    if (!empty($client['data'])) {
                        foreach ($client['data'] as $k => $v) {
                            $tariffs[] = [
                                'code' => $k,
                                'name' => $v
                            ];
                        }
                        if(count($tariffs) > 0) {
                            $this->eshoplogistic3->Cache($cache_key, 'create', $tariffs);
                        }
                    }
                }
            }
        }

        $limit = $properties['limit'] ?? 10;
        $start = $properties['start'] ?? 0;
        $total = count($tariffs);
        if($total > 0) {
           $tariffs = array_slice($tariffs, $start, $limit);
        }

        #$this->modx->log(1, print_r($tariffs,1));

        return $this->modx->toJSON([
            'success' => true,
            'total' => $total,
            'results' => $tariffs
        ]);
    }

}

return 'eshoplogistic3TariffProcessor';