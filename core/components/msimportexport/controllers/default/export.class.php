<?php
/**
 * Copyright 2015 by Prihod <prihod2004@gmail.com>
 *
 * @package msimportexport
 */
/**
 * Loads the build page.
 *
 * @package msimportexport
 * @subpackage controllers
 */

require_once dirname(dirname(dirname(__FILE__))) . '/index.class.php';


class ControllersMgrImportManagerController extends MsieMainController
{
    public static function getDefaultController()
    {
        return 'export';
    }
}


class msImportExportExportManagerController extends MsieMainController
{
    public function getPageTitle()
    {
        return $this->modx->lexicon('msimportexport.page_title_export');
    }

    public function loadCustomCssJs()
    {
        $mgrUrl = $this->modx->getOption('manager_url', null, MODX_MANAGER_URL);

        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/misc/strftime-min-1.3.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/misc/search.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/misc/default.grid.js');

        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.ym_params.grid.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.currency_default.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.fields.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.type.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/ctx.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/gallery.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.currency_rate.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.format.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/presets.grid.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/alias.grid.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/presets.window.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/presets.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/category.tree.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.settings.panel.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/export.panel.js');
        $this->addLastJavascript($this->msie->config['jsUrl'] . 'mgr/sections/export.js');

        $this->addCss($this->msie->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->msie->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addCss($this->msie->config['assetsUrl'] . 'vendor/fontawesome/css/font-awesome.min.css');


        $ymName = $this->msie->modx->getOption('msimportexport.export.ym.name', null, '');
        $ymCompany = $this->modx->getOption('msimportexport.export.ym.company', null, '');
        $ymName = $ymName ? $ymName : $this->msie->modx->getOption('site_name', null, '');
        $ymCompany = $ymCompany ? $ymCompany : $ymName;
        $paramFields = $this->msie->strOption2Arr('msimportexport.export.ym.param_fields');
        $settings = array(
            'isPemain' => $this->msie->hasPlugin('msproductremains'),
            'isOptionsPrice2' => $this->msie->hasPlugin('msoptionsprice'),
            'isMS2Gallery' => $this->msie->hasPlugin('ms2gallery'),
            'isOptionsColor' => $this->msie->hasPlugin('msoptionscolor'),
            'isSalePrice' => $this->msie->hasPlugin('mssaleprice'),
        );
        $this->addHtml('<script type="text/javascript">
        // <![CDATA[
        Ext.onReady(function() {
            Msie.config["settings"] = ' . $this->modx->toJSON($settings) . ';
            MODx.load({
                xtype: "msie-page-export"
                ,options: {
                    delimeter: "' . $this->modx->getOption('msimportexport.export.delimeter', null, ';') . '"
                    ,sub_delimeter: "' . $this->modx->getOption('msimportexport.export.sub_delimeter', null, '') . '"
                    ,where: "' . addslashes($this->modx->getOption('msimportexport.export.where', null, '')) . '"
                    ,thumb_settings: "' . addslashes($this->modx->getOption('msimportexport.export_thumb_settings', null, '{"thumb":"small","width":150}')) . '"
                    ,debug: ' . $this->modx->getOption('msimportexport.export.debug', null, 0) . '
                    ,depth: ' . $this->modx->getOption('msimportexport.export.depth', null, 0) . '
                    ,limit: ' . $this->modx->getOption('msimportexport.export.limit', null, 0) . '
                    ,columnAutoAize: ' . $this->modx->getOption('msieimport.export.column_auto_size', null, 0, true) . '
                    ,head: ' . $this->modx->getOption('msimportexport.export.head', null, 0) . '
                    ,imageScheme: ' . $this->modx->getOption('msimportexport.export.image_scheme', null, 0) . '
                    ,convert_date: ' . $this->modx->getOption('msimportexport.export.convert_date', null, 0) . '
                    ,ctx: "' . $this->modx->getOption('msimportexport.export.ctx', null, 'web') . '"
                    ,gallery_copy_image: ' . $this->modx->getOption('msimportexport.gallery.copy_image', null, 0) . '
                    ,gallery_copy_image_path: "' . addslashes($this->modx->getOption('msimportexport.gallery.copy_image_path', null, 'assets/msie_gallery/')) . '"
                    ,gallery_zip: ' . $this->modx->getOption('msimportexport.gallery.zip', null, 0) . '
                    ,gallery_clear_dir: ' . $this->modx->getOption('msimportexport.gallery.clear_dir', null, 1) . '
                    ,format_date: "' . addslashes($this->modx->getOption('msimportexport.export.format_date', null, '%m/%d/%Y %T')) . '"
                    ,gallery_class_name: "' . addslashes($this->modx->getOption('msimportexport.gallery.class_name', null, 'msProductFile')) . '"
                    ,ym: {
                        name: "' . addslashes($ymName) . '"
                        ,company: "' . addslashes($ymCompany) . '"
                        ,delivery_field: "' . $this->modx->getOption('msimportexport.export.ym.delivery_field', null, '') . '"
                        ,in_stock_field: "' . $this->modx->getOption('msimportexport.export.ym.in_stock_field', null, '') . '"
                        ,pickup_field: "' . $this->modx->getOption('msimportexport.export.ym.pickup_field', null, '') . '"
                        ,sales_notes_field: "' . $this->modx->getOption('msimportexport.export.ym.sales_notes_field', null, '') . '"
                        ,default_currency: "' . $this->modx->getOption('msimportexport.export.ym.default_currency', null, '') . '"
                        ,currency_rate: "' . $this->modx->getOption('msimportexport.export.ym.currency_rate', null, '') . '"
                        ,currencies: "' . $this->modx->getOption('msimportexport.export.ym.currencies', null, '') . '"
                        ,param_fields: ' . $this->modx->toJSON($paramFields) . '
                    }
                }
            });
        });
        // ]]>
        </script>');

        $this->modx->invokeEvent('msieOnManagerCustomCssJs', array('controller' => &$this, 'mode' => Msie::MODE_EXPORT));

    }

    public function getTemplateFile()
    {
        return $this->msie->config['templatesPath'] . 'mgr/export.tpl';
    }

    public function getLanguageTopics()
    {
        return array('msimportexport:default');
    }
}