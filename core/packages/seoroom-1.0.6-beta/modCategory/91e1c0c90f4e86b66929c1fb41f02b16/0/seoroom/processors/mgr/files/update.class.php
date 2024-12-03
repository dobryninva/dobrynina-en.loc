<?php

class SEOroomRobotsEditProcessor extends modProcessor {

    public $source;
    public function checkPermissions() {
        return $this->modx->hasPermission('file_update');
    }
    public function getLanguageTopics() {
        return array('file');
    }
    public function process() {
        /* get base paths and sanitize incoming paths */
        $filePath = rawurldecode($this->getProperty('file',''));

        $loaded = $this->getSource();
        if (!($this->source instanceof modMediaSource)) {
            return $loaded;
        }
        if (!$this->source->checkPolicy('save')) {
            return $this->failure($this->modx->lexicon('permission_denied'));
        }

        $path = $this->source->updateObject($filePath,$this->getProperty('content'));
        if (empty($path)) {
            $msg = '';
            $errors = $this->source->getErrors();
            foreach ($errors as $k => $msg) {
                $this->addFieldError($k,$msg);
            }
            return $this->failure($msg);
        }
        return $this->success('',array(
            'file' => $path,
        ));
    }

    /**
     * @return boolean|string
     */
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

return 'SEOroomRobotsEditProcessor';