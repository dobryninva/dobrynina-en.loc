<?php
if (!function_exists(dd)){
  function dd($var){
    print '<pre>';
    print_r($var);
    print '</pre>';
  }
}

$q = $modx->newQuery('modResource');
$q->where(array(
  'template:IN' => [24,50],
  'published' => 1,
  'deleted' => 0
));
$q->sortby('pagetitle','ASC');

if(!$docs = $modx->getCollection('modResource',$q)){return;}

foreach($docs as $doc){
  $rid = $doc->id;
  $pagetitle = $doc->pagetitle;
  $paramtitle = '';
  $units = $doc->getTVValue('tname');
  $link = $modx->makeUrl($rid,'web');
  $template = '';

  $migx_torg_id = 67;
  $arJson = array();
  $json_raw = '';
  $query = $modx->newQuery('modTemplateVarResource', array('contentid' => $rid, 'tmplvarid' => $migx_torg_id));
  $query->select('value');
  if($query->prepare() && $query->stmt->execute()) {
    $res = $query->stmt->fetch(PDO::FETCH_ASSOC);
    $json_raw = $res['value'];
  }

  // если заполнены торговые предложения
  if (!empty($json_raw)) {

    $arJson = json_decode($json_raw, true);
    //dd($arJson);

    $arOffers = array();
    foreach ($arJson as $key => $offer){
      if (!empty($offer['vybor2']) && !empty($offer['value2'])){
        $paramtitle = $offer['vybor2'];
        $arOffers[$offer['value1']][] = $offer;
      }
    }
    //dd($arOffers);

    // если торговые предложения зависимые
    if (!empty($arOffers)){

      $arResult = array();
      foreach ($arOffers as $nameOffer => $curOffers) {
        $i = 0;
        $prevValue = '';
        foreach ($curOffers as $key => $offer){
          if ($key == 0) {
            $arResult[$nameOffer][$i]['value'] = $offer['value2'];
            $arResult[$nameOffer][$i]['price'] = $offer['price'];
            $prevValue = $offer['value2'];
            continue;
          }

          if ($offer['price'] != $arResult[$nameOffer][$i]['price']) {
            $arResult[$nameOffer][$i]['value'] = ($arResult[$nameOffer][$i]['value'] != $prevValue) ? $arResult[$nameOffer][$i]['value'].' - '.$prevValue : $arResult[$nameOffer][$i]['value'];
            ++$i;
            $arResult[$nameOffer][$i]['value'] = $offer['value2'];
            $arResult[$nameOffer][$i]['price'] = $offer['price'];
            $prevValue = $offer['value2'];
          } else {
            $prevValue = $offer['value2'];
            if (count($curOffers) == ($key + 1)) {
              $arResult[$nameOffer][$i]['value'] = $arResult[$nameOffer][$i]['value'].' - '.$prevValue;
            }
          }
        }
      }
      //dd($arResult);

      $template = '<h3><a href="'.$link.'" title="'.$pagetitle.'">'.$pagetitle.'</a></h3><table class="table"><thead><tr><th class="prds_title">Наименование</th><th class="prds_param">'.$paramtitle.'</th><th class="prds_units">Ед.изм</th><th class="prds_price">Цена руб/ед. без НДС</th></tr><thead><tbody>';
      foreach ($arResult as $nameOffer => $arOffer){
        $price = '';
        foreach ($arOffer as $key => $offer) {
          $price = ($offer['price'] > 0) ? $offer['price'] : 'уточните';
          $template .= '<tr><td class="prds_title">'.$pagetitle.' '.$nameOffer.'</td><td class="prds_param">'.$offer['value'].'</td><td class="prds_units">'.$units.'</td><td class="prds_price">'.$price.'</td></tr>';
        }
      }
      $template .= '</tbody></table>';
      print $template;

    // если торговые предложения обычные
    } else {

      $arResult = array();
      $i = 0;
      $prevValue = '';
      foreach ($arJson as $key => $offer){
        if ($key == 0) {
          $paramtitle = $offer['vybor1'];
          $arResult[$i]['value'] = $offer['value1'];
          $arResult[$i]['price'] = $offer['price'];
          $prevValue = $offer['value1'];
          continue;
        }

        if ($offer['price'] != $arResult[$i]['price']) {
          $arResult[$i]['value'] = ($arResult[$i]['value'] != $prevValue) ? $arResult[$i]['value'].' - '.$prevValue : $arResult[$i]['value'];
          ++$i;
          $arResult[$i]['value'] = $offer['value1'];
          $arResult[$i]['price'] = $offer['price'];
          $prevValue = $offer['value1'];
        } else {
          $prevValue = $offer['value1'];
          if (count($arJson) == ($key + 1)) {
            $arResult[$i]['value'] = $arResult[$i]['value'].' - '.$prevValue;
          }
        }
      }
      //dd($arResult);

      $template = '<h3><a href="'.$link.'" title="'.$pagetitle.'">'.$pagetitle.'</a></h3><table class="table"><thead><tr><th class="prds_title">Наименование</th><th class="prds_param">'.$paramtitle.'</th><th class="prds_units">Ед.изм</th><th class="prds_price">Цена руб/ед. без НДС</th></tr><thead><tbody>';
      $price = '';
      foreach ($arResult as $key => $offer){
        $price = ($offer['price'] > 0) ? $offer['price'] : 'уточните';
        $template .= '<tr><td class="prds_title">'.$pagetitle.'</td><td class="prds_param">'.$offer['value'].'</td><td class="prds_units">'.$units.'</td><td class="prds_price">'.$price.'</td></tr>';
      }
      $template .= '</tbody></table>';
      print $template;

    }

  // если нет торговых предложений
  } else {

    $tempPrice = $doc->getTVValue('price');
    $price = ($tempPrice > 0) ? $tempPrice : 'уточните';
    $template = '<h3><a href="'.$link.'" title="'.$pagetitle.'">'.$pagetitle.'</a></h3><table class="table"><thead><tr><th class="prds_title">Наименование</th><th class="prds_units">Ед.изм</th><th class="prds_price">Цена руб/ед. без НДС</th></tr><thead><tbody>';
    $template .= '<tr><td class="prds_title">'.$pagetitle.'</td><td class="prds_units">'.$units.'</td><td class="prds_price">'.$price.'</td></tr>';
    $template .= '</tbody></table>';
    print $template;

  }

}