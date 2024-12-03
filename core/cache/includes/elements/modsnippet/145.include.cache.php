<?php

if (is_array($options)) {
  if ($options['case']) {
    $case = $options['case'];
  } else return;
} else {
  $case = $options;
}

switch ($case) {
  case 'qq':
  case 'quotes':
    return str_replace('"', "'", $input);
    break;

  case 'q':
  case 'quote':
    return str_replace("'", '"', $input);
    break;

  case 'tel':
  case 'phone':
    return str_replace(array('(', ')', '-', ' '), '', $input);
    break;

  case 'num':
  case 'number':
    return str_replace(array(' ', ','), array('', '.'), strval($input));
    break;

  case 'viber':
    return str_replace(array('(', ')', '-', ' ', '+'), '', $input);
    break;

  // оставляем из массива $arr элементы с ключами 'key1','key2','key3'
  // {$arr | clean : ['case' => 'include', 'keys' => ['key1','key2','key3']]}
  case 'include':
    if (is_array($input) && !empty($input)) {
      $tmp_arr = array();
      foreach ($input as $i => $value) {
        if (in_array($i, $options['keys']) && !empty($value)) {
          $tmp_arr[$i] = $value;
        }
      }
      return $tmp_arr;
    } else return;
    break;

  // убираем из массива $arr элементы с ключами 'key1','key2','key3'
  // {$arr | clean : ['case' => 'exclude', 'keys' => ['key1','key2','key3']]}
  case 'exclude':
    if (is_array($input) && !empty($input)) {
      $tmp_arr = array();
      foreach ($input as $i => $value) {
        if (!in_array($i, $options['keys']) && !empty($value)) {
          $tmp_arr[$i] = $value;
        }
      }
      return $tmp_arr;
    } else return;
    break;

  default:
    return trim($input);
    break;
}
return;
