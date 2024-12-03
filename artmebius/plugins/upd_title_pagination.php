<?php
if ($modx->context->get('key') == 'mgr') {
    return;
}
if($modx->context->get('key') != "mgr"){

  switch ($modx->event->name) {
    case 'OnWebPagePrerender':
      if ($_GET['page'] && $_GET['page'] > 1)
      {
        $pt = &$modx->resource->pagetitle;
        $lt = &$modx->resource->longtitle;
        $output = &$modx->resource->_output;
        if (!empty($lt))
        {
          $output = str_replace($lt, $pt, $output);
        }
      }
      break;
  }
  
}