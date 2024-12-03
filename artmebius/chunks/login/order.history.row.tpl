<div class="item_block">
  <div class="item_title_wrap">
    <span class="item_title">Заказ № [[+orderID]]</span>
    <span class="item_date">от <span class="item_date_value">[[+date:strtotime:date=`%d-%m-%Y %X`]]</span></span>
  </div>
  <div class="item_info">
    <div class="item_status">Статус: <span class="item_status_value">[[+status]]</span></div>
    <div class="order_products">
      [[+order_items]]
    </div>
    <div class="item_delivery_wrap">
      <span>Способ доставки:</span>
      <span>[[+delivery]]</span>
    </div>
    <div class="item_payment_wrap">
      <span>Способ оплаты:</span>
      <span>[[+payment]]</span>
    </div>
    <div class="item_summary">
      <span>Общая сумма:</span>
      <span class="item_summary_price">[[+price_total:num_format]] [[+currency]]</span>
    </div>
  </div>
</div>