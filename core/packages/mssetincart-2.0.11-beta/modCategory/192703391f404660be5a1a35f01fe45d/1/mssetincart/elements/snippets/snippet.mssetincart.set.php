<?php

/** @var array $scriptProperties */
$corePath = $modx->getOption('mssetincart_core_path', null,
    $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/mssetincart/');
/** @var msSetInCart $msSetInCart */
$msSetInCart = $modx->getService('mssetincart', 'msSetInCart', $corePath . 'model/mssetincart/',
    array('core_path' => $corePath));
if (!$msSetInCart) {
    return 'Could not load msSetInCart class!';
}

$element = $scriptProperties['element'] = $modx->getOption('element', $scriptProperties, 'msProducts', true);
$tpl = $scriptProperties['tpl'] = $modx->getOption('tpl', $scriptProperties, 'tpl.msSetInCart.set', true);
$link = $scriptProperties['link'] = (int)$modx->getOption('link', $scriptProperties);
$master = $scriptProperties['master'] = (int)$modx->getOption('master', $scriptProperties, $modx->resource->id, true);

$setActive = $scriptProperties['setActive'] = (int)$modx->getOption('setActive', $scriptProperties, 1);
$setInput = $scriptProperties['setInput'] = $modx->getOption('setInput', $scriptProperties, 'checkbox', true);
$setMode = $scriptProperties['setMode'] = $modx->getOption('setMode', $scriptProperties, 'cart', true);
$setRemoveSlave = $scriptProperties['setRemoveSlave'] = $modx->getOption('setRemoveSlave', $scriptProperties, true);

$limit = $scriptProperties['limit'] = $modx->getOption('limit', $scriptProperties, 100, true);

if (isset($this) AND $this instanceof modSnippet AND $element == $this->get('name')) {
    $properties = $this->getProperties();
    $element = $scriptProperties['element'] = $modx->getOption('element', $properties, 'msProducts', true);
}

if (empty($link)) {
    return "[msSetInCart] The link with id = {$link} is not instance of msLink.";
}

$propkey = $scriptProperties['propkey'] = $modx->getOption('propkey', $scriptProperties,
    sha1(serialize($scriptProperties)), true);

$msSetInCart->initialize($modx->context->key, $scriptProperties);
$msSetInCart->saveProperties($scriptProperties);
$msSetInCart->loadResourceJsCss($scriptProperties);


$select = array();
$select[] = $modx->getSelectColumns('msProductLink', 'Link', 'mssetincart_');
foreach (array('propkey', 'setActive', 'setInput', 'setMode') as $k) {
    $key = 'mssetincart_' . strtolower(str_replace('set', '', $k));
    $select[] = "'{${$k}}' as {$key}";
}

$default = array(
    'parents' => 0,
    'select'  => array(
        'msProductLink' => $msSetInCart->cleanAndImplode($select)
    )
);

$output = '';
/** @var modSnippet $snippet */
if ($snippet = $modx->getObject('modSnippet', array('name' => $element))) {
    $scriptProperties = array_merge($default, $scriptProperties);
    $snippet->setCacheable(false);
    $output = $snippet->process($scriptProperties);
}

return $output;