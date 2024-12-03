<?php
require_once dirname(__FILE__) . '/yandexmarket.class.php';
require_once dirname(dirname(dirname(__FILE__))) . '/vendor/autoload.php';

use \ForceUTF8\Encoding;

/**
 * MODx Msie Class
 *
 * @package msimportexport
 */
class Msie
{

    const MODE_IMPORT = 'import';
    const MODE_EXPORT = 'export';
    const  LOCK_FILE_CRON = 'msim_cron.lock';
    const version = '1.4.21';
    /** @var MsieController $controller */
    public $controller;
    /** @var array $initialized */
    public $initialized = array();
    /** @var int $root_category_id */
    public $root_category_id = null;
    /** @var string $siteUrl */
    public $siteUrl;
    /** @var array $treeCategoriesId */
    public $treeCategoriesId = array();
    /** @var array $categoryIds */
    public $categoryIds = array();
    /** @var array $trackTitleParent */
    public $trackTitleParent = array();
    /** @var array $categories */
    public $categories = array();
    /** @var array $ids */
    public $ids = array();
    /** @var array $linkIds */
    public $linkIds = array();
    /** @var array $galleryProductIds */
    public $galleryProductIds = array();
    /** @var array $productIds */
    public $productIds = array();
    /** @var array $$productIdsByKey */
    public $productIdsByKey = array();
    /** @var array $sourceBasePath */
    public $sourceBasePath = array();
    /** @var array $productOptionMeta */
    public $productOptionMeta = array();
    /* @var miniShop2 $miniShop2 */
    public $miniShop2 = null;
    /* @var ms2Gallery $ms2Gallery */
    public $ms2Gallery = null;
    /** @var msoptionsprice $optionsPrice2 */
    public $optionsPrice2 = null;
    /** @var msoptionscolor $optionscolor */
    public $optionscolor = null;
    /** @var msSalePrice $saleprice */
    public $saleprice = null;
    /** @var string $ctx */
    public $ctx = 'web';
    /** @var string */
    public $namespace = 'msimportexport';

    /**
     * Creates an instance of the Msie class.
     *
     * @param modX &$modx A reference to the modX instance.
     * @param array $config An array of configuration parameters.
     * @return Msie
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;
        $this->modx->lexicon->load('msimportexport:default');
        $this->modx->lexicon->load('minishop2:default');
        $corePath = $this->modx->getOption('msimportexport.core_path', $config, $this->modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/msimportexport/');
        $assetsUrl = $this->modx->getOption('msimportexport.assets_url', $config, $this->modx->getOption('assets_url') . 'components/msimportexport/');
        $assetsPath = $this->modx->getOption('msimportexport.assets_path', $config, $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/msimportexport/');
        $pathPhpInterpreter = $this->modx->getOption('msimportexport.import.path_php_interpreter', null, 'php');
        $this->config = array_merge(array(
            'namespace' => 'msimportexport',
            'chunksPath' => $corePath . 'elements/chunks/',
            'controllersPath' => $corePath . 'controllers/',
            'corePath' => $corePath,
            'uploadPath' => $assetsPath . 'upload/',
            'exportPath' => $this->modx->getOption('msimportexport.export_path', null, $assetsPath . 'export/', true),
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'modelPath' => $corePath . 'model/',
            'processorsPath' => $corePath . 'processors/',
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'templatesPath' => $corePath . 'elements/templates/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'managerUrl' => MODX_MANAGER_URL,
            'exportUrl' => $assetsUrl . 'export.php',
            'pathPhpInterpreter' => $pathPhpInterpreter,
            'cronScript' => $corePath . 'cron.php 1> /dev/null 2>&1',
            'token' => $this->getToken(),
            'manager_url' => $this->modx->config['manager_url'],
            'msproductremains' => $this->modx->getOption('mspr_core_path', $config, $this->modx->getOption('core_path') . 'components/msproductremains/model/'),
            'corePathMiniShop2' => $this->modx->getOption('minishop2.core_path', null, $this->modx->getOption('core_path') . 'components/minishop2/'),
            'corePathMs2gallery' => $this->modx->getOption('ms2gallery.core_path', null, $this->modx->getOption('core_path') . 'components/ms2gallery/'),
        ), $config);
        $this->siteUrl = MODX_URL_SCHEME . MODX_HTTP_HOST;
        $this->ctx = $this->modx->getOption('msimportexport.import.ctx', null, 'web', true);
        $this->modx->addPackage('msimportexport', $this->config['modelPath']);
        if ($this->hasPlugin('ms2gallery')) {
            $this->modx->lexicon->load('ms2gallery:default');
            $this->modx->addPackage('ms2gallery', $this->config['corePathMs2gallery'] . 'model/');
        }
        $memoryLimit = $this->modx->getOption('msimportexport.memory_limit', null, 0, true);
        set_time_limit($this->modx->getOption('msimportexport.time_limit', null, 600, true));
        if (!empty($memoryLimit)) ini_set('memory_limit', $memoryLimit . 'M');
        // $this->checkStat();
    }


    /**
     * @param string $ctx
     * @param array $scriptProperties
     * @return mixed
     */
    public function initialize($ctx = 'web', $scriptProperties = array())
    {
        if (isset($this->initialized[$ctx])) {
            return $this->initialized[$ctx];
        }
        $this->config = array_merge($this->config, $scriptProperties);
        $this->ctx = $ctx;
        $this->initialized[$ctx] = true;
    }


