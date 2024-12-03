<?php

require_once MODX_CORE_PATH . 'components/minishop2/processors/mgr/product/productlink/create.class.php';

class modMsProductLinkCreateProcessor extends msProductLinkCreateProcessor
{
    public $classKey = 'msProductLink';


    public function process()
    {
        $result = parent::process();

        if (!$this->hasErrors()) {

            $query = $this->getQuery();
            $this->object = $this->modx->getObject($this->classKey, $query);
            if (empty($this->object)) {
                return $this->modx->lexicon($this->objectType . '_err_nfs', $query);
            }

            $this->object->fromArray($this->getProperties());
            /* save element */
            if ($this->saveObject() == false) {
                $this->modx->error->checkValidation($this->object);

                return $this->failure($this->modx->lexicon($this->objectType . '_err_save'));
            }
        }

        return $result;
    }

    public function getQuery()
    {
        $query = array();
        foreach (array('link', 'master', 'slave') as $k) {
            $query[$k] = trim($this->getProperty($k));
        }

        return $query;
    }

}

return 'modMsProductLinkCreateProcessor';