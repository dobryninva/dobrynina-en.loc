<?php
if ($_POST['face']=='Юридическое лицо'){
  $success = empty($value);
  if ($success) {
    $validator->addError($key,'Это поле обязательно для заполнения.');
  }
  return $success;
} else {
  return true;
}