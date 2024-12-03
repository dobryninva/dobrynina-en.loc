<div id="filters" class="mdl filters_widget filters_side">
  <div class="filter_switcher d-md-none closed">
    <a class="switcher_link link-inline link-pointer link-dotted" href="#">
      <span class="switcher_title"> <span class="switcher_title_closed">Показать</span><span class="switcher_title_opened">Скрыть</span> фильтр</span>
    </a>
  </div>
  <div class="mdl_body">
    <form id="form_filters" action="{$id | url}" method="get">
      <div class="filter_options">
        {'!tmFilters' | snippet : [
          'debug'                 => 0,
          'jsMap'                 => 1,
          'style'                 => 0,
          'jsScript'              => 1,
          'filtersType'           => 'filters',
          'filterNumericOuterTpl' => 'filter.property.wrapper',
          'filterNumericTpl'      => 'filter.numeric.row',
          'filterOuterTpl'        => 'filter.property.wrapper',
          'filterTpl'             => 'filter.checkbox.row',
        ]}
        {*
          'filterGroupOuterTpl'   => 'filter.group.wrapper',
          'filterGroupTpl'        => 'filter.group.row',
        *}
        <button type="button" class="btn-clear link-inline link-pointer link-dotted" onclick="tmFilters.resetFilters();tmFilters.resetExt();return false;">Сбросить</button>
      </div>
      <input type="hidden" name="page_id" value="{$id}" disabled="disabled" />
    </form>
  </div>
</div>