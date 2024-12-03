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

$page = 0;
$resources = array();
$activeTags = array();
$resourcesIn = array();
$resourcesOut = array();
$whereVideo = array();
$wherePhoto = array();

$sortbyEscaped = !empty($sortbyEscaped) ? true : false;
$sortbyAlias = isset($sortbyAlias) ? $sortbyAlias : '';
$thumb = isset($thumb) ? $thumb : 'small';


if ($scriptProperties['parents'] == '' && empty($scriptProperties['resources'])) {
    $scriptProperties['resources'] = $modx->resource->get('id');
}

$alwaysIncludeScripts = isset($scriptProperties['alwaysIncludeScripts']) ? $scriptProperties['alwaysIncludeScripts'] : true;

if (!empty($scriptProperties['resources'])) {
    $resources = array_filter(array_map('trim', explode(',', $scriptProperties['resources'])));
}

if (!empty($scriptProperties['parents'])) {
    $tmp = array();
    $parents = array_filter(array_map('trim', explode(',', $scriptProperties['parents'])));
    $ctx = $modx->context->get('key');
    foreach ($parents as $parent) {
        $tmp = array_merge($tmp, $modx->getChildIds($parent, $depth, array('context' => $ctx)));
    }
    $resources = array_merge($resources, $tmp);
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
    $activeTags = $tags = array_map('trim', explode(',', str_replace('"', '', $tags)));

} else if (!empty($scriptProperties['tags'])) {
    $tags = array_map('trim', explode(',', str_replace('"', '', $scriptProperties['tags'])));
}

if (!empty($tags) && is_array($tags)) {
    $tags = implode('","', $tags);
}

if (!empty($_REQUEST[$scriptProperties['pageVarKey']])) {
    $page = (int)$_REQUEST[$scriptProperties['pageVarKey']];
}

$where = !empty($where) ? $modx->fromJSON($where) : array();
$options = $modx->fromJSON($modx->getOption('resvideogallery.thumb_options', null, '{"w":360,"h":270,"q":90,"zc":"1","f":"jpg","bg":"000000"}'));

if (!empty($resourcesIn)) {
    $whereVideo['RvgVideos.resource_id:IN'] = $resourcesIn;
}
if (!empty($resourcesOut)) {
    $where['RvgVideos.resource_id:NOT IN'] = $resourcesOut;
}

if (empty($showInactive)) {
    $whereVideo['RvgVideos.active'] = 1;
}


$qVideo = $modx->newQuery('RvgVideos');
$qVideo->innerJoin('modResource', 'Resource', 'RvgVideos.resource_id = Resource.id');
$qVideo->select($modx->getSelectColumns('RvgVideos', 'RvgVideos'));

if (!empty($tags)) {
    $qVideo->innerJoin('RvgVideosTags', 'Tag', 'RvgVideos.id = Tag.video_id AND Tag.tag IN ("' . $tags . '")');
}

$whereVideo = array_merge($where, $whereVideo);

if (!empty($whereVideo)) {
    $qVideo->where($whereVideo);
}

$qVideo->groupby('RvgVideos.id');

