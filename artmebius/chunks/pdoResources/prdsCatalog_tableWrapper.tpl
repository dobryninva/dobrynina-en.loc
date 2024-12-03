<table id="products_table" class="table table-striped items_table prds_table">
	<thead>
	  <tr class="">
	    <th class="prds_title">Наименование</th>
			[[+ph_size:is=`1`:then=`<th class="prds_prop prds_size">Размер</th>`]]
			[[+ph_mark:is=`1`:then=`<th class="prds_prop prds_mark">Марка</th>`]]
			[[+ph_diameter:is=`1`:then=`<th class="prds_prop prds_diameter">Диаметр</th>`]]
			[[+ph_shelf:is=`1`:then=`<th class="prds_prop prds_shelf">Полка</th>`]]
			[[+ph_thickness:is=`1`:then=`<th class="prds_prop prds_thickness">Толщина</th>`]]
			[[+ph_mark_width:is=`1`:then=`<th class="prds_prop prds_mark_width">Марка, Ширина</th>`]]
			[[+ph_characteristic:is=`1`:then=`<th class="prds_prop prds_characteristic">Хар-ка</th>`]]
			[[+ph_wall:is=`1`:then=`<th class="prds_prop prds_wall">Стенка</th>`]]
			[[+ph_mark_size:is=`1`:then=`<th class="prds_prop prds_mark_size">Размер, Марка</th>`]]
			[[+ph_width:is=`1`:then=`<th class="prds_prop prds_width">Ширина</th>`]]
			[[+ph_length:is=`1`:then=`<th class="prds_prop prds_length">Длина</th>`]]
			[[+ph_units:is=`1`:then=`<th class="prds_prop prds_units">Ед.изм</th>`]]
	    <th class="prds_prop prds_price">Цена, руб.</th>
	    <th class="prds_buy"></th>
	  </tr>
	</thead>
	<tbody class="ajax_rows">
		[[+inner]]
	</tbody>
</table>