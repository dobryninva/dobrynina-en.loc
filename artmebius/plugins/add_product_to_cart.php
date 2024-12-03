<?php
if (!function_exists('dd')){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
  }
}
$stroka = '';

switch ($modx->event->name) {

    case 'OnSHKaddProduct':
      $options = array();
// $stroka .= print_r($product->content, true) . "\n\n";
      // $option = array('title_tv + value', +price, price, 'title_tv');
      // $test_1 = array('цвет синий', 0, 1000, 'цвет');
      // $test_2 = array('размер 100*50*90', 0, 5000, 'размер');
      // $options = array($test_1, $test_2);

      if (!empty($_POST['torg-id']) && !empty($_POST['shk-id'])) {
        $torg_tv = $modx->getObject('modTemplateVar',array('name'=>'migx_torg'));
        $torg_arr = json_decode($torg_tv->getValue($_POST['shk-id']), true);
        foreach ($torg_arr as $k => $tp) {
          if ($tp['MIGX_id'] == $_POST['torg-id']) {
            if (!empty($tp['value1'])) {
              $options['value1'] = array($tp['vybor1'].': '.$tp['value1'], 0, 0, $tp['vybor1']);
            }
            if (!empty($tp['value2'])) {
              $options['value2'] = array($tp['vybor2'].': '.$tp['value2'], 0, 0, $tp['vybor2']);
            }
            $product->content['price'] = $tp['price'];
            break;
          }
        }
      }

      // old
      // if (!empty($_POST['torg-price'])) {
      //   $product->content['price'] = $_POST['torg-price'];
      // }
      // if (!empty($_POST['torg-option']) && count($_POST['torg-option']) > 0) {
      //   // $product->content['options'] = $_POST['torg-option'];
      //   foreach ($_POST['torg-option'] as $k => $option_val) {
      //     $option = explode('__', $option_val);
      //     $options['torg-option-'.$k] = array($option[0].': '.$option[1], 0,0, $option[0]);
      //   }
      // }


      // kit old
      // if (!empty($_POST['kit-price'])) {
      //   $product->content['price'] = $_POST['kit-price'];
      // }
      // if (!empty($_POST['kit-option']) && count($_POST['kit-option']) > 0) {
      //   // $product->content['options'] = $_POST['kit-option'];
      //   foreach ($_POST['kit-option'] as $k => $option_val) {
      //     $option = explode('__', $option_val);
      //     $qty = ($option[3] > 0) ? $option[3] : 0;
      //     // $options['kit-option-'.$k] = array($option[0].'__'.$option[1].'__'.$option[2], 0,0, $option[0]);
      //     $options['kit-option-'.$k] = array($option_val, 0, $qty, $option[0]);
      //   }
      // }

$stroka .= "options: \n";
$stroka .= print_r($options, true) . "\n\n";
      if (count($options) > 0) {
        $product->content['options'] = array_merge($product->content['options'],$options);
      }
$stroka .= "product->content['options']: \n";
$stroka .= print_r($product->content['options'], true) . "\n\n";
// $stroka .= print_r($product->content, true) . "\n\n";

      // if (!empty($_POST['torg-option-0'])){
      //   $option = explode('__', $_POST['torg-option-0']);
      //   $options['torg-option-0'] = array($option[0].' '.$option[1], 0,0, $option[0]);
      // }
      // if (!empty($_POST['torg-option-1'])){
      //   $option = explode('__', $_POST['torg-option-1']);
      //   $options['torg-option-1'] = array($option[0].' '.$option[1], 0,0, $option[0]);
      // }
      // $output = $product;
      // $stroka .= "product:\n\n";
      // $stroka .= print_r($output, true) . "\n\n";
      $modx->event->output($product);
      break;

  case 'OnSHKgetProductPrice':
    // $stroka .= print_r($_POST, true) . "\n\n";
    // $stroka .= print_r($id, true) . "\n\n";
    // $stroka .= print_r($price, true) . "\n\n";
    // $stroka .= print_r($purchaseArray, true) . "\n\n";

    // $output = (!empty($_POST['price-kit'])) ? $_POST['price-kit'] : $price;
    $output = $price;
    $modx->event->output($output);
    break;

    case 'OnSHKcalcTotalPrice':
      // price_total
      // delvery_price
      $output = $price_total;
      $modx->event->output($output);
      break;

    case 'OnSHKgetProductAdditParamPrice':
      // price
      // id
      // purchaseArray
      $output = $price;
      $modx->event->output($output);
      break;
}

$artm_log = MODX_BASE_PATH . 'assets/temp.log';
// file_put_contents($artm_log, $stroka, FILE_APPEND | LOCK_EX);

return;