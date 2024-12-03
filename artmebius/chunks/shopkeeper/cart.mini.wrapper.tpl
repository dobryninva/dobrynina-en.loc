<div class="shop-cart cart_mini cart_def" data-shopcart="3">
  <div class="cart_link">
    <span class="switcher_icon hdr_icon icon_cart"></span>
    <span class="cart_qty">0</span>
  </div>
</div>
<!--tpl_separator-->
<div class="shop-cart cart_mini cart_def" data-shopcart="3">
  <form action="{$this_page_url}" method="post">
    <a class="cart_link" href="{$order_page_url}">
      <span class="switcher_icon hdr_icon icon_cart"></span>
      <span class="cart_qty">{$items_total}</span>
    </a>
  </form>
</div>
{*
<span class="cart_row">Корзина - {$price_total} {$currency}</span>
<a href="{$empty_url}" id="shk_butEmptyCart" title="Очистить корзину"><span class="fa fa-trash d-xs-none d-md-inline-block"></span><span class="d-xs-inline d-md-none">очистить</span></a>
{$inner} - список товаров (по шаблону cart.mini.row);
{$price_total} - общая цена товаров в корзине;
{$items_total} - общее число товаров в корзине;
{$items_unique_total} - общее число уникальных товаров в корзине;
{$plural} - слово "товар" во множественном числе в зависимости от числа выбранных товаров;
{$this_page_url} - адрес текущей страницы;
{$empty_url} - ссылка для очистки корзины;
{$order_page_url} - ссылка на страницу оформления заказа;
{$currency} - валюта товаров;
{$delivery_name} - Название выбранной доставки.
{$delivery_price} - Цена выбранной доставки.
*}