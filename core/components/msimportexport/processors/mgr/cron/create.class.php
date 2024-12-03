<?php

class  msImportExportCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'MsieCron';
    public $languageTopics = array('msimportexport:default');

    public function beforeSet()
    {
        $this->setCheckbox('active');
        $this->setCheckbox('run_user');
        $this->setProperty('pid_key', md5('pid_' . uniqid(mt_rand(), true)));
        $this->setProperty('seek', 0);
        $this->setProperty('iteration', 0);
        return parent::beforeSet();
    }
}

return 'msImportExportCreateProcessor';