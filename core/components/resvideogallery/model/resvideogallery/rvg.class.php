<?php

require_once MODX_CORE_PATH . 'components/resvideogallery/vendor/autoload.php';

/**
 * MODx Rvg Class
 *
 * @package resvideogallery
 */
class Rvg
{
    const version = '2.0.3';
    /** @var RvgController $controller */
    public $controller;
    private $useUploadTempDirectory = false;
    private $providers = array();
    /** @var pdoFetch $pdoTools */
    public $pdoTools = null;
    /** @var array $initialized */
    public $initialized = array();
    /** @var string */
    protected $namespace = 'resvideogallery';

    /**
     * Creates an instance of the Rvg class.
     *
     * @param modX &$modx A reference to the modX instance.
     * @param array $config An array of configuration parameters.
     * @return Rvg
     */
    function __construct(modX &$modx, array $config = array())
    {
        $this->modx =& $modx;
        $this->modx->lexicon->load('resvideogallery:default');
        $corePath = $modx->getOption('resvideogallery.core_path', $config, $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/resvideogallery/');
        $assetsUrl = $modx->getOption('resvideogallery.assets_url', $config, $modx->getOption('assets_url') . 'components/resvideogallery/');
        $assetsPath = $modx->getOption('resvideogallery.assets_path', $config, $modx->getOption('assets_path', null, MODX_ASSETS_PATH) . 'components/resvideogallery/');
        $this->config = array_merge(array(
            'chunksPath' => $corePath . 'elements/chunks/',
            'controllersPath' => $corePath . 'controllers/',
            'corePath' => $corePath,
            'assetsPath' => $assetsPath,
            'assetsUrl' => $assetsUrl,
            'modelPath' => $corePath . 'model/',
            'cachePath' => $assetsPath . 'cache/',
            'processorsPath' => $corePath . 'processors/',
            'providersPath' => $corePath . 'model/resvideogallery/providers/',
            'jsUrl' => $assetsUrl . 'js/',
            'cssUrl' => $assetsUrl . 'css/',
            'templatesPath' => $corePath . 'elements/templates/',
            'connectorUrl' => $assetsUrl . 'connector.php',
            'themePath' => $assetsPath . 'theme/',
            'themeUrl' => $assetsUrl . 'theme/',
            'actionUrl' => $assetsUrl . 'action.php',
            'embedUrl' => $assetsUrl . 'embed.php',
            'managerUrl' => $this->modx->config['manager_url'],
            'pageSize' => $this->modx->getOption('resvideogallery.page_size', null, 20),
            'date_format' => $this->modx->getOption('resvideogallery.date_format', null, '%d.%m.%Y %H:%M'),
            'modelPathMs2g' => MODX_CORE_PATH . 'components/ms2gallery/model/',
            'oauth2callback' => MODX_URL_SCHEME . MODX_HTTP_HOST . $assetsUrl . 'oauth2callback.php',
        ), $config);

        $this->config['thumbsPath'] = $this->preparePath($this->modx->getOption('resvideogallery.thumbs_path', null, '{assets_path}resvideogallery/'));
        $this->config['thumbsUrl'] = $this->preparePath($this->modx->getOption('resvideogallery.thumbs_url', null, '{assets_url}resvideogallery/'));

        $this->modx->addPackage('resvideogallery', $this->config['modelPath']);

        if (file_exists($this->config['modelPathMs2g']))
            $this->modx->addPackage('ms2gallery', $this->config['modelPathMs2g']);

        // $this->checkStat();

    }


    /**
     * @param array $config
     * @return object|pdoFetch|null
     */
    public function getPdoTools($config = array())
    {
        if (!$this->pdoTools) {
            $fqn = $this->modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
            $path = $this->modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
            if ($pdoClass = $this->modx->loadClass($fqn, $path, false, true)) {
                $this->pdoTools = new $pdoClass($this->modx, $config);
            } else {
                $this->pdoTools = $this->modx->getService('pdoFetch');
            }
            $this->pdoTools = $this->modx->getService('pdoFetch');
        }
        return $this->pdoTools;
    }


    /**
     * Load the appropriate controller
     * @param string $controller
     * @return null|RvgController
     */
    public function loadController($controller)
    {
        if ($this->modx->loadClass('RvgController', $this->config['modelPath'] . 'resvideogallery/', true, true)) {
            $classPath = $this->config['controllersPath'] . 'web/' . mb_strtolower($controller) . '.php';
            $className = 'ResVideoGallery' . $controller . 'Controller';
            if (file_exists($classPath)) {
                if (!class_exists($className)) {
                    $className = require_once $classPath;
                }
                if (class_exists($className)) {
                    $this->controller = new $className($this, $this->config);
                } else {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Could not load controller: ' . $className . ' at ' . $classPath);
                }
            } else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Could not load controller file: ' . $classPath);
            }
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Could not load RvgController class.');
        }
        return $this->controller;
    }


