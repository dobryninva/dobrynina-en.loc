<?php
/**
* Запускает обновление статуса выгруженных заказов по crontab
* например:  0 2 * * * php ~/core/components/eshoplogistic3/cron/run.php запускать каждый день в 2 часа ночи
*/

$config = require dirname(__FILE__, 4).'/config/config.inc.php';
define('MODX_API_MODE', true);
require MODX_BASE_PATH.'/index.php';


if(!empty($modx->getOption('eshoplogistic3_update_data')) && !empty($modx->getOption('eshoplogistic3_update_data_statuses'))) {

    $statuses = explode(',', $modx->getOption('eshoplogistic3_update_data_statuses'));

    if(count($statuses) > 0) {

        if($eshoplogistic3 = $modx->getService('eshoplogistic3', 'eshoplogistic3', MODX_CORE_PATH . 'components/eshoplogistic3/model/eshoplogistic3/')) {

            $q = $modx->newQuery('msOrder', ['status:IN' => $statuses]);

            foreach ($modx->getIterator('msOrder', $q) as $order) {

                $properties = $order->get('properties');

                if(!empty($properties['eshoplogistic3_data']['order']['id'])) {

                    $modx->runProcessor('mgr/order/getstatus',
                        [ 'order_id' => $order->id ],
                        [ 'processors_path' => $eshoplogistic3->config['processorsPath']]
                    );

                }

            }
        }
    }
};

