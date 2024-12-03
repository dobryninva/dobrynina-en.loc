<?php

/**
 * YandexMarket Class
 *
 * @package msimportexport
 */
class YandexMarket
{
    private $shop = array();
    private $currencies = array();
    private $categories = array();
    private $defaultCurrency;
    private $deliveryField;
    private $inStockField;
    private $salesNotesField;
    private $pickupField;
    private $paramsKey;
    private $offers = array();
    private $descriptionFields = array();
    private $fromCharset = 'utf-8';
    private $siteUrl;
    private $pictureUrl;
    private $eol = "\n";
    private $out = '';

    function __construct(Msie &$msie, array $config = array())
    {
        $this->msie =& $msie;
        $this->msie->modx->lexicon->load('minishop2:product');
        $this->siteUrl = MODX_URL_SCHEME . MODX_HTTP_HOST;
        $this->pictureUrl = $this->msie->modx->getOption('msimportexport.export.ym.add_picture_url', null, true) ? $this->siteUrl : '';
        $vers = $this->msie->modx->getVersionData();
        $name = $this->msie->modx->getOption('msimportexport.export.ym.name', null, '');
        $optionsPriceExtended = $this->msie->modx->getOption('msimportexport.export.ym.options_price_extended', null, false);
        $company = $this->msie->modx->getOption('msimportexport.export.ym.company', null, '');
        $name = $name ? $name : $this->msie->modx->getOption('site_name', null, '');
        $company = $company ? $company : $name;
        $config['optionsTv'] = array();
        $this->deliveryField = $this->msie->modx->getOption('msimportexport.export.ym.delivery_field', null, '');
        $this->pickupField = $this->msie->modx->getOption('msimportexport.export.ym.pickup_field', null, '');
        $this->inStockField = $this->msie->modx->getOption('msimportexport.export.ym.in_stock_field', null, '');
        $this->salesNotesField = $this->msie->modx->getOption('msimportexport.export.ym.sales_notes_field', null, '');
        $this->defaultCurrency = strtoupper($this->msie->modx->getOption('msimportexport.export.ym.default_currency', null, 'RUB'));
        $currencyRate = strtoupper($this->msie->modx->getOption('msimportexport.export.ym.currency_rate', null, 'CBRF'));
        $currencies = array_map('trim', explode(',', strtoupper($this->msie->modx->getOption('msimportexport.export.ym.currencies', null, ''))));
        $this->descriptionFields = array_map('trim', explode(',', $this->msie->modx->getOption('msimportexport.export.ym.description_fields', null, 'description,introtext,content', true)));
        $this->paramsKey = $this->msie->strOption2Arr('msimportexport.export.ym.param_fields');
        $isOptionsPrice = $this->msie->hasPlugin('msoptionsprice');

        if ($this->deliveryField) $config['optionsTv'][] = $this->deliveryField;
        if ($this->pickupField) $config['optionsTv'][] = $this->pickupField;
        if ($this->inStockField) $config['optionsTv'][] = $this->inStockField;
        if ($this->salesNotesField) $config['optionsTv'][] = $this->salesNotesField;

        foreach ($currencies as $currency) {
            if ($currency != $this->defaultCurrency) {
                $this->setCurrency($currency, $currencyRate);
            } else {
                $this->setCurrency($currency, 1);
            }
        }

        // shop
        $this->setShop('name', $name);
        $this->setShop('company', $company);
        $this->setShop('url', MODX_SITE_URL);
        $this->setShop('phone', $this->msie->modx->getOption('msimportexport.export.ym.phone', null, ''));
        $this->setShop('platform', 'MODX ' . $vers['code_name']);
        $this->setShop('version', $vers['full_version']);

        $this->setCategory($config['depth']);
        $fds = array('name', 'price', 'old_price', 'article', 'weight', 'count', 'image');

        while ($products = $this->msie->getProducts($config)) {
            //  $this->msie->modx->log(modX::LOG_LEVEL_ERROR, print_r($products, 1));
            $this->offers = array();
            foreach ($products as $product) {
                if ($isOptionsPrice) {
                    if ($modifications = $this->msie->modx->call('msopModification', 'getProductModification', array(&$this->msie->modx, $product['id']))) {
                        foreach ($modifications as $modification) {
                            $data = $product;
                            $data['id'] = $data['id'] . 'M' . $modification['id'];
                            foreach ($fds as $k) {
                                if (empty($modification[$k])) continue;
                                if ($k == 'name') {
                                    $data['pagetitle'] = $modification[$k];
                                }
                                if ($k == 'image') {
                                    if ($image = $this->msie->getImageProductModification($modification[$k])) {
                                        $data['image'] = $image;
                                    }
                                } else {
                                    $data[$k] = $modification[$k];
                                }
                            }
                            $data = array_merge(
                                $data,
                                $modification['options']
                            );
                            $this->setProductData($data, $product);
                        }
                    }
                    if ($optionsPriceExtended || empty($modifications)) {
                        $this->setProductData($product);
                    }
                } else {
                    $this->setProductData($product);
                }
            }
            $this->out .= $this->getOffersYml();
            $config['offset'] = $config['offset'] + $config['limit'];
        }
    }


