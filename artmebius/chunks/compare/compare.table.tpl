<table class="table table_compare table-bordered data-table table-responsive">
<!--tpl_separator-->
<tr class="{$classes}">{$inner}</tr>
<!--tpl_separator-->
<td class="odd first"></td>
<!--tpl_separator-->
<td class="prod_td {$classes}">
  <div class="prod_image">
    <img class="items_img" src="{'phpthumbon' | snippet : ['input'=>'/images/'~$image,'options'=>'w=250&h=250&far=1&zc=0&bg=ffffff']}" alt="{$pagetitle}" />
  </div>
  <div class="prod_link">
    <a class="items_link" href="{$id | url}">{$pagetitle}</a> <a class="del-link" href="{$_modx->resource.id | url}?cmpr_action=del_product&amp;pid={$id}" title="Удалить из списка сравнения"><span class="fa fa-times-circle"></span></a>
  </div>
</td>
<!--tpl_separator-->
<td class="odd first">{$param_name}</td>
<!--tpl_separator-->
<td class="{$classes}">{$param_value}</td>
<!--tpl_separator-->
</table>
<a href="{$_modx->resource.id | url}?cmpr_action=empty">Удалить все товары из сравнения</a>