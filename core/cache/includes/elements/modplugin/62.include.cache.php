<?php
if ($modx->event->name != 'OnMODXInit') {
    return;
}

$modx->loadClass('msProductLink');

$modx->map['msProductLink']['fields']['count'] = 0;
$modx->map['msProductLink']['fieldMeta']['count'] = array(
    'dbtype'     => 'int',
    'precision'  => '10',
    'phptype'    => 'integer',
    'attributes' => 'unsigned',
    'null'       => false,
    'default'    => 0,
);

$modx->map['msProductLink']['fields']['price'] = '';
$modx->map['msProductLink']['fieldMeta']['price'] = array(
    'dbtype'    => 'varchar',
    'precision' => 255,
    'phptype'   => 'string',
    'null'      => false,
    'default'   => '',
);
return;
