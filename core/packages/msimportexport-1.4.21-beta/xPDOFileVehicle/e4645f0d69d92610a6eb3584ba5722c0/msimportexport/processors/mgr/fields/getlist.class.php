<?php

class msImportExportGetListProcessor extends modObjectGetListProcessor
{
    public $languageTopics = array(
        'msimportexport:default',
        'minishop2:product',
        'resource',
        'msproductremains:manager',
        'msoptionsprice:manager',
        'msoptionscolor:manager',
        'mssaleprice:default',
    );
    public $checkListPermission = true;
    /** @var Msie $msie */
    public $msie;
    /** @var miniShop2 $miniShop2 */
    public $miniShop2;

    public $offLexicon = false;

    public function initialize()
    {
        $this->miniShop2 = $this->modx->getService('miniShop2');
        $this->msie = $this->modx->getService('Msie');
        return parent::initialize();
    }

    public function iterate(array $data = array())
    {
        $query = $this->getProperty('query', '');
        return $this->getFieldsList($query);
    }

    /**
     * @param string $query
     * @param string $type
     * @return array
     */
    public function getFieldsList($query = '', $type = '')
    {
        $insIgnoreField = true;
        $type = $type ? $type : $this->getProperty('type', '');
        $exclude = array_map('trim', explode(',', $this->modx->getOption('msimportexport.import.exclude_fields', '')));
        $key = $this->modx->getOption('msimportexport.key', null, 'article');

        switch ($type) {
            case 'pemains':
                $fields = array(
                    $key => $this->lexicon($key) . ' - ' . $key . ' (Product)'
                );
                $fields = array_merge(
                    $fields,
                    $this->getRemainsFields('mspr:', ' (msProductRemains)')
                );
                break;
            case 'options_price2':

                $fields = array(
                    $key => $this->lexicon($key) . ' - ' . $key . ' (Product)'
                );
                $fields = array_merge(
                    $fields,
                    $this->getOptionsPrice2Fields('msop:', ' (msOptionsPrice2)'),
                    $this->buildFields(array('color', 'size'), 'msop:', ' (msOptionsPrice2)'),
                    $this->getOptions('msop:', ' (msOptionsPrice2)'),
                    $this->getCustomFields('msop:', ' (msOptionsPrice2)')
                );
                break;
            case 'options_color':
                $fields = array(
                    $key => $this->lexicon($key) . ' - ' . $key . ' (Product)'
                );
                $fields = array_merge(
                    $fields,
                    //$this->getResourceFields('', ' (Product)', array('id', 'pagetitle')),
                    //$this->getProductFields('', ' (Product)'),
                    $this->getOptionsColorFields('msoc:', ' (msOptionsColor)')
                );
                break;
            case 'sale_price':
                $fields = array(
                    $key => $this->lexicon($key) . ' - ' . $key . ' (Product)'
                );
                $fields = array_merge(
                    $fields,
                    //$this->getResourceFields('', ' (Product)', array('id', 'pagetitle')),
                    //$this->getProductFields('', ' (Product)'),
                    $this->getSalePriceFields('mssp:', ' (msSalePrice)')
                );
                break;
            case 'update_products':
                $fields = $this->getProductFields();
                break;
            case 'categories':
                $fields = array_merge(
                    $this->getResourceFields(),
                    $this->getTVs('tv', ' (TV)')
                );
                break;
            case 'gallery':
                $fields = array_merge(
                    $this->getResourceFields('', ' (Product)', array('id', 'pagetitle')),
                    $this->getProductFields('', ' (Product)'),
                    $this->getGalleryFields('', ' (Gallery)')
                );
                break;
            case 'links':
                $fields = array_merge(
                    $this->getResourceFields('master_', '(Master product)', array('id', 'pagetitle')),
                    $this->getProductFields('master_', ' (Master product)'),
                    $this->getResourceFields('slave_', ' (Slave product)', array('id', 'pagetitle')),
                    $this->getProductFields('slave_', ' (Slave product)'),
                    $this->getLinkFields('', ' (Link)')
                );
                break;
            case 'keys':
                $insIgnoreField = false;
                $fields = array_merge(
                    $this->getResourceFields(),
                    $this->getProductFields()
                );
                break;
            case 'all':
                $this->offLexicon = true;
                return $this->getAllFields();
                break;
            default:
                $fields = array(
                    'categories' => $this->modx->lexicon('msimportexport.combo.field_сategories'),
                    'gallery' => $this->modx->lexicon('msimportexport.combo.field_gallery'),
                );

                if ($this->msie->hasPlugin('seopro')) {
                    $fields['seo_keywords'] = $this->modx->lexicon('msimportexport.combo.field_seo_keywords');
                }

                $fields = array_merge(
                    $fields,
                    $this->getResourceFields(),
                    $this->getProductFields(),
                    $this->getOptions('options-', ' (Option)'),
                    $this->getTVs('tv', ' (TV)')
                );

                if ($this->msie->hasPlugin('msoptionsprice')) {
                    $fields = array_merge(
                        $fields,
                        $this->getOptionsPrice2Fields('msop:', ' (msOptionsPrice2)'),
                        $this->getOptions('msop:', ' (msOptionsPrice2)'),
                        $this->getCustomFields('msop:', ' (msOptionsPrice2)')
                    );
                }
        }
        $list = array();
        if (!empty($fields)) {
            foreach ($fields as $k => $v) {
                if (!empty($query)) {
                    if (preg_match('/' . $query . '/', $k)) {
                        $list[] = array('name' => $v, 'val' => $k);
                    }
                } else {
                    if (!in_array($k, $exclude)) {
                        $list[] = array('name' => $v, 'val' => $k);
                    }
                }
                if (!empty($query) && empty($list)) {
                    $list[] = array('name' => $query, 'val' => $query);
                }
            }
            if ($insIgnoreField) {
                array_unshift($list, array(
                    'name' => $this->modx->lexicon('msimportexport.combo.field_ignore'),
                    'val' => -1
                ));
            }
            return $list;
        }
    }

