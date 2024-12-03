<?php
switch ($modx->event->name) {
  case 'OnDocFormSave':
    /*
      Обновляет\добавляет значения tv-свойств pp_* в таблицу pp_products_properties
    */

    $pp_ext_arr = array();
    $ext_properties = $modx->getOption('ext_properties');
    if ($ext_properties) {
      $pp_ext_arr = array_map('trim', explode(',', $ext_properties));
    }

    $where_arr = array('tv.name:LIKE' =>'pp_%');
    if (!empty($pp_ext_arr)) $where_arr['OR:tv.name:IN'] = $pp_ext_arr;

    $query = $modx->newQuery('modTemplateVarResource', array('contentid'=>$id));
    $query->select('modTemplateVarResource.value, `tv`.`name` as code, `tv`.`caption` as name');
    $query->leftJoin('modTemplateVar', 'tv', "tv.id=modTemplateVarResource.tmplvarid");
    $query->where($where_arr);

    if ($query->prepare() && $query->stmt->execute()) {
      $result = $query->stmt->fetchAll(PDO::FETCH_ASSOC);

      $output = $pp_table_tv = $properties = $pps = array();

      foreach ($result as $key => $tv) {
        if($tv['code']=='pp_products_properties'){
          $pp_table_tv = $tv;
          continue;
        }
        if($tv['value']){
          $pps[$tv['code']] = $tv;
        }
      }

      if(count($pp_table_tv)){
        $properties = json_decode($pp_table_tv['value'],true);
        if(count($properties)){
          foreach ($properties as $key => $prop) {

            if(array_key_exists($prop['code'], $pps)){

              if ($pps[$prop['code']]['value']){
                $properties[$key]['title'] = $pps[$prop['code']]['title'];
                $properties[$key]['value'] = $pps[$prop['code']]['value'];
                $properties[$key]['code'] = $pps[$prop['code']]['code'];
                unset($pps[$prop['code']]);
              } else {
                unset($properties[$key]);
                unset($pps[$prop['code']]);
              }

            }else {
              unset($properties[$key]);
            }

          }
        }
      }

      $output = array_values(array_merge($properties,$pps));

      $resource->setTVValue('pp_products_properties',json_encode($output,JSON_UNESCAPED_UNICODE));
    }
    break;
}