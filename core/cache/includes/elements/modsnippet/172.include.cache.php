<?php

/** @var modX $modx */
/** @var array $scriptProperties */
/** @var miniShop2 $miniShop2 */
$miniShop2 = $modx->getService('miniShop2');
$miniShop2->initialize($modx->context->key);
/** @var pdoFetch $pdoFetch */
$fqn = $modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
$path = $modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
    $pdoFetch = new $pdoClass($modx, $scriptProperties);
} else {
    return false;
}
$pdoFetch->addTime('pdoTools loaded.');

// Adding extra parameters into special place so we can put them in a results
/** @var modSnippet $snippet */
$additionalPlaceholders = $properties = array();
if (isset($this) && $this instanceof modSnippet && $this->get('properties')) {
    $properties = $this->get('properties');
}
elseif ($snippet = $modx->getObject('modSnippet', array('name' => 'pdoResources'))) {
    $properties = $snippet->get('properties');
}
if (!empty($properties)) {
    foreach ($scriptProperties as $k => $v) {
        if (!isset($properties[$k])) {
            $additionalPlaceholders[$k] = $v;
        }
    }
}
// $scriptProperties['additionalPlaceholders'] = $additionalPlaceholders;

if (isset($parents) && $parents === '') {
    $scriptProperties['parents'] = $modx->resource->id;
}

// Start build "where" expression
$where = array(
    'class_key' => 'msProduct',
);
if (empty($showZeroPrice)) {
    $where['Data.price:>'] = 0;
}
// Add grouping
$groupby = array(
    'msProduct.id',
);

// Join tables
$leftJoin = array(
    'Data' => array('class' => 'msProductData'),
    'Vendor' => array('class' => 'msVendor', 'on' => 'Data.vendor=Vendor.id'),
);

$select = array(
    'msProduct' => !empty($includeContent)
        ? $modx->getSelectColumns('msProduct', 'msProduct')
        : $modx->getSelectColumns('msProduct', 'msProduct', '', array('content'), true),
    'Data' => $modx->getSelectColumns('msProductData', 'Data', '', array('id'), true),
    'Vendor' => $modx->getSelectColumns('msVendor', 'Vendor', 'vendor.', array('id'), true),
);

// Include thumbnails
if (!empty($includeThumbs)) {
    $thumbs = array_map('trim', explode(',', $includeThumbs));
    foreach ($thumbs as $thumb) {
        if (empty($thumb)) {
            continue;
        }
        $leftJoin[$thumb] = array(
            'class' => 'msProductFile',
            'on' => "`{$thumb}`.product_id = msProduct.id AND `{$thumb}`.rank = 0 AND `{$thumb}`.path LIKE '%/{$thumb}/%'",
        );
        $select[$thumb] = "`{$thumb}`.url as `{$thumb}`";
        $groupby[] = "`{$thumb}`.url";
    }
}

// Include thumbnails // nw rw
if (!empty($includeThumbsSorce)) {
    $leftJoin['images_ext'] = array(
        'class' => 'msProductFile',
        'on' => "`images_ext`.product_id = msProduct.id AND `images_ext`.parent = 0",
    );
    $select['images_ext'] = "`images_ext`.url as `images_ext`";
    $groupby[] = "`images_ext`.url";
}

// Include linked products
$innerJoin = array();
if (!empty($link) && !empty($master)) {
    $innerJoin['Link'] = array(
        'class' => 'msProductLink',
        'on' => 'msProduct.id = Link.slave AND Link.link = ' . $link,
    );
    $where['Link.master'] = $master;
} elseif (!empty($link) && !empty($slave)) {
    $innerJoin['Link'] = array(
        'class' => 'msProductLink',
        'on' => 'msProduct.id = Link.master AND Link.link = ' . $link,
    );
    $where['Link.slave'] = $slave;
}

// Add user parameters
foreach (array('where', 'leftJoin', 'innerJoin', 'select', 'groupby') as $v) {
    if (!empty($scriptProperties[$v])) {
        $tmp = $scriptProperties[$v];
        if (!is_array($tmp)) {
            $tmp = json_decode($tmp, true);
        }
        if (is_array($tmp)) {
            $$v = array_merge($$v, $tmp);
        }
    }
    unset($scriptProperties[$v]);
}
$pdoFetch->addTime('Conditions prepared');

// Add filters by options
$joinedOptions = array();
if (!empty($scriptProperties['optionFilters'])) {
    $filters = json_decode($scriptProperties['optionFilters'], true);
    foreach ($filters as $key => $value) {
        $option = preg_replace('#\:.*#', '', $key);
        $key = str_replace($option, $option . '.value', $key);
        if (!in_array($option, $joinedOptions)) {
            $leftJoin[$option] = array(
                'class' => 'msProductOption',
                'on' => "`{$option}`.product_id = Data.id AND `{$option}`.key = '{$option}'",
            );
            $joinedOptions[] = $option;
            $where[$key] = $value;
        }
    }
}

