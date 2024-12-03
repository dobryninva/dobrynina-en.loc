<div id="msCart" class="checkout_cart cart_full">
  {if count($products)}
    <div class="cart_full_items">
      {foreach $products as $product}
        <div class="cart_full_item cart_item" id="{$product.key}">
          <div class="cart_item_image">
            <a href="{$product.id | url}">
              <img src="{$product.image  | phpthumbon : '&w=150&h=150&far=1&zc=0&bg=ffffff'}" alt="">
            </a>
          </div>
          <div class="cart_item_info">
            <div class="cart_item_title"><a href="{$product.id | url}">{$product.pagetitle}</a></div>
            {if $product.options}
              <div class="cart_item_attr">
                {foreach $product.options as $name => $option}
                  {if $name | match : 'modification*' != 1}
                  {$name | get_field_caption : 'msoption'}: {$option}
                  {/if}
                {/foreach}
              </div>
            {/if}
          </div>
          <div class="cart_item_qty qty-field">
            {$product.count} шт.
          </div>
          <div class="cart_item_prices">
            <div class="cart_item_price{($product.old_price) ? ' price_with_discount' : ''}">
              <span class="cart_item_price_value">{$product.price}</span> <span class="cart_item_price_currency">руб.</span>
            </div>
            {if $product.old_price}
              <div class="cart_item_price_old"><span class="cart_item_price_old_value">{$product.old_price}</span> <span class="cart_item_price_old_currency">руб.</span></div>
            {/if}
          </div>
          {* <div class="cart_item_sum"></div> *}
        </div>
      {/foreach}
    </div>

    <div class="cart_full_summary">
      <div class="cart_full_summary_item">
        <span class="cart_full_summary_title">Сумма заказа:</span>
        <span class="cart_full_summary_price"><span class="cart_full_summary_price_value">{$total.cart_cost}</span> руб.</span>
      </div>
      <div class="cart_full_summary_item">
        <span class="cart_full_summary_title">Стоимость доставки:</span>
        <span class="cart_full_summary_price">{$total.delivery_cost ? '<span class="cart_full_summary_price_value">'~$total.delivery_cost~'</span> руб.' : 'Бесплатно'}</span>
      </div>
      <div class="cart_full_summary_item">
        <span class="cart_full_summary_title">Итого:</span>
        <span class="cart_full_summary_price total_price"><span class="cart_full_summary_price_value">{$total.cost}</span> руб.</span>
      </div>
    </div>

    {if $payment_link}
      <p>{'ms2_payment_link' | lexicon : ['link' => $payment_link]}</p>
    {/if}

  {/if}
</div>
<!--noindex-->
<p><a class="btn btn-main btn-sm" href="{$_modx->resource.id | url}" title="назад"><i class="fal fa-long-arrow-left"></i> Вернуться к списку заказов</a></p>
<!--/noindex-->