<?php

/**
 * Get an msopModification
 */
class msSetInCartSetGetProcessor extends modProcessor
{
    public $objectType = 'msopModification';
    public $classKey = 'msopModification';
    public $languageTopics = array('mssetincart');
    public $permission = '';

    public function initialize()
    {
        return parent::initialize();
    }

    /** {@inheritDoc} */
    public function process()
    {
        /** @var mssetincart $msSetInCart */
        $msSetInCart = $this->modx->getService('mssetincart');
        $msSetInCart->initialize($this->getProperty('ctx', $this->modx->context->key));

        $data = $msSetInCart->getSetData($this->getProperty('data'));
        $data = array_merge($data, array(
            'errors' => null
        ));

        /* process msmulticurrency */
        /** @var MsMC $msmc */
        if ($msSetInCart->isExistService('msmulticurrency') AND $msmc = $this->modx->getService('msmulticurrency', 'MsMC')) {
            $tmp = &$data['sets']['cost'];
            if (is_array($tmp)) {
                foreach ($tmp as $rid => $price) {
                    $tmp[$rid] = $msmc->getPrice($price, $rid);
                }
            }
        }

        return $msSetInCart->success('', $data);
    }

}

return 'msSetInCartSetGetProcessor';