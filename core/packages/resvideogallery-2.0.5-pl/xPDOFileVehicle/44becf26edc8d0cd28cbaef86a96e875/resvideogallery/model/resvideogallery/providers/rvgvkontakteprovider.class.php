<?php

require_once (dirname(dirname(__FILE__))) . '/rvgprovider.class.php';

class RvgVkontakteProvider extends RvgProvider
{
    /* @var VKApiClient $vk */
    private $vk;
    private $initialized = false;

    public function __construct(& $rvg)
    {
        parent::__construct($rvg);
        $this->patternApiUrl = '$1';
        $this->patternEmbedCode = '<iframe {$w} {$h} src="//vk.com/video_ext.php?{$video_key}&autoplay={$autoplay}" frameborder="0"></iframe>';
        $this->regexes = array(
            '.vk\.com\/video_ext\.php\?(oid=\-?[0-9]+&id=\-?[0-9]+&hash=[0-9a-zA-Z]+(&hd=[0-9])*).*',
        );
    }

    private function initialize()
    {
        if (!$this->initialized) {
            $this->initialized = true;
            $this->vk = new VK\Client\VKApiClient();
        }
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'vkontakte';
    }

    public function scrape()
    {
        $videoUrl = $this->getApiUrl();
        if ($params = $this->parseParams($videoUrl)) {
            $videoId = $params['oid'] . '_' . $params['id'];
            $response = $this->loadVideoData($videoId);
            if (!empty($response)) {
                $this->videoData['provider'] = $this->getName();
                $this->videoData['description'] = $response['description'];
                $this->videoData['tags'] = '';
                $this->videoData['title'] = $response['title'];
                $this->videoData['duration'] = $response['duration'];
                $this->videoData['video_key'] = $videoUrl;
                $this->videoData['embed_url'] = '//vk.com/video_ext.php?' . $this->videoData['video_key'];
                $this->videoData['url'] = 'https://vk.com/video' . $videoId;
                $this->videoData['thumbnails'] = array(
                    'default' => '',
                    'small' => isset($response['photo_130']) ? $response['photo_130'] : '',
                    'medium' => isset($response['photo_320']) ? $response['photo_320'] : '',
                    'large' => isset($response['photo_800']) ? $response['photo_800'] : '',
                    'huge' => '',
                    'maxres' => '',
                );
                $this->videoData['primary_thumb'] = $this->getThumbMaxSize();
            } else {
                $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery]: Scrape VK error load data: video ID= ' . $videoId);
            }
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery]: Scrape VK error parse params video url: = ' . $videoUrl);
        }

        return $this->videoData;
    }


    /**
     * @param string $videoId
     * @return array|mixed|string
     */
    public function loadVideoData($videoId = '')
    {
        $this->initialize();
        $response = array();
        $accessToken = $this->modx->getOption('resvideogallery.vk_access_token');
        if (empty($accessToken)) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery]: Scrape VK error: not set Access Token. More info: https://docs.modx.pro/komponentyi/resvideogallery/nastrojka/vkontakte');
            return $response;
        }

        try {
            $response = $this->vk->video()->get($accessToken, array(
                'videos' => $videoId,
                'extended' => 1,
                'count' => 1,
            ));
        } catch (Exception $e) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery] Scrape VK error: ' . $e->getMessage());
        }

        if (!empty($response) && isset($response['items'])) {
            return $response['items'][0];
        }
        return $response;
    }

    /**
     * @param string $str
     * @return array
     */
    protected function parseParams($str = '')
    {
        $params = array();
        if (empty($str)) return $params;
        parse_str($str, $params);
        return $params;

    }

}

return 'RvgVkontakteProvider';