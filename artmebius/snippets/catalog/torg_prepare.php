<?php
if (!function_exists('dd')){
  function dd($var){
    print '{ignore}<pre>';
    print_r($var);
    print '</pre>{/ignore}';
  }
}
if (empty($torg)) return;

$pdoTools = $modx->getService('pdoTools');

$show_size_table = $modx->getOption('show_size_table', $scriptProperties, 0);
$show_label = $modx->getOption('show_label', $scriptProperties, 0);
$cur_id = $modx->getOption('id', $scriptProperties, '');
// $cur_id = $modx->resource->id;

// кэширование временно отключено, нужно дальнейшее тестирование
// $cache_dir = 'torg';
// $cache_options = array(xPDO::OPT_CACHE_KEY => $cache_dir, xPDO::OPT_CACHE_EXPIRES => 0);
// $cache_path = MODX_CORE_PATH.'cache/resource/web/resources/'.$cur_id.'.cache.php';
// $cache_check = file_exists($cache_path);
// if (!$cache_check){

//   $modx->cacheManager->delete($cur_id, $cache_options);

  $arTorg = (!is_array($torg)) ? json_decode($torg, true) : $torg;
// dd($arTorg);
  $props_with_image = $modx->getOption('props_with_image');
  $ar_props_with_image = array();
  if (!empty($props_with_image)) {
    $ar_props_with_image = explode(',', $props_with_image);
  }

  $watermark = $modx->getOption('prdt_image_wm');
  // $full_options = (!empty($watermark)) ? '&w=640&h=480&zc=0&far=1'.$watermark : '&w=640&h=480&zc=0&far=1'; // картинка ТП
  $full_options = '&w=640&h=480&zc=0&far=1'; // картинка ТП (для заглушки)
  $full_options_wm = $full_options.$watermark; // картинка ТП с водяным знаком
  // $modx->getOption('prds_preview_width') $modx->getOption('prds_preview_height') $modx->getOption('prds_preview_zc')
  $preview_options = '&w='.$modx->getOption('prds_preview_width').'&h='.$modx->getOption('prds_preview_height').'&zc='.$modx->getOption('prds_preview_zc').'&far=1'; // картинка ТП (для списка товаров)
  $preview_options_wm = $preview_options.$watermark;
  $thumb_options = '&w=140&h=105&zc=0&far=1'; // доп. картинки ТП // 140/105  4/3
  $params_watermark = '&fltr[]=wmi|/images/logo-200-o-50.png|BR|100|10|10|0'; // logo-50-o-50.png
  $thumb_params_options = '&w=75&h=75&zc=1&far=1'; // картинка параметров
  $thumb_params_options_wm = $thumb_params_options.$params_watermark;

  $main_properties = $modx->getOption('main_properties');
  $ext_properties = $modx->getOption('ext_properties');
  $sort_properties = $modx->getOption('sort_properties');
  if (!empty($sort_properties)) {
    $ar_sort_properties = array_map('trim', explode(',', $sort_properties));
  }

  $arResult = $ar_vybor_codes = $ar_vybor_titles = $ar_value_codes = $ar_value_titles = $ar_image_codes = $ar_image_titles = array();

  // анализируем и разбираем ТП
  foreach ($arTorg as $tp) {

    $find_vybor = preg_grep("/vybor/", array_keys($tp));
    if ($find_vybor) {
      foreach ($find_vybor as $vyborN) {
        $N = substr($vyborN, -1);
        if (!empty($tp[$vyborN]) && !in_array($vyborN, $ar_vybor_codes)) {
          $ar_vybor_codes[$N] = $vyborN;
        }

        if (!empty($tp[$vyborN]) && !in_array(mb_strtolower(trim($tp[$vyborN])),$ar_vybor_titles)) {
          $ar_vybor_titles[$N] = mb_strtolower(trim($tp[$vyborN]));
        }

      }
    }

    $find_value = preg_grep("/value/", array_keys($tp));
    if ($find_value) {
      foreach ($find_value as $valueN) {
        $N = substr($valueN, -1);
        if (!empty($tp[$valueN]) && !in_array($valueN, $ar_value_codes)) {
          $ar_value_codes[$N] = $valueN;
        }

        // if (!empty($tp[$valueN]) && !in_array(mb_strtolower(trim($tp[$valueN])), $ar_value_titles[$valueN])) { // re
        //   $ar_value_titles[$valueN][] = mb_strtolower(trim($tp[$valueN]));
        // }

        if (!empty($tp[$valueN])){
          if (!isset($ar_value_titles[$valueN])) {
            $ar_value_titles[$valueN][] = mb_strtolower(trim($tp[$valueN]));
          } elseif (!in_array(mb_strtolower(trim($tp[$valueN])), $ar_value_titles[$valueN])) {
            $ar_value_titles[$valueN][] = mb_strtolower(trim($tp[$valueN]));
          }
        }
      }
    }

    $find_image = preg_grep("/image(\d)/", array_keys($tp));
    if ($find_image) {
      foreach ($find_image as $imageN) {
        $N = substr($imageN, -1);
        if (!empty($tp[$imageN]) && !in_array($imageN, $ar_image_codes)) {
          $ar_image_codes[$N] = $imageN;
        }
      }
    }

  }
