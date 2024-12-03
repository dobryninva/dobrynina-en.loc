<?php

class ResVideoGalleryUploadController extends RvgController
{

    private $params = array();

    public function initialize()
    {
        $this->modx->lexicon->load('resvideogallery:video');
        $this->setDefaultProperties(array(
            'validate' => 'url|required',
        ));
    }

    public function process()
    {
        $out = array('success' => false, 'data' => array(), 'message' => '');
        $this->loadDictionary();
        $this->loadValidator();
        $key = $this->getProperty('key');
        $action = $this->getProperty('action');
        $this->params = @$_SESSION['resvideogallery:upload'][$key];
        if (empty($this->params) || !is_array($this->params)) {
            $out['message'] = 'incorrect request key:' . $key;
        } else {
            switch ($action) {
                case 'scrape':
                    $videoData = $this->rvg->scrapeVideo($this->dictionary->get('url', ''));
                    if ($videoData === false) {
                        $out['message'] = $this->modx->lexicon('video.err.scrape');
                    } else {
                        $out['success'] = true;
                        $out['video'] = array(
                            'title' => $videoData['title'],
                            'description' => $videoData['description'],
                            'duration' => $this->rvg->prepareDuration($videoData['duration']),
                            'tags' => $videoData['tags'],
                            'thumb' => $videoData['primary_thumb'],
                        );
                    }
                    break;
                case 'upload':
                    $out['success'] = true;
                    $out['message'] = $this->modx->lexicon('video.success');
                    if ($this->isPermission()) {
                        $this->setTags();
                        $this->setProperty('resource', $this->modx->getOption('resource', $this->params, 0));
                        $this->setProperty('allowTags', $this->modx->getOption('allowTags', $this->params, 0));
                        $this->setProperty('active', $this->modx->getOption('active', $this->params, 1));
                        if ($this->runProcessor('web/video/upload')) {
                            $out['success'] = true;
                            $out['message'] = $this->modx->lexicon('video.success');
                        } else {
                            $out['message'] = $this->modx->lexicon('video.err.upload');
                        }

                    } else {
                        $out['message'] = $this->modx->lexicon('video.err.permission');
                    }
                    break;
                default:
                    return '';
            }
        }
        return $out;
    }


    private function setTags()
    {
        if ($tags = $this->modx->getOption('tags', $this->params, '')) {
            $tags = array_filter(array_map('trim', explode(',', $tags)));
            $this->setProperty('tags', $tags);
        }
    }

    private function isPermission()
    {
        if ($this->modx->getOption('onlyAuth', $this->params, 1) && !$this->modx->user->isAuthenticated('web'))
            return false;
        if ($usergroups = $this->modx->getOption('usergroups', $this->params, '')) {
            $usergroups = array_filter(array_map('trim', explode(',', $usergroups)));
            return $this->modx->user->isMember($usergroups);
        }
        return true;
    }

}

return 'ResVideoGalleryUploadController';