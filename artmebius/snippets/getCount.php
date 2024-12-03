<?php
// getCount

/**
* v.1.1
*
* fenom:
* {'getCount' | snippet : ['parent:IN'=>[1,2,3], 'template'=>10]}
*
* &scriptProperties - параметры сниппета = параметры подбора, обязательное
* &className - класс объекта, не обязательное
*
* возвращает количество ресурсов по параметрам подбора
*/

$className = 'modResource';
$params_default = [
  'published' => 1,
  'deleted'   => 0
];
$params = [];

if (is_array($scriptProperties) && !empty($scriptProperties)) {

  // задаём новый className
  if (isset($scriptProperties['className']) && !empty($scriptProperties['className'])) {
    $className = $scriptProperties['className'];
    unset($scriptProperties['className']);
  }

  // преобразуем строковое значения в массив для параметров с :IN
  foreach ($scriptProperties as $key => $value) {
    if (strpos($key, ':IN') !== false) {
      if (!is_array($value)) {
        $scriptProperties[$key] = explode(',', $value);
      }
    }
  }

  $params = array_merge($params_default, $scriptProperties);
}

return $modx->getCount($className, $params);