// dd($ar_vybor_codes);
// dd($ar_vybor_titles);
// dd($ar_value_codes);
// dd($ar_value_titles);
// dd($ar_image_codes);

  // сортировка значений
  foreach ($ar_value_codes as $k_vc => $value_code) {
    sort($ar_value_titles[$value_code], SORT_NATURAL); // Значения

    // костыль для размеров
    // if(substr_count(mb_strtolower($arr_vybor_titles[$k_vc]), "размер")){
    //   $sortSizes = array('xs','s','m','l','xl','2xl','xxl','3xl','xxxl','4xl','5xl','6xl');
    //   if(count(array_intersect($ar_value_titles[$value_code], $sortSizes))){
    //     $ar_value_titles[$value_code] = array_keys(array_intersect_key(array_flip($sortSizes),array_flip($ar_value_titles[$value_code])));
    //   } else {
    //     $ar_value_titles[$value_code] = array_keys(array_flip($ar_value_titles[$value_code]));
    //     sort($ar_value_titles[$value_code], SORT_NATURAL); // Значения
    //   }
    // }
    // else {
    //   $ar_value_titles[$value_code] = array_keys(array_flip($ar_value_titles[$value_code]));
    //   sort($ar_value_titles[$value_code], SORT_NATURAL); // Значения
    // }
  }

  // создаём основу под результат
  $ar_value_titles_ext = array();
  foreach ($ar_value_titles as $value_code => $option) {
    foreach ($option as $k => $title) {
      $ar_value_titles_ext[$value_code][$k]['title'] = $title;
    }
  }
// dd($ar_value_titles_ext);

  // доп. массивы со связями колонок ТП
  $ar_value_codes__vibor_titles = $ar_value_codes__image_codes = array();
  foreach ($ar_vybor_titles as $k => $title) {
    $ar_value_codes__vibor_titles[$ar_value_codes[$k]] = $title;
  }
  foreach ($ar_image_codes as $k => $code) {
    $ar_value_codes__image_codes[$ar_value_codes[$k]] = $code;
  }
