<?php
/*
пример:
[[+id:in_favorite=`active||inactive`]]
*/

if(!isset($options)) $options = 'active';
$opt_arr = explode('||',$options);
if(count($opt_arr)<2) $opt_arr[1] = ' ';

$favoriteIds_arr = !empty($_COOKIE['favoriteList']) ? array_map('intval', array_map('trim', explode(',', $_COOKIE['favoriteList']))) : array();
return in_array($input,$favoriteIds_arr) ? $opt_arr[0] : $opt_arr[1];