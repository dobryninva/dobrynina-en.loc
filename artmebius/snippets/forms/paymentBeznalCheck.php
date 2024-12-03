<?php
if ($_POST['payment']=='Безналичный расчёт'){
  $success = empty($value);
  if ($success) {
    $validator->addError($key,'Это поле обязательно для заполнения.');
  }
  return $success;
} else {
  return true;
}