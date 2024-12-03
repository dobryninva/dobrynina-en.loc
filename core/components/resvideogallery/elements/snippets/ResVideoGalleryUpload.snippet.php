<?php
/**
 * @var modX $modx
 * @var array $scriptProperties
 * @var Rvg $rvg
 * @var pdoTools $pdoTools
 */


require_once $modx->getOption('resvideogallery.core_path', null, $modx->getOption('core_path') . 'components/resvideogallery/') . 'model/resvideogallery/rvg.class.php';
$rvg = new Rvg($modx, $scriptProperties);

if (!is_object($rvg) || !($rvg instanceof Rvg)) return 'ResVideoGallery not found!';
if (!$pdoTools = $rvg->getPdoTools()) return 'PdoTools not found!';

$modx->lexicon->load('resvideogallery:video');

$usergroups = array_filter(array_map('trim', explode(',', $usergroups)));
$scriptProperties['resource'] = empty($scriptProperties['resource']) ? $modx->resource->get('id') : $scriptProperties['resource'];

if ($onlyAuth && !$modx->user->isAuthenticated('web')) return '';
if (!empty($usergroups) && !$modx->user->isMember($usergroups)) return '';

$hash = sha1(serialize($scriptProperties));
$_SESSION['resvideogallery:upload'][$hash] = $scriptProperties;


$config = array(
    'multiple' => $scriptProperties['multiple'],
    'actionUrl' => $rvg->config['actionUrl'],
);

if (!empty($css)) $modx->regClientCSS($rvg->preparePath($css));
if (!empty($js)) $modx->regClientScript($rvg->preparePath($js));

$modx->regClientScript('
<script type="text/javascript"> 
   new ResVideoGalleryUpload("' . $hash . '", ' . $modx->toJSON($config) . ');
 </script>', true);

return $pdoTools->getChunk($tpl, array(
        'key' => $hash,
        'multiple' => $multiple,
    )
);