<?php
/**
 * @var modX $modx
 * @var array $scriptProperties
 * @var Rvg $rvg
 * @var pdoTools $pdoTools
 */

$rvg = $modx->getService('resvideogallery', 'Rvg', $modx->getOption('resvideogallery.core_path', null, $modx->getOption('core_path') . 'components/resvideogallery/') . 'model/resvideogallery/', array());

if (!is_object($rvg) || !($rvg instanceof Rvg)) return 'ResVideoGallery not found!';
if (!$pdoTools = $rvg->getPdoTools()) return 'PdoTools not found!';

$resources = array();
$resourcesIn = array();
$resourcesOut = array();
$whereVideo = array();
$wherePhoto = array();
$activeTags = array();

$where = !empty($where) ? $modx->fromJSON($where) : array();

if ($scriptProperties['parents'] == '' && empty($scriptProperties['resources'])) {
    $scriptProperties['resources'] = $modx->resource->get('id');
}

if (!empty($scriptProperties['resources'])) {
    $resources = array_filter(array_map('trim', explode(',', $scriptProperties['resources'])));
}

if (!empty($scriptProperties['parents'])) {
    $tmp = array();
    $parents = array_filter(array_map('trim', explode(',', $scriptProperties['parents'])));
    foreach ($parents as $parent) {
        $tmp = array_merge($tmp, $modx->getChildIds($parent, $depth));
    }
    $resources = array($resources, $tmp);
}

foreach ($resources as $v) {
    if ($v < 0) {
        $resourcesOut[] = abs($v);
    } else {
        $resourcesIn[] = abs($v);
    }
}

if (!empty($tagsVar) && isset($_REQUEST[$tagsVar])) {
    $tags = $modx->stripTags($_REQUEST[$tagsVar]);
    $activeTags = array_map('trim', explode(',', str_replace('"', '', $tags)));
}

$qVideo = $rvg->getQueryTags();

if (!empty($resourcesIn)) {
    $whereVideo['resource_id:IN'] = $resourcesIn;
}
if (!empty($resourcesOut)) {
    $whereVideo['resource_id:NOT IN'] = $resourcesOut;
}

if (empty($showInactive)) {
    $whereVideo['RvgVideos.active'] = 1;
}

$whereVideo = array_merge($where, $whereVideo);

if (!empty($whereVideo)) {
    $qVideo->where($whereVideo);
}

$qVideo->groupby('tag');

$totalVideo = $modx->getCount('RvgVideosTags', $qVideo);

$totalPhoto = 0;
$photoGalleryKey = '';
$photoGalleryClass = '';
$photoGalleryTagClass = '';

if (!empty($photoGallery)) {
    switch ($photoGallery) {
        case 'ms2Images':
            $photoGalleryClass = 'msProductFile';
            $photoGalleryTagClass = '';
            $photoGalleryKey = 'product_id';
            break;
        case 'ms2Gallery':
            $photoGalleryClass = 'msResourceFile';
            $photoGalleryTagClass = 'msResourceFileTag';
            $photoGalleryKey = 'resource_id';
            /* @var ms2Gallery $ms2Gallery */
            $ms2Gallery = $modx->getService('ms2gallery', 'ms2Gallery', MODX_CORE_PATH . 'components/ms2gallery/model/ms2gallery/');
            break;
    }
    if (!empty($photoGalleryTagClass)) {
        $qPhoto = $rvg->getQueryTags(true);

        if (!empty($resourcesIn)) {
            $wherePhoto[$photoGalleryClass . '.' . $photoGalleryKey . ':IN'] = $resourcesIn;
        }
        if (!empty($resourcesOut)) {
            $wherePhoto[$photoGalleryClass . '.' . $photoGalleryKey . ':NOT IN'] = $resourcesOut;
        }

        if (empty($showInactive)) {
            $wherePhoto[$photoGalleryClass . '.active'] = 1;
        }

        $wherePhoto = array_merge($where, $wherePhoto);

        if (!empty($wherePhoto)) {
            $qPhoto->where($wherePhoto);
        }

        $qPhoto->groupby('tag');

        $totalPhoto = $modx->getCount($photoGalleryTagClass, $qPhoto);

    }
}

$total = $totalVideo + $totalPhoto;

$modx->setPlaceholder($plPrefix . $totalVar, $total);


if (!empty($sortby)) {
    if (strpos($sortby, '{') === 0) {
        $sorts = $modx->fromJSON($sortby);
    } else {
        $sorts = array($sortby => $sortdir);
    }
    if (is_array($sorts)) {
        while (list($sort, $dir) = each($sorts)) {
            if ($sortbyEscaped) $sort = $modx->escape($sort);
            if (!empty($sortbyAlias)) $sort = $modx->escape($sortbyAlias) . ".{$sort}";
            if (!empty($qVideo)) $qVideo->sortby($sort, $dir);
            if (!empty($qPhoto)) $qPhoto->sortby($sort, $dir);
        }
    }
}

if (!empty($limit)) {
    if (!empty($photoGalleryClass)) {
        if ($primarily == 'video') {
            $qVideo->limit($limit, $offset);
            $diff = $totalVideo - $offset;
            if ($diff < $limit) {
                if ($diff > 0) {
                    $qPhoto->limit($limit - $diff, 0);
                } else {
                    $qVideo = null;
                    $qPhoto->limit($limit, $offset - $totalVideo);
                }
            } else {
                $qPhoto = null;
            }
        } else {
            $qPhoto->limit($limit, $offset);
            $diff = $totalPhoto - $offset;
            if ($diff < $limit) {
                if ($diff > 0) {
                    $qVideo->limit($limit - $diff, 0);
                } else {
                    $qPhoto = null;
                    $qVideo->limit($limit, $offset - $totalPhoto);
                }
            } else {
                $qVideo = null;
            }
        }

    } else {
        $qVideo->limit($limit, $offset);
    }
}

if (!empty($debug)) {
    if ($qVideo) {
        $qVideo->prepare();
        $modx->log(modX::LOG_LEVEL_ERROR, $qVideo->toSQL());
    }

    if ($qPhoto) {
        $qPhoto->prepare();
        $modx->log(modX::LOG_LEVEL_ERROR, $qPhoto->toSQL());
    }
}


$tags = array();

if (!empty($photoGalleryTagClass)) {
    if ($primarily == 'video') {
        $tags = $rvg->executeQueryTags($qVideo, $activeTags);
        $tags = array_merge($tags, $rvg->executeQueryTags($qPhoto, $activeTags));
    } else {
        $tags = $rvg->executeQueryTags($qPhoto, $activeTags);
        $tags = array_merge($tags, $rvg->executeQueryTags($qVideo, $activeTags));
    }
} else {
    $tags = $rvg->executeQueryTags($qVideo, $activeTags);
}

return $pdoTools->getChunk($tpl, array('tags' => $tags, 'total' => $total));