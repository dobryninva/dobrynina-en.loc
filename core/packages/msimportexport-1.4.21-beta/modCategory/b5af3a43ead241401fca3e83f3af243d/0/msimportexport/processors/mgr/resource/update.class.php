<?php
include_once MODX_CORE_PATH . 'components/minishop2/processors/mgr/product/update.class.php';

class msImportExportResourceUpdateProcessor extends msProductUpdateProcessor
{


    /**
     * Allow for Resources to use derivative classes for their processors
     *
     * @static
     * @param modX $modx
     * @param string $className
     * @param array $properties
     * @return modProcessor
     */
    public static function getInstance(modX &$modx, $className, $properties = array())
    {
        $processor = new msImportExportResourceUpdateProcessor($modx, $properties);
        return $processor;
    }

    /**
     * Set any Template Variables passed to the Resource. You must pass "tvs" as 1 or true to initiate these checks.
     * @return array|mixed
     */
    public function saveTemplateVariables()
    {
        $tvs = $this->getProperty('tvs', null);
        if (!empty($tvs)) {
            $tmplvars = array();

            $tvs = $this->object->getTemplateVars();
            /** @var modTemplateVar $tv */
            foreach ($tvs as $tv) {
                if (!$tv->checkResourceGroupAccess()) {
                    continue;
                }

                $tvKey = 'tv' . $tv->get('id');
                $value = $this->getProperty($tvKey, null);
                /* set value of TV */
                if ($tv->get('type') != 'checkbox') {
                    $value = $value !== null ? $value : $tv->get('default_text');
                } else {
                    $value = $value ? $value : null;
                }
                /* validation for different types */
                switch ($tv->get('type')) {
                    case 'url':
                        $prefix = $this->getProperty($tvKey . '_prefix', '');
                        if ($prefix != '--') {
                            $value = str_replace(array('ftp://', 'http://'), '', $value);
                            $value = $prefix . $value;
                        }
                        break;
                    case 'date':
                        $value = empty($value) ? '' : strftime('%Y-%m-%d %H:%M:%S', strtotime($value));
                        break;
                    /* ensure tag types trim whitespace from tags */
                    case 'tag':
                    case 'autotag':
                        $tags = explode(',', $value);
                        $newTags = array();
                        foreach ($tags as $tag) {
                            $newTags[] = trim($tag);
                        }
                        $value = implode(',', $newTags);
                        break;
                    default:
                        /* handles checkboxes & multiple selects elements */
                        if (is_array($value)) {
                            $featureInsert = array();
                            while (list($featureValue, $featureItem) = each($value)) {
                                if (empty($featureItem)) {
                                    continue;
                                }
                                $featureInsert[count($featureInsert)] = $featureItem;
                            }
                            $value = implode('||', $featureInsert);
                        }
                        break;
                }

                /* if different than default and set, set TVR record */
                $default = $tv->processBindings($tv->get('default_text'), $this->object->get('id'));
                if ($value !== null && strcmp($value, $default) != 0) {
                    /* update the existing record */
                    $tvc = $this->modx->getObject('modTemplateVarResource', array(
                        'tmplvarid' => $tv->get('id'),
                        'contentid' => $this->object->get('id'),
                    ));
                    if ($tvc == null) {
                        /** @var modTemplateVarResource $tvc add a new record */
                        $tvc = $this->modx->newObject('modTemplateVarResource');
                        $tvc->set('tmplvarid', $tv->get('id'));
                        $tvc->set('contentid', $this->object->get('id'));
                    }
                    $tvc->set('value', $value);
                    $tvc->save();
                } else if ($this->getProperty($tvKey, null) !== null) {
                    $tvc = $this->modx->getObject('modTemplateVarResource', array(
                        'tmplvarid' => $tv->get('id'),
                        'contentid' => $this->object->get('id'),
                    ));
                    if (!empty($tvc)) {
                        $tvc->set('value', '');
                        $tvc->save();
                    }
                }
            }
        }
        return $tvs;
    }

}

return 'msImportExportResourceUpdateProcessor';
