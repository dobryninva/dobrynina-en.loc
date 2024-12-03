{*
<p><strong>Способ оплаты:</strong> {$delivery}</p>
<p><strong>Способ доставки:</strong> {$payment}</p>
<h3>Состав заказа:</h3>
*}
<table class="noborder">
  <thead>
    <tr><th style="background: #E6EFF6; text-align: left;">Контактные данные</th></tr>
  </thead>
  <tbody>
    <tr><td></td></tr>
    {$contacts}
    <tr><td></td></tr>
  </tbody>
</table>

<table>
  <thead>
    <tr>
      <th style="background: #E6EFF6; text-align: left;"></th>
      <th style="background: #E6EFF6; text-align: left;">Наименование</th>
      <th style="background: #E6EFF6; text-align: left;">Параметры</th>
      <th style="background: #E6EFF6; text-align: left; white-space: nowrap;">Цена, {$currency}</th>
      <th style="background: #E6EFF6; text-align: left; white-space: nowrap;">Кол-во</th>
      <th style="background: #E6EFF6; text-align: left; white-space: nowrap;">Сумма, {$currency}</th>
    </tr>
  </thead>
  <tbody>
    {$purchases}
  </tbody>
  <tfoot>
    <tr class="cart-order">
      <td colspan="5" style="text-align: right;">
        {$delivery}
      </td>
      <td>
        <b>
        {if $delivery != 'Самовывоз' && $delivery_price == 0}
          Стоимость доставки рассчитывается индивидуально
        {else}
          {$delivery_price | numberFormat} {$currency}
        {/if}
        </b>
      </td>
    </tr>
    <tr class="cart-order">
      <td colspan="5" style="text-align: right;">
        <b>Итого:</b>
      </td>
      <td>
        <b>{$price | numberFormat} {$currency}</b>
      </td>
    </tr>
  </tfoot>
</table>
