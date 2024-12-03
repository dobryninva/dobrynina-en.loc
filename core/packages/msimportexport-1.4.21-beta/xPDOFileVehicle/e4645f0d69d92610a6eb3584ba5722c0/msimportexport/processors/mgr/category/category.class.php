<?php
require_once MODX_CORE_PATH . 'components/msimportexport/model/msimportexport/msie.class.php';

class msImportExportCategoryProcessor extends modObjectCreateProcessor
{
    /** @var Msie $msie */
    private $msie;
    public $checkListPermission = true;

    /** {@inheritDoc} */
    public function initialize()
    {
        $this->msie = new Msie($this->modx);
        return true;
    }


    /** {@inheritDoc} */
    public function process()
    {
        $parents = '';
        $preset = null;
        $presetId = $this->getProperty('preset', 0);
        if ($presetId) {
            if ($preset = $this->modx->getObject('MsiePresetsFields', $presetId)) {
                $parents = $preset->get('categories');
            }
        } else {
            $parents = $this->modx->getOption('msimportexport.export.parents', null, '');
        }


        $categories = array_map('trim', explode(',', $parents));
        $cid = $this->getProperty('category_id');
        if ($cid > 0) {
            $key = array_search($cid, $categories);
            if ($key !== false) {
                unset($categories[$key]);
            } else {
                $categories[] = $cid;
            }
            $categories = array_diff($categories, array(''));
            $categories = implode(',', $categories);

            if ($preset) {
                $preset->set('categories', $categories);
                $preset->save();
            } else {
                $this->msie->setOption('msimportexport.export.parents', $categories);
            }
        }
        return $this->success('');
    }

}

return 'msImportExportCategoryProcessor';