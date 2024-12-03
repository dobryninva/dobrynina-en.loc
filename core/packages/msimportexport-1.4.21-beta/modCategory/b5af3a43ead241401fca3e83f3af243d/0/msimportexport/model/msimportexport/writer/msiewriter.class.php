<?php

use Cache\Bridge\SimpleCache\SimpleCacheBridge;
use Symfony\Component\Cache\Adapter\ApcuAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

interface MsieWriterInterface
{

    public function write(array $data, array $options);

}

abstract class MsieWriter implements MsieWriterInterface
{
    public $config = array();
    /** @var modX $modx */
    public $modx;
    /** @var SimpleCacheBridge $cacheAdapter */
    public $cacheAdapter = null;
    public $seek = 0;

    /**
     * MsieWriter constructor.
     * @param modX $modx
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
     * @param string $file
     * @param int $columnIndex
     * @param int $row
     * @param array $options
     */
    public function drawing($file, $columnIndex, $row, $options = array())
    {

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
    public function getSeek()
    {
        return $this->seek;
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