    /**
     * Load the appropriate controller
     * @param string $controller
     * @return null|MsieController
     */
    public function loadController($controller)
    {
        if ($this->modx->loadClass('MsieController', $this->config['modelPath'] . 'msimportexport/', true, true)) {
            $classPath = $this->config['controllersPath'] . 'web/' . mb_strtolower($controller) . '.php';
            $className = 'msImportExport' . $controller . 'Controller';
            if (file_exists($classPath)) {
                if (!class_exists($className)) {
                    $className = require_once $classPath;
                }
                if (class_exists($className)) {
                    $this->controller = new $className($this, $this->config);
                } else {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] Could not load controller: ' . $className . ' at ' . $classPath);
                }
            } else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] Could not load controller file: ' . $classPath);
            }
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] Could not load MsieController class.');
        }
        return $this->controller;
    }

    /**
     * Loads the Validator class.
     *
     * @access public
     * @param string $type The name to give the service on the msie object
     * @param array $config An array of configuration parameters for the
     * MsieValidator class
     * @return MsieValidator An instance of the MsieValidator class.
     */
    public function loadValidator($type = 'validator', $config = array())
    {
        if (!$this->modx->loadClass('MsieValidator', $this->config['modelPath'], true, true)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] Could not load Validator class.');
            return false;
        }
        $this->$type = new MsieValidator($this, $config);
        return $this->$type;
    }

    /**
     * Helper function to get a chunk or tpl by different methods.
     *
     * @access public
     * @param string $name The name of the tpl/chunk.
     * @param array $properties The properties to use for the tpl/chunk.
     * @param string $type The type of tpl/chunk. Can be embedded,
     * modChunk, file, or inline. Defaults to modChunk.
     * @return string The processed tpl/chunk.
     */
    public function getChunk($name, $properties, $type = 'modChunk')
    {
        $output = '';
        switch ($type) {
            case 'embedded':
                if (!$this->modx->user->isAuthenticated($this->modx->context->get('key'))) {
                    $this->modx->setPlaceholders($properties);
                }
                break;
            case 'modChunk':
                $output .= $this->modx->getChunk($name, $properties);
                break;
            case 'file':
                $name = str_replace(array(
                    '{base_path}',
                    '{assets_path}',
                    '{core_path}',
                ), array(
                    $this->modx->getOption('base_path'),
                    $this->modx->getOption('assets_path'),
                    $this->modx->getOption('core_path'),
                ), $name);
                $output .= file_get_contents($name);
                $this->modx->setPlaceholders($properties);
                break;
            case 'inline':
            default:
                /* default is inline, meaning the tpl content was provided directly in the property */
                $chunk = $this->modx->newObject('modChunk');
                $chunk->setContent($name);
                $chunk->setCacheable(false);
                $output .= $chunk->process($properties);
                break;
        }
        return $output;
    }


    /**
     * @return array
     */
    public function getContexts($exclude = array())
    {
        $contexts = array();
        $query = $this->modx->newQuery('modContext');
        $query->select($this->modx->escape('key'));
        if ($exclude) {
            $query->where(array('key:NOT IN' => $exclude));
        }
        if ($query->prepare() && $query->stmt->execute()) {
            $contexts = $query->stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        return $contexts;
    }


    /**
     * @return msoptionsprice|null
     */
    public function getInstanceOptionsPrice2()
    {
        if (!$this->hasPlugin('msoptionsprice')) return null;
        if (!$this->optionsPrice2) {
            $this->optionsPrice2 = $this->modx->getService('msoptionsprice');
        }
        return $this->optionsPrice2;
    }

    public function getInstanceOptionsColor()
    {
        if (!$this->hasPlugin('msoptionscolor')) return null;
        if (!$this->optionscolor) {
            $this->optionscolor = $this->modx->getService('msoptionscolor');
        }
        return $this->optionscolor;
    }

    public function getInstanceSalePrice()
    {
        if (!$this->hasPlugin('mssaleprice')) return null;
        if (!$this->saleprice) {
            $this->saleprice = $this->modx->getService('mssaleprice', 'msSalePrice', $this->modx->getOption('mssaleprice_core_path', null,
                    $this->modx->getOption('core_path') . 'components/mssaleprice/') . 'model/mssaleprice/'
            );
        }
        return $this->saleprice;
    }

    public function getInstanceProductRemains()
    {
        if (!$this->hasPlugin('msproductremains')) return null;
        return $this->modx->getService('msproductremains', 'msProductRemains', $this->modx->getOption('mspr_core_path', null, $this->modx->getOption('core_path') . 'components/msproductremains/') . 'model/msproductremains/');
    }


    /**
     * @return miniShop2|null
     */
    public function getInstanceMiniShop2()
    {
        if (!$this->miniShop2) {
            $this->miniShop2 = $this->modx->getService('miniShop2');
            $this->miniShop2->initialize($this->ctx);
        }
        return $this->miniShop2;
    }

    /**
     * @param string $key
     * @param string $value
     * @param bool $clearCache
     * @return bool
     */
    public function setOption($key, $value, $clearCache = true)
    {
        if (empty(trim($key))) return false;
        //$this->modx->log(modX::LOG_LEVEL_ERROR, '$key='.$key.'  $value='.$value);
        if (!$setting = $this->modx->getObject('modSystemSetting', $key)) {
            $setting = $this->modx->newObject('modSystemSetting');
            $setting->set('namespace', $this->config['namespace']);
        }
        $setting->set('value', $value);
        if ($setting->save()) {
            $this->modx->config[$key] = $value;
            if ($clearCache) {
                $this->modx->cacheManager->refresh(array('system_settings' => array()));
            }
            return true;
        }
        return false;
    }


    /**
     * Get the true client IP. Returns an array of values:
     *
     * * ip - The real, true client IP
     * * suspected - The suspected IP, if not alike to REMOTE_ADDR
     * * network - The client's network IP
     *
     * @access public
     * @return array
     */
    public function getClientIp()
    {
        $ip = '';
        $ipAll = array(); // networks IP
        $ipSus = array(); // suspected IP

        $serverVariables = array(
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_X_CLUSTER_CLIENT_IP',
            'HTTP_X_COMING_FROM',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'HTTP_COMING_FROM',
            'HTTP_CLIENT_IP',
            'HTTP_FROM',
            'HTTP_VIA',
            'REMOTE_ADDR',
        );

        foreach ($serverVariables as $serverVariable) {
            $value = '';
            if (isset($_SERVER[$serverVariable])) {
                $value = $_SERVER[$serverVariable];
            } elseif (getenv($serverVariable)) {
                $value = getenv($serverVariable);
            }

            if (!empty($value)) {
                $tmp = explode(',', $value);
                $ipSus[] = $tmp[0];
                $ipAll = array_merge($ipAll, $tmp);
            }
        }

        $ipSus = array_unique($ipSus);
        $ipAll = array_unique($ipAll);
        $ip = (sizeof($ipSus) > 0) ? $ipSus[0] : $ip;

        return array(
            'ip' => $ip,
            'suspected' => $ipSus,
            'network' => $ipAll,
        );
    }

    /**
     * @param $str
     * @param array $varArr
     * @param string $prefix
     * @param string $suffix
     * @return mixed
     */
    public function parseString($str, $varArr = array(), $prefix = '[[+', $suffix = ']]')
    {
        if (is_array($varArr)) {
            reset($varArr);
            while (list($key, $value) = each($varArr)) {
                $str = str_replace($prefix . $key . $suffix, $value, $str);
            }
        }
        return $str;
    }


    /**
     * @param string $text
     * @param string $postfix
     * @return string
     */
    public function createAlias($text, $postfix = '')
    {
        $res = $this->modx->newObject('modResource');
        $delimiter = $this->modx->getOption('friendly_alias_word_delimiter', null, '-');
        $alias = $res->cleanAlias($text);
        return empty($postfix) ? $alias : ($alias . $delimiter . $postfix);
    }

    /**
     * @param string $pagetitle
     * @param bool $onlyRootCatalog
     * @param string $ctx
     * @return int
     */
    public function getProductIdByPageTitle($pagetitle = '', $onlyRootCatalog = false, $ctx = '')
    {
        $id = 0;
        $ctx = $ctx ? $ctx : $this->ctx;
        if (empty($pagetitle)) return $id;
        $checkAlias = $this->modx->getOption('msimportexport.import.check_alias', null, 1);
        $q = $this->modx->newQuery('modResource');
        if ($checkAlias) {
            $q->where(array(
                'pagetitle:=' => $pagetitle,
                'OR:alias:=' => $this->createAlias($pagetitle),
            ));
            $q->where(array(
                'context_key:=' => $ctx,
            ));
        } else {
            $q->where(array(
                'pagetitle:=' => trim($pagetitle),
                'context_key:=' => $ctx,
            ));
        }
        if ($onlyRootCatalog) {
            $q->where(array(
                'id:IN' => $this->getChildIds($this->getRootCategoryId($ctx)),
            ));
        }
        $q->select('id');
        if ($q->prepare() && $q->stmt->execute()) {
            $id = $q->stmt->fetch(PDO::FETCH_COLUMN);
        }
        return $id ? $id : 0;
    }

    /**
     * @param array $data
     * @param string $ctx
     * @return int
     */
    public function getResourceIdByData($data = array(), $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        if (!isset($data['context_key'])) $data['context_key'] = $ctx;
        $checkAlias = $this->modx->getOption('msimportexport.import.check_alias', null, 1);
        $q = $this->modx->newQuery('modResource');
        if ($checkAlias && isset($data['pagetitle'])) {
            $q->where(array(
                'pagetitle:=' => $data['pagetitle'],
                'OR:alias:=' => $this->createAlias($data['pagetitle']),
            ));
            unset($data['pagetitle']);
        }
        $q->where($data);
        $q->select('id');
        $id = 0;
        if ($q->prepare() && $q->stmt->execute()) {
            $id = $q->stmt->fetch(PDO::FETCH_COLUMN);
        }
        return $id ? $id : 0;
    }

    /**
     * @param $id
     * @return string
     */
    public function getResourcePageTitleById($id)
    {
        $q = $this->modx->newQuery('modResource');
        $q->where(array('id' => $id));
        $q->select('pagetitle');
        if ($q->prepare() && $q->stmt->execute()) {
            $pagetitle = $q->stmt->fetch(PDO::FETCH_COLUMN);
        }
        return $pagetitle ? $pagetitle : '';
    }


    /**
     * @param string $name
     * @param bool $cache
     * @param bool|null $onlyRootCatalog
     * @param string $ctx
     * @return int
     */
    public function getCategoryIdByName($name, $cache = true, $onlyRootCatalog = null, $ctx = '')
    {
        if ($cache && isset($this->categoryIds[$name])) {
            return $this->categoryIds[$name];
        } else {
            $ctx = $ctx ? $ctx : $this->ctx;
            if ($id = $this->getProductIdByPageTitle($name, $onlyRootCatalog, $ctx)) {
                $this->categoryIds[$name] = $id;
                return $id;
            }
        }
        return 0;
    }

    /**
     * @param string $name
     * @param int $parentId
     * @param string $ctx
     * @return int
     */
    public function checkSubCategoryByName($name, $parentId, $ctx = '')
    {
        $q = $this->modx->newQuery('modResource');
        $q->where(array(
            'pagetitle:=' => trim($name),
            'parent:=' => $parentId,
            'context_key:=' => $ctx,
        ));
        $r = $this->modx->getObject('modResource', $q);
        return $r ? $r->get('id') : 0;
    }

    /**
     * @param string $name
     * @param bool $cache
     * @param bool|null $onlyRootCatalog
     * @param string $ctx
     * @return array
     */
    public function getCategoryDataByName($name, $cache = true, $onlyRootCatalog = null, $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $onlyRootCatalog = $onlyRootCatalog === null ? filter_var($this->modx->getOption('msimportexport.import.use_only_root_catalog', null, 0), FILTER_VALIDATE_BOOLEAN) : $onlyRootCatalog;
        if ($cache && isset($this->categories[$name])) {
            return $this->categories[$name];
        } else {
            $q = $this->modx->newQuery('modResource');
            $q->where(array(
                'pagetitle:=' => trim($name),
                'context_key:=' => $ctx,
            ));
            if ($onlyRootCatalog) {
                $q->where(array(
                    'id:IN' => $this->getChildIds($this->getRootCategoryId($ctx)),
                ));
            }
            if ($r = $this->modx->getObject('modResource', $q)) {
                $this->categories[$name] = $r->toArray();
                return $this->categories[$name];
            }
        }
        return array();
    }

    /**
     * @param string $ctx
     * @return int
     */
    public function getRootCategoryId($ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        if ($this->root_category_id == null) {
            $catalog = (int)$this->modx->getOption('msimportexport.import.root_catalog', null, 0);
            if (!empty($catalog)) {
                if ($this->modx->getObject('msCategory', array('id' => $catalog, 'context_key' => $ctx))) {
                    $this->root_category_id = $catalog;
                    return $catalog;
                }
            }
            $q = $this->modx->newQuery('msCategory');
            $q->where(array(
                'class_key:=' => 'msCategory',
                'context_key:=' => $ctx,
            ));
            $q->sortby('id');
            $r = $this->modx->getObject('msCategory', $q);
            $this->root_category_id = $r ? $r->get('id') : 0;

        }
        return $this->root_category_id;
    }

    /**
     * @param string $ctx
     * @return null|object
     */
    public function getRootCategory($ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        return $this->modx->getObject('msCategory', $this->getRootCategoryId($ctx));
    }

    /**
     * @param int $presetId
     * @param bool $log
     * @return bool
     */
    public function getPresetFields($presetId, $log = true)
    {
        $q = $this->modx->newQuery('MsiePresetsFields');
        $q->where(array('id:=' => $presetId));
        if ($preset = $this->modx->getObject('MsiePresetsFields', $q)) {
            $fields = $preset->get('fields');
            if (empty($fields) && $log)
                $this->modx->log(modX::LOG_LEVEL_ERROR, sprintf($this->modx->lexicon('msimportexport.err.preset_empty_fields'), $presetId));
            return array_map('trim', $fields);
        }
        if ($log) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, sprintf($this->modx->lexicon('msimportexport.err.ns_preset'), $presetId));
        }
        return false;
    }

    /**
     * @param int $presetId
     * @param string $default
     * @return string
     */
    public function getPresetCategories($presetId, $default = '')
    {
        if (empty($presetId)) return $default;
        $q = $this->modx->newQuery('MsiePresetsFields');
        $q->where(array('id:=' => $presetId));
        if ($preset = $this->modx->getObject('MsiePresetsFields', $q)) {
            if ($categories = $preset->get('categories')) {
                return $categories;
            }

        }
        return $default;
    }

    /**
     * @param int $presetId
     * @param string $default
     * @return string
     */
    public function getPresetKey($presetId, $default = '')
    {
        $q = $this->modx->newQuery('MsiePresetsFields');
        $q->where(array('id:=' => $presetId));
        if ($preset = $this->modx->getObject('MsiePresetsFields', $q)) {
            if ($key = $preset->get('key')) {
                return $key;
            }

        }
        return $default;
    }


    /**
     * @param int $presetId
     * @param string $def
     * @return string
     */
    public function getPresetWhere($presetId, $def = '')
    {
        $where = '';
        if ($preset = $this->modx->getObject('MsiePresetsFields', $presetId)) {
            $where = $preset->get('where');
        }
        return $where ? $where : $def;
    }

    /**
     * @param int $presetId
     * @param string $def
     * @return string
     */
    public function getPresetLeftJoin($presetId, $def = '')
    {
        if ($preset = $this->modx->getObject('MsiePresetsFields', $presetId)) {
            $leftjoin = $preset->get('leftjoin');
        }
        return $leftjoin ? $leftjoin : $def;
    }

    /**
     * @param int $presetId
     * @param string $def
     * @return string
     */
    public function getPresetInnerJoin($presetId, $def = '')
    {
        if ($preset = $this->modx->getObject('MsiePresetsFields', $presetId)) {
            $innerjoin = $preset->get('innerjoin');
        }
        return $innerjoin ? $innerjoin : $def;
    }

    /**
     * @param int $presetId
     * @param string $def
     * @return string
     */
    public function getPresetSelect($presetId, $def = '')
    {
        if ($preset = $this->modx->getObject('MsiePresetsFields', $presetId)) {
            $select = $preset->get('select');
        }
        return $select ? $select : $def;
    }

    /**
     * @param int $presetId
     * @param array $fields
     * @return bool
     */
    public function setPresetFields($presetId, $fields = array())
    {
        $arr = array();
        foreach ($fields as $key => $v) {
            if ($v != -1) {
                $arr[$key] = $v;
            }
        }
        $q = $this->modx->newQuery('MsiePresetsFields');
        $q->where(array('id:=' => $presetId));
        if ($preset = $this->modx->getObject('MsiePresetsFields', $q)) {
            $preset->set('fields', $arr);
            return $preset->save();
        }
        return false;
    }

    /**
     * @param string $name
     * @param int|null $parent
     * @param bool $toArr
     * @param bool $checkExist
     * @param string $ctx
     * @return bool|int|array
     */
    public function createCategory($name, $parent = null, $toArr = false, $checkExist = false, $ctx = '')
    {
        $name = trim($name);
        $resource = null;
        $ctx = $ctx ? $ctx : $this->ctx;
        $parent = $parent === null ? $this->getRootCategoryId($ctx) : $parent;
        $checkAlias = $this->modx->getOption('msimportexport.import.check_alias', null, 1);
        $templateCategory = (int)$this->modx->getOption('msimportexport.import.template_category', null, 0);
        $data = array(
            'pagetitle' => $name,
            'parent' => $parent,
            'context_key' => $ctx,
        );
        if ($checkExist) {
            if ($toArr) {
                $q = $this->modx->newQuery('modResource');
                if ($checkAlias) {
                    $q->where(array(
                        'pagetitle:=' => $data['pagetitle'],
                        'OR:alias:=' => $this->createAlias($data['pagetitle']),
                    ));
                    $q->where(array(
                        'parent:=' => $parent,
                        'context_key:=' => $ctx,
                    ));
                } else {
                    $q->where(array(
                        'pagetitle:=' => $data['pagetitle'],
                        'parent:=' => $parent,
                        'context_key:=' => $ctx,
                    ));
                }
                if ($resource = $this->modx->getObject('msCategory', $data)) {
                    $resource = $resource->toArray();
                }
            } else {
                if ($id = $this->getResourceIdByData($data)) {
                    return $id;
                }
            }
        }
        if (!$resource) {
            if (!empty($templateCategory)) {
                $data['template'] = $templateCategory;
            }
            $data['class_key'] = 'msCategory';
            $response = $this->modx->runProcessor('resource/create', $data);
            if ($response->isError()) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err_create_category') . ":\n" . print_r($response->getAllErrors(), 1));
                return false;
            }
            $resource = $response->getObject();
        }
        return $toArr ? $resource : $resource['id'];
    }

    /**
     * @param array $names
     * @param string $ctx
     * @return array
     */
    public function getCategoriesByName($names = array(), $ctx = '')
    {
        $result = array();
        $ctx = $ctx ? $ctx : $this->ctx;
        $onlyRootCatalog = filter_var($this->modx->getOption('msimportexport.import.use_only_root_catalog', null, 0), FILTER_VALIDATE_BOOLEAN);
        $q = $this->modx->newQuery('modResource');
        $q->where(array(
            'pagetitle:IN' => $names,
            'context_key:=' => $ctx,
        ));
        if ($onlyRootCatalog) {
            $q->where(array(
                'id:IN' => $this->getChildIds($this->getRootCategoryId($ctx)),
            ));
        }
        $q->select(array(
            'modResource.id',
            'modResource.pagetitle',
        ));
        $s = $q->prepare();
        $s->execute();
        foreach ($s->fetchAll(PDO::FETCH_ASSOC) as $item) {
            $result[$item['pagetitle']] = $item['id'];
        }
        return $result;
    }

    /**
     * @param string $ctx
     * @return bool
     */
    public function checkValidityСatalog($ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        if (filter_var($this->modx->getOption('import.check_validity_catalog', null, true), FILTER_VALIDATE_BOOLEAN)) {
            if (!$rootId = $this->getRootCategoryId($ctx)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err_nf_root_catalog'));
                return false;
            }

            $class = 'modResource';
            $where = array(
                'context_key:=' => $ctx,
                'isfolder:=' => 1,
                'class_key:NOT IN' => array('msCategory', 'msProduct')
            );
            $default = array(
                'class' => $class,
                'fastMode' => false,
                'return' => 'data',
                'parents' => $rootId,
                'limit' => 0,
                'depth' => 10,
                'where' => $this->modx->toJSON($where),
            );

            if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
                return false;
            }

            $pdoFetch = new pdoFetch($this->modx, $default);
            $rows = $pdoFetch->run();

            if (!empty($rows)) {
                $info = '';
                foreach ($rows as $v) {
                    $info .= "ID:{$v['id']}; Name:{$v['pagetitle']}\n";
                }
                $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err_invalid_setup_catalog') . $info);
                return false;
            }
        }
        return true;
    }


    /**
     * @param array $fields
     * @return array
     */
    public function checkValidityFields($fields = array())
    {
        if (!filter_var($this->modx->getOption('msieimport.check_validity_fields', null, true, true), FILTER_VALIDATE_BOOLEAN)) return array();
        $otherProps = array(
            'processors_path' => $this->config['processorsPath']
        );

        $arrFields = array();
        $response = $this->modx->runProcessor('mgr/fields/getlist', array('type' => 'all'), $otherProps);
        $data = $this->modx->fromJSON($response->response);
        $results = $data['results'];

        foreach ($fields as $field) {
            if ($field == -1) continue;
            if (!isset($results[$field])) {
                $arrFields[] = $field;
            }
        }

        return $arrFields;
    }


    /**
     * @return array
     */
    public function getListHeadAlias()
    {
        $result = array();
        $q = $this->modx->newQuery('MsieHeadAlias');
        $q->select(array(
            'MsieHeadAlias.*',
        ));
        $s = $q->prepare();
        $s->execute();
        foreach ($s->fetchAll(PDO::FETCH_ASSOC) as $item) {
            $result[$item['key']] = $item['value'];
        }
        return $result;
    }

    /**
     * @param array $fields
     * @param bool $clear
     * @return array
     */
    public function prepareHeadFields($fields = array(), $clear = false)
    {
        $result = array();
        if (!empty($fields)) {
            if ($alias = $this->getListHeadAlias()) {
                foreach ($fields as $field) {
                    if ($clear) {
                        $key = $this->clearPrefixKey($field);
                    } else {
                        $key = $field;
                    }
                    if (isset($alias[$key])) {
                        $result[] = $alias[$key];
                    } else {
                        if ($clear) {
                            $field = str_replace(array('msopm_', 'msopo_'), 'msop:', $field);
                            $field = str_replace(array('msoc_'), 'msoc:', $field);
                            $field = str_replace(array('mspr_'), 'mspr:', $field);
                        }
                        $result[] = $field;
                    }
                }
            }
        }
        return $result ? $result : $fields;
    }

    /**
     * @param string $key
     * @param array $pref
     * @return string
     */
    public function clearPrefixKey($key, $pref = array())
    {
        $prefix = array('product_', 'data_');
        $prefix = $pref ? array_merge($prefix, $pref) : $prefix;
        return str_replace($prefix, '', $key);
    }


    /**
     * @param array $treeCategories
     * @param string $ctx
     * @return array
     */
    public function getFirstNonExistentCategory($treeCategories = array(), $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $rTreeCategories = array_reverse($treeCategories);
        $count = count($rTreeCategories);
        if ($categories = $this->getCategoriesByName($rTreeCategories, $ctx)) {
            foreach ($rTreeCategories as $k => $v) {
                if (isset($categories[$v])) {
                    return array('index' => ($count - $k), 'parent' => $categories[$v]);
                }
            }
        } else {
            return array('index' => 0, 'parent' => $this->getRootCategoryId($ctx));
        }
    }

    /**
     * @param string $sCategories
     * @param string $ctx
     * @return int
     */
    public function createTreeCategories($categories, $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $delimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, '|');
        $aCategories = is_array($categories) ? $categories : array_map('trim', explode($delimeter, $categories));
        if ($aCategories) {
            $key = md5(implode($delimeter, $aCategories));
            if (!isset($this->treeCategoriesId[$key])) {
                // $parent = $this->getRootCategoryId();
                $parent = 0;
                foreach ($categories as $category) {
                    if (!$parent = $this->createCategory($category, $parent, false, true, $ctx)) {
                        $this->modx->log(modX::LOG_LEVEL_ERROR, '[createTreeCategories] unable to create category name:' . $category);
                        return 0;
                    }
                }
                $this->treeCategoriesId[$key] = $parent;
                return $parent;
            } else {
                return $this->treeCategoriesId[$key];
            }
        }
        return 0;
    }

    /**
     * @param int $productId
     * @param string $sCategories
     * @param int $parent
     * @param bool $clear
     * @param string $ctx
     * @return bool
     */
    public function addProductToSubCategories($productId, $sCategories, $parent = 0, $clear = true, $ctx = '')
    {
        $delimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, '|');
        $delimeter2 = $this->modx->getOption('msimportexport.import.sub_delimeter2', null, '%');
        $aCategories = array_map('trim', explode($delimeter, $sCategories));
        $ctx = $ctx ? $ctx : $this->ctx;
        if ($aCategories) {
            if ($clear) {
                $this->removeProductFromSubCategories($productId, $parent);
            }
            foreach ($aCategories as $category) {
                if (!is_numeric($category)) {
                    $pathCategories = array_map('trim', explode($delimeter2, $category));
                    $count = count($pathCategories);
                    if ($count == 1) {
                        $categoryId = $this->getCategoryIdByName($category, true, null, $ctx);
                    } else {
                        $categoryId = $this->createTreeCategories($pathCategories, $ctx);
                    }
                } else {
                    $categoryId = $category;
                }

                if ($categoryId) {
                    /* @var msCategoryMember $res */
                    $res = $this->modx->getObject('msCategoryMember', array('category_id' => $categoryId, 'product_id' => $productId));
                    if (!$res) {
                        $res = $this->modx->newObject('msCategoryMember');
                        $res->set('product_id', $productId);
                        $res->set('category_id', $categoryId);
                        $res->save();
                    }
                }
            }
        }
        return false;
    }

    /**
     * @param int $productId
     * @param int $parent
     * @param string $ctx
     */
    public function removeProductFromSubCategories($productId, $parent)
    {
        $q = $this->modx->newQuery('msCategoryMember');
        $q->where(array('product_id:=' => $productId, 'category_id:!=' => $parent));
        if ($c = $this->modx->getCollection('msCategoryMember', $q)) {
            foreach ($c as $item) {
                $item->remove();
            }
        }
    }

    /**
     * @param string $key
     * @return bool
     */
    public function isKeyArrayType($key)
    {

        if ($type = $this->getProductKeyType($key)) {
            if ($type == 'json' || $type == 'array') return true;
        } else if ($type = $this->getProductOptionKeyType($key)) {
            if ($type == 'combo-multiple' || $type == 'combo-options') return true;
        }
        return false;
    }


    /**
     * @param string $key
     * @return null|string
     */
    public function getProductKeyType($key)
    {
        $meta = $this->modx->getFieldMeta('msProductData');
        if (isset($meta[$key])) return $meta[$key]['phptype'];
        return null;

    }

    /**
     * @param string $key
     * @return null|string
     */
    public function getProductOptionKeyType($key)
    {
        $key = str_replace('options-', '', $key);
        $meta = $this->getProductOptionMeta();
        if (isset($meta[$key])) return $meta[$key]['type'];
        return null;
    }

    /**
     * @return array
     */
    public function getProductOptionMeta()
    {
        $classKey = 'msOption';
        if (!$this->productOptionMeta) {
            $q = $this->modx->newQuery($classKey);
            $q->select($this->modx->getSelectColumns($classKey, $classKey));
            if ($q->prepare() && $q->stmt->execute()) {
                while ($item = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                    $this->productOptionMeta[$item['key']] = $item;
                }
            }
        }
        return $this->productOptionMeta;
    }


    /**
     * @param int $parent
     * @param string $ctx
     * @return bool
     */
    public function hasParent($parent, $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $q = $this->modx->newQuery('msCategory');
        $q->where(array('id:=' => $parent, 'context_key:=' => $ctx));
        $q->prepare();
        $q->stmt->execute();
        return $q->stmt->fetchAll(PDO::FETCH_ASSOC) ? true : false;
    }

    /**
     * @param string $name
     * @return int
     */
    public function getVendorIdByName($name)
    {
        $q = $this->modx->newQuery('msVendor');
        $q->select(array('id'));
        $q->where(array('name:=' => $name));
        $q->prepare();
        $q->stmt->execute();
        return $q->stmt->fetchColumn();
    }

    /**
     * @param $name
     * @return int
     */
    public function addVendor($name)
    {
        $vendor = $this->modx->newObject('msVendor');
        $vendor->set('name', $name);
        if ($vendor->save()) {
            return $vendor->get('id');
        } else {
            return 0;
        }
    }


    /**
     * @param string $keywords
     * @param int $resourceId
     */
    public function addSeoKeywords($keywords = '', $resourceId)
    {
        $seoKeywords = $this->modx->getObject('seoKeywords', array('resource' => $resourceId));
        if (!$seoKeywords && isset($resourceId)) {
            $seoKeywords = $this->modx->newObject('seoKeywords', array('resource' => $resourceId));
        }
        if ($seoKeywords) {
            $seoKeywords->set('keywords', trim($keywords, ','));
            $seoKeywords->save();
        }
    }


    public function addPackageSeoPro()
    {
        if ($this->hasPlugin('seopro')) {
            // $seoPro = $this->modx->getService('seopro', 'seoPro',  $this->modx->getOption('seopro.core_path', null,  $this->modx->getOption('core_path') . 'components/seopro/') . 'model/seopro/', array());
            $corePath = $this->modx->getOption('seopro.core_path', null, $this->modx->getOption('core_path') . 'components/seopro/');
            $modelPath = $corePath . 'model/';
            $this->modx->addPackage('seopro', $modelPath);
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasPlugin($name)
    {
        return $this->modx->getObject('modNamespace', $name) ? true : false;
    }


    /**
     * @param string $parents
     * @param int $depth
     * @param int $limit
     * @param string $ctx
     * @return array|bool
     */
    public function getCategoryChildren($parents = '', $depth = 10, $limit = 0, $ctx = '')
    {
        // Default parameters
        $result = array();
        $class = 'msCategory'; //modResource
        $ctx = $ctx ? $ctx : $this->ctx;
        $where = array('class_key:=' => 'msCategory', 'show_in_tree:=' => 1, 'isfolder:=' => 1, 'context_key:=' => $ctx);
        $default = array(
            'class' => $class,
            'sortby' => $class . '.id',
            'sortdir' => 'ASC',
            //'groupby' => $class.'.parent',
            'fastMode' => false,
            'return' => 'data',
            'parents' => $parents,
            'limit' => $limit,
            'depth' => $depth,
            'where' => $this->modx->toJSON($where),
        );
        if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
            return false;
        }
        $pdoFetch = new pdoFetch($this->modx, $default);
        $children = $pdoFetch->run();
        unset($default['parents']);
        $where['id:IN'] = array_map('trim', explode(',', $parents));
        $where['id:!='] = $this->getRootCategoryId($ctx);
        $default['where'] = $this->modx->toJSON($where);
        $pdoFetch->setConfig($default);
        if ($data = array_merge($pdoFetch->run(), $children)) {
            foreach ($data as $item) {
                $result[$item['id']] = $item;
            }
        }

        return $result;
    }

    /**
     * @param $id
     * @param bool $useSelf
     * @param int $depth
     * @param int $limit
     * @param string $ctx
     * @return array|bool
     */
    public function getChildIds($id, $useSelf = true, $depth = 100, $limit = 0, $ctx = '')
    {
        $class = 'msCategory';
        $ctx = $ctx ? $ctx : $this->ctx;
        $where = array('class_key:=' => 'msCategory', 'show_in_tree:=' => 1, 'isfolder:=' => 1, 'context_key:=' => $ctx);
        $default = array(
            'class' => $class,
            'sortby' => $class . '.menuindex',
            'sortdir' => 'DESC',
            'fastMode' => false,
            'return' => 'ids',
            'parents' => $id,
            'limit' => $limit,
            'depth' => $depth,
            'where' => $this->modx->toJSON($where),
        );
        if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
            return false;
        }
        $pdoFetch = new pdoFetch($this->modx, $default);
        return explode(',', $pdoFetch->run());
    }


    /**
     * @param array $data
     * @param string $ctx
     * @return array
     */
    public function getTreeCategories(array $data, $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $tvs = array();
        $tvPrefix = 'tv.';

        if (!empty($data['fields'])) {
            foreach ($data['fields'] as $v) {
                if (preg_match('/^tv\.([^\.][\w\.]+)$/', $v)) {
                    $tvs[] = str_replace("tv.", '', $v);

                }
            }
            unset($data['fields']);
        }

        $q = $this->modx->newQuery('msCategory');
        $q->select($this->modx->getSelectColumns('msCategory', 'msCategory'));

        if (!empty($tvs)) {
            $qTv = $this->modx->newQuery('modTemplateVar', array('name:IN' => $tvs));
            $qTv->select('id,name,type,default_text');
            if ($qTv->prepare() && $qTv->stmt->execute()) {
                while ($tv = $qTv->stmt->fetch(PDO::FETCH_ASSOC)) {
                    $name = strtolower($tv['name']);
                    $alias = 'TV' . $name;
                    $q->leftJoin('modTemplateVarResource', $alias, '`TV' . $name . '`.`contentid` = `msCategory`.`id` AND `TV' . $name . '`.`tmplvarid` = ' . $tv['id']);
                    $q->select('IFNULL(`' . $alias . '`.`value`, ' . $this->modx->quote($tv['default_text']) . ') AS `' . $tvPrefix . $tv['name'] . '`');
                }

            }
        }

        $where = array(
            'class_key:=' => 'msCategory',
            'context_key:=' => $ctx,
        );


        if (isset($data['where']) && !empty($data['where'])) {
            if (!is_array($data['where'])) {
                $tmp = $this->modx->fromJSON($data['where']);
                $tmp = $this->prepareWhere($tmp);
                if (is_array($tmp)) {
                    $where = array_merge($where, $tmp);
                }
            } else {
                $where = array_merge($where, $data['where']);
            }
        }

        if (isset($data['parents']) && !empty($data['parents'])) {
            $where[] = array(
                'id:IN' => $this->getAllChildIds($data['parents'], 10, $ctx),
            );
        }

        $q->where($where);

        if (isset($data['limit']) && !empty($data['limit'])) {
            $offset = isset($data['offset']) ? $data['offset'] : 0;
            $q->limit($data['limit'], $offset);
        }

        $q->sortby('parent', 'ASC');

        if (!empty($data['isDebug'])) {
            $q->prepare();
            $this->modx->log(modX::LOG_LEVEL_ERROR, $q->toSQL());
        }

        if ($q->prepare() && $q->stmt->execute()) {
            return $q->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return array();
    }


    /**
     * @param int $productId
     * @param int $parentId
     * @param string $column
     * @param string $ctx
     * @return array
     */
    public function getCategories($productId, $parentId, $column = 'pagetitle', $ctx = '')
    {
        $out = array();
        $ctx = $ctx ? $ctx : $this->ctx;
        $resourceColumns = array('id', 'pagetitle');
        $q = $this->modx->newQuery('modResource');
        $q->rightJoin('msCategoryMember', 'Member', array('modResource.id = ' . $parentId . ' OR (modResource.id = Member.category_id AND Member.product_id = ' . $productId . ')'));
        $q->select($this->modx->getSelectColumns('modResource', 'modResource', '', $resourceColumns));
        $q->select(array(
            'Member.member' => 'category_id'
        ));
        $q->where(array(
            'show_in_tree' => true,
            'isfolder' => true,
            'context_key:=' => $ctx,
        ));
        $q->groupby($this->modx->getSelectColumns('modResource', 'modResource', '', $resourceColumns), '');
        $q->sortby('modResource.id');
        $s = $q->prepare();
        //$this->modx->log(modX::LOG_LEVEL_ERROR, $q->toSQL());
        $s->execute();
        foreach ($s->fetchAll(PDO::FETCH_ASSOC) as $data) {
            $out[] = $data[$column];
        }
        return $out;
    }

    /**
     * @param int $productId
     * @param array $options
     * @return string
     */
    public function createHashRemain($productId = 0, $options = array())
    {
        $str = '';
        asort($options);
        foreach ($options as $k => $v) {
            $str .= strtolower(trim($k)) . strtolower(trim($v));
        }
        return md5($productId . $str);
    }

    public function getRemains()
    {
        $data = array();
        $q = $this->modx->newQuery('msprRemains');
        $collection = $this->modx->getCollection('msprRemains', $q);
        foreach ($collection as $remain) {
            $hash = $this->createHashRemain($remain->product_id, $this->modx->fromJSON($remain->options));
            $data[$hash] = $remain->id;
        }
        return $data;
    }

    /**
     * @param array $data
     * @param int $remain_id
     * @return bool
     */
    public function setRemain($data = array(), $remain_id = 0)
    {
        if (!$remain_id) {
            $remain = $this->modx->newObject('msprRemains');
        } else {
            $remain = $this->modx->getObject('msprRemains', $remain_id);
        }
        if ($remain) {
            $remain->set('product_id', $data['product_id']);
            $remain->set('options', $this->modx->toJSON($data['options']));
            $remain->set('remains', $data['remain']);
            return $remain->save();
        }
        return false;
    }

    /**
     * @param string $hashKey
     * @param int $productId
     * @return int
     */
    public function getRemainIdByHash($hashKey, $productId = 0)
    {
        $q = $this->modx->newQuery('msprRemains');
        if ($productId) {
            $q->where(array('product_id:=' => $productId));
        }
        $q->sortby('id', 'DESC');
        $collection = $this->modx->getCollection('msprRemains', $q);
        foreach ($collection as $remain) {
            $hash = $this->createHashRemain($remain->product_id, $this->modx->fromJSON($remain->options));
            if ($hash == $hashKey)
                return $remain->id;
        }
        return 0;
    }

    /**
     * @param bool $save
     * @return string
     */
    public function generateExportToken($save = true)
    {
        $token = md5(MODX_HTTP_HOST . time() . microtime(true) . $this->modx->user->generatePassword());
        if ($save) {
            $this->setOption('msimportexport.token', $token);
        }
        return $token;
    }

    /**
     * @param bool $save
     * @return string
     */
    public function getToken()
    {
        $token = $this->modx->getOption('msimportexport.token', null, '');
        if (empty($token)) {
            $token = $this->generateExportToken();
        }
        return $token;
    }


    /**
     * @param string $token
     * @return bool
     */
    public function checkExportToken($token)
    {
        return $token == $this->modx->getOption('msimportexport.token', null, '') ? true : false;
    }

    /**
     * @param array $params
     * @return string
     */
    public function generateSig($params = array())
    {
        $sig = '';
        ksort($params);
        foreach ($params as $key => $value) {
            $sig .= $key . '=' . $value;
        }
        $sig .= $this->getToken();
        return md5($sig);
    }

    /**
     * @param string $sig
     * @return bool
     */
    public function checkAccessDownloadPrice($sig = '')
    {
        if (!$timeout = (int)$this->modx->getOption('msimportexport.price.timeout', null, 180)) {
            return true;
        }
        $ip = $this->getClientIp();
        $q = $this->modx->newQuery('MsieAccessPrice');
        $q->where(array(
            'sig' => $sig,
            'ip' => ip2long($ip['ip']),
            'createdon:>' => time() - $timeout,
        ));
        $q->select(array("id"));

        if ($q->prepare() && $q->stmt->execute()) {
            return $q->stmt->fetch(PDO::FETCH_COLUMN) ? false : true;
        }

        return false;
    }

    /**
     * @param string $sig
     * @return bool
     */
    public function regAccessDownloadPrice($sig = '')
    {
        if (!$timeout = (int)$this->modx->getOption('msimportexport.price.timeout', null, 180)) {
            return true;
        }
        $ip = $this->getClientIp();
        $access = $this->modx->newObject('MsieAccessPrice');
        $access->set('sig', $sig);
        $access->set('ip', ip2long($ip['ip']));
        $access->set('user_id', $this->modx->user->id);
        $access->set('createdon', time());
        return $access->save();
    }

    /**
     * @return bool
     */
    public function clearAccessDownloadPrice()
    {
        $timeout = (int)$this->modx->getOption('msimportexport.price.timeout', null, 180);
        $q = $this->modx->newQuery('MsieAccessPrice');
        $q->command('DELETE');
        $q->where(array(
            'createdon:<' => time() - $timeout
        ));
        $q->prepare();
        return $q->stmt->execute();
    }

    /**
     * @param array $data
     * @param string $ctx
     * @return array
     */
    public function getLinks($data = array(), $ctx = '')
    {

        $ctx = $ctx ? $ctx : $this->ctx;
        $where = array('ProductMaster.context_key:=' => $ctx);
        $q = $this->modx->newQuery('msProductLink');
        $q->leftJoin('msProduct', 'ProductMaster', array('ProductMaster.id = msProductLink.master'));
        $q->leftJoin('msProductData', 'DataMaster', 'DataMaster.id = ProductMaster.id');
        $q->leftJoin('msProduct', 'ProductSlave', array('ProductSlave.id = msProductLink.slave'));
        $q->leftJoin('msProductData', 'DataSlave', 'DataSlave.id = ProductSlave.id');

        $q->select($this->modx->getSelectColumns('msProductLink', 'msProductLink'));
        $q->select($this->modx->getSelectColumns('msProduct', 'ProductMaster', 'master_', array('id', 'pagetitle', 'context_key')));
        $q->select($this->modx->getSelectColumns('msProductData', 'DataMaster', 'master_', array('id'), true));
        $q->select($this->modx->getSelectColumns('msProduct', 'ProductSlave', 'slave_', array('id', 'pagetitle')));
        $q->select($this->modx->getSelectColumns('msProductData', 'DataSlave', 'slave_', array('id'), true));

        if (isset($data['where']) && !empty($data['where'])) {
            if (!is_array($data['where'])) {
                $tmp = $this->modx->fromJSON($data['where']);
                $tmp = $this->prepareWhere($tmp);
                if (is_array($tmp)) {
                    $where = array_merge($where, $tmp);
                }
            } else {
                $where = array_merge($where, $data['where']);
            }
        }

        if (isset($data['parents']) && !empty($data['parents'])) {
            $where[] = array(
                'ProductMaster.id:IN' => $this->getAllChildIds($data['parents'], 10, $ctx),
            );
        }

        $q->where($where);

        if (isset($data['limit']) && !empty($data['limit'])) {
            $offset = isset($data['offset']) ? $data['offset'] : 0;
            $q->limit($data['limit'], $offset);
        }

        $q->sortby('ProductMaster.id', 'ASC');
        // $data['isDebug'] = true;
        if (!empty($data['isDebug'])) {
            $q->prepare();
            $this->modx->log(modX::LOG_LEVEL_ERROR, $q->toSQL());
        }

        if ($q->prepare() && $q->stmt->execute()) {
            return $q->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return array();
    }


    /**
     * @return string
     */
    public function getGalleryClassName()
    {
        return trim($this->modx->getOption('msimportexport.gallery.class_name', null, 'msProductFile', true));
    }

    /**
     * @return string
     */
    public function getExportGalleryImageDir()
    {
        $imagePath = MODX_BASE_PATH . $this->modx->getOption('msimportexport.gallery.copy_image_path', null, 'assets/msie_gallery/', true);
        $imagePath = str_replace('//', '/', $imagePath);
        if (!file_exists($imagePath)) {
            if (!$this->modx->cacheManager->writeTree($imagePath)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[getExportGalleryImageDir]  Could not create directory: ' . $imagePath);
                $imagePath = '';
            }
        }
        return $imagePath;
    }


    /**
     * @param string $source
     * @param string $ctx
     * @return string
     */
    public function getGalleryDirBySource($source, $ctx = '')
    {
        $dir = '';
        $ctx = $ctx ? $ctx : $this->ctx;
        if (isset($this->sourceBasePath[$source])) {
            return $this->sourceBasePath[$source];
        }
        if ($mediaSource = $this->modx->getObject('sources.modMediaSource', $source)) {
            $mediaSource->set('ctx', $ctx);
            $mediaSource->initialize();
            $dir = $mediaSource->getBasePath();
            $this->sourceBasePath[$source] = $dir;
        }
        return $dir;
    }

    /**
     * @param array $data
     * @param string $ctx
     * @return array
     */
    public function getGalleryData($data = array(), $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $where = array('Product.context_key:=' => $ctx,);
        $className = $this->getGalleryClassName();
        $q = $this->modx->newQuery($className);

        switch ($className) {
            case 'msProductFile':
                $key = 'product_id';
                break;
            case 'msResourceFile':
                $key = 'resource_id';
                $q->select($className . '.alt');
                break;
        }

        $q->leftJoin('msProduct', 'Product', array('Product.id = ' . $className . '.' . $key));
        $q->leftJoin('msProductData', 'Data', 'Data.id = Product.id');

        $q->select($this->modx->getSelectColumns('msProduct', 'Product', '', array('id', 'pagetitle')));
        $q->select($this->modx->getSelectColumns('msProductData', 'Data', '', array('id'), true));
        $q->select($this->modx->getSelectColumns($className, $className, '', array('name', '	alt', 'description', 'add', 'path', 'file', 'url', 'source', 'rank', 'active')));

        if (isset($data['where']) && !empty($data['where'])) {
            if (!is_array($data['where'])) {
                $tmp = $this->modx->fromJSON($data['where']);
                $tmp = $this->prepareWhere($tmp);
                if (is_array($tmp)) {
                    $where = array_merge($where, $tmp);
                }
            } else {
                $where = array_merge($where, $data['where']);
            }
        }

        $where[] = array(
            $className . '.parent:=' => 0
        );

        if (isset($data['parents']) && !empty($data['parents'])) {
            $where[] = array(
                'Product.id:IN' => $this->getAllChildIds($data['parents'], 10, $ctx),
            );
        }

        $q->where($where);

        if (isset($data['limit']) && !empty($data['limit'])) {
            $offset = isset($data['offset']) ? $data['offset'] : 0;
            $q->limit($data['limit'], $offset);
        }

        $q->sortby($key, 'ASC');
        // $data['isDebug'] = true;
        if (isset($data['isDebug']) && !empty($data['isDebug'])) {
            $q->prepare();
            $this->modx->log(modX::LOG_LEVEL_ERROR, $q->toSQL());
        }

        if ($q->prepare() && $q->stmt->execute()) {
            return $q->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return array();
    }


    /**
     * @param string $source
     * @param string $dest
     * @return bool
     */
    public function zip($source, $dest)
    {
        if ($zipClass = $this->modx->loadClass('compression.xPDOZip', XPDO_CORE_PATH, true, true)) {
            if ($zip = new $zipClass($this->modx, $dest, array('create' => true, 'overwrite' => true))) {
                @unlink($dest);
                $result = $zip->pack($source);
                // $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($result, 1));
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $type
     * @return null|MsieWriter
     */
    public function getWriter($type)
    {
        $writers = $this->modx->getOption('msimportexport.writer_class', null, '{"csv":{"MsieCsvWriter":"{+core_path}model/msimportexport/writer/msiecsvwriter.class.php"},"xlsx":{"MsieExcelWriter":"{+core_path}model/msimportexport/writer/msieexcelwriter.class.php"}}', true);
        $writers = $this->modx->fromJSON($writers);

        if (empty($writers)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error get writers class');
            return null;
        }

        if (!class_exists('MsieWriter')) {
            require_once dirname(__FILE__) . '/writer/msiewriter.class.php';
        }
        $className = $this->getArrayFirstKey($writers[$type]);

        if ($className) {
            if (!class_exists($className)) {
                require_once $this->preparePath($writers[$type][$className]);
            }
            try {
                return new $className($this->modx);
            } catch (Exception $e) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error create  writer class ' . $className . '  ' . $e->getMessage());
            }
        }

        return null;
    }

    /**
     * @param string $file
     * @return null|MsieReader
     */
    public function getReader($file = '')
    {
        $type = mb_strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($type == 'xls') $type = 'xlsx';

        $readers = $this->modx->getOption('msimportexport.reader_class', null, '{"csv":{"MsieCsvReader":"{+core_path}model/msimportexport/reader/msiecsvreader.class.php"},"xlsx":{"MsieExcelReader":"{+core_path}model/msimportexport/reader/msieexcelreader.class.php"}}', true);
        $readers = $this->modx->fromJSON($readers);

        if (empty($readers)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error get readers class');
            return null;
        }

        if (!class_exists('MsieReader')) {
            require_once dirname(__FILE__) . '/reader/msiereader.class.php';
        }
        $className = $this->getArrayFirstKey($readers[$type]);

        if ($className) {
            if (!class_exists($className)) {
                require_once $this->preparePath($readers[$type][$className]);
            }
            try {
                return new $className($this->modx);
            } catch (Exception $e) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error create  reader class ' . $className . '  ' . $e->getMessage());
            }
        }

        return null;
    }


    /**
     * @param string|array $productIds
     * @param string $thumb
     * @return array
     */
    public function getProductsGallery($productIds = '', $thumb = '')
    {
        $out = array();
        $productIds = is_array($productIds) ? $productIds : explode(',', $productIds);
        $imageSchemeFull = filter_var($this->modx->getOption('msimportexport.export.image_scheme', null, 0), FILTER_VALIDATE_BOOLEAN);
        if (empty($productIds)) return $out;
        $q = $this->modx->newQuery('msProductFile', array('product_id:IN' => $productIds));
        if (empty($thumb)) {
            $q->where(array('parent:=' => 0));
        } else {
            $q->where(array('parent:!=' => 0, 'path:LIKE' => '%' . $thumb . '%'));
        }
        $q->select('product_id, url');


        if ($q->prepare() && $q->stmt->execute()) {
            while ($row = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                if (!isset($out[$row['product_id']])) {
                    $out[$row['product_id']] = array();
                }
                $scheme = $imageSchemeFull ? $this->siteUrl . '/' : '';
                $out[$row['product_id']][] = $scheme . ltrim($row['url'], '/');
            }

        }
        return $out;
    }


    /**
     * @param string $pageTitle
     * @param int $id
     * @param int $parent
     * @param string $ctx
     * @return int
     */
    public function checkPageTitle($pageTitle, $id = 0, $parent = 0, $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $checkGlobally = (int)$this->modx->getOption('msimportexport.import.check_page_title_globally', null, 0);
        $q = $this->modx->newQuery('msProduct');
        $q->where(array('pagetitle' => $pageTitle, 'context_key:=' => $ctx));
        if ($id) $q->where(array('id:!=' => $id));
        if (!$checkGlobally && $parent) $q->where(array('parent:=' => $parent));
        $q->select(array("id"));
        if ($q->prepare() && $q->stmt->execute()) {
            return $q->stmt->fetch(PDO::FETCH_COLUMN);
        }

        return 0;
    }


    /**
     * @param int $categoryId
     * @param bool $clearBin
     * @param string $ctx
     */
    public function removeProducts($categoryId = 0, $clearBin = true, $ctx = '')
    {
        $ids = array();
        $ctx = $ctx ? $ctx : $this->ctx;
        $processorsPath = $this->config['corePathMiniShop2'] . 'processors/mgr/';
        $q = $this->modx->newQuery('msProduct');
        $q->where(array('class_key' => 'msProduct', 'context_key:=' => $ctx));
        if (!empty($categoryId)) {
            $q->where(array('parent' => $categoryId));
        }
        $q->select(array("id"));
        if ($q->prepare() && $q->stmt->execute()) {
            $ids = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
        }

        if (!empty($ids)) {
            $response = $this->modx->runProcessor('product/multiple',
                array('method' => 'delete', 'ids' => $this->modx->toJSON($ids)),
                array('processors_path' => $processorsPath)

            );
            if ($response->isError()) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[removeProducts] ' . print_r($response->getAllErrors(), 1));
            }
            if ($clearBin) {
                $response = $this->modx->runProcessor('resource/emptyrecyclebin', array());
                if ($response->isError()) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, '[removeProducts] clear bin' . print_r($response->getAllErrors(), 1));
                }
            }
        }
    }

    public function clearGallery()
    {
        $tableName = $this->modx->getTableName('msProductFile');
        $fileDir = $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH) . '/images/products/';
        $sql = "DELETE FROM {$tableName}";
        $this->modx->exec($sql);
        if (file_exists($fileDir)) {
            $this->modx->cacheManager->deleteTree($fileDir, array('deleteTop' => false, 'skipDirs' => false, 'extensions' => array()));
        }
    }


    /**
     * @param array|int $id
     * @param int $depth
     * @param string $ctx
     * @return array
     */
    public function getAllChildIds($id, $depth = 10, $ctx = '')
    {
        $ids = array();
        $ctx = $ctx ? $ctx : $this->ctx;
        if (is_numeric($id)) {
            return $this->modx->getChildIds($id, $depth, array('context' => $ctx));
        } else {
            if (!is_array($id)) {
                $id = explode(',', $id);
            }
            foreach ($id as $v) {
                $ids = array_merge(
                    $ids,
                    $this->modx->getChildIds($v, $depth, array('context' => $ctx))
                );
            }

        }

        return $ids;

    }


    /**
     * @param mixed $val
     * @param string $key
     * @param string $ctx
     * @return int
     */
    public function getProductIdByKey($val, $key = '', $ctx = '')
    {
        $className = 'msProduct';
        $ctx = $ctx ? $ctx : $this->ctx;
        if (isset($this->productIdsByKey[$val])) {
            return $this->productIdsByKey[$val];
        }
        $key = empty($key) ? $this->modx->getOption('msimportexport.key', null, 'article', true) : $key;
        $tmp = $this->modx->getFields($className);
        $q = $this->modx->newQuery($className);
        $q->innerJoin('msProductData', 'Data', $className . '.id = Data.id');
        $q->select($className . '.id');
        $q->where(array('context_key:=' => $ctx));
        if (isset($tmp[$key])) {
            $q->where(array($key => $val));
        } else {
            $q->where(array('Data.' . $key => $val));
        }


        if ($q->prepare() && $q->stmt->execute()) {
            $id = $q->stmt->fetch(PDO::FETCH_COLUMN);
            $this->productIdsByKey[$val] = $id;
            return $id;
        }
        return 0;
    }


    /**
     * @param int $id
     * @return string
     */
    public function getPageTitleById($id)
    {
        $q = $this->modx->newQuery('modResource');
        $q->where(array('id:=' => $id));
        $q->select(array("pagetitle"));
        if ($q->prepare() && $q->stmt->execute()) {
            return $q->stmt->fetch(PDO::FETCH_COLUMN);
        }
        return '';
    }

    /**
     * @param int $parentId
     * @param int $depth
     * @param string $ctx
     * @return string
     */
    public function getTrackTitleByParent($parentId, $depth = 1000, $ctx = '')
    {
        $track = '';
        $ctx = $ctx ? $ctx : $this->ctx;
        if (isset($this->trackTitleParent[$parentId])) {
            return $this->trackTitleParent[$parentId];
        }
        $glue = $this->modx->getOption('msimportexport.import.sub_delimeter', null, '|');
        if ($ids = $this->modx->getParentIds($parentId, $depth, array('context' => $ctx))) {
            array_pop($ids);
            $ids = array_reverse($ids);
            $ids[] = $parentId;
            foreach ($ids as $id) {
                $track .= empty($track) ? '' : $glue;
                $track .= $this->getPageTitleById($id);
            }
            $this->trackTitleParent[$parentId] = $track;
        }
        return $track;
    }

    /**
     * @param array $data
     * @param string $ctx
     * @return array
     */
    public function getOptionsPrice2($data = array(), $ctx = '')
    {
        /* @var pdoFetch $pdoFetch */
        if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
            return false;
        }
        $ctx = $ctx ? $ctx : $this->ctx;
        $pdoFetch = new pdoFetch($this->modx, $data);
        $where = array('Product.context_key:=' => $ctx);
        if (empty($data['class'])) {
            $data['class'] = 'msopModification';
        }
        $class = $data['class'];

        if (!empty($data['parents'])) {
            $where['rid:IN'] = $this->getAllChildIds($data['parents']);
            unset($data['parents']);
            //$where[$class . 'active'] = 1;
        }


        $select = array(
            $class => $this->modx->getSelectColumns($class, $class, 'msopm_'),
            'Product' => $this->modx->getSelectColumns('msProduct', 'Product', 'product_'),
            'Data' => $this->modx->getSelectColumns('msProductData', 'Data', 'data_', array('vendor'), true),
            'Vendor' => array('Vendor.name AS data_vendor'),
            'File' => array('CONCAT(`File`.`path`,`File`.`file`) AS msopm_image_path, `File`.`url` AS msopm_image_url, `File`.`source` AS msopm_image_source'),
            //'Vendor' => $this->modx->getSelectColumns('msVendor', 'Vendor', 'vendor_', array('name'), false),
        );

        // Joining tables
        $leftJoin = array(
            array('class' => 'msProduct', 'alias' => 'Product', 'on' => '`Product`.`id`=`' . $class . '`.`rid`'),
            array('class' => 'msProductData', 'alias' => 'Data', 'on' => '`Data`.`id`=`Product`.`id`'),
            array('class' => 'msVendor', 'alias' => 'Vendor', 'on' => '`Data`.`vendor`=`Vendor`.`id`'),
            array('class' => 'msProductFile', 'alias' => 'File', 'on' => '`File`.`id`=`msopModification`.`image`'),
        );

        // Add custom parameters
        foreach (array('where', 'leftJoin', 'innerJoin', 'select') as $v) {
            if (!empty($data[$v])) {
                $tmp = $this->modx->fromJSON($data[$v]);
                if (is_array($tmp)) {
                    $$v = array_merge($$v, $tmp);
                }
            }
            unset($data[$v]);
        }


        $default = array(
            'class' => $class,
            'where' => $this->modx->toJSON($where),
            'leftJoin' => $this->modx->toJSON($leftJoin),
            'select' => $this->modx->toJSON($select),
            'sortby' => $class . '.rid',
            'sortdir' => 'ASC',
            'groupby' => $class . '.id',
            'fastMode' => false,
            'return' => 'data',
        );


        if (!empty($data['isDebug'])) {
            $pdoFetch->setConfig(array_merge($default, $data, array('return' => 'sql')));
            $this->modx->log(modX::LOG_LEVEL_ERROR, $pdoFetch->run());
        }

        $pdoFetch->setConfig(array_merge($default, $data));
        return $pdoFetch->run();

    }

    /**
     * @param array $data
     * @param string $ctx
     * @return array
     */
    public function getOptionsColor($data = array(), $ctx = '')
    {
        /* @var pdoFetch $pdoFetch */
        if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
            return false;
        }
        $ctx = $ctx ? $ctx : $this->ctx;
        $pdoFetch = new pdoFetch($this->modx, $data);
        $where = array('Product.context_key:=' => $ctx);
        if (empty($data['class'])) {
            $data['class'] = 'msocColor';
        }
        $class = $data['class'];

        if (!empty($data['parents'])) {
            $where['rid:IN'] = $this->getAllChildIds($data['parents']);
            unset($data['parents']);
            //$where[$class . 'active'] = 1;
        }


        $select = array(
            $class => $this->modx->getSelectColumns($class, $class, 'msoc_'),
            'Product' => $this->modx->getSelectColumns('msProduct', 'Product', 'product_'),
            'Data' => $this->modx->getSelectColumns('msProductData', 'Data', 'data_', array('vendor'), true),
            'Vendor' => array('Vendor.name AS data_vendor'),
            //'Vendor' => $this->modx->getSelectColumns('msVendor', 'Vendor', 'vendor_', array('name'), false),
        );

        // Joining tables
        $leftJoin = array(
            array('class' => 'msProduct', 'alias' => 'Product', 'on' => '`Product`.`id`=`' . $class . '`.`rid`'),
            array('class' => 'msProductData', 'alias' => 'Data', 'on' => '`Data`.`id`=`Product`.`id`'),
            array('class' => 'msVendor', 'alias' => 'Vendor', 'on' => '`Data`.`vendor`=`Vendor`.`id`'),
        );

        // Add custom parameters
        foreach (array('where', 'leftJoin', 'innerJoin', 'select') as $v) {
            if (!empty($data[$v])) {
                $tmp = $this->modx->fromJSON($data[$v]);
                if (is_array($tmp)) {
                    $$v = array_merge($$v, $tmp);
                }
            }
            unset($data[$v]);
        }


        $default = array(
            'class' => $class,
            'where' => $this->modx->toJSON($where),
            'leftJoin' => $this->modx->toJSON($leftJoin),
            'select' => $this->modx->toJSON($select),
            'sortby' => $class . '.rid',
            'sortdir' => 'ASC',
            'groupby' => '',
            //'groupby' => $class . '.rid,' . $class . '.key',
            'fastMode' => false,
            'return' => 'data',
        );

        if (!empty($data['isDebug'])) {
            $pdoFetch->setConfig(array_merge($default, $data, array('return' => 'sql')));
            $this->modx->log(modX::LOG_LEVEL_ERROR, $pdoFetch->run());
        }

        $pdoFetch->setConfig(array_merge($default, $data));
        return $pdoFetch->run();

    }

    public function getSalePrice($data = array(), $ctx = '')
    {
        $this->getInstanceSalePrice();
        /* @var pdoFetch $pdoFetch */
        if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
            return false;
        }
        $ctx = $ctx ? $ctx : $this->ctx;
        $pdoFetch = new pdoFetch($this->modx, $data);
        $where = array('Product.context_key:=' => $ctx);
        if (empty($data['class'])) {
            $data['class'] = 'msspPrice';
        }
        $class = $data['class'];

        if (!empty($data['parents'])) {
            $where['rid:IN'] = $this->getAllChildIds($data['parents']);
            unset($data['parents']);
            //$where[$class . 'active'] = 1;
        }


        $select = array(
            $class => $this->modx->getSelectColumns($class, $class, 'mssp_'),
            'Product' => $this->modx->getSelectColumns('msProduct', 'Product', 'product_'),
            'Data' => $this->modx->getSelectColumns('msProductData', 'Data', 'data_', array('vendor'), true),
            'Vendor' => array('Vendor.name AS data_vendor'),
            //'Vendor' => $this->modx->getSelectColumns('msVendor', 'Vendor', 'vendor_', array('name'), false),
        );

        // Joining tables
        $leftJoin = array(
            array('class' => 'msProduct', 'alias' => 'Product', 'on' => '`Product`.`id`=`' . $class . '`.`rid`'),
            array('class' => 'msProductData', 'alias' => 'Data', 'on' => '`Data`.`id`=`Product`.`id`'),
            array('class' => 'msVendor', 'alias' => 'Vendor', 'on' => '`Data`.`vendor`=`Vendor`.`id`'),
        );

        // Add custom parameters
        foreach (array('where', 'leftJoin', 'innerJoin', 'select') as $v) {
            if (!empty($data[$v])) {
                $tmp = $this->modx->fromJSON($data[$v]);
                if (is_array($tmp)) {
                    $$v = array_merge($$v, $tmp);
                }
            }
            unset($data[$v]);
        }


        $default = array(
            'class' => $class,
            'where' => $this->modx->toJSON($where),
            'leftJoin' => $this->modx->toJSON($leftJoin),
            'select' => $this->modx->toJSON($select),
            'sortby' => $class . '.rid',
            'sortdir' => 'ASC',
            'groupby' => $class . '.id',
            'fastMode' => false,
            'return' => 'data',
        );

        if (!empty($data['isDebug'])) {
            $pdoFetch->setConfig(array_merge($default, $data, array('return' => 'sql')));
            $this->modx->log(modX::LOG_LEVEL_ERROR, $pdoFetch->run());
        }

        $pdoFetch->setConfig(array_merge($default, $data));
        return $pdoFetch->run();

    }

    public function getProductRemains($data = array(), $ctx = '')
    {
        $this->getInstanceProductRemains();
        /* @var pdoFetch $pdoFetch */
        if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
            return false;
        }
        $ctx = $ctx ? $ctx : $this->ctx;
        $pdoFetch = new pdoFetch($this->modx, $data);
        $where = array('Product.context_key:=' => $ctx);
        if (empty($data['class'])) {
            $data['class'] = 'msprRemains';
        }
        $class = $data['class'];

        if (!empty($data['parents'])) {
            $where['product_id:IN'] = $this->getAllChildIds($data['parents']);
            unset($data['parents']);
        }


        $select = array(
            $class => $this->modx->getSelectColumns($class, $class, 'mspr_'),
            'Product' => $this->modx->getSelectColumns('msProduct', 'Product', 'product_'),
            'Data' => $this->modx->getSelectColumns('msProductData', 'Data', 'data_', array('vendor'), true),
            'Vendor' => array('Vendor.name AS data_vendor'),
            //'Vendor' => $this->modx->getSelectColumns('msVendor', 'Vendor', 'vendor_', array('name'), false),
        );

        // Joining tables
        $leftJoin = array(
            array('class' => 'msProduct', 'alias' => 'Product', 'on' => '`Product`.`id`=`' . $class . '`.`product_id`'),
            array('class' => 'msProductData', 'alias' => 'Data', 'on' => '`Data`.`id`=`Product`.`id`'),
            array('class' => 'msVendor', 'alias' => 'Vendor', 'on' => '`Data`.`vendor`=`Vendor`.`id`'),
        );

        // Add custom parameters
        foreach (array('where', 'leftJoin', 'innerJoin', 'select') as $v) {
            if (!empty($data[$v])) {
                $tmp = $this->modx->fromJSON($data[$v]);
                if (is_array($tmp)) {
                    $$v = array_merge($$v, $tmp);
                }
            }
            unset($data[$v]);
        }


        $default = array(
            'class' => $class,
            'where' => $this->modx->toJSON($where),
            'leftJoin' => $this->modx->toJSON($leftJoin),
            'select' => $this->modx->toJSON($select),
            'sortby' => $class . '.product_id',
            'sortdir' => 'ASC',
            'groupby' => $class . '.id',
            'fastMode' => false,
            'return' => 'data',
        );

        if (!empty($data['isDebug'])) {
            $pdoFetch->setConfig(array_merge($default, $data, array('return' => 'sql')));
            $this->modx->log(modX::LOG_LEVEL_ERROR, $pdoFetch->run());
        }

        $pdoFetch->setConfig(array_merge($default, $data));
        return $pdoFetch->run();

    }


    /**
     * @param int $id
     * @param string $key
     * @return bool|int
     */
    public function removeLink($id, $key = 'master')
    {
        $q = $this->modx->newQuery('msProductLink');
        $q->where(array($key => $id));
        return $this->modx->removeCollection('msProductLink', $q);
    }


    /**
     * @param array $data
     * @return array
     */
    public function prepareWhere(&$data = array())
    {
        if ($data) {
            foreach ($data as $k => $v) {
                if (!is_numeric($v) && substr($v, 0, 1) == ':') {
                    $code = trim(mb_substr($v, 1));
                    $end = substr($code, -1) == ';' ? '' : ';';
                    $code = 'return ' . $code . $end;
                    $data[$k] = eval($code);
                }
            }
        }
        return $data;
    }

    /**
     * @param array $data
     * @param string $ctx
     * @return array
     */
    public function getProducts($data = array(), $ctx = '')
    {
        /* @var miniShop2 $miniShop2 */
        $ctx = $ctx ? $ctx : $this->ctx;
        $miniShop2 = $this->modx->getService('minishop2');
        $miniShop2->initialize($ctx);
        $includeContent = true;
        $includeParentTitle = isset($data['includeParentTitle']) || (isset($data['fields']) ? in_array('category.pagetitle', $data['fields']) : false);
        $allowPriceModification = $this->modx->getOption('msieimport.export.allow_price_modification', null, 1, true);
        // You can set modResource instead of msProduct
        if (empty($data['class'])) {
            $data['class'] = 'msProduct';
        }
        if (empty($data['parents'])) {
            $data['parents'] = $this->getRootCategoryId($ctx);
        }

        $class = $data['class'];

        /* @var pdoFetch $pdoFetch */
        if (!$this->modx->loadClass('pdofetch', MODX_CORE_PATH . 'components/pdotools/model/pdotools/', false, true)) {
            return false;
        }
        $pdoFetch = new pdoFetch($this->modx, $data);

        // Start building "Where" expression
        $where = array('class_key' => 'msProduct', 'context_key:=' => $ctx);


        // Joining tables
        $leftJoin = array(
            array('class' => 'msProductData', 'alias' => 'Data', 'on' => '`' . $class . '`.`id`=`Data`.`id`'),
            array('class' => 'msVendor', 'alias' => 'Vendor', 'on' => '`Data`.`vendor`=`Vendor`.`id`'),
        );

        $innerJoin = array();

        // Include Thumbnails
        $thumbsSelect = array();
        if (!empty($data['includeThumbs'])) {
            $thumbs = array_map('trim', explode(',', $data['includeThumbs']));
            if (!empty($thumbs[0])) {
                foreach ($thumbs as $thumb) {
                    $leftJoin[] = array(
                        'class' => 'msProductFile',
                        'alias' => $thumb,
                        'on' => "`$thumb`.`product_id` = `$class`.`id` AND `$thumb`.`parent` != 0 AND `$thumb`.`path` LIKE '%/$thumb/'"
                    );
                    $thumbsSelect[$thumb] = "`$thumb`.`url` as `$thumb`";
                }
            }
        }

        // include Linked products
        if (!empty($link) && !empty($master)) {
            $innerJoin[] = array('class' => 'msProductLink', 'alias' => 'Link', 'on' => '`' . $class . '`.`id` = `Link`.`slave` AND `Link`.`link` = ' . $link);
            $where['Link.master'] = $master;
        } else if (!empty($link) && !empty($slave)) {
            $innerJoin[] = array('class' => 'msProductLink', 'alias' => 'Link', 'on' => '`' . $class . '`.`id` = `Link`.`master` AND `Link`.`link` = ' . $link);
            $where['Link.slave'] = $slave;
        }

        // Fields to select
        $select = array(
            $class => !empty($includeContent) ? $this->modx->getSelectColumns($class, $class) : $this->modx->getSelectColumns($class, $class, '', array('content'), true),
            'Data' => $this->modx->getSelectColumns('msProductData', 'Data', '', array('id'), true),
            'Vendor' => $this->modx->getSelectColumns('msVendor', 'Vendor', 'vendor.', array(), true),
        );

        if ($includeParentTitle) {
            $innerJoin[] = array('class' => 'msCategory', 'alias' => 'Category', 'on' => '`' . $class . '`.`parent` = `Category`.`id`');
            $select['Category'] = $this->modx->getSelectColumns('msCategory', 'Category', 'category.', array('pagetitle'), false);
        }

        if (!empty($data['isSeoPro'])) {
            $innerJoin[] = array('class' => 'seoKeywords', 'alias' => 'SeoPro', 'on' => '`' . $class . '`.`id` = `SeoPro`.`resource`');
            $select['SeoPro'] = $this->modx->getSelectColumns('seoKeywords', 'SeoPro', 'seo_', array('keywords'), false);
        }


        if (!empty($thumbsSelect)) {
            $select = array_merge($select, $thumbsSelect);
        }


        // Add custom parameters
        foreach (array('where', 'leftJoin', 'innerJoin', 'select') as $v) {
            if (!empty($data[$v])) {
                $tmp = $this->modx->fromJSON($data[$v]);
                if (is_array($tmp)) {
                    if ($v == 'where') $tmp = $this->prepareWhere($tmp);
                    $$v = array_merge($$v, $tmp);
                }
            }
            unset($data[$v]);
        }

        $joinedOptions = array();
        // Add filters by options
        if (!empty($data['optionFilters'])) {
            $filters = $this->modx->fromJSON($data['optionFilters']);
            $opt_where = array();

            foreach ($filters as $key => $value) {
                $key_operator = explode(':', $key);
                $operator = '=';
                $conj = '';
                if ($key_operator && count($key_operator) === 2) {
                    $key = $key_operator[0];
                    $operator = $key_operator[1];
                } elseif ($key_operator && count($key_operator) === 3) {
                    $conj = $key_operator[0];
                    $key = $key_operator[1];
                    $operator = $key_operator[2];
                }

                if (!in_array($key, $joinedOptions)) {
                    $leftJoin[] = array('class' => 'msProductOption', 'alias' => $key, 'on' => "`{$key}`.`product_id`=`Data`.`id` AND `{$key}`.`key`='{$key}'");
                    $joinedOptions[] = $key;
                }

                if (!is_string($value)) {
                    if (!empty($conj)) {
                        $last_where = end($opt_where);
                        if (is_array($last_where)) {
                            $conj = !empty($conj) ? $conj . ':' : '';
                            $opt_where[] = array("{$conj}`{$key}`.`value`:{$operator}" => $value);
                        } else {
                            array_splice($opt_where, -1, 1, $last_where . " {$conj} `{$key}`.`value`{$operator}{$value}");
                        }
                    } else {
                        $opt_where[] = "`{$key}`.`value`{$operator}{$value}";
                    }

                } else {
                    $conj = !empty($conj) ? $conj . ':' : '';
                    $opt_where[] = array("{$conj}`{$key}`.`value`:{$operator}" => $value);
                }


            }
            $where[] = $opt_where;
        }

        // Add sorting by options
        if (!empty($data['sortbyOptions'])) {
            $sorts = explode(',', $data['sortbyOptions']);
            foreach ($sorts as $sort) {
                $sort = explode(':', $sort);
                $option = $sort[0];
                $type = 'string';
                if (isset($sort[1])) {
                    $type = $sort[1];
                }

                switch ($type) {
                    case 'number':
                    case 'decimal':
                        $sortbyOptions = "CAST(`{$option}`.`value` AS DECIMAL(13,3))";
                        break;
                    case 'integer':
                        $sortbyOptions = "CAST(`{$option}`.`value` AS UNSIGNED INTEGER)";
                        break;
                    case 'date':
                    case 'datetime':
                        $sortbyOptions = "CAST(`{$option}`.`value` AS DATETIME)";
                        break;
                    default:
                        $sortbyOptions = "`{$option}`.`value`";
                        break;
                }

                $data['sortby'] = str_replace($option, $sortbyOptions, $data['sortby']);

                if (!in_array($option, $joinedOptions)) {
                    $leftJoin[] = array('class' => 'msProductOption', 'alias' => $option, 'on' => "`{$option}`.`product_id`=`Data`.`id` AND `{$option}`.`key`='{$option}'");
                    $joinedOptions[] = $option;
                }

            }
        }


        $tvs = array();
        // find TV var BEGIN
        if (!empty($where)) {
            foreach ($where as $key => $v) {
                if (preg_match('/^tv\.([^\.][\w\.:=<>!]+)$/', $key)) {
                    $tvs[] = str_replace(array('tv.', ':=', ':!=', ':>', ':<'), '', $key);
                    $where[str_replace(array('tv.'), '', $key)] = $v;
                    unset($where[$key]);
                }
            }

        }

        if (!empty($data['optionsTv'])) {
            foreach ($data['optionsTv'] as $v) {
                if (preg_match('/^tv\.([^\.][\w\.]+)$/', $v)) {
                    $tvs[] = str_replace("tv.", '', $v);

                }
            }
        }

        if (!empty($data['fields'])) {
            foreach ($data['fields'] as $v) {
                if (preg_match('/^tv\.([^\.][\w\.]+)$/', $v)) {
                    $tvs[] = str_replace("tv.", '', $v);

                }
            }
        }

        // find TV var  END


        // Default parameters
        $default = array(
            'class' => $class,
            'where' => $this->modx->toJSON($where),
            'leftJoin' => $this->modx->toJSON($leftJoin),
            'innerJoin' => $this->modx->toJSON($innerJoin),
            'select' => $this->modx->toJSON($select),
            'sortby' => $class . '.parent',
            'sortdir' => 'ASC',
            'groupby' => $class . '.id',
            'fastMode' => false,
            'includeTVs' => '',
            'tvPrefix' => 'tv.',
            'return' => !empty($returnIds) ? 'ids' : 'data',
            'nestedChunkPrefix' => 'minishop2_',
        );

        if (!empty($tvs)) {
            $default['includeTVs'] .= implode(',', $tvs);
        }

        if (!empty($data['isDebug'])) {
            $pdoFetch->setConfig(array_merge($default, $data, array('return' => 'sql')));
            $this->modx->log(modX::LOG_LEVEL_ERROR, $pdoFetch->run());
        }
        // Merge all properties and run!

        $pdoFetch->setConfig(array_merge($default, $data));
        $rows = $pdoFetch->run();


        if (!empty($returnIds)) {
            return $rows;
        }

        $productsGallery = array();
        if (!empty($data['isGallery'])) {
            $ids = array();
            foreach ($rows as $k => $row) {
                $ids[] = $row['id'];
            }
            $productsGallery = $this->getProductsGallery($ids);
        }

        $output = array();
        if (!empty($rows) && is_array($rows)) {
            $q = $this->modx->newQuery('modPluginEvent', array('event:IN' => array('msOnGetProductPrice', 'msOnGetProductWeight')));
            $q->innerJoin('modPlugin', 'modPlugin', 'modPlugin.id = modPluginEvent.pluginid');
            $q->where('modPlugin.disabled = 0');

            if ($modificators = $this->modx->getOption('ms2_price_snippet', null, false, true) || $this->modx->getOption('ms2_weight_snippet', null, false, true) || $this->modx->getCount('modPluginEvent', $q)) {
                /* @var msProductData $product */
                $product = $this->modx->newObject('msProductData');
            }
            $pdoFetch->addTime('Checked the active modifiers');

            $opt_time = 0;
            foreach ($rows as $k => $row) {
                if (!empty($allowPriceModification) && $modificators) {
                    $product->fromArray($row, '', true, true);
                    $row['weight'] = $product->getWeight($row);
                    $tmp = $row['price'];
                    $row['price'] = $product->getPrice($row);
                    if ($row['price'] != $tmp) {
                        $row['old_price'] = $tmp;
                    }
                }
                /*$row['price'] = $miniShop2->formatPrice($row['price']);
                $row['old_price'] = $miniShop2->formatPrice($row['old_price']);
                $row['weight'] = $miniShop2->formatWeight($row['weight']);*/

                $row['idx'] = $pdoFetch->idx++;

                $opt_time_start = microtime(true);
                $options = $this->modx->call('msProductData', 'loadOptions', array(&$this->modx, $row['id']));
                if (!empty($data['isCategories'])) {
                    $row['categories'] = $this->getCategories($row['id'], $row['parent']);
                }

                if (!empty($data['isGallery'])) {
                    $row['gallery'] = (!empty($productsGallery) && isset($productsGallery[$row['id']])) ? $productsGallery[$row['id']] : array();
                }

                $row = array_merge($row, $options);
                $opt_time += microtime(true) - $opt_time_start;
                $output[] = $row;
                if (!empty($data['isDebug'])) {
                    $default['return'] = 'sql';
                    $pdoFetch->setConfig(array_merge($default, $data));
                    $this->modx->log(modX::LOG_LEVEL_INFO, $pdoFetch->run());
                    $this->modx->log(modX::LOG_LEVEL_INFO, print_r($output, 1));
                    return $output;
                }
            }
            $pdoFetch->addTime('Loaded options for products', $opt_time);
            $pdoFetch->addTime('Returning processed chunks');
        }

        return $output;
    }

    /**
     * @return array|null
     */
    public function getCronTasks()
    {
        $q = $this->modx->newQuery('MsieCron');
        $q->where(array('active' => 1));
        return $this->modx->getCollection('MsieCron', $q);
    }


    /**
     * @param int $productId
     * @return array
     */
    public function getProductOptions($productId)
    {
        $result = array();
        $classKey = 'msProductOption';

        $q = $this->modx->newQuery($classKey);
        $q->select($this->modx->getSelectColumns($classKey, $classKey));
        $q->where(array('product_id' => $productId));

        if ($q->prepare() && $q->stmt->execute()) {
            $result = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    /**
     * @param array $data
     * @return array
     */
    public function hasProductOption($data = array())
    {
        $ids = array();
        $q = $this->modx->newQuery('msProductOption');
        $q->where($data);
        $q->select('id');
        if ($q->prepare() && $q->stmt->execute()) {
            $ids = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
        }
        return $ids;
    }


    /**
     * @param int $productId
     * @param array $options
     */
    public function addProductOptions($productId, $options = array())
    {
        $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($options, 1));
        if (!empty($options) && $productId) {
            foreach ($options as $key => $val) {
                $params = array(
                    'product_id' => $productId,
                    'key' => $key,
                    'value' => $val,
                );
                if (!$this->hasProductOption($params)) {
                    $option = $this->modx->newObject('msProductOption');
                    $option->fromArray($params);
                    if (!$option->save()) {
                        $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error add product option ' . print_r($params, 1));
                    }
                }
            }
        }
    }

    /**
     * @param int $productId
     * @param string $key
     * @return bool|void
     */
    public function removeProductOptions($productId = 0, $key = '')
    {
        if ($productId) {
            $q = $this->modx->newQuery('msProductOption');
            $q->command('DELETE');
            $q->where(array(
                'product_id' => $productId,
            ));
            if (!empty($key)) {
                $q->where(array(
                    'key' => $key,
                ));
            }
            $q->prepare();
            return $q->stmt->execute();
        }
    }

    /**
     * @param int $productId
     * bool $removeOptions
     * @return bool|void
     */
    public function removeProductAllRemains($productId, $removeOptions = false)
    {
        if (!$remains = $this->getInstanceProductRemains()) return;
        if ($items = $this->modx->getCollection('msprRemains', array('product_id' => $productId))) {
            foreach ($items as $item) {
                if ($removeOptions) {
                    if ($options = $item->get('options')) {
                        foreach ($options as $option) {
                            $this->removeProductOptions($productId, $option);
                        }
                    }
                }
                $item->remove();
            }
        }
        return true;
    }

    /**
     * @param array $data
     * @param int $productId
     * @param int $preset
     * @return bool|void
     */
    public function saveRemain($data, $productId, $preset = 0)
    {

        $data['product_id'] = $productId;
        if (!isset($data['options'])) $data['options'] = array();
        $res = $this->invokeEvent('msieOnBeforeImportRemains', array(
            'data' => $data,
            'productId' => $productId,
            'msie' => &$this,
            'preset' => $preset,
            'skip' => false,
        ));

        if (!$res['success']) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
            return;
        }
        if (!empty($res['data']['skip'])) return;
        $data = $res['data']['data'];
        $this->modx->log(modX::LOG_LEVEL_INFO, '[msImportExport] data for  msProductRemains (product ID ' . $productId . '):' . "\n" . print_r($data, 1));
        $isRemove = $this->modx->getOption('msimportexport.import.mspr_remove', null, 0);

        if (!isset($this->ids[$preset][$productId])) {
            $product = $this->modx->getObject('msProduct', $productId);
            $this->ids[$preset][$productId] = 1;
            if ($isRemove) $this->removeProductAllRemains($productId);
            if (!empty($data['options']) && $product) {
                foreach ($data['options'] as $key => $val) {
                    $val = $this->isKeyArrayType($key) ? array() : '';
                    if ($this->getProductOptionKeyType($key)) {
                        $pOptions = $product->get('options');
                        $pOptions[$key] = $val;
                        $product->set('options', $pOptions);
                    } else {
                        $product->set($key, $val);
                    }
                }
            }
        }

        $this->getInstanceProductRemains();
        if (isset($data['id']) && !empty($data['id'])) {
            $remain = $this->modx->getObject('msprRemains', $data['id']);

        } else {
            $remain = $this->modx->getObject('msprRemains', array(
                'product_id' => $productId
            , 'options' => $this->modx->toJSON($data['options'])
            ));
        }
        if (empty($remain)) {
            $remain = $this->modx->newObject('msprRemains');
        }

        if (!empty($data['options'])) {
            if (!$product) $product = $this->modx->getObject('msProduct', $productId);
            if ($product) {
                foreach ($data['options'] as $key => $val) {
                    if ($this->isKeyArrayType($key)) {
                        if (!$tmp = $product->get($key)) $tmp = array();
                        if (!in_array($val, $tmp)) {
                            $tmp[] = $val;
                        }
                        $val = $tmp;
                    }
                    if ($this->getProductOptionKeyType($key)) {
                        $pOptions = $product->get('options');
                        $pOptions[$key] = $val;
                        $product->set('options', $pOptions);
                    } else {
                        $product->set($key, $val);
                    }
                }
            }
        }


        $remain->fromArray($data);
        if ($remain->save()) {
            if ($product) $product->save();
            $res = $this->invokeEvent('msieOnAfterImportRemains', array(
                'data' => $data,
                'productId' => $productId,
                'msie' => &$this,
                'preset' => $preset,
            ));
            return true;
        }
        return false;
    }


    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importRemain($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );

        $fileIds = self::getTempDir() . $preset . '_ids.txt';
        $file = $this->config['uploadPath'] . $filename;
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $delimeter = $this->modx->getOption('msimportexport.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, $delimeter);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $optionsKey = array_map('trim', explode(',', $this->modx->getOption('mspr_options', null, '')));
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);

        if (empty($seek)) {
            if (file_exists($fileIds)) unlink($fileIds);
            $this->ids[$preset] = array();
            $res = $this->invokeEvent('msieOnStartImportRemains', array(
                'file' => $file,
                'preset' => $preset,
                'msie' => &$this,
            ));
        } else {
            $this->ids[$preset] = array();
            if (file_exists($fileIds)) {
                $this->ids[$preset] = unserialize(file_get_contents($fileIds));
            }
        }
        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(
            array('file' => $file, 'seek' => $seek),
            function (
                $reader,
                $csv
            ) use (
                &$i,
                &$out,
                &$ids,
                &$self,
                $fields,
                $optionsKey,
                $stepLimit,
                $isDebug,
                $subDelimeter,
                $key,
                $ignoreFirstLine,
                $preset
            ) {
                $i++;
                $out['rows']++;
                $self->modx->error->reset();
                if ($ignoreFirstLine && $i == 1) return true;
                $data = array();
                $options = array('options' => array());
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));
                foreach ($fields as $k => $v) {
                    if ($v != $key) {
                        $v = str_replace('mspr:', '', $v);
                        if ($v == 'options') {
                            $val = array_map('trim', explode($subDelimeter, $csv[$k]));
                            foreach ($optionsKey as $oIdx => $oKey) {
                                $options['options'][$oKey] = isset($val[$oIdx]) ? $val[$oIdx] : '';
                            }
                        } else {
                            $options[$v] = trim($csv[$k]);
                        }
                    } else {
                        $data[$v] = trim($csv[$k]);
                    }
                }
                $productId = 0;
                if (!isset($options['product_id'])) {

                    // Set default values
                    if (empty($data['class_key'])) {
                        $data['class_key'] = 'msProduct';
                    }
                    if (empty($data['context_key'])) {
                        $data['context_key'] = $self->ctx;
                    }

                    // Duplicate check
                    $q = $self->modx->newQuery($data['class_key']);
                    $q->select($data['class_key'] . '.id');
                    $isProduct = false;
                    if (strtolower($data['class_key']) == 'msproduct') {
                        $q->innerJoin('msProductData', 'Data', $data['class_key'] . '.id = Data.id');
                        $isProduct = true;
                    }
                    $tmp = $self->modx->getFields($data['class_key']);
                    if (isset($tmp[$key])) {
                        $q->where(array('context_key:=' => $data['context_key'], $key => $data[$key]));
                    } elseif ($isProduct) {
                        $q->where(array('context_key:=' => $data['context_key'], 'Data.' . $key => $data[$key]));
                    }
                    $q->prepare();
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.check_duplicate') . "\n" . $q->toSql());

                    /** @var modResource $exists */
                    if (!$exists = $self->modx->getObject($data['class_key'], $q)) {
                        $self->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] not find product by key:' . $key);
                        $out['errors']++;
                        return true;
                    }
                    $productId = $exists->id;
                    unset($exists);
                } else {
                    $productId = $options['product_id'];
                }
                if ($self->saveRemain($options, $productId, $preset)) {
                    $out['update']++;
                } else {
                    $out['errors']++;
                }

                unset($res);
                unset($data);
                unset($options);

                if ($isDebug) {
                    $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                    return false;
                }

                $seek = $reader->getSeek();
                if ($i >= $stepLimit || $seek < 0) {
                    return false;
                } else {
                    return true;
                }
            }
        );

        if (!empty($this->ids[$preset])) {
            file_put_contents($fileIds, serialize($this->ids[$preset]));
        }

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportRemains', array(
                'data' => empty($this->ids[$preset]) ? array() : $this->ids[$preset],
                'msie' => &$this,
                'preset' => $preset,
            ));
            $this->clearUploadDir();
        }

        $out['seek'] = $seek;
        return $out;
    }


    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importLinks($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );
        $file = $this->config['uploadPath'] . $filename;
        $fileIds = self::getTempDir() . 'linkids.txt';
        $this->linkIds = array();
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $isRemoveLinks = $this->modx->getOption('msimportexport.import.remove_link', null, 0, true);
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);
        if (empty($seek)) {
            if (file_exists($fileIds)) unlink($fileIds);
        } else {
            if (file_exists($fileIds)) {
                $this->linkIds = unserialize(file_get_contents($fileIds));
            }
        }

        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(array(
            'file' => $file,
            'seek' => $seek,
        ), function (
            $reader,
            $csv
        ) use (
            &$i,
            &$out,
            &$self,
            $fields,
            $key,
            $ignoreFirstLine,
            $isRemoveLinks,
            $stepLimit,
            $isDebug,
            $preset
        ) {
            $i++;
            $out['rows']++;
            $self->modx->error->reset();
            if ($ignoreFirstLine && $i == 1) {
                return true;
            }

            $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));

            $res = $self->invokeEvent('msieOnBeforePrepareImportLinks', array(
                'data' => $csv,
                'fields' => $fields,
                'preset' => $preset,
                'msie' => &$self,
            ));

            $csv = $res['data']['data'];
            $fields = $res['data']['fields'];


            foreach ($fields as $k => $v) {
                switch ($v) {
                    case 'link':
                        $data['link'] = $csv[$k];
                        break;
                    case 'master':
                        $data['master'] = $csv[$k];
                        break;
                    case 'master_' . $key:
                        $data['master'] = $this->getProductIdByKey($csv[$k], $key);
                        break;
                    case 'slave':
                        $data['slave'] = $csv[$k];
                        break;
                    case 'slave_' . $key:
                        $data['slave'] = $this->getProductIdByKey($csv[$k], $key);
                        break;
                }
            }

            if (count($data) < 3) {
                $out['errors']++;
                $self->modx->log(modX::LOG_LEVEL_ERROR, 'Error import link, incorrect data. Fields: ' . print_r($fields, 1) . '  Input data: ' . print_r($csv, 1) . ' Output data:' . print_r($data, 1));
                return true;
            }

            if ($isRemoveLinks && !isset($this->linkIds[$data['master']])) {
                $this->linkIds[$data['master']] = 1;
                $self->removeLink($data['master']);
            }

            $res = $self->invokeEvent('msieOnBeforeImportLinks', array(
                'srcData' => $csv,
                'destData' => $data,
                'fields' => $fields,
                'msie' => &$self,
                'preset' => $preset,
                'skip' => false,
            ));

            if (!$res['success']) {
                $out['errors']++;
                $self->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                return true;
            }

            if (!empty($res['data']['skip'])) return true;
            $data = $res['data']['destData'];

            $response = $self->modx->runProcessor('mgr/product/productlink/create', $data, array('processors_path' => $self->config['corePathMiniShop2'] . 'processors/'));
            if ($response->isError()) {
                $out['errors']++;
                $self->modx->log(modX::LOG_LEVEL_ERROR, $self->modx->lexicon('msimportexport.err_import_link') . "\n" . print_r($response->getAllErrors(), 1));
            } else {
                $out['create']++;
            }

            if ($isDebug) {
                $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                return false;
            }
            $seek = $reader->getSeek();
            if ($i >= $stepLimit || $seek < 0) {
                return false;
            } else {
                return true;
            }
        });

        if (!empty($this->linkIds)) {
            file_put_contents($fileIds, serialize($this->linkIds));
        }

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportLinks', array(
                'msie' => &$this,
                'preset' => $preset,
            ));
        }

        $out['seek'] = $seek;
        return $out;
    }

    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importGallery($filename = '', $preset, $seek = 0, $key = '')
    {

        $out = array(
            'errors' => 0,
            'update' => 0,
            'create' => 0,
            'seek' => 0,
            'rows' => 0,
        );
        $fileIds = self::getTempDir() . 'gallery_ids.txt';
        $file = $this->config['uploadPath'] . $filename;
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $clearGallery = $this->modx->getOption('msimportexport.gallery.remove_before_import', null, 0, true);

        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        if (empty($seek)) {
            if (file_exists($fileIds)) unlink($fileIds);
            $this->galleryProductIds = array();
        } else {
            $this->galleryProductIds = array();
            if (file_exists($fileIds)) {
                $this->galleryProductIds = unserialize(file_get_contents($fileIds));
            }
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);
        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(array(
            'file' => $file,
            'seek' => $seek,
        ), function (
            $reader,
            $csv
        ) use (
            &$i,
            &$out,
            &$self,
            $fields,
            $preset,
            $key,
            $ignoreFirstLine,
            $clearGallery,
            $stepLimit,
            $isDebug
        ) {
            $i++;
            $out['rows']++;
            $self->modx->error->reset();
            if ($ignoreFirstLine && $i == 1) {
                return true;
            }

            $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));
            $continue = false;
            foreach ($fields as $k => $v) {

                if (!isset($csv[$k])) {
                    $out['errors']++;
                    $continue = true;
                    $self->modx->log(modX::LOG_LEVEL_ERROR, $self->parseString($self->modx->lexicon('msimportexport.err_field'), array('field' => $v, 'index' => $out['rows'])));
                    continue;
                }
                $data[$v] = $csv[$k];
            }

            if ($continue) return true;

            if (!isset($data['id']) || empty($data['id'])) {
                $val = isset($data[$key]) ? $data[$key] : null;
                if ($val) {
                    $data['id'] = $self->getProductIdByKey($val, $key);
                }
            }

            if (!isset($data['id']) || empty($data['id'])) {
                $self->modx->log(modX::LOG_LEVEL_ERROR, '[importGallery] Not set product ID. Data:' . print_r($data, 1));
                return true;
            }

            if ($clearGallery && !isset($self->galleryProductIds[$data['id']])) {
                $self->clearImageGallery($data['id']);
            }

            if ($self->addImageGallery($data, $preset)) {
                $out['create']++;
            } else {
                $out['errors']++;
            }

            $self->galleryProductIds[$data['id']] = $data['id'];

            if ($isDebug) {
                $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                return false;
            }
            $seek = $reader->getSeek();
            if ($i >= $stepLimit || $seek < 0) {
                return false;
            } else {
                return true;
            }
        });

        if (!empty($this->galleryProductIds)) {
            file_put_contents($fileIds, serialize($this->galleryProductIds));
        }

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportGallery', array(
                'msie' => &$this,
                'data' => implode(',', $this->galleryProductIds),
                'preset' => $preset,
            ));
        }

        $out['seek'] = $seek;
        return $out;
    }

    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importCategories($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );
        $file = $this->config['uploadPath'] . $filename;
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $delimeter = $this->modx->getOption('msimportexport.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, $delimeter);
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);

        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        $tvEnabled = false;

        foreach ($fields as $v) {
            if (preg_match('/^tv(\d+)$/', $v)) {
                $tvEnabled = true;
                break;
            }
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);
        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(
            array(
                'file' => $file,
                'seek' => $seek,
            ), function (
            $reader,
            $csv
        ) use (
            &$i,
            &$out,
            &$self,
            $key,
            $fields,
            $preset,
            $subDelimeter,
            $stepLimit,
            $ignoreFirstLine,
            $tvEnabled,
            $isDebug
        ) {
            $i++;
            $out['rows']++;
            $self->modx->error->reset();
            if ($ignoreFirstLine && $i == 1) {
                return true;
            }
            $data = array();
            $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));

            $res = $self->invokeEvent('msieOnBeforePrepareImportCategory', array(
                'data' => $csv,
                'fields' => $fields,
                'preset' => $preset,
                'msie' => &$self,
            ));
            $csv = $res['data']['data'];
            $fields = $res['data']['fields'];
            foreach ($fields as $k => $v) {
                if ($v == 'parent') {
                    if (!is_numeric($csv[$k])) {
                        if ($parent = $self->prepareParentProduct($csv[$k])) {
                            $data[$v] = $parent;
                        }
                    } else {
                        $data[$v] = trim($csv[$k]);
                    }
                } else {
                    $data[$v] = trim($csv[$k]);
                }
            }

            if (empty($data['class_key'])) {
                $data['class_key'] = 'msCategory';
            }

            if (empty($data['context_key'])) {
                $data['context_key'] = $self->ctx;;
            }

            $data['tvs'] = $tvEnabled;

            if (!isset($data['parent']) || empty($data['parent'])) $data['parent'] = 0;

            // Duplicate check
            $q = $self->modx->newQuery($data['class_key']);
            // $q->where(array('context_key:=' => $data['context_key'], $key => $data[$key], 'parent' => $data['parent']));
            $q->where(array($key => $data[$key]));
            if (isset($data['context_key'])) {
                $q->where(array('context_key:=' => $data['context_key']));
            }
            $q->prepare();
            $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.check_duplicate') . "\n" . $q->toSql());


            /** @var modResource $exists */
            if ($exists = $self->modx->getObject($data['class_key'], $q)) {
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.key_duplicate'), array('key1' => $key, 'key2' => $data[$key])));
                $action = 'update';
                if (!isset($data['pagetitle'])) {
                    $data['pagetitle'] = $exists->get('pagetitle');
                }
                if (!isset($data['parent'])) {
                    $data['parent'] = $exists->get('parent');
                }
                $data['id'] = $exists->id;
            } else {
                $action = 'create';
            }

            if (empty($data['parent']) && $action == 'create') {
                $out['errors']++;
                $self->modx->log(modX::LOG_LEVEL_ERROR, $self->modx->lexicon('msimportexport.err_parent') . print_r($data, 1));
                return true;
            }

            $res = $self->invokeEvent('msieOnBeforeImportCategory', array(
                'mode' => $action,
                'preset' => $preset,
                'srcData' => $csv,
                'destData' => $data,
                'fields' => $fields,
                'msie' => &$self,
                'skip' => false,
            ));

            if (!$res['success']) {
                $out['errors']++;
                $self->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                return true;
            }

            if (!empty($res['data']['skip'])) return true;

            $data = $res['data']['destData'];

            $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.importing_data') . "\n" . print_r($data, 1));

            $response = $self->modx->runProcessor('resource/' . $action, $data);

            if ($response->isError()) {
                $self->modx->log(modX::LOG_LEVEL_ERROR, $self->modx->lexicon('msimportexport.err_action') . " $action: \n" . print_r($response->getAllErrors(), 1));
            } else {
                $out[$action]++;
                $resource = $response->getObject();
                $res = $self->invokeEvent('msieOnAfterImportCategory', array(
                    'mode' => $action,
                    'preset' => $preset,
                    'srcData' => $csv,
                    'destData' => $data,
                    'data' => $resource,
                    'fields' => $fields,
                    'msie' => &$self,
                ));
                $self->modx->log(modX::LOG_LEVEL_INFO, "Successful $action: \n" . print_r($resource, 1));
                // Process gallery images, if exists
            }
            unset($exists);
            unset($response);
            unset($res);
            unset($data);

            if ($isDebug) {
                $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                return false;
            }

            $seek = $reader->getSeek();
            $reader->clearCache();

            if ($i >= $stepLimit || $seek < 0) {
                return false;
            } else {
                return true;
            }
        });

        $seek = $reader->getSeek();
        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportCategory', array(
                'msie' => &$this,
                'preset' => $preset,
            ));
            $this->clearUploadDir();
        }

        $out['seek'] = $seek;
        unset($ids);
        unset($fields);
        return $out;
    }


    /**
     * @param string $field
     * @param string $val
     * @return string
     */
    public function prepareUpdateNumberField($field, $val)
    {
        if ($val == '') return 0;
        $val = trim($val);
        $val = str_replace(',', '.', $val);
        $pref = mb_substr($val, 0, 2);
        $act = '';
        switch ($pref) {
            case '+=':
                $act = ' + ';
                break;
            case '-=':
                $act = ' - ';
                break;
            case '*=':
                $act = ' * ';
                break;
        }
        return empty($act) ? $val : $this->modx->escape($field) . $act . mb_substr($val, 2);
    }

    /**
     * @param array $fields
     * @param array $where
     * @param string $className
     * @return string
     */
    public function buildUpdateSql(array $fields, array $where = array(), $className = 'msProductData')
    {
        $vType = '';
        $sql = '';
        $table = $this->modx->getTableName($className);
        $fieldMeta = $this->modx->getFieldMeta($className);
        $set = array();
        foreach ($fields as $key => $value) {
            if (!array_key_exists($key, $fieldMeta)) continue;

            $fieldType = PDO::PARAM_STR;
            if (!in_array($fieldMeta[$key]['phptype'], array('string', 'password', 'datetime', 'timestamp', 'date', 'time', 'array', 'json', 'float'))) {
                $fieldType = PDO::PARAM_INT;
            }
            $phptype = $fieldMeta[$key]['phptype'];
            $dbtype = $fieldMeta[$key]['dbtype'];
            $quote = true;
            switch ($phptype) {
                case 'timestamp' :
                case 'datetime' :
                    $ts = false;
                    if (preg_match('/int/i', $dbtype)) {
                        if (strtolower($vType) == 'integer' || is_int($value) || $value == '0') {
                            $ts = (integer)$value;
                        } else {
                            $ts = strtotime($value);
                        }
                        if ($ts === false) {
                            $ts = 0;
                        }
                        $value = $ts;
                    } else {
                        if ($vType == 'utc' || in_array($value, $this->modx->driver->_currentTimestamps) || $value === '0000-00-00 00:00:00') {
                            $value = (string)$value;
                            $set = true;
                        } else {
                            if (strtolower($vType) == 'integer' || is_int($value)) {
                                $ts = intval($value);
                            } elseif (is_string($value) && !empty($value)) {
                                $ts = strtotime($value);
                            }
                            if ($ts !== false) {
                                $value = strftime('%Y-%m-%d %H:%M:%S', $ts);
                            }
                        }
                    }
                    break;
                case 'date' :
                    if (preg_match('/int/i', $dbtype)) {
                        if (strtolower($vType) == 'integer' || is_int($value) || $value == '0') {
                            $ts = (integer)$value;
                        } else {
                            $ts = strtotime($value);
                        }
                        if ($ts === false) {
                            $ts = 0;
                        }
                        $value = $ts;
                    } else {
                        if ($vType == 'utc' || in_array($value, $this->modx->driver->_currentDates) || $value === '0000-00-00') {

                        } else {
                            if (strtolower($vType) == 'integer' || is_int($value)) {
                                $ts = intval($value);
                            } elseif (is_string($value) && !empty($value)) {
                                $ts = strtotime($value);
                            }
                            $ts = strtotime($value);
                            if ($ts !== false) {
                                $value = strftime('%Y-%m-%d', $ts);
                            }
                        }
                    }
                    break;
                case 'float' :
                    $value = $this->prepareUpdateNumberField($key, $value);
                    if (is_numeric($value)) {
                        $value = str_replace(',', '.', floatval($value));
                    } else {
                        $quote = false;
                    }
                    break;
                case 'boolean' :
                case 'integer' :
                case 'tinyint' :
                case 'int' :
                    $value = $this->prepareUpdateNumberField($key, $value);
                    if (is_numeric($value)) {
                        $value = intval($value);
                    } else {
                        $quote = false;
                    }
                    break;
                case 'json' :
                    if (is_array($value)) {
                        $value = $this->modx->toJSON($value);
                    }
                    break;
                case 'array' :
                    if (is_array($value)) {
                        $value = serialize($value);
                    }
                    break;
            }
            $value = $quote ? $this->modx->quote($value, $fieldType) : $value;
            $set[] = $this->modx->escape($key) . '=' . $value;
        }

        if (!empty($set)) {
            $sql = "UPDATE {$table}  AS {$className} SET " . implode(',', $set);
            if (!empty($where)) {
                $q = $this->modx->newQuery($className);
                $q->where($where);
                $q->sql = $q->buildConditionalClause($q->query['where']);
                $sql .= ' WHERE ' . $q->toSql() . ' ';
            }
        }
        return $sql;
    }

    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    public function updateProducts($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );

        $vendorIds = array();
        $file = $this->config['uploadPath'] . $filename;
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $delimeter = $this->modx->getOption('msimportexport.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, $delimeter);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);

        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);

        if (empty($seek)) {
            $res = $this->invokeEvent('msieOnStartUpdateProduct', array(
                'fields' => $fields,
                'preset' => $preset,
                'msie' => &$this,
            ));
        }

        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(
            array('file' => $file, 'seek' => $seek),
            function (
                $reader,
                $csv
            ) use (
                &$i,
                &$out,
                &$self,
                $fields,
                $preset,
                $stepLimit,
                $isDebug,
                $vendorIds,
                $subDelimeter,
                $key,
                $ignoreFirstLine
            ) {
                $i++;
                $out['rows']++;
                $self->modx->error->reset();
                if ($ignoreFirstLine && $i == 1) {
                    return true;
                }

                $data = array();
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));
                $res = $self->invokeEvent('msieOnBeforePrepareUpdateProduct', array(
                    'data' => $csv,
                    'fields' => $fields,
                    'preset' => $preset,
                    'msie' => &$self,
                ));

                $csv = $res['data']['data'];
                $fields = $res['data']['fields'];

                foreach ($fields as $k => $v) {
                    if ($v == 'vendor') {
                        $vendorId = $csv[$k];
                        if (!is_numeric($csv[$k])) {
                            if (empty($vendorIds[$csv[$k]])) {
                                if ($vendorId = $self->getVendorIdByName($csv[$k])) {
                                    $vendorIds[$csv[$k]] = $vendorId;
                                } else {
                                    $vendorId = $self->addVendor($csv[$k]);
                                }
                            } else {
                                $vendorId = $vendorIds[$csv[$k]];
                            }
                        }
                        if ($vendorId) {
                            $data[$v] = $vendorId;
                        }
                    } else if ($self->isKeyArrayType($v)) {
                        $val = array_map('trim', explode($subDelimeter, $csv[$k]));
                        $data[$v] = $val;
                    } else {
                        $data[$v] = $csv[$k];
                    }
                }

                $res = $self->invokeEvent('msieOnBeforeUpdateProduct', array(
                    'data' => $data,
                    'fields' => $fields,
                    'preset' => $preset,
                    'skip' => false,
                    'msie' => &$self,
                ));

                if (!$res['success']) {
                    $out['errors']++;
                    $self->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                    return true;
                }

                if (!empty($res['data']['skip'])) return true;

                $data = $res['data']['data'];
                if ($key != 'pagetitle') {
                    $where = array(
                        $key . ':=' => $data[$key],
                    );
                } else {
                    $where = array(
                        'id' . ':=' => $this->getProductIdByPageTitle($data[$key]),
                    );
                }
                unset($data[$key]);
                $sql = $self->buildUpdateSql($data, $where);
                $self->modx->log(modX::LOG_LEVEL_INFO, "Update SQL: \n" . $sql);
                if ($self->modx->exec($sql)) {
                    $out['update']++;
                } else {
                    $err = $self->modx->pdo->errorInfo();
                    switch ($err[0]) {
                        case '01000':
                        case '00000':
                            $out['update']++;
                            break;
                        default:
                            $out['errors']++;
                            $this->modx->log(modX::LOG_LEVEL_ERROR, '[updateProducts]  error info: ' . print_r($err, 1) . "\nSQL: " . $sql);
                    }
                }

                if ($isDebug) {
                    $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                    return false;
                }

                $seek = $reader->getSeek();
                if ($i >= $stepLimit || $seek < 0) {
                    return false;
                } else {
                    return true;
                }
            }
        );

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteUpdateProduct', array('preset' => $preset,));
            $this->clearUploadDir();
        }

        $out['seek'] = $seek;
        unset($fields);
        unset($vendorIds);
        return $out;
    }

    /**
     * @param int $productId
     * @param string $article
     * @param array $data
     * @return mixed
     */
    public function setProductModification($productId, $article, $data = array())
    {
        if (!$modification = $this->modx->getObject('msopModification', array('rid' => $productId, 'article' => $article))) {
            return false;
            /* $modification = $this->modx->newObject('msopModification');
             $modification->set('rid', $productId);
             $modification->set('article', $article);*/
        }
        $modification->fromArray($data);
        return $modification->save();
    }

    /**
     * @param string $article
     * @param string $field
     * @return array|mixed
     */
    public function getProductModificationByArticle($article, $field = '')
    {
        $result = array();
        $classKey = 'msopModification';
        $q = $this->modx->newQuery($classKey);
        $q->select($this->modx->getSelectColumns($classKey, $classKey));
        $q->where(array('msopModification.`article`:=' => $article));
        if ($q->prepare() && $q->stmt->execute()) {
            $result = $q->stmt->fetch(PDO::FETCH_ASSOC);
        }
        return $field ? $result[$field] : $result;
    }

    /**
     * @param array $data
     * @param int $productId
     * @param int $preset
     */
    public function saveProductModification($data, $productId, $preset = 0)
    {

        if (empty($data)) return;
        $fds = array('name', 'active', 'type', 'price', 'old_price', 'article', 'weight', 'count', 'image');
        $modifications = array('options' => array());
        if (empty($productId) && !empty($data['article'])) {
            if (!$productId = $this->getProductModificationByArticle($data['article'], 'rid')) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error save product modification. Not find product id by article:' . $data['article']);
                return;
            }
        }

        foreach ($data as $key => $val) {
            if (in_array($key, $fds)) {
                $modifications[$key] = $val;
            } else {
                if ($val != '!skip!') {
                    $modifications['options'][$key] = $val;
                }
            }
        }

        if (isset($modifications['image']) && !empty($modifications['image']) && !is_numeric($modifications['image'])) {
            $modifications['image'] = $this->getProductModificationImageId($productId, $modifications['image']);
        }

        if (!isset($modifications['active'])) $modifications['active'] = 1;

        $modifications['options'] = array_filter($modifications['options'], function ($value) {
            return trim($value) !== '';
        });

        $res = $this->invokeEvent('msieOnBeforeImportOptionsPrice2', array(
            'data' => $modifications,
            'productId' => $productId,
            'msie' => &$this,
            'preset' => $preset,
            'skip' => false,
        ));

        if (!$res['success']) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
            return;
        }
        if (!empty($res['data']['skip'])) return;
        $modifications = $res['data']['data'];
        $this->modx->log(modX::LOG_LEVEL_INFO, '[msImportExport] data for  OptionsPrice2 (product ID ' . $productId . '):' . "\n" . print_r($modifications, 1));
        $isRemoveModification = $this->modx->getOption('msimportexport.import.msop_remove_modification', null, 0);
        if ($isRemoveModification && !isset($this->ids[$preset . '_op'][$productId])) {
            $this->ids[$preset . '_op'][$productId] = 1;
            $this->modx->call('msopModification', 'removeProductModification', array(&$this->modx, $productId));
        }
        if (empty($modifications['options']) && isset($modifications['article'])) {
            $this->setProductModification($productId, $modifications['article'], $data);
        } else {
            $this->modx->call('msopModification', 'saveProductModification', array(&$this->modx, $productId, array($modifications)));
        }
        $res = $this->invokeEvent('msieOnAfterImportOptionsPrice2', array(
            'data' => $modifications,
            'productId' => $productId,
            'msie' => &$this,
            'preset' => $preset,
        ));

    }

    /**
     * @param int $productId
     * @param string $image
     * @return int
     */
    public function getProductModificationImageId($productId, $image)
    {
        $classGallery = trim($this->modx->getOption('msoptionsprice_modification_gallery_class', null, 'msProductFile', true));
        if ($classGallery) {
            $image = pathinfo($image, PATHINFO_BASENAME);
            $q = $this->modx->newQuery($classGallery);
            $orImage = str_replace('_', '-', $image);
            $q->where(array(
                '`' . $classGallery . '`.`file`:=' => $image,
                'OR:`' . $classGallery . '`.`file`:=' => $orImage,
                '`' . $classGallery . '`.parent`:=' => 0,
            ));
            $q->select('id');
            switch ($classGallery) {
                case 'msProductFile':
                    $q->where(array('product_id' => $productId));
                    break;
                case 'msResourceFile':
                    $q->where(array('resource_id' => $productId));
                    break;
            }

            if ($q->prepare() && $q->stmt->execute()) {
                return $q->stmt->fetch(PDO::FETCH_COLUMN);
            }
        }
        return 0;
    }

    /**
     * @param $id
     * @return string
     */
    public function getImageProductModification($id)
    {
        $classGallery = trim($this->modx->getOption('msoptionsprice_modification_gallery_class', null, 'msProductFile', true));
        if ($classGallery) {
            $q = $this->modx->newQuery($classGallery);
            $q->where(array('id' => $id, 'parent' => 0));
            $q->select("{$classGallery}.url");
            if ($q->prepare() && $q->stmt->execute()) {
                return $q->stmt->fetch(PDO::FETCH_COLUMN);
            }
        }
        return '';
    }

    public function disableAllProductModification()
    {
        $table = $this->modx->getTableName('msopModification');
        $update = $this->modx->prepare("UPDATE {$table} SET active = 0");
        $update->execute(array());
    }

    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importOptionsPrice2($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );

        $fileIds = self::getTempDir() . $preset . '_ids.txt';
        $file = $this->config['uploadPath'] . $filename;
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $delimeter = $this->modx->getOption('msimportexport.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, $delimeter);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $disableModification = (int)$this->modx->getOption('msimportexport.import.msop_disable_modification', null, 0);
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);

        if (empty($seek)) {
            if (file_exists($fileIds)) unlink($fileIds);
            if ($disableModification) $this->disableAllProductModification();
            $this->ids[$preset . '_op'] = array();
            $res = $this->invokeEvent('msieOnStartImportOptionsPrice2', array(
                'file' => $file,
                'msie' => &$this,
                'preset' => $preset,
            ));
        } else {
            $this->ids[$preset . '_op'] = array();
            if (file_exists($fileIds)) {
                $this->ids[$preset . '_op'] = unserialize(file_get_contents($fileIds));
            }
        }
        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(
            array('file' => $file, 'seek' => $seek),
            function (
                $reader,
                $csv
            ) use (
                &$i,
                &$out,
                &$ids,
                &$self,
                $fields,
                $stepLimit,
                $isDebug,
                $subDelimeter,
                $key,
                $ignoreFirstLine,
                $preset
            ) {
                $i++;
                $out['rows']++;
                $self->modx->error->reset();
                if ($ignoreFirstLine && $i == 1) return true;
                $data = array();
                $modification = array();
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));
                foreach ($fields as $k => $v) {
                    if ($v != $key) {
                        $v = str_replace('msop:', '', $v);
                        $modification[$v] = trim($csv[$k]);
                    } else {
                        $data[$v] = trim($csv[$k]);
                    }
                }
                // Set default values
                if (empty($data['class_key'])) {
                    $data['class_key'] = 'msProduct';
                }
                if (empty($data['context_key'])) {
                    $data['context_key'] = $self->ctx;
                }

                // Duplicate check
                $q = $self->modx->newQuery($data['class_key']);
                $q->select($data['class_key'] . '.id');
                $isProduct = false;
                if (strtolower($data['class_key']) == 'msproduct') {
                    $q->innerJoin('msProductData', 'Data', $data['class_key'] . '.id = Data.id');
                    $isProduct = true;
                }
                $tmp = $self->modx->getFields($data['class_key']);
                $productId = 0;
                if (isset($data[$key])) {
                    if (isset($tmp[$key])) {
                        $q->where(array('context_key:=' => $data['context_key'], $key => $data[$key]));
                    } elseif ($isProduct) {
                        $q->where(array('context_key:=' => $data['context_key'], 'Data.' . $key => $data[$key]));
                    }
                    $q->prepare();
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.check_duplicate') . "\n" . $q->toSql());
                    /** @var modResource $exists */
                    if (!$exists = $self->modx->getObject($data['class_key'], $q)) {
                        $out['errors']++;
                        $self->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] not find product by key:' . $key);
                        return true;
                    } else {
                        $productId = $exists->id;
                    }
                } else if (!isset($modification['article'])) {
                    $out['errors']++;
                    $self->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] Unable to search for product ID for data:' . print_r($csv, 1));
                    return true;
                }

                $self->saveProductModification($modification, $productId, $preset);
                $out['update']++;

                unset($exists);
                unset($res);
                unset($data);
                unset($modification);

                if ($isDebug) {
                    $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                    return false;
                }

                $seek = $reader->getSeek();
                if ($i >= $stepLimit || $seek < 0) {
                    return false;
                } else {
                    return true;
                }
            }
        );

        if (!empty($this->ids[$preset . '_op'])) {
            file_put_contents($fileIds, serialize($this->ids[$preset . '_op']));
        }

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportOptionsPrice2', array(
                'data' => empty($this->ids[$preset . '_op']) ? array() : $this->ids[$preset . '_op'],
                'msie' => &$this,
                'preset' => $preset,
            ));
            $this->clearUploadDir();
        }

        $out['seek'] = $seek;
        return $out;
    }


    public function disableAllProductColor()
    {
        if (!$msoptionscolor = $this->getInstanceOptionsColor()) return;
        $table = $this->modx->getTableName('msocColor');
        $update = $this->modx->prepare("UPDATE {$table} SET active = 0");
        $update->execute(array());
    }

    /**
     * @param int $productId
     * @return bool|void
     */
    public function removeProductAllColor($productId)
    {
        if (!$msoptionscolor = $this->getInstanceOptionsColor()) return;
        if ($items = $this->modx->getCollection('msocColor', array('rid' => $productId))) {
            $msoptionscolor->removeProductOptions($productId);
            foreach ($items as $item) {
                $item->remove();
            }
        }
        return true;
    }


    /**
     * @param array $data
     * @param $productId
     * @param int $preset
     * @return bool|void
     */
    public function saveProductColor($data, $productId, $preset = 0)
    {
        if (empty($data)) return;
        $data['key'] = isset($data['key']) ? trim($data['key']) : '';
        $data['value'] = isset($data['value']) ? trim($data['value']) : '';
        if (!isset($data['active'])) $data['active'] = 1;
        if (empty($data['key'])) return;
        $res = $this->invokeEvent('msieOnBeforeImportOptionsColor', array(
            'data' => $data,
            'productId' => $productId,
            'msie' => &$this,
            'preset' => $preset,
            'skip' => false,
        ));

        if (!$res['success']) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
            return;
        }
        if (!empty($res['data']['skip'])) return;
        $data = $res['data']['data'];
        $this->modx->log(modX::LOG_LEVEL_INFO, '[msImportExport] data for  OptionsColor (product ID ' . $productId . '):' . "\n" . print_r($data, 1));
        $isRemoveColor = $this->modx->getOption('msimportexport.import.msoc_remove_color', null, 0);
        if ($isRemoveColor && !isset($this->ids[$preset][$productId])) {
            $this->ids[$preset][$productId] = 1;
            $this->removeProductAllColor($productId);
        }

        $keys = array_map('trim', explode(',', $this->modx->getOption('msimportexport.import.msoc_keys', null, 'key', true)));
        $tmp = array('rid' => $productId);

        foreach ($keys as $key) {
            if (isset($data[$key]))
                $tmp[$key] = $data[$key];
        }

        $msoptionscolor = $this->getInstanceOptionsColor();
        $msoptionscolor->setProductOptions($productId, array($data['key'] => $data['value']), $data['key']);

        if (!$color = $this->modx->getObject('msocColor', $tmp)) {
            $color = $this->modx->newObject('msocColor');
            $color->set('rid', $productId);
            $color->set('key', $data['key']);
            $color->set('value', $data['value']);
        }
        $color->fromArray($data);
        if ($color->save()) {
            $res = $this->invokeEvent('msieOnAfterImportOptionsColor', array(
                'data' => $data,
                'productId' => $productId,
                'msie' => &$this,
                'preset' => $preset,
            ));
            return true;
        }
        return false;
    }

    /**
     * @param int $productId
     * @return bool|void
     */
    public function removeProductAllSalePrice($productId)
    {
        if (!$saleprice = $this->getInstanceSalePrice()) return;
        if ($items = $this->modx->getCollection('msspPrice', array('rid' => $productId))) {
            foreach ($items as $item) {
                $item->remove();
            }
        }
        return true;
    }

    /**
     * @param array $data
     * @param int $productId
     * @param int $preset
     * @return bool|void
     */
    public function saveSalePrice($data, $productId, $preset = 0)
    {
        $types = array('=' => 1, '+' => 2, '-' => 3, '*' => 4, '/' => 5, '%' => 6);
        if (empty($data)) return;
        if (isset($data['type'])) {
            $type = $data['type'];
            $data['type'] = isset($types[$type]) ? $types[$type] : $type;
        }
        $data['rid'] = $productId;
        $res = $this->invokeEvent('msieOnBeforeImportSalePrice', array(
            'data' => $data,
            'productId' => $productId,
            'msie' => &$this,
            'preset' => $preset,
            'skip' => false,
        ));

        if (!$res['success']) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
            return;
        }
        if (!empty($res['data']['skip'])) return;
        $data = $res['data']['data'];
        $this->modx->log(modX::LOG_LEVEL_INFO, '[msImportExport] data for  SalePrice (product ID ' . $productId . '):' . "\n" . print_r($data, 1));
        $isRemove = $this->modx->getOption('msimportexport.import.mssp_remove', null, 0);
        if ($isRemove && !isset($this->ids[$preset][$productId])) {
            $this->ids[$preset][$productId] = 1;
            $this->removeProductAllSalePrice($productId);
        }
        $this->getInstanceSalePrice();
        if (!isset($data['count']) || !$saleprice = $this->modx->getObject('msspPrice', array('rid' => $productId, 'count' => $data['count']))) {
            $saleprice = $this->modx->newObject('msspPrice');
        }
        $saleprice->fromArray($data);
        if ($saleprice->save()) {
            $res = $this->invokeEvent('msieOnAfterImportSalePrice', array(
                'data' => $data,
                'productId' => $productId,
                'msie' => &$this,
                'preset' => $preset,
            ));
            return true;
        }
        return false;
    }


    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importOptionsColor($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );

        $fileIds = self::getTempDir() . $preset . '_ids.txt';
        $file = $this->config['uploadPath'] . $filename;
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $delimeter = $this->modx->getOption('msimportexport.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, $delimeter);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $disableColor = (int)$this->modx->getOption('msimportexport.import.msoc_disable_color', null, 0);
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);

        if (empty($seek)) {
            if (file_exists($fileIds)) unlink($fileIds);
            if ($disableColor) $this->disableAllProductColor();
            $this->ids[$preset] = array();
            $res = $this->invokeEvent('msieOnStartImportOptionsColor', array(
                'file' => $file,
                'preset' => $preset,
                'msie' => &$this,
            ));
        } else {
            $this->ids[$preset] = array();
            if (file_exists($fileIds)) {
                $this->ids[$preset] = unserialize(file_get_contents($fileIds));
            }
        }
        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(
            array('file' => $file, 'seek' => $seek),
            function (
                $reader,
                $csv
            ) use (
                &$i,
                &$out,
                &$ids,
                &$self,
                $fields,
                $stepLimit,
                $isDebug,
                $subDelimeter,
                $key,
                $ignoreFirstLine,
                $preset
            ) {
                $i++;
                $out['rows']++;
                $self->modx->error->reset();
                if ($ignoreFirstLine && $i == 1) return true;
                $data = array();
                $options = array();
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));
                foreach ($fields as $k => $v) {
                    if ($v != $key) {
                        $v = str_replace('msoc:', '', $v);
                        $options[$v] = trim($csv[$k]);
                    } else {
                        $data[$v] = trim($csv[$k]);
                    }
                }
                // Set default values
                if (empty($data['class_key'])) {
                    $data['class_key'] = 'msProduct';
                }
                if (empty($data['context_key'])) {
                    $data['context_key'] = $self->ctx;
                }

                // Duplicate check
                $q = $self->modx->newQuery($data['class_key']);
                $q->select($data['class_key'] . '.id');
                $isProduct = false;
                if (strtolower($data['class_key']) == 'msproduct') {
                    $q->innerJoin('msProductData', 'Data', $data['class_key'] . '.id = Data.id');
                    $isProduct = true;
                }
                $tmp = $self->modx->getFields($data['class_key']);
                if (isset($tmp[$key])) {
                    $q->where(array('context_key:=' => $data['context_key'], $key => $data[$key]));
                } elseif ($isProduct) {
                    $q->where(array('context_key:=' => $data['context_key'], 'Data.' . $key => $data[$key]));
                }
                $q->prepare();
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.check_duplicate') . "\n" . $q->toSql());

                /** @var modResource $exists */
                if (!$exists = $self->modx->getObject($data['class_key'], $q)) {
                    $self->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] not find product by key:' . $key);
                    $out['errors']++;
                    return true;
                }
                if ($self->saveProductColor($options, $exists->id, $preset)) {
                    $out['update']++;
                } else {
                    $out['errors']++;
                }
                unset($exists);
                unset($res);
                unset($data);
                unset($options);

                if ($isDebug) {
                    $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                    return false;
                }

                $seek = $reader->getSeek();
                if ($i >= $stepLimit || $seek < 0) {
                    return false;
                } else {
                    return true;
                }
            }
        );

        if (!empty($this->ids[$preset])) {
            file_put_contents($fileIds, serialize($this->ids[$preset]));
        }

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportOptionsColor', array(
                'data' => empty($this->ids[$preset]) ? array() : $this->ids[$preset],
                'msie' => &$this,
                'preset' => $preset,
            ));
            $this->clearUploadDir();
        }

        $out['seek'] = $seek;
        return $out;
    }

    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importSalePrice($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );

        $fileIds = self::getTempDir() . $preset . '_ids.txt';
        $file = $this->config['uploadPath'] . $filename;
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $delimeter = $this->modx->getOption('msimportexport.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, $delimeter);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);

        if (empty($seek)) {
            if (file_exists($fileIds)) unlink($fileIds);
            $this->ids[$preset] = array();
            $res = $this->invokeEvent('msieOnStartImportSalePrice', array(
                'file' => $file,
                'preset' => $preset,
                'msie' => &$this,
            ));
        } else {
            $this->ids[$preset] = array();
            if (file_exists($fileIds)) {
                $this->ids[$preset] = unserialize(file_get_contents($fileIds));
            }
        }
        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(
            array('file' => $file, 'seek' => $seek),
            function (
                $reader,
                $csv
            ) use (
                &$i,
                &$out,
                &$ids,
                &$self,
                $fields,
                $stepLimit,
                $isDebug,
                $subDelimeter,
                $key,
                $ignoreFirstLine,
                $preset
            ) {
                $i++;
                $out['rows']++;
                $self->modx->error->reset();
                if ($ignoreFirstLine && $i == 1) return true;
                $data = array();
                $options = array();
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));
                foreach ($fields as $k => $v) {
                    if ($v != $key) {
                        $v = str_replace('mssp:', '', $v);
                        $options[$v] = trim($csv[$k]);
                    } else {
                        $data[$v] = trim($csv[$k]);
                    }
                }
                // Set default values
                if (empty($data['class_key'])) {
                    $data['class_key'] = 'msProduct';
                }
                if (empty($data['context_key'])) {
                    $data['context_key'] = $self->ctx;
                }

                // Duplicate check
                $q = $self->modx->newQuery($data['class_key']);
                $q->select($data['class_key'] . '.id');
                $isProduct = false;
                if (strtolower($data['class_key']) == 'msproduct') {
                    $q->innerJoin('msProductData', 'Data', $data['class_key'] . '.id = Data.id');
                    $isProduct = true;
                }
                $tmp = $self->modx->getFields($data['class_key']);
                if (isset($tmp[$key])) {
                    $q->where(array('context_key:=' => $data['context_key'], $key => $data[$key]));
                } elseif ($isProduct) {
                    $q->where(array('context_key:=' => $data['context_key'], 'Data.' . $key => $data[$key]));
                }
                $q->prepare();
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.check_duplicate') . "\n" . $q->toSql());

                /** @var modResource $exists */
                if (!$exists = $self->modx->getObject($data['class_key'], $q)) {
                    $self->modx->log(modX::LOG_LEVEL_ERROR, '[msImportExport] not find product by key:' . $key);
                    $out['errors']++;
                    return true;
                }
                if ($self->saveSalePrice($options, $exists->id, $preset)) {
                    $out['update']++;
                } else {
                    $out['errors']++;
                }

                unset($exists);
                unset($res);
                unset($data);
                unset($options);

                if ($isDebug) {
                    $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                    return false;
                }

                $seek = $reader->getSeek();
                if ($i >= $stepLimit || $seek < 0) {
                    return false;
                } else {
                    return true;
                }
            }
        );

        if (!empty($this->ids[$preset])) {
            file_put_contents($fileIds, serialize($this->ids[$preset]));
        }

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportSalePrice', array(
                'data' => empty($this->ids[$preset]) ? array() : $this->ids[$preset],
                'msie' => &$this,
                'preset' => $preset,
            ));
            $this->clearUploadDir();
        }

        $out['seek'] = $seek;
        return $out;
    }

    /**
     * @param string $filename
     * @param int $preset
     * @param int $seek
     * @param string $key
     * @return array
     */
    private function importProducts($filename = '', $preset, $seek = 0, $key = '')
    {
        $out = array(
            'errors' => 0,
            'create' => 0,
            'update' => 0,
            'seek' => 0,
            'rows' => 0,
        );
        $vendorIds = array();
        $tvEnabled = false;
        $fileIds = self::getTempDir() . $preset . '_ids.txt';
        $fileOpIds = self::getTempDir() . $preset . '_opids.txt';
        $file = $this->config['uploadPath'] . $filename;
        $stepLimit = (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50);
        $delimeter = $this->modx->getOption('msimportexport.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, $delimeter);
        $key = $key ? $key : $this->getPresetKey($preset, $this->modx->getOption('msimportexport.key', null, 'article'));
        $idParentNewProduct = $this->modx->getOption('msimportexport.import.id_parent_new_product', null, 0);
        $isDebug = filter_var($this->modx->getOption('msimportexport.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $isSkipEmptyParent = filter_var($this->modx->getOption('msimportexport.skip_empty_parent', null, 1), FILTER_VALIDATE_BOOLEAN);
        $isCreateParent = filter_var($this->modx->getOption('msimportexport.create_parent', null, 1), FILTER_VALIDATE_BOOLEAN);
        $ignoreFirstLine = filter_var($this->modx->getOption('msimportexport.ignore_first_line', null, false), FILTER_VALIDATE_BOOLEAN);
        $checkPageTitle = filter_var($this->modx->getOption('msimportexport.import.check_page_title', null, false), FILTER_VALIDATE_BOOLEAN);
        $formatFields = array_map('trim', explode(',', $this->modx->getOption('msimportexport.import.text_format_fields', '', false)));
        $isOptionsPrice = $this->hasPlugin('msoptionsprice');
        $galleryClassName = $this->getGalleryClassName();
        $this->addPackageSeoPro();
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        if (!$fields = $this->getPresetFields($preset)) {
            $out['errors']++;
            return $out;
        }

        if (!$reader = $this->getReader($file)) {
            $out['errors']++;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->modx->lexicon('msimportexport.err.reader'));
            return $out;
        }

        foreach ($fields as $v) {
            if (preg_match('/^tv(\d+)$/', $v)) {
                $tvEnabled = true;
                break;
            }
        }

        $i = 0;
        $ignoreFirstLine = $ignoreFirstLine && empty($seek);

        if (empty($seek)) {
            if (file_exists($fileIds)) unlink($fileIds);
            if (file_exists($fileOpIds)) unlink($fileOpIds);
            $this->ids[$preset . '_op'] = array();
            $this->productIds = array();
            $res = $this->invokeEvent('msieOnStartImportProduct', array(
                'file' => $file,
                'isOptionsPrice' => $isOptionsPrice,
                'preset' => $preset,
                'msie' => &$this,
            ));
        } else {
            $this->ids[$preset . '_op'] = array();
            if (file_exists($fileOpIds)) {
                $this->ids[$preset . '_op'] = unserialize(file_get_contents($fileOpIds));
            }
            if (file_exists($fileIds)) {
                $this->productIds = unserialize(file_get_contents($fileIds));
            }
        }
        $self = $this;
        $reader->setCacheKey('import_' . $preset . microtime(true));

        $reader->read(
            array('file' => $file, 'seek' => $seek),
            function (
                $reader,
                $csv
            ) use (
                &$i,
                &$out,
                &$self,
                $fields,
                $preset,
                $stepLimit,
                $isDebug,
                $idParentNewProduct,
                $vendorIds,
                $subDelimeter,
                $tvEnabled,
                $key,
                $isSkipEmptyParent,
                $isCreateParent,
                $isOptionsPrice,
                $ignoreFirstLine,
                $checkPageTitle,
                $fileIds,
                $galleryClassName,
                $formatFields
            ) {
                $i++;
                $out['rows']++;
                $self->modx->error->reset();

                if ($ignoreFirstLine && $i == 1) {
                    return true;
                }

                $data = array();
                $gallery = array();
                $optionsPrice = array();
                $parentOwn = '';
                $continue = false;
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.raw_data') . "\n" . print_r($csv, 1));

                $res = $self->invokeEvent('msieOnBeforePrepareImportProduct', array(
                    'data' => $csv,
                    'fields' => $fields,
                    'preset' => $preset,
                    'isOptionsPrice' => $isOptionsPrice,
                    'msie' => &$self,
                ));

                $csv = $res['data']['data'];
                $fields = $res['data']['fields'];

                foreach ($fields as $k => $v) {
                    if ($isOptionsPrice && substr($v, 0, 5) == 'msop:') {
                        $keyName = str_replace('msop:', '', $v);
                        $v = trim($csv[$k]);
                        $optionsPrice[$keyName] = $v;
                        continue;
                    }
                    if ($v == 'gallery') {
                        $val = array_map('trim', explode($subDelimeter, $csv[$k]));
                        $gallery = array_merge($gallery, $val);
                    } elseif ($v == 'vendor') {
                        if ($vendorId = $csv[$k]) {
                            if (!is_numeric($csv[$k])) {
                                if (empty($vendorIds[$csv[$k]])) {
                                    if ($vendorId = $self->getVendorIdByName($csv[$k])) {
                                        $vendorIds[$csv[$k]] = $vendorId;
                                    } else {
                                        $vendorId = $self->addVendor($csv[$k]);
                                    }
                                } else {
                                    $vendorId = $vendorIds[$csv[$k]];
                                }
                            }
                            if ($vendorId) {
                                $data[$v] = $vendorId;
                            }
                        }
                    } elseif ($v == 'parent') {
                        $parentOwn = trim($csv[$k]);
                        if (!is_numeric($csv[$k])) {
                            if ($parent = $self->prepareParentProduct($csv[$k])) {
                                $data[$v] = $parent;
                            } else {
                                // $data[$v] = $self->getRootCategoryId();
                                //$self->modx->log(modX::LOG_LEVEL_ERROR, $self->parseString($self->modx->lexicon('msimportexport.err.find_parent'), array('pagetitle' => $csv[$k], 'parent' => $data[$v], 'index' => $out['rows'])));
                            }
                        } else {
                            $data[$v] = trim($csv[$k]);
                        }
                    } else if ($self->isKeyArrayType($v)) {
                        if (!isset($data[$v])) {
                            $data[$v] = array();
                        }
                        $val = array_map('trim', explode($subDelimeter, $csv[$k]));
                        $data[$v] = array_merge($data[$v], $val);
                    } else {
                        if (!empty($formatFields) && in_array($v, $formatFields)) {
                            $data[$v] = $self->formatText($csv[$k]);
                        } else {
                            $data[$v] = trim($csv[$k]);
                        }
                    }
                }
                //--------------------------------------------------------------
                $isProduct = false;
                if ($continue) return true;

                // Set default values
                if (empty($data['class_key'])) {
                    $data['class_key'] = 'msProduct';
                }

                //if (!isset($data['parent'])) $data['parent'] = 0;

                $parent = null;
                if (empty($data['context_key'])) {
                    $data['context_key'] = $self->ctx;
                }
                $data['tvs'] = $tvEnabled;

                // Duplicate check
                $q = $self->modx->newQuery($data['class_key']);
                $q->select($data['class_key'] . '.id');
                if (strtolower($data['class_key']) == 'msproduct') {
                    $q->innerJoin('msProductData', 'Data', $data['class_key'] . '.id = Data.id');
                    $isProduct = true;
                }
                $tmp = $self->modx->getFields($data['class_key']);
                if (array_key_exists($key, $tmp)) {
                    $q->where(array('class_key:=' => $data['class_key'], 'context_key:=' => $data['context_key'], $key => $data[$key]));
                } elseif ($isProduct) {
                    $q->where(array('class_key:=' => $data['class_key'], 'context_key:=' => $data['context_key'], 'Data.' . $key => $data[$key]));
                }
                $q->prepare();
                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.check_duplicate') . "\n" . $q->toSql());

                /** @var modResource $exists */
                if ($exists = $self->modx->getObject($data['class_key'], $q)) {
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.key_duplicate'), array('key1' => $key, 'key2' => $data[$key])));
                    $action = 'update';
                    if (!isset($data['pagetitle']) || empty($data['pagetitle'])) {
                        $data['pagetitle'] = $exists->get('pagetitle');
                    }
                    if (!isset($data['parent'])) {
                        $data['parent'] = $exists->get('parent');
                    }
                    if (!isset($data['alias'])) {
                        $data['alias'] = $exists->get('alias');
                    }
                    if (!isset($data['uri'])) {
                        $data['uri'] = $exists->get('uri');
                    }
                    $data['id'] = $exists->id;
                } else {
                    if (!isset($data['parent']) && !empty($idParentNewProduct)) {
                        $data['parent'] = $idParentNewProduct;
                    }
                    $action = 'create';
                }

                $self->modx->log(modX::LOG_LEVEL_INFO, $self->modx->lexicon('msimportexport.importing_data') . "\n" . print_r($data, 1));

                if (empty($data['parent']) && empty($parentOwn) && $action == 'create' && $isSkipEmptyParent) {
                    $out['errors']++;
                    $self->modx->log(modX::LOG_LEVEL_ERROR, $self->modx->lexicon('msimportexport.err_parent') . print_r($data, 1));
                    return true;
                } else if (empty($data['parent']) && !$isSkipEmptyParent) {
                    $data['parent'] = $self->getRootCategoryId($self->ctx);
                }

                if ($action == 'create' && empty($data['parent']) && !empty($parentOwn) && $isCreateParent && ($parent == null || !$self->hasParent($data['parent']))) {
                    if (!$data['parent'] = $self->createCategory($parentOwn)) {
                        $out['errors']++;
                        return true;
                    }
                }


                if ($checkPageTitle && isset($data['pagetitle'])) {
                    $id = $data['id'] ? $data['id'] : 0;
                    $parent = $data['parent'] ? $data['parent'] : 0;
                    if ($productId = $self->checkPageTitle($data['pagetitle'], $id, $parent)) {
                        $res = $self->invokeEvent('msieOnEqualPageTitleImportProduct', array(
                            'mode' => $action,
                            'productId' => $productId,
                            'srcData' => $csv,
                            'destData' => $data,
                            'optionsPriceData' => $optionsPrice,
                            'isOptionsPrice' => $isOptionsPrice,
                            'fields' => $fields,
                            'msie' => &$self,
                            'preset' => $preset,
                            'skip' => true,
                        ));

                        if (!$res['success']) {
                            $out['errors']++;
                            $self->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            return true;
                        }

                        if (empty($res['data']['skip'])) {
                            $data = $res['data']['destData'];
                            $optionsPrice = $res['data']['optionsPriceData'];
                        } else {
                            $out['errors']++;
                            $self->modx->log(modX::LOG_LEVEL_ERROR, sprintf($self->modx->lexicon('msimportexport.err_equal_page_title'), $data['pagetitle'], $productId));
                            return true;
                        }

                    }
                }
                $res = $self->invokeEvent('msieOnBeforeImportProduct', array(
                    'mode' => $action,
                    'srcData' => $csv,
                    'destData' => $data,
                    'optionsPriceData' => $optionsPrice,
                    'isOptionsPrice' => $isOptionsPrice,
                    'fields' => $fields,
                    'gallery' => $gallery,
                    'msie' => &$self,
                    'preset' => $preset,
                    'skip' => false,
                ));

                if (!$res['success']) {
                    $out['errors']++;
                    $self->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                    return true;
                }

                if (!empty($res['data']['skip'])) return true;


                $data = $res['data']['destData'];
                $optionsPrice = $res['data']['optionsPriceData'];


                if ($galleryClassName == 'msResourceFile' && $action == 'create') {
                    $mediaSource = isset($data['media_source']) ? $data['media_source'] : $self->modx->getOption('ms2gallery_source_default');
                    $data['properties'] = array('ms2gallery' => array('media_source' => $mediaSource));
                    $data['media_source'] = $mediaSource;
                }


                // Create or update resource
                /** @var modProcessorResponse $response */
                $response = $self->modx->runProcessor('resource/' . $action, $data, array(
                    'processors_path' => $self->config['processorsPath'] . 'mgr/',
                    'location' => '',
                ));
                if ($response->isError()) {
                    $out['errors']++;
                    $self->modx->log(modX::LOG_LEVEL_ERROR, $self->modx->lexicon('msimportexport.err_action') . " $action: \n" . print_r($data, 1) . "\n Message: " . $response->getMessage() . "\n " . print_r($response->getAllErrors(), 1));
                } else {
                    $out[$action]++;
                    $resource = $response->getObject();
                    $res = $self->invokeEvent('msieOnAfterImportProduct', array(
                        'mode' => $action,
                        'srcData' => $csv,
                        'destData' => $data,
                        'data' => $resource,
                        'optionsPriceData' => $optionsPrice,
                        'isOptionsPrice' => $isOptionsPrice,
                        'fields' => $fields,
                        'gallery' => $gallery,
                        'msie' => &$self,
                        'preset' => $preset,
                    ));


                    if (isset($data['categories']) && !empty($data['categories'])) {
                        $self->addProductToSubCategories($resource['id'], $data['categories'], $resource['parent']);
                    }

                    if (isset($data['seo_keywords'])) {
                        $this->addSeoKeywords($data['seo_keywords'], $resource['id']);
                    }

                    $self->modx->log(modX::LOG_LEVEL_INFO, "Successful $action: \n" . print_r($resource, 1));
                    // Process gallery images, if exists
                    if (!empty($gallery)) {
                        $self->modx->log(modX::LOG_LEVEL_INFO, "Importing images: \n" . print_r($gallery, 1));
                        $clearGallery = $self->modx->getOption('msimportexport.gallery.remove_before_import', null, 0, true);
                        foreach ($gallery as $vidx => $v) {
                            if ($clearGallery && empty($vidx) && !isset($self->productIds[$resource['id']])) {
                                $self->modx->log(modX::LOG_LEVEL_INFO, "Clear Gallery for resource ID:" . $resource['id']);
                                $self->clearImageGallery($resource['id']);
                            }
                            $self->addImageGallery(array('id' => $resource['id'], 'file' => $v), $preset);
                        }
                    }

                    $optionsPrice = $res['data']['optionsPriceData'];
                    $self->saveProductModification($optionsPrice, $resource['id'], $preset);

                    $self->productIds[$resource['id']] = $resource['id'];
                }
                unset($exists);
                unset($response);
                unset($res);
                unset($data);

                if ($isDebug) {
                    $timeEnd = number_format(microtime(true) - $self->modx->startTime, 7);
                    $self->modx->log(modX::LOG_LEVEL_INFO, $self->parseString($self->modx->lexicon('msimportexport.debug_mode'), array('time' => $timeEnd)));
                    return false;
                }

                $seek = $reader->getSeek();
                if ($i >= $stepLimit || $seek < 0) {
                    return false;
                } else {
                    return true;
                }
            }
        );

        if (!empty($this->productIds)) {
            file_put_contents($fileIds, serialize($this->productIds));
        }

        if (!empty($this->ids[$preset . '_op'])) {
            file_put_contents($fileOpIds, serialize($this->ids[$preset . '_op']));
        }

        $seek = $reader->getSeek();
        $reader->clearCache();

        if ($seek < 0) {
            $this->invokeEvent('msieOnCompleteImportProduct', array(
                'file' => $file,
                'data' => implode(',', $this->productIds),
                'isOptionsPrice' => $isOptionsPrice,
                'msie' => &$this,
                'preset' => $preset,
            ));
            $this->clearUploadDir();
        }

        $out['seek'] = $seek;
        unset($ids);
        unset($fields);
        unset($vendorIds);
        return $out;
    }


    /**
     * Shorthand for original modX::invokeEvent() method with some useful additions.
     *
     * @param $eventName
     * @param array $params
     * @param $glue
     *
     * @return array
     */
    public function invokeEvent($eventName, array $params = array(), $glue = '<br/>')
    {
        if (isset($this->modx->event->returnedValues)) {
            $this->modx->event->returnedValues = null;
        }

        $response = $this->modx->invokeEvent($eventName, $params);
        if (is_array($response) && count($response) > 1) {
            foreach ($response as $k => $v) {
                if (empty($v)) {
                    unset($response[$k]);
                }
            }
        }

        $message = is_array($response) ? implode($glue, $response) : trim((string)$response);
        if (isset($this->modx->event->returnedValues) && is_array($this->modx->event->returnedValues)) {
            $params = array_merge($params, $this->modx->event->returnedValues);
        }

        return array(
            'success' => empty($message),
            'message' => $message,
            'data' => $params,
        );
    }

    /**
     * @param bool $self
     * @return string
     */
    public static function getTempDir($self = false)
    {
        $selfTmp = MODX_ASSETS_PATH . 'components/msimportexport/tmp' . DIRECTORY_SEPARATOR;
        if ($self) {
            return $selfTmp;
        } elseif ($temp = ini_get('upload_tmp_dir')) {
            if (file_exists($temp)) return realpath($temp) . DIRECTORY_SEPARATOR;
        } elseif ($home = getenv('HOME')) {
            $tmp = $home . DIRECTORY_SEPARATOR . 'tmp' . DIRECTORY_SEPARATOR;
            if (is_dir($tmp) && self::perms($tmp) >= 771) {
                return $tmp;
            }
        }
        if (function_exists('sys_get_temp_dir')) {
            $tmp = sys_get_temp_dir();
        } elseif (!empty($selfTmp)) {
            return $selfTmp;
        } elseif (!empty($_SERVER['TMP'])) {
            $tmp = $_SERVER['TMP'];
        } elseif (!empty($_SERVER['TEMP'])) {
            $tmp = $_SERVER['TEMP'];
        } elseif (!empty($_SERVER['TMPDIR'])) {
            $tmp = $_SERVER['TMPDIR'];
        } else {
            $tmp = getcwd();
        }
        return $tmp . DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $filename
     * @return string
     */
    public function perms($filename)
    {
        return substr(decoct(fileperms($filename)), -3);
    }

    public static function writeTree($dirname, $options = array())
    {
        $written = false;
        if (!empty ($dirname)) {
            if (!is_array($options)) $options = is_scalar($options) && !is_bool($options) ? array('mode' => $options) : array();
            $mode = isset($options['mode']) ? $options['mode'] : 493;
            if (is_string($mode)) $mode = octdec($mode);
            $dirname = strtr(trim($dirname), '\\', '/');
            if ($dirname{strlen($dirname) - 1} == '/') $dirname = substr($dirname, 0, strlen($dirname) - 1);
            if (is_dir($dirname) || (is_writable(dirname($dirname)) && @mkdir($dirname, $mode))) {
                $written = true;
            } elseif (!self::writeTree(dirname($dirname), $options)) {
                $written = false;
            } else {
                $written = @ mkdir($dirname, $mode);
            }
            if ($written && !is_writable($dirname)) {
                @ chmod($dirname, $mode);
            }
        }
        return $written;
    }

    /**
     * @return array
     */
    public function getTVs()
    {
        $result = array();
        $q = $this->modx->newQuery('modTemplateVar');
        $q->select(array(
            'modTemplateVar.*',
        ));
        if ($q->prepare() && $q->stmt->execute()) {
            $result = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return $result;
    }

    /**
     * @param string $filename
     * @return bool
     */
    public static function isLockFile($filename)
    {
        $locked = false;
        $file = self::getTempDir() . 'locks' . DIRECTORY_SEPARATOR . $filename;
        if (!file_exists($file)) return $locked;
        $fp = fopen($file, 'w');
        if (!flock($fp, LOCK_EX | LOCK_NB)) {
            $locked = true;
        } else {
            flock($fp, LOCK_UN);
        }
        fclose($fp);
        return $locked;
    }

    /**
     * @param string $filename
     * @return bool
     * @throws Exception
     */
    public static function lockFile($filename)
    {
        $locked = false;
        $filename = $filename ? $filename : getmypid() . '.lock';
        $lockDir = self::getTempDir() . 'locks' . DIRECTORY_SEPARATOR;
        if (self::writeTree($lockDir)) {
            $file = $lockDir . $filename;
            if (file_exists($file))
                @unlink($file);
            if (!file_exists($file)) {
                $fp = fopen($file, 'w');
                fwrite($fp, getmypid());
                if (flock($fp, LOCK_EX | LOCK_NB)) {
                    register_shutdown_function(function () use ($fp, $file) {
                        flock($fp, LOCK_UN);
                        fclose($fp);
                        unlink($file);
                    });
                    $locked = true;
                }
            }
        } else {
            throw new Exception("The lock_dir at {$lockDir} is not writable and could not be created");
        }
        return $locked;
    }

    /**
     * @param string $filename
     * @return bool
     */
    public static function unLockFile($filename)
    {
        $file = self::getTempDir() . 'locks' . DIRECTORY_SEPARATOR . $filename;
        if (!file_exists($file)) return true;
        if ($fp = fopen($file, 'w')) {
            flock($fp, LOCK_UN);
            fclose($fp);
            unlink($file);
            return true;
        }
        return false;

    }

    /**
     * @param string $parent
     * @param bool $onlyRootCatalog
     * @param string $ctx
     * @return array|bool|int
     */
    public function prepareParentProduct($parent, $onlyRootCatalog = false, $ctx = '')
    {
        $ctx = $ctx ? $ctx : $this->ctx;
        $subDelimeter = $this->modx->getOption('msimportexport.import.sub_delimeter', null, '|');
        $parent = array_map('trim', explode($subDelimeter, $parent));
        if (count($parent) == 1) {
            if (empty($parent[0])) return 0;
            if ($parentId = $this->getProductIdByPageTitle($parent[0], $onlyRootCatalog, $ctx)) {
                return $parentId;
            } else {
                return $this->createCategory($parent[0], $this->getRootCategoryId($ctx), false, false, $ctx);
            }
        } else {
            return $this->createTreeCategories($parent, $ctx);
        }
    }

    /**
     * @param array $data
     * @param int $preset
     * @return bool
     */
    public function addImageGallery($data, $preset = 0)
    {

        if (!isset($data['file']) || empty($data['file'])) {
            return false;
        }

        $imageBasePath = $this->modx->getOption('msimportexport.import.image_base_path', null, MODX_BASE_PATH, true);

        if ($this->isUrl($data['file'])) {
            if (!$file = $this->downloadUrlToFile($data['file'])) {
                return false;
            }
        } else {
            $file = str_replace('//', '/', $imageBasePath . $data['file']);
        }
        if (empty($file) || !file_exists($file)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $this->parseString($this->modx->lexicon('msimportexport.err_import_image'), array('img' => $data['file'], 'file' => $file)));
            return false;
        }

        switch ($this->getGalleryClassName()) {
            case 'msProductFile':
                $processorsPath = $this->config['processorsPath'] . 'mgr/gallery/minishop2/';
                break;
            case 'msResourceFile':
                $processorsPath = $this->config['processorsPath'] . 'mgr/gallery/ms2gallery/';
                break;
        }

        $data['file'] = $file;

        if (!isset($data['id']) || empty($data['id'])) {
            $key = $this->modx->getOption('msimportexport.key', null, 'article', true);
            $val = isset($data[$key]) ? $data[$key] : null;
            if ($val) {
                $data['id'] = $this->getProductIdByKey($val, $key);
            }
        }

        if (!isset($data['id']) || empty($data['id'])) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error add image to Gallery, not found product id. Data: ' . print_r($data, 1));
            return false;
        }
        $this->modx->error->reset();


        $res = $this->invokeEvent('msieOnBeforeImportGalleryImage', array(
            'preset' => $preset,
            'skip' => false,
            'data' => $data,
            'msie' => &$this,
        ));

        if (!$res['success']) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
            return false;
        }

        if (!empty($res['data']['skip'])) {
            return true;
        }

        $response = $this->modx->runProcessor('upload',
            $data,
            array('processors_path' => $processorsPath)
        );
        $object = $response->getObject();
        $isNew = true;
        if ($response->isError()) {
            if (isset($object['code']) && $object['code'] == 304) {
                $isNew = false;
                $data['id'] = $object['file_id'];
                $data['file'] = $object['file'];
                $data['name'] = $object['name'];
            } else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, $this->parseString($this->modx->lexicon('msimportexport.err.gallery_upload'), array('v' => $file)) . ": \n" . print_r($response->getAllErrors(), 1));
                return false;
            }
        }
        $this->modx->log(modX::LOG_LEVEL_INFO, $this->parseString($this->modx->lexicon('msimportexport.success.gallery_upload'), array('v' => $file)) . ": \n" . print_r($object, 1));
        unset($data['url']);
        $data = array_diff($data, array(''));
        if (!$isNew && count($data) > 2) {
            $this->modx->error->reset();
            $response = $this->modx->runProcessor('update',
                $data,
                array('processors_path' => $processorsPath)
            );
            if ($response->isError()) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($response->getAllErrors(), 1));
            }
        }

        $this->invokeEvent('msieOnAfterImportGalleryImage', array(
            'preset' => $preset,
            'data' => $data,
            'isNew' => $isNew,
            'object' => &$object,
            'msie' => &$this,
        ));

        return true;
    }


    /**
     * @param int $resourceId
     * @param string $galleryClass
     */
    public function clearImageGallery($resourceId, $galleryClass = '')
    {
        $classKey = empty($galleryClass) ? $this->getGalleryClassName() : $galleryClass;

        switch ($classKey) {
            case 'msProductFile':
                $field = 'product_id';
                break;
            case 'msResourceFile':
                $field = 'resource_id';
                break;
        }

        $q = $this->modx->newQuery($classKey);
        $q->where(array($field => $resourceId));
        $q->select('id');
        $ids = array();

        if ($q->prepare() && $q->stmt->execute()) {
            $ids = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
        }

        foreach ($ids as $id) {
            if ($file = $this->modx->getObject($classKey, $id)) {
                $file->remove();
            }
        }
    }

    /**
     * @param string $path
     * @return bool|string
     */
    public function loadImportFile($path)
    {
        if ($content = @file_get_contents($path)) {
            $name = 'import_cron_data.csv';
            $file = $this->config['uploadPath'] . $name;
            if (file_put_contents($file, $content)) {
                return $name;
            }
        }
        return false;
    }

    /**
     * @param string $url
     * @param string $path
     * @param bool $onlyName
     * @param bool $hashName
     * @return string
     */
    public function downloadUrlToFile($url, $path = '', $onlyName = false, $hashName = false)
    {
        if (empty($url)) return '';
        $path = $path ? $path : $this->config['uploadPath'];
        if ($file = $this->download($url, $path)) {
            return $onlyName ? basename($file) : $file;
        }
        return '';
    }

    /**
     * @param string $url
     * @param string $path
     * @return bool|string
     */
    public function download($url, $path = '')
    {
        $fp = null;
        $file = '';
        $self = $this;
        $headers = array();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
        //curl_setopt($ch, CURLOPT_REFERER, '');
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/69.0.3497.100 Safari/537.36',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
                'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,uk;q=0.6',
            )
        );
        curl_setopt($ch, CURLOPT_HEADERFUNCTION,
            function ($ch, $string) use (&$headers) {
                $len = strlen($string);
                $header = explode(':', $string, 2);
                if (count($header) < 2) return $len;
                $name = strtolower(trim($header[0]));
                $headers[$name] = trim($header[1]);
                return $len;
            });
        curl_setopt($ch, CURLOPT_WRITEFUNCTION,
            function ($ch, $string) use (&$self, &$fp, &$file, &$headers, $url, $path) {
                if ($fp === null) {
                    $basename = '';
                    if (isset($headers['content-disposition'])) {
                        $parts = explode(';', $headers['content-disposition']);
                        foreach ($parts AS $crumb) {
                            if (strstr($crumb, '=')) {
                                list($pname, $pval) = explode('=', $crumb);
                                $pname = trim($pname);
                                if (strcasecmp($pname, 'filename') == 0) {
                                    $basename = basename($self->unquote($pval));
                                }
                            }
                        }
                    }
                    if (empty($basename)) {
                        $info = pathinfo($url);
                        $ext = isset($info['extension']) ? $info['extension'] : '';
                        $filename = isset($info['filename']) ? $info['filename'] : uniqid('file_');
                        $contentType = strtolower(curl_getinfo($ch, CURLINFO_CONTENT_TYPE));
                        if ($contentType && $mimeTypes = $self->getMimeTypes()) {
                            $ext = isset($mimeTypes[$contentType]) ? $mimeTypes[$contentType] : $info['extension'];
                        }
                        $basename = $filename . '.' . $ext;
                    }
                    $file = $path . $basename;
                    if (!$fp = @fopen($file, 'wb')) {
                        throw new Exception("Can't open file: {$file} for writing");
                    }
                }
                $len = fwrite($fp, $string);
                return $len;
            });

        try {
            if (!$output = curl_exec($ch)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, "Error download. Url : {$url}. Message:\n" . curl_error($ch) . "\nError:\n" . curl_errno($ch));
            }
        } catch (Exception $e) {
            $file = '';
            $this->modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage());
        }
        if ($fp) fclose($fp);
        curl_close($ch);
        return $file ? $file : false;
    }

    /**
     * @return array
     */
    public function getMimeTypes()
    {
        $cacheKey = $this->getCacheKey('getMimeTypes');
        $url = 'http://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types';
        if (!$mimes = $this->modx->cacheManager->get($cacheKey)) {
            $mimes = array();
            foreach (@explode("\n", @file_get_contents($url)) as $x) {
                if (isset($x[0]) && $x[0] !== '#' && preg_match_all('#([^\s]+)#', $x, $out) && isset($out[1]) && ($c = count($out[1])) > 1) {
                    $mimes[$out[1][0]] = $out[1][1];
                    /*for ($i = 1; $i < $c; $i++) {
                        //$mimes[$out[1][$i]] = $out[1][0];

                    }*/
                }
            }
            $this->modx->cacheManager->set($cacheKey, $mimes, $this->config['cacheTime']);
        }
        return $mimes;
    }

    /**
     * @param string $str
     * @return mixed
     */
    public function unquote($str)
    {
        return str_replace(array("'", '"'), '', trim($str));
    }

    /**
     * @param array|string $options
     * @return string
     */
    public function getCacheKey($options)
    {
        return $this->namespace . DIRECTORY_SEPARATOR . sha1(is_array($options) ? serialize($options) : $options);
    }

    /**
     * @param $file
     * @param string $to
     * @param bool $encoding
     * @param bool $onlyName
     * @param bool $hashName
     * @return mixed|string
     */
    public function copyFile($file, $to = '', $encoding = true, $onlyName = true, $hashName = false)
    {
        $out = '';
        if ($this->isUrl($file)) {
            $out = $this->downloadUrlToFile($file, $to, false, $hashName);
        } else {
            $to = $to ? $to : $this->config['uploadPath'];
            $filename = $this->prepareFileName($file, $hashName);
            $newFile = $to . $filename;
            if (!copy($file, $newFile)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error copy file: ' . $file . ' to ' . $newFile);
            } else {
                $out = $newFile;
            }
        }
        if ($out && $encoding) {
            $this->cp1251ToUtf8($out);
        }
        return $onlyName ? pathinfo($out, PATHINFO_BASENAME) : $out;
    }

    /**
     * @param string $file
     */
    public function cp1251ToUtf8($file)
    {
        $encoding = trim($this->modx->getOption('msimportexport.import.csv_encoding', null, 'cp1251', true));
        $utf8Encode = filter_var($this->modx->getOption('msimportexport.import.utf8_encode', null, 0), FILTER_VALIDATE_BOOLEAN);
        $ext = mb_strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if ($ext == 'csv' && !empty($utf8Encode)) {
            $content = file_get_contents($file);
            if (empty($encoding)) {
                $encoding = mb_detect_encoding($content, array('cp1251', 'utf-8', 'ASCII'));
            }
            if (strtolower($encoding) != 'utf-8') {
                file_put_contents($file, iconv(strtolower($encoding), 'utf-8', $content));
                // file_put_contents($file, mb_convert_encoding($content, 'utf-8', strtolower($encoding)));
            }
            /*$encoding = Encoding::toUTF8($content);
            file_put_contents($file, $encoding);*/
        }
    }


    /**
     * @return string
     */
    public function findPathPhpInterpreter()
    {
        if ($this->checkFunctionEnabled('exec')) {
            return exec('which php');
        } else {
            return PHP_BINDIR . DIRECTORY_SEPARATOR . 'php';
        }
    }

    /**
     * @param string $name
     * @return bool
     */
    public function checkFunctionEnabled($name)
    {
        $f = array_map('trim', explode(', ', ini_get('disable_functions')));
        if (
            function_exists($name) &&
            !in_array($name, $f) &&
            !in_array(strtolower(ini_get('safe_mode')), array('on', '1'), true)
        ) {
            return true;
        }
        return false;
    }

    /**
     * @param string $filename
     * @param int $preset
     * @param string $type products|pemains
     * @param int $seek
     * @param string $key
     * @return array
     */
    public function import($filename = '', $preset, $type = 'products', $seek = 0, $key = '')
    {
        $this->modx->cacheManager->refresh(array('system_settings' => array()));
        switch ($type) {
            case 'pemains':
                $out = $this->importRemain($filename, $preset, $seek, $key);
                break;
            case 'options_price2':
                $out = $this->importOptionsPrice2($filename, $preset, $seek, $key);
                break;
            case 'options_color':
                $out = $this->importOptionsColor($filename, $preset, $seek, $key);
                break;
            case 'sale_price':
                $out = $this->importSalePrice($filename, $preset, $seek, $key);
                break;
            case 'links':
                $out = $this->importLinks($filename, $preset, $seek, $key);
                break;
            case 'gallery':
                $out = $this->importGallery($filename, $preset, $seek, $key);
                break;
            case 'categories':
                $out = $this->importCategories($filename, $preset, $seek, $key);
                break;
            case 'update_products':
                $out = $this->updateProducts($filename, $preset, $seek, $key);
                break;
            default:
                $out = $this->importProducts($filename, $preset, $seek, $key);
        }
        return $out;
    }

    /**
     * @param string $file
     * @param bool $hashName
     * @return string
     */
    public function prepareFileName($file, $hashName = false)
    {
        $name = preg_replace('/\?.*/', '', pathinfo($file, PATHINFO_BASENAME));
        $name = str_replace(' ', '_', $name);
        $name = $hashName ? md5($name) . '.' . pathinfo($name, PATHINFO_EXTENSION) : $name;
        return mb_strtolower($name);
    }

    /**
     * @param $str
     * @return int
     */
    public function isUrl($str)
    {
        return preg_match('/^http|https:\/\//', $str);
    }

    /**
     * @param string $key
     * @param array $data
     * @return int|string
     */
    public function prepareValue($key, $data)
    {

        if (isset($data[$key . 'type'])) {
            switch ($data[$key . 'type']) {
                case 'combobox';
                case 'combo-multiple';
                case 'combo-options';
                    return $data[$key . 'value'];
                    break;
                case 'combo-boolean';
                    $v = $data[$key . 'value'];
                    if ($v == 'Yes' || $v = 'Да') {
                        return 1;
                    } else if ($v == 'No' || $v = 'Нет') {
                        return 0;
                    }
                    return $v;
                    break;
                case 'checkbox';
                    return filter_var($data[$key . 'value'], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
                    break;
            }
        } else {
            return $data[$key];
        }
    }


    /**
     * @param MsieWriter $writer
     * @param array $data
     * @return bool|null
     */
    public function exportRow(MsieWriter &$writer, array $data)
    {
        $data['msie'] = &$this;
        $data['writer'] = &$writer;
        $res = $this->invokeEvent('msieOnBeforeExport', $data);
        if (!$res['success']) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
            return false;
        }
        if (!empty($res['data']['skip']) || empty($res['data']['destData'])) {
            return null;
        }

        $writer->write(
            $res['data']['destData'],
            $this->modx->getOption('options', $res['data'], array())
        );
        $this->invokeEvent('msieOnAfterExport', $res['data']);
        return true;

    }

    /**
     * @param string $to
     * @param int $preset
     * @param bool $save
     * @param string $type
     * @param string $path
     * @param string $filename
     * @param string $categories
     * @param array $options
     * @return bool
     */
    public function export($to = 'csv', $preset = 0, $save = false, $type = 'products', $path = '', $filename = '', $categories = '', $options = null)
    {

        if (!$writer = $this->getWriter($to)) return false;

        $writer->setCacheKey('export_' . $preset . microtime(true));
        $this->ctx = $this->modx->getOption('msimportexport.export.ctx', null, 'web', true);
        $isDebug = filter_var($this->modx->getOption('msimportexport.export.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $isHead = filter_var($this->modx->getOption('msimportexport.export.head', null, 0), FILTER_VALIDATE_BOOLEAN);
        $headStyle = $this->modx->fromJSON($this->modx->getOption('msimportexport.export.head_style', null, '[]', true));
        $isHeadСategory = filter_var($this->modx->getOption('msimportexport.export.head_category', null, 0), FILTER_VALIDATE_BOOLEAN);
        $isHeadRepeat = filter_var($this->modx->getOption('msimportexport.export.head_repeat', null, 1), FILTER_VALIDATE_BOOLEAN);
        $headСategoryStyle = $this->modx->fromJSON($this->modx->getOption('msimportexport.export.head_category_style', null, '[]', true));
        $isAddHost = filter_var($this->modx->getOption('msimportexport.export.add_host', null, 1), FILTER_VALIDATE_BOOLEAN);
        $delimeter = $this->modx->getOption('msimportexport.export.delimeter', null, ';');
        $subDelimeter = $this->modx->getOption('msimportexport.export.sub_delimeter', null, $delimeter);
        $isConvertDate = filter_var($this->modx->getOption('msimportexport.export.convert_date', null, 0), FILTER_VALIDATE_BOOLEAN);
        $formatDate = $this->modx->getOption('msimportexport.export.format_date', null, '%m/%d/%Y %T');

        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));

        $dateFields = $this->getDateFields();

        $fields = ($options && isset($options['fields'])) ? explode(',', $options['fields']) : array();

        if (empty($fields)) {
            if (!$fields = $this->getPresetFields($preset)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error export, not set preset ID');
                return '';
            } else {
                $this->modx->log(modX::LOG_LEVEL_INFO, sprintf($this->modx->lexicon('msimportexport.preset_use'), $preset));
            }
        }

        $fields = array_map('trim', $fields);

        $data = array();
        $data['limit'] = $this->modx->getOption('msimportexport.export.limit', null, 0);
        $data['depth'] = $this->modx->getOption('msimportexport.export.depth', null, 10);
        $data['offset'] = 0;
        $data['parents'] = !empty($categories) ? $categories : $this->getPresetCategories($preset, $this->modx->getOption('msimportexport.export.parents', null, ''));
        $data['where'] = $this->getPresetWhere($preset, $this->modx->getOption('msimportexport.export.where', null, ''));
        $data['leftJoin'] = $this->getPresetLeftJoin($preset);
        $data['innerJoin'] = $this->getPresetInnerJoin($preset);
        $data['select'] = $this->getPresetSelect($preset);
        $data['fields'] = $fields;
        $data['isCategories'] = array_search('categories', $fields) !== false ? true : false;
        $data['isGallery'] = in_array('gallery', $fields);
        $data['isSeoPro'] = in_array('seo_keywords', $fields);

        $optionKeys = array('where', 'leftJoin', 'innerJoin', 'limit', 'resources');
        foreach ($optionKeys as $option) {
            if (isset($options[$option]) && !empty($options[$option])) {
                $data[$option] = $options[$option];
            }
        }

        $data['isDebug'] = $isDebug;
        if (in_array($type, array('options_price2', 'options_color', 'pemains'))) {
            $clearHeadField = true;
        }

        $res = $this->invokeEvent('msieOnBeforeExportQuery', array(
            'type' => $type,
            'preset' => $preset,
            'data' => &$data,
            'fields' => &$fields,
            'msie' => &$this,
        ));

        $fields = $res['data']['fields'];
        $data = $res['data']['data'];

        $headFields = $this->prepareHeadFields($fields, $clearHeadField);
        if ($isHead && $fields && !$isHeadСategory || $isHead && !$isHeadRepeat) {
            $this->exportRow($writer, array(
                'type' => $type,
                'section' => 'fields',
                'preset' => $preset,
                'srcData' => array(),
                'destData' => $headFields,
                'fields' => $fields,
                'skip' => false,
                'options' => array('style' => $headStyle)
            ));
        }

        switch ($type) {
            case 'products':
                $this->addPackageSeoPro();
                $categoryId = 0;
                if ($isHeadСategory) $data['includeParentTitle'] = true;
                $thumbSettings = $this->modx->getOption('msimportexport.export_thumb_settings', null, '[]');
                $thumbSettings = $this->modx->fromJSON($thumbSettings);
                if (!empty($thumbSettings['thumb'])) {
                    $data['includeThumbs'] = $thumbSettings['thumb'];
                }
                while ($products = $this->getProducts($data)) {
                    foreach ($products as $product) {
                        $row = array();
                        if ($isHead && $isHeadСategory && $categoryId != $product['parent']) {
                            $categoryId = $product['parent'];
                            $this->exportRow($writer, array(
                                'type' => $type,
                                'section' => 'category',
                                'preset' => $preset,
                                'srcData' => $product,
                                'destData' => array(
                                    $product['category.pagetitle']
                                ),
                                'fields' => $fields,
                                'skip' => false,
                                'options' => array(
                                    'mergeCells' => array('columnIndex1' => 1),
                                    'style' => $headСategoryStyle)
                            ));
                            if ($isHeadRepeat) {
                                $this->exportRow($writer, array(
                                    'type' => $type,
                                    'section' => 'fields',
                                    'preset' => $preset,
                                    'srcData' => array(),
                                    'destData' => $headFields,
                                    'fields' => $fields,
                                    'skip' => false,
                                    'options' => array('style' => $headStyle)
                                ));
                            }
                        }
                        foreach ($fields as $idx => $v) {
                            if ($v == 'put_thumb') {
                                $row[] = null;
                                $file = '';
                                $drawingSettings = $thumbSettings;
                                if (!empty($thumbSettings['thumb']) && isset($product[$thumbSettings['thumb']]) && !empty($product[$thumbSettings['thumb']])) {
                                    $drawingSettings = array();
                                    $file = $this->sanitizePath(MODX_BASE_PATH . $product[$thumbSettings['thumb']]);
                                } else if (!empty($product['image'])) {
                                    $file = $this->sanitizePath(MODX_BASE_PATH . $product['image']);
                                }
                                if (file_exists($file)) {
                                    $writer->drawing($file, $idx + 1, $writer->getSeek(), $drawingSettings);
                                }
                            } else if ($v == 'parents') {
                                $row[] = $this->getTrackTitleByParent($product['parent']);
                            } else if ($v == 'href') {
                                $row[] = MODX_URL_SCHEME . MODX_HTTP_HOST . '/' . $product['uri'];
                            } else if (isset($product[$v])) {
                                if (is_array($product[$v])) {
                                    $row[] = implode($subDelimeter, array_diff($product[$v], array('')));
                                } else {
                                    if ($isConvertDate && isset($dateFields[$v])) {
                                        $product[$v] = strftime($formatDate, $product[$v]);
                                    }
                                    if ($isAddHost && $this->isImageField($product[$v]) && !$this->isUrl($product[$v])) {
                                        $product[$v] = $this->siteUrl . $product[$v];
                                    }
                                    $row[] = $product[$v];
                                }
                            } else {
                                $row[] = '';
                            }
                        }

                        $this->exportRow($writer, array(
                            'type' => $type,
                            'section' => 'data',
                            'preset' => $preset,
                            'srcData' => $product,
                            'destData' => $row,
                            'fields' => $fields,
                            'skip' => false,
                            'options' => array()
                        ));
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) break;
                }
                break;
            case 'links':
                while ($links = $this->getLinks($data)) {
                    foreach ($links as $link) {
                        $row = array();
                        foreach ($fields as $v) {
                            if (isset($link[$v])) {
                                $row[] = $link[$v];
                            } else {
                                $row[] = '';
                            }
                        }
                        $res = $this->invokeEvent('msieOnBeforeExport', array(
                            'type' => $type,
                            'preset' => $preset,
                            'srcData' => $link,
                            'destData' => $row,
                            'fields' => $fields,
                            'skip' => false,
                            'msie' => &$this,
                        ));

                        if (!$res['success']) {
                            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            continue;
                        }

                        if (empty($res['data']['skip'])) {
                            $row = $res['data']['destData'];
                        } else {
                            continue;
                        }
                        if (!empty($row)) {
                            $writer->write($row);
                        }
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) {
                        $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($row, 1));
                        break;
                    }
                }
                break;
            case 'gallery':
                $isCopyImage = $this->modx->getOption('msimportexport.gallery.copy_image', null, 0, true);
                $imagePath = $this->getExportGalleryImageDir();
                if ($this->modx->getOption('msimportexport.gallery.clear_dir', null, 1, true)) {
                    $this->modx->cacheManager->deleteTree($imagePath, array('deleteTop' => false, 'skipDirs' => false, 'extensions' => false));
                }
                if ($isCopyImage && empty($imagePath)) {
                    $isCopyImage = false;
                }

                while ($images = $this->getGalleryData($data)) {
                    foreach ($images as $image) {
                        $row = array();
                        $galleryDir = $this->getGalleryDirBySource($image['source']);
                        foreach ($fields as $v) {
                            if (isset($image[$v])) {
                                if ($v == 'url') {
                                    $row[] = $isAddHost ? $this->siteUrl . $image[$v] : $image[$v];
                                } else if ($isCopyImage && $v == 'file') {
                                    $row[] = $image['path'] . $image[$v];
                                } else {
                                    $row[] = $image[$v];
                                }
                            } else {
                                $row[] = '';
                            }
                        }
                        if ($isCopyImage) {
                            $tmpPath = $imagePath . $image['path'];
                            $ok = true;
                            if (!file_exists($tmpPath)) {
                                if (!$this->modx->cacheManager->writeTree($tmpPath)) {
                                    $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error could not create directory: ' . $tmpPath);
                                    $ok = false;
                                }
                            }
                            if ($ok) {
                                $image['path'] = $image['path'] . $image['file'];
                                $source = $galleryDir . $image['path'];
                                $dest = $imagePath . $image['path'];
                                if (!copy($source, $dest)) {
                                    $this->modx->log(modX::LOG_LEVEL_ERROR, ' Error copy image from ' . $source . ' to ' . $dest);
                                }
                            }
                        }
                        $res = $this->invokeEvent('msieOnBeforeExport', array(
                            'type' => $type,
                            'preset' => $preset,
                            'srcData' => $image,
                            'destData' => $row,
                            'fields' => $fields,
                            'skip' => false,
                            'msie' => &$this,
                        ));

                        if (!$res['success']) {
                            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            continue;
                        }

                        if (empty($res['data']['skip'])) {
                            $row = $res['data']['destData'];
                        } else {
                            continue;
                        }
                        if (!empty($row)) {
                            $writer->write($row);
                        }
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) {
                        $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($row, 1));
                        break;
                    }
                }
                if (!empty($imagePath) && $this->modx->getOption('msimportexport.gallery.zip', null, 0, true)) {
                    $dest = $imagePath . pathinfo($imagePath, PATHINFO_FILENAME) . '.zip';
                    $this->zip($imagePath, $dest);
                }
                break;
            case 'categories':
                $data['fields'] = $fields;
                while ($categories = $this->getTreeCategories($data)) {
                    foreach ($categories as $category) {
                        $row = array();
                        foreach ($fields as $v) {
                            if (isset($category[$v])) {
                                $row[] = $category[$v];
                            } else if ($v == 'parents') {
                                $row[] = $this->getTrackTitleByParent($category['parent']);
                            } else {
                                $row[] = '';
                            }
                        }

                        $res = $this->invokeEvent('msieOnBeforeExport', array(
                            'type' => $type,
                            'preset' => $preset,
                            'srcData' => null,
                            'destData' => $row,
                            'fields' => null,
                            'skip' => false,
                            'msie' => &$this,
                        ));

                        if (!$res['success']) {
                            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            continue;
                        }

                        if (empty($res['data']['skip'])) {
                            $row = $res['data']['destData'];
                        } else {
                            continue;
                        }
                        if (!empty($row)) {
                            $writer->write($row);
                        }
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) {
                        $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($row, 1));
                        break;
                    }
                }
                break;
            case 'options_price2':
                $processOptions = false;
                $prefixOption = 'msopo_';
                while ($products = $this->getOptionsPrice2($data)) {
                    foreach ($products as $product) {
                        $options = $this->modx->call('msopModificationOption', 'getOptions', array(&$this->modx, $product['msopm_id'], $product['msopm_rid'], null, $processOptions));
                        $row = array();
                        foreach ($fields as $v) {
                            $val = '';
                            $key = $this->clearPrefixKey($v, array('msopm_', 'msopo_'));
                            if ($v == 'msopm_image_path') {
                                if (!empty($product[$v])) {
                                    $galleryDir = $this->getGalleryDirBySource($product['msopm_image_source']);
                                    $val = $galleryDir . $product[$v];
                                }
                            } else if (isset($product[$v])) {
                                $val = $product[$v];
                            } else if (substr($v, 0, 6) == $prefixOption) {
                                if (isset($options[$key])) {
                                    $val = $options[$key];
                                } else {
                                    $val = '';
                                }
                            }

                            if (is_array($val)) {
                                $row[] = implode($subDelimeter, array_diff($val, array('')));
                            } else {
                                if ($isConvertDate && isset($dateFields[$key])) {
                                    $val = strftime($formatDate, $val);
                                } else if ($isAddHost && $this->isImageField($val) && $v != 'msopm_image_path') {
                                    $val = $this->siteUrl . $val;
                                }
                                $row[] = $val;
                            }
                        }

                        $res = $this->invokeEvent('msieOnBeforeExport', array(
                            'type' => $type,
                            'preset' => $preset,
                            'srcData' => $product,
                            'srcOptionsData' => $options,
                            'destData' => $row,
                            'fields' => $fields,
                            'skip' => false,
                            'msie' => &$this,
                        ));

                        if (!$res['success']) {
                            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            continue;
                        }

                        if (empty($res['data']['skip'])) {
                            $row = $res['data']['destData'];
                        } else {
                            continue;
                        }

                        if (!empty($row)) {
                            $writer->write($row);
                        }
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) break;
                }
                break;
            case 'options_color':
                while ($products = $this->getOptionsColor($data)) {
                    foreach ($products as $product) {
                        $row = array();
                        foreach ($fields as $v) {
                            $val = '';
                            $key = $this->clearPrefixKey($v, array('msoc_'));
                            if (isset($product[$v])) {
                                $val = $product[$v];
                            }
                            if (is_array($val)) {
                                $row[] = implode($subDelimeter, array_diff($val, array('')));
                            } else {
                                if ($isConvertDate && isset($dateFields[$key])) {
                                    $val = strftime($formatDate, $val);
                                } else if ($isAddHost && $this->isImageField($val)) {
                                    $val = $this->siteUrl . $val;
                                }
                                $row[] = $val;
                            }
                        }
                        $res = $this->invokeEvent('msieOnBeforeExport', array(
                            'type' => $type,
                            'preset' => $preset,
                            'srcData' => $product,
                            'srcOptionsData' => $options,
                            'destData' => $row,
                            'fields' => $fields,
                            'skip' => false,
                            'msie' => &$this,
                        ));
                        if (!$res['success']) {
                            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            continue;
                        }
                        if (empty($res['data']['skip'])) {
                            $row = $res['data']['destData'];
                        } else {
                            continue;
                        }

                        if (!empty($row)) {
                            $writer->write($row);
                        }
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) break;
                }
                break;
            case 'sale_price':
                while ($products = $this->getSalePrice($data)) {
                    foreach ($products as $product) {
                        $row = array();
                        foreach ($fields as $v) {
                            $val = '';
                            $key = $this->clearPrefixKey($v, array('mssp_'));
                            if (isset($product[$v])) {
                                $val = $product[$v];
                            }
                            if (is_array($val)) {
                                $row[] = implode($subDelimeter, array_diff($val, array('')));
                            } else {
                                if ($isConvertDate && isset($dateFields[$key])) {
                                    $val = strftime($formatDate, $val);
                                } else if ($isAddHost && $this->isImageField($val)) {
                                    $val = $this->siteUrl . $val;
                                }
                                $row[] = $val;
                            }
                        }
                        $res = $this->invokeEvent('msieOnBeforeExport', array(
                            'type' => $type,
                            'preset' => $preset,
                            'srcData' => $product,
                            'srcOptionsData' => $options,
                            'destData' => $row,
                            'fields' => $fields,
                            'skip' => false,
                            'msie' => &$this,
                        ));
                        if (!$res['success']) {
                            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            continue;
                        }
                        if (empty($res['data']['skip'])) {
                            $row = $res['data']['destData'];
                        } else {
                            continue;
                        }

                        if (!empty($row)) {
                            $writer->write($row);
                        }
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) break;
                }
                break;
            case 'pemains':
                while ($products = $this->getProductRemains($data)) {
                    foreach ($products as $product) {
                        $row = array();
                        foreach ($fields as $v) {
                            $val = '';
                            $key = $this->clearPrefixKey($v, array('mspr_'));
                            if (isset($product[$v])) {
                                $val = $product[$v];
                            }
                            if (is_array($val)) {
                                $row[] = implode($subDelimeter, array_diff($val, array('')));
                            } else {
                                if ($isConvertDate && isset($dateFields[$key])) {
                                    $val = strftime($formatDate, $val);
                                } else if ($isAddHost && $this->isImageField($val)) {
                                    $val = $this->siteUrl . $val;
                                }
                                $row[] = $val;
                            }
                        }
                        $res = $this->invokeEvent('msieOnBeforeExport', array(
                            'type' => $type,
                            'preset' => $preset,
                            'srcData' => $product,
                            'srcOptionsData' => $options,
                            'destData' => $row,
                            'fields' => $fields,
                            'skip' => false,
                            'msie' => &$this,
                        ));
                        if (!$res['success']) {
                            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
                            continue;
                        }
                        if (empty($res['data']['skip'])) {
                            $row = $res['data']['destData'];
                        } else {
                            continue;
                        }

                        if (!empty($row)) {
                            $writer->write($row);
                        }
                    }
                    $data['offset'] = $data['offset'] + $data['limit'];
                    if ($isDebug) break;
                }
                break;
        }
        $filename = $filename ? $filename : 'export_' . date('d_m_Y_H_i_s');
        $filename .= '.' . $to;
        $path = !empty($path) ? $path : $this->config['exportPath'];

        $ok = $writer->save($filename, $save ? $path : '');
        $writer->clearCache();

        $this->invokeEvent('msieOnCompleteExport', array(
            'to' => $to,
            'preset' => $preset,
            'type' => $type,
            'file' => $save ? $path . $filename : '',
            'msie' => &$this,
        ));

        return $ok;
    }


    /**
     * @param bool $save
     * @param int $preset
     * @param string $path
     * @param string $filename
     * @param string $categories
     * @return string
     */
    public function exportToYmarket($save = false, $preset = 0, $path = '', $filename = '', $categories = '')
    {

        $this->ctx = $this->modx->getOption('msimportexport.export.ctx', null, 'web', true);
        $isDebug = filter_var($this->modx->getOption('msimportexport.export.debug', null, 0), FILTER_VALIDATE_BOOLEAN);
        $this->modx->setLogLevel($isDebug ? modX::LOG_LEVEL_INFO : modX::LOG_LEVEL_ERROR);
        $this->modx->log(modX::LOG_LEVEL_INFO, 'max_execution_time:' . ini_get('max_execution_time'));
        $this->modx->log(modX::LOG_LEVEL_INFO, 'memory_limit:' . ini_get('memory_limit'));
        $data = array();
        $data['limit'] = $this->modx->getOption('msimportexport.export.limit', null, 0);
        $data['offset'] = 0;
        $data['depth'] = $this->modx->getOption('msimportexport.export.depth', null, 10);
        $data['parents'] = !empty($categories) ? $categories : $this->getPresetCategories($preset, $this->modx->getOption('msimportexport.export.parents', null, ''));
        $data['where'] = $this->modx->getOption('msimportexport.export.where', null, '');
        $data['isDebug'] = $isDebug;
        $data['isCategories'] = false;


        $res = $this->invokeEvent('msieOnBeforeExportQuery', array(
            'to' => 'xml',
            'type' => 'products',
            'data' => &$data,
            'msie' => &$this,
        ));

        $data = $res['data']['data'];

        $ym = new YandexMarket($this, $data);
        $xml = $ym->getYml();
        $path = !empty($path) ? $path : $this->config['exportPath'];
        $filename = $filename ? $filename : 'export_' . date('d_m_Y_H_i_s');
        $filename .= '.xml';
        if ($save) {
            $fp = fopen($path . $filename, 'w');
            fwrite($fp, $xml);
            fclose($fp);
            $xml = '';
        } else {
            header('Content-Type: application/xml');
        }

        $this->invokeEvent('msieOnCompleteExport', array(
            'to' => 'xml',
            'type' => 'products',
            'file' => $save ? $path . $filename : '',
            'msie' => &$this,
        ));

        return $xml;
    }


    public function cron($str)
    {
        $cron = Cron\CronExpression::factory($str);
        if ($cron->isDue()) {
            return 'cron is now due.';

        } else {
            return 'cron is not due.';
        }
        //return  $cron->getNextRunDate()->format('Y-m-d H:i:s');

    }


    /**
     * @param array $ids
     */
    public function removeСategoryFromPresets($ids = array())
    {
        if (!$categories = $this->modx->getCollection('MsiePresetsFields', array('categories:!=' => ''))) return;
        foreach ($categories as $category) {
            $parents = array_map('trim', explode(',', $category->get('categories')));
            $parents = implode(',', array_diff($parents, $ids));
            $category->set('categories', $parents);
            $category->save();
        }
    }

    /**
     * @param string $text
     * @param string $method
     * @return string
     */
    public function formatText($text, $method = '')
    {
        if (empty($text)) return '';
        $method = $method ? $method : $this->modx->getOption('msimportexport.import.text_format_method');
        switch ($method) {
            case 'nl2br';
                $text = nl2br($text);
                break;
            case 'wrap';
                if ($arr = preg_split('/\r\n|\r|\n/', $text)) {
                    $text = '';
                    foreach ($arr as $val) {
                        $val = trim($val);
                        if (empty($val)) continue;
                        $text .= "<p>{$val}</p>";
                    }
                }
                break;
        }
        return $text;
    }

    /***
     * @param string $name
     * @return array
     */
    public function strOption2Arr($name)
    {
        $data = array();
        if ($name) {
            $paramsFields = array_map('trim', explode(',', $this->modx->getOption($name, null, '')));
            if (!empty($paramsFields)) {
                foreach ($paramsFields as $v) {
                    $arr = explode('=', $v);
                    $data[$arr[0]] = $arr[1];
                }
            }
        }
        return $data;
    }

    /***
     * @param array $data
     * @return string
     */
    public function arrOption2Str($data)
    {
        $str = '';
        if ($data && is_array($data)) {
            //  $data = array_diff($data, array(''));
            foreach ($data as $k => $v) {
                if (!empty($k)) {
                    $str .= $str ? ',' : '';
                    $str .= trim($k) . '=' . trim($v);
                }
            }
        }
        return $str;
    }

    /**
     * Sanitize the specified path
     *
     * @param string $path The path to clean
     * @return string The sanitized path
     */
    public function sanitizePath($path)
    {
        return preg_replace(array("/\.*[\/|\\\]/i", "/[\/|\\\]+/i"), array(DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR), $path);
    }

    /**
     * @return bool
     */
    public function clearUploadDir()
    {
        return $this->modx->cacheManager->deleteTree($this->config['uploadPath'], array('deleteTop' => false, 'skipDirs' => false, 'extensions' => array()));
    }

    /**
     * @param $value
     * @return bool
     */
    public function isDate($value)
    {
        $ts = false;
        if (!empty($value)) {
            $ts = strtotime($value);
        }
        if ($ts === false || empty($value)) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function getDateFields()
    {
        $out = array();
        if ($meta = array_merge($this->modx->getFieldMeta('msProductData'), $this->modx->getFieldMeta('modResource'))) {
            foreach ($meta as $key => $v) {
                if (($v['dbtype'] == 'int' || $v['dbtype'] == 'integer') && ($v['phptype'] == 'timestamp' || $v['phptype'] == 'datetime' || $v['phptype'] == 'date')) {
                    $out[$key] = $key;
                }
            }
        }
        return $out;
    }


    public function isImageField($val)
    {
        return preg_match('/^\/[\w\-\.\?\/+@&#;`~=%!]+(?:jpg|jpeg|png|gif)$/', trim($val));
    }

    /**
     * @param string $path
     * @return string
     */
    public function preparePath($path)
    {
        $path = str_replace(array(
            '{assets_path}',
            '{assets_url}',
            '{base_path}',
            '{core_path}',
            '{+core_path}',
            '{+assets_path}',
            '{+assets_url}',
        ), array(
            $this->modx->getOption('assets_path', null, MODX_ASSETS_PATH),
            $this->modx->getOption('assets_url', null, MODX_ASSETS_URL),
            $this->modx->getOption('base_path', null, MODX_BASE_PATH),
            $this->modx->getOption('core_path', null, MODX_CORE_PATH),
            $this->config['corePath'],
            $this->config['assetsPath'],
            $this->config['assetsUrl'],
        ), $path);

        return $path;
    }

    public function getArrayFirstKey(array $arr)
    {
        $keys = array_keys($arr);
        return empty($keys) ? null : $keys[0];
    }

    protected function checkStat()
    {
        $key = strtolower(__CLASS__);
        /** @var modDbRegister $registry */
        $registry = $this->modx->getService('registry', 'registry.modRegistry')
            ->getRegister('user', 'registry.modDbRegister');
        $registry->connect();
        $registry->subscribe('/modstore/' . md5($key));
        if ($res = $registry->read(array('poll_limit' => 1, 'remove_read' => false))) {
            return;
        }
        $c = $this->modx->newQuery('transport.modTransportProvider', array('service_url:LIKE' => '%modstore%'));
        $c->select('username,api_key');
        /** @var modRest $rest */
        $rest = $this->modx->getService('modRest', 'rest.modRest', '', array(
            'baseUrl' => 'https://modstore.pro/extras',
            'suppressSuffix' => true,
            'timeout' => 1,
            'connectTimeout' => 1,
        ));
        if ($rest) {
            $level = $this->modx->getLogLevel();
            $this->modx->setLogLevel(modX::LOG_LEVEL_FATAL);
            $rest->post('stat', array(
                'package' => $key,
                'version' => $this::version,
                'keys' => $c->prepare() && $c->stmt->execute()
                    ? $c->stmt->fetchAll(PDO::FETCH_ASSOC)
                    : array(),
                'uuid' => $this->modx->uuid,
                'database' => $this->modx->config['dbtype'],
                'revolution_version' => $this->modx->version['code_name'] . '-' . $this->modx->version['full_version'],
                'supports' => $this->modx->version['code_name'] . '-' . $this->modx->version['full_version'],
                'http_host' => $this->modx->getOption('http_host'),
                'php_version' => XPDO_PHP_VERSION,
                'language' => $this->modx->getOption('manager_language'),
            ));
            $this->modx->setLogLevel($level);
        }
        $registry->subscribe('/modstore/');
        $registry->send('/modstore/', array(md5($key) => true), array('ttl' => 3600 * 24));
    }

}