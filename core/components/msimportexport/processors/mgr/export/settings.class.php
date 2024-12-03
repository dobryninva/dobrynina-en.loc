<?php

class msImportExportExportSettings extends modProcessor
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

        $this->msie->setOption('msimportexport.export.depth', (int)$this->getProperty('depth', 10), false);


        $this->msie->setOption('msimportexport.export.limit', (int)$this->getProperty('limit', 0), false);

        $debug = filter_var($this->getProperty('debug'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.export.debug', $debug, false);
        $this->msie->setOption('msimportexport.export.where', $this->getProperty('where', ''), false);
        $this->msie->setOption('msimportexport.export_thumb_settings', $this->getProperty('thumb_settings', ''), false);
        $this->msie->setOption('msimportexport.export.ctx', $this->getProperty('context', ''), false);
        $this->msie->setOption('msimportexport.gallery.class_name', $this->getProperty('gallery_class_name', ''), false);

        $val = filter_var($this->getProperty('gallery_copy_image'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.gallery.copy_image', $val, false);

        $val = filter_var($this->getProperty('gallery_zip'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.gallery.zip', $val, false);

        $val = filter_var($this->getProperty('gallery_clear_dir'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.gallery.clear_dir', $val, false);

        $this->msie->setOption('msimportexport.gallery.copy_image_path', $this->getProperty('gallery_copy_image_path', ''), false);

        /**
         * CSV Файл
         */

        if (!empty($this->getProperty('delimeter'))) {
            $this->msie->setOption('msimportexport.export.delimeter', $this->getProperty('delimeter', ''), false);
        }

        if (!empty($this->getProperty('sub_delimeter'))) {
            $this->msie->setOption('msimportexport.export.sub_delimeter', $this->getProperty('sub_delimeter', ''), false);
        }

        $head = filter_var($this->getProperty('head'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.export.head', $head, false);

        $scheme = filter_var($this->getProperty('image_scheme'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.export.image_scheme', $scheme, false);

        $convert_date = filter_var($this->getProperty('convert_date'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msimportexport.export.convert_date', $convert_date, false);

        $column_auto_size = filter_var($this->getProperty('column_auto_size'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        $this->msie->setOption('msieimport.export.column_auto_size', $column_auto_size, false);

        $this->msie->setOption('msimportexport.export.format_date', $this->getProperty('format_date'), false);


        /**
         * Excel Файл
         */


        // $excel_format_data = filter_var($this->getProperty('excel_format_data'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        // $this->msie->setOption('msimportexport.export.excel_format_data', $excel_format_data, false);

        // $excel_insert_img = filter_var($this->getProperty('excel_insert_img'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        // $this->msie->setOption('msimportexport.export.excel_insert_img', $excel_insert_img, false);

        //$this->msie->setOption('msimportexport.export.excel_height_img', $this->getProperty('excel_height_img'), false);

        $fields = $this->getProperty('fields') ? $this->getProperty('fields') : array();
        $preset = $this->getProperty('preset') ? $this->getProperty('preset') : 0;

        if ($fields && $preset) {
            $this->msie->setPresetFields($preset, $fields);
        }

        /**
         * Яндекс.Маркет
         */

        $this->msie->setOption('msimportexport.export.ym.pickup_field', $this->getProperty('ym_pickup_field', ''), false);
        $this->msie->setOption('msimportexport.export.ym.in_stock_field', $this->getProperty('ym_in_stock_field', ''), false);
        $this->msie->setOption('msimportexport.export.ym.delivery_field', $this->getProperty('ym_delivery_field', ''), false);
        $this->msie->setOption('msimportexport.export.ym.sales_notes_field', $this->getProperty('ym_sales_notes_field', ''), false);
        $this->msie->setOption('msimportexport.export.ym.currency_rate', $this->getProperty('ym_currency_rate', ''), false);
        $this->msie->setOption('msimportexport.export.ym.default_currency', $this->getProperty('ym_default_currency', ''), false);
        $this->msie->setOption('msimportexport.export.ym.currencies', $this->getProperty('ym_currencies', ''), false);
        $this->msie->setOption('msimportexport.export.ym.company', $this->getProperty('ym_company', ''), false);
        $this->msie->setOption('msimportexport.export.ym.name', $this->getProperty('ym_name', ''), false);

        $this->modx->cacheManager->refresh(array('system_settings' => array()));

        return $this->modx->error->success('');
    }
}

return 'msImportExportExportSettings';


