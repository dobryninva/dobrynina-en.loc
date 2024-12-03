<?php
$regexp = '/^(8|\+7)[\- ]?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/i';
preg_match($regexp, $value, $matches);

if(!empty($matches) && !empty($matches[0]) == true ){
    return true;
}else{
    $validator->addError($key,'Вы указали телефон в неверном формате.');
}