    /**
     * @param array $product
     * @param array $mainProduct
     */
    public function setProductData($product, $mainProduct = array())
    {
        $params = array();
        $data = array();
        $data['param'] = array();

        // Атрибуты товарного предложения
        $data['id'] = $product['id'];
//				$data['type'] = 'vendor.model';
//				$data['bid'] = 10;
//				$data['cbid'] = 15;

        // Параметры товарного предложения
        $data['url'] = $this->siteUrl . '/' . $product['uri'];
        $data['price'] = $product['price'];
        $data['currencyId'] = $this->defaultCurrency;
        $data['categoryId'] = $product['parent'];
        $data['delivery'] = isset($product[$this->deliveryField]) ? filter_var($product[$this->deliveryField], FILTER_VALIDATE_BOOLEAN) : 'true';
        $data['available'] = isset($product[$this->inStockField]) ? filter_var($product[$this->inStockField], FILTER_VALIDATE_BOOLEAN) : true;

//				$data['local_delivery_cost'] = 100;
        $data['name'] = $product['pagetitle'];
        $data['vendor'] = $product['vendor.name'];
        $data['vendorCode'] = $product['vendor.id'];
        $data['country_of_origin'] = $product['vendor.country'];
        $data['model'] = isset($product['model']) ? $product['model'] : $product['article'];
        $data['description'] = $this->prepareDescription($product);

        if (!empty($mainProduct) && empty($data['description'])) {
            $data['description'] = $this->prepareDescription($mainProduct);
        }

        if ($this->salesNotesField && isset($product[$this->salesNotesField])) {
            if (is_array($product[$this->salesNotesField])) {
                $data['sales_notes'] = isset($product[$this->salesNotesField . '.value']) ? $product[$this->salesNotesField . '.value'] : '';
            } else {
                $data['sales_notes'] = $product[$this->salesNotesField];
            }
        }


        if (!empty($product['old_price']) && $product['old_price'] > 0) {
            $data['oldprice'] = $product['old_price'];
        }

        if ($picture = $this->preparePicture($product)) {
            $data['picture'] = $picture;
        }

        if ($this->pickupField && isset($product[$this->pickupField])) {
            $data['pickup'] = $product[$this->pickupField] ? 'true' : 'false';
        }

        foreach ($this->paramsKey as $k => $v) {
            if (isset($product[$k]) && !empty($product[$k])) {
                $unit = !empty($v) ? $v : '';
                $params[$k] = array(
                    'field' => $product[$k]
                , 'unit' => $unit
                );
            }
        }
        $data['param'] = $this->prepareOfferParams($params);


        $res = $this->msie->invokeEvent('msieOnBeforeExport', array(
            'to' => 'xml',
            'type' => 'products',
            'srcData' => $product,
            'destData' => $data,
            'skip' => false,
            'msie' => &$this,
        ));

        if (!$res['success']) {
            $this->modx->log(modX::LOG_LEVEL_ERROR, $res['message']);
            return;
        }

        if (empty($res['data']['skip'])) {
            $data = $res['data']['destData'];
        } else {
            return;
        }

        $this->setOffer($data);
    }

