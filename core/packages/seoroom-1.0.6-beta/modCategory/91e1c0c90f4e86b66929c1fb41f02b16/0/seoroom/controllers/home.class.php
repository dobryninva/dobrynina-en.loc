<?php

/**
 * The home manager controller for SEOroom.
 *
 */
class SEOroomHomeManagerController extends SEOroomMainController {
	/* @var SEOroom $SEOroom */
	public $SEOroom;


	/**
	 * @param array $scriptProperties
	 */
	public function process(array $scriptProperties = array()) {
	}


	/**
	 * @return null|string
	 */
	public function getPageTitle() {
		return $this->modx->lexicon('seoroom');
	}


	/**
	 * @return void
	 */
	public function loadCustomCssJs() {
		$this->addCss($this->SEOroom->config['cssUrl'] . 'mgr/main.css');
		$this->addCss($this->SEOroom->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
		$this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/misc/utils.js');
        $this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/widgets/robots_txt.form.js');
        $this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/widgets/htaccess.form.js');
        $this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/widgets/items.grid.js');
		$this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/widgets/items.windows.js');
		$this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/widgets/home.panel.js');
		$this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/sections/home.js');
		$this->addHtml('<script type="text/javascript">
		Ext.onReady(function() {
			MODx.load({ xtype: "seoroom-page-home"});
		});
		</script>');
	}


	/**
	 * @return string
	 */
	public function getTemplateFile() {
		return $this->SEOroom->config['templatesPath'] . 'home.tpl';
	}
}