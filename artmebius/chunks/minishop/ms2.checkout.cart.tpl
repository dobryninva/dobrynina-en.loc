<div id="msCart" class="checkout_cart cart_full">
  {if !count($products)}
    <div class="alert alert-warning">
      {'ms2_cart_is_empty' | lexicon}{* Ваша корзина пуста *}
    </div>
  {else}
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
                    {$name | filter_item_caption_get : 'msoption'}: {$option}
                  {/if}
                {/foreach}
              </div>
            {/if}
          </div>
          <div class="cart_item_qty qty-field">
            <form method="post" class="ms2_form d-flex ml-auto" role="form">
              <div class="cart_item_count count_wrap">
                <button class="btn btn-outline btn-h-cyan count_btn count_minus" type="button"><i class="fal fa-minus"></i></button>{* data-dir="minus" *}
                <input type="text" name="count" {* id="product_price" *} class="form-control count_input" value="{$product.count}"/>
                <button class="btn btn-outline btn-h-cyan count_btn count_plus" type="button"><i class="fal fa-plus"></i></button>{* data-dir="plus" *}
              </div>
              <input type="hidden" name="key" value="{$product.key}"/>
              <button class="d-none" type="submit" name="ms2_action" value="cart/change">&#8635;</button>
            </form>
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
          <div class="cart_item_remove">
            <form method="post" class="ms2_form">
              <input type="hidden" name="key" value="{$product.key}">
              <button class="cart_item_remove_btn btn btn-main btn-h-red btn-shadow-" type="submit" name="ms2_action" value="cart/remove" title="Удалить">
                <span class="fixp"><i class="fal fa-trash"></i></span>
              </button>
            </form>
          </div>
        </div>
      {/foreach}
    </div>
    <div class="cart_full_summary">
      <div class="cart_full_summary_item">
        <span class="cart_full_summary_title">Итого:</span>
        <span class="cart_full_summary_price total_price"><span class="ms2_total_cost cart_full_summary_price_value">{$total.cost}</span> руб.</span>
      </div>
    </div>
    {* <div class="row">
      <div class="col">
        <form method="post">
          <button type="submit" name="ms2_action" value="cart/clean" class="btn btn-small btn-light">
            <i class="fa fa-trash-alt"></i> Очистить корзину
          </button>
        </form>
      </div>
    </div> *}
  {/if}
</div>