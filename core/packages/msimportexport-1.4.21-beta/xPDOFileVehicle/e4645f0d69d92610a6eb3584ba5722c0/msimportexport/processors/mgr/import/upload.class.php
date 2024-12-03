<?php
class msImportExportUpload extends modProcessor
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
        $steps = 0;
        $fields = array();
        $this->msie->clearUploadDir();
        if (!$_FILES['file']) {
            return $this->modx->error->failure($this->modx->lexicon('msimportexport.err.ns_file'));
        }

        $filename = str_replace(' ', '_', $_FILES['file']['name']);
        $file = $this->msie->config['uploadPath'] . $filename;

        if (!move_uploaded_file($_FILES['file']['tmp_name'], $file)) {
            return $this->modx->error->failure($this->modx->lexicon('msimportexport.err_upload'));
        }

        $this->msie->cp1251ToUtf8($file);

        if (!$reader = $this->msie->getReader($file)) {
            return $this->modx->error->failure($this->modx->lexicon('msimportexport.err.reader'));
        }

        $reader->read(array(
            'file' => $file,
            'seek' => 0,
        ), function ($reader, $data) use (& $fields) {
            $fields = $data;
            return false;
        });


        if (!empty($fields)) {
            $fields = array_map('strip_tags', $fields);
        }

        return $this->modx->error->success('', array(
            'filename' => $filename,
            'fields' => $fields,
            'steps' => $steps,
            'memory_limit' => ini_get('memory_limit'),
            'timeout' => ini_get('max_execution_time'),
            'phpversion' => phpversion(),
        ));
    }
}

return 'msImportExportUpload';






