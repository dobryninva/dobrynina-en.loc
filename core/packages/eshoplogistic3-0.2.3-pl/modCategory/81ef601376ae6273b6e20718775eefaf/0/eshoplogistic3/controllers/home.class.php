<?php

/**
 * The home manager controller for eshoplogistic3.
 *
 */
class eshoplogistic3HomeManagerController extends modExtraManagerController
{
    /** @var eshoplogistic3 $eshoplogistic3 */
    public $eshoplogistic3;


    /**
     *
     */
    public function initialize()
    {
        $this->eshoplogistic3 = $this->modx->getService('eshoplogistic3', 'eshoplogistic3', MODX_CORE_PATH . 'components/eshoplogistic3/model/eshoplogistic3/');
        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return ['eshoplogistic3:default'];
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('eshoplogistic3');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addJavascript($this->eshoplogistic3->config['jsUrl'] . 'mgr/eshoplogistic3.js');
        $this->addJavascript($this->eshoplogistic3->config['jsUrl'] . 'mgr/widgets/form-info.js');
        $this->addJavascript($this->eshoplogistic3->config['jsUrl'] . 'mgr/widgets/form-statistics.js');
        $this->addJavascript($this->eshoplogistic3->config['jsUrl'] . 'mgr/widgets/form-log.js');
        $this->addJavascript($this->eshoplogistic3->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->eshoplogistic3->config['jsUrl'] . 'mgr/sections/home.js');

        $this->addHtml('<script type="text/javascript">
        eshoplogistic3.config = ' . json_encode($this->eshoplogistic3->config) . ';
        eshoplogistic3.config.connector_url = "' . $this->eshoplogistic3->config['connectorUrl'] . '";
        Ext.onReady(function() {MODx.load({ xtype: "eshoplogistic3-page-home"});});
        </script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        $this->content .= '<div id="eshoplogistic3-panel-home-div"></div>';
        return '';
    }
}