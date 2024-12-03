<?php
$eventName = $modx->event->name;
switch($eventName) {
  case "OnUserSave":
  case "OnWebLogin":
		if($user->id){
			if(!empty($_COOKIE['favoriteList'])){
				$profile = $user->getOne('Profile');
				$fields = $profile->get('extended');

				$products = array();
				if(!empty($fields['favoriteList'])){
					// $products = json_decode($fields['favoriteList'],true);
					$products = array_map('trim', explode(',', $fields['favoriteList']));
				}
				$productsCookie = array_map('intval', array_map('trim', explode(',', $_COOKIE['favoriteList'])));
				$products = array_values(array_unique(array_merge($products, $productsCookie)));
				$fields['favoriteList'] = implode(',', $products);
				$profile->set('extended', $fields);
				$profile->save();
			}
		}
	 break;
}