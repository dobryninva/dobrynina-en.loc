<?php

require_once MODX_CORE_PATH . 'components/minishop2/processors/mgr/product/productlink/getlist.class.php';

class modMsProductLinkGetListProcessor extends msProductLinkGetListProcessor
{
    public $classKey = 'msProductLink';
    public $languageTopics = array('default', 'minishop2:manager', 'minishop2:product');

    /**
     * @param xPDOQuery $c
     *
     * @return xPDOQuery
     */
    public function prepareQueryBeforeCount(xPDOQuery $c)
    {
        $c = parent::prepareQueryBeforeCount($c);

        $link = trim($this->getProperty('link'));
        if (!empty($link)) {
            $c->where(array(
                'msLink.id' => $link
            ));
        }

        return $c;
    }


    /**
     * @param xPDOObject $object
     *
     * @return array
     */
    public function prepareRow(xPDOObject $object)
    {
        $data = parent::prepareRow($object);

        $actions = array(
            array(
                'cls'    => '',
                'icon'   => 'icon icon-edit',
                'title'  => $this->modx->lexicon('ms2_product_edit'),
                'action' => 'updateLink',
                'button' => true,
                'menu'   => true,
            ),
        );

        $data['actions'] = array_merge($actions, $data['actions']);

        return $data;
    }


}

return 'modMsProductLinkGetListProcessor';