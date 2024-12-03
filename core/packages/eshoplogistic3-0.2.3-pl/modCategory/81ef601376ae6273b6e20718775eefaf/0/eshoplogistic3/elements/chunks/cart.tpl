<form class="ms2_form" id="msOrder" method="post">
    <div class="row">
        <div class="col-9">

            {* получатель *}
            <div class="row">
                <div class="col-12">
                    <p class="h5">{'ms2_frontend_credentials' | lexicon}:</p>
                    {foreach ['email','receiver','phone'] as $field}
                        <div class="form-floating d-inline-block">
                            <input type="text" id="{$field}" placeholder="{('ms2_frontend_' ~ $field) | lexicon}"
                                   name="{$field}" value="{$form[$field]}"
                                   class="form-control{($field in list $errors) ? ' error' : ''}">
                            <label for="{$field}">
                                {('ms2_frontend_' ~ $field) | lexicon} <span class="required-star">*</span>
                            </label>
                        </div>
                    {/foreach}

                    {*<div class="form-floating">
                        <textarea name="comment" id="comment" placeholder="{'ms2_frontend_comment' | lexicon}"
                                  class="form-control{('comment' in list $errors) ? ' error' : ''}">{$form.comment}</textarea>
                        <label for="comment">
                            {'ms2_frontend_comment' | lexicon} <span class="required-star">*</span>
                        </label>
                    </div>*}
                </div>
            </div>

            <hr>

            {* адрес *}
            <div class="row">
                <div class="col-12">
                    <p class="h5">{'ms2_frontend_address' | lexicon}:</p>
                    {foreach ['region','city', 'street', 'building', 'room'] as $field}
                        <div class="form-floating d-inline-block">
                            <input type="text" id="{$field}" placeholder="{('ms2_frontend_' ~ $field) | lexicon}"
                                   name="{$field}" value="{$form[$field]}"
                                   class="form-control{($field in list $errors) ? ' error' : ''}">
                            <label for="{$field}">
                                {('ms2_frontend_' ~ $field) | lexicon} <span class="required-star">*</span>
                            </label>
                        </div>
                    {/foreach}

                    {*<div class="form-group row input-parent">
                        <label class="col-md-4 col-form-label" for="text_address">
                            {'ms2_frontend_text_address' | lexicon} <span class="required-star">*</span>
                        </label>
                        <div class="col-md-8">
                                <textarea name="text_address" id="text_address" placeholder="{'ms2_frontend_text_address' | lexicon}"
                                          class="form-control{('text_address' in list $errors) ? ' error' : ''}">{$form.text_address}</textarea>
                        </div>
                    </div>*}
                </div>
            </div>

            <hr>

            {* способы оплаты *}
            <div class="row">
                <div class="col-12" id="payments">
                    <p class="h5">{'ms2_frontend_payments' | lexicon}:</p>
                    {foreach $payments as $payment index=$index}
                        {var $checked = !($order.payment in keys $payments) && $index == 0 || $payment.id == $order.payment}
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input"  name="payment" value="{$payment.id}" id="payment_{$payment.id}"{$checked ? 'checked' : ''}>
                            <label class="form-check-label" for="payment_{$payment.id}">{$payment.name}</label>
                            {*if $payment.logo?}
                                <img src="{$payment.logo}" alt="{$payment.name}" title="{$payment.name}" class="mw-100"/>
                            {else}
                                {$payment.name}
                            {/if}
                            {if $payment.description?}
                                <p class="small">{$payment.description}</p>
                            {/if*}
                        </div>
                    {/foreach}
                </div>
            </div>

            <hr>

            {* способы доставки *}
            <div class="row">
                <div class="col-12 mb-5" id="deliveries">
                    <p class="h5">{'ms2_frontend_deliveries' | lexicon}:</p>
                    {foreach $deliveries as $delivery index=$index}
                        {var $checked = !($order.delivery in keys $deliveries) && $index == 0 || $delivery.id == $order.delivery}
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="delivery" value="{$delivery.id}" id="delivery_{$delivery.id}"
                                   data-payments="{$delivery.payments | json_encode}"
                                    {$checked ? 'checked' : ''}>
                            <label class="form-check-label" for="delivery_{$delivery.id}">{$delivery.name}</label>
                            {*if $delivery.logo?}
                                        <img src="{$delivery.logo}" alt="{$delivery.name}" title="{$delivery.name}"/>
                                    {else}
                                        {$delivery.name}
                                    {/if}
                                    {if $delivery.description?}
                                        <p class="small">
                                            {$delivery.description}
                                        </p>
                                    {/if*}
                        </div>
                    {/foreach}
                </div>
            </div>

            {'!eshoplogistic3Order' | snippet}

        </div>
        <div class="col-3">
            <div class="cart-data">
                <p class="h4">Корзина</p>
                <p>Стоимость товаров: <span id="ms2_order_cart_cost">{$order.cart_cost ?: 0}</span> {'ms2_frontend_currency' | lexicon}</p>
                <p>Стоимость доставки: <span id="ms2_order_delivery_cost">{$order.delivery_cost ?: 0}</span> {'ms2_frontend_currency' | lexicon}</p>

                <div id="eShopLogistic3Info"></div>

                <p class="mt-3">Итого: <strong><span id="ms2_order_cost">{$order.cost ?: 0}</span> {'ms2_frontend_currency' | lexicon}</strong></p>
                <hr>
                <div class="text-center">
                    <button type="submit" name="ms2_action" value="order/submit" class="btn btn-lg btn-primary ml-md-2 ms2_link">
                        Отправить заказ
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>