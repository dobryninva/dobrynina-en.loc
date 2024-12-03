<?php
/*
*	перед кастомными валидаторами можно прокидывать параметры из сниппета
*	&fileValidatorExtensions=`xls, doc, xlsx, docx, txt, jpg, jpeg, gif, png`
*	&fileValidatorMaxFileSize=`7000000`
*	&customValidators=`fileValidator`
*/

$errors = array();
$extensions = (trim($fileValidatorExtensions) == '' || !isset($fileValidatorExtensions)) ? 'xls, doc, xlsx, docx, txt, jpg, jpeg, gif, png' : $fileValidatorExtensions;
$extensions = explode(',', str_replace(' ', '', $extensions));
$maxFileSize = (trim($fileValidatorMaxFileSize) == '' || !isset($fileValidatorMaxFileSize)) ? 2000000 : (integer) $fileValidatorMaxFileSize;

//if(!isset($value['name']) && trim($value['name']) == '') $errors[] = 'Выберите файл со списком покупок';

if(isset($value['name']) && trim($value['name']) != ''){
  $info = new SplFileInfo($value['name']);

  if(@array_search(@strtolower($info->getExtension()), $extensions) === false) $errors[] = 'Вы можете загрузить файлы только с расширением: '.implode(', ', $extensions);
  if(isset($value['size']) && (integer) $value['size'] > (integer) $maxFileSize || $value['name'] == '') $errors[] = 'Размер файла не должен превышать '.round(((integer) $maxFileSize / 1000000), 3).'мб';

  if(count($errors) > 0){
      $validator->addError($key, implode('<br />', $errors));
      return false;
  }
}

return true;