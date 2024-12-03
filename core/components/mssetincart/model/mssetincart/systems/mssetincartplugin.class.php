<?php

abstract class msSetInCartPlugin
{
    /** @var modX $modx */
    protected $modx;
    /** @var msSetInCart $msSetInCart */
    protected $msSetInCart;
    /** @var array $scriptProperties */
    protected $scriptProperties;

    public $isAjax = false;

    public function __construct(modX $modx, &$scriptProperties)
    {
        $this->modx = &$modx;
        $this->scriptProperties =& $scriptProperties;

        if (!$this->msSetInCart = &$this->modx->mssetincart) {
            return;
        }

        if ($this->msSetInCart->miniShop2) {
            $this->msSetInCart->miniShop2->initialize($this->modx->context->key);
        }
        
        $this->msSetInCart->initialize($this->modx->context->key);

    }

    abstract public function run();

    public function getQueryLink(array $data = array())
    {
        $query = array();
        $options = array('link', 'master', 'slave');
        foreach ($options as $k) {
            if (isset($data["mssetincart_{$k}"])) {
                $query[$k] = $data["mssetincart_{$k}"];
            } else {
                if (isset($_REQUEST["mssetincart_{$k}"])) {
                    $query[$k] = $_REQUEST["mssetincart_{$k}"];
                }
            }
        }

        if (count($query) == count($options)) {
            return $query;
        }

        if (empty($query)) {
            foreach ($options as $k) {
                if (isset($_REQUEST["mssetincart_{$k}"])) {
                    $query[$k] = $_REQUEST["mssetincart_{$k}"];
                }
            }
        }

        if (count($query) == count($options)) {
            $this->isAjax = true;

            return $query;
        }

        return null;
    }
}