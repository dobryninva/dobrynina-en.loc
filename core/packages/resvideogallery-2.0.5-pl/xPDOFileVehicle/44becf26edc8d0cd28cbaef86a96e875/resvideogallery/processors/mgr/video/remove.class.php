<?php

class ResVideoGalleryRemoveProcessor extends modObjectRemoveProcessor
{
    public $classKey = 'RvgVideos';
    public $languageTopics = array('resresvideogallery:default');
    /** @var Rvg $rvg */
    public $rvg;

    public function initialize()
    {
        if (!$this->rvg = $this->modx->getService('resvideogallery', 'Rvg', MODX_CORE_PATH . 'components/resvideogallery/model/resvideogallery/')) {
            return 'Could not load class ResVideoGallery!';
        }
        return parent::initialize();
    }

    /**
     * @return array|string
     */
    public function process()
    {
        $id = $this->getProperty('id');
        if (empty($id)) {
            return $this->failure($this->modx->lexicon('resresvideogallery.err.ns'));
        }

        $res = $this->rvg->invokeEvent('rvgOnBeforeVideoRemove', array(
            'video' => $this->object,
        ));

        if (!$res['success']) {
            return $this->modx->error->failure();
        }

        /* @var RvgVideos $video */
        if ($video = $this->modx->getObject('RvgVideos', $id)) {
            $resource_id = $video->get('resource_id');
            if ($video->remove()) {
                $this->rvg->rankResourceVideos($resource_id);
                $this->rvg->invokeEvent('rvgOnAfterVideoRemove', array(
                    'video' => $this->object,
                ));
            }
        }
        return $this->success();
    }

}

return 'ResVideoGalleryRemoveProcessor';