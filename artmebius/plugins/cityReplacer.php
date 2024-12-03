<?php
/*
--
cityReplacerExclude
Исключить ресурсы из автозамены городов на поддоменах
Список id ресурсов через запятую
--

--
cityReplacerDefault radio да==1||нет==0
Основной домен
--

--
cityReplacer Поддомены / города
  Вкладки формы:
    [{"caption":"items", "fields": [
    {
      "field":"default",
      "caption":"Основной домен",
      "inputTV":"cityReplacerDefault",
      "description":"Из списка доменов один должен быть обязательно отмечен как основной"
    },
    {
      "field":"domain",
      "caption":"Домен",
      "description":"Название домена, без протокола"
    },
    {
      "field":"code",
      "caption":"Код",
      "description":"Краткое название поддомена, используется в контенте в виде тегов {nn}...{/nn} {msk}...{/msk} и т.п"
    },
    {
      "field":"names",
      "caption":"Соответствия городов для автозамены",
      "description":"Список соответствий городов, через разделитель ||. Каждый из элементов списка соответствуют элементу списка других доменов. Т.е. при заполнении последовательности городов, на всех доменах, необходимо соблюдать единую падежность элементов списка (Нижний Новгород||Нижнему Новгороду||Нижним Новгородом  --  Москва||Москве||Москвой и т.п.)"
    }
    ]}]
  Разметка колонок:
    [{"header": "Основной", "sortable": "true", "dataIndex": "default", "width":"100"},
    {"header": "Домен", "sortable": "true", "dataIndex": "domain","width":"150"},
    {"header": "Код", "sortable": "true", "dataIndex": "code","width":"100"
    },
    {"header": "Соответствия городов для автозамены", "sortable": "true", "dataIndex": "names","width":"650"
    }]

    Нижний Новгород||Нижнего Новгорода||Нижнему Новгород||Нижним Новгородом||в Нижнем Новгороде||В Нижнем Новгороде
    Москва||Москвы||Москве||Москвой||в Москве||В Москве
--
*/
if(!function_exists('getTVValueByName')){
  function getTVValueByName($modx,$name){
    $q = $modx->newQuery("modTemplateVar");
    $q->select("values.value");
    $q->leftJoin("modTemplateVarResource", "values", "values.tmplvarid = modTemplateVar.id");
    $q->where(array(
      "modTemplateVar.name"   => $name,
    ));
    if ($q->prepare() && $q->stmt->execute()) {
      $result = $q->stmt->fetch(PDO::FETCH_COLUMN);
      return $result;
    }
  }
}

$eventName = $modx->event->name;
switch($eventName) {
//  // case "OnWebPageInit":
//  case "OnLoadWebDocument":
//    // $cities = array();
//    // // получаем список городов / доменов из TV cityReplacer
//    // $citiesJson = getTVValueByName($modx,'cityReplacer');

//    // if($citiesJson){
//    //  $cities = json_decode($citiesJson);

//    //  if(count($cities) < 2) return;
//    //  foreach ($cities as $k => $city) {
//    //    if ($city->domain == MODX_HTTP_HOST) {
//    //      $cityActive = $city;
//    //      break;
//    //    }
//    //  }
//    // }
//    // $modx->setPlaceholder('cityActiveCode',$cityActive->code);
//    // $modx->setPlaceholder('cityActiveDomain',$cityActive->domain);


//    if (strrpos(MODX_SITE_URL, 'nnov') === false) {
//      $result = $modx->runSnippet('checkAccess');
//      if (!empty($result) && $result) {
//        $modx->sendErrorPage();
//      }
//    }


//  break;
  case "OnWebPagePrerender":
    $cities = array();

    $output = &$modx->resource->_output;

    // получаем список городов / доменов из TV cityReplacer
    $citiesJson = getTVValueByName($modx,'cityReplacer');

    if($citiesJson){
      $cities = json_decode($citiesJson);

      foreach ($cities as $k => $city) {
        $cities[$k]->names = array_map('trim',explode("||", $city->names));
      }
    }

    if(count($cities) < 2) return;
    // поиск и замена тегов {city_code}..{/city_code}
    foreach ($cities as $city) {
      if ($city->domain == MODX_HTTP_HOST) {
        $cityActive = $city;
        $output = preg_replace("/\[[\/]?".$city->code."\]/is", "",$output);
      }
      else {
        $output = trim(preg_replace("/\[".$city->code."\]([^\[\]]*)\[\/".$city->code."\]/is", "", $output));
      }
    }

    // определяем основной домен/город
    foreach ($cities as $k=>$city) {
      if($city->default){
        $cityMain = $cities[$k];
        break;
      }
    }

    // обработка составных кодов пример {nn,msk}Текст для Москвы и Нижнего Новгорода{/nn,msk}
    if(isset($cityActive)) {
      preg_match_all("/\[([А-яA-z\-,]*)\]/is", $output, $matches);
      foreach ($matches[1] as $tagMulti) {
        if($tagMulti && substr_count($tagMulti, ',')){
          $tags = explode(',', $tagMulti);
          if(in_array($cityActive->code, $tags)){
            $output = preg_replace("/\[[\/]?".$tagMulti."\]/is", "",$output);
          }
          else {
            $output = trim(preg_replace("/\[".$tagMulti."\]([^\[\]]*)\[\/".$tagMulti."\]/is", "", $output));
          }
        }
      }
    }

    if(isset($cityMain)) {
      // исключения id ресурсов
      $citiesExclude = getTVValueByName($modx,'cityReplacerExclude');
      $citiesExclude = array_map("trim",explode(",", $citiesExclude));
      if (in_array($modx->resource->id, $citiesExclude)) {
        return;
      }

      if($cityMain->domain == MODX_HTTP_HOST){
        $output = preg_replace("/\[[\/]?exclude\]/is", "",$output);
      }
      else {
        $patternExclude = "/\[exclude\](.*?)\[\/exclude\]/is";

        preg_match_all($patternExclude, $output, $matchesExclOrig);

        foreach ($cities as $key => $city) {
          if ($city->domain == MODX_HTTP_HOST) {
            $output = str_replace($cityMain->names, $city->names, $output);
          }
        }

        preg_match_all($patternExclude, $output, $matchesExclUpd);

        $output = str_replace($matchesExclUpd[0], $matchesExclOrig[1], $output);

      }
    }
  break;
}