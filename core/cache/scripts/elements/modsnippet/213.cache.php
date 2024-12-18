<?php  return '/** @var array $scriptProperties */
/** @var Sendex $Sendex */
$Sendex = $modx->getService(\'sendex\',\'Sendex\',$modx->getOption(\'sendex_core_path\',null,$modx->getOption(\'core_path\').\'components/sendex/\').\'model/sendex/\',$scriptProperties);
if (!($Sendex instanceof Sendex)) return \'\';
$is_fenom = $modx->getOption(\'pdotools_fenom_parser\');
if ($is_fenom) {
  $pdoTools = $modx->getService(\'pdoTools\');
}

$site_name = $modx->getOption(\'site_name\');
$emailsender = $modx->getOption(\'emailsender\');

$tplSubscribeAuth = $modx->getOption(\'tplSubscribeAuth\',$scriptProperties,\'tpl.Sendex.subscribe.auth\');
$tplSubscribeGuest = $modx->getOption(\'tplSubscribeGuest\',$scriptProperties,\'tpl.Sendex.subscribe.guest\');
$tplUnsubscribe = $modx->getOption(\'tplUnsubscribe\',$scriptProperties,\'tpl.Sendex.unsubscribe\');
$tplActivate = $modx->getOption(\'tplActivate\',$scriptProperties,\'tpl.Sendex.activate\');
if (empty($linkTTL)) {$linkTTL = 1800;}

if (empty($id) || !$newsletter = $modx->getObject(\'sxNewsletter\', $id)) {
    return $modx->lexicon(\'sendex_newsletter_err_ns\');
}

/** @var sxNewsletter $newsletter */
if (!$newsletter->active && empty($showInactive)) {
    return $modx->lexicon(\'sendex_newsletter_err_disabled\');
}

$placeholders = $newsletter->toArray();
$placeholders[\'message\'] = \'\';
$placeholders[\'class\'] = \'\';
$placeholders[\'error\'] = 0;
if ($modx->user->isAuthenticated($modx->context->key)) {
    $placeholders = array_merge(
        $modx->user->toArray(),
        $modx->user->Profile->toArray(),
        $placeholders
    );
}

$isAuthenticated = $modx->user->isAuthenticated($modx->context->key);

if (!empty($_REQUEST[\'sx_action\'])) {
    $isAjax = isset($_SERVER[\'HTTP_X_REQUESTED_WITH\']) && $_SERVER[\'HTTP_X_REQUESTED_WITH\'] == \'XMLHttpRequest\';

    $params = $_GET;
    unset($params[$modx->getOption(\'request_param_alias\')]);
    unset($params[$modx->getOption(\'request_param_id\')]);

    switch ($_REQUEST[\'sx_action\']) {
        case \'subscribe\':
            if (empty($_REQUEST[\'token\'])) return;

            if ($isAuthenticated && $modx->user->id) {
                if (!$response = $newsletter->Subscribe($modx->user->id)) {
                    $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_err_email_wrong\');
                    $placeholders[\'error\'] = 1;
                }
            } elseif (!empty($_REQUEST[\'email\'])) {
                $email = htmlentities(strip_tags(urldecode($_REQUEST[\'email\'])));
                $response = $newsletter->checkEmail($email, $modx->user->id, $linkTTL);
                if ($response === true) {
                    $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_err_already\');
                    $placeholders[\'is_answer\'] = 1;
                } elseif ($response === false) {
                    $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_err_email_wrong\');
                    $placeholders[\'error\'] = 1;
                } else {
                    $params[\'hash\'] = $response;
                    $params[\'sx_action\'] = \'confirm\';
                    $resource_id = $modx->getOption(\'resource_id\', $scriptProperties, $modx->resource->id);
                    $placeholders[\'link\'] = $modx->makeUrl($resource_id, $modx->context->key, $params, \'full\');
                    $placeholders[\'email_body\'] = ($is_fenom) ? $pdoTools->getChunk($tplActivate, $placeholders) : $modx->getChunk($tplActivate, $placeholders);
                    $response = $Sendex->sendEmail($email, $placeholders);
                    if ($response !== true) {
                        $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_err_email_send\');
                        $placeholders[\'error\'] = 1;
                    } else {
                        $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_email_subscribed\');
                        $params[\'sx_subscribed\'] = 1;
                        $placeholders[\'is_answer\'] = 1;
                        $Sendex->sendEmail($emailsender, [
                          \'email_subject\' => \'Появился новый подписчик на \'.$site_name.\'!\',
                          \'email_body\' => \'Новый подписчик: \' . $email,
                          // \'email_from\' => \'\', // emailsender
                          // \'email_from_name\' => \'\', // site_name
                        ]);
                    }
                }
            } else {
                $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_err_email_ns\');
                $placeholders[\'error\'] = 1;
            }
            unset($params[\'email\'], $params[\'hash\']);
            break;
        case \'confirm\':
            if (!empty($_REQUEST[\'hash\'])) {
                $response = $newsletter->confirmEmail($_REQUEST[\'hash\']);
                $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_email_confirmed\');
                $placeholders[\'is_answer\'] = 1;
                $params[\'sx_confirmed\'] = 1;
                unset($params[\'hash\']);
            }
            break;
        case \'unsubscribe\':
            if (!empty($_REQUEST[\'code\'])) {
                $response = $newsletter->unSubscribe($_REQUEST[\'code\']);
                $placeholders[\'message\'] = $modx->lexicon(\'sendex_subscribe_email_unsubscribed\');
                $placeholders[\'is_answer\'] = 1;
                $params[\'sx_unsubscribed\'] = 1;
            }
            unset($params[\'code\']);
            break;
    }

    unset($params[\'sx_action\']);
    if (!$isAjax && empty($placeholders[\'message\'])) {
        $modx->sendRedirect($modx->makeUrl($modx->resource->id, $modx->context->key, $params, \'full\'));
    }
}

if (!empty($placeholders[\'message\'])) {
    $placeholders[\'class\'] = $modx->getOption(\'msgClass\',$scriptProperties,\'active\');
}

if ($isAuthenticated && $id = $newsletter->isSubscribed($modx->user->id)) {
    if ($subscriber = $modx->getObject(\'sxSubscriber\', $id)) {
        $placeholders = array_merge($subscriber->toArray(), $placeholders);
    }
    $output = ($is_fenom) ? $pdoTools->getChunk($tplUnsubscribe, $placeholders) : $modx->getChunk($tplUnsubscribe, $placeholders);

} else {
    $output = $isAuthenticated
        ? ( ($is_fenom) ? $pdoTools->getChunk($tplSubscribeAuth, $placeholders) : $modx->getChunk($tplSubscribeAuth, $placeholders) )
        : ( ($is_fenom) ? $pdoTools->getChunk($tplSubscribeGuest, $placeholders) : $modx->getChunk($tplSubscribeGuest, $placeholders) );
}

if (!empty($isAjax)) {
    @session_write_close();
    exit($output);
} else {
    return $output;
}
return;
';