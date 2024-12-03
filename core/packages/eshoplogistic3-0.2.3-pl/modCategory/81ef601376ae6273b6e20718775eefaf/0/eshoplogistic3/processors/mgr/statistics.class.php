<?php

class eShopLogistic3StatisticsProcessor extends modProcessor
{
    public function process()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        if($requests = $this->eshoplogistic3->ApiQuery('client/requests')) {
            if (!empty($requests['data'])) {

                $items = [];
                foreach (['sum', 'api', 'widget'] as $item) {
                    $items[$item] = '?';
                    if(!empty($requests['data']['requests']['total'][$item])) {
                        $items[$item] = $requests['data']['requests']['total'][$item];
                        if(!empty($requests['data']['requests']['average'][$item])) {
                            $items[$item] .= ', в среднем за сутки: '.$requests['data']['requests']['average'][$item];
                        }
                    }
                }

                $data = [
                    'tariff' => (!empty($requests['data']['tariff']['name'])) ? $requests['data']['tariff']['name'].', '.$requests['data']['tariff']['price'].' р./месяц' : '?',
                    'limit' => (!empty($requests['data']['tariff']['limit'])) ? $requests['data']['tariff']['limit'].' запросов в сутки' : '?',
                    'sum' => $items['sum'],
                    'widget' => $items['widget'],
                    'api' => $items['api']
                ];

                return $this->outputArray($data);

            }
        }

        return $this->failure($this->modx->lexicon('eshoplogistic3_err_statistics'));
    }

}

return 'eShopLogistic3StatisticsProcessor';