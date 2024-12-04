<?php  return '
if (!empty($_SERVER[\'HTTP_X_REQUESTED_WITH\']) && strtolower($_SERVER[\'HTTP_X_REQUESTED_WITH\']) == \'xmlhttprequest\' && !empty($_REQUEST[\'action\'])) {

  $eventName = $modx->event->name;

  switch($eventName) {
    case "OnLoadWebDocument":

      if($_REQUEST[\'action\'] == \'quick\' && $modx->resource->template == 10){
        $modx->resource->set(\'cacheable\', 0);
        $modx->resource->set(\'template\', 27);
      }

      break;
  }

}
return;
';