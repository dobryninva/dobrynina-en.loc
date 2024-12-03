<?php
if (!function_exists('dd')){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
  }
}
$cur_id = $modx->resource->id;
$parent = $modx->getOption('parent', $scriptProperties, $cur_id);
$tplWrapper = $modx->getOption('tplWrapper', $scriptProperties, '');
$tplLetter = $modx->getOption('tplLetter', $scriptProperties, '');
$tplLink = $modx->getOption('tplLink', $scriptProperties, '');
$output = '';

// кэширование временно отключено, нужно дальнейшее тестирование
// $cache_dir = 'brands';
// $cache_options = array(xPDO::OPT_CACHE_KEY => $cache_dir, xPDO::OPT_CACHE_EXPIRES => 0);
// $path = MODX_CORE_PATH.'cache/resource/web/resources/'.$cur_id.'.cache.php';
// $cache_check = file_exists($path);
// if (!$cache_check){
  // $modx->cacheManager->delete($cur_id, $cache_options);

  $q = $modx->newQuery('modResource');
  $q->select(array(
      'id',
      'pagetitle',
      'menutitle',
      'link_attributes',
      'class_key'
  ));
  $q->where(array(
      'parent' => $cur_id,
      'published' => 1,
      'deleted' => 0
  ));
  $q->sortby('pagetitle', 'ASC');
  $q->prepare();
  if($q->stmt && $q->stmt->execute()){
    $docs = $q->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  if (!empty($docs)){
    $pdoTools = $modx->getService('pdoTools');

    $arABC = array();
    foreach($docs as $doc){
      $title = mb_strtolower($doc['pagetitle'], 'UTF-8');
      $fl = mb_substr($title, 0, 1, 'UTF-8');
      $arABC[$fl][] = $doc;
    }
    //asort($arABC);

    $cur_link = $modx->makeUrl($cur_id,'web');

    $abc_nav = '<ul class="menu menu_horz">';
    $abc_output = '';
    foreach ($arABC as $let => $arRes){
      $abc_nav .= '<li><a href="'.$cur_link.'#let_'.$let.'" data-target="#let_'.$let.'" rel="nofollow">'.$let.'</a></li>';
      $abc_links = '';
      foreach ($arRes as $key => $res){
        $res['link'] =  $modx->makeUrl($res['id'],'','','full');
        $abc_links .= $pdoTools->getChunk($tplLink, $res);
      }
      $abc_output .= $pdoTools->getChunk($tplLetter, array('abc_letter' => $let, 'abc_links' => $abc_links));
    }
    $abc_nav .= '</ul>';

    $output = $pdoTools->getChunk($tplWrapper, array('abc_nav' => $abc_nav, 'abc_output' => $abc_output));

    // $modx->cacheManager->set($cur_id, $output, 0, $cache_options);
  } else return;

// }else{
//   $output = $modx->cacheManager->get($cur_id, $cache_options);
// }

return $output;