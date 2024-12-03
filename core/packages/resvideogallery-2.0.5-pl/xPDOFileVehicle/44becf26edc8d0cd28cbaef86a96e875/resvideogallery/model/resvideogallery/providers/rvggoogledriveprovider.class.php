<?php

require_once (dirname(dirname(__FILE__))) . '/rvgprovider.class.php';


class RvgGoogleDriveProvider extends RvgProvider
{

    private $initialized = false;

    public function __construct(& $rvg)
    {
        parent::__construct($rvg);
        $this->patternApiUrl = '$1';
        $this->patternEmbedCode = '<iframe {$w} {$h} src="https://drive.google.com/file/d/{$video_key}/preview"></iframe>';
        $this->regexes = array(
            'drive\.google\.com\/file\/d\/([a-zA-Z0-9_\-]+)\/preview',
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'googledrive';
    }

    /**
     * @return string
     */
    public function getPatternEmbedCode()
    {
        $useHtml5Player = $this->modx->getOption('resvideogallery.google_drive_html5_player', null, 1, true);
        if ($useHtml5Player) {
            return $this->getPatternHTML5Player();
        } else {
            return parent::getPatternEmbedCode();
        }
    }

    public function scrape()
    {
        $videoUrl = $this->getApiUrl();
        if ($this->videoData = $this->loadVideoData($videoUrl)) {
            $this->videoData['provider'] = $this->getName();
            $this->videoData['primary_thumb'] = $this->getThumbMaxSize();
        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, '[ResVideoGallery]: Scrape google drive video error load data: video ID= ' . $videoUrl);
        }
        return $this->videoData;
    }


    public function loadVideoData($videoId)
    {
        $result = array();
        $client = $this->getClient();
        if ($client && !is_string($client)) {
            /** @var Google_Service_Drive $service */
            $service = new Google_Service_Drive($client);
            $filedata = $service->files->get($videoId, array('fields' => 'id,name,mimeType, description,videoMediaMetadata,thumbnailLink,webContentLink,webViewLink'));
            $result['title'] = $filedata->getName();
            $result['description'] = $filedata->getDescription();
            $result['tags'] = '';
            $result['duration'] = (int)$filedata->getVideoMediaMetadata()->getDurationMillis() / 1000;
            $result['video_key'] = $filedata->getId();
            $result['embed_url'] = $filedata->getWebViewLink();
            $result['url'] = $filedata->getWebViewLink();
            $result['src'] = $filedata->getWebContentLink();
            $result['mime_type'] = $filedata->getMimeType();
            $result['thumbnails'] = array(
                'default' => $filedata->getThumbnailLink(),
                'small' => '',
                'medium' => '',
                'large' => '',
                'huge' => '',
                'maxres' => '',
            );

        } else {
            $this->modx->log(modX::LOG_LEVEL_ERROR, 'Error get client for google drive. Info:' . $client);
        }
        return $result;
    }

    /**
     * @return Google_Client|string|null
     * @throws Exception
     */
    public function getClient()
    {
        $config = $this->modx->getOption('resvideogallery.google_drive_auth_config', null, '[]', true);
        $config = $this->modx->fromJSON($config);

        if (empty($config) || empty($config['installed'])) {
            $err = 'Error! Not set google drive auth config data';
            $this->modx->log(modX::LOG_LEVEL_ERROR, $err);
            throw new Exception($err);
        }

        $config = $config['installed'];
        $client = new Google_Client();
        $client->setApplicationName('ResVideoGallery');
        $client->setScopes(array(
            Google_Service_Drive::DRIVE_METADATA_READONLY,
            Google_Service_Drive::DRIVE_READONLY,

        ));
        $client->setClientId($config['client_id']);
        $client->setClientSecret($config['client_secret']);
        if (isset($config['redirect_uris'])) {
            $client->setRedirectUri($config['redirect_uris'][0]);
        }
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');


        $token = $this->modx->getOption('resvideogallery.google_drive_auth_token', null, '', true);
        if (!empty($token)) {
            $client->setAccessToken($token);
        }

        // If there is no previous token or it's expired.
        if ($client->isAccessTokenExpired()) {
            // Refresh the token if possible, else fetch a new one.
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                // Request authorization from the user.
                $authCode = $this->modx->getOption('resvideogallery.google_drive_auth_code', null, '', true);
                if (empty($authCode)) {
                    $authUrl = $client->createAuthUrl();
                    return $authUrl;
                }
                $authCode = trim($authCode);
                // Exchange authorization code for an access token.
                $accessToken = $client->fetchAccessTokenWithAuthCode($authCode);
                $client->setAccessToken($accessToken);

                // Check to see if there was an error.
                if (array_key_exists('error', $accessToken)) {
                    $err = 'Error! Not set google drive access token. ' . join(', ', $accessToken);
                    $this->modx->log(modX::LOG_LEVEL_ERROR, $err);
                    throw new Exception($err);
                }
            }

            $this->rvg->setOption('google_drive_auth_token', $client->getAccessToken(), '', true);
        }
        return $client;

    }

    /**
     * @return array|bool
     */
    public function checkSetup()
    {
        try {
            $client = $this->getClient();
            if (is_string($client)) {
                return array('redirect' => $client);
            } else {
                return true;
            }
        } catch (Exception $e) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $e->getMessage());
            return array('message' => $e->getMessage());
        }
    }

}

return 'RvgGoogleDriveProvider';