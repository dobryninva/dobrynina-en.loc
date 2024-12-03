<?php
if (!function_exists('dd')){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
  }
}


// $ids $color
$pdo = $modx->getService('pdoTools');
$arIds = $arCounts = $arFieldsValues = $arProds = $arResult = array();
$output = $output_torg = '';
$color = mb_strtolower($color);
$thumb_params = '&w=50&h=50&zc=0&far=1';

foreach ($ids as $id => $value) {
  $arValue = explode('__', $value);
  $arFieldsValues[$id] = $arValue[1];
  if (!empty($arValue[2])) $arCounts[$id] = $arValue[2];
  $arIds[] = $id;
}

if(!$prods = $modx->getIterator('modResource', array(
    'id:IN' => $arIds,
    'published' => 1,
    'deleted' => 0
))){return;}

foreach($prods as $prod){
  $pid = $prod->get('id');
  $arProds[$pid]['id'] = $pid;
  $arProds[$pid]['title'] = $prod->get('pagetitle');
  $arProds[$pid]['image'] = $prod->getTVValue('image');
  $arProds[$pid]['count'] = (isset($arCounts[$pid]) && !empty($arCounts[$pid])) ? $arCounts[$pid] : 1;
  $arProds[$pid]['price'] = $prod->getTVValue('price');
  // $arProds[$pid]['price'] = $prod->getTVValue('price') * $arProds[$pid]['count']; // nw d
  $arProds[$pid]['old_price'] = $prod->getTVValue('old_price');
  $arProds[$pid]['label'] = $prod->getTVValue('label');
  $arProds[$pid]['field_value'] = $arFieldsValues[$pid];
  $arProds[$pid]['torg'] = (!empty($prod->getTVValue('migx_torg'))) ? json_decode($prod->getTVValue('migx_torg'), true) : array();
}

foreach ($arProds as $p => $prod) {
  $arResult[$p]['id'] = $prod['id'];
  $arResult[$p]['title'] = $prod['title'];
  $arResult[$p]['url'] = $modx->makeUrl($prod['id'], '', '', 'full');
  $arResult[$p]['thumb'] = $modx->runSnippet('phpthumbon', array('input'=> $prod['image'], 'options'=>$preview_params));
  $arResult[$p]['count'] = $prod['count'];
  // $prod['field_value']

// $stroka .= print_r($prod['torg'], true) . "\n\n";
  if (!empty($prod['torg'])) {
    foreach ($prod['torg'] as $k => $torg) {
      if (mb_strtolower($torg['value1']) != mb_strtolower($prod['field_value']) && mb_strtolower($torg['value2']) != mb_strtolower($prod['field_value'])) {
        unset($arProds[$p]['torg'][$k]);
        continue;
      }

      $have_color = 0;
      $have_field = 0;
      $count_fields = 0;

      if (!empty($torg['value1'])){
        // ищем цвет в 1-м параметре
        if (mb_strtolower($torg['vybor1']) == 'цвет') {
          $color_title_code = 'vybor1';
          $color_value_code = 'value1';
          $have_color = 1;
        } else {
          $field_title_code = 'vybor1';
          $field_value_code = 'value1';
          $have_field = 1;
        }
        ++$count_fields;
      }

      if (!empty($torg['value2'])){
        // ищем цвет во 2-м параметре
        if (!$have_color && mb_strtolower($torg['vybor2']) == 'цвет') {
          $color_title_code = 'vybor2';
          $color_value_code = 'value2';
          $have_color = 1;
        } elseif (!$have_field) {
          $field_title_code = 'vybor2';
          $field_value_code = 'value2';
          $have_field = 1;
        }
        ++$count_fields;
      }

      // если цвет найден
      if ($have_color) {
        // исключаем ТП без нужного цвета
        if (mb_strtolower($torg[$color_value_code]) != $color) {
          unset($arProds[$p]['torg'][$k]);
          continue;
        }
        // исключаем ТП с пустыми значениями параметров
        if ($count_fields == 0) {
          unset($arProds[$p]['torg'][$k]);
          continue;
        }
      } // если ТП без цвета
      else {
        // исключаем ТП с пустыми значениями параметров или если количество параметров больше одного
        if ($count_fields != 1) {
          unset($arProds[$p]['torg'][$k]);
          continue;
        }
      }

      // if (!empty($torg['image'])) {
      //   $arResult[$p]['thumb'] = $modx->runSnippet('phpthumbon', array('input'=>'/images/'.$torg['image'], 'options'=>$thumb_params));
      // } else {
      //   $arResult[$p]['thumb'] = $modx->runSnippet('phpthumbon', array('input'=> $prod['image'], 'options'=>$preview_params));
      // }
      $arResult[$p]['field_value'] = $prod['field_value'];
      $arResult[$p]['price'] = (!empty($torg['price'])) ? $torg['price'] : $prod['price'];
      if ($have_field) {
        $arResult[$p]['field_title'] = mb_strtolower($torg[$field_title_code]);
      } elseif ($have_color) { // если заполнен только параметр цвет
        $arResult[$p]['field_title'] = mb_strtolower($torg[$color_title_code]);
      }
    }
  } else {
    $arResult[$p]['price'] = $prod['price'];
    // $arResult[$p]['thumb'] = $modx->runSnippet('phpthumbon', array('input'=> $prod['image'], 'options'=>$preview_params));
  }

  $arResult[$p]['price'] = $arResult[$p]['price'] * $arResult[$p]['count'];
}

// dd($arResult);

if (empty($tpl)) {
  $tpl = '@INLINE <div class="kit_row">
                    <div class="kit_preview"><a href="{$url}" title="{$title}"><img src="{$thumb}" alt="{$title}"></a></div>
                    <div class="kit_info">
                      <div class="kit_title"><a href="{$url}" title="{$title}">{$title}</a></div>
                      {if $field_value}<div class="kit_size">{$field_title}: {$field_value}</div>{/if}
                    </div>
                    {if ($count > 1)}<div class="kit_count">{$count} шт.</div>{/if}
                    <div class="kit_price">{$price | num_format} руб.</div>
                  </div>';
}

foreach ($arResult as $rid => $prod) {
  $output .= $pdo->getChunk($tpl, $prod);
}

// $artm_log = MODX_BASE_PATH . 'assets/temp.log';
// file_put_contents($artm_log, $stroka, FILE_APPEND | LOCK_EX);

return $output;