    public function process()
    {
        $list = $this->iterate();
        $total = count($list);
        return $this->outputArray($list, $total);
    }

    public function lexicon($key)
    {
        $space = array('ms2_product_', 'resource_', 'msimportexport.combo.field_', 'msoptionsprice_tooltip_', 'mspr_');
        foreach ($space as $val) {
            $k = $val . $key;
            $str = $this->modx->lexicon($k);
            if ($str != $k) return $str;
        }
        return $key;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public
    function getOptions($prefix = '', $postfix = '', $only = array())
    {
        $option = array();
        if ($collection = $this->modx->getCollection('msOption')) {
            foreach ($collection as $resourceId => $resource) {
                $key = $prefix . $resource->get('key');
                $option[$key] = $resource->get('caption') . $postfix;
            }
        }
        return $option;
    }


    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public function getTVs($prefix = 'tv', $postfix = '', $only = array())
    {
        $tvs = array();
        if ($tvArr = $this->msie->getTVs()) {
            foreach ($tvArr as $tv) {
                if (!empty($only) && !in_array($tv['name'], $only)) continue;
                $key = $prefix . $tv['id'];
                $tvs[$key] = (!empty($tv['caption']) ? $tv['caption'] : $tv['name']) . " - {$tv['name']}" . $postfix;
            }
        }
        return $tvs;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public
    function getResourceFields($prefix = '', $postfix = '', $only = array())
    {
        $fields = array();
        if ($fds = array_keys($this->modx->getFields('modResource'))) {
            foreach ($fds as $k) {
                if (!empty($only) && !in_array($k, $only)) continue;
                $key = $prefix . $k;
                $fields[$key] = $this->offLexicon ? $k : $this->lexicon($k) . " - {$k}" . $postfix;
            }
        }
        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public
    function getProductFields($prefix = '', $postfix = '', $only = array())
    {
        $fields = array();
        if ($fds = array_keys($this->modx->getFields('msProductData'))) {
            foreach ($fds as $k) {
                if ($k != 'id') {
                    if (!empty($only) && !in_array($k, $only)) continue;
                    $key = $prefix . $k;
                    $fields[$key] = $this->offLexicon ? $k : $this->modx->lexicon('ms2_product_' . $k) . " - {$k}" . $postfix;
                }
            }
        }
        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public
    function getCustomFields($prefix = '', $postfix = '', $only = array())
    {
        $fields = array();
        $plugins = (array)$this->miniShop2->loadPlugins();
        foreach ($plugins as $field => $plugin) {
            if (!empty($plugin['xpdo_meta_map']['msProductData'])) {
                $fds = $plugin['xpdo_meta_map']['msProductData']['fields'];
                foreach ((array)$fds as $k => $v) {
                    if (!empty($only) && !in_array($k, $only)) continue;
                    $key = $prefix . $k;
                    $fields[$key] = $this->offLexicon ? $k : $this->modx->lexicon('ms2_product_' . $k) . " - {$k}" . $postfix;
                }
            }
        }
        return $fields;
    }

    /**
     * @param array $arr
     * @param string $prefix
     * @param string $postfix
     * @return array
     */
    public
    function buildFields($arr = array(), $prefix = '', $postfix = '')
    {
        $fields = array();
        foreach ($arr as $k) {
            $key = $prefix . $k;
            $fields[$key] = $this->offLexicon ? $k : $this->lexicon($k) . " - {$k}" . $postfix;
        }
        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public
    function getGalleryFields($prefix = '', $postfix = '', $only = array())
    {
        $fields = array();
        $className = $this->msie->getGalleryClassName();
        $only = $only ? $only : array('alt', 'name', 'description', 'add', 'file', 'url', 'source', 'rank', 'active');
        if ($fds = array_keys($this->modx->getFields($className))) {
            foreach ($fds as $k) {
                if (!empty($only) && !in_array($k, $only)) continue;
                $key = $prefix . $k;
                $fields[$key] = $k . $postfix;
            }
        }
        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public
    function getLinkFields($prefix = '', $postfix = '', $only = array())
    {
        $fields = array();
        if ($fds = array_keys($this->modx->getFields('msProductLink'))) {
            foreach ($fds as $k) {
                if (!empty($only) && !in_array($k, $only)) continue;
                $key = $prefix . $k;
                $fields[$key] = $k . $postfix;
            }
        }
        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $columns
     * @param bool $exclude
     * @return array
     */
    public function getRemainsFields($prefix = '', $postfix = '', $columns = array(), $exclude = false)
    {

        $fields = array();
        $this->msie->getInstanceProductRemains();
        $aColumns = array_map('trim', explode(',', $this->modx->getOption('mspr_options', null, '')));
        $aColumns = array_merge(
            $aColumns,
            $aColumns = array_keys($this->modx->getFields('msprRemains'))
        );
        if (!$exclude && !empty($columns)) {
            foreach ($columns as $column) {
                if (!in_array($column, $aColumns)) {
                    continue;
                }
                $fields[$prefix . $column] = $this->offLexicon ? $column : $this->lexicon($column) . " - {$column}" . $postfix;
            }
        } else {
            foreach ($aColumns as $k) {
                if ($exclude && in_array($k, $columns)) {
                    continue;
                } elseif (empty ($columns)) {
                    $fields[$prefix . $k] = $this->offLexicon ? $k : $this->lexicon($k) . " - {$k}" . $postfix;
                } elseif ($exclude || in_array($k, $columns)) {
                    $fields[$prefix . $k] = $this->offLexicon ? $k : $this->lexicon($k) . " - {$k}" . $postfix;
                } else {
                    continue;
                }
            }
        }

        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @param array $only
     * @return array
     */
    public function getOptionsPrice2Fields($prefix = '', $postfix = '', $only = array())
    {
        $fields = array();
        $fds = array('name', 'type', 'price', 'old_price', 'article', 'weight', 'count', 'image', 'size', 'color', 'tags');
        $fields[$prefix . 'active'] = $this->modx->lexicon('msimportexport.combo.field_op_active') . $postfix;
        foreach ($fds as $k) {
            if (!empty($only) && !in_array($k, $only)) continue;
            $key = $prefix . $k;
            $fields[$key] = $this->offLexicon ? $k : $this->modx->lexicon('msoptionsprice_tooltip_' . $k) . " - {$k}" . $postfix;
            //$fields[$key] = $this->lexicon($k) . $postfix;
        }
        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @return array
     */
    public function getOptionsColorFields($prefix = '', $postfix = '')
    {

        $fields = array();
        $exclude = array('rid', 'id');
        if ($fds = array_keys($this->modx->getFields('msocColor'))) {
            foreach ($fds as $k) {
                if (!in_array($k, $exclude)) {
                    $key = $prefix . $k;
                    $fields[$key] = $this->offLexicon ? $k : $this->modx->lexicon('msoptionscolor_' . $k) . " - {$k}" . $postfix;
                }
            }
        }
        return $fields;
    }

    /**
     * @param string $prefix
     * @param string $postfix
     * @return array
     */
    public function getSalePriceFields($prefix = '', $postfix = '')
    {

        $fields = array();
        $exclude = array('rid', 'id');
        $this->msie->getInstanceSalePrice();
        if ($fds = array_keys($this->modx->getFields('msspPrice'))) {
            foreach ($fds as $k) {
                if (!in_array($k, $exclude)) {
                    $key = $prefix . $k;
                    $fields[$key] = $this->offLexicon ? $k : $this->modx->lexicon('mssaleprice_' . $k) . " - {$k}" . $postfix;
                }
            }
        }
        return $fields;
    }


    public function getAllFields()
    {
        $fields = array(
            'categories' => $this->modx->lexicon('msimportexport.combo.field_сategories'),
            'gallery' => $this->modx->lexicon('msimportexport.combo.field_gallery'),
        );

        if ($this->msie->hasPlugin('seopro')) {
            $fields['seo_keywords'] = $this->modx->lexicon('msimportexport.combo.field_seo_keywords');
        }

        $fields = array_merge(
            $fields,
            $this->getResourceFields(),
            $this->getProductFields(),
            $this->getOptions('options-', ' (Option)'),
            $this->getTVs('tv', ' (TV)'),
            $this->getResourceFields('master_', '(Master product)', array('id', 'pagetitle')),
            $this->getProductFields('master_', ' (Master product)'),
            $this->getResourceFields('slave_', ' (Slave product)', array('id', 'pagetitle')),
            $this->getProductFields('slave_', ' (Slave product)'),
            $this->getLinkFields('', ' (Link)'),
            $this->getGalleryFields('', ' (Gallery)')
        );

        if ($this->msie->hasPlugin('msoptionsprice')) {
            $fields = array_merge(
                $fields,
                $this->getOptionsPrice2Fields('msop:', ' (msOptionsPrice2)'),
                $this->buildFields(array('color', 'size'), 'msop:', ' (msOptionsPrice2)'),
                $this->getOptions('msop:', ' (msOptionsPrice2)'),
                $this->getCustomFields('msop:', ' (msOptionsPrice2)')
            );
        }

        if ($this->msie->hasPlugin('msoptionscolor')) {
            $fields = array_merge(
                $fields,
                $this->getOptionsColorFields('msoc:', ' (msOptionsColor)')
            );
        }

        if ($this->msie->hasPlugin('mssaleprice')) {
            $fields = array_merge(
                $fields,
                $this->getSalePriceFields('mssp:', ' (msSalePrice)')
            );
        }
        if ($this->msie->hasPlugin('msproductremains')) {
            $fields = array_merge(
                $fields,
                $this->getRemainsFields('mspr:', ' (msProductRemains)')
            );
        }

        return $fields;

    }


}

return 'msImportExportGetListProcessor';