<?php
/**
* get_set_price
*
* @version v.1.1
*
* @example
* {set $set_price = '!get_set_price' | snippet : ['link' => 1]}
*
* @var integer $master - id ресурса, по умолчанию текущий, обязательное
* @var integer $link - id связи, обязательное
*
* @return array возвращает $output в котором массив цен: price - сумма цен связей или если они пустые - товаров; old_price - сумма цен товаров
*/

$funs = $modx->getService('funs', 'functions', MODX_BASE_PATH.'artmebius/snippets/model/');
$master = (int)$modx->getOption('master', $scriptProperties, $modx->resource->id, true);
$link = (int)$modx->getOption('link', $scriptProperties, '', true);

if (empty($master) || empty($link)) return false;

$where = array('master' => $master, 'link' => $link, 'count:>' => 0);
$output = [
  'price' => 0,
  'old_price' => 0,
];
$links_price = 0;
$prods_price = 0;

if ($funs->db_count('msProductLink', $where)) {
  $links_price = $funs->db_select('msProductLink', 'SUM(`count`*`price`)', array('master' => $master, 'link' => $link, 'count:!=' => 0), 'column');

  $q = $modx->newQuery('msProductLink');
  $q->setClassAlias('links');
  $q->leftJoin('msProductData','product', array('product.id = links.slave'));
  $q->select('SUM(`links`.`count`*`product`.`price`)');
  $q->where([
    'links.master' => $master,
    'links.link' => $link
  ]);
  $q->prepare();
  // print $q->toSQL();die;
  if($q->stmt && $q->stmt->execute()){
    $prods_price = $q->stmt->fetch(PDO::FETCH_COLUMN);
  }
  $q->stmt->closeCursor();

  if ((int)$links_price > 0) {
    $output['price'] = (int)$links_price;
    $output['old_price'] = (int)$prods_price;
  } else {
    $output['price'] = (int)$prods_price;
    $output['old_price'] = (int)$prods_price; // или 0, хз как удобнее
  }

}

return $output;