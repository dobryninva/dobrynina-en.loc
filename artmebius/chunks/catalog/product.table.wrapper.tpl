{* $table_options *}
{set $table_options_arr = $table_options | split : ','}
{set $table_options_quotes = '"'~($table_options_arr | join : '","')~'"'}
{set $table_options_th_html = 'pdoResources' | snippet : [
  'class'   => 'msOption',
  'select'  => '{"msOption":"key, caption"}',
  'where'   => '{"key:IN":['~$table_options_quotes~']}',
  'sortby'  => 'FIELD(msOption.key, '~$table_options_quotes~')',
  'sortdir' => 'ASC',
  'limit'   => 0,
  'tpl'     => '@INLINE <th class="prds_table_prop prds_table_{$key}">{$caption}</th>'
]}
<table class="table table-hover table-th-dark table-sticky table-striped- prds_table">
  <thead>
    <tr class="">
      {if $show_title}<th class="prds_table_title">{$alt_title_caption ? $alt_title_caption : 'Наименование'}</th>{/if}
      {$table_options_th_html}
      <th class="prds_table_price">Цена, руб.</th>
      <th class="prds_table_buy"></th>
    </tr>
  </thead>
  <tbody class="prds_table_ajax_rows">
    {$output}
    {$inner}
  </tbody>
</table>