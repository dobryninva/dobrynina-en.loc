<?php

use Cache\Bridge\SimpleCache\SimpleCacheBridge;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

interface MsieReaderInterface
{

    public function read(array $provider, $callback = null);

    public function clearCache();

}

abstract class MsieReader implements MsieReaderInterface
{
    /** @var modX $modx */
    public $modx;
    /** @var int $seek */
    protected $seek = 0;
    /** @var int $totalRows */
    protected $totalRows = null;
    /** @var array $provider */
    protected $provider = array();
    /** @var SimpleCacheBridge $cacheAdapter */
    public $cacheAdapter = null;
    public $config = array();

    /**
     * MsieReader constructor.
     * @param $modx
     * @param array $config
     */
    public function __construct(& $modx, $config = array())
    {
        $this->modx = &$modx;
        $this->config = array_merge(array(
            'cacheKey' => '',
        ), $config);
    }

    /**
     * @param int $seek
     */
    public function setSeek($seek)
    {
        $this->seek = $seek;
    }

    /**
     * @return int
     */
    public function getTotalRows()
    {
        return $this->totalRows;
    }

    /**
     * @return int
     */
    public function getSeek()
    {
        return $this->seek;
    }

    /**
     * @return SimpleCacheBridge|null
     */
    public function getCacheAdapter()
    {
        if (!$this->cacheAdapter) {
            $cacheAdapterName = $this->modx->getOption('msimportexport.cache_adapter', null, '');
            switch ($cacheAdapterName) {
                case 'APCu':
                    if (extension_loaded('apcu')) {
                        $this->cacheAdapter = new SimpleCacheBridge(new ApcuAdapter($this->config['cacheKey']));
                    } else {
                        $this->modx->log(modX::LOG_LEVEL_ERROR, 'APCu extension not installed!');
                    }
                    break;
                case 'Filesystem':
                    $this->cacheAdapter = new SimpleCacheBridge(new FilesystemAdapter($this->config['cacheKey']));
                    break;
            }
        }
        return $this->cacheAdapter;
    }

    /**
     * @param string $key
     */
    public function setCacheKey($key = '')
    {
        $this->config['cacheKey'] = $key;
    }

    /**
     * @return bool
     */
    public function clearCache()
    {
        if ($this->cacheAdapter) {
            return $this->cacheAdapter->clear();
        }
    }

}

