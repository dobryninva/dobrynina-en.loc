<?php
switch ($modx->event->name) {
  case 'OnBeforeDocFormSave':
    //if(strpos($resource->get('uri'),'katalog') !== false){}
    $exclude = array(1,2,3,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,24,25,27);
    $id = $resource->get('id');
    $title = $resource->get('pagetitle');
    $old_alias = $resource->get('alias');
    $new_alias = $resource->cleanAlias($title);
    if  (!in_array($id, $exclude) && (empty($old_alias) || $new_alias !== $old_alias)) {
      $resource->set('alias', $new_alias);
    }
  break;
}
return;