// Add sort by options
if (!empty($scriptProperties['sortbyOptions'])) {
    $sorts = array_map('trim', explode(',', $scriptProperties['sortbyOptions']));
    foreach ($sorts as $sort) {
        $sort = explode(':', $sort);
        $option = $sort[0];
        if (preg_match("#\b{$option}\b#", $scriptProperties['sortby'], $matches)) {
            $type = 'string';
            if (isset($sort[1])) {
                $type = $sort[1];
            }
            switch ($type) {
                case 'number':
                case 'decimal':
                    $sortbyOptions = "CAST(`{$option}`.`value` AS DECIMAL(13,3))";
                    break;
                case 'int':
                case 'integer':
                    $sortbyOptions = "CAST(`{$option}`.`value` AS UNSIGNED INTEGER)";
                    break;
                case 'date':
                case 'datetime':
                    $sortbyOptions = "CAST(`{$option}`.`value` AS DATETIME)";
                    break;
                default:
                    $sortbyOptions = "`{$option}`.`value`";
                    break;
            }
            $scriptProperties['sortby'] = preg_replace("#\b{$option}\b#", $sortbyOptions, $scriptProperties['sortby']);
            $groupby[] = "`{$option}`.value";
        }

        if (!in_array($option, $joinedOptions)) {
            $leftJoin[$option] = array(
                'class' => 'msProductOption',
                'on' => "`{$option}`.product_id = Data.id AND `{$option}`.key = '{$option}'",
            );
            $joinedOptions[] = $option;
        }

    }
}

// mods
// $modx->log(1, print_r($scriptProperties['sortby'],1));
// $modx->log(1, print_r($sortby_arr,1));

if (empty($scriptProperties['sortby'])) {
  $scriptProperties['sortby'] = 'Data.price=0, Data.price';
} else {
  $sortby_arr = array_map('trim', explode(',', $scriptProperties['sortby']));
   if (!in_array('Data.price=0', $sortby_arr)) {
    array_unshift($sortby_arr, 'Data.price=0');
    $scriptProperties['sortby'] = implode(',', $sortby_arr);
  }
}

// $modx->log(1, print_r($scriptProperties['sortby'],1));

$default = array(
    'class' => 'msProduct',
    'where' => $where,
    'leftJoin' => $leftJoin,
    'innerJoin' => $innerJoin,
    'select' => $select,
    'sortby' => 'msProduct.id',
    'sortdir' => 'ASC',
    'groupby' => implode(', ', $groupby),
    'return' => !empty($returnIds)
        ? 'ids'
        : 'data',
    'nestedChunkPrefix' => 'minishop2_',
);
// Merge all properties and run!
$pdoFetch->setConfig(array_merge($default, $scriptProperties), false);
$rows = $pdoFetch->run();

// Process rows
$output = array();
if (!empty($rows) && is_array($rows)) {
    $c = $modx->newQuery('modPluginEvent', array('event:IN' => array('msOnGetProductPrice', 'msOnGetProductWeight', 'msOnGetProductFields')));
    $c->innerJoin('modPlugin', 'modPlugin', 'modPlugin.id = modPluginEvent.pluginid');
    $c->where('modPlugin.disabled = 0');

    $modifications = $modx->getOption('ms2_price_snippet', null, false, true) ||
        $modx->getOption('ms2_weight_snippet', null, false, true) || $modx->getCount('modPluginEvent', $c);
    if ($modifications) {
        /** @var msProductData $product */
        $product = $modx->newObject('msProductData');
    }
    $pdoFetch->addTime('Checked the active modifiers');

    $opt_time = 0;
    foreach ($rows as $k => $row) {
        if ($modifications) {
            $product->fromArray($row, '', true, true);
            $tmp = $row['price'];
            $row['price'] = $product->getPrice($row);
            $row['weight'] = $product->getWeight($row);
            // A discount here, so we should replace old price
            if ($row['price'] < $tmp) {
                $row['old_price'] = $tmp;
            }
            $row = $product->modifyFields($row);
        }
        $row['price'] = $miniShop2->formatPrice($row['price']);
        $row['old_price'] = $miniShop2->formatPrice($row['old_price']);
        $row['weight'] = $miniShop2->formatWeight($row['weight']);
        $row['idx'] = $pdoFetch->idx++;

        $opt_time_start = microtime(true);
        $options = $modx->call('msProductData', 'loadOptions', array(&$modx, $row['id']));
        $row = array_merge($row, $options);
        $opt_time += microtime(true) - $opt_time_start;

        $tpl = $pdoFetch->defineChunk($row);
        $output[] = $pdoFetch->getChunk($tpl, array_merge($additionalPlaceholders, $row));
    }
    $pdoFetch->addTime('Time to load products options', $opt_time);
}

$log = '';
if ($modx->user->hasSessionContext('mgr') && !empty($showLog)) {
    $log .= '<pre class="msProductsLog">' . print_r($pdoFetch->getTime(), 1) . '</pre>';
}

// Return output
if (!empty($returnIds) && is_string($rows)) {
    $modx->setPlaceholder('msProducts.log', $log);
    if (!empty($toPlaceholder)) {
        $modx->setPlaceholder($toPlaceholder, $rows);
    } else {
        return $rows;
    }
} elseif (!empty($toSeparatePlaceholders)) {
    $output['log'] = $log;
    $modx->setPlaceholders($output, $toSeparatePlaceholders);
} else {
    if (empty($outputSeparator)) {
        $outputSeparator = "\n";
    }
    $output['log'] = $log;
    $output = implode($outputSeparator, $output);

    if (!empty($tplWrapper) && (!empty($wrapIfEmpty) || !empty($output))) {
        $output = $pdoFetch->getChunk($tplWrapper, array_merge($additionalPlaceholders, array('output' => $output)));
    }

    if (!empty($toPlaceholder)) {
        $modx->setPlaceholder($toPlaceholder, $output);
    } else {
        return $output;
    }
}
return;
