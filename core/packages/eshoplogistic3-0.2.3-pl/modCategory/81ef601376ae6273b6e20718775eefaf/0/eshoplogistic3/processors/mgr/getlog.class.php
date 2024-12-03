<?php

class eShopLogistic3GetLogProcessor extends modProcessor
{
    public function process()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3');

        $content = '';

        if(file_exists($this->eshoplogistic3->log_file)) {
            # ограничение вывода
            $limit = 102400;
            $filesize = filesize($this->eshoplogistic3->log_file);
            $offset = ($filesize < $limit) ? 0 : $filesize - $limit;
            $content = file_get_contents($this->eshoplogistic3->log_file, false, null, $offset );
            $content = stristr($content, '*****');
        }

        return $this->success('', [
            'content' => $content
        ]);

    }

}

return 'eShopLogistic3GetLogProcessor';