<?php

class msImportExportImportSettings extends modProcessor
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

        $this->msie->setOption('msimportexport.delimeter', $this->getProperty('delimeter'), false);
        $this->msie->setOption('msimportexport.import.sub_delimeter', $this->getProperty('sub_delimeter'), false);
        $this->msie->setOption('msimportexport.import.sub_delimeter2', $this->getProperty('sub_delimeter2'), false);
        $this->msie->setOption('msimportexport.key', $this->getProperty('key'), false);
        $this->msie->setOption('msimportexport.import.id_parent_new_product', $this->getProperty('id_parent_new_product'), false);
        $this->msie->setOption('msimportexport.import.root_catalog', $this->getProperty('catalog'), false);

        $useOnlyRootCatalog = filter_var($this->getProperty('use_only_root_catalog'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.import.use_only_root_catalog', $useOnlyRootCatalog, false);

        $this->msie->setOption('msimportexport.time_limit', (int)$this->getProperty('time_limit'), false);
        $this->msie->setOption('msimportexport.memory_limit', (int)$this->getProperty('memory_limit'), false);
        $this->msie->setOption('msimportexport.import.template_category', (int)$this->getProperty('template_category'), false);
        $this->msie->setOption('msimportexport.import.step_limit', (int)$this->getProperty('step_limit'), false);

        $ignore_first_line = filter_var($this->getProperty('ignore_first_line'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.ignore_first_line', $ignore_first_line, false);

        $gallery_remove_before_import = filter_var($this->getProperty('gallery_remove_before_import'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.gallery.remove_before_import', $gallery_remove_before_import, false);

        $ignore_first_line = filter_var($this->getProperty('auto_set_field'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.import.auto_set_field', $ignore_first_line, false);

        $debug = filter_var($this->getProperty('debug'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.debug', $debug, false);

        $utf8Encode = filter_var($this->getProperty('utf8_encode'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.import.utf8_encode', $utf8Encode, false);

        $skip_empty_parent = filter_var($this->getProperty('skip_empty_parent'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.skip_empty_parent', $skip_empty_parent, false);

        $create_parent = filter_var($this->getProperty('create_parent'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.create_parent', $create_parent, false);

        $cron_log = filter_var($this->getProperty('cron_log'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.import.cron_log', $cron_log, false);

        $val = filter_var($this->getProperty('remove_link'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.import.remove_link', $val, false);

        $check_page_title = filter_var($this->getProperty('check_page_title'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.import.check_page_title', $check_page_title, false);

        $this->msie->setOption('msimportexport.import.path_php_interpreter', $this->getProperty('path_php_interpreter', ''), false);
        $this->msie->setOption('msimportexport.import.cron_file_path', $this->getProperty('cron_file_path', ''), false);
        $this->msie->setOption('msimportexport.import.msop_remove_modification', $this->getProperty('msop_remove_modification'), false);
        $this->msie->setOption('msimportexport.import.msop_disable_modification', $this->getProperty('msop_disable_modification'), false);
        $this->msie->setOption('msimportexport.import.msoc_disable_color', $this->getProperty('msoc_disable_color'), false);
        $this->msie->setOption('msimportexport.import.msoc_remove_color', $this->getProperty('msoc_remove_color'), false);
        $this->msie->setOption('msimportexport.import.mssp_remove', $this->getProperty('mssp_remove'), false);
        $this->msie->setOption('msimportexport.import.mspr_remove', $this->getProperty('mspr_remove'), false);
        $this->msie->setOption('msimportexport.import.ctx', $this->getProperty('context'), false);
        $this->msie->setOption('msimportexport.import.text_format_method', $this->getProperty('text_format_method'), false);
        $this->msie->setOption('msimportexport.import.text_format_fields', $this->getProperty('text_format_fields'), false);
        $this->msie->setOption('msimportexport.gallery.class_name', $this->getProperty('gallery_class_name'), false);
        $this->msie->setOption('msimportexport.import.image_base_path', $this->getProperty('gallery_image_base_path', ''), false);


        $fields = $this->getProperty('fields') ? $this->getProperty('fields') : array();
        $preset = $this->getProperty('preset') ? $this->getProperty('preset') : 0;

        if ($fields && $arrFields = $this->msie->checkValidityFields($fields)) {
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

        if ($fields && $preset) {
            $this->msie->setPresetFields($preset, $fields);
        }


        $this->modx->cacheManager->refresh(array('system_settings' => array()));

        return $this->modx->error->success('', array(
            'memory_limit' => ini_get('memory_limit'),
            'timeout' => ini_get('max_execution_time'),
        ));
    }
}

return 'msImportExportImportSettings';




