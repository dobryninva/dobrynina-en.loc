<?php

class ResVideoGalleryUpdateProcessor extends modObjectUpdateProcessor
{
    /* @var RvgVideos $object */
    public $object;
    /** @var Rvg $rvg */
    public $rvg;
    public $classKey = 'RvgVideos';
    public $languageTopics = array('core:default', 'resresvideogallery:default');

    public function initialize()
    {
        if (!$this->rvg = $this->modx->getService('resvideogallery', 'Rvg', MODX_CORE_PATH . 'components/resvideogallery/model/resvideogallery/')) {
            return 'Could not load class ResVideoGallery!';
        }
        return parent::initialize();
    }

    /**
     * @return array|bool|string
     */
    public function beforeSet()
    {
        if (!$this->getProperty('id')) {
            return $this->failure($this->modx->lexicon('resresvideogallery.err.ns'));
        }
        $scrapeData = $this->rvg->scrapeVideo($this->object->url);
        if ($scrapeData !== false) {
            $this->setProperty('primary_thumb', $scrapeData['primary_thumb']);
        } else {
            return $this->failure($this->modx->lexicon('resvideogallery.err.scrape'));
        }
        $res = $this->rvg->invokeEvent('rvgOnBeforeThumbUpdate', array(
            'video' => $this->object,
            'properties' => $this->getProperties()
        ));
        $this->setProperties($res['data']['properties']);
        return ($res['success'] && parent::beforeSet());
    }

    public function afterSave()
    {
        if ($save = parent::afterSave()) {
            $this->rvg->invokeEvent('rvgOnAfterThumbUpdate', array(
                'video' => $this->object,
                'properties' => $this->getProperties()
            ));
        }
        return $save;
    }

}

return 'ResVideoGalleryUpdateProcessor';