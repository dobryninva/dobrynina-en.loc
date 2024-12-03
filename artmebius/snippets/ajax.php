<?php
// Подключаем API MODX'a
require_once dirname(dirname(dirname(__FILE__))).'/config.core.php';
require_once MODX_CORE_PATH.'model/modx/modx.class.php';
$modx = new modX();
$modx->initialize('web');

// Включаем обработку ошибок
$modx->getService('error','error.modError', '', '');
$modx->setLogLevel(modX::LOG_LEVEL_FATAL);
$modx->setLogTarget(XPDO_CLI_MODE ? 'ECHO' : 'HTML');
$modx->error->message = null; // Обнуляем переменную

if (!function_exists(is_ajax)) {
  function is_ajax(){
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest');
  }
}

// Определение действия сниппета
if ((empty($_REQUEST['action']) && empty($_SERVER['HTTP_ACTION'])) || !is_ajax()) {
  die;
}

// Также можем передавать скрипту $action через Header - Action
$action = (!empty($_SERVER['HTTP_ACTION'])) ? $_SERVER['HTTP_ACTION'] : $_REQUEST['action'];

$funs = $modx->getService('funs', 'functions', MODX_BASE_PATH.'artmebius/snippets/model/');

$tpl_option = '@INLINE <option value="{$id}">{$menutitle ?: $pagetitle}</option>';

