{set $currency = 'shk3.currency' | option}
{* prices *}
{set $price_num = $price | clean : 'num'  | int}
{set $old_price_num = $old_price | clean : 'num' | int}
{* product_title *}
{if $alt_title_option}
  {set $alt_title_value = 'msProductOptions' | snippet : [
    'product'     => $id,
    'onlyOptions' => $alt_title_option,
    'tpl'         => 'ms2.product.option',
  ]}
{/if}
{set $product_title = $alt_title_value ?: ($menutitle ?: $pagetitle)}
{* availability *}
{set $availability = '!msProductOptions' | snippet : [
  'product'     => $id,
  'onlyOptions' => 'product_availability',
  'tpl'         => 'ms2.product.option',
]}
{* table_options *}
{set $table_options_arr = $table_options | split : ','}
{set $table_options_td_html}
  {foreach $table_options_arr as $option}
    <td class="prds_table_prop prds_table_{$option}">
      {'msProductOptions' | snippet : [
        'product'     => $id,
        'onlyOptions' => $option,
        'tpl'         => 'ms2.product.option',
      ]}
    </td>
  {/foreach}
{/set}
{* tpl *}
<tr class="prds_table_item ms2_product" data-id="{$id}">

  {if $show_title}
  <td class="prds_table_title">
    <a class="prds_table_title_link prds_table_link" href="{$id | url}" {$link_attributes}>{$product_title}</a>
  </td>
  {/if}

  {$table_options_td_html}

  <td class="prds_table_price">
    <div class="prds_item_prices">
      {if $old_price}
      <span class="prds_item_price_old">
        <span class="prds_item_price_old_value">{$old_price | num_format}</span>
        <span class="prds_item_price_old_currency price_currency">{$currency}</span>
      </span>
      {/if}
      <span class="prds_item_price{($old_price) ? ' price_with_discount' : ''}">
        {if $price}
          <span class="prds_item_price_value price_value">{$price | num_format}</span> <span class="prds_item_price_currency price_currency">{$currency}</span>
        {else}
          <span class="prds_item_price_value price_value">по запросу</span>
        {/if}
      </span>
    </div>
  </td>

  <td class="prds_table_buy">
    <form class="prds_table_form ms2_form" action="{$_modx->resource.id | url}" method="post">
      <button class="prds_table_buy_btn btn btn-dark-gray btn-h-red btn-buy" type="submit" name="ms2_action" value="cart/add">Купить</button>
      <input type="hidden" name="id" value="{($class_key == 'modSymLink') ? $content : $id}" />
      <input type="hidden" name="count" value="1">
    </form>
  </td>

</tr>