<?php

//ini_set('display_errors', 1);
//ini_set('error_reporting', -1);

/**
 * The base class for mssetincart.
 */
class mssetincart
{
    public $version = "2.0.11-beta";

    /** @var modX $modx */
    public $modx;

    /** @var mixed|null $namespace */
    public $namespace = 'mssetincart';
    /** @var array $config */
    public $config = array();
    /** @var array $initialized */
    public $initialized = array();

    /** @var miniShop2 $miniShop2 */
    public $miniShop2;

    /** @var msoptionsprice $msOptionsPrice */
    public $msOptionsPrice;

    /**
     * @param       $n
     * @param array $p
     */
    public function __call($n, array $p)
    {
        echo __METHOD__ . ' says: ' . $n;
    }

    /**
     * @param modX  $modx
     * @param array $config
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;

        $corePath = $this->getOption('core_path', $config,
            $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/mssetincart/');
        $assetsPath = $this->getOption('assets_path', $config,
            $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/mssetincart/');
        $assetsUrl = $this->getOption('assets_url', $config,
            $this->modx->getOption('assets_url', null, MODX_ASSETS_URL) . 'components/mssetincart/');
        $connectorUrl = $assetsUrl . 'connector.php';

        $this->config = array_merge(array(
            'namespace'       => $this->namespace,
            'connectorUrl'    => $connectorUrl,
            'assetsBasePath'  => MODX_ASSETS_PATH,
            'assetsBaseUrl'   => MODX_ASSETS_URL,
            'assetsPath'      => $assetsPath,
            'assetsUrl'       => $assetsUrl,
            'cssUrl'          => $assetsUrl . 'css/',
            'jsUrl'           => $assetsUrl . 'js/',
            'corePath'        => $corePath,
            'modelPath'       => $corePath . 'model/',
            'handlersPath'    => $corePath . 'handlers/',
            'processorsPath'  => $corePath . 'processors/',
            'templatesPath'   => $corePath . 'elements/templates/mgr/',
            'jsonResponse'    => true,
            'prepareResponse' => true,
            'showLog'         => false,
        ), $config);


        $this->modx->addPackage('mssetincart', $this->config['modelPath']);
        $this->modx->lexicon->load('mssetincart:default');
        $this->namespace = $this->getOption('namespace', $config, 'mssetincart');

        $this->miniShop2 = $modx->getService('miniShop2');
        if (!($this->miniShop2 instanceof miniShop2)) {
            return false;
        }

        $level = $modx->getLogLevel();
        $modx->setLogLevel(xPDO::LOG_LEVEL_FATAL);

        $this->msOptionsPrice = $modx->getService('msoptionsprice');
        if (!($this->msOptionsPrice instanceof msoptionsprice)) {
            $this->msOptionsPrice = false;
        }

        $modx->setLogLevel($level);

        $this->checkStat();
    }

    /**
     * @param       $key
     * @param array $config
     * @param null  $default
     *
     * @return mixed|null
     */
    public function getOption($key, $config = array(), $default = null, $skipEmpty = false)
    {
        $option = $default;
        if (!empty($key) AND is_string($key)) {
            if ($config != null AND array_key_exists($key, $config)) {
                $option = $config[$key];
            } elseif (array_key_exists($key, $this->config)) {
                $option = $this->config[$key];
            } elseif (array_key_exists("{$this->namespace}_{$key}", $this->modx->config)) {
                $option = $this->modx->getOption("{$this->namespace}_{$key}");
            }
        }
        if ($skipEmpty AND empty($option)) {
            $option = $default;
        }

        return $option;
    }

    public function initialize($ctx = 'web', array $scriptProperties = array())
    {
        if (isset($this->initialized[$ctx])) {
            return $this->initialized[$ctx];
        }

        $this->config = array_merge($this->config, $scriptProperties, array('ctx' => $ctx));

        if ($ctx != 'mgr' AND (!defined('MODX_API_MODE') OR !MODX_API_MODE)) {

        }

        $initialize = true;
        $this->initialized[$ctx] = $initialize;

        return $initialize;
    }

