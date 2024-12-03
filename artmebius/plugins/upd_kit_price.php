<?php
switch ($modx->event->name) {
  case 'OnDocFormSave':
    if ($resource->get('template') == 21) {
      $price = 0;
      $arKit = $arNames = $arNamesCount = $arProds = $arKitsWithDiscount = array();

      $id = $resource->get('id');
      $kit = $resource->getTVValue('kit');
      $color = mb_strtolower($resource->getTVValue('color_kit'));
      $tkan = mb_strtolower($resource->getTVValue('tkan_kit')); // tt
      $tkan_enable = 0;
      if (!empty($tkan)) {
        $tkan_enable = 1; // включаем проверку на ткань
      }
      $discount = $resource->getTVValue('discount'); // tt

      if (!empty($kit)) {

        $arKit = json_decode($kit, true);
        foreach ($arKit as $k => $prod) {
          $arNames[] = $prod['prod_name'];
        }
        $arNamesCount = array_count_values($arNames);
        $strNames = "'".implode("','", $arNames)."'";

        $q = $modx->newQuery('modResource');
        $q->select(array('modResource.*'));
        $q->where(array(
          'pagetitle:IN'=>$arNames,
          'published'=>1,
          'deleted'=>0
        ));
        $q->sortby("FIELD(pagetitle,".$strNames.")");

        if(!$prods = $modx->getIterator('modResource', $q)){return;}

        foreach ($prods as $prod){

          $prod_id = $prod->get('id');
          $prod_price = $prod->getTVValue('price');
          $prod_discount = $prod->getTVValue('discount');
          $prod_kits_with_discount = $prod->getTVValue('kits_with_discount');
          $prod_torg = (!empty($prod->getTVValue('migx_torg'))) ? json_decode($prod->getTVValue('migx_torg'), true) : array();
          $prod_tkan = $prod->getTVValue('tkan');
          $prod_count = $arNamesCount[$prod->get('pagetitle')];

          // проверяем ткань: если заполнена и в комплекте и у товара
          $ar_prod_tkan = array();
          if ($tkan_enable) { // если проверка включена
            if (!empty($prod_tkan)) { // и если ткань заполнена у товара
              $ar_prod_tkan = array_map('mb_strtolower',array_map('trim', explode(',', $prod_tkan)));
              if (!in_array($tkan, $ar_prod_tkan)) {
                continue;
              }
            }
          }

          $min_price = $need_save = 0;

          if (!empty($prod_torg)) {
            foreach ($prod_torg as $k => $torg) {

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

              // отфильтровываем ТП: если цвет найден
              if ($have_color) {
                // исключаем ТП без нужного цвета
                if (mb_strtolower($torg[$color_value_code]) != $color) {
                  continue;
                }
                // исключаем ТП с пустыми значениями параметров
                if ($count_fields == 0) {
                  continue;
                }
              } // если ТП без цвета
              else {
                // исключаем ТП с пустыми значениями параметров или если количество параметров больше одного
                if ($count_fields != 1) {
                  continue;
                }
              }

              // ищем мин. цену среди подходящих ТП каждого товара
              if ($torg['price'] < $min_price || $min_price == 0) {
                $min_price = $torg['price'];
              }

              // если у комплекта скидка, сохраняем id комплекта в доступных ТП без собственной скидки
              if (!empty($discount) && empty($torg['discount'])) {
                $arKitsWithDiscount = (!empty($torg['kits_with_discount'])) ? array_map('trim', explode(',', $torg['kits_with_discount'])) : array();
                if (!empty($arKitsWithDiscount)) {
                  if (!in_array($id, $arKitsWithDiscount)) {
                    $need_save = 1;
                    $arKitsWithDiscount[] = $id;
                  }
                } else {
                  $need_save = 1;
                  $arKitsWithDiscount[] = $id;
                }
              }

              if (!empty($arKitsWithDiscount)) {
                $prod_torg[$k]['kits_with_discount'] = implode(',', $arKitsWithDiscount);
              }


            } // foreach ($prod_torg as $k => $torg)

            if ($prod_count > 0) {
              $price += $min_price * $prod_count;
            } else {
              $price += $min_price;
            }

            if ($need_save) {
              $prod->setTVValue('migx_torg', json_encode($prod_torg));
              $prod->save();
            }

          } // if (!empty($prod_torg))
          else {

            if ($prod_count > 0) {
              $price += $prod_price * $prod_count;
            } else {
              $price += $prod_price;
            }

            // если у комплекта скидка, сохраняем id комплекта если товар без собственной скидки
            if (!empty($discount) && empty($prod_discount)) {
              $arKitsWithDiscount = (!empty($prod_kits_with_discount)) ? array_map('trim', explode(',', $prod_kits_with_discount)) : array();
              if (!empty($arKitsWithDiscount)) {
                if (!in_array($id, $arKitsWithDiscount)) {
                  $need_save = 1;
                  $arKitsWithDiscount[] = $id;
                }
              } else {
                $need_save = 1;
                $arKitsWithDiscount[] = $id;
              }
            }

            if ($need_save) {
              $prod->setTVValue('kits_with_discount', implode(',', $arKitsWithDiscount));
              $prod->save();
            }

          }

          // if ($prod_count > 0) {
          //   $price = $price * $prod_count;
          // }

        } // end foreach ($prods as $prod)

        if (!empty($discount)) {
          $discount_price = $price * (1 - $discount / 100);
          $resource->setTVValue('old_price', $price);
          $resource->setTVValue('price', $discount_price);
        } else {
          $resource->setTVValue('old_price', $price);
          $resource->setTVValue('price', $price);
        }


      } // !empty $kit

    }
    break;
}