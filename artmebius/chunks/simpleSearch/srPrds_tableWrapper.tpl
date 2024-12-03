<p class="sr_info">[[+resultInfo]]</p>
<div class="catalog_main">
	<table id="products_table" class="table table-striped items_table prds_table">
    <thead>
      <tr class="hidden-xs">
        <th class="prds_title">Наименование</th>
[[-
        <th class="prds_prop prds_units">Ед. изм.</th>
-]]
        <th class="prds_prop prds_price">Цена</th>
        <th class="prds_buy"><span class="fa fa-shopping-basket"></span></th>
      </tr>
    </thead>
    <tbody>
      [[+results]]
    </tbody>
  </table>
</div>
<div class="sr_pagi">
  <p class="sr_pages">[[%sisea.result_pages? &namespace=`sisea` &topic=`default`]]</p>
  <nav class="pagination"><ul>[[+paging]]</ul></nav>
</div>