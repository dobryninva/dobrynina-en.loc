<?php

class msImportExportExport extends modProcessor
{
    /** @var Msie $msie */
    public $msie;

    public function initialize()
    {
        $this->msie = $this->modx->getService('msimportexport', 'Msie', $this->modx->getOption('msimportexport.core_path', null, $this->modx->getOption('core_path') . 'components/msimportexport/') . 'model/msimportexport/', array());;
        $this->modx->lexicon->load('msimportexport:default');
        return parent::initialize();
    }

    public function process()
    {
        if ($this->modx->error->hasError()) {
            return $this->modx->error->failure();
        }

        /*

        if ($this->getProperty('depth')) {
            $this->msie->setOption('msimportexport.export.depth', (int)$this->getProperty('depth'));
        }

        if ($this->getProperty('limit')) {
            $this->msie->setOption('msimportexport.export.limit', (int)$this->getProperty('limit'));
        }

        if ($this->getProperty('debug')) {
            $debug = filter_var($this->getProperty('debug'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
            $this->msie->setOption('msimportexport.export.debug', $debug);
        }



        if (!empty($this->getProperty('delimeter'))) {
            $this->msie->setOption('msimportexport.export.delimeter', $this->getProperty('delimeter'));
        }

        if (!empty($this->getProperty('sub_delimeter'))) {
            $this->msie->setOption('msimportexport.export.sub_delimeter', $this->getProperty('sub_delimeter'));
        }

        if ($this->getProperty('ym_pickup_field')) {
            $this->msie->setOption('msimportexport.export.ym.pickup_field', $this->getProperty('ym_pickup_field'));
        }
        if ($this->getProperty('ym_in_stock_field')) {
            $this->msie->setOption('msimportexport.export.ym.in_stock_field', $this->getProperty('ym_in_stock_field'));
        }

        if ($this->getProperty('ym_delivery_field')) {
            $this->msie->setOption('msimportexport.export.ym.delivery_field', $this->getProperty('ym_delivery_field'));
        }

        if ($this->getProperty('ym_currency_rate')) {
            $this->msie->setOption('msimportexport.export.ym.currency_rate', $this->getProperty('ym_currency_rate'));
        }

        if ($this->getProperty('ym_default_currency')) {
            $this->msie->setOption('msimportexport.export.ym.default_currency', (int)$this->getProperty('ym_default_currency'));
        }

        if ($this->getProperty('ym_currencies')) {
            $this->msie->setOption('msimportexport.export.ym.currencies', $this->getProperty('ym_currencies'));
        }

        if ($this->getProperty('ym_company')) {
            $this->msie->setOption('msimportexport.export.ym.company', $this->getProperty('ym_company'));
        }

        if ($this->getProperty('ym_name')) {
            $this->msie->setOption('msimportexport.export.ym.name', $this->getProperty('ym_name'));
        }*/

        $preset = $this->getProperty('preset') ? $this->getProperty('preset') : 0;

        if (empty($preset)) {
            return $this->modx->error->failure(sprintf($this->modx->lexicon('msimportexport.err.ns_preset'), $preset));
        }

        $result = array();
        return $this->modx->error->success('', $result);
    }
}

return 'msImportExportExport';




