<?php

interface RvgProviderInterface
{
    public function scrape();

    public function getName();

}

abstract class RvgProvider implements RvgProviderInterface
{
    /* @var Rvg $rvg */
    protected $rvg;
    /* @var modX $modx */
    protected $modx;
    protected $apiUrl;
    protected $regexes = array();
    protected $videoData = array();
    protected $patternApiUrl;
    protected $patternEmbedCode;
    protected $allowCheckBlocked = false;

    public function __construct(&$rvg)
    {
        $this->rvg = &$rvg;
        $this->modx = &$rvg->modx;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function checkUrl($url)
    {
        foreach ($this->regexes as $regex) {
            if (preg_match('~' . $regex . '~imu', $url, $matches) && isset($matches[1]) && !empty($matches[1])) {
                $this->prepareApiUrl($matches);
                return true;
            }
        }
        return false;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param array $video
     * @param bool $autoPlay
     * @param string $w
     * @param string $h
     * @return string
     */
    public function getEmbedCode($video = array(), $autoPlay = true, $w = '100%', $h = '100%')
    {
        $code = '';
        $video = empty($video) ? $this->getVideoData() : $video;
        if (!empty($video) && is_array($video)) {
            $params = array(
                'autoplay' => $this->prepareAutoPlayValue($autoPlay),
                'w' => empty($w) ? '' : 'width="' . $w . '"',
                'h' => empty($h) ? '' : 'height="' . $h . '"',
                'thumbsUrl' => $this->rvg->config['thumbsUrl'],
            );


            $params = array_merge($video, $params);
            $code = '@INLINE ' . $this->getPatternEmbedCode();
            $code = $this->rvg->getPdoTools()->getChunk($code, $params);
        }
        return $code;
    }

    /**
     * @return string
     */
    public function getPatternHTML5Player()
    {
        return '<video {if $thumb?} poster_="{$thumbsUrl}{$thumb}" {/if} id="rvg-html5-player-{$id}" class="rvg-html5-player"  data-plyr-config= {ignore} \'{ {/ignore}"duration":{$duration}, "title": "{$title}"{ignore} }\' {/ignore}  playsinline controls {if $autoplay?}autoplay{/if}> 
                    <source src="{$src}" type="{$mime_type}">
                </video>';
    }

    /**
     * @return string
     */
    public function getPatternEmbedCode()
    {
        return $this->patternEmbedCode;
    }


    public function prepareAutoPlayValue($autoPlay)
    {
        return filter_var($autoPlay, FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
    }

    /**
     * @return bool
     */
    public function hasAllowCheckBlocked()
    {
        return $this->allowCheckBlocked;
    }

    /**
     * @param string $videoId
     * @return bool
     */
    public function checkBlocked($videoId = '')
    {
        return false;
    }

    /**
     * @return bool|array
     */
    public function checkSetup()
    {
        return true;
    }

    /**
     * @return array
     */
    public function getVideoData()
    {
        return $this->videoData;
    }

    /**
     * @param string $url
     * @param array $headers
     * @return string
     */
    public function request($url, $headers = array())
    {
        $output = '';
        $headers = !empty($headers) ? $headers : array(
            'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome /69.0.3497.100 Safari /537.36',
            'Accept: text/html,application/xhtml + xml,application/xml;q = 0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7,uk;q=0.6',
        );
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, $url);
        curl_setopt($c, CURLOPT_HEADER, false);
        //   curl_setopt($c, CURLOPT_HEADER, true);
        curl_setopt($c, CURLOPT_TIMEOUT, 5);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_ENCODING, 'gzip, deflate');
        curl_setopt($c, CURLOPT_HTTPHEADER, $headers);

        try {
            if (!$output = curl_exec($c)) {
                $this->modx->log(modX::LOG_LEVEL_ERROR, "Error request. Url : {$url}. Message:\n" . curl_error($c) . "\nError:\n" . curl_errno($c) . "\noutput:\n {$output}");
            }
        } catch (Exception $e) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage());
        }
        curl_close($c);
        return $output;
    }


    /**
     * @return string
     */
    protected function getThumbMaxSize()
    {
        $thumbnails = array_reverse($this->videoData['thumbnails']);
        foreach ($thumbnails as $thumb) {
            if (!empty($thumb))
                return $thumb;
        }
        return '';
    }

    /**
     * @param array $matches
     * @return void
     */
    protected function prepareApiUrl($matches)
    {
        $url = $this->patternApiUrl;
        foreach ($matches as $i => $match) {
            $url = str_ireplace('$' . $i, $match, $url);
        }
        $this->apiUrl = $url;
    }
}