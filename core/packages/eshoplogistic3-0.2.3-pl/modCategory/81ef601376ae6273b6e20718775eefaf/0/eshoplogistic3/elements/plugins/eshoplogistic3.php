<?php

$eshoplogistic3 = $modx->getService('eshoplogistic3', 'eshoplogistic3', $modx->getOption('core_path') . 'components/eshoplogistic3/model/eshoplogistic3/', $scriptProperties ?? []);

switch ($modx->event->name) {

    case 'msOnManagerCustomCssJs':
        if (!empty($scriptProperties['page'])) {
            if ($scriptProperties['page'] == 'orders') {
                $modx->controller->addLexiconTopic('eshoplogistic3:default');
                $modx->controller->addCss($eshoplogistic3->config['cssUrl'] . 'mgr/main.css');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/eshoplogistic3.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/misc/utils.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/misc/combo.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/upload-common.tab.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/upload-receiver.tab.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/upload-places.window.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/upload-places.tab.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/upload-additional.window.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/upload-additional.tab.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/unload.window.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/delivery.window.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/delivery.panel.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/inject/order.tab.js');
                $modx->regClientStartupScript('<script>eshoplogistic3.config.connector_url = "' . $eshoplogistic3->config['connectorUrl'] . '";</script>');
                #$modx->controller->addHtml('<div id="eShopLogisticWidgetBlock" data-order="false" data-lazy-load="true"></div>');
                #$modx->regClientStartupScript('https://api.esplc.ru/widgets/block/app.js');
                $modx->controller->addHtml('<div id="eShopLogisticWidgetModal" data-order="false" data-lazy-load="true"></div>');
                $modx->regClientStartupScript('https://api.esplc.ru/widgets/modal/app.js');
                $modx->regClientStartupScript($eshoplogistic3->config['jsUrl'] . 'mgr/widgets/widget-run.js');
            }
        }
        break;


    case 'msOnCreateOrder':
        if(empty($esl_mode_widget)) {
            $order_data = $order->get();
            if(!empty($order_data['eshoplogistic3_data'])) {
                if($esl_data = json_decode($order_data['eshoplogistic3_data'], 1)) {
                    $eshoplogistic3->setEslData($msOrder, $esl_data);
                }
            }
        }
        break;


    case 'msOnChangeOrderStatus':
        $eshoplogistic3->orderUnload($order, $status);
        break;


    # автор Ivan Klimchuk
    case 'OnManagerPageBeforeRender':
        if ($_GET['a'] !== 'system/settings') {
            return;
        }
        $pathPrefix = MODX_ASSETS_URL . 'components/eshoplogistic3/js/mgr/misc/';
        $modx->controller->addLastJavascript($pathPrefix . 'weight.combo.js');
        $modx->controller->addLastJavascript($pathPrefix . 'ss-xtypes-loader.js');
        break;


    # установка обязательных полей для курьера
    case 'msOnSubmitOrder':
        $order_data = $order->get();
        if(!empty($order_data['eshoplogistic3_data'])) {
            if($eshoplogistic3_data = json_decode($order_data['eshoplogistic3_data'], 1)) {
                if(is_array($eshoplogistic3_data)) {

                    if(isset($eshoplogistic3_data['type'])) {
                        if($eshoplogistic3_data['type'] == 'door') {
                            if(empty($data['street']) || empty($data['building']) || empty($data['room'])) {
                                $modx->event->output(strip_tags($modx->lexicon('eshoplogistic3_need_address_message')));
                            }
                        }
                        else {
                            if(empty($eshoplogistic3_data['terminal']['code'])) {
                                $modx->event->output(strip_tags($modx->lexicon('eshoplogistic3_need_pvz_message')));
                            }
                        }
                    }
                }
            }
        }
        break;

    /*
    # Получение данных товаров. Можно добавить габариты, изменить вес и т.д.
    case 'eshoplogistic3OnGetOffers':
        foreach($offers as $k => $offer) {
            # Например, в поле weight_packing msProductData у нас хранятся параметры веса упаковки: возьмём её вес вместо штатного поля weight
            if($productData = $modx->getObject('msProductData', $offer['article'])) {
                $offers[$k]['weight'] = (int)$productData->get('weight_packing') ?? 5;
            }
            # Например, в поле dimensions msProductData у нас хранятся габариты товар, формат Д*Ш*В (25*15*10), в сантиметрах
            if($productData = $modx->getObject('msProductData', $offer['article'])) {
                $offers[$k]['dimensions'] = $productData->get('dimensions');
            }
        }
        $modx->event->output(['offers' => $offers]);
        break;
    */



    /*
    # срабатывает перед выгрузкой заказа в кабинет транспортной компании, можно изменить данные заказа
    case 'eshoplogistic3BeforeUnloadOrder':
        $modx->log(1, print_r($query_data, 1));
        $query_data['sender']['company'] = 'Название компании';
        $modx->event->output(['query_data' => $query_data]);
        break;
    */



    /*
    # срабатывает после выгрузки заказа в кабинет транспортной компании
    case 'eshoplogistic3UnloadOrder':
        $modx->log(1, print_r($query_data, 1));
        $modx->log(1, print_r($response, 1));
        break;
    */



    /*
    # Выполняется после обновления статуса доставки выгрженного заказа
    case 'eshoplogistic3OnGetOrderStatus':
        #$modx->log(1, print_r($response, 1));
        # в зависимости от ответа можно что-то делать; например изменить статус заказа:
        if(isset($status['new'])) {
            if($status['new'] == 'taken') {
                $miniShop2 = $this->modx->getService('miniShop2');
                $miniShop2->changeOrderStatus($order->id, 5);
            }
        }
        break;
    */

}