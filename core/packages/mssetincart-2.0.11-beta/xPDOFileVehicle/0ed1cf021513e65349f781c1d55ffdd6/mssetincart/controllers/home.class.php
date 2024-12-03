<?php

/**
 * The home manager controller for mssetincart.
 *
 */
class mssetincartHomeManagerController extends mssetincartMainController
{
    /* @var mssetincart $mssetincart */
    public $mssetincart;


    /**
     * @param array $scriptProperties
     */
    public function process(array $scriptProperties = array())
    {
    }


    /**
     * @return null|string
     */
    public function getPageTitle()
    {
        return $this->modx->lexicon('mssetincart');
    }


    /**
     * @return void
     */
    public function loadCustomCssJs()
    {
        $this->addCss($this->mssetincart->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->mssetincart->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addJavascript($this->mssetincart->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->mssetincart->config['jsUrl'] . 'mgr/widgets/items.grid.js');
        $this->addJavascript($this->mssetincart->config['jsUrl'] . 'mgr/widgets/items.windows.js');
        $this->addJavascript($this->mssetincart->config['jsUrl'] . 'mgr/widgets/home.panel.js');
        $this->addJavascript($this->mssetincart->config['jsUrl'] . 'mgr/sections/home.js');
        $this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "mssetincart-page-home"});
		});
		</script>');
    }


    /**
     * @return string
     */
    public function getTemplateFile()
    {
        return $this->mssetincart->config['templatesPath'] . 'home.tpl';
    }
}