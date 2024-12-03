<?php

class msImportExportGetListProcessor extends modObjectGetListProcessor
{
    public $languageTopics = array('msimportexport:default');
    public $classKey = 'MsieCron';
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
        if (!empty($type)) {
            $c->where(array('type' => $type));
        }
        return $c;
    }

    public function prepareRow(xPDOObject $object)
    {
        return $this->prepareArray($object->toArray());
    }

    public function prepareArray(array $row)
    {
        $row['actions'] = array();
        $row['actions'][] = array(
            'cls' => '',
            'icon' => "icon icon-edit",
            'title' => $this->modx->lexicon('msimportexport.menu.edit'),
            'action' => 'edit',
            'button' => true,
            'menu' => true,
        );

        if ($row['status'] == MsieCron::STATUS_WAIT) {
            $row['actions'][] = array(
                'cls' => array(
                    'menu' => 'green',
                    'button' => 'green',
                ),
                'icon' => "icon icon-play",
                'title' => $this->modx->lexicon('msimportexport.menu.run'),
                'action' => 'run',
                'button' => true,
                'menu' => true,
            );
        }

        if ($row['status'] == MsieCron::STATUS_RUN) {
            $row['actions'][] = array(
                'cls' => array(
                    'menu' => 'yellow',
                    'button' => 'yellow',
                ),
                'icon' => "icon icon-minus-circle",
                'title' => $this->modx->lexicon('msimportexport.menu.abort'),
                'action' => 'abort',
                'button' => true,
                'menu' => true,
            );
        } else {
            $row['actions'][] = array(
                'cls' => array(
                    'menu' => 'red',
                    'button' => 'red',
                ),
                'icon' => "icon icon-trash action-red",
                'title' => $this->modx->lexicon('msimportexport.menu.remove'),
                'action' => 'remove',
                'button' => true,
                'menu' => true,
            );
        }
        return $row;

    }
}

return 'msImportExportGetListProcessor';