    public function preparePicture($product = array())
    {
        $picture = '';
        if (!empty($product['image'])) {
            if ($this->msie->isUrl($product['image'])) {
                $picture = $product['image'];
            } else {
                $picture = $this->pictureUrl . $product['image'];
            }
        }
        return $picture;
    }

    /**
     * @param array $product
     * @return string
     */
    public function prepareDescription($product = array())
    {
        foreach ($this->descriptionFields as $key) {
            if (isset($product[$key]) && !empty(trim($product[$key]))) {
                return strip_tags($product[$key]);
            }
        }
        return '';
    }


    public
    function getHeaderYml()
    {
        $yml = '<?xml version="1.0" encoding="windows-1251"?>' . $this->eol;
        $yml .= '<!DOCTYPE yml_catalog SYSTEM "shops.dtd">' . $this->eol;
        $yml .= '<yml_catalog date="' . date('Y-m-d H:i') . '">' . $this->eol;
        $yml .= '<shop>' . $this->eol;

        // информация о магазине
        $yml .= $this->array2Tag($this->shop);

        // валюты
        $yml .= '<currencies>' . $this->eol;
        foreach ($this->currencies as $currency) {
            $yml .= $this->getElement($currency, 'currency');
        }
        $yml .= '</currencies>' . $this->eol;

        // категории
        $yml .= '<categories>' . $this->eol;
        foreach ($this->categories as $category) {
            $category_name = $category['name'];
            unset($category['name']);
            $yml .= $this->getElement($category, 'category', $category_name);
        }
        $yml .= '</categories>' . $this->eol;
        // товарные предложения
        $yml .= '<offers>' . $this->eol;
        return $yml;
    }


    public
    function getOffersYml()
    {
        $yml = '';
        foreach ($this->offers as $offer) {
            $tags = $this->array2Tag($offer['data']);
            unset($offer['data']);
            if (isset($offer['param'])) {
                $tags .= $this->array2Param($offer['param']);
                unset($offer['param']);
            }
            $yml .= $this->getElement($offer, 'offer', $tags);
        }
        return $yml;
    }

    public
    function getFooterYml()
    {
        $yml = '';
        $yml .= '</offers>' . $this->eol;

        $yml .= '</shop>' . $this->eol;
        $yml .= '</yml_catalog>';

        return $yml;
    }


    public
    function getYml()
    {
        return $this->getHeaderYml() . $this->out . $this->getFooterYml();
    }

    /**
     * Формирование YML файла
     *
     * @return string
     */
    public
    function _getYml()
    {
        $yml = '<?xml version="1.0" encoding="windows-1251"?>' . $this->eol;
        $yml .= '<!DOCTYPE yml_catalog SYSTEM "shops.dtd">' . $this->eol;
        $yml .= '<yml_catalog date="' . date('Y-m-d H:i') . '">' . $this->eol;
        $yml .= '<shop>' . $this->eol;

        // информация о магазине
        $yml .= $this->array2Tag($this->shop);

        // валюты
        $yml .= '<currencies>' . $this->eol;
        foreach ($this->currencies as $currency) {
            $yml .= $this->getElement($currency, 'currency');
        }
        $yml .= '</currencies>' . $this->eol;

        // категории
        $yml .= '<categories>' . $this->eol;
        foreach ($this->categories as $category) {
            $category_name = $category['name'];
            unset($category['name']);
            $yml .= $this->getElement($category, 'category', $category_name);
        }
        $yml .= '</categories>' . $this->eol;

        // товарные предложения
        $yml .= '<offers>' . $this->eol;
        foreach ($this->offers as $offer) {
            $tags = $this->array2Tag($offer['data']);
            unset($offer['data']);
            if (isset($offer['param'])) {
                $tags .= $this->array2Param($offer['param']);
                unset($offer['param']);
            }
            $yml .= $this->getElement($offer, 'offer', $tags);
        }
        $yml .= '</offers>' . $this->eol;

        $yml .= '</shop>' . $this->eol;
        $yml .= '</yml_catalog>';

        return $yml;
    }

