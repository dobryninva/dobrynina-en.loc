<div class="mdl sort_and_pages row">
  <div class="col-sm-12 col-md-8 col-lg-9">
    <div class="sorting_col">
      <span class="sort_title">Сортировать по:</span>
      <span class="sort_options">
        {'!sortLink' | snippet : ['url'=>$uri,'field'=>'pagetitle','caption'=>'По названию']}
        {'!sortLink' | snippet : ['url'=>$uri,'field'=>'price','caption'=>'По цене']}
      </span>
    </div>
    <div class="paging_col">
      <span class="sort_title">Показывать по:</span>
      {'!pagesLink' | snippet : ['url'=>$uri,'limit'=>24]}
      {'!pagesLink' | snippet : ['url'=>$uri,'limit'=>48]}
      {'!pagesLink' | snippet : ['url'=>$uri,'limit'=>96]}
    </div>
  </div>
  <div class="col-sm-12 col-md-4 col-lg-3">
    <div id="viewSwitch" class="view_switchers">
      <a rel="nofollow" data-action="grid" href="{$id | url}" class="active"><span class="fa fa-th-large"></span> Галерея</a>
      <a rel="nofollow" data-action="table" href="{$id | url}"><span class="fa fa-bars"></span> Список</a>
    </div>
  </div>
</div>
