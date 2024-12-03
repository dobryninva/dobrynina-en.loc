<div class="mdl recommended_products catalog_main">
  <h3 class="mdl-header tac">Тебе также может понравиться</h3>
  [[getProductsExt?
    &parents        =`-1`
    &resources      =`[[*recommended_products]]`
    &showHidden     =`1`
    &hideContainers =`1`
    &limit          =`20`
    &depth          =`0`
    &sortby         =`menuindex`
    &sortdir        =`ASC`
    &sortbyTV       =`label`
    &sortdirTV      =`DESC`
    &includeTVs     =`price,image,size,old_price,label,number,model,units`

    &outerTpl       =`prdsCatalog_tableWrapper`
    &tpl            =`prdsCatalog_tableRow`
    &frontend_css   =``
  ]]
  [[-!pdoResources?
    &parents=`0`
    &resources=`[[*recommended_products]]`
    &depth=`10`
    &hideContainers=`0`
    &showHidden=`1`
    &sortby=`RAND()`
    &sortdir=`ASC`
    &limit=`4`
    &includeTVs=`pol,obuv,kollekciya,odejda,dopolnitelno,brendy,aksessuary,price,image,old_price,size,label`
    &processTVs=`0`
    &tplWrapper=`prdsRecommended_gridWrapper`
    &tpl=`prdsRecommended_gridRow`
    &frontend_css=``
  ]]
</div>