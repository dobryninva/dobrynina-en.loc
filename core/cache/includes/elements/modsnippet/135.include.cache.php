<?php

$products = array();
// error_reporting(PHP_INT_MAX);
// ini_set('display_errors', true);
$productId = intval($_POST['productId']);
if($productId){
	switch ($_POST['task']) {
		case 'add':
			// если юзер авторизован, кладем в доп. поле favoriteList
			if ($modx->user->isAuthenticated('web')) {
				$profile = $modx->user->getOne('Profile');
				$fields = $profile->get('extended');
				
				if(!isset($fields['favoriteList'])){
					$products[] = $productId;
				}
				else {
					$products = array_map('trim', explode(',', $fields['favoriteList']));
					if(!in_array($productId, $products)){
						$products[] = $productId;
					}
				}
				
				$fields['favoriteList'] = implode(",", $products);
				$profile->set('extended', $fields);
				$profile->save();
			}
			// если юзер не авторизован, кладем в куку
			else {
				if(!isset($_COOKIE['favoriteList'])){
					$products[] = $productId;
				}
				else {
					$products = array_map('trim', explode(',', $_COOKIE['favoriteList']));
					if(!in_array($productId, $products)){
						$products[] = $productId;
					}
				}
			}
			setcookie('favoriteList', implode(",", $products), time()+3600*24*7, "/", MODX_HTTP_HOST);
			
			return json_encode(array(
				"count" => count($products), 
			));
		break;		
		case 'remove':
			if ($modx->user->isAuthenticated('web')) {
				$profile = $modx->user->getOne('Profile');
				$fields = $profile->get('extended');
				
				if($fields['favoriteList']){
					$products = array_map('trim', explode(',', $fields['favoriteList']));
					$key = array_search($productId, $products);
					unset($products[$key]);
					array_values($products);
				
					$fields['favoriteList'] = implode(",", $products);
					$profile->set('extended',$fields);
					$profile->save();
				}
			}
			else {
				if($_COOKIE['favoriteList']){
					$products = array_map('trim', explode(',', $_COOKIE['favoriteList']));
					$key = array_search($productId, $products);
					unset($products[$key]);
					array_values($products);
				}
			}
			setcookie('favoriteList', implode(",", $products), time()+3600*24*7, "/", MODX_HTTP_HOST);

			return json_encode(array(
				"count" => count($products), 
			));
		break;
	}
}

$showList = $modx->getOption('tpl', $scriptProperties, 'favorite.chunk');

if(!empty($_COOKIE['favoriteList'])) {
	$products = array_map('intval', array_map('trim', explode(',', $_COOKIE['favoriteList'])));
}
else {
	if ($modx->user->isAuthenticated('web')) {
		$profile = $modx->user->getOne('Profile');
		$fields = $profile->get('extended');
		if(!empty($fields['favoriteList'])){
			$products = array_map('intval', array_map('trim', explode(',', $fields['favoriteList'])));

			setcookie('favoriteList', implode(",", $products), time()+3600*24*7, "/", 	MODX_HTTP_HOST);
		}
	}
}

$modx->setPlaceholders(array(
	"count" => count($products),
	"items" => implode(",", $products)
), 'favorite.');
return;
