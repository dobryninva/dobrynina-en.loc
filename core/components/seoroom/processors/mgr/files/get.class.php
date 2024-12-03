<?php

class SEOroomRobotsGetProcessor extends modProcessor {

    public $source;

    public function process(){

        $loaded = $this->getSource();
        if ($loaded !== true) {
            return $loaded;
        }

        $fileArray = $this->source->getObjectContents($this->getProperty('file'));

        return $this->success('',array('content' => $fileArray['content']));

    }

    public function getSource() {
        $source = $this->getProperty('source',1);
        /** @var modMediaSource $source */
        $this->modx->loadClass('sources.modMediaSource');
        $this->source = modMediaSource::getDefaultSource($this->modx,$source);
        if (!$this->source->getWorkingContext()) {
            return $this->modx->lexicon('permission_denied');
        }
        $this->source->setRequestProperties($this->getProperties());
        return $this->source->initialize();
    }

}

return 'SEOroomRobotsGetProcessor';