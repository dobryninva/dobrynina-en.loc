<?php
$deliveries = array(
    'Курьерская доставка',
    'Доставка по Автозаводскому району',
    'Доставка по Ленинскому району',
    'Доставка в другие районы',
    'Доставка по Нижнему Новгороду',
    'Доставка по Нижегородской области',
    'Доставка в другой город',
);
if (in_array($_POST['shk_delivery'], $deliveries)){
  $success = empty($value);
  if ($success) {
    $validator->addError($key,'Это поле обязательно для заполнения.');
  }
  return $success;
} else {
  return true;
}