// dd($ar_value_codes__vibor_titles);
// dd($ar_value_codes__image_codes);

  if (!function_exists('get_props_table')) {
    function get_props_table($props, $pdoTools, $main_properties = '', $ext_properties = ''){
      if (empty($props)) return;
      $output_props = '';
      if (!is_array($props)) {
        $arProps = json_decode($props, true);
      } else {
        $arProps = $props;
      }
      if ($main_properties) {
        $ar_main_properties = array_map('trim', explode(',', $main_properties));
      }
      if ($ext_properties) {
        $ar_ext_properties = array_map('trim', explode(',', $ext_properties));
      }
      if (count($arProps) > 0) {
        $arPropsResult = array();
        foreach ($arProps as $r => $row) {
          if (count($ar_main_properties) > 0 && !in_array($row['code'], $ar_main_properties)) continue;
          $arPropsResult[$r]['title'] = $row['title'];
          $arPropsResult[$r]['value'] = $row['value'];
          $arPropsResult[$r]['code'] = $row['code'];
        }
        if (empty($tpl_props)) {
           // $tpl_props = '@INLINE <div class="props_row"><div class="props_title">{$title}:</div> <div class="props_value">{$value}</div></div>';
           $tpl_props = '@INLINE <tr class="props_row"><td class="props_title">{$title}</td><td class="props_value">{$value}</td></tr>';
        }
        foreach ($arPropsResult as $p => $prop) {
          $output_props .= $pdoTools->getChunk($tpl_props, $prop);
        }
        return $output_props;
      }
      return;
    }
  }

  if (!function_exists('upd_props_table')) {
    function upd_props_table($tp_pp, $pp, $pdoTools, $sort_properties = '', $main_properties = ''){
      if (empty($tp_pp)) return;
      if (!is_array($tp_pp)) {
        $tp_pp = json_decode($tp_pp, true);
      }
      if (!empty($main_properties)) {
        $ar_main_properties = array_map('trim', explode(',', $main_properties));
      }
      $propsResult = $tp_pp_ext = $tp_pp_codes = $upd_pp_codes = $diff_codes = array();
      foreach ($tp_pp as $p => $prop) {
        $tp_pp_ext[$prop['code']] = array('title'=>$prop['title'], 'value'=>$prop['value']);
        $tp_pp_codes[] = $prop['code'];
      }

      // если таблица pp_products_properties заполнена, сначала обновляем в ней значения
      if (is_array($pp) && count($pp) > 0) {
        foreach ($pp as $p => $prop) {
          if (in_array($prop['code'], $tp_pp_codes)) {
            $pp[$p]['value'] = $tp_pp_ext[$prop['code']]['value'];
            $upd_pp_codes[] = $prop['code'];
          }
        }
        // проверяем есть ли новые строки
        $diff_codes = array_diff($tp_pp_codes, $upd_pp_codes);
        // если есть новые строки
        if (count($diff_codes) > 0) {
          // добавляем в pp_products_properties новые строки из таблицы свойств ТП
          foreach ($diff_codes as $code) {
            $pp[] = array('title'=>$tp_pp_ext[$code]['title'], 'value'=>$tp_pp_ext[$code]['value'], 'code'=>$code);
          }
        }
      } else {
        // иначе таблица pp_products_properties = $tp_pp
        $pp = $tp_pp;
      }

      $pp_ext = array();
      foreach ($pp as $r => $row) {
        $pp_ext[$row['code']] = $row;
      }

      // сортировка
      if (is_array($sort_properties)) {
        $pp_ext = array_replace(array_intersect_key(array_flip($sort_properties),$pp_ext), $pp_ext);
      }

      foreach ($pp_ext as $p => $prop) {
        if (count($ar_main_properties) > 0 && !in_array($prop['code'], $ar_main_properties)) continue;
        $arPropsResult[$p]['title'] = $prop['title'];
        $arPropsResult[$p]['value'] = $prop['value'];
        $arPropsResult[$p]['alias'] = $prop['code'];
      }

      $output_props = '';
      if (empty($tpl_props)) {
         // $tpl_props = '@INLINE <div class="props_row"><div class="props_title">{$title}:</div> <div class="props_value">{$value}</div></div>';
         $tpl_props = '@INLINE <tr class="props_row"><td class="props_title">{$title}</td><td class="props_value">{$value}</td></tr>';
      }
      foreach ($arPropsResult as $p => $prop) {
        $output_props .= $pdoTools->getChunk($tpl_props, $prop);
      }
      return $output_props;
    }
  }
