<?php
if($scriptProperties["action"] == "insert-city"){
    $ip = $scriptProperties["userip"];
    $city = $scriptProperties["location"];
    $res = $modx->query("INSERT INTO cities (ip, city) VALUES('$ip', '$city')");
    echo 'OK';
    //sleep(60);
    // $GLOBALS['USER_CITY'] = $city;
}
if($scriptProperties["action"] == "choose-city"){
    $ip = !empty($scriptProperties["userip"]) ? $scriptProperties["userip"] : $_SERVER["HTTP_X_FORWARDED_FOR"];
    // $ip = $scriptProperties["userip"];
    $city = $scriptProperties["location"];
    $res = $modx->query("INSERT INTO cities (ip, city) VALUES('$ip', '$city')");
    //sleep(60);
    // $GLOBALS['USER_CITY'] = $city;
    // setcookie('sel_city',urlencode($city), 0,'/');
}
if($scriptProperties["action"] == "checkIP"){
    $ip = !empty($scriptProperties["ip"]) ? $scriptProperties["ip"] : $_SERVER["HTTP_X_FORWARDED_FOR"];
    $sel = "SELECT ip, city FROM cities WHERE ip='".$ip. "' ORDER BY id DESC LIMIT 1;";
    $row = $modx->query($sel);
    $arResult = $row->fetch(PDO::FETCH_ASSOC);
    if($arResult['city'] != ''){
        // setcookie('sel_city',urlencode($arResult['city']), 0,'/');
        echo $arResult['city'];
    }else{
         echo "";
     }
     $arResult = null;
     $row = null;
     //sleep(60);
}

if($scriptProperties["action"] == "getIP"){
    $ip = $_SERVER["REMOTE_ADDR"];
    echo $ip;
}