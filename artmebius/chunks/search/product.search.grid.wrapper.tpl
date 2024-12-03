<p class="sr_info">{$resultInfo}</p>
<div class="catalog_main">
  <div class="catalog_main_ctgs">
  	<div class="prds_grid ctgs_grid tiles_grid items_grid">
      <div class="row tiles_row">
        {$results}
      </div>
    </div>
  </div>
</div>
<div class="sr_pagi">
  <nav class="pagination_bottom"><ul class="pagination">{$paging}</ul></nav>
</div>
{*
  <p class="sr_pages">[[%sisea.result_pages? &namespace=`sisea` &topic=`default`]]</p> ???
*}