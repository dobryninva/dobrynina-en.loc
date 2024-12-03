<?php
$captcha_token = $hook->getValue('token');
$captcha_action = $hook->getValue('action');
$site_key = $modx->getOption('recaptcha.v3.site_key', null, '');
$secret_key = $modx->getOption('recaptcha.v3.secret_key', null, '');
$score = $modx->getOption('recaptcha.v3.score', null, '');
$url = 'https://www.google.com/recaptcha/api/siteverify';
$params = [
  'secret' => $secret_key,
  'response' => $captcha_token,
  'remoteip' => $_SERVER['REMOTE_ADDR']
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec($ch);
if(!empty($response)) $decoded_response = json_decode($response);

if ($decoded_response && $decoded_response->success){
  switch ($decoded_response->action){
    case 'form_load':
      if (($decoded_response->score > $score) && $decoded_response->success) {
        $success = true;
      } else {
        $hook->addError('token', 'Рекаптча не прошла проверку: '.$decoded_response->score);
        $success = false;
      }
      break;

    case 'form_send':
      if (($decoded_response->score > $score) && $decoded_response->success) {
        $success = true;
      } else {
        $hook->addError('token', 'Рекаптча не прошла проверку: '.$decoded_response->score);
        $success = false;
      }
      break;

    case 'checkout_send':
      if (($decoded_response->score > $score) && $decoded_response->success) {
        $success = true;
      } else {
        $hook->addError('token', 'Рекаптча не прошла проверку: '.$decoded_response->score);
        $success = false;
      }
      break;

    default:
      $hook->addError('token', 'Рекаптча не прошла проверку!');
      $success = false;
      break;
  }
} else {
  $hook->addError('token', 'Рекаптча не прошла проверку!');
  $success = false;
}
return $success;