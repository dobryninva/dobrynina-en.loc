<?php
if ($modx->context->key == 'mgr') {
	return;
}
$uri = $modx->getOption('REQUEST_URI', $_SERVER, '/');
if($modx->event->name == 'OnPageNotFound'){
    $scriptProperties['response_code'] = 'HTTP/1.1 410 Gone';
    $scriptProperties['error_type'] =  '410';
    $scriptProperties['error_header'] = 'HTTP/1.1 410 Gone';
    $scriptProperties['error_pagetitle'] = 'Error 410: Page gone';
    $scriptProperties['error_message'] = '<h1>Страница удалена навсегда</h1><p>Бывает, что товар не ожидается. Или статья устарела и не актуальна.</p>';
    $resource = $modx->getObject('modResource', array('alias'=>'410'));
    $modx->sendForward($resource->get('id'), $scriptProperties);
}
return;
