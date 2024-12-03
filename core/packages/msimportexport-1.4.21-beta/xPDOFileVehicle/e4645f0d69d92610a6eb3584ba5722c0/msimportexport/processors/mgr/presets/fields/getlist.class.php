<?php

class msImportExportGetListProcessor extends modObjectGetListProcessor
{
    public $languageTopics = array('msimportexport:default');
    public $classKey = 'MsiePresetsFields';
    public $defaultSortField = 'id';
    public $defaultSortDirection = 'ASC';
    public $checkListPermission = true;

    public function beforeQuery()
    {
        $this->setProperty('limit', 0);
        return parent::beforeQuery();
    }

    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $type = $this->getProperty('type');
        $act = $this->getProperty('act');
        if (!empty($type)) {
            $c->where(array('type' => $type));
        }
        if (!empty($act)) {
            $c->where(array('act' => $act));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object)
    {
        $data = $object->toArray();

        if (!$this->getProperty('combo')) {
            $data['actions'] = array(
                array(
                    'cls' => array(
                        'menu' => 'green',
                        'button' => 'green',
                    ),
                    'icon' => 'icon icon-edit',
                    'title' => $this->modx->lexicon('msimportexport.menu.edit'),
                    'action' => 'updateSet',
                    'button' => true,
                    'menu' => true,
                ), array(
                    'cls' => array(
                        'menu' => 'blue',
                        'button' => 'blue',
                    ),
                    'icon' => 'icon icon-copy',
                    'title' => $this->modx->lexicon('msimportexport.menu.duplicate'),
                    'action' => 'duplicateSet',
                    'button' => true,
                    'menu' => true,
                ),
                array(
                    'cls' => array(
                        'menu' => 'red',
                        'button' => 'red',
                    ),
                    'icon' => 'icon icon-trash-o',
                    'title' => $this->modx->lexicon('msimportexport.menu.remove'),
                    'multiple' => $this->modx->lexicon('msimportexport.menu.multiple_remove'),
                    'action' => 'removeSet',
                    'button' => true,
                    'menu' => true,
                ),
            );
        }

        return $data;
    }
}

return 'msImportExportGetListProcessor';