    /**
     * Формирование массива для элемента shop описывающего магазин
     *
     * @param string $name - Название элемента
     * @param string $value - Значение элемента
     */
    private
    function setShop($name, $value)
    {
        $allowed = array('name', 'company', 'url', 'phone', 'platform', 'version', 'agency', 'email');
        if (in_array($name, $allowed)) {
            $this->shop[$name] = $this->prepareField($value);
        }
    }

    /**
     * Категории товаров
     */
    private
    function setCategory($depth = 0)
    {
        $depth = !empty($depth) ? $depth : 1000;
        $parents = trim($this->msie->modx->getOption('msimportexport.export.parents', null, ''));
        if (empty($parents)) {
            $parents = $this->msie->getRootCategoryId();
        }
        $rows = $this->msie->getCategoryChildren($parents, $depth);
        foreach ($rows as $key => $v) {
            if ($v['parent'] > 0 && isset($rows[$v['parent']])) {
                $this->categories[$v['id']] = array(
                    'id' => $v['id'],
                    'parentId' => $v['parent'],
                    'name' => $this->prepareField($v['pagetitle'])
                );
            } else {
                $this->categories[$v['id']] = array(
                    'id' => $v['id'],
                    'name' => $this->prepareField($v['pagetitle'])
                );
            }
        }

        return true;
    }

