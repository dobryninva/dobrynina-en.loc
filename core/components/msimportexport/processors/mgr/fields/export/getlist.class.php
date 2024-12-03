<?php
require_once(dirname(dirname(__FILE__)) . '/getlist.class.php');

class msImportExportGetListExportProcessor extends msImportExportGetListProcessor
{

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
        $type = $type ? $type : $this->getProperty('type', '');
        $exclude = array_map('trim', explode(',', $this->modx->getOption('msimportexport.export.exclude_fields', '')));
        switch ($type) {
            case 'pemains':
                $fields = array_merge(
                    $this->getResourceFields('product_', ' (Product)', array('id', 'pagetitle')),
                    $this->getProductFields('data_', ' (Product)'),
                    $this->getRemainsFields('mspr_', ' (msProductRemains)')
                );
                break;
            case 'options_price2':
                $fields = array_merge(
                    $this->getResourceFields('product_', ' (Product)'),
                    $this->getProductFields('data_', ' (Product)'),
                    $this->getOptions('', ' (Option)'),
                    $this->getOptionsPrice2Fields('msopm_', ' (msOptionsPrice2)'),
                    $this->buildFields(array('color', 'size'), 'msopo_', ' (msOptionsPrice2)'),
                    $this->getOptions('msopo_', ' (msOptionsPrice2)'),
                    $this->getCustomFields('msopo_', ' (msOptionsPrice2)'),
                    array(
                        'msopm_image_path' => $this->modx->lexicon('msoptionsprice_msopm_image_path'),
                        'msopm_image_url' => $this->modx->lexicon('msoptionsprice_msopm_image_url'),
                    )
                );
                break;
            case 'categories':
                $fields = array(
                    'parents' => $this->modx->lexicon('msimportexport.combo.field_track'),
                );
                $fields = array_merge(
                    $fields,
                    $this->getResourceFields(),
                    $this->getTVs('tv.', ' (TV)')
                );
                break;
            case 'options_color':
                $fields = array_merge(
                    $this->getResourceFields('product_', ' (Product)', array('id', 'pagetitle')),
                    $this->getProductFields('data_', ' (Product)'),
                    $this->getOptionsColorFields('msoc_', ' (msOptionsColor)')
                );
                break;
            case 'sale_price':
                $fields = array_merge(
                    $this->getResourceFields('product_', ' (Product)', array('id', 'pagetitle')),
                    $this->getProductFields('data_', ' (Product)'),
                    $this->getSalePriceFields('mssp_', ' (msSalePrice)')
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
            default:
                $fields = array(
                    'categories' => $this->modx->lexicon('msimportexport.combo.field_сategories'),
                    'parents' => $this->modx->lexicon('msimportexport.combo.field_track'),
                    'category.pagetitle' => $this->modx->lexicon('msimportexport.combo.field_parent_title'),
                    'vendor.name' => $this->modx->lexicon('msimportexport.combo.field_vendor_name'),
                    'put_thumb' => $this->modx->lexicon('msimportexport.combo.field_put_thumb'),
                    'gallery' => $this->modx->lexicon('msimportexport.combo.field_gallery'),
                    'href' => $this->modx->lexicon('msimportexport.combo.field_href'),
                );

                if ($this->msie->hasPlugin('seopro')) {
                    $fields['seo_keywords'] = $this->modx->lexicon('msimportexport.combo.field_seo_keywords');
                }

                $fields = array_merge(
                    $fields,
                    $this->getResourceFields(),
                    $this->getProductFields(),
                    $this->getOptions('', ' (Option)'),
                    $this->getTVs('tv.', ' (TV)')
                );
        }
        $list = array();
        // $this->modx->log(modX::LOG_LEVEL_ERROR, print_r($fields, 1));
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
            array_unshift($list, array(
                'name' => $this->modx->lexicon('msimportexport.combo.field_ignore'),
                'val' => -1
            ));
            return $list;
        }
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
                $key = $prefix . $tv['name'];
                $tvs[$key] = (!empty($tv['caption']) ? $tv['caption'] : $tv['name']) . " - {$tv['name']}" . $postfix;
            }
        }
        return $tvs;
    }

}

return 'msImportExportGetListExportProcessor';