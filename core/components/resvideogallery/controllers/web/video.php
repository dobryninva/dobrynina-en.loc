<?php

/**
 * @package resvideogallery
 */
class ResVideoGalleryVideoController extends RvgController
{
    public $placeholders = array();

    public function initialize()
    {
        $this->modx->lexicon->load('resvideogallery:default');
        $this->setDefaultProperties(array(
            'tpl' => '',
            'validate' => ''
        ));
    }

    public function process()
    {
        $out = array('success' => false, 'data' => array(), 'message' => '');
        $this->loadDictionary();
        $key = $this->getProperty('key');
        $action = $this->getProperty('action');
        $dataType = $this->getProperty('data_type', 'json', 'isset');
        $params = @$_SESSION['resvideogallery'][$key];
        if (empty($params) || !is_array($params)) {
            $out['message'] = 'incorrect request key:' . $key;
            $this->modx->log(modX::LOG_LEVEL_ERROR, $out['message']);
            $this->modx->log(modX::LOG_LEVEL_ERROR, "SESSION data: \n" . print_r($_SESSION, 1));
        } else {
            switch ($action) {
                case 'embed':
                    $tplEmbed = $this->modx->getOption('tplEmbed', $params, 'resVideoGalleryEmbedTpl',true);
                    if ($video = $this->runProcessor('web/video/get')) {
                        $video['tags'] = $this->rvg->getTagsById($this->getProperty('id', 0));
                        $res = $this->rvg->invokeEvent('rvgOnGetVideoEmbed', array('data' => $video));
                        if ($res['success']) {
                            $out['data'] = $this->rvg->getPdoTools()->getChunk($tplEmbed, $res['data']['data']);
                        }
                    }
                    break;
                case 'load':
                    $params['tpl'] = '';
                    $params['offset'] = $this->getProperty($params['pageVarKey'], 0) * $params['limit'];
                    $params['session_key'] = $key;
                    $out['data']['results'] = $this->modx->runSnippet('ResVideoGallery', $params);
                    $out['data']['total'] = $this->modx->getPlaceholder($params['plPrefix'] . $params['totalVar']);
                    $out['success'] = true;
                    break;
            }
        }
        return $dataType == 'json' ? $out : $out['data'];
    }
}

return 'ResVideoGalleryVideoController';