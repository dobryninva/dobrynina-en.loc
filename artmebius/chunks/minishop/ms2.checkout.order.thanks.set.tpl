<p>Ваш заказ успешно оформлен! Письмо с подробностями заказа было отправлено на указанный Вами e-mail.</p>

<div id="msCart" class="checkout_cart cart_full cart_thanks">
  {if count($products)}
    <div class="cart_full_items">

      {foreach $products as $product}

        {set $is_master = $is_slave = 0}
        {set $not_master = $not_slave = 1}
        {set $prod_class_sfx = ''}
        {* get main modification *}
        {set $modification = []}
        {if $product.options and $product.options.modification?}
          {set $modification = $_modx->runSnippet('!msOptionsPrice.modification',[
            'product'       => $product.id,
            'includeThumbs' => 'small',
            'where'         => json_encode(['msopModification.id' => $product.options.modification]),
            'return'        => 'data'
          ])}
          {set $modification = $modification[0]}
        {/if}

        {*$modification|print_r*}
        {if $modification['small']?}
          {set $product.thumb = $modification['small']}
          {set $product.old_price = $modification['old_price']}
        {/if}

        {* get all modification *}
        {if $product.options and $product.options.modifications?}
          {set $modifications = $_modx->runSnippet('!msOptionsPrice.modification',[
            'product'       => $product.id,
            'type'          => '1,2,3',
            'sortby'        => 'type',
            'includeThumbs' => 'small',
            'where'         => json_encode(['msopModification.id:IN' => $product.options.modifications]),
            'return'        => 'data'
          ])}
        {/if}

        {if (($product['option.mssetincart']['option_slave'] | count) > 0 || ($product['option.mssetincart']['cart_slave'] | count) > 0)}
          {set $prod_class_sfx = ' cart_item_master'}
          {set $is_master = 1}
          {set $not_master = 0}
        {/if}
        {if $product['option.mssetincart']['master_key']}
          {set $prod_class_sfx = ' cart_item_slave'}
          {set $is_slave = 1}
          {set $not_slave = 0}
        {/if}

        <div class="cart_full_item cart_item {$prod_class_sfx}" id="{$product.key}" mssetincart-master="{$product['option.mssetincart']['master_key']}">

          <div class="cart_item_image">
            {set $image_link_tag = ($not_slave) ? 'a' : 'div'}
            {set $image_link_href = ($not_slave) ? ' href="'~($product.id | url)~'"' : ''}
            {set $image_params = ($not_slave) ? '&w=150&h=150&far=1&zc=0&bg=ffffff' : '&w=150&h=38&far=1&zc=0&bg=ffffff'}
            <{$image_link_tag} {$image_link_href} class="cart_item_image_link">
              <img src="{$product.image | phpthumbon : $image_params}" alt="">
            </{$image_link_tag}>
          </div>

          <div class="cart_item_info">
            <div class="cart_item_title">
              {if $product.id?}
                {if $not_slave}
                  <a href="{$product.id | url}">{$product.pagetitle}</a>
                {else}
                  {$product.pagetitle}
                {/if}
              {else}
                {$product.pagetitle}
              {/if}
            </div>
            {if $product.options}
              <div class="cart_item_options">
                {foreach $product.options as $key => $option}
                  {set $tmp = $key|preg_replace : '#\_.*#' : ''}
                  {if $tmp in ['modification','modifications','mssetincart','msal']}{continue}{/if}
                  {set $caption = $product[$key ~ '.caption']}
                  {set $caption = $caption ? $caption : ('ms2_product_' ~ $key) | lexicon}
                  <div class="cart_item_option">
                    {if $option is array}
                      <span class="cart_item_option_title">{$caption}:</span> <span class="cart_item_option_value">{$option | join : '; '}</span>
                    {else}
                      <span class="cart_item_option_title">{$caption}:</span> <span class="cart_item_option_value">{$option}</span>
                    {/if}
                  </div>
                {/foreach}
                {if $product.options.mssetincart}
                  {$_modx->getChunk('tpl.msSetInCart.info', $product.options.mssetincart)}
                {/if}
              </div>
            {/if}
            {if $modification}
              <div class="cart_item_ean"><span class="cart_item_ean_title">артикул:</span> <span class="cart_item_ean_value">{$modification['article']}</span>{* article *}</div>
            {/if}
            {if $colors?}
              {foreach $colors as $row index=$index}
                {if $row.pattern?}
                  <div>
                    <img alt="" title="{$row.value}" class="img-rounded"
                       style="background-image:url({$row.pattern});width:25px;height:25px;">
                  </div>
                {else}
                  <div>
                    <img alt="" title="{$row.value}" class="img-rounded"
                       style="background-color:#{$row.color};width:25px;height:25px;">
                  </div>
                {/if}
                {$row.value}
              {/foreach}
            {/if}

          </div>

          <div class="cart_item_qty qty-field">
            {$product.count} шт.
          </div>

          <div class="cart_item_prices">
            <div class="cart_item_price{($product.old_price) ? ' price_with_discount' : ''}">
              <span class="cart_item_price_value">{$product.price}</span> <span class="cart_item_price_currency">руб.</span>
            </div>
            {if ($product.old_price && $not_slave)}
              <div class="cart_item_price_old"><span class="cart_item_price_old_value">{$product.old_price}</span> <span class="cart_item_price_old_currency">руб.</span></div>
            {/if}
          </div>

        </div>
      {/foreach}
    </div>

    <div class="cart_full_summary">
      <div class="cart_full_summary_item">
        <span class="cart_full_summary_title">Сумма заказа:</span>
        <span class="cart_full_summary_price"><span class="cart_full_summary_price_value">{$total.cart_cost}</span> руб.</span>
      </div>
      {if $total.delivery_cost}
      <div class="cart_full_summary_item">
        <span class="cart_full_summary_title">Стоимость доставки:</span>
        <span class="cart_full_summary_price">{$total.delivery_cost ? '<span class="cart_full_summary_price_value">'~$total.delivery_cost~'</span> руб.' : 'Бесплатно'}</span>
      </div>
      {/if}
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
