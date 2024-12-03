<div class="sort_panel">
  <div class="row">
    <div class="col-xs-6">
      <div class="sorting_col">
        <span class="sort_title">Сортировать по:</span>
        [[!sortLink? &url=`[[*uri]]` &field=`price` &caption=`Цене` &active=`1`]]
        [[-!sortLink? &url=`[[*uri]]` &field=`pagetitle` &caption=`Наименованию`]]
        [[-!sortLink? &url=`[[*uri]]` &field=`availability` &caption=`Наличию`]]
      </div>
    </div>
    <div class="col-xs-6">
      <div class="paging_col">
        <span class="sort_title">Показывать по:</span>
        [[!pagesLink? &url=`[[*uri]]` &limit=`6`]]
        [[!pagesLink? &url=`[[*uri]]` &limit=`12` &active=`1`]]
        [[!pagesLink? &url=`[[*uri]]` &limit=`24`]]
        [[!pagesLink? &url=`[[*uri]]` &limit=`48`]]
      </div>
    </div>
  </div>
</div>
<div id="products" class="shop_prds">
  [[!tmCatalog@catalog_filters?
    &parents =`[[*id]]`
    &sortby  =`menuindex`
    &sortdir =`ASC`
  ]]
</div>
<div id="pages">
  [[!+page.nav]]
</div>