<?php

/**
 * Class mssetincartMainController
 */
abstract class mssetincartMainController extends modExtraManagerController
{
    /** @var mssetincart $mssetincart */
    public $mssetincart;


    /**
     * @return void
     */
    public function initialize()
    {
        $corePath = $this->modx->getOption('mssetincart_core_path', null,
            $this->modx->getOption('core_path') . 'components/mssetincart/');
        require_once $corePath . 'model/mssetincart/mssetincart.class.php';

        $this->mssetincart = new mssetincart($this->modx);
        $this->addCss($this->mssetincart->config['cssUrl'] . 'mgr/main.css');
        $this->addJavascript($this->mssetincart->config['jsUrl'] . 'mgr/mssetincart.js');
        $this->addHtml('
		<script type="text/javascript">
			mssetincart.config = ' . $this->modx->toJSON($this->mssetincart->config) . ';
			mssetincart.config.connector_url = "' . $this->mssetincart->config['connectorUrl'] . '";
		</script>
		');

        parent::initialize();
    }


    /**
     * @return array
     */
    public function getLanguageTopics()
    {
        return array('mssetincart:default');
    }


    /**
     * @return bool
     */
    public function checkPermissions()
    {
        return true;
    }
}


/**
 * Class IndexManagerController
 */
class IndexManagerController extends mssetincartMainController
{

    /**
     * @return string
     */
    public static function getDefaultController()
    {
        return 'home';
    }
}