// dd($arTorg);
  // готовим ТП
  $arTorgCrossValues = array(); // $crossOptionMap
  foreach ($arTorg as $tp) {

    $ar_cross_values = $tp_ext = array();

    $tp_ext['torg_id'] = $tp['MIGX_id'];
    // $tp_ext['vybor1'] = $tp['vybor1'];
    // $tp_ext['value1'] = $tp['value1'];
    // $tp_ext['vybor2'] = $tp['vybor2'];
    // $tp_ext['value2'] = $tp['value2'];

    $tp_ext['price'] = $tp['price'];
    $tp_ext['old_price'] = $tp['old_price'];
    // $tp_ext['ean'] = $tp['ean'];
    $tp_ext['label'] = $tp['label'];
    $tp_ext['discount'] = $tp['discount'];
    // $tp_ext['images'] = $tp['images'];

    // if ($tp['kits_with_discount']) {
    //   $ar_kits_with_discount = array_map('trim', explode(',', $tp['kits_with_discount']));
    //   $html_kits_with_discount = '';
    //   foreach ($ar_kits_with_discount as $kit_id) {
    //     $kit_res = $modx->getObject('modResource',$kit_id);
    //     $html_kits_with_discount .= '<div class="mdl-header">Купить со скидкой:</div>';
    //     $html_kits_with_discount .= '<div><a href="' . $modx->makeUrl($kit_id,'','','full') . '" title="' . $kit_res->get('pagetitle') . '">' . $kit_res->get('pagetitle') . '</a></div>';
    //   }
    //   $tp_ext['kits_with_discount'] = $html_kits_with_discount;
    // }

    // свойства торговых предложений
    // v1. простая замена табличек свойств
    // $tp_ext['props'] = get_props_table($tp['torg_table'], $pdoTools);
    // $tp_ext['props_main'] = get_props_table($tp['torg_table'], $pdoTools, $main_properties);
    // v2. анализ свойств в таблицах свойств
    $tp_ext['props'] = upd_props_table($tp['torg_table'], $pp, $pdoTools, $ar_sort_properties);
    $tp_ext['props_main'] = upd_props_table($tp['torg_table'], $pp, $pdoTools, $ar_sort_properties, $main_properties);

    // остаток на складе
    if ($tp['torg_stores']) {
      $tp_ext['stores'] = '';
      $stores_arr = json_decode($tp['torg_stores'], true);
      foreach ($stores_arr as $s => $store) {
        $tp_ext['stores'] .= '<div class="prdt_store"><span class="prdt_store_title">'.$store['name'].':</span><span class="prdt_store_value">'.$store['count'].' шт.</span></div>';
      }
    }

    // основная картинка ТП
    $image = $image_src = $image_full = $image_thumb = '';
    // нужно определиться, картинка ТП обязательное поле или нет
    if ($tp['image']) {
      $image_src = 'images/'.$tp['image'];
      $image = (!empty($watermark)) ? $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $watermark)) : $image_src;
      $image_full = $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $full_options_wm));
      $image_preview = $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $preview_options_wm));
      $image_thumb = $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $thumb_options));
    } else { // заглушка noimage если обязательное поле
      //$image_src = $tp['image'];
      //$image = $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $full_options));
      //$image_full = $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $full_options));
      //$image_preview = $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $preview_options));
      //$image_thumb = $modx->runSnippet('phpthumbon',array('input' => $image_src, 'options' => $thumb_options));
    }
    $tp_ext['image'] = $image; // $tp['image'];
    $tp_ext['image_full'] = $image_full; // !empty($image_full) ? $image_full : '';
    $tp_ext['image_preview'] = $image_preview; // !empty($image_full) ? $image_full : '';
    $tp_ext['image_thumb'] = $image_thumb; // !empty($image_thumb) ? $image_thumb : '';

    // доп. картинки ТП
    $images = $images_src = $images_full = $images_thumb = array();
    if ($tp['images']) {
      $images = json_decode($tp['images'], true);

      // Добавление основного превью ТП // в последних версиях не тестил
      // if ($tp['image']) {
      //   $images[] = $tp_ext['image'];
      //   $images_full[] = $tp_ext['image_full'];
      //   $images_thumb[] = $tp_ext['image_thumb'];
      // }

      foreach ($images as $img) {
        $imgs_src = 'images/'.$img['src'];
        $images_src[] = (!empty($watermark)) ? $modx->runSnippet('phpthumbon',array('input' => $imgs_src, 'options' => $watermark)) : $imgs_src;
        $images_full[] = $modx->runSnippet('phpthumbon',array('input' => $imgs_src, 'options' => $full_options_wm));
        $images_thumb[] = $modx->runSnippet('phpthumbon',array('input' => $imgs_src, 'options' => $thumb_options));
      }

      // $tp_ext['images'] = array_reverse($images_src);
      // $tp_ext['images_full'] = array_reverse($images_full);
      // $tp_ext['images_thumb'] = array_reverse($images_thumb);
      $tp_ext['images'] = $images_src;
      $tp_ext['images_full'] = $images_full;
      $tp_ext['images_thumb'] = $images_thumb;
    }

    // картинки параметров
    // $tp_ext['image1'] = $tp['image1'];
    // $tp_ext['image2'] = $tp['image2'];
    foreach ($ar_image_codes as $image_code) {
      $image_params = $image_params_src = $image_params_thumb = '';
      // $image_params_src = ($tp[$image_code]) ? 'images/'.$tp[$image_code] : ''; // prev
      $image_params_src = 'images/'.$tp[$image_code];
      $image_params = (!empty($params_watermark)) ? $modx->runSnippet('phpthumbon',array('input' => $image_params_src, 'options' => $params_watermark)) : $image_params_src;
      $image_params_thumb = $modx->runSnippet('phpthumbon',array('input' => $image_params_src, 'options' => $thumb_params_options));
      $tp_ext[$image_code] = ($tp[$image_code]) ? $image_params : $image_params_thumb;
      $tp_ext[$image_code.'_thumb'] = !empty($image_params_thumb) ? $image_params_thumb : '';
      // $tp_ext[$image_code] = !empty($image_params_src) ? $image_params_src : '';
      // $tp_ext[$image_code.'_thumb'] = !empty($image_params_thumb) ? $image_params_thumb : '';
    }

    foreach ($ar_value_codes as $value_code) {
      $value_key = array_search(mb_strtolower(trim($tp[$value_code])), $ar_value_titles[$value_code]);
      if ($value_key !== false) {
        $ar_cross_values[] = $value_code.'_'.$value_key;

        if (empty($ar_value_titles_ext[$value_code][$value_key]['image'])) {
          $ar_value_titles_ext[$value_code][$value_key]['image'] = $tp_ext[$ar_value_codes__image_codes[$value_code]];
        }
        if (empty($ar_value_titles_ext[$value_code][$value_key]['image_thumb'])) {
          $ar_value_titles_ext[$value_code][$value_key]['image_thumb'] = $tp_ext[$ar_value_codes__image_codes[$value_code].'_thumb'];
        }
      }

    }

    $arTorgCrossValues[implode('__',$ar_cross_values)] = $tp_ext;

  } // foreach ($arTorg as $tp)


  ksort($arTorgCrossValues);
