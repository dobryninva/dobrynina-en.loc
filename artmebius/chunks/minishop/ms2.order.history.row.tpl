<div class="order_item">
  <div class="order_item_title">
    <a class="order_item_title_link" href="{$_modx->resource.id|url}?msorder={$id}">
      <span class="order_item_title_link_text">Заказ № {$num}.</span>
    </a>
  </div>
  <div class="order_item_info">
    <div class="order_item_date">
      <span class="order_item_date_title order_item_info_title">Дата:</span>
      <span class="order_item_date_value order_item_info_value">{$createdon| date_format:"%d.%m.%Y %H:%M:%S" | dateago}</span>
    </div>
    <div class="order_item_status">
      <span class="order_item_status_title order_item_info_title">Статус:</span>
      <span class="order_item_status_value order_item_info_value">{$status_name}</span>
    </div>
    <div class="order_item_delivery">
      <span class="order_item_delivery_title order_item_info_title">Способ доставки:</span>
      <span class="order_item_delivery_value order_item_info_value">{$delivery_name}</span>
    </div>
    <div class="order_item_payment">
      <span class="order_item_payment_title order_item_info_title">Способ оплаты:</span>
      <span class="order_item_payment_value order_item_info_value">{$payment_name}</span>
    </div>
    <div class="order_item_summary">
      <span class="order_item_summary_title order_item_info_title">Общая сумма:</span>
      <span class="order_item_summary_value order_item_info_value">{$cost | num_format} руб</span>
    </div>
  </div>
</div>