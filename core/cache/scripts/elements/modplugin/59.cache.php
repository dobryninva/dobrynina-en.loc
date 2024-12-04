<?php  return '
$eventName = $modx->event->name;
switch($eventName) {
    case "OnResourceTVFormRender":
    if (!$modx->user->isMember(\'Administrator\') ) {
        return;
    }
    foreach ($categories as $id => & $category) {
        if (!empty($category[\'tvs\'])) {
            foreach ($category[\'tvs\'] as $key => & $tv) {
                // if($tv->id == 20){
                //     $tv->type = "hidden";
                //     $tv->formElement = "";
                // }
                $tv->caption = "<a href=\'/manager/?a=element/tv/update&id={$tv->id}\' target=\'_blank\' style=\'font-size: 16px; color: #555; vertical-align: middle;\'><i class=\'icon icon icon-edit\'></i></a> ".$tv->caption;
            }
        }
    }
    break;
}
return;
';