<?php

class ResVideoGalleryAddProcessor extends modObjectCreateProcessor
{
    public $classKey = 'RvgVideos';
    public $languageTopics = array('videogallery:default');
    /** @var Rvg $rvg */
    public $rvg;

    /**
     * @return bool|null|string
     */
    public function initialize()
    {
        /* @var modResource $resource */
        $resourceId = $this->getProperty('resource_id', 0);
        if (!$resource = $this->modx->getObject('modResource', $resourceId)) {
            return $this->modx->lexicon('resvideogallery.err.nf_resource');
        }

        if (!$this->rvg = $this->modx->getService('resvideogallery', 'Rvg', MODX_CORE_PATH . 'components/resvideogallery/model/resvideogallery/')) {
            return 'Could not load class ResVideoGallery!';
        }
        return parent::initialize();
    }

    public function beforeSet()
    {
        $rank = $this->modx->getCount('RvgVideos', array('resource_id' => $this->getProperty('resource_id', 0)));
        $this->setProperty('createdon', date('Y-m-d H:i:s'));
        $this->setProperty('createdby', $this->modx->user->id);
        $this->setProperty('rank', $rank);
        $res = $this->rvg->invokeEvent('rvgOnBeforeVideoAdd',  array(
            'properties' => $this->getProperties()
        ));
        $this->setProperties($res['data']['properties']);
        return ($res['success'] && parent::beforeSet());
    }

    public function afterSave()
    {
        $tags = array_map('trim', explode(',', $this->getProperty('tags', '')));
        foreach ($tags as $tag) {
            $videosTags = $this->modx->newObject('RvgVideosTags');
            $videosTags->set('video_id', $this->object->get('id'));
            $videosTags->set('tag', $tag);
            if (!$videosTags->save()) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] error save tag "' . $tag . '" for video ID ' . $this->object->get('id'));
            }
        }
        if ($save = parent::afterSave()) {
            $this->rvg->invokeEvent('rvgOnAfterVideoAdd', array(
                'video' => $this->object,
                'properties' => $this->getProperties()
            ));
        }
        return $save;
    }

}

return 'ResVideoGalleryAddProcessor';
