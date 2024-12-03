<?php return array (
  '1ae36ca923ef3d86f56535cbbc028503' => 
  array (
    'criteria' => 
    array (
      'name' => 'tvtable',
    ),
    'object' => 
    array (
      'name' => 'tvtable',
      'path' => '{core_path}components/tvtable/',
      'assets_path' => '',
    ),
  ),
  '257d6eaced1f52cdd5d7115d6090c5d3' => 
  array (
    'criteria' => 
    array (
      'key' => 'tvtable_clear_button',
    ),
    'object' => 
    array (
      'key' => 'tvtable_clear_button',
      'value' => '',
      'xtype' => 'combo-boolean',
      'namespace' => 'tvtable',
      'area' => 'tvtable_main',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'a57c658c2be4635e8f543b1f21d34f35' => 
  array (
    'criteria' => 
    array (
      'key' => 'tvtable_remove_confirm',
    ),
    'object' => 
    array (
      'key' => 'tvtable_remove_confirm',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'tvtable',
      'area' => 'tvtable_main',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'ec7d8c06bf6f2e13ff21130ca3b208f4' => 
  array (
    'criteria' => 
    array (
      'category' => 'TVTable',
    ),
    'object' => 
    array (
      'id' => 90,
      'parent' => 0,
      'category' => 'TVTable',
      'rank' => 0,
    ),
  ),
  'b730a3750f04401b998941650bb92752' => 
  array (
    'criteria' => 
    array (
      'name' => 'TVTable',
    ),
    'object' => 
    array (
      'id' => 152,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'TVTable',
      'description' => '',
      'editor_type' => 0,
      'category' => 90,
      'cache_type' => 0,
      'snippet' => '/** @var modX $modx */
/** @var array $scriptProperties */

$tv = $modx->getOption(\'tv\', $scriptProperties, \'\');
$input = $modx->getOption(\'input\', $scriptProperties, \'\');
$resource = (int) $modx->getOption(\'id\', $scriptProperties, \'\');
$x = $modx->getOption(\'getX\', $scriptProperties, \'\');
$y = $modx->getOption(\'getY\', $scriptProperties, \'\');
$head = $modx->getOption(\'head\', $scriptProperties, true, true);
$display_headers = $modx->getOption(\'displayHeaders\', $scriptProperties, false, true);

$tdTpl = $modx->getOption(\'tdTpl\', $scriptProperties, \'@INLINE <td>[[+val]]</td>\', true);
$thTpl = $modx->getOption(\'thTpl\', $scriptProperties, \'@INLINE <th>[[+val]]</th>\', true);
$trTpl = $modx->getOption(\'trTpl\', $scriptProperties, \'@INLINE <tr>[[+cells]]</tr>\', true);
$wrapperTpl = $modx->getOption(\'wrapperTpl\', $scriptProperties, \'@INLINE <table class="[[+classname]]">[[+table]]</table>\', true);

$tableClass = $modx->getOption(\'tableClass\', $scriptProperties, \'tvtable\', true);
$headClass = $modx->getOption(\'headClass\', $scriptProperties, \'\');
$bodyClass = $modx->getOption(\'bodyClass\', $scriptProperties, \'\');

$classname = !empty($classname) ? $classname : $tableClass;
$headOpen = empty($headClass) ? \'<thead>\' : \'<thead class="\' . $headClass . \'">\';
$bodyOpen = empty($bodyClass) ? \'<tbody>\' : \'<tbody class="\' . $bodyClass . \'">\';

if (empty($tv) && empty($input)) return;

if (empty($input)) {
    if (!empty($resource)) {
        $resource = $modx->getObject(\'modResource\', array(\'id\' => $resource));
        if (!$resource instanceof modResource) return;
        $value = $resource->getTVValue($tv);
    } else {
        $value = $modx->resource->getTVValue($tv);
    }
} else {
    $value = $input;
}

if (!$tvtArr = $modx->fromJSON($value)) { return; };

if ($x == \'first\') $x = 0;
if ($y == \'first\') $y = 0;

$values = array();

if ($x !== \'\' && $y === \'\') {
    $directionX = true;
    if ($x === \'last\') {
        $values = array_pop($tvtArr);
    } else {
        $values = $tvtArr[$x];
    }
} elseif ($x === \'\' && $y !== \'\') {
    $directionY = true;
    if (count($tvtArr[0]) > $y) {
        foreach ($tvtArr as $key => $row) {
            if ($y === \'last\') { $y = count($tvtArr[$key]) - 1; }
            $values[$key] = $tvtArr[$key][$y];
        }
    }
} elseif ($x !== \'\' && $y !== \'\') {
    if ($x === \'last\') { $x = count($tvtArr) - 1; }
    if ($y === \'last\') { $y = count($tvtArr[$x]) - 1; }
    return $tvtArr[$x][$y];
} else {
    $values = $tvtArr;
}

if ($display_headers && count($values)) {
    $query = $modx->newQuery(\'modTemplateVar\');
    $query->where(array(\'id\' => $tv));
    $query->where(array(\'name\' => $tv), xPDOQuery::SQL_OR);
    if ($tv_obj = $modx->getObject(\'modTemplateVar\', $query)) {
        $tv_props = $tv_obj->get(\'input_properties\');
        $headers = explode(\'||\', $tv_props[\'headers\']);
        $headersDefault = $tv_props[\'headers_default\'];
        if (count($headers)) {
            $column_count = ($directionX || $directionY) ? count($values) : count($values[0]);
            $header_row = array();
            if ($directionY) {
                $header_row = $headers[$y] ?: $headersDefault;
            } else {
                for ($i = 0; $i < $column_count; $i++) {
                    $header_row[] = $headers[$i] ?: $headersDefault;
                }
            }
            if ($directionX) {
                $directionX = false;
                $values = array($header_row, $values);
            } else {
                array_unshift($values, $header_row);
            }
        }
    }
}

if (empty($values)) return;

/** @var pdoFetch $pdoFetch */
$fqn = $modx->getOption(\'pdoFetch.class\', null, \'pdotools.pdofetch\', true);
$path = $modx->getOption(\'pdofetch_class_path\', null, MODX_CORE_PATH . \'components/pdotools/model/\', true);
if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
    $pdoFetch = new $pdoClass($modx, $scriptProperties);
} else {
    return false;
}
$pdoFetch->addTime(\'pdoTools loaded\');
$output = $pdoFetch->run();
$fastMode = $pdoFetch->config[\'fastMode\'];

if ($directionX) {
    $directionXTpl = $head ? $thTpl : $tdTpl;
    foreach ($values as $value) {
        $cells .= $pdoFetch->getChunk($directionXTpl, array(\'val\' => $value), $fastMode);
    }
    $rows .= $head ? $headOpen : $bodyOpen;
    $rows .= $pdoFetch->getChunk($trTpl, array(\'cells\' => $cells, \'idx\' => $x), $fastMode);
    $rows .= $head ? \'</thead>\' : \'</tbody>\';
} else {
    if ($head) {
        $rows .= $headOpen;
        $head = array_shift($values);
        $headCells = \'\';
        if (is_array($head)) {
            $col = 0;
            foreach ($head as $row) {
                $headCells .= $pdoFetch->getChunk($thTpl, array(\'val\' => $row, \'row\' => $idx + 1, \'col\' => $col + 1), $fastMode);
                $col++;
            }
        } else {
            $headCells .= $pdoFetch->getChunk($thTpl, array(\'val\' => $head), $fastMode);
        }
        $rows .= $pdoFetch->getChunk($trTpl, array(\'cells\' => $headCells, \'idx\' => 0), $fastMode);
        $rows .= \'</thead>\';
    }
    if ($values) {
        $rows .= $bodyOpen;
        $idx = $head ? 1 : 0;
        foreach ($values as $row) {
            $cells = \'\';
            if(is_array($row)) {
                $col = 0;
                foreach ($row as $cell) {
                    $cells .= $pdoFetch->getChunk($tdTpl, array(\'val\' => $cell, \'row\' => $idx + 1, \'col\' => $col + 1), $fastMode);
                    $col++;
                }
            } else {
                $cells .= $pdoFetch->getChunk($tdTpl, array(\'val\' => $row), $fastMode);
            }
            $rows .= $pdoFetch->getChunk($trTpl, array(\'cells\' => $cells, \'idx\' => $idx), $fastMode);
            $idx++;
        }
        $rows .= \'</tbody>\';
    }
}

$output = $pdoFetch->getChunk($wrapperTpl, array(\'table\' => $rows, \'classname\' => $classname), $fastMode);

return $output;',
      'locked' => 0,
      'properties' => 'a:12:{s:10:"tableClass";a:7:{s:4:"name";s:10:"tableClass";s:4:"desc";s:23:"tvtable_prop_tableClass";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:9:"headClass";a:7:{s:4:"name";s:9:"headClass";s:4:"desc";s:22:"tvtable_prop_headClass";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:9:"bodyClass";a:7:{s:4:"name";s:9:"bodyClass";s:4:"desc";s:22:"tvtable_prop_bodyClass";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:4:"head";a:7:{s:4:"name";s:4:"head";s:4:"desc";s:17:"tvtable_prop_head";s:4:"type";s:13:"combo-boolean";s:7:"options";a:0:{}s:5:"value";b:1;s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:2:"tv";a:7:{s:4:"name";s:2:"tv";s:4:"desc";s:15:"tvtable_prop_tv";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:2:"id";a:7:{s:4:"name";s:2:"id";s:4:"desc";s:15:"tvtable_prop_id";s:4:"type";s:11:"numberfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:5:"tdTpl";a:7:{s:4:"name";s:5:"tdTpl";s:4:"desc";s:18:"tvtable_prop_tdTpl";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:25:"@INLINE <td>[[+val]]</td>";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:5:"thTpl";a:7:{s:4:"name";s:5:"thTpl";s:4:"desc";s:18:"tvtable_prop_thTpl";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:25:"@INLINE <th>[[+val]]</th>";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:5:"trTpl";a:7:{s:4:"name";s:5:"trTpl";s:4:"desc";s:18:"tvtable_prop_trTpl";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:27:"@INLINE <tr>[[+cells]]</tr>";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:10:"wrapperTpl";a:7:{s:4:"name";s:10:"wrapperTpl";s:4:"desc";s:23:"tvtable_prop_wrapperTpl";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:56:"@INLINE <table class="[[+classname]]">[[+table]]</table>";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:4:"getY";a:7:{s:4:"name";s:4:"getY";s:4:"desc";s:17:"tvtable_prop_getY";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}s:4:"getX";a:7:{s:4:"name";s:4:"getX";s:4:"desc";s:17:"tvtable_prop_getX";s:4:"type";s:9:"textfield";s:7:"options";a:0:{}s:5:"value";s:0:"";s:7:"lexicon";s:18:"tvtable:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/tvtable/elements/snippets/snippet.tvtable.php',
      'content' => '/** @var modX $modx */
/** @var array $scriptProperties */

$tv = $modx->getOption(\'tv\', $scriptProperties, \'\');
$input = $modx->getOption(\'input\', $scriptProperties, \'\');
$resource = (int) $modx->getOption(\'id\', $scriptProperties, \'\');
$x = $modx->getOption(\'getX\', $scriptProperties, \'\');
$y = $modx->getOption(\'getY\', $scriptProperties, \'\');
$head = $modx->getOption(\'head\', $scriptProperties, true, true);
$display_headers = $modx->getOption(\'displayHeaders\', $scriptProperties, false, true);

$tdTpl = $modx->getOption(\'tdTpl\', $scriptProperties, \'@INLINE <td>[[+val]]</td>\', true);
$thTpl = $modx->getOption(\'thTpl\', $scriptProperties, \'@INLINE <th>[[+val]]</th>\', true);
$trTpl = $modx->getOption(\'trTpl\', $scriptProperties, \'@INLINE <tr>[[+cells]]</tr>\', true);
$wrapperTpl = $modx->getOption(\'wrapperTpl\', $scriptProperties, \'@INLINE <table class="[[+classname]]">[[+table]]</table>\', true);

$tableClass = $modx->getOption(\'tableClass\', $scriptProperties, \'tvtable\', true);
$headClass = $modx->getOption(\'headClass\', $scriptProperties, \'\');
$bodyClass = $modx->getOption(\'bodyClass\', $scriptProperties, \'\');

$classname = !empty($classname) ? $classname : $tableClass;
$headOpen = empty($headClass) ? \'<thead>\' : \'<thead class="\' . $headClass . \'">\';
$bodyOpen = empty($bodyClass) ? \'<tbody>\' : \'<tbody class="\' . $bodyClass . \'">\';

if (empty($tv) && empty($input)) return;

if (empty($input)) {
    if (!empty($resource)) {
        $resource = $modx->getObject(\'modResource\', array(\'id\' => $resource));
        if (!$resource instanceof modResource) return;
        $value = $resource->getTVValue($tv);
    } else {
        $value = $modx->resource->getTVValue($tv);
    }
} else {
    $value = $input;
}

if (!$tvtArr = $modx->fromJSON($value)) { return; };

if ($x == \'first\') $x = 0;
if ($y == \'first\') $y = 0;

$values = array();

if ($x !== \'\' && $y === \'\') {
    $directionX = true;
    if ($x === \'last\') {
        $values = array_pop($tvtArr);
    } else {
        $values = $tvtArr[$x];
    }
} elseif ($x === \'\' && $y !== \'\') {
    $directionY = true;
    if (count($tvtArr[0]) > $y) {
        foreach ($tvtArr as $key => $row) {
            if ($y === \'last\') { $y = count($tvtArr[$key]) - 1; }
            $values[$key] = $tvtArr[$key][$y];
        }
    }
} elseif ($x !== \'\' && $y !== \'\') {
    if ($x === \'last\') { $x = count($tvtArr) - 1; }
    if ($y === \'last\') { $y = count($tvtArr[$x]) - 1; }
    return $tvtArr[$x][$y];
} else {
    $values = $tvtArr;
}

if ($display_headers && count($values)) {
    $query = $modx->newQuery(\'modTemplateVar\');
    $query->where(array(\'id\' => $tv));
    $query->where(array(\'name\' => $tv), xPDOQuery::SQL_OR);
    if ($tv_obj = $modx->getObject(\'modTemplateVar\', $query)) {
        $tv_props = $tv_obj->get(\'input_properties\');
        $headers = explode(\'||\', $tv_props[\'headers\']);
        $headersDefault = $tv_props[\'headers_default\'];
        if (count($headers)) {
            $column_count = ($directionX || $directionY) ? count($values) : count($values[0]);
            $header_row = array();
            if ($directionY) {
                $header_row = $headers[$y] ?: $headersDefault;
            } else {
                for ($i = 0; $i < $column_count; $i++) {
                    $header_row[] = $headers[$i] ?: $headersDefault;
                }
            }
            if ($directionX) {
                $directionX = false;
                $values = array($header_row, $values);
            } else {
                array_unshift($values, $header_row);
            }
        }
    }
}

if (empty($values)) return;

/** @var pdoFetch $pdoFetch */
$fqn = $modx->getOption(\'pdoFetch.class\', null, \'pdotools.pdofetch\', true);
$path = $modx->getOption(\'pdofetch_class_path\', null, MODX_CORE_PATH . \'components/pdotools/model/\', true);
if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
    $pdoFetch = new $pdoClass($modx, $scriptProperties);
} else {
    return false;
}
$pdoFetch->addTime(\'pdoTools loaded\');
$output = $pdoFetch->run();
$fastMode = $pdoFetch->config[\'fastMode\'];

if ($directionX) {
    $directionXTpl = $head ? $thTpl : $tdTpl;
    foreach ($values as $value) {
        $cells .= $pdoFetch->getChunk($directionXTpl, array(\'val\' => $value), $fastMode);
    }
    $rows .= $head ? $headOpen : $bodyOpen;
    $rows .= $pdoFetch->getChunk($trTpl, array(\'cells\' => $cells, \'idx\' => $x), $fastMode);
    $rows .= $head ? \'</thead>\' : \'</tbody>\';
} else {
    if ($head) {
        $rows .= $headOpen;
        $head = array_shift($values);
        $headCells = \'\';
        if (is_array($head)) {
            $col = 0;
            foreach ($head as $row) {
                $headCells .= $pdoFetch->getChunk($thTpl, array(\'val\' => $row, \'row\' => $idx + 1, \'col\' => $col + 1), $fastMode);
                $col++;
            }
        } else {
            $headCells .= $pdoFetch->getChunk($thTpl, array(\'val\' => $head), $fastMode);
        }
        $rows .= $pdoFetch->getChunk($trTpl, array(\'cells\' => $headCells, \'idx\' => 0), $fastMode);
        $rows .= \'</thead>\';
    }
    if ($values) {
        $rows .= $bodyOpen;
        $idx = $head ? 1 : 0;
        foreach ($values as $row) {
            $cells = \'\';
            if(is_array($row)) {
                $col = 0;
                foreach ($row as $cell) {
                    $cells .= $pdoFetch->getChunk($tdTpl, array(\'val\' => $cell, \'row\' => $idx + 1, \'col\' => $col + 1), $fastMode);
                    $col++;
                }
            } else {
                $cells .= $pdoFetch->getChunk($tdTpl, array(\'val\' => $row), $fastMode);
            }
            $rows .= $pdoFetch->getChunk($trTpl, array(\'cells\' => $cells, \'idx\' => $idx), $fastMode);
            $idx++;
        }
        $rows .= \'</tbody>\';
    }
}

$output = $pdoFetch->getChunk($wrapperTpl, array(\'table\' => $rows, \'classname\' => $classname), $fastMode);

return $output;',
    ),
  ),
  'ac7c9da322230ed738a8db3e6fabf97d' => 
  array (
    'criteria' => 
    array (
      'name' => 'TVTable',
    ),
    'object' => 
    array (
      'id' => 46,
      'source' => 1,
      'property_preprocess' => 0,
      'name' => 'TVTable',
      'description' => '',
      'editor_type' => 0,
      'category' => 90,
      'cache_type' => 0,
      'plugincode' => '/** @var modX $modx */
$corePath = $modx->getOption(\'tvtable.core_path\', null, $modx->getOption(\'core_path\') . \'components/tvtable/\');
$assetsPath = $modx->getOption(\'assets_url\', null, MODX_ASSETS_URL) . \'components/tvtable/\';

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath . \'elements/tv/input/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/inputoptions/\');
        break;
    case \'OnDocFormPrerender\':
        $modx->regClientCSS($assetsPath . \'css/mgr/tvtable.css?ver=3.5.3\');
        $modx->regClientStartupScript($assetsPath . \'js/mgr/tvtable.js?ver=3.5.3\');
        break;
    case \'OnManagerPageBeforeRender\':
        $modx->controller->addLexiconTopic(\'tvtable:default\');
        break;
}',
      'locked' => 0,
      'properties' => NULL,
      'disabled' => 0,
      'moduleguid' => '',
      'static' => 0,
      'static_file' => 'core/components/tvtable/elements/plugins/plugin.tvtable.php',
      'content' => '/** @var modX $modx */
$corePath = $modx->getOption(\'tvtable.core_path\', null, $modx->getOption(\'core_path\') . \'components/tvtable/\');
$assetsPath = $modx->getOption(\'assets_url\', null, MODX_ASSETS_URL) . \'components/tvtable/\';

switch ($modx->event->name) {
    case \'OnTVInputRenderList\':
        $modx->event->output($corePath . \'elements/tv/input/\');
        break;
    case \'OnTVInputPropertiesList\':
        $modx->event->output($corePath . \'elements/tv/inputoptions/\');
        break;
    case \'OnDocFormPrerender\':
        $modx->regClientCSS($assetsPath . \'css/mgr/tvtable.css?ver=3.5.3\');
        $modx->regClientStartupScript($assetsPath . \'js/mgr/tvtable.js?ver=3.5.3\');
        break;
    case \'OnManagerPageBeforeRender\':
        $modx->controller->addLexiconTopic(\'tvtable:default\');
        break;
}',
    ),
  ),
  '179139e4ddeca3bb5453c98e19fc7dc1' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 46,
      'event' => 'OnTVInputRenderList',
    ),
    'object' => 
    array (
      'pluginid' => 46,
      'event' => 'OnTVInputRenderList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '7ab94c58fa9ad7c00f49e3000ced4946' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 46,
      'event' => 'OnTVInputPropertiesList',
    ),
    'object' => 
    array (
      'pluginid' => 46,
      'event' => 'OnTVInputPropertiesList',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  '90f16a61816443505e14a8306ad1d41a' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 46,
      'event' => 'OnDocFormPrerender',
    ),
    'object' => 
    array (
      'pluginid' => 46,
      'event' => 'OnDocFormPrerender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
  'ccb09193166f237ca8d059fb21be2296' => 
  array (
    'criteria' => 
    array (
      'pluginid' => 46,
      'event' => 'OnManagerPageBeforeRender',
    ),
    'object' => 
    array (
      'pluginid' => 46,
      'event' => 'OnManagerPageBeforeRender',
      'priority' => 0,
      'propertyset' => 0,
    ),
  ),
);