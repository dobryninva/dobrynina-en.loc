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
        return 'import';
    }
}


class msImportExportImportManagerController extends MsieMainController
{
    public function getPageTitle()
    {
        return $this->modx->lexicon('msimportexport.page_title_import');
    }

    public function loadCustomCssJs()
    {

        $ms2 = $this->msie->getInstanceMiniShop2();


        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/misc/strftime-min-1.3.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/misc/search.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/misc/default.grid.js');

        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/vendor/highstock/highcharts.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/vendor/highstock/modules/exporting.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/cron.status.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/cron.grid.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/cron.panel.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/chart.panel.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/fields.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/gallery.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/ctx.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/import.type.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/text_format.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/keys.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/catalog.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/presets.grid.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/presets.window.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/presets.combo.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/resource.duplicate.grid.js');
        $this->addJavascript($this->msie->config['jsUrl'] . 'mgr/widgets/import.panel.js');
        $this->addLastJavascript($this->msie->config['jsUrl'] . 'mgr/sections/import.js');

        $this->addCss($this->msie->config['cssUrl'] . 'mgr/main.css');
        $this->addCss($this->msie->config['cssUrl'] . 'mgr/bootstrap.buttons.css');
        $this->addCss($this->msie->config['assetsUrl'] . 'vendor/fontawesome/css/font-awesome.min.css');


        $phpInterpreter = $this->modx->getOption('msimportexport.import.path_php_interpreter', null, $this->msie->findPathPhpInterpreter(), true);
        $memoryLimit = filter_var(ini_get('memory_limit'), FILTER_SANITIZE_NUMBER_INT);
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
                xtype: "msie-page-import"
                ,options: {
                    delimeter: "' . $this->modx->getOption('msimportexport.delimeter', null, ';') . '"
                    ,ctx: "' . $this->modx->getOption('msimportexport.import.ctx', null, 'web') . '"
                    ,text_format_method: "' . $this->modx->getOption('msimportexport.import.text_format_method', null, 'nl2br') . '"
                    ,text_format_fields: "' . $this->modx->getOption('msimportexport.import.text_format_fields', null, '') . '"
                    ,sub_delimeter: "' . $this->modx->getOption('msimportexport.import.sub_delimeter', null, '|') . '"
                    ,sub_delimeter2: "' . $this->modx->getOption('msimportexport.import.sub_delimeter2', null, '%') . '"
                    ,time_limit: "' . (int)$this->modx->getOption('msimportexport.time_limit', null, 600) . '"
                    ,memory_limit: "' . (int)$this->modx->getOption('msimportexport.memory_limit', null, $memoryLimit, true) . '"
                    ,step_limit: "' . (int)$this->modx->getOption('msimportexport.import.step_limit', null, 50) . '"
                    ,ignore_first_line: "' . (int)$this->modx->getOption('msimportexport.ignore_first_line', null, 0) . '"
                    ,auto_set_field: "' . (int)$this->modx->getOption('msimportexport.import.auto_set_field', null, 0) . '"
                    ,template_category: "' . (int)$this->modx->getOption('msimportexport.import.template_category', null, 0) . '"
                    ,id_parent_new_product: "' . (int)$this->modx->getOption('msimportexport.import.id_parent_new_product', null, 0) . '"
                    ,key: "' . $this->modx->getOption('msimportexport.key', null, 'article') . '"
                    ,gallery_image_base_path: "' . $this->modx->getOption('msimportexport.import.image_base_path', null, MODX_BASE_PATH, true) . '"
                    ,gallery_class_name: "' . $this->modx->getOption('msimportexport.gallery.class_name', null, 'msProductFile') . '"
                    ,gallery_remove_before_import: "' . (int)$this->modx->getOption('msimportexport.gallery.remove_before_import', null, 0) . '"
                    ,catalog: "' . $this->modx->getOption('msimportexport.import.root_catalog', null, '') . '"
                    ,use_only_root_catalog: "' . $this->modx->getOption('msimportexport.import.use_only_root_catalog', null, 0) . '"
                    ,debug: ' . (int)$this->modx->getOption('msimportexport.debug', null, 0) . '
                    ,remove_link: ' . (int)$this->modx->getOption('msimportexport.import.remove_link', null, 0) . '
                    ,chartShow: ' . (int)$this->modx->getOption('msimportexport.import.report_chart', null, 1) . '
                    ,utf8_encode: ' . (int)$this->modx->getOption('msimportexport.import.utf8_encode', null, 0) . '
                    ,skip_empty_parent: ' . (int)$this->modx->getOption('msimportexport.skip_empty_parent', null, 1) . '
                    ,create_parent: ' . (int)$this->modx->getOption('msimportexport.create_parent', null, 1) . '
                    ,check_page_title: ' . (int)$this->modx->getOption('msimportexport.import.check_page_title', null, 0) . '
                    ,msop_remove_modification: ' . (int)$this->modx->getOption('msimportexport.import.msop_remove_modification', null, 0) . '
                    ,msop_disable_modification: ' . (int)$this->modx->getOption('msimportexport.import.msop_disable_modification', null, 0) . '
                    ,msoc_disable_color: ' . (int)$this->modx->getOption('msimportexport.import.msoc_disable_color', null, 0) . '
                    ,msoc_remove_color: ' . (int)$this->modx->getOption('msimportexport.import.msoc_remove_color', null, 0) . '
                    ,mspr_remove: ' . (int)$this->modx->getOption('msimportexport.import.mspr_remove', null, 0) . '
                    ,mssp_remove: ' . (int)$this->modx->getOption('msimportexport.import.mssp_remove', null, 0) . '
                    ,cron_log: ' . (int)$this->modx->getOption('msimportexport.import.cron_log', null, 0) . '
                    ,cron_wait: ' . $this->modx->getOption('msimportexport.cron_wait', null, 0, true) . '
                    ,path_php_interpreter: "' . $phpInterpreter . '"
                }
            });
        });
        // ]]>
        </script>');

        $this->modx->invokeEvent('msieOnManagerCustomCssJs', array('controller' => &$this, 'mode' => Msie::MODE_IMPORT));
    }

    public function getTemplateFile()
    {
        return $this->msie->config['templatesPath'] . 'mgr/import.tpl';
    }

    public function getLanguageTopics()
    {
        return array('msimportexport:default');
    }
}