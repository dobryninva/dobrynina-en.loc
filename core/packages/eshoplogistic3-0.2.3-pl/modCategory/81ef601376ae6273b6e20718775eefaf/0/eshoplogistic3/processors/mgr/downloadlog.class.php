<?php

class eShopLogistic3DownloadLogProcessor extends modProcessor
{
    public function process()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        if(file_exists($this->eshoplogistic3->log_file)) {
            header('Content-Type: application/force-download');
            header('Content-Length: ' . filesize($this->eshoplogistic3->log_file));
            header('Content-Disposition: attachment; filename="' . basename($this->eshoplogistic3->log_file) . '"');
            ob_get_level() && @ob_end_flush();
            readfile($this->eshoplogistic3->log_file);
            die();
        }
    }
}

return 'eShopLogistic3DownloadLogProcessor';