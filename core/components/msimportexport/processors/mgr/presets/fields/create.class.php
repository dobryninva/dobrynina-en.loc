<?php

class  msImportExportCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'MsiePresetsFields';
    public $languageTopics = array('msimportexport:default');

    public function beforeSet()
    {
        $this->setProperty('fields', '');
        return parent::beforeSet();
    }
}

return 'msImportExportCreateProcessor';