<?php

class eShopLogistic3ClearCacheProcessor extends modProcessor
{
    public function process()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        $cache_data = $this->eshoplogistic3->cacheSize('delete');

        if(file_exists($this->eshoplogistic3->deliveries_config_file)) {
            unlink($this->eshoplogistic3->deliveries_config_file);
        }

        return $this->outputArray([
            'cache_size' => $cache_data['size'].' Mb '.str_replace(['{files}', '{time}'], [$cache_data['files'], $cache_data['time']], $this->modx->lexicon('eshoplogistic3_info_cache_size_text'))
        ]);
    }

}

return 'eShopLogistic3ClearCacheProcessor';