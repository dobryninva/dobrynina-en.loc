<div class="shop-cart cart_compact" data-shopcart="6">
  <table class="cart_table_compact cart_table_empty">
    <thead>
      <tr>
        <th class="ct_icn"><span class="icon-shopping-cart"></span></th>
        <th class="ct_message">Ваша корзина пуста</th>
      </tr>
    </thead>
  </table>
</div>
<!--tpl_separator-->
<div class="shop-cart cart_compact" data-shopcart="6">
  <form action="[[+this_page_url]]#shopCart" method="post">
    <table class="cart_table_compact cart_table_full">
      <thead>
        <tr>
          <th class="ct_icn"><span class="icon-shopping-cart"></span></th>
          <th class="ct_message">Выбрано: <b>[[+items_total]]</b> [[+plural]]</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        [[+inner]]
      </tbody>
    </table>
    <noscript>
      <div><input type="submit" name="shk_recount" value="Пересчитать" /></div>
    </noscript>
    [[+delivery_name:isnot=`[ Метод доставки не выбран ]`:then=`<div class="cart_delivery" style="text-align:right;">Доставка: [[+delivery_name]] ([[+delivery_price]] [[+currency]])</div>`]]
    <div class="cart_total">Общая сумма: <b>[[+price_total]]</b> [[+currency]]</div>
    <div class="cart_ctrl clearfix">
      <a href="[[+empty_url]]" id="shk_butEmptyCart">Очистить корзину</a>
      <a href="/[[+order_page_url]]" id="shk_butOrder" onclick="showFormCartOrder(); return false;">Оформить заказ</a>
    </div>
  </form>
</div>