    /**
     * Товарные предложения
     *
     * @param array $data - массив параметров товарного предложения
     */
    private
    function setOffer($data)
    {
        $offer = array();

        $attributes = array('id', 'type', 'available', 'bid', 'cbid', 'param');
        $attributes = array_intersect_key($data, array_flip($attributes));
        foreach ($attributes as $key => $value) {
            switch ($key) {
                case 'id':
                    $offer[$key] = $value;
                    break;
                case 'bid':
                case 'cbid':
                    $value = (int)$value;
                    if ($value > 0) {
                        $offer[$key] = $value;
                    }
                    break;

                case 'type':
                    if (in_array($value, array('vendor.model', 'book', 'audiobook', 'artist.title', 'tour', 'ticket', 'event-ticket'))) {
                        $offer['type'] = $value;
                    }
                    break;

                case 'available':
                    $offer['available'] = ($value ? 'true' : 'false');
                    break;

                case 'param':
                    if (is_array($value)) {
                        $offer['param'] = $value;
                    }
                    break;

                default:
                    break;
            }
        }

        $type = isset($offer['type']) ? $offer['type'] : '';

        $allowed_tags = array('url' => 0, 'buyurl' => 0, 'price' => 1, 'oldprice' => 0, 'wprice' => 0, 'currencyId' => 1, 'xCategory' => 0, 'categoryId' => 1, 'picture' => 0, 'store' => 0, 'pickup' => 0, 'delivery' => 0, 'deliveryIncluded' => 0, 'local_delivery_cost' => 0, 'orderingTime' => 0);

        if (!empty($data['model'])) $allowed_tags['model'] = 1;

        switch ($type) {
            case 'vendor.model':
                $allowed_tags = array_merge($allowed_tags, array('typePrefix' => 0, 'vendor' => 1, 'vendorCode' => 0, 'model' => 1, 'provider' => 0, 'tarifplan' => 0));
                break;

            case 'book':
                $allowed_tags = array_merge($allowed_tags, array('author' => 0, 'name' => 1, 'publisher' => 0, 'series' => 0, 'year' => 0, 'ISBN' => 0, 'volume' => 0, 'part' => 0, 'language' => 0, 'binding' => 0, 'page_extent' => 0, 'table_of_contents' => 0));
                break;

            case 'audiobook':
                $allowed_tags = array_merge($allowed_tags, array('author' => 0, 'name' => 1, 'publisher' => 0, 'series' => 0, 'year' => 0, 'ISBN' => 0, 'volume' => 0, 'part' => 0, 'language' => 0, 'table_of_contents' => 0, 'performed_by' => 0, 'performance_type' => 0, 'storage' => 0, 'format' => 0, 'recording_length' => 0));
                break;

            case 'artist.title':
                $allowed_tags = array_merge($allowed_tags, array('artist' => 0, 'title' => 1, 'year' => 0, 'media' => 0, 'starring' => 0, 'director' => 0, 'originalName' => 0, 'country' => 0));
                break;

            case 'tour':
                $allowed_tags = array_merge($allowed_tags, array('worldRegion' => 0, 'country' => 0, 'region' => 0, 'days' => 1, 'dataTour' => 0, 'name' => 1, 'hotel_stars' => 0, 'room' => 0, 'meal' => 0, 'included' => 1, 'transport' => 1, 'price_min' => 0, 'price_max' => 0, 'options' => 0));
                break;

            case 'event-ticket':
                $allowed_tags = array_merge($allowed_tags, array('name' => 1, 'place' => 1, 'hall' => 0, 'hall_part' => 0, 'date' => 1, 'is_premiere' => 0, 'is_kids' => 0));
                break;

            default:
                $allowed_tags = array_merge($allowed_tags, array('name' => 1, 'vendor' => 0, 'vendorCode' => 0));
                break;
        }

        $allowed_tags = array_merge($allowed_tags, array('aliases' => 0, 'additional' => 0, 'description' => 0, 'sales_notes' => 0, 'promo' => 0, 'manufacturer_warranty' => 0, 'country_of_origin' => 0, 'downloadable' => 0, 'adult' => 0, 'barcode' => 0));

        // $this->msie->modx->log(modX::LOG_LEVEL_ERROR, print_r($allowed_tags, 1));

        $required_tags = array_filter($allowed_tags);

        if (sizeof(array_intersect_key($data, $required_tags)) != sizeof($required_tags)) {
            return;
        }

        $data = array_intersect_key($data, $allowed_tags);
//		if (isset($data['tarifplan']) && !isset($data['provider'])) {
//			unset($data['tarifplan']);
//		}

        $allowed_tags = array_intersect_key($allowed_tags, $data);

        // Стандарт XML учитывает порядок следования элементов,
        // поэтому важно соблюдать его в соответствии с порядком описанным в DTD
        $offer['data'] = array();
        foreach ($allowed_tags as $key => $value) {
            $offer['data'][$key] = $this->prepareField($data[$key]);
        }

        $this->offers[] = $offer;
    }

    /**
     * Фрмирование элемента
     *
     * @param array $attributes
     * @param string $element_name
     * @param string $element_value
     * @return string
     */
    private
    function getElement($attributes, $element_name, $element_value = '')
    {
        $retval = '<' . $element_name . ' ';
        foreach ($attributes as $key => $value) {
            $retval .= $key . '="' . $value . '" ';
        }
        $retval .= $element_value ? '>' . $this->eol . $element_value . '</' . $element_name . '>' : '/>';
        $retval .= $this->eol;

        return $retval;
    }

    /**
     * Преобразование массива в теги
     *
     * @param array $tags
     * @return string
     */
    private
    function array2Tag($tags)
    {
        $retval = '';
        foreach ($tags as $key => $value) {
            $retval .= '<' . $key . '>' . $value . '</' . $key . '>' . $this->eol;
        }

        return $retval;
    }

    /**
     * Преобразование массива в теги параметров
     *
     * @param array $params
     * @return string
     */
    private
    function array2Param($params)
    {
        $retval = '';
        foreach ($params as $param) {
            $retval .= '<param name="' . $this->prepareField($param['name']);
            if (isset($param['unit'])) {
                $retval .= '" unit="' . $this->prepareField($param['unit']);
            }
            $retval .= '">' . $this->prepareField($param['value']) . '</param>' . $this->eol;
        }

        return $retval;
    }

