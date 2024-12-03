<?php

class eShopLogistic3ClearLogProcessor extends modProcessor
{
    public function process()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        $data['content'] = '';
        
        if(file_exists($this->eshoplogistic3->log_file)) {
            unlink($this->eshoplogistic3->log_file);
        }

        return $this->outputArray($data);
    }

}

return 'eShopLogistic3ClearLogProcessor';