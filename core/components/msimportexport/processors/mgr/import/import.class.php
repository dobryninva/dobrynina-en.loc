<?php

class msImportExportImport extends modProcessor
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
        if (empty($this->getProperty('filename'))) {
            $this->modx->error->addField('filename', $this->modx->lexicon('msimportexport.err.err_ns'));
        }

        if ($this->modx->error->hasError()) {
            return $this->modx->error->failure();
        }

        $fields = $this->getProperty('fields') ? $this->getProperty('fields') : array();
        $preset = $this->getProperty('preset') ? $this->getProperty('preset') : 0;
        $seek = $this->getProperty('seek') ? $this->getProperty('seek') : 0;
        $key = $this->getProperty('key') ? $this->getProperty('key') : '';
        $offset = $this->getProperty('offset') ? $this->getProperty('offset') : 0;
        $steps = $this->getProperty('steps') ? $this->getProperty('steps') : 0;
        $type = $this->getProperty('import_type') ? $this->getProperty('import_type') : 'products';


        if ($fields && $preset) {
            if ($arrFields = $this->msie->checkValidityFields($fields)) {
                foreach ($fields as $index => $field) {
                    if (in_array($field, $arrFields)) {
                        $this->modx->log(modX::LOG_LEVEL_ERROR, 'Invalid field name:' . $field);
                        $this->modx->error->addField($index, $this->modx->lexicon('msimportexport.err.err_field_name') . $field);
                    }
                }
            }

            if ($this->modx->error->hasError()) {
                return $this->modx->error->failure();
            }

            $this->msie->setPresetFields($preset, $fields);
        } else {
            return $this->modx->error->failure($this->modx->lexicon('msimportexport.err.import_empty_fields'));
        }

        if (!$this->msie->checkValidityСatalog()) {
            return $this->modx->error->failure($this->modx->lexicon('msimportexport.err_invalid_catalog'));
        }

        $result = $this->msie->import($this->getProperty('filename'), $preset, $type, $seek, $key);


        $this->modx->cacheManager->refresh(array('system_settings' => array()));

        return $this->modx->error->success('', $result);
    }
}

return 'msImportExportImport';