<?php

class eshoplogistic3
{
    public object $modx;
    public object $pdoTools;

    public array $config;
    public string $version = '0.2.0';

    public string $log_file;
    public string $deliveries_config_file;
    public string $cache_dir = 'cache/';
    public string $widget_controller = '';



    function __construct (modX &$modx, array $config = [])
    {
        $this->modx =& $modx;
        $this->pdoTools = $this->modx->getService('pdoTools');

        $corePath = MODX_CORE_PATH . 'components/eshoplogistic3/';
        $assetsUrl = MODX_ASSETS_URL . 'components/eshoplogistic3/';

        $this->log_file = $corePath.'log.txt';
        $this->deliveries_config_file = $corePath.'config.json';

        $this->cache_dir = $corePath.$this->cache_dir;
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir, 0755);
        }
        else {
            $this->cacheControl();
        }

        $this->config = array_merge([
            'corePath' => $corePath,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'assetsUrl' => $assetsUrl,
            'cssUrl' => $assetsUrl . 'css/',
            'jsUrl' => $assetsUrl . 'js/'
        ], $config);

        $this->modx->addPackage('eshoplogistic3', $this->config['modelPath']);
        $this->modx->lexicon->load('eshoplogistic3:default');
    }


    public function initialize($ctx = 'web', array $scriptProperties = array())
    {
        if (isset($this->initialized[$ctx])) {
            return $this->initialized[$ctx];
        }

        $this->config = array_merge($this->config, $scriptProperties, array('ctx' => $ctx));

        if ($ctx != 'mgr' AND (!defined('MODX_API_MODE') OR !MODX_API_MODE)) {}

        $config = $this->pdoTools->makePlaceholders($this->config);

        $delivery_id = 0;
        if($delivery = $this->modx->getObject('msDelivery', ['active' => 1, 'class' => 'eShopLogisticHandler'])) {
            $delivery_id = $delivery->id;
        }

        $payments = [
            'card' => explode(',', $this->modx->getOption('eshoplogistic3_payment_card')),
            'cash' => explode(',', $this->modx->getOption('eshoplogistic3_payment_cash')),
            'cashless' => explode(',', $this->modx->getOption('eshoplogistic3_payment_cashless')),
            'prepay' => explode(',', $this->modx->getOption('eshoplogistic3_payment_prepay')),
            'upon_receipt' => explode(',', $this->modx->getOption('eshoplogistic3_payment_upon_receipt'))
        ];

        $data = json_encode([
            'delivery_id' => $delivery_id,
            'default_delivery_id' => (int)$this->modx->getOption('eshoplogistic3_default_delivery_id'),
            'actionUrl' => $this->config['assetsUrl'] . 'action.php',
            'payment_on' => (int)$this->modx->getOption('eshoplogistic3_payment_on'),
            'payments' => json_encode($payments),
            'warning_message' => $this->modx->lexicon('eshoplogistic3_warning_message'),
            'settlement_warning_message' => $this->modx->lexicon('eshoplogistic3_settlement_warning_message'),
            'fail_message' => $this->modx->lexicon('eshoplogistic3_fail_message'),
            'loading_message' => $this->modx->lexicon('eshoplogistic3_loading_message'),
            'no_delivery_message' => $this->modx->lexicon('eshoplogistic3_no_delivery_to_location')
        ], true);

        $this->modx->regClientStartupScript('<script>eshoplogistic3Config = '.$data.';</script>', true);

        $css = trim($this->modx->getOption('eshoplogistic3_frontend_css'));
        if (!empty($css) && preg_match('/\.css$/i', $css)) {
            $this->modx->regClientCSS(str_replace($config['pl'], $config['vl'], $css.'?v='.$this->version));
        }

        $js = trim($this->modx->getOption('eshoplogistic3_frontend_js'));
        if (!empty($js) && preg_match('/\.js/i', $js)) {
            $this->modx->regClientScript(str_replace($config['pl'], $config['vl'], $js.'?v='.$this->version)); //time()));
        }

        $initialize = true;
        $this->initialized[$ctx] = $initialize;

        return $initialize;
    }



    public function initCheckout (string $fias=null, string $city=null, string $region = '') : array
    {
        $this->setWidgetController();
        
        $target = '';
        if(!empty($fias) || !empty($city)) {
            $target = $fias ?: $city;
        }
        
        return [
            'widget_target' => $target,
            'widget_region' => $region,
            'widget_controller' => $this->widget_controller,
            'widget_key' => $this->modx->getOption('eshoplogistic3_widget_key'),
            'source_url' => $this->modx->getOption('eshoplogistic3_widgets_source')
        ];
    }



    public function initWidget (int $product_id, array $product_options = [])  : array
    {
        $this->setWidgetController();

        $offers = $this->getOffers('product', $product_id, $product_options);

        # во избежание проблем с fenom'ом нужно подправить json
        $json_offers = '[';
        foreach ($offers as $offer) {
            $json_offers .= json_encode($offer) . ',';
        }
        $json_offers = substr($json_offers, 0, -1);
        $json_offers .= ']';
        $json_offers = str_replace(['{', '}'], ['{ ', ' }'], $json_offers);

        return [
            'widget_controller' => $this->widget_controller,
            'offers' => $json_offers
        ];
    }



    private function setWidgetController() : void
    {
        $widget_controller = trim($this->modx->getOption('eshoplogistic3_controller'));
        if (!empty($widget_controller) && preg_match('/\.php$/i', $widget_controller)) {
            $config_pl = $this->pdoTools->makePlaceholders($this->config);
            $link_hash = uniqid();
            if(empty($_SESSION['widget_hash'])) {
                $_SESSION['widget_hash'] = $link_hash ;
            }
            else {
                $link_hash = $_SESSION['widget_hash'];
            }
            $this->widget_controller = str_replace($config_pl['pl'], $config_pl['vl'], $widget_controller).'?hash='. $link_hash;
        }
    }



    public function getOffers (string $mode = 'cart', int $product_id = 0, array $product_options = []) : array
    {
        $offers = [];

        $ms2 = $this->modx->getService('minishop2');
        $ms2->initialize('web');
        $this->modx->lexicon->load('minishop2:default');

        switch ($mode) {

            case 'product':
                if ($product = $this->modx->getObject('msProduct', $product_id)) {
                    $offers[$product_id] = [
                        'article' => $product_id,
                        'name' => $product->pagetitle,
                        'count' => 1,
                        'price' => $product->get('price'),
                        'weight' => round($this->setWeight((float)$product->get('weight')),2)
                    ];

                    #$this->modx->log(1, print_r($offers[$product_id],1));

                    # у товара могут быть опции
                    if(count($product_options) > 0) {
                        $options = [];
                        foreach ($product_options as $name) {
                            if (!empty($name) && $option = $product->get($name)) {
                                if (!is_array($option)) {
                                    $option = array($option);
                                }
                                if (!empty($option[0])) {
                                    $options[$name] = [
                                        'name' => $this->modx->lexicon('ms2_product_'.$name),
                                        'value' => $option[0]
                                    ];
                                }
                            }
                        }
                        if(count($options) > 0) {
                            $offers[$product_id]['options'] = $options;
                        }
                    }
                }
                break;

            // cart
            default:
                $cart = $ms2->cart->get();
                if (!empty($cart)) {
                    foreach ($cart as $item) {
                        $offers[$item['id']] = [
                            'article' => $item['id'],
                            'name' => $item['id'],
                            'count' => $item['count'],
                            'price' => $item['price'],
                            'weight' => round($this->setWeight((float)$item['weight']),2)
                        ];

                        if(!empty($item['dimensions'])) {
                            $offers[$item['id']]['dimensions'] = $item['dimensions'];
                        }
                    }
                }
        }


        if (!empty($offers)) {

            $nfd = $this->modx->invokeEvent('eshoplogistic3OnGetOffers', [
                'offers' => $offers
            ]);

            if(!empty($nfd)) {
                if(is_array($nfd)) {
                    foreach($nfd as $odata) {
                        if(!empty($odata['offers'])) {
                            $offers = $odata['offers'];
                            break;
                        }
                    }
                }
            }
        }

        return $offers;
    }



    private function setWeight (float $weight) : float
    {
        $min_weight = (float)$this->modx->getOption('eshoplogistic3_min_weight') ?? 0;
        $weight_unit = $this->modx->getOption('eshoplogistic3_weight_unit');
        $weight_ratio = ($weight_unit == 'gm') ? 1000 : 1;

        if($weight > 0) {
            $weight = round($weight / $weight_ratio, 4);
            return ($weight < $min_weight) ? $min_weight : $weight;
        }
        else {
            return $min_weight;
        }
    }



    public function ApiQuery (string $method, array $data = [], string $raw = '')
    {
        $apiKey = $this->modx->getOption('eshoplogistic3_api_key');
        if(empty($apiKey)) {
            $this->modx->log(1, 'eShopLogistic3: необходимо указать Ключ API eShopLogistic');
            return [];
        }

        $apiUrl = $this->modx->getOption('eshoplogistic3_api_url');
        if(empty($apiUrl)) {
            $this->modx->log(1, 'eShopLogistic3: необходимо указать URL API eShopLogistic');
            return [];
        }


        $lc = substr($apiUrl, -1);
        if($lc != '/') {
            $apiUrl .= '/';
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl.$method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_POST, 1);
        if(preg_match('/widget/', $method)) {
            # заказ из виджета отправляется в raw
            if($method == 'widget/send') {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $raw);
                curl_setopt($curl, CURLOPT_HTTPHEADER,  [
                    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36',
                    'Content-Type: application/json'
                ]);
            }
            else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36'
                ]);
            }
        }
        else {
            # выгрузка заказа в raw
            if ($method == 'delivery/order') {
                $raw = json_encode(array_merge($data, ['key' => $apiKey]));
                curl_setopt($curl, CURLOPT_POSTFIELDS, $raw);
                curl_setopt($curl, CURLOPT_HTTPHEADER,  [
                    'Content-Type: application/json'
                ]);
            }
            else {
                curl_setopt($curl, CURLOPT_POSTFIELDS, array_merge($data, ['key' => $apiKey, 'partner_key' => '264a70436ba3f54.08398039']));
            }
        }

        $result = curl_exec($curl);
        curl_close($curl);

        #$this->modx->log(1, print_r(array_merge($data, ['key' => $apiKey]),1));

        if($result = json_decode($result,1)) {
            if(is_array($result)) {
                if($result['http_status'] == 401) {
                    $txt = 'eShopLogistic3: сервер вернул статус '.$result['http_status'];

                    if(!empty($result['http_status_message'])) {
                        $txt .= ' «'.$result['http_status_message'].'»';
                    }

                    $this->modx->log(1, $txt);
                    return false;
                }
                else {

                    if ($this->modx->getOption('eshoplogistic3_query_log') == 1) {
                        $this->Log($method, $result, $data);
                    }

                    return $result;
                }
            }
        }

        $this->modx->log(1, 'eShopLogistic3: сервер не ответил на запрос '.$apiUrl.$method);

        return false;
    }



    private function Log (string $method, array $result, array $data = []) : void
    {
        $log_mode = $this->modx->getOption('eshoplogistic3_query_log_mode');

        if($log_mode != 0) {
            if(!strripos($method, 'calculation')) {
                return;
            }
            if($log_mode == 2) {
                if(isset($result['data']['terminals'])) {
                    unset($result['data']['terminals']);
                }
            }
        }

        if(file_exists($this->log_file)) {
            if(filesize($this->log_file) / 1024 / 1024 > 1) {
                unlink($this->log_file);
            }
        }

        $to_log = [];
        $to_log[] = '*****'.PHP_EOL;
        $to_log[] = date('d.m.Y H:i:s').': '.$method.PHP_EOL;
        if(count($data) > 0) {
            $to_log[] = 'REQUEST: ' . print_r($data, 1).PHP_EOL;
        }
        $to_log[] = 'RESPONSE: '.print_r($result,1).PHP_EOL;

        file_put_contents($this->log_file, $to_log, FILE_APPEND);
    }



    public function Cache (string $cache_key, string $mode = 'get', array $data = []) : array
    {
        $cache_file = $this->cache_dir.$cache_key.'.json';

        switch ($mode) {

            case 'get':
                if(file_exists($cache_file)) {
                    if($str = file_get_contents($cache_file)) {
                        if($data = json_decode($str,1)) {
                            if(is_array($data)) {
                                return $data;
                            }
                        }
                    }
                }
                break;


            case 'create':
                if(count($data) > 0) {
                    file_put_contents($cache_file, json_encode($data));
                }
            //break;
        }

        return [];
    }



    public function cacheSize (string $mode = 'get') : array
    {
        $out = [
            'files' => 0,
            'size' => 0,
            'last_update' => '',
            'time' => 0
        ];

        foreach (glob($this->cache_dir.'*') as $file) {
            if($mode == 'get') {
                if(empty($out['last_update'])) {
                    $out['last_update'] = filectime($file);
                }
                $out['files']++;
                $out['size'] += filesize($file);
            }
            if($mode == 'delete') {
                if(file_exists($file)) {
                    unlink($file);
                }
            }
        }

        if($out['size'] != 0) {
            if(!empty($out['last_update'])) {
                $time = (time() - $out['last_update']) / 60 / 60;
                $out['time'] = number_format($time, 2, '.', ' ');
            }

            $out['size'] = number_format($out['size'] / 1024 / 1024, 2, '.', ' ');
        }

        return $out;
    }



    private function cacheControl (): void
    {
        $cache_time = $this->modx->getOption('eshoplogistic3_cache_time');
        foreach (glob($this->cache_dir.'*') as $file) {
            $last_update = filectime($file);
            break;
        }

        if(isset($last_update)) {
            $time = (time() - $last_update) / 60 / 60;
            if($time >= $cache_time) {
                $this->cacheSize('delete');
            }
        }
    }



    public function createOrder (array $data) : array
    {
        include_once dirname(__FILE__).'/orderHandler.class.php';
        $oh = new Order($this->modx);
        return $oh->Process($data);
    }



    # массив всегда должен быть именно таким: https://modx-v3.eshoplogistic.ru/documentation.html#d5
    public function setEslData(object $order, array $data) : void
    {
        $test = false;
        if($delivery = $this->modx->getObject('msDelivery', $order->delivery)) {
            if($delivery->class == 'eShopLogisticHandler') {
                $test = true;
            }
        }

        if(!$test) {
            return;
        }

        $esl_data = [];

        if(!empty($data['settlement']['name'])) {
            $esl_data['settlement'] =  [
                'name' => $data['settlement']['name'],
                'fias' => $data['settlement']['fias'] ?? '',
                'region' => $data['settlement']['region'] ?? ''
            ];
        }

        if(!empty($data['service']['code'])) {
            $esl_data['service'] =  [
                'code' => $data['service']['code'],
                'name' => $data['service']['name'] ?? ''
            ];
        }

        if(!empty($data['tariff']['code'])) {
            $esl_data['tariff'] =  [
                'code' => $data['tariff']['code'],
                'name' => $data['tariff']['name'] ?? ''
            ];
        }

        $esl_data['type'] = $data['type'] ?? 'door';

        if(isset($data['price']['value'])) {
            $esl_data['price'] =  [
                'value' => $data['price']['value'],
                'unit' => $data['price']['unit'] ?? ''
            ];
            if(isset($data['price']['base'])) {
                $esl_data['price']['base'] = $data['price']['base'];
            }
        }

        if(isset($data['time']['value'])) {
            $esl_data['time'] =  [
                'value' => $data['time']['value'],
                'unit' => $data['time']['unit'] ?? ''
            ];
        }

        if(!empty($data['comments']['service'])) {
            $esl_data['comments']['service'] = $data['comments']['service'];
        }
        if(!empty($data['comments']['type'])) {
            $esl_data['comments']['type'] = $data['comments']['type'];
        }

        if(!empty($data['terminal']['code'])) {
            $esl_data['terminal'] = [
                'code' => $data['terminal']['code'],
                'name' => $data['terminal']['name'] ?? '',
                'address' => $data['terminal']['address'] ?? '',
                'phones' => $data['terminal']['phones'] ?? '',
                'workTime' => $data['terminal']['workTime'] ?? '',
                'lon' => $data['terminal']['lon'] ?? '',
                'lat' => $data['terminal']['lat'] ?? '',
                'is_postamat' => (!empty($data['terminal']['is_postamat'])) ? 1 : 0
            ];
        }

        if(!empty($data['order']['id'])) {
            $esl_data['order'] = [
                'id' => $data['order']['id'],
                'tracking' => $data['order']['tracking'] ?? '',
                'print' => $data['order']['print'] ?? '',
            ];
            if(!empty($data['order']['state']['status']['code'])) {
                $esl_data['order']['state']['status'] = [
                    'code' => $data['order']['state']['status']['code'],
                    'description' => $data['order']['state']['status']['description'] ?? ''
                ];
            }
            if(!empty($data['order']['state']['service_status']['code'])) {
                $esl_data['order']['state']['status'] = [
                    'code' => $data['order']['state']['service_status']['code'],
                    'description' => $data['order']['state']['service_status']['description'] ?? ''
                ];
            }
        }

        $properties = $order->get('properties');
        $properties['eshoplogistic3_data'] = $esl_data;
        $order->set('properties', $properties);
        $order->save();
    }





    # выгрузка заказа в кабинет ТК
    public function orderUnload(object $order, int $status) : void
    {
        if($this->modx->getOption('eshoplogistic3_allow_automatic_unloading_orders')) {
            if($status == $this->modx->getOption('eshoplogistic3_unloading_order_start_status')) {
                include_once dirname(__FILE__) . '/orderUnloadHandler.class.php';
                $ouh = new OrderUnload($this->modx, $order);
                $ouh->Process();
            }
        }
    }

}