    /**
     * Валюты
     *
     * @param string $id - код валюты (RUR, RUB, USD, BYR, KZT, EUR, UAH)
     * @param float|string $rate - курс этой валюты к валюте, взятой за единицу.
     *    Параметр rate может иметь так же следующие значения:
     *        CBRF - курс по Центральному банку РФ.
     *        NBU - курс по Национальному банку Украины.
     *        NBK - курс по Национальному банку Казахстана.
     *        СВ - курс по банку той страны, к которой относится интернет-магазин
     *        по Своему региону, указанному в Партнерском интерфейсе Яндекс.Маркета.
     * @param float $plus - используется только в случае rate = CBRF, NBU, NBK или СВ
     *        и означает на сколько увеличить курс в процентах от курса выбранного банка
     * @return bool
     */
    private
    function setCurrency($id, $rate = 'CBRF', $plus = 0)
    {
        $allow_id = array_map('trim', explode(',', $this->msie->modx->getOption('msimportexport.export.ym.currencies', '')));
        if (!in_array($id, $allow_id)) {
            return false;
        }
        $allow_rate = array('CBRF', 'NBU', 'NBK', 'CB');
        if (in_array($rate, $allow_rate)) {
            $plus = str_replace(',', '.', $plus);
            if (is_numeric($plus) && $plus > 0) {
                $this->currencies[] = array(
                    'id' => $this->prepareField(strtoupper($id)),
                    'rate' => $rate,
                    'plus' => (float)$plus
                );
            } else {
                $this->currencies[] = array(
                    'id' => $this->prepareField(strtoupper($id)),
                    'rate' => $rate
                );
            }
        } else {
            $rate = str_replace(',', '.', $rate);
            if (!(is_numeric($rate) && $rate > 0)) {
                return false;
            }
            $this->currencies[] = array(
                'id' => $this->prepareField(strtoupper($id)),
                'rate' => (float)$rate
            );
        }

        return true;
    }

    /**
     * Подготовка текстового поля в соответствии с требованиями Яндекса
     * Запрещаем любые html-тэги, стандарт XML не допускает использования в текстовых данных
     * непечатаемых символов с ASCII-кодами в диапазоне значений от 0 до 31 (за исключением
     * символов с кодами 9, 10, 13 - табуляция, перевод строки, возврат каретки). Также этот
     * стандарт требует обязательной замены некоторых символов на их символьные примитивы.
     * @param string $text
     * @return string
     */
    private
    function prepareField($field)
    {

        $field = htmlspecialchars_decode($field);
        $field = strip_tags($field);
        $from = array('"', '&', '>', '<', '\'');
        $to = array('&quot;', '&amp;', '&gt;', '&lt;', '&apos;');
        $field = str_replace($from, $to, $field);
        if ($this->fromCharset != 'windows-1251') {
            //$field = iconv($this->fromCharset, 'windows-1251//IGNORE', $field);
            $field = iconv($this->fromCharset, 'windows-1251//TRANSLIT', $field);
        }
        $field = preg_replace('#[\x00-\x08\x0B-\x0C\x0E-\x1F]+#is', ' ', $field);

        return trim($field);
    }

    /**
     * @param array $data
     * @return array
     */
    private function prepareOfferParams($data = array())
    {
        $params = array();
        foreach ($data as $k => $v) {
            $values = is_array($v['field']) ? $v['field'] : array($v['field']);
            foreach ($values as $value) {
                if ($param = $this->prepareUserField($k, $value, $v['unit'])) {
                    $params[] = $param;
                }
            }
        }
        return $params;
    }

    /**
     * @param string $key
     * @param string|array $field
     * @param string $unit
     * @return array
     */
    private function prepareUserField($key, $value, $unit = '')
    {
        $name = $this->msie->modx->lexicon('ms2_product_' . $key);
        $param = array();
        if (!empty($value)) {
            $param = array(
                'name' => $name ? $name : $key,
                'value' => $value
            );
            if (!empty($unit)) {
                $param['unit'] = $unit;
            }
        }
        return $param;
    }

}