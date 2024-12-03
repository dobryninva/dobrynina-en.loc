<?php

$id = ''; //id родителя

$parent = $modx->getObject('modResource', $id);
$resources = $modx->getCollection('modResource', array(
    'parent' => $parent->get('id')
));

foreach ($resources as $resource) {
    $response = $modx->runProcessor('resource/delete', array('id' => $resource->get('id')));
    //if ($responseDelete->isError()) return $response->getMessage();
}

$modx->runProcessor('resource/emptyrecyclebin');

return 'Все дочерние ресурсы удалены';

?>