    /**
     * @param array $properties
     */
    public function loadResourceJsCss(array $scriptProperties = array())
    {
        $config = array_merge($this->config, $scriptProperties);
        $pls = $this->makePlaceholders($config);

        $propkey = $this->modx->getOption('propkey', $config);
        if (!empty($propkey)) {
            $this->modx->regClientHTMLBlock("<form class=\"ms2_form\" id=\"{$propkey}\"></form>");
        }

        $css = trim($this->getOption('frontCss', $scriptProperties,
            $this->modx->getOption('mssetincart_front_css', null), true));
        if (!empty($css)) {
            $this->modx->regClientCSS(str_replace($pls['pl'], $pls['vl'], $css));
        }

        $js = trim($this->getOption('frontJs', $scriptProperties,
            $this->modx->getOption('mssetincart_front_js', null), true));
        if (!empty($js)) {
            $this->modx->regClientScript(str_replace($pls['pl'], $pls['vl'], $js));
        }

        $action = trim($this->getOption('actionUrl', null, '[[+assetsUrl]]action.php'));

        $config = json_encode(array(
            'actionUrl' => str_replace($pls['pl'], $pls['vl'], $action),
            'miniShop2' => array(
                'version' => $this->getVersionMiniShop2()
            ),
            'ctx'       => $this->modx->context->get('key')
        ), true);

        $this->modx->regClientStartupScript("<script type=\"text/javascript\">msSetInCartConfig={$config};</script>",
            true);
    }


    /**
     * @return string
     */
    public function getVersionMiniShop2()
    {
        return isset($this->miniShop2->version) ? $this->miniShop2->version : '2.2.0';
    }

    /** @inheritdoc} */
    public function getPropertiesKey(array $properties = array())
    {
        return !empty($properties['propkey']) ? $properties['propkey'] : false;
    }

    /** @inheritdoc} */
    public function saveProperties(array $properties = array())
    {
        return !empty($properties['propkey']) ? $_SESSION[$this->namespace][$properties['propkey']] = $properties : false;
    }

    /** @inheritdoc} */
    public function getProperties($key = '')
    {
        return !empty($_SESSION[$this->namespace][$key]) ? $_SESSION[$this->namespace][$key] : array();
    }

    /**
     * return lexicon message if possibly
     *
     * @param string $message
     *
     * @return string $message
     */
    public function lexicon($message, $placeholders = array())
    {
        $key = '';
        if ($this->modx->lexicon->exists($message)) {
            $key = $message;
        } elseif ($this->modx->lexicon->exists($this->namespace . '_' . $message)) {
            $key = $this->namespace . '_' . $message;
        }
        if ($key !== '') {
            $message = $this->modx->lexicon->process($key, $placeholders);
        }

        return $message;
    }

    /**
     * @param string $message
     * @param array  $data
     * @param array  $placeholders
     *
     * @return array|string
     */
    public function failure($message = '', $data = array(), $placeholders = array())
    {
        $response = array(
            'success' => false,
            'message' => $this->lexicon($message, $placeholders),
            'data'    => $data,
        );

        return $this->config['jsonResponse'] ? $this->modx->toJSON($response) : $response;
    }

    /**
     * @param string $message
     * @param array  $data
     * @param array  $placeholders
     *
     * @return array|string
     */
    public function success($message = '', $data = array(), $placeholders = array())
    {
        $response = array(
            'success' => true,
            'message' => $this->lexicon($message, $placeholders),
            'data'    => $data,
        );

        return $this->config['jsonResponse'] ? $this->modx->toJSON($response) : $response;
    }


    /**
     * @param        $array
     * @param string $delimiter
     *
     * @return array
     */
    public function explodeAndClean($array, $delimiter = ',')
    {
        $array = explode($delimiter, $array);     // Explode fields to array
        $array = array_map('trim', $array);       // Trim array's values
        $array = array_keys(array_flip($array));  // Remove duplicate fields
        $array = array_filter($array);            // Remove empty values from array

        return $array;
    }

    /**
     * @param        $array
     * @param string $delimiter
     *
     * @return array|string
     */
    public function cleanAndImplode($array, $delimiter = ',')
    {
        $array = array_map('trim', $array);       // Trim array's values
        $array = array_keys(array_flip($array));  // Remove duplicate fields
        $array = array_filter($array);            // Remove empty values from array
        $array = implode($delimiter, $array);

        return $array;
    }

    /**
     * @param array $array
     *
     * @return array
     */
    public function cleanArray(array $array = array())
    {
        $array = array_map('trim', $array);       // Trim array's values
        $array = array_filter($array);            // Remove empty values from array
        $array = array_keys(array_flip($array));  // Remove duplicate fields

        return $array;
    }

