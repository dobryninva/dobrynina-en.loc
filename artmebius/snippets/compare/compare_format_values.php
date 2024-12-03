<?php
if ($miniShop2 = $modx->getService('minishop2')) {

// Получаемые массивы нужно преобразовать в строку, иначе вы получите слово Array, вместо значения
if (is_array($value)) {
  natsort($value);
  $value = implode(',', $value);
}

// Форматирование цены и веса товаров miniShop2
  switch ($field) {
    case 'data.price':
      if (empty($value) || $value == 0) {
        $value = 'Цена по запросу';
      } else {
        $value = $miniShop2->formatPrice($value) . ' ' . $modx->lexicon('ms2_frontend_currency');
      }
      break;
  }
}

// Возвращаем значение
return $value;

?>