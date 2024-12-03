{$_modx->lexicon->load('minishop2:product')}
<div id="msCart" class="checkout_cart cart_full">
  {if !count($products)}
    <div class="alert alert-warning">
      {'ms2_cart_is_empty' | lexicon}{* Ваша корзина пуста *}
    </div>
  {else}
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

        {* get product colors *}
        {* {if $product.options?}
          {set $colors = $_modx->runSnippet('!msOptionsColor',[
            'product'    => $product.id,
            'byOptions'  => json_encode($product.options),
            'return'     => 'data'
          ])}
        {/if} *}

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

        {* <div class="test">
          {$product['option.mssetincart']|print}
          {$product['option.mssetincart']['option_slave'] | count}
          {$product['option.mssetincart']['cart_slave'] | count}
        </div> *}

        <div class="cart_full_item cart_item {$prod_class_sfx}" id="{$product.key}" mssetincart-master="{$product['option.mssetincart']['master_key']}">

          <div class="cart_item_image">
            {* {if $product.thumb?}
              <img src="{$product.thumb}" alt="{$product.pagetitle}" title="{$product.pagetitle}"/>
            {else}
              <img src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png"
                 srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x"
                 alt="{$product.pagetitle}" title="{$product.pagetitle}"/>
            {/if} *}
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
              {* <a href="{$product.id | url}">{$product.pagetitle}</a> *}
            </div>
            {if $product.options}
              <div class="cart_item_options">

                {foreach $product.options as $key => $option}
                  {set $tmp = $key|preg_replace : '#\_.*#' : ''}
                  {if $tmp in ['modification','modifications','mssetincart','msal']}{continue}{/if}
                  {* <br> *}
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
                  {* <br> *}
                  {$_modx->getChunk('tpl.msSetInCart.info', $product.options.mssetincart)}
                {/if}
                {*
                {foreach $product.options as $name => $option}
                  {if $name | match : 'modification*' != 1}
                    {$name | filter_item_caption_get : 'msoption'}: {$option}
                  {/if}
                {/foreach}
                *}
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
            <form method="post" class="ms2_form d-flex ml-auto" role="form">
              <div class="cart_item_count count_wrap">
                <button class="btn btn-outline btn-h-cyan count_btn count_minus" type="button"><i class="fal fa-minus"></i></button>{* data-dir="minus" *}
                <input type="text" name="count" class="form-control count_input" value="{$product.count}"/>
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
            {if ($product.old_price && $not_slave)}
              <div class="cart_item_price_old"><span class="cart_item_price_old_value">{$product.old_price}</span> <span class="cart_item_price_old_currency">руб.</span></div>
              {* {if $is_slave}
              {else}
              {/if} *}
            {/if}
          </div>

          {* <div class="cart_item_sum"></div> *}
          <div class="cart_item_remove">
            <form method="post" class="ms2_form">
              <input type="hidden" name="key" value="{$product.key}">
              <button class="cart_item_remove_btn btn btn-main btn-h-red btn-shadow-" type="submit" name="ms2_action" value="cart/remove" title="Удалить">
                <span class="fixp"><i class="fal fa-times"></i></span>{* trash trash-alt times *}
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