    /**
     * Loads the Validator class.
     *
     * @access public
     * @param string $type The name to give the service on the rvg object
     * @param array $config An array of configuration parameters for the
     * RvgValidator class
     * @return RvgValidator An instance of the RvgValidator class.
     */
    public function loadValidator($type = 'validator', $config = array())
    {
        if (!$this->modx->loadClass('RvgValidator', $this->config['modelPath'], true, true)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Could not load Validator class.');
            return false;
        }
        $this->$type = new RvgValidator($this, $config);
        return $this->$type;
    }

    /**
     * Sanitize the specified path
     *
     * @param string $path The path to clean
     * @return string The sanitized path
     */
    public function normalizePath($path)
    {
        $path = str_replace('./', '/', $path);
        return preg_replace(array("/\.*[\/|\\\]/i", "/[\/|\\\]+/i"), array(DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR), $path);
    }

    /**
     * @param modManagerController $controller
     * @param modResource $resource
     */
    public function loadVideoManagerFiles(modManagerController $controller, modResource $resource)
    {
        $modx23 = (int)$this->systemVersion();
        $jsUrl = $this->config['jsUrl'] . 'mgr/';
        $cssUrl = $this->config['cssUrl'] . 'mgr/';

        $controller->addLexiconTopic('resvideogallery:default');
        $controller->addJavascript($jsUrl . 'rvg.js');
        $controller->addLastJavascript($jsUrl . 'utils/rvg.utils.js');
        $controller->addLastJavascript($jsUrl . 'utils/ext.ddview.js');
        $controller->addLastJavascript($jsUrl . 'widgets/rvg.combo.js');
        $controller->addLastJavascript($jsUrl . 'widgets/rvg.view.js');
        $controller->addLastJavascript($jsUrl . 'widgets/rvg.window.js');
        $controller->addLastJavascript($jsUrl . 'widgets/rvg.toolbar.js');
        $controller->addLastJavascript($jsUrl . 'widgets/rvg.panel.js');

        $controller->addCss($cssUrl . 'main.css');
        if (!$modx23) {
            $controller->addCss($cssUrl . 'font-awesome.min.css');
        }

        $controller->addHtml('
		<script type="text/javascript">
			MODx.modx23 = ' . $modx23 . ';
			Rvg.config = ' . $this->modx->toJSON($this->config) . ';
		</script>');

        $insertTab = '
				tabs.add({
					xtype: "resvideogallery-page",
					id: "resvideogallery-page",
					title: _("resvideogallery"),
					record: {
						id: ' . $resource->get('id') . '
					}
				});
			';
        $controller->addHtml('
				<script type="text/javascript">
					Ext.ComponentMgr.onAvailable("modx-resource-tabs", function() {
						var tabs = this;
						tabs.on("beforerender", function() {
							' . $insertTab . '
						});
					});
				</script>');
    }

    /**
     * Accurate sorting of resource videos
     *
     * @param $resource_id
     */
    public function rankResourceVideos($resource_id)
    {
        if (!$this->modx->getOption('resvideogallery.exact_sorting', null, true, true)) {
            return;
        }

        $q = $this->modx->newQuery('RvgVideos', array('resource_id' => $resource_id));
        $q->select('id');
        $q->sortby('rank ASC, createdon', 'ASC');

        if ($q->prepare() && $q->stmt->execute()) {
            $sql = '';
            $table = $this->modx->getTableName('RvgVideos');
            if ($ids = $q->stmt->fetchAll(PDO::FETCH_COLUMN)) {
                foreach ($ids as $k => $id) {
                    $sql .= "UPDATE {$table} SET `rank` = '{$k}' WHERE (`id` = {$id});";
                }
            }
            $sql .= "ALTER TABLE {$table} ORDER BY `rank` ASC;";
            $this->modx->exec($sql);
        }
    }

    /**
     * Compares MODX version
     *
     * @param string $version
     * @param string $dir
     *
     * @return bool
     */
    public function systemVersion($version = '2.3.0', $dir = '>=')
    {
        $this->modx->getVersionData();

        return !empty($this->modx->version) && version_compare($this->modx->version['full_version'], $version, $dir);
    }

    /**
     * @return null|string
     */
    public function getSysTempDir()
    {
        if ($this->useUploadTempDirectory) {
            //  use upload-directory when defined to allow running on environments having very restricted
            //      open_basedir configs
            if (ini_get('upload_tmp_dir') !== FALSE) {
                if ($temp = ini_get('upload_tmp_dir')) {
                    if (file_exists($temp))
                        return realpath($temp);
                }
            }
        }

        // sys_get_temp_dir is only available since PHP 5.2.1
        // http://php.net/manual/en/function.sys-get-temp-dir.php#94119
        if (!function_exists('sys_get_temp_dir')) {
            if ($temp = getenv('TMP')) {
                if ((!empty($temp)) && (file_exists($temp))) {
                    return realpath($temp);
                }
            }
            if ($temp = getenv('TEMP')) {
                if ((!empty($temp)) && (file_exists($temp))) {
                    return realpath($temp);
                }
            }
            if ($temp = getenv('TMPDIR')) {
                if ((!empty($temp)) && (file_exists($temp))) {
                    return realpath($temp);
                }
            }

            // trick for creating a file in system's temporary dir
            // without knowing the path of the system's temporary dir
            $temp = tempnam(__FILE__, '');
            if (file_exists($temp)) {
                unlink($temp);
                return realpath(dirname($temp));
            }

            return null;
        }
        // use ordinary built-in PHP function
        //	There should be no problem with the 5.2.4 Suhosin realpath() bug, because this line should only
        //		be called if we're running 5.2.1 or earlier
        return realpath(sys_get_temp_dir());
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

    /**
     * @param string $theme
     * @param string $postfix
     */
    public function regHheme($theme, $postfix = '.min')
    {
        if (!empty($theme)) {
            if (file_exists($this->config['themePath'] . $theme . '/js/main' . $postfix . '.js')) {
                $this->modx->regClientScript($this->config['themeUrl'] . $theme . '/js/main' . $postfix . '.js');
            }
            if (file_exists($this->config['themePath'] . $theme . '/css/main' . $postfix . '.css')) {
                $this->modx->regClientCSS($this->config['themeUrl'] . $theme . '/css/main' . $postfix . '.css');
            }
        }
    }


    /**
     * @param string $url
     * @param bool $clearCache
     * @param string $path
     * @return bool|string
     */
    public function loadImageFromUrl($url, $clearCache = true, $path = '')
    {
        if (!is_writable($this->config['cachePath'])) {
            if (!$this->modx->cacheManager->writeTree($this->config['cachePath'])) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, 'Cache dir not writable: ' . $this->config['cachePath']);
                return '';
            }
        }
        $path = empty($path) ? $this->config['cachePath'] : $path;
        if ($clearCache) $this->clearCache($path);
        $ext = pathinfo($url, PATHINFO_EXTENSION);
        $filename = $path . md5($url . microtime(true)) . '.' . $ext;
        if ($image = file_get_contents($url)) {
            if (file_put_contents($filename, $image)) {
                return $filename;
            }
        }
        return false;
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
     * @return RvgProvider[]
     */
    public function getProviders()
    {
        if (empty($this->providers)) {
            $this->loadProviders();
        }
        return $this->providers;
    }

    /**
     * @param string $name
     * @return RvgProvider|null
     */

    public function getProviderByName($name)
    {
        if (empty($this->providers)) {
            $this->loadProviders();
        }
        if (empty($this->providers)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Could not load roviders');
        }
        if (isset($this->providers[$name]) && !empty($this->providers[$name])) {
            return $this->providers[$name];
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Could not find provider by name: ' . $name);
        }
        return null;
    }

    /**
     * @param bool $onlyAllowCheckBlocked
     * @return array
     */
    public function getProvidersName($onlyAllowCheckBlocked = true)
    {
        $names = array();
        if ($providers = $this->getProviders()) {
            foreach ($providers as $provider) {
                if ($onlyAllowCheckBlocked) {
                    if ($provider->hasAllowCheckBlocked()) {
                        $names[] = $provider->getName();
                    }
                } else {
                    $names[] = $provider->getName();
                }
            }
        }
        return $names;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function scrapeVideo($url)
    {
        if ($provider = $this->getProviderBy($url)) {
            return $provider->scrape();
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Could not find a single providers');
        }
        return false;
    }

    /**
     * @param string $url
     * @return RvgProvider|null
     */
    public function getProviderBy($url)
    {
        if ($providers = $this->getProviders()) {
            foreach ($providers as $provider) {
                if ($provider->checkUrl($url)) {
                    return $provider;
                }
            }
        } else {
            return null;
        }
    }

    /**
     * @param int $duration
     * @return string
     */
    public function prepareDuration($duration)
    {
        if (gmdate('G', $duration)) {
            return gmdate("H:i:s", $duration);
        } else {
            return gmdate("i:s", $duration);
        }
    }

    /**
     * @return string
     */
    public function getBasePath()
    {
        return $this->config['thumbsPath'];
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->config['thumbsUrl'];
    }


    /**
     * @param array $video
     * @param bool $autoPlay
     * @param string $w
     * @param string $h
     * @return string
     */
    public function getEmbedCode($video, $autoPlay = true, $w = '100%', $h = '100%')
    {
        if ($provider = $this->getProviderByName($video['provider'])) {
            return $provider->getEmbedCode($video, $autoPlay, $w, $h);
        }
        return '';
    }

    /**
     * @param int $id
     * @param array $options
     * @return string
     */
    public function getEmbedCodeById($id, array $options = array())
    {

        if ($video = $this->modx->getObject('RvgVideos', $id)) {
            $autoPlay = $this->modx->getOption('autoPlay', $options, true);
            $width = $this->modx->getOption('width', $options, '100%');
            $height = $this->modx->getOption('height', $options, '100%');
            return $this->getEmbedCode($video->toArray(), $autoPlay, $width, $height);
        }
        return '';
    }

    /**
     * @return string
     */
    public function getEmbedUrl()
    {
        return $this->config['embedUrl'];
    }


    /**
     * @param xPDOQuery $q
     * @param array $activeTags
     * @return array
     */
    public function executeQueryTags(xPDOQuery $q, $activeTags = array())
    {
        $result = array();
        if ($q->prepare() && $q->stmt->execute()) {
            while ($item = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                if (empty($item['tag'])) continue;
                if (in_array($item['tag'], $activeTags)) {
                    $item['active'] = 1;
                } else {
                    $item['active'] = 0;
                }
                $result[$item['tag']] = $item;
            }
        }
        return $result;
    }

    /**
     * @param bool $isPhotoGallery
     * @return null|xPDOQuery
     */
    public function getQueryTags($isPhotoGallery = false)
    {
        if ($isPhotoGallery) {
            $q = $this->modx->newQuery('msResourceFile');
            $q->innerJoin('msResourceFileTag', 'Tag', 'msResourceFile.id = Tag.file_id');
            $q->select(array(
                'Tag.tag, Tag.file_id as media_id , msResourceFile.resource_id'
            ));
        } else {
            $q = $this->modx->newQuery('RvgVideos');
            $q->innerJoin('RvgVideosTags', 'Tag', 'RvgVideos.id = Tag.video_id');
            $q->select(array(
                'Tag.tag, Tag.video_id as media_id , RvgVideos.resource_id'
            ));
        }
        return $q;
    }

    /**
     * @param int $id
     * @param array $data
     * @param bool $isPhotoGallery
     * @return array
     */
    public function getTagsById($id = 0, $data = array(), $isPhotoGallery = false)
    {
        $result = array();
        if (empty($data['photoGalleryTagClass'])) return $result;
        if ($q = $this->getQueryTags($isPhotoGallery)) {
            $q->where(array('id:=' => $id));
            if ($q->prepare() && $q->stmt->execute()) {
                while ($item = $q->stmt->fetch(PDO::FETCH_ASSOC)) {
                    $item['active'] = (empty($data['activeTags']) || !in_array($item['tag'], $data['activeTags'])) ? 0 : 1;
                    $result[] = $item;
                }
            }
        }
        return $result;
    }

    /**
     * @param xPDOQuery|null $query
     * @param array $data
     * @param bool $isPhotoGallery
     * @return string
     */
    public function renderQuery(xPDOQuery $query = null, $data = array(), $isPhotoGallery = false)
    {
        $result = '';
        if ($query) {
            if ($query->prepare() && $query->stmt->execute()) {
                foreach ($query->stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                    if ($isPhotoGallery) {
                        $properties = $this->modx->fromJSON($row['properties']);
                        $row['isVideo'] = 0;
                        $row['title'] = $row['alt'];
                        $row['width'] = $properties['width'];
                        $row['height'] = $properties['height'];
                        $row['thumb'] = $row['url'];
                        $row['url'] = isset($row['basic_url']) ? $row['basic_url'] : $row['url'];
                        $row['key'] = $data['key'];
                    } else {
                        $row['isVideo'] = 1;
                        $row['key'] = $data['key'];
                        $row['thumb'] = $this->getBaseUrl() . $row['thumb'];
                        $row['embed'] = $this->getEmbedCode($row, $data['autoPlay']);
                        $row['width'] = $data['width'];
                        $row['height'] = $data['height'];
                        $row['duration'] = $this->prepareDuration($row['duration']);
                    }
                    $row['tags'] = array();
                    if ($data['getTags']) {
                        $id = empty($row['parent']) ? $row['id'] : $row['parent'];
                        $row['tags'] = $this->getTagsById($id, $data, $isPhotoGallery);
                    }
                    $result .= $this->pdoTools->getChunk($data['tplRow'], $row);
                }
            }
        }
        return $result;
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
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $key
     * @param string $value
     * @param string $namespace
     * @param bool $clearCache
     * @return bool
     */
    public function setOption($key, $value, $namespace = '', $clearCache = false)
    {
        if (empty(trim($key))) return false;

        $namespace = $namespace ? $namespace : $this->getNamespace();
        $key = $namespace . '.' . $key;

        if (!$setting = $this->modx->getObject('modSystemSetting', $key)) {
            $setting = $this->modx->newObject('modSystemSetting');
            $setting->set('namespace', $namespace);
        }

        $val = is_array($value) ? $this->modx->toJSON($value) : $value;
        $setting->set('value', $val);

        if ($setting->save()) {
            $this->modx->setOption($key, $value);
            if ($clearCache) {
                $this->modx->cacheManager->refresh(array('system_settings' => array()));
            }
            return true;
        }
        return false;
    }

    /**
     * @param string $path
     */
    private function clearCache($path = '')
    {
        $path = empty($path) ? $this->config['cachePath'] : $path;
        if (file_exists($path)) {
            $files = glob($path . '*');
            if (!empty($files)) {
                foreach ($files as $file) {
                    unlink($file);
                }
            }
        }
    }

    private function loadProviders()
    {
        if (empty($this->providers)) {
            foreach (glob($this->config['providersPath'] . '*.class.php') as $classPath) {
                if (!file_exists($classPath)) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] not find file provider : ' . $classPath);
                    continue;
                }
                try {
                    $explode = explode('/', $classPath);
                    $className = preg_replace(array('/rvg/', '/provider.class.php/'), '', $explode[(count($explode) - 1)]);
                    $className = 'Rvg' . ucfirst($className) . 'Provider';

                    if (!class_exists($className)) {
                        $className = require_once $classPath;
                    }

                    $provider = new $className($this);
                    $this->providers[$provider->getName()] = $provider;
                } catch (Exception $e) {
                    $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] ' . $e->getMessage());
                }
            }
        }
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