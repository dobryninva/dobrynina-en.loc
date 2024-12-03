<form id="msOrder" class="ms2_form checkout_order" method="post">
  <div class="checkout_order_deliveries_payments row">

    {if $deliveries}
      <div class="col-md-6 mb-4">
        <div class="checkout_order_deliveries divider_top" id="deliveries">
          <div class="checkout_order_deliveries_title checkout_order_sub_title">Способ доставки</div>
          {foreach $deliveries as $delivery index=$index}
            {set $checked = !($order.delivery in keys $deliveries) && $index == 0 || $delivery.id == $order.delivery}
            <div class="custom-control custom-radio">
              <input class="custom-control-input" id="delivery_{$delivery.id}" type="radio" name="delivery" value="{$delivery.id}" data-payments="{$delivery.payments | json_encode}" {$checked ? 'checked' : '' }>
              <label class="custom-control-label delivery" for="delivery_{$delivery.id}">
                <div class="fixp">
                  {if $delivery.logo}
                    <img class="delivery_logo" src="{$delivery.logo}" alt="{$delivery.name}" title="{$delivery.name}" />
                  {else}
                    <span class="delivery_name">{$delivery.name}</span>
                  {/if}
                  {if $delivery.price}
                    <span class="delivery_price">(+ {$delivery.price} руб.)</span>
                  {/if}
                </div>
                {if $delivery.description}
                  <div class="delivery_description small">{$delivery.description}</div>
                {/if}
              </label>
            </div>
          {/foreach}
        </div>
      </div>
    {/if}

    {if $payments}
      <div class="col-md-6 mb-4">
        <div class="checkout_order_payments divider_top" id="payments">
          <div class="checkout_order_payments_title checkout_order_sub_title">Способ оплаты</div>
          {foreach $payments as $payment index=$index}
            {var $checked = !($order.payment in keys $payments) && $index == 0 || $payment.id == $order.payment}
            <div class="custom-control custom-radio">
              <input class="custom-control-input" id="payment_{$payment.id}" type="radio" name="payment" value="{$payment.id}" {$checked ? 'checked' : '' }>
              <label class="custom-control-label payment fixp" for="payment_{$payment.id}">
                <div class="fixp">
                  {if $payment.logo}
                    <img class="payment_logo mw-100" src="{$payment.logo}" alt="{$payment.name}" title="{$payment.name}" />
                  {else}
                    <span class="payment_name">{$payment.name}</span>
                  {/if}
                </div>
                {if $payment.description}
                  <div class="payment_description small">{$payment.description}</div>
                {/if}
              </label>
            </div>
          {/foreach}
        </div>
      </div>
    {/if}
  </div>

  <div class="checkout_order_customer divider_top form-default mb-4">
    <div class="checkout_order_customer_title checkout_order_sub_title">Контактные данные</div>
    <div class="row form-fix">
      <div class="form-group col-lg-12">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-user"></i></span>
          <input class="form-control" size="100" type="text" name="receiver" value="" id="" placeholder="Ваше имя">
          <span class="error"></span>
        </div>
      </div>
      <div class="form-group col-lg-6">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-phone fa-flip-horizontal"></i></span>
          <input class="form-control" size="100" type="text" name="phone" value="" id="" placeholder="Контактный телефон">
          <span class="error"></span>
        </div>
      </div>
      <div class="form-group col-lg-6">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-envelope"></i></span>
          <input class="form-control" size="100" type="text" name="email" value="" id="" placeholder="E-mail">
          <span class="error"></span>
        </div>
      </div>
      <div class="form-group col-lg-12">
        <div class="input-group">
          <span class="form-icon align-content-start"><i class="fa fa-comment"></i></span>
          <textarea class="form-control" name="comment" cols="100" rows="5" placeholder="Комментарий к заказу"></textarea>
        </div>
      </div>
    </div>
  </div>


  <div class="checkout_order_address divider_top form-default mb-4">
    <div class="checkout_order_address_title checkout_order_sub_title">Адрес доставки</div>
    <div class="row form-fix">
      {* <div class="form-group col-lg-4">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-user"></i></span>
          <input class="form-control" size="100" type="text" name="index" value="" placeholder="Почтовый индекс">
          <span class="error"></span>
        </div>
      </div> *}
      <div class="form-group col-lg-6">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-city"></i></span>
          <input class="form-control" size="100" type="text" name="region" value="" placeholder="Регион/область">
          <span class="error"></span>
        </div>
      </div>
      <div class="form-group col-lg-6">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-building"></i></span>
          <input class="form-control" size="100" type="text" name="city" value="" placeholder="Город">
          <span class="error"></span>
        </div>
      </div>
      <div class="form-group col-lg-6">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-map-marker-alt"></i></span>
          <input class="form-control" size="100" type="text" name="street" value="" placeholder="Улица">
          <span class="error"></span>
        </div>
      </div>
      <div class="form-group col-lg-3">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-home"></i></span>
          <input class="form-control" size="100" type="text" name="building" value="" placeholder="Дом">
          <span class="error"></span>
        </div>
      </div>
      <div class="form-group col-lg-3">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fa fa-street-view"></i></span>
          <input class="form-control" size="100" type="text" name="room" value="" placeholder="Квартира">
          <span class="error"></span>
        </div>
      </div>
    </div>
  </div>

  <div class="checkout_order_summary divider_top">
    <div class="mb-4">
      <span class="checkout_order_summary_title">Сумма заказа:</span>
      <span class="checkout_order_summary_price" id="ms2_order_cost">{$order.cost ?: 0}</span>
      <span class="checkout_order_summary_currency">руб.</span>
    </div>
    <button type="submit" name="ms2_action" value="order/submit" class="btn btn-main btn-lg btn-shadow ms2_link"><span class="fixp">Оформить заказ</span></button>
    <div class="mt-4 small">Нажимая на кнопку «Оформить заказ» вы соглашаетесь с <a href="{47 | url}" target="_blank">политикой конфиденциальности</a> компании</div>
  </div>
</form>