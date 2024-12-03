<?php
// OnSHKaddProduct

$tv = $modx->getObject('modTemplateVar',array('name'=>'migx_torg'));

$tp_prop_vybor = $conf_fields = $conf_fields_name = array();

$data = json_decode($tv->getValue($_POST['shk-id']));

foreach ($data as $tp) {
    $find_vybor = preg_grep("/vybor/", array_keys((array)$tp));
    if($find_vybor){
        $tp_prop_vybor = array_unique(array_merge($tp_prop_vybor , $find_vybor));
    }
    $find_value = preg_grep("/value/", array_keys((array)$tp));
    if($find_value){
        $conf_fields = array_unique(array_merge($conf_fields , $find_value));
    }
}
foreach ($data as $tp) {
    foreach ($tp_prop_vybor as $lbl) {
        if(!in_array($tp->$lbl,$conf_fields_name)){
            $conf_fields_name[] = $tp->$lbl;
        }
    }
}

if(!count($conf_fields)) return;

$data = json_decode($tv->getValue($_POST['shk-id']));

// значения полей атрибутов
$attrs = array();
foreach ($conf_fields as $f) {
    $attrs_tmp = explode('__', $_POST[$f]);
    $attrs[$attrs_tmp[0]] = $attrs_tmp[1];
}

$conf_opts_fields = array();
foreach ($data as $k=> $v) {

    foreach ($conf_fields as $key => $field) {
        if(!isset(${$field})) ${$field} = array();
        ${$field}[] = mb_strtolower(trim($v->$field));

        if(!in_array($field, $conf_opts_fields)){
            $conf_opts_fields[] = $field;
        }
    }
}

foreach ($conf_opts_fields as $key => $c_field) {
    ${$c_field} = array_keys(array_flip(${$c_field})); sort(${$c_field}, SORT_NATURAL); // Значения
}

$output_attr = array();
$count_conf = count($conf_fields);
foreach ($data as $kd => $data_val) {

    foreach ($conf_fields as $kf => $cfield) {
        ${$cfield.'_val'} = array_search(mb_strtolower(trim($data_val->$cfield)), ${$cfield});

        if(${$cfield.'_val'} == $attrs[$cfield]){
            $data_key[$cfield] = $kd;
        }
    }
    if($count_conf == count($data_key)) break;
}
// ключ связки атрибутов (строка в migx)
$data_line = max($data_key);

$options = array();
if($data_line!==false){

    foreach ($conf_fields as $key => $cfield) {
        if($data[$data_line]->$cfield){
            $output_attr[] = $conf_fields_name[$key].": ".mb_strtolower(trim($data[$data_line]->$cfield));
        }
    }
    $options[$tv->name] = array(
            implode(', ', $output_attr),
        );
    $product->content['options'] = array_merge($product->content['options'],$options);
    $product->content['price'] = $data[$data_line]->price;

}

$modx->event->output($product);