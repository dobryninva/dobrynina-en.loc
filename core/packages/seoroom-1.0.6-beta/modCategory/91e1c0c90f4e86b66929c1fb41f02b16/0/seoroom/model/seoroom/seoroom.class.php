<?php

/**
 * The base class for SEOroom.
 */
class SEOroom {
	/* @var modX $modx */
	public $modx;


	/**
	 * @param modX $modx
	 * @param array $config
	 */
	function __construct(modX &$modx, array $config = array()) {

		$this->modx =& $modx;

		$corePath = $this->modx->getOption('seoroom_core_path', $config, $this->modx->getOption('core_path') . 'components/seoroom/');
		$assetsUrl = $this->modx->getOption('seoroom_assets_url', $config, $this->modx->getOption('assets_url') . 'components/seoroom/');
		$connectorUrl = $assetsUrl . 'connector.php';

		$this->config = array_merge(array(
			'assetsUrl' => $assetsUrl,
			'cssUrl' => $assetsUrl . 'css/',
			'jsUrl' => $assetsUrl . 'js/',
			'imagesUrl' => $assetsUrl . 'images/',
			'connectorUrl' => $connectorUrl,

			'corePath' => $corePath,
			'modelPath' => $corePath . 'model/',
			'chunksPath' => $corePath . 'elements/chunks/',
			'templatesPath' => $corePath . 'elements/templates/',
			'chunkSuffix' => '.chunk.tpl',
			'snippetsPath' => $corePath . 'elements/snippets/',
			'processorsPath' => $corePath . 'processors/'
		), $config);

		$this->modx->addPackage('seoroom', $this->config['modelPath']);
		$this->modx->lexicon->load('seoroom:default');
	}

}