// dd($arTorgCrossValues);

  // подготавливаем данные для чанков (собираем $arResult)
  foreach ($ar_value_titles_ext as $value_code => $options) {
    $type = in_array($ar_value_codes__vibor_titles[$value_code], $ar_props_with_image) ? 'label_with_image' : 'label';
    $arResult[$value_code]['show_size_table'] = $show_size_table;
    $arResult[$value_code]['show_label'] = $show_label;
    $arResult[$value_code]['origin'] = 'tp';
    $arResult[$value_code]['type'] = $type;
    $arResult[$value_code]['code'] = $value_code;
    $arResult[$value_code]['title'] = $ar_value_codes__vibor_titles[$value_code];
    $arResult[$value_code]['alias'] = $modx->filterPathSegment($ar_value_codes__vibor_titles[$value_code]);
    foreach ($options as $o => $option) {
      $arResult[$value_code]['options'][$o]['type'] = $type;
      $arResult[$value_code]['options'][$o]['title'] = $option['title'];
      $arResult[$value_code]['options'][$o]['name'] = $value_code;
      $arResult[$value_code]['options'][$o]['value'] = $value_code.'_'.$o;
      $arResult[$value_code]['options'][$o]['image'] = $option['image'];
      $arResult[$value_code]['options'][$o]['image_thumb'] = $option['image_thumb'];
    }
  }

  // сортируем аттрибуты так, чтобы с картинками всегда шли первыми
  if (!function_exists(cmp)) {
    function cmp($a, $b){
      // label_with_image label
      if ($a['type'] == $b['type']) return 1;
      if ($a['type'] == 'label' && $b['type'] == 'label_with_image') return 1;
      if ($a['type'] == 'label_with_image' && $b['type'] == 'label') return -1;
      return 0;
    }
  }
  // usort($arResult, 'cmp'); // необязательно

  // обрабатываем модификаторы (множители ТП)
  if (!empty($mods)) {
    $arModsResult = $ar_cur_list_ext = array();
    $catalog = $modx->getObject('modResource',7);
    foreach ($mods as $mod => $arMod) {
      $mod_list = $mod.'_list';
      $$mod_list = $catalog->getTVValue($mod_list);
      $ar_full_list = json_decode($$mod_list, true);
      $ar_cur_list = explode(',', trim($arMod['value']));
      foreach ($ar_cur_list as $k => $title) {
        $ar_cur_list_ext[$k]['title'] = trim($title); //[$mod]
        foreach ($ar_full_list as $i => $arRow) {
          if (mb_strtolower(trim($arRow['title'])) == mb_strtolower(trim($title))) {
            $image_params = $image_params_src = $image_params_thumb = '';
            // $image_params_src = !empty($arRow['img']) ? 'images/'.$arRow['img'] : '';
            $image_params_src = 'images/'.$arRow['img'];
            $image_params = (!empty($params_watermark)) ? $modx->runSnippet('phpthumbon',array('input' => $image_params_src, 'options' => $params_watermark)) : $image_params_src;
            $image_params_thumb = $modx->runSnippet('phpthumbon',array('input' => $image_params_src, 'options' => $thumb_params_options));
            $ar_cur_list_ext[$k]['image'] = !empty($arRow['img']) ? $image_params : $image_params_thumb;
            $ar_cur_list_ext[$k]['image_thumb'] = !empty($image_params_thumb) ? $image_params_thumb : '';
            // $ar_cur_list_ext[$k]['image'] = 'images/'.$arRow['img'];
            // $ar_cur_list_ext[$k]['image_thumb'] = $modx->runSnippet('phpthumbon',array('input' => 'images/'.$arRow['img'], 'options' => $thumb_params_options));
          }
        }
      }

      $type = 'label_with_image';
      $arModsResult[$mod]['origin'] = 'mod';
      $arModsResult[$mod]['type'] = $type;
      $arModsResult[$mod]['code'] = 'value_'.$mod;
      $arModsResult[$mod]['title'] = $arMod['title'];
      $arModsResult[$mod]['alias'] = $modx->filterPathSegment($arMod['title']);
      foreach ($ar_cur_list_ext as $o => $option) {
        $arModsResult[$mod]['options'][$o]['type'] = $type;
        $arModsResult[$mod]['options'][$o]['title'] = $option['title'];
        $arModsResult[$mod]['options'][$o]['name'] = 'value_'.$mod;
        $arModsResult[$mod]['options'][$o]['value'] = $mod;
        $arModsResult[$mod]['options'][$o]['image'] = $option['image'];
        $arModsResult[$mod]['options'][$o]['image_thumb'] = $option['image_thumb'];
      }

    }
  }

  // добавляем модификаторы к настоящим ТП
  if (!empty($arModsResult)) {
    foreach ($arModsResult as $k => $mod) {
      array_unshift($arResult, $mod);
    }
    // array_unshift($arResult, $arModsResult);
  }

  // собираем HTML
  $output = $output_fields = '';
  if (empty($tpl_wrapper)) {
    $tpl_wrapper = '@INLINE <div class="item_torg">{$fields}</div>';
  }

  if (empty($tpl_field)) {
    $tpl_field = '@INLINE <div class="attr_field attr_field_{$code} attr_field_{$alias} attr_type_{$type} attr_{$origin}" data-title="{$title}">
                            {if $show_label == 1}<div class="attr_label" data-title="{$title}">{$title}:</div>{/if}
                            {if ($alias == "razmer" && $show_size_table)}<div class="attr_info"><i class="fa fa-info-circle"></i> Указан российский размер, смотрите соответствие в таблице размеров.</div>{/if}
                            <div class="attr_options_wrap">{$options}</div>
                            {if ($alias == "razmer" && $show_size_table)}
                            <div class="attr_table_size_wrap">
                              <a class="table_size_link" href="javascript:void(0);" data-toggle="modal" data-target="#modal_sizes_table">Таблица размеров</a>
                            </div>
                            {/if}
                          </div>';
  }

  if (empty($tpl_option)) {

    $tpl_option = '@INLINE <div class="grid-control grid-checkbox">
                            <label class="grid-control-label attr_option attr_{$value}" data-value="{$title}">
                              {switch $type}
                                {case "label_with_image"}
                                  {if $image_thumb}
                                    <img src="{$image_thumb}" alt="{$title}" />
                                    <a href="{$image}" title="{$title}" class="attr_option_lightbox lightbox"><i class="fa fa-search-plus"></i></a>
                                  {else}
                                    <span class="attr_option_title">{$title}</span>
                                  {/if}
                                {case default}
                                  <span class="attr_option_title">{$title}</span>
                              {/switch}
                              <input class="grid-control-input" type="radio" name="{$name}" value="{$value}">
                            </label>
                          </div>';
  }

  foreach ($arResult as $f => $field) {
    $output_options = '';
    foreach ($field['options'] as $o => $option) {
      $output_options .= $pdoTools->getChunk($tpl_option, $option);
    }
    $field['options'] = $output_options;
    $output_fields .= $pdoTools->getChunk($tpl_field, $field);
  }

  $output .= $pdoTools->getChunk($tpl_wrapper, array('fields' => $output_fields));
  $crossOptionMap = json_encode($arTorgCrossValues,JSON_FORCE_OBJECT);
  $output .= "<script>\r\n";
  // $output .= "var crossOptionMap = ".json_encode($arTorgCrossValues,JSON_FORCE_OBJECT).";\r\n";
  $output .= "/*{ignore}*/

              if (typeof crossOptionMaps == 'undefined') {var crossOptionMaps = {};}
              if(!crossOptionMaps.hasOwnProperty($cur_id)){
                crossOptionMaps[$cur_id] = $crossOptionMap;
              }
              if (typeof torg != 'undefined') {torg.init($cur_id)}";
  $output .= "/*{/ignore}*/</script>\r\n";

//   $modx->cacheManager->set($cur_id, $output, 0, $cache_options);

// }else{
//   $output = $modx->cacheManager->get($cur_id, $cache_options);
// }

return $output;