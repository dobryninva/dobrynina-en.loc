<div class="cart_full" data-shopcart="4">
  <p class="cart_message">Ваша корзина пуста</p>
</div>
<!--tpl_separator-->
<div class="cart_full" data-shopcart="4">
  <form action="[[+this_page_url]]#shopCart" method="post">
    <div class="table-responsive">
      <table class="table_cart table_cart_full table-responsive table table-striped">
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
          [[+inner]]
        </tbody>
      </table>
    </div>
    <div class="cart_total" style="text-align:right;">
      Общая сумма: <b>[[+price_total]]</b> [[+currency]]
    </div>
    <noscript>
      <div><input type="submit" name="shk_recount" value="Пересчитать" /></div>
    </noscript>
    <div class="cart_ctrl clearfix">
      <a href="[[~11]]" id="shk_back" class="btn-d-gray"><span class="fa fa-angle-left"></span> Продолжить выбор товаров</a>
      <a href="[[+order_page_url]]" id="shk_butOrder" class="btn-d-gray">Оформить заказ <span class="fa fa-angle-right"></span></a>
    </div>
  </form>
</div>