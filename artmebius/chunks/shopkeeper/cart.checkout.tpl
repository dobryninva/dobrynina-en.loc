<div class="shop-cart cart_checkout" data-shopcart="5">
  <p class="cart_message">Ваша корзина пуста</p>
</div>
<!--tpl_separator-->
<div class="shop-cart cart_checkout" data-shopcart="5">
  <form action="{$this_page_url}#shopCart" method="post">
    <div class="table-responsive">
      <table class="table_cart table_cart_full table table-striped">
        <thead>
          <tr class="cart_ths">
            <th class="cart_img">Фото</th>
            <th class="cart_title">Наименование</th>
            <th class="cart_price">Цена</th>
            <th class="cart_qty">Кол-во</th>
            <th class="cart_price_count">Сумма</th>
            <th class="cart_del"><span class="fa fa-trash"></span></th>
          </tr>
        </thead>
        <tbody>
          {$inner}
        </tbody>
      </table>
    </div>
  </form>
  {if $delivery_name != '[ Метод доставки не выбран ]'}
    <div class="cart_delivery" style="text-align:right;">Доставка: {$delivery_name} ({$delivery_price} {$currency})</div>
  {/if}
  <div class="cart_total" style="text-align:right;">Общая сумма: <b>{$price_total}</b> {$currency}</div>
</div>