<?php

class msImportExportCronRun extends modProcessor
{
    /** @var Msie $msie */
    public $msie;

    public function initialize()
    {
        $this->msie = $this->modx->getService('msimportexport', 'Msie', $this->modx->getOption('msimportexport.core_path', null, $this->modx->getOption('core_path') . 'components/msimportexport/') . 'model/msimportexport/', array());
        $this->modx->lexicon->load('msimportexport:default');
        return parent::initialize();
    }

    public function process()
    {
        $preset = $this->getProperty('preset') ? $this->getProperty('preset') : 0;

        if (empty($this->getProperty('cron_file_path'))) {
            $this->modx->error->addField('cron_file_path', $this->modx->lexicon('msimportexport.err.err_ns'));
            return $this->modx->error->failure();
        }

        if (empty($preset)) {
            return $this->modx->error->failure(sprintf($this->modx->lexicon('msimportexport.err.ns_preset'), $preset));
        }

        if (!$file = $this->msie->loadImportFile($this->getProperty('cron_file_path'))) {
            return $this->modx->error->failure(sprintf($this->modx->lexicon('msimportexport.err_open_file'), $file));
        }

        $cron_log = filter_var($this->getProperty('cron_log'), FILTER_VALIDATE_BOOLEAN) ? 1 : 0;

        if (!$this->msie->checkValidityСatalog()) {
            return $this->modx->error->failure($this->modx->lexicon('msimportexport.err_invalid_catalog'));
        }

        $result = $this->msie->import($file, $preset, $this->getProperty('import_type'), $cron_log);
        $report = '';
        if ($result) {
            $report .= '<h3>' . $this->modx->lexicon('msimportexport.result.report') . '</h3>';
            $report .= '<p>';
            $report .= $this->modx->lexicon('msimportexport.result.errors') . ' <a href="/manager/?a=system/event" target="_blank">' . $result['errors'].'</a><br>';
            $report .= $this->modx->lexicon('msimportexport.result.created') . ' ' . $result['create'] . '<br>';
            $report .= $this->modx->lexicon('msimportexport.result.updated') . ' ' . $result['update'] . '<br>';
            $report .= $this->modx->lexicon('msimportexport.result.rows') . ' ' . $result['rows'];
            $report .= '</p>';
            if (isset($result['uri'])) {
                $report .= '<h3>' . $this->modx->lexicon('msimportexport.result.report.uri') . '</h3>';
                $report .= '<p>';
                $report .= $this->modx->lexicon('msimportexport.result.report.uri.total_duplicate') . ' ' . $result['uri']['total'] . '<br>';
                $report .= $this->modx->lexicon('msimportexport.result.report.uri.success') . ' ' . $result['uri']['success'] . '<br>';
                $report .= $this->modx->lexicon('msimportexport.result.report.uri.failed') . ' ' . $result['uri']['failed'];
                $report .= '</p>';
            }
        }

        return $this->modx->error->success($report);
    }
}

return 'msImportExportCronRun';











