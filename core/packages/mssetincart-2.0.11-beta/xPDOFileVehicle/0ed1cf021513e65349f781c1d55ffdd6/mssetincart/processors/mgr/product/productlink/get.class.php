<?php

/**
 * Get an msProductLink
 */
class modMsProductLinkCreateProcessor extends modObjectGetProcessor
{
    /** @var msProductLink $object */
    public $object;
    public $objectType = 'msProductLink';
    public $classKey = 'msProductLink';
    public $languageTopics = array('default', 'minishop2:manager', 'minishop2:product');
    public $permission = '';

    public function initialize()
    {
        $this->setProperties(json_decode($this->getProperty('query'), true));

        $query = $this->getQuery();
        $this->object = $this->modx->getObject($this->classKey, $query);
        if (empty($this->object)) {
            return $this->modx->lexicon($this->objectType . '_err_nfs', $query);
        }

        return true;
    }

    public function getQuery()
    {
        $query = array();
        foreach (array('link', 'master', 'slave') as $k) {
            $query[$k] = trim($this->getProperty($k));
        }

        return $query;
    }

    public function cleanup()
    {
        $array = $this->object->toArray();

        return $this->success('', $array);
    }

}

return 'modMsProductLinkCreateProcessor';