$totalVideo = $modx->getCount('RvgVideos', $qVideo);

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
    if (!empty($photoGalleryClass)) {
        $qPhoto = $modx->newQuery($photoGalleryClass);
        $qPhoto->innerJoin('modResource', 'Resource', $photoGalleryClass . '.' . $photoGalleryKey . ' = Resource.id');
        $qPhoto->leftJoin($photoGalleryClass, 'Photo', 'Photo.id = ' . $photoGalleryClass . '.parent');
        $qPhoto->select($modx->getSelectColumns($photoGalleryClass, $photoGalleryClass));
        $qPhoto->select('Photo.url as basic_url');

        if (!empty($photoGalleryTagClass) && !empty($tags)) {
            $qPhoto->innerJoin($photoGalleryTagClass, 'Tag', '(' . $photoGalleryClass . '.' . $photoGalleryKey . ' = Tag.file_id OR Photo.id = Tag.file_id) AND Tag.tag IN ("' . $tags . '")');
        }

        if (!empty($resourcesIn)) {
            $wherePhoto[$photoGalleryClass . '.' . $photoGalleryKey . ':IN'] = $resourcesIn;
        }
        if (!empty($resourcesOut)) {
            $wherePhoto[$photoGalleryClass . '.' . $photoGalleryKey . ':NOT IN'] = $resourcesOut;
        }

        if (empty($thumb)) {
            $wherePhoto[$photoGalleryClass . '.parent'] = 0;
        } else {
            $wherePhoto[$photoGalleryClass . '.path:LIKE'] = '%' . $thumb . '%';
        }
        if (empty($showInactive)) {
            $wherePhoto[$photoGalleryClass . '.active'] = 1;
        }

        $wherePhoto = array_merge($where, $wherePhoto);

        if (!empty($wherePhoto)) {
            $qPhoto->where($wherePhoto);
        }

        $qPhoto->groupby($photoGalleryClass . '.id');

        $totalPhoto = $modx->getCount($photoGalleryClass, $qPhoto);

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
        foreach($sorts as $sort => $dir){
            if ($sortbyEscaped) $sort = $modx->escape($sort);
           // if (!empty($sortbyAlias)) $sort = $modx->escape($sortbyAlias) . ".{$sort}";
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

if (!isset($scriptProperties['session_key']) || empty($scriptProperties['session_key'])) {
    $hash = sha1(serialize($scriptProperties));
    $_SESSION['resvideogallery'][$hash] = $scriptProperties;
} else {
    $hash = $scriptProperties['session_key'];
}

$data = array(
    'getTags' => $getTags,
    'width' => $options['w'],
    'height' => $options['h'],
    'autoPlay' => $autoPlay,
    'tplRow' => $tplRow,
    'key' => $hash,
    'thumb' => $thumb,
    'activeTags' => $activeTags,
    'photoGalleryKey' => $photoGalleryKey,
    'photoGalleryClass' => $photoGalleryClass,
    'photoGalleryTagClass' => $photoGalleryTagClass,
);

$output = '';
if (!empty($photoGalleryClass)) {
    if ($primarily == 'video') {
        $output = $rvg->renderQuery($qVideo, $data);
        $output .= $rvg->renderQuery($qPhoto, $data, true);

    } else {
        $output = $rvg->renderQuery($qPhoto, $data, true);
        $output .= $rvg->renderQuery($qVideo, $data);
    }
} else {
    $output = $rvg->renderQuery($qVideo, $data);
}


$config = array(
    'total' => $total,
    'offset' => $offset,
    'limit' => $limit,
    'page' => $page,
    'plPrefix' => $plPrefix,
    'autoPlay' => $autoPlay,
    'tagsVar' => $tagsVar,
    'pageVarKey' => $pageVarKey,
    'photoGallery' => $photoGallery,
    'actionUrl' => $rvg->config['actionUrl'],
    'pageId' => !empty($pageId) ? (integer)$pageId : $modx->resource->id,
    'mode' => in_array($scriptProperties['ajaxMode'], array('button', 'scroll')) ? $scriptProperties['ajaxMode'] : '',
    'lang' => $modx->getOption('manager_language'),
);

if (!empty($tpl)) {
    $output = $pdoTools->getChunk($tpl, array(
        'results' => $output,
        'total' => $total,
        'key' => $hash,
    ));
}

if ($alwaysIncludeScripts || $total) {

    if (!empty($css)) $modx->regClientCSS($rvg->preparePath($css));
    if (!empty($js)) $modx->regClientScript($rvg->preparePath($js));

    $modx->regClientScript('
<script type="text/javascript">
   new ResVideoGallery("' . $hash . '", ' . $modx->toJSON($config) . ');
 </script>', true);

}

return $output;