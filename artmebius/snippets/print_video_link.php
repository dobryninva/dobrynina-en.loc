<?php
/**
* print_video_link
*
* @version v.1.0
*
* @example
* {'print_video_link' | snippet : ['url'=>'', 'title'=>'']}
* [[print_video_link? &url=`` &title=``]]
*
* @var string $url - ссылка на видео, обязательное
* @var string $title - заголовок видео, необязательные
* @var string $toPlaceholder - описание, необязательные
*
* @return string возвращает $output с ссылкой на видео или устанавливает плейсхолдеры в $toPlaceholder
*/

$output = '';
$result = $errors = array();

$tpl = $modx->getOption('tpl', $scriptProperties, '');
$url = $modx->getOption('url', $scriptProperties, '');
$result['title'] = $modx->getOption('title', $scriptProperties, '');

if (empty($url)) {
  // unset placeholders mb?
  return;
}

$parsed_url = parse_url($url);
switch ($parsed_url['host']) {

  case 'rutube.ru':
    $result['host'] = 'rutube';
    $result['id'] = end(array_diff(explode('/', $parsed_url['path']), array('')));
    $result['embed_link'] = 'https://rutube.ru/play/embed/'.$result['id'];
    break;

  case 'youtu.be':
    $result['host'] = 'youtube';
    $result['id'] = str_replace('/', '', $parsed_url['path']);
    $result['embed_link'] = 'https://www.youtube.com/embed/'.$result['id'].'?rel=0&amp;wmode=transparent&showinfo=0';
    break;

  case 'www.youtube.com':
  case 'youtube.com':
  default:
    parse_str($parsed_url['query'], $vars);
    $result['host'] = 'youtube';
    $result['id'] = $vars['v'];
    $result['embed_link'] = 'https://www.youtube.com/embed/'.$result['id'].'?rel=0&amp;wmode=transparent&showinfo=0';
    break;
}

switch ($result['host']) {
  case 'rutube':
    if ($xml = simplexml_load_file("https://rutube.ru/api/video/".$result['id']."/?format=xml")) {
      $result['thumb'] = (string)$xml->thumbnail_url;
    }
    break;

  case 'youtube':
    $result['thumb'] = 'https://i1.ytimg.com/vi/'.$result['id'].'/0.jpg'; // 0 default hqdefault mqdefault sddefault maxresdefault
    break;
}

$pdoTools = $modx->getService('pdoTools');

if (empty($tpl)) {
  $tpl = '@INLINE <a class="video_item_preview_link youtube" href="{$embed_link}" title="{$title | clean : \'qq\'}">
      <span class="video_item_preview_link_image">
        <img src="{$thumb}" alt="{$title | clean : \'qq\'}">
      </span>
      <span class="video_item_preview_link_text">{$title}</span>
    </a>';
}

if (empty($errors)) {

  $output = $pdoTools->getChunk($tpl, $result);

  if($toPlaceholder){
    $modx->setPlaceholder($toPlaceholder, $output);
    $output = '';
  }

} // empty($errors)

if (!empty($errors)) {
  if (empty($tpl_errors)) {
    $tpl_errors = '@INLINE <div class="alert alert-danger" role="alert">{$error}</div>';
  }
  foreach ($errors as $e => $error) {
    $output .= $pdoTools->getChunk($tpl_errors, array('error' => $error));
  }
}

return $output;