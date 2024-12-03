<?php
/*
 * Сниппет роутинга ajax запросов для modx revolution.
 * Возвращает $output - json объект для js где все плэйсхолдеры это дочерние объекты
 *
 * Возможно потребуется создание чанков для использования сниппето внутри их
 *
 * @author Капустин Дмитрий Игоревич <021088z@gmail.com>
 * @version 1.0
 */

// require_once('./artmebius/snippets/ajaxRouter/index.php');
// return $output;

//список используемых сниппетов
// require_once('methods.php');
$methods = array(

  'searchTips' => array(
    'name' => 'SimpleSearch',
    'params' => array(
      'method'       => 'POST',
      'searchIndex'  => 'search',
      'containerTpl' => 'search.tips.wrapper',
      'tpl'          => 'search.tips.row',
      'noResultsTpl' => 'search.tips.empty',
      'showExtract'  => '0',
      'perPage'      => '10',
      'docFields'    => 'pagetitle,longtitle',
      'idType'       => 'parents', // только по каталогу
      'ids'          => '7', // только по каталогу
    )
  ),

  'addToFavorite' => array(
    'name' => 'favorite',
    'params' => array(
      'task' => $_POST['task'],
      'productId' => $_POST['productId'],
    )
  ),

  'geoIp' => array(
    'name' => 'citySelectAjaxRequest',
    'params' => array(
        'action'    => !empty($_REQUEST["action"]) ? $_REQUEST["action"] : '',
        'userip'    => !empty($_REQUEST["userip"]) ? $_REQUEST["userip"] : '',
        'location'  => !empty($_REQUEST["location"]) ? $_REQUEST["location"] : '',
        'ip'        => !empty($_REQUEST["ip"]) ? $_REQUEST["ip"] : '',
    )
  )

);

$request = $_POST;
$method = $methods[$request['method']];

if(isset($request['params']) && count($request['params']) > 0){
  $method['params'] = array_merge($method['params'], $request['params']);
}

if(!empty($method)){
  $output = $modx->runSnippet($method['name'], $method['params']);
  return $output;
}