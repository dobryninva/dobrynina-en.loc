<?php

class msImportExportUpdateProcessor extends modObjectUpdateProcessor
{
    public $languageTopics = array('msimportexport:default');
    public $classKey = 'MsieCron';

    public function beforeSet()
    {
        $this->setCheckbox('active');
        $this->setCheckbox('run_user');
        return parent::beforeSet();
    }

}

return 'msImportExportUpdateProcessor';