<?php

$tv = $modx->getOption('tv', $scriptProperties, '');
$input = $modx->getOption('input', $scriptProperties, '');
$resource = (int)$modx->getOption('id', $scriptProperties, '');
$x = $modx->getOption('getX', $scriptProperties, '');
$y = $modx->getOption('getY', $scriptProperties, '');
$head = $modx->getOption('head', $scriptProperties, true, true);
$display_headers = $modx->getOption('displayHeaders', $scriptProperties, false, true);

$tdTpl = $modx->getOption('tdTpl', $scriptProperties, '@INLINE <td>[[+val]]</td>', true);
$thTpl = $modx->getOption('thTpl', $scriptProperties, '@INLINE <th>[[+val]]</th>', true);
$trTpl = $modx->getOption('trTpl', $scriptProperties, '@INLINE <tr>[[+cells]]</tr>', true);
$wrapperTpl = $modx->getOption('wrapperTpl', $scriptProperties, '@INLINE <table class="[[+classname]]">[[+table]]</table>', true);

$tableClass = $modx->getOption('tableClass', $scriptProperties, 'tvtable', true);
$headClass = $modx->getOption('headClass', $scriptProperties, '');
$bodyClass = $modx->getOption('bodyClass', $scriptProperties, '');

$classname = !empty($classname) ? $classname : $tableClass;
$headOpen = empty($headClass) ? '<thead>' : '<thead class="' . $headClass . '">';
$bodyOpen = empty($bodyClass) ? '<tbody>' : '<tbody class="' . $bodyClass . '">';

if (empty($tv) && empty($input)) return;

$version = $modx->getVersionData();
$modx_version = intval(substr($version['full_version'], 0, 1));

if (empty($input)) {
    if (!empty($resource)) {
        $resource = $modx->getObject('modResource', ['id' => $resource]);
        if (!$resource instanceof modResource) return;
        $value = $resource->getTVValue($tv);
    } else {
        $value = $modx->resource->getTVValue($tv);
    }
} else {
    $value = $input;
}

if (!$tvtArr = $modx->fromJSON($value)) {
    return;
};

if ($x == 'first') $x = 0;
if ($y == 'first') $y = 0;

$values = [];

if ($x !== '' && $y === '') {
    $directionX = true;
    if ($x === 'last') {
        $values = array_pop($tvtArr);
    } else {
        $values = $tvtArr[$x];
    }
} elseif ($x === '' && $y !== '') {
    $directionY = true;
    if (count($tvtArr[0]) > $y) {
        foreach ($tvtArr as $key => $row) {
            if ($y === 'last') {
                $y = count($tvtArr[$key]) - 1;
            }
            $values[$key] = $tvtArr[$key][$y];
        }
    }
} elseif ($x !== '' && $y !== '') {
    if ($x === 'last') {
        $x = count($tvtArr) - 1;
    }
    if ($y === 'last') {
        $y = count($tvtArr[$x]) - 1;
    }

    return $tvtArr[$x][$y];
} else {
    $values = $tvtArr;
}

if ($display_headers && count($values)) {
    $query = $modx->newQuery('modTemplateVar');
    $query->where(['id' => $tv]);
    $query->where(['name' => $tv], xPDOQuery::SQL_OR);
    if ($tv_obj = $modx->getObject('modTemplateVar', $query)) {
        $tv_props = $tv_obj->get('input_properties');
        $headers = explode('||', $tv_props['headers']);
        $headersDefault = $tv_props['headers_default'];
        if (count($headers)) {
            $column_count = ($directionX || $directionY) ? count($values) : count($values[0]);
            $header_row = [];
            if ($directionY) {
                $header_row = $headers[$y] ?: $headersDefault;
            } else {
                for ($i = 0; $i < $column_count; $i++) {
                    $header_row[] = $headers[$i] ?: $headersDefault;
                }
            }
            if ($directionX) {
                $directionX = false;
                $values = [$header_row, $values];
            } else {
                array_unshift($values, $header_row);
            }
        }
    }
}

if (empty($values)) return;

if ($modx_version === 3) {
    $pdoFetch = $modx->services->get(ModxPro\PdoTools\Fetch::class);
    if (!$pdoFetch) {
        return false;
    }
    $fastMode = $pdoFetch->getConfig['fastMode'];

} else {
    $fqn = $modx->getOption('pdoFetch.class', null, 'pdotools.pdofetch', true);
    $path = $modx->getOption('pdofetch_class_path', null, MODX_CORE_PATH . 'components/pdotools/model/', true);
    if ($pdoClass = $modx->loadClass($fqn, $path, false, true)) {
        $pdoFetch = new $pdoClass($modx, $scriptProperties);
        $fastMode = $pdoFetch->config['fastMode'];
    } else {
        return false;
    }
}

$pdoFetch->addTime('pdoTools loaded');
$output = $pdoFetch->run();
$rows = '';

if ($directionX) {
    $directionXTpl = $head ? $thTpl : $tdTpl;
    foreach ($values as $value) {
        $cells .= $pdoFetch->getChunk($directionXTpl, ['val' => $value], $fastMode);
    }
    $rows .= $head ? $headOpen : $bodyOpen;
    $rows .= $pdoFetch->getChunk($trTpl, ['cells' => $cells, 'idx' => $x], $fastMode);
    $rows .= $head ? '</thead>' : '</tbody>';
} else {
    if ($head) {
        $rows .= $headOpen;
        $head = array_shift($values);
        $headCells = '';
        if (is_array($head)) {
            foreach ($head as $row) {
                $headCells .= $pdoFetch->getChunk($thTpl, ['val' => $row], $fastMode);
            }
        } else {
            $headCells .= $pdoFetch->getChunk($thTpl, ['val' => $head], $fastMode);
        }
        $rows .= $pdoFetch->getChunk($trTpl, ['cells' => $headCells, 'idx' => 0], $fastMode);
        $rows .= '</thead>';
    }
    if ($values) {
        $rows .= $bodyOpen;
        $idx = $head ? 1 : 0;
        foreach ($values as $row) {
            $cells = '';
            if (is_array($row)) {
                foreach ($row as $cell) {
                    $cells .= $pdoFetch->getChunk($tdTpl, ['val' => $cell], $fastMode);
                }
            } else {
                $cells .= $pdoFetch->getChunk($tdTpl, ['val' => $row], $fastMode);
            }
            $rows .= $pdoFetch->getChunk($trTpl, ['cells' => $cells, 'idx' => $idx], $fastMode);
            $idx++;
        }
        $rows .= '</tbody>';
    }
}

$output = $pdoFetch->getChunk($wrapperTpl, ['table' => $rows, 'classname' => $classname], $fastMode);

return $output;