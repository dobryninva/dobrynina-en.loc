<?php
include_once MODX_CORE_PATH . 'components/minishop2/processors/mgr/product/create.class.php';

class msImportExportResourceCreateProcessor extends msProductCreateProcessor
{

    /*public static function getInstance(modX &$modx, $className, $properties = array())
    {
        $className = __CLASS__;
        $processor = new $className($modx, $properties);
        return $processor;
    }

    public function checkPermissions()
    {
        return true;
    }*/

}

return 'msImportExportResourceCreateProcessor';
