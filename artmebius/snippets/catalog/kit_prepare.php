<?php
/*
  {'kit_prepare' | snippet : ['kit'=>$kit, 'color_kit'=>$color_kit, 'tkan_kit'=>$tkan_kit, 'show_ext'=>1]}
*/

if (!function_exists('dd')){
  function dd($var){
    print '{ignore}<pre>';
    print_r($var);
    print '</pre>{/ignore}';
  }
}

if (empty($kit)) return;

$pdo = $modx->getService('pdoTools');
$show_ext = $modx->getOption('show_ext', $scriptProperties, 0);

$cur_id = $modx->resource->id;
$cache_dir = 'kit';
$cache_options = array(xPDO::OPT_CACHE_KEY => $cache_dir, xPDO::OPT_CACHE_EXPIRES => 0);
$cache_path = MODX_CORE_PATH.'cache/resource/web/resources/'.$cur_id.'.cache.php';
$cache_check = file_exists($cache_path);
if (!$cache_check){

  $modx->cacheManager->delete($cur_id, $cache_options);
  $modx->cacheManager->delete($cur_id.'_kit_errors', $cache_options);

  $output = $output_torg = $kit_errors = '';
  $color_kit = trim($color_kit);
  $color = mb_strtolower($color_kit);
  $tkan_kit = trim($tkan_kit);
  $tkan = mb_strtolower($tkan_kit);
  $watermark = $modx->getOption('prds_preview_wm');
  $preview_params = '&w=380&h=240&zc=0&far=1';// 380*200
  // $preview_params_wm = (!empty($watermark)) ? $preview_params.$watermark : $preview_params;
  $preview_params_wm = $preview_params.$watermark;
  $thumb_params = '&w=190&h=140&zc=0&far=1';
  $arNames = $arNamesCount = $arIds = $arKit = $arProds = $arResult = $arCat = array();
  $strNames = '';

  $arKit = json_decode($kit, true);
  // dd($arKit);
  foreach ($arKit as $k => $prod) {
    $arNames[] = $prod['prod_name'];
  }
  $arNamesCount = array_count_values($arNames);
  // dd($arNames);
  // $strNames = '"'.implode('","', $arNames).'"';
  $strNames = "'".implode("','", $arNames)."'";
  // dd($strNames);

  $q = $modx->newQuery('modResource');
  $q->select(array('modResource.*'));
  $q->where(array(
    'pagetitle:IN'=>$arNames,
    'published'=>1,
    'deleted'=>0
  ));
  // $q->sortby('FIELD(pagetitle,'.$strNames.')');
  $q->sortby("FIELD(pagetitle,".$strNames.")");

  if(!$prods = $modx->getIterator('modResource', $q)){return;}

  // подготавливаем массив с товарами из комплекта
  foreach($prods as $prod){
    // dd($prod);
    $pid = $prod->get('id');
    $arProds[$pid]['id'] = $pid;
    $arProds[$pid]['title'] = $prod->get('pagetitle');
    $arProds[$pid]['image'] = $prod->getTVValue('image');
    $arProds[$pid]['price'] = $prod->getTVValue('price');
    $arProds[$pid]['old_price'] = $prod->getTVValue('old_price');
    $arProds[$pid]['label'] = $prod->getTVValue('label');
    $arProds[$pid]['ean'] = $prod->getTVValue('ean');
    $arProds[$pid]['tkan'] = $prod->getTVValue('tkan');
    $arProds[$pid]['torg'] = (!empty($prod->getTVValue('migx_torg'))) ? json_decode($prod->getTVValue('migx_torg'), true) : array();
    // $arProds[$pid]['ext'] = (!empty($arIdsExt[$pid])) ? $arIdsExt[$pid] : '';
    $arProds[$pid]['ext'] = $prod->get('parent');
    $arProds[$pid]['count'] = $arNamesCount[$prod->get('pagetitle')];
  }

  // dd($arProds);

  $tkan_enable = 0;
  if (!empty($tkan)) {
    $tkan_enable = 1; // включаем проверку на ткань
  }

  // собираем результат
  foreach ($arProds as $pid => $prod) {

    // проверяем ткань: если заполнена в комплекте и у товара
    $ar_tkan_prod = array();
    if ($tkan_enable) { // если проверка включена
      if (!empty($prod['tkan'])) { // и если ткань заполнена у товара
        $ar_tkan_prod = array_map('mb_strtolower',array_map('trim', explode(',', $prod['tkan'])));
        if (!in_array($tkan, $ar_tkan_prod)) {
          $kit_errors .= '<div><b style="color:red;">Ошибка!</b></div>';
          $kit_errors .= '<p>В товаре \' ' . $prod['title'] . ' \' нет ткани, которая указана в комплекте.</p>';
          continue;
        }
      } // товары без ткани допускаем //else continue;
    }

    $arResult[$pid]['id'] = $prod['id'];
    $arResult[$pid]['title'] = $prod['title'];
    $arResult[$pid]['url'] = $modx->makeUrl($prod['id'], '', '', 'full');
    $arResult[$pid]['preview'] = ($prod['image']) ? $modx->runSnippet('phpthumbon', array('input'=> $prod['image'], 'options'=>$preview_params_wm)) : $modx->runSnippet('phpthumbon', array('input'=> $prod['image'], 'options'=>$preview_params));
    $arResult[$pid]['count'] = $prod['count'];

    if (!empty($prod['torg'])) {
      foreach ($prod['torg'] as $k => $torg) {
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
            unset($arProds[$pid]['torg'][$k]);
            continue;
          }
          // исключаем ТП с пустыми значениями параметров
          if ($count_fields == 0) {
            unset($arProds[$pid]['torg'][$k]);
            continue;
          }
        } // если ТП без цвета
        else {
          // исключаем ТП с пустыми значениями параметров или если количество параметров больше одного
          if ($count_fields != 1) {
            unset($arProds[$pid]['torg'][$k]);
            continue;
          }
        }

        // общие поля
        $arResult[$pid]['torg'][$k]['have_field'] = $have_field;
        $arResult[$pid]['torg'][$k]['have_color'] = $have_color;
        $arResult[$pid]['torg'][$k]['prod_id'] = $pid;
        $arResult[$pid]['torg'][$k]['id'] = $pid.'_'.$k;
        $arResult[$pid]['torg'][$k]['price'] = $torg['price'];
        $arResult[$pid]['torg'][$k]['ean'] = $torg['ean'];
        $arResult[$pid]['torg'][$k]['thumb'] = $modx->runSnippet('phpthumbon', array('input'=>'/images/'.$torg['image'], 'options'=>$thumb_params));
        // если заполнена ткань в товаре и в комплекте
        $arResult[$pid]['torg'][$k]['have_tkan'] = (in_array($tkan, $ar_tkan_prod)) ? 1 : 0;
        // если заполнен параметр и это не цвет (второй параметр может быть цвет или отсутствует)
        if ($have_field) {
          $arResult[$pid]['torg'][$k]['field_alias'] = $modx->resource->cleanAlias($torg[$field_title_code]); // $field_title;
          $arResult[$pid]['torg'][$k]['field_title'] = $torg[$field_title_code]; // $field_title;
          $arResult[$pid]['torg'][$k]['field_title_code'] = $field_title_code;
          $arResult[$pid]['torg'][$k]['field_value'] = $torg[$field_value_code];
          $arResult[$pid]['torg'][$k]['field_value_code'] = $field_value_code;
        } elseif ($have_color) { // если заполнен только параметр цвет
          $arResult[$pid]['torg'][$k]['field_alias'] = 'color';//$modx->resource->cleanAlias($torg[$color_title_code]);
          $arResult[$pid]['torg'][$k]['field_title'] = $torg[$color_title_code];
          $arResult[$pid]['torg'][$k]['field_title_code'] = $color_title_code;
          $arResult[$pid]['torg'][$k]['field_value'] = $torg[$color_value_code];
          $arResult[$pid]['torg'][$k]['field_value_code'] = $color_value_code;
        }
      } // foreach ($prod['torg'] as $k => $torg)

      if (empty($arResult[$pid]['torg'])) {
        $kit_errors .= '<div><b style="color:red;">Ошибка!</b></div>';
        $kit_errors .= '<p>В товаре \' ' . $arResult[$pid]['title'] . ' \' нет подходящих торговых предложений.</p>';
        unset($arResult[$pid]);
      }

    } // if (!empty($prod['torg']))
    else {

      // заглушка для товара без ТП
      $arResult[$pid]['torg'][0]['have_field'] = 0;
      $arResult[$pid]['torg'][0]['have_color'] = 0;
      $arResult[$pid]['torg'][0]['prod_id'] = $pid;
      $arResult[$pid]['torg'][0]['id'] = $pid.'_0';
      $arResult[$pid]['torg'][0]['price'] = $prod['price'];
      $arResult[$pid]['torg'][0]['ean'] = $prod['ean'];
      $arResult[$pid]['torg'][0]['field_alias'] = 'tovar'; //$modx->resource->cleanAlias($arResult[$pid]['title']);
      $arResult[$pid]['torg'][0]['field_title'] = 'товар'; // $field_title;
      $arResult[$pid]['torg'][0]['field_title_code'] = 'pagetitle';
      $arResult[$pid]['torg'][0]['field_value'] = $prod['title'];//$arResult[$pid]['title'];
      $arResult[$pid]['torg'][0]['field_value_code'] = 'pagetitle';
      $arResult[$pid]['torg'][0]['thumb'] = $modx->runSnippet('phpthumbon', array('input'=>$prod['image'], 'options'=>$thumb_params));

    } // if (!empty($prod['torg']))

    // дополнительная ссылка
    if ($show_ext && !empty($prod['ext']) && !empty($arResult[$pid])) {
      $cat = $modx->getObject('modResource', $prod['ext']);
      $arResult[$pid]['ext']['id'] = $cat->get('id');
      $arResult[$pid]['ext']['title'] = ($cat->getTVValue('title_kit')) ? $cat->getTVValue('title_kit') : $cat->get('pagetitle'); // menutitle ?
      $catImage = ($cat->getTVValue('image_kit')) ? $cat->getTVValue('image_kit') : $cat->getTVValue('image');
      $arResult[$pid]['ext']['image'] = $catImage;
      $arResult[$pid]['ext']['thumb'] = $modx->runSnippet('phpthumbon', array('input'=>$catImage, 'options'=>$thumb_params));
      $arResult[$pid]['ext']['url'] = $modx->makeUrl($cat->get('id'), '', '', 'full');
    }
    // dd($arResult[$pid]);
  } // foreach ($arProds as $pid => $prod)

  // dd($arResult);

  if (empty($tpl)) {
    $tpl = '@INLINE <div class="kit_row shk-item">
                      <form action="{$_modx->makeUrl($_modx->resource.id)}">
                      <div class="kit_title">
                        {$title} {if ($count > 1)}(количество: {$count}){/if}
                      </div>
                      <div class="kit_torgs row">
                        <div class="kit_col col-xs-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
                          <div class="kit_preview">
                            <a href="{$url}"><img src="{$preview}" alt="{$title}"></a>
                          </div>
                          <div class="kit_more"><a href="{$url}" target="_blank">Подробнее о модуле</a></div>
                          <div class="kit_buy_wrap">
                            <button class="btn-buy" type="submit"><i class="icon-shopping-basket"></i><span class="orderSubmit">Купить отдельно</span></button>
                          </div>
                        </div>
                        {$torg_rows}
                      </div>
                      <input type="hidden" name="shk-id" value="{$id}">
                      <input type="hidden" name="shk-name" value="{$title}">
                      {if ($count > 1)}<input type="hidden" name="qty" value="{$count}">{/if}
                      </form>
                    </div>';
  }

  if (empty($tpl_torg)) {
    $tpl_torg = '@INLINE <div class="kit_col col-xs-12 col-sm-e-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="kit_torg">
                              {if $ean}<div class="kit_ean">Модуль: {$ean}</div>{/if}
                              {if ($field_title != "" && $field_title !="товар")}<div class="kit_value kit_{$field_alias}">{$field_title}: {$field_value}</div>{/if}
                              <div class="kit_thumb">
                                <img src="{$thumb}" alt="">
                              </div>
                              <label class="kit_price" for="{$id}">
                                <input type="radio" name="kit-option" id="{$id}" value="{$field_value}" data-title="{$field_title}" data-alias="{$field_alias}" data-price="{$price}" data-have-color="{$have_color}" data-have-field="{$have_field}" data-have-tkan="{$have_tkan}">
                                <span class="option-price">{$price | num_format} руб.</span>
                              </label>
                            </div>
                          </div>';
  }

  if (empty($tpl_ext)) {
    $tpl_ext = '@INLINE <div class="kit_col col-xs-12 col-sm-e-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="kit_ext">
                              <a class="kit_ext_link" href="{$url}" target="_blank">
                                <span class="kit_ext_thumb"><img src="{$thumb}" alt="{$title}"></span>
                                <span class="kit_ext_title btn-buy"><span class="fa fa-plus"></span> {$title}</span>
                              </a>
                            </div>
                          </div>';
  }

  foreach ($arResult as $pid => $prod) {
    $output_torg = '';
    foreach ($prod['torg'] as $k => $torg) {
      $output_torg .= $pdo->getChunk($tpl_torg, $torg);
    }
    if (is_array($prod['ext'])) {
      $output_torg .= $pdo->getChunk($tpl_ext, $prod['ext']);
    }
    $prod['torg_rows'] = $output_torg;
    $output .= $pdo->getChunk($tpl, $prod);
  }

  if (!empty($kit_errors)) {
    $modx->setPlaceholder('kit_errors', $kit_errors);
    $modx->cacheManager->set($cur_id.'_kit_errors', $kit_errors, 0, $cache_options);
  }
  $modx->cacheManager->set($cur_id, $output, 0, $cache_options);

}else{

  $kit_errors = $modx->cacheManager->get($cur_id.'_kit_errors', $cache_options);
  if (!empty($kit_errors)) {
    $modx->setPlaceholder('kit_errors', $kit_errors);
  }
  $output = $modx->cacheManager->get($cur_id, $cache_options);

}
return $output;