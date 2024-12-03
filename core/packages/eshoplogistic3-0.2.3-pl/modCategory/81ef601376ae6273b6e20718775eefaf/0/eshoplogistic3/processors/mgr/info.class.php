<?php

class eShopLogistic3InfoProcessor extends modProcessor
{
    public function process()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        if($client = $this->eshoplogistic3->ApiQuery('client/state')) {
            if(!empty($client['data'])) {

                $services = [];

                if(!empty($client['data']['services'])) {
                    if(is_array($client['data']['services'])) {
                        foreach ($client['data']['services'] as $service) {
                            $services[] = $service['name'];
                        }
                    }
                }

                $cache_data = $this->eshoplogistic3->cacheSize();

                $data = [
                    'active' => ($client['data']['blocked'] == 0) ? 'Да' : 'Нет',
                    'balance' => $client['data']['balance'].' р. (~ '.$client['data']['paid_days_text'].')',
                    'free_days' => $client['data']['free_days'],
                    'services' => implode(', ', $services),
                    'cache_size' => $cache_data['size'].' Mb '.str_replace(['{files}', '{time}'], [$cache_data['files'], $cache_data['time']], $this->modx->lexicon('eshoplogistic3_info_cache_size_text'))
                ];

                return $this->outputArray($data);

            }
        }

        return $this->failure($this->modx->lexicon('eshoplogistic3_err_info'));
    }



}

return 'eShopLogistic3InfoProcessor';