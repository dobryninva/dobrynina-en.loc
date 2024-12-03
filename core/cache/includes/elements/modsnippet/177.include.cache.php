<?php

$canonicalLink = "";
$docId = $modx->resource->get('id');
$modx->setPlaceholder('rid',$docId);
$query = $modx->newQuery("modSymLink");

$query->select(array(
    'id',
    'class_key',
    'content',
));
$query->where(array(
    'id' => $docId,
    'class_key' => 'modSymLink'
));

if ($query->prepare() && $query->stmt->execute()) {
    $symIndex = $query->stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Символическая ссылка
if (!empty($symIndex)) {
    $id = (integer) $symIndex[0]['content'];
    $canonicalLink = $modx->makeUrl($id, '', '', 'full');
}
elseif (!empty($_GET['page']) && $_GET['page'] > 1){
    // Страницы пагинации
    $canonicalLink = $modx->makeUrl($docId, '', '', 'full');
}
elseif ($link = $modx->resource->getTVValue('canonical')){
    $canonicalLink = MODX_URL_SCHEME . MODX_HTTP_HOST . rtrim(MODX_BASE_URL, '/') .'/'. ltrim($link, '/');
}
else{
    $canonicalLink = $modx->makeUrl($docId, '', '', 'full');
}

if (!empty($canonicalLink)) {
    return '<link rel="canonical" href="' . $canonicalLink . '" />';
}

return '';
return;
