<?php

/**
 * Class SEOroomMainController
 */
abstract class SEOroomMainController extends modExtraManagerController {
	/** @var SEOroom $SEOroom */
	public $SEOroom;


	/**
	 * @return void
	 */
	public function initialize() {
		$corePath = $this->modx->getOption('seoroom_core_path', null, $this->modx->getOption('core_path') . 'components/seoroom/');

		require_once $corePath . 'model/seoroom/seoroom.class.php';

		$this->SEOroom = new SEOroom($this->modx);
		//$this->addCss($this->SEOroom->config['cssUrl'] . 'mgr/main.css');
		$this->addJavascript($this->SEOroom->config['jsUrl'] . 'mgr/seoroom.js');
		$this->addHtml('
		<script type="text/javascript">
			SEOroom.config = ' . $this->modx->toJSON($this->SEOroom->config) . ';
			SEOroom.config.connector_url = "' . $this->SEOroom->config['connectorUrl'] . '";
		</script>
		');

		parent::initialize();
	}


	/**
	 * @return array
	 */
	public function getLanguageTopics() {
		return array('seoroom:default');
	}


	/**
	 * @return bool
	 */
	public function checkPermissions() {
		return true;
	}
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends SEOroomMainController {

	/**
	 * @return string
	 */
	public static function getDefaultController() {
		return 'home';
	}
}