// Вызов нужного метода
switch ($action) {

  case 'subscribe':
    if (!empty($_REQUEST['subscribe_params'])) {
      $params = json_decode(urldecode($_REQUEST['subscribe_params']),1);
      $output = $modx->runSnippet('SendexExt', $params);
    }
    break;

  case 'get_prod_preview':
    if (!empty($_REQUEST['rid'])) {
      $id = $_REQUEST['rid'];
      $prod = $modx->getObject('modResource', $id);
      $prod = $prod->toArray();

      $tpl = '@INLINE
        <div class="product-preview">
          <div class="product-preview__img-wrap">
            <img class="product-preview__img" src="{$image | phpthumbon : \'&h=240&zc=0&aoe=1&bg=eeeeee\'}" alt="{$title|clean:\'qq\'}">
          </div>
          <div class="product-preview__title">{$title}</div>
          {if $price > 0}
          <div class="product-preview__price">Цена: {$price|num_format} руб.</div>
          {/if}
        </div>
        <input type="hidden" name="pagetitle" value="{$title|clean:\'qq\'}">
        <input type="hidden" name="resource_id" value="{$id}">
      ';

      $output = $pdoTools->getChunk($tpl, [
        'image' => $prod['image'],
        'title' => $prod['pagetitle'],
        'price' => $prod['price'],
        'id'    => $prod['id'],
      ]);

    } else {
      $output['error'] = 'empty id';
    }
    break;

  case 'get_full_menu':
    $params = [
      'select'             => '{"modResource":"id,parent,template,menuindex,pagetitle,menutitle,link_attributes,class_key,content"}',
      'parents'            => 0,
      'level'              => 10,
      'showHidden'         => 0,
      'sortby'             => 'menuindex',
      'sortdir'            => 'ASC',

      'tplOuter'           => 'menu.ul',
      'tpl'                => 'menu.li',
      'tplParentRow'       => 'menu.li.parent',
      'tplParentRowActive' => 'menu.li.parent.active',

      'outerClass'         => 'menu menu_vert_accord menu_accord_tablet',
      'innerClass'         => 'sub_menu',
      'rowClass'           => 'menu_item',
      'selfClass'          => 'current',
      'parentClass'        => 'parent',
      'hereClass'          => 'active'
    ];
    $output = $modx->runSnippet('pdoMenu', $params);
    break;

  case 'get_catalog_menu':
    $params = [
      'select'             => '{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key"}',
      'parents'            => 7,
      'level'              => 0,
      'showHidden'         => 1,
      'sortby'             => 'menuindex',
      'sortdir'            => 'ASC',
      'where'              => '{"template:IN":[9]}',

      // 'displayStart' => 1,
      // 'tplStart' => 'menu.li.start',

      'tplOuter'           => 'menu.ul',
      'tpl'                => 'menu.li',
      'tplParentRow'       => 'menu.li.parent',
      'tplParentRowActive' => 'menu.li.parent.active',

      'outerClass'         => 'menu menu_vert_slide',
      'innerClass'         => 'sub_menu',
      'rowClass'           => 'menu_item',
      'selfClass'          => 'current',
      'parentClass'        => 'parent',
      'hereClass'          => 'active'
    ];
    // catalog + brands
    // $catalog_params = [
    //   'parents'            => 7,
    //   'where'              => '{"template:IN":[0,9]}',
    // ];
    // $brands_params = [
    //   'displayStart'       => 1,
    //   'tplStart'           => 'menu.li.start',
    //   'parents'            => 25,
    //   'where'              => '{"template:IN":[9,19]}',
    // ];
    // $catalog_menu = $modx->runSnippet('pdoMenu', array_merge($params, $catalog_params));
    // $brands_menu = $modx->runSnippet('pdoMenu', array_merge($params, $brands_params));
    // $output = $catalog_menu . $brands_menu;
    $output = $modx->runSnippet('pdoMenu', $params);
    break;

  case 'get_gallery_album':
    if (!empty($_REQUEST['album'])) {
      $album = $_REQUEST['album'];
      $params = [
        'useCss'        => 0,
        'album'         => $album,
        'limit'         => 0,

        'thumbWidth'    => 100,
        'thumbHeight'   => 75,
        'thumbZoomCrop' => 1,
        'thumbFar'      => 1,
        'thumbQuality'  => 75,

        'linkToImage'   => 1,
        'thumbTpl'      => 'gallery.ajax.row',
        'containerTpl'  => 'gallery.grid.wrapper',
      ];
      $output = $modx->runSnippet('GalleryExt', $params);
    }
    break;

  case 'get_ticket_comment':
    if (!empty($_REQUEST['id'])) {
      $id = $_REQUEST['id'];
      $output['review'] =  $funs->db_select('TicketComment', 'name, text', ['id' => $id]);
    }
    break;

  case 'get_prod_data':
    if (!empty($_REQUEST['id'])) {
      $id = $_REQUEST['id'];
      $prod = $modx->getObject('msProductData', $id);
      $options = $prod->getMany('Options');

      $output = $prod->toArray();
      foreach ($options as $k => $option) {
        $tmp = $option->toArray();
        $output['options'][$tmp['key']] = $tmp['value'];
      }
    } else {
      $output['error'] = 'empty id';
    }
    break;

  case 'search':
    $output = $modx->runSnippet('SimpleSearch',array(
      'method'       => 'POST',
      'searchIndex'  => 'search',
      'containerTpl' => 'sf_tipsWrapper',
      'tpl'          => 'sf_tipsRow',
      'noResultsTpl' => 'sf_tipsEmpty',
      'showExtract'  => 0,
      'perPage'      => 10
    ));
    break;

  case 'get_ip':
  case 'get_uesr_ip':
    if(!empty($_SERVER["HTTP_X_REAL_IP"])){
      $ip = $_SERVER["HTTP_X_REAL_IP"];
    }else{
      $ip = $_SERVER["REMOTE_ADDR"];
    }
    $output['ip'] = $ip;
    break;

  case 'check_city_by_ip':
    $ip = $_REQUEST["ip"];
    $sql = "SELECT `city` FROM `cities` WHERE `ip` = '" . $ip . "' ORDER BY `id` DESC LIMIT 1;";
    $stmt = $modx->prepare($sql);
    if (!$stmt->execute()) {
      $modx->log(1, print_r($stmt->errorInfo(), true) . ' SQL: ' . $sql);
    } else {
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    $output = ($result) ? $result : array('city' => false);
    break;

  case 'proccess_city':
    $output = array('success' => true);
    $ip = $_REQUEST["ip"];
    $city = $_REQUEST["city"];

    $sql = "SELECT count(*) FROM `cities` WHERE `ip` = '" . $ip . "'";
    $stmt = $modx->prepare($sql);
    if (!$stmt->execute()) {
      $modx->log(1, print_r($stmt->errorInfo(), true) . ' SQL: ' . $sql);
      $count = null;
      $output['success'] = false;
    } else {
      $count = $stmt->fetchColumn();
      $output['count'] = $count;
    }

    if (!is_null($count) && $count > 0) {
      $sql = "UPDATE `cities` SET `city` = '{$city}' WHERE `ip` = '" . $ip ."'";
    } else {
      $sql = "INSERT INTO `cities` (`ip`, `city`) VALUES ('{$ip}', '{$city}')";
    }
    $output['sql'] = $sql;
    $stmt = $modx->prepare($sql);
    if (!$stmt->execute()) {
      $modx->log(1, print_r($stmt->errorInfo(), true) . ' SQL: ' . $sql);
      $output['success'] = false;
    }
    break;

  case 'cities_get':
  case 'get_cities':
    $cities = $modx->getChunk('cities');
    $output['cities'] = $cities;
    break;

  case 'hello_world':
    $output = 'Hello World!';
  break;

  default: $output = '';
}

if (is_ajax() && !empty($output)) {
  header('Content-Type: application/json; charset=UTF-8');
  echo json_encode($output);die;
} else {
  die;
}