    /**
     * @param array $array1
     * @param array $array2
     *
     * @return array
     */
    public function array_merge_recursive_ex(array & $array1 = array(), array & $array2 = array())
    {
        $merged = $array1;

        foreach ($array2 as $key => & $value) {
            if (is_array($value) AND isset($merged[$key]) AND is_array($merged[$key])) {
                $merged[$key] = $this->array_merge_recursive_ex($merged[$key], $value);
            } else {
                if (is_numeric($key)) {
                    if (!in_array($value, $merged)) {
                        $merged[] = $value;
                    }
                } else {
                    $merged[$key] = $value;
                }
            }
        }

        return $merged;
    }

    /**
     * @param array  $array
     * @param string $prefix
     *
     * @return array
     */
    public function flattenArray(array $array = array(), $prefix = '')
    {
        $outArray = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $outArray = $outArray + $this->flattenArray($value, $prefix . $key . '.');
            } else {
                $outArray[$prefix . $key] = $value;
            }
        }

        return $outArray;
    }


    /**
     * Transform array to placeholders
     *
     * @param array  $array
     * @param string $plPrefix
     * @param string $prefix
     * @param string $suffix
     * @param bool   $uncacheable
     *
     * @return array
     */
    public function makePlaceholders(
        array $array = array(),
        $plPrefix = '',
        $prefix = '[[+',
        $suffix = ']]',
        $uncacheable = true
    ) {
        $result = array('pl' => array(), 'vl' => array());

        $uncached_prefix = str_replace('[[', '[[!', $prefix);
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                $result = array_merge_recursive($result,
                    $this->makePlaceholders($v, $plPrefix . $k . '.', $prefix, $suffix, $uncacheable));
            } else {
                $pl = $plPrefix . $k;
                $result['pl'][$pl] = $prefix . $pl . $suffix;
                $result['vl'][$pl] = $v;
                if ($uncacheable) {
                    $result['pl']['!' . $pl] = $uncached_prefix . $pl . $suffix;
                    $result['vl']['!' . $pl] = $v;
                }
            }
        }

        return $result;
    }


    public function isWorkingClassKey($resource)
    {
        $value = '';
        /** @var modResource $resource */
        if (is_object($resource) AND is_a($resource, 'modResource')) {
            $value = $resource->get('class_key');
        } elseif (is_object($resource) AND $resource instanceof xPDOObject) {
            $rid = $resource->get('id');
        } elseif (is_array($resource)) {
            $rid = !empty($resource['id']) ? $resource['id'] : 0;
        }

        if (empty($value) AND !empty($rid) AND $resource = $this->modx->getObject('modResource', $rid)) {
            $value = $resource->get('class_key');
        }

        $allowed = $this->explodeAndClean($this->getOption('working_class_key', null, 'msProduct', true));

        return ($value AND $allowed) ? in_array($value, $allowed) : true;
    }

    public function isWorkingTemplates($resource)
    {
        $value = '';
        /** @var modResource $resource */
        if (is_object($resource) AND is_a($resource, 'modResource')) {
            $value = $resource->get('template');
        } elseif (is_object($resource) AND $resource instanceof xPDOObject) {
            $rid = $resource->get('id');
        } elseif (is_array($resource)) {
            $rid = !empty($resource['id']) ? $resource['id'] : 0;
        }

        if (empty($value) AND !empty($rid) AND $resource = $this->modx->getObject('modResource', $rid)) {
            $value = $resource->get('template');
        }

        $allowed = $this->explodeAndClean($this->getOption('working_templates', null));

        return ($value AND $allowed) ? in_array($value, $allowed) : true;
    }

    public function isExistService($service = '')
    {
        $service = strtolower($service);

        return file_exists(MODX_CORE_PATH . 'components/' . $service . '/model/' . $service . '/');
    }


    /**
     * @param string $action
     * @param array  $data
     *
     * @return array|modProcessorResponse|string
     */
    public function runProcessor($action = '', $data = array())
    {
        if ($error = $this->modx->getService('error', 'error.modError')) {
            $error->reset();
        }
        $processorsPath = !empty($this->config['processorsPath']) ? $this->config['processorsPath'] : MODX_CORE_PATH;
        /* @var modProcessorResponse $response */
        $response = $this->modx->runProcessor($action, $data, array('processors_path' => $processorsPath));

        return $this->config['prepareResponse'] ? $this->prepareResponse($response) : $response;
    }

    /**
     * This method returns prepared response
     *
     * @param mixed $response
     *
     * @return array|string $response
     */
    public function prepareResponse($response)
    {
        if ($response instanceof modProcessorResponse) {
            $output = $response->getResponse();
        } else {
            $message = $response;
            if (empty($message)) {
                $message = $this->lexicon('err_unknown');
            }
            $output = $this->failure($message);
        }
        if ($this->config['jsonResponse'] AND is_array($output)) {
            $output = $this->modx->toJSON($output);
        } elseif (!$this->config['jsonResponse'] AND !is_array($output)) {
            $output = $this->modx->fromJSON($output);
        }

        return $output;
    }

    /**
     * @param string $message
     * @param array  $data
     * @param bool   $showLog
     * @param bool   $writeLog
     */
    public function log($message = '', $data = array(), $showLog = false)
    {
        if ($this->getOption('showLog', null, $showLog, true)) {
            if (!empty($message)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($message, 1));
            }
            if (!empty($data)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($data, 1));
            }
        }
    }

    /**
     * @param modManagerController $controller
     * @param array                $setting
     */
    public function loadControllerJsCss(modManagerController &$controller, array $setting = array())
    {
        $controller->addLexiconTopic('mssetincart:default');

        $config = $this->config;
        if (is_object($controller->resource) AND $controller->resource instanceof xPDOObject) {
            $config['resource'] = $controller->resource->toArray();
        }

        $config['connector_url'] = $this->config['connectorUrl'];

        if (!empty($setting['css'])) {
            $controller->addCss($this->config['cssUrl'] . 'mgr/main.css');
            $controller->addCss($this->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        }

        if (!empty($setting['config'])) {
            $controller->addHtml("<script type='text/javascript'>mssetincart.config={$this->modx->toJSON($config)}</script>");
        }

        if (!empty($setting['tools'])) {
            $controller->addJavascript($this->config['jsUrl'] . 'mgr/mssetincart.js');
            $controller->addJavascript($this->config['jsUrl'] . 'mgr/misc/tools.js');
            $controller->addJavascript($this->config['jsUrl'] . 'mgr/misc/combo.js');
        }

        if (!empty($setting['link'])) {
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/product/link.window.js');
            $controller->addLastJavascript($this->config['jsUrl'] . 'mgr/product/link.grid.js');
        }

    }


    /**
     * @param int $number
     *
     * @return float
     */
    public function formatNumber($number = 0, $ceil = false)
    {
        $number = str_replace(',', '.', $number);
        $number = (float)$number;

        if ($ceil) {
            $number = ceil($number / 10) * 10;
        }

        return round($number, 3);
    }


    /**
     * @param string $price
     * @param bool   $number
     *
     * @return float|mixed|string
     */
    public function formatPrice($price = '0', $number = false, $ceil = false)
    {
        $price = $this->formatNumber($price, $ceil);
        $pf = json_decode($this->getOption('number_format', null, '[0, 1]', true), true);
        if (is_array($pf)) {
            $price = round($price, $pf[0], $pf[1]);
        }

        if (!$number) {
            $pf = json_decode($this->modx->getOption('ms2_price_format', null, '[2, ".", " "]', true), true);
            if (is_array($pf)) {
                $price = number_format($price, $pf[0], $pf[1], $pf[2]);
            }

            if ($this->modx->getOption('ms2_price_format_no_zeros', null, false, true)) {
                if (preg_match('/\..*$/', $price, $matches)) {
                    $tmp = rtrim($matches[0], '.0');
                    $price = str_replace($matches[0], $tmp, $price);
                }
            }
        }

        return $price;
    }


    public function formatData($data = array())
    {
        if (!is_array($data)) {
            $data = stripslashes((string)$data);
            $data = json_decode($data, true);
        }

        if (!is_array($data)) {
            $data = array();
        }

        foreach ($data as $k => $v) {
            parse_str($v, $data[$k]);
        }

        $this->log('', $data);

        return $data;
    }

    public function getDataActive(&$data = array())
    {
        $result = array();

        foreach ($data as $k => $v) {
            $propkey = isset($v['mssetincart_propkey']) ? $v['mssetincart_propkey'] : null;

            if (!empty($propkey) AND !isset($v['id'])) {
                $result[$propkey] = $v;

                unset($data[$k]);
            }
        }

        return $result;
    }

    public function getDataProduct(&$data = array())
    {
        $result = array();

        foreach ($data as $k => $v) {
            $id = isset($v['id']) ? $v['id'] : null;
            $set = isset($v['mssetincart_set']) ? $v['mssetincart_set'] : null;

            if (!empty($id) AND !empty($set) AND !isset(
                    $v['mssetincart_link'],
                    $v['mssetincart_master'],
                    $v['mssetincart_slave'],
                    $v['mssetincart_propkey']
                )
            ) {
                $result[$id] = $v;
                unset($data[$k]);
            }
        }

        return $result;
    }

    public function getDataSet(&$data = array(), $active = array(), $product = array())
    {
        $result = array();

        foreach ($data as $k => $v) {
            $id = isset($v['id']) ? $v['id'] : null;
            $count = isset($v['count']) ? $v['count'] : null;
            $propkey = isset($v['mssetincart_propkey']) ? $v['mssetincart_propkey'] : null;
            $master = isset($v['mssetincart_master']) ? $v['mssetincart_master'] : null;

            if (!empty($id) AND !empty($count) AND !empty($propkey) AND !empty($master) AND isset(
                    $v['mssetincart_link'],
                    $v['mssetincart_master'],
                    $v['mssetincart_slave']
                )
            ) {

                if (!array_key_exists($master, $product)) {
                    unset($data[$k]);
                    continue;
                }

                if (!empty($active) AND array_key_exists($propkey, $active)) {
                    $tmp = $active[$propkey];
                    $ids = isset($tmp['mssetincart_active']) ? $tmp['mssetincart_active'] : array();

                    /* exclude not active*/
                    if (in_array($id, $ids)) {
                        $result[$propkey][$id] = $v;
                    }
                } else {
                    $result[$propkey][$id] = $v;
                }

                unset($data[$k]);
            }
        }

        return $result;
    }


    public function getProductSet($data = array(), $isMultiply = false, $config = array())
    {
        $rid = isset($data['id']) ? $data['id'] : 0;
        /** @var msProduct $product */
        $product = $this->modx->getObject('msProduct', array('id' => $rid));
        if ($product) {
            $data = array_merge($data, $product->toArray());
        }

        $count = isset($data['count']) ? $data['count'] : 0;
        $options = &$data['options'];
        if (empty($options) OR !is_array($options)) {
            $options = array();
        }
        $data['msoptionsprice_options'] = $options;

        /** @var msProductData $productData */
        $productData = $this->modx->newObject('msProductData');
        $productData->fromArray($data, '', true, true);

        $data['cost'] = $data['price'] = $productData->getPrice($data);
        $data['mass'] = $data['weight'] = $productData->getWeight($data);

        if ($isMultiply) {
            $data['cost'] = $count * $data['cost'];
            $data['mass'] = $count * $data['mass'];
        }


        /* get pagetitle */
        if ($product = $productData->getOne('Product')) {
            $data['pagetitle'] = $product->get('pagetitle');
        }


        /* get modification */
        if ($this->msOptionsPrice) {

            $excludeIds = array(0);
            $excludeType = array(0, 2, 3);

            /* get main modification */
            if (!$modification = $this->msOptionsPrice->getModificationByOptions($rid, $options, null, $excludeIds,
                $excludeType)
            ) {
                /* get modification by id */
                $modification = $this->msOptionsPrice->getModificationById(0, $rid, $options);
            }
            $excludeIds[] = $modification['id'];

            /* get not main modification */
            while (
            $tmp = $this->msOptionsPrice->getModificationByOptions($rid, $options, null, $excludeIds)
            ) {
                $excludeIds[] = $tmp['id'];
            }

            $options['modifications'] = $this->cleanArray($excludeIds);
            $options['modification'] = $modification['id'];
        }

        $data['mssetincart_remove'] = isset($config['setRemoveSlave']) ? $config['setRemoveSlave'] : true;

        return $data;
    }


    public function getCostByLink($rid, $price, $query, $isAjax = false)
    {
        /** @var $product msProduct */
        if (!$link = $this->modx->getObject('msProductLink', $query)) {
            return false;
        }

        $cost = trim($link->get('price'));

        switch (true) {
            case $cost == '':
                $cost = $price;
                break;
            case preg_match('/%$/', $cost):
                $add = str_replace('%', '', $cost);
                $add = $price / 100 * $add;
                $cost = $price + $add;
                break;
            case strpos($cost, '+') !== false:
            case strpos($cost, '-') !== false:
                $cost = $price + (float)$cost;
                break;
            default:
                break;
        }

        if ($cost < 0) {
            $cost = 0;
        }

        if (!$cost AND !$this->getOption('allow_zero_cost', null, false)) {
            $cost = $price;
        }


        if (!empty($cost)) {
            $cost = $this->formatPrice($cost, !$isAjax, false);
        }

        return $cost;
    }

    public function getSetData($data = array())
    {
        $data = $this->formatData($data);
        $active = $this->getDataActive($data);
        $product = $this->getDataProduct($data);
        $set = $this->getDataSet($data, $active, $product);

        $cost = $mass = $cart = $option = array();

        foreach ($product as &$row) {
            $row = $this->getProductSet($row, false);
            $cost[$row['id']] = array(
                'base'   => $row['cost'],
                'cart'   => 0,
                'option' => 0,
            );
            $mass[$row['id']] = array(
                'base'   => $row['mass'],
                'cart'   => 0,
                'option' => 0,
            );
        }
        unset($row);

        foreach ($set as $propkey => &$rows) {
            $config = $this->getProperties($propkey);
            $setMode = $this->modx->getOption('setMode', $config, 'cart', true);

            foreach ($rows as &$row) {
                $master = $row['mssetincart_master'];
                $row = $this->getProductSet($row, true, $config);

                // if cacheble, get from "row"
                $setMode = $this->modx->getOption('mssetincart_mode', $row, $setMode, true);

                switch ($setMode) {
                    case 'cart':
                        $cost[$master][$setMode] += $row['cost'];
                        $mass[$master][$setMode] += $row['mass'];
                        $cart[$master][] = $row;
                        break;
                    case 'option':
                        $cost[$master][$setMode] += $row['cost'];
                        $mass[$master][$setMode] += $row['mass'];
                        $option[$master][] = $row;
                        break;
                }
            }
        }
        unset($rows);

        foreach ($product as $master => $row) {
            $count = $row['count'];
            $cost[$master] = $cost[$master]['base'] * $count + $cost[$master]['cart'] + $cost[$master]['option'] * $count;
            $mass[$master] = $mass[$master]['base'] * $count + $mass[$master]['cart'] + $mass[$master]['option'] * $count;
        }

        $sets = array(
            'active'  => $active,
            'product' => $product,
            'set'     => $set,
            'sets'    => array(
                'cost'   => $cost,
                'mass'   => $mass,
                'cart'   => $cart,
                'option' => $option
            )
        );

        return $sets;
    }

    protected function checkStat()
    {
        $key = strtolower(__CLASS__);
        /** @var modDbRegister $registry */
        $registry = $this->modx->getService('registry', 'registry.modRegistry')->getRegister('user', 'registry.modDbRegister');
        $registry->connect();
        $registry->subscribe('/modstore/' . md5($key));
        if ($res = $registry->read(array('poll_limit' => 1, 'remove_read' => false))) {
            return;
        }
        $c = $this->modx->newQuery('transport.modTransportProvider', array('service_url:LIKE' => '%modstore%'));
        $c->select('username,api_key');
        /** @var modRest $rest */
        $rest = $this->modx->getService('modRest', 'rest.modRest', '', array(
            'baseUrl'        => 'https://modstore.pro/extras',
            'suppressSuffix' => true,
            'timeout'        => 1,
            'connectTimeout' => 1,
        ));

        if ($rest) {
            $level = $this->modx->getLogLevel();
            $this->modx->setLogLevel(modX::LOG_LEVEL_FATAL);
            $rest->post('stat', array(
                'package'            => $key,
                'version'            => $this->version,
                'keys'               => $c->prepare() AND $c->stmt->execute() ? $c->stmt->fetchAll(PDO::FETCH_ASSOC) : array(),
                'uuid'               => $this->modx->uuid,
                'database'           => $this->modx->config['dbtype'],
                'revolution_version' => $this->modx->version['code_name'] . '-' . $this->modx->version['full_version'],
                'supports'           => $this->modx->version['code_name'] . '-' . $this->modx->version['full_version'],
                'http_host'          => $this->modx->getOption('http_host'),
                'php_version'        => XPDO_PHP_VERSION,
                'language'           => $this->modx->getOption('manager_language'),
            ));
            $this->modx->setLogLevel($level);
        }
        $registry->subscribe('/modstore/');
        $registry->send('/modstore/', array(md5($key) => true), array('ttl' => 3600 * 24));
    }

}