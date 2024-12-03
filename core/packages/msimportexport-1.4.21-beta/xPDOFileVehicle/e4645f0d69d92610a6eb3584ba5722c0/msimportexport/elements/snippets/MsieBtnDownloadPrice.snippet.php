<?php
/**
 * MsieBtnDownloadPrice
 * @package msimportexport
 *
 */

/**
 * @var modX $modx
 * @var array $scriptProperties
 * @var Msie $msie
 */

$msie = $modx->getService('msimportexport', 'Msie', $modx->getOption('msimportexport.core_path', null, $modx->getOption('core_path') . 'components/msimportexport/') . 'model/msimportexport/', array());
$msie->initialize('web');
$modx->lexicon->load('msimportexport:price');

$scriptProperties['res'] = (!empty($res) || $res === '0') ? $res : $modx->resource->get('id');
$savedProperties = array();

if (!empty($usergroup)) {
    $usergroup = explode(',', $usergroup);
    if (!$modx->user->isMember($usergroup)) return;
}

$scriptProperties['sig'] = $msie->generateSig($scriptProperties);

$key = sha1(serialize($scriptProperties));
$_SESSION['MsieBtnDownloadPrice'][$key] = $scriptProperties;

$res = explode(',', $scriptProperties['res']);
array_walk($res, 'trim');
$res = array_unique($res);


$name = !empty($name) ? $name : (count($res) == 1 ? $msie->getResourcePageTitleById($res[0]) : '');

$modx->regClientScript($msie->config['jsUrl'] . 'web/' . $js);

return $msie->getInstanceMiniShop2()->pdoTools->getChunk($tpl, array(
    'name' => $name,
    'key' => $key,
));