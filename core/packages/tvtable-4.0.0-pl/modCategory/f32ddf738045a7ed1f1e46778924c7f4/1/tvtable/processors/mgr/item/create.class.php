<?php

class TVTableItemCreateProcessor extends modObjectCreateProcessor
{
    public $objectType = 'TVTableItem';
    public $classKey = 'TVTableItem';
    public $languageTopics = array('tvtable');
    //public $permission = 'create';


    /**
     * @return bool
     */
    public function beforeSet()
    {
        $name = trim($this->getProperty('name'));
        if (empty($name)) {
            $this->modx->error->addField('name', $this->modx->lexicon('tvtable_item_err_name'));
        } elseif ($this->modx->getCount($this->classKey, array('name' => $name))) {
            $this->modx->error->addField('name', $this->modx->lexicon('tvtable_item_err_ae'));
        }

        return parent::beforeSet();
    }

}

return 'TVTableItemCreateProcessor';