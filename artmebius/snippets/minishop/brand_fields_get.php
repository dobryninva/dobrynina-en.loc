<?php
/**
* v.1.2
*
* [[brand_fields_get? &prefix=`brand`]]
* fenom:
* {'brand_fields_get' | snippet : ['prefix'=>'brand']}
*
* &prefix - обязательное, по-умолчанию - brand
* &brand_id -  необязательное, id бренда минишопа
* &brand_name -  необязательное, название (имя) бренда минишопа
*
* устанавливает плейсхолдеры полей выбранного бренда ({'brand.name' | placeholder})
* если не заданы brand_id или brand_name получает поля бренда связанным с текущим ресурсом (в котором вызывается сниппет)
*/

$resource_id = $modx->resource->id;
$prefix = $modx->getOption('prefix', $scriptProperties, 'brand');
$brand_id = $modx->getOption('brand_id', $scriptProperties, '');
$brand_name = $modx->getOption('brand_name', $scriptProperties, '');
$where_arr = array();

$q = $modx->newQuery('msVendor');
$q->select('id,name,resource,country,logo,address,phone,fax,email,description,properties');
if (!empty($brand_id)) {
  $where_arr['id'] = $brand_id;
} elseif (!empty($brand_name)) {
  $where_arr['name'] = trim($brand_name);
} else {
  $where_arr['resource'] = $resource_id;
}
$q->where($where_arr);
$q->prepare();
if($q->stmt && $q->stmt->execute()){
  $brand_arr = $q->stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$brand_arr) return;
$modx->toPlaceholders($brand_arr, $prefix);
return;