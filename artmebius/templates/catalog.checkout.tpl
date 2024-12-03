{extends 'template:base'}

{block 'vars'}
  {parent}
  {set $show_sidebar = 0}
{/block}

{block 'page'}
<div id="page" class="page-inner page-checkout{$page_class}">
{/block}

{block 'main'}
  <main class="catalog_main">
    <div id="checkout" class="content checkout">

      {if $.get.msorder}
          <h1 class="page-header">Спасибо за заказ!</h1>
      {else}
          <h1 class="page-header">{$h1 ?: $pagetitle}</h1>
      {/if}

      {'!msCart' | snippet : [
        'tpl' => 'ms2.checkout.cart'
      ]}

      {'!msOrder' | snippet : [
        'tpl' => 'ms2.checkout.order'
      ]}

      {'!msGetOrder' | snippet : [
        'tpl' => 'ms2.checkout.order.thanks'
      ]}

      {if $content}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}
  {set $script}
  <script>
  (function(){
    if (typeof miniShop2 !== "undefined") {

      //getcost
      // miniShop2.Callbacks.Order.getcost
      miniShop2.Callbacks.add('Order.add.response.success', 'order_cost', function(response) {
          // miniShop2.Message.success('Всё хорошо!');
          // console.log(response);
          // miniShop2.Order.getcost
      });

      // Показать \ Скрыть блок с адресом
      miniShop2.Callbacks.add("Order.getrequired.response.success", "getRequired", function (response) {
        // console.log(response);
        if (
          typeof response !== 'undefined'
          && response.success
          && typeof response.data !== 'undefined'
          && typeof response.data.requires !== 'undefined'
        ) {

          let requires = response.data.requires;

          if (requires.indexOf('region') >= 0 || requires.indexOf('city') >= 0) {
            $('.checkout_order_address').fadeIn();
          } else {
            $('.checkout_order_address').hide();
          }
        }
      });

      // miniShop2.Callbacks.add("Order.getcost.response.success", "getDeliveryPrice", function (response) {
      //   if (
      //     typeof response !== 'undefined'
      //     && response.success
      //     && typeof response.data !== 'undefined'
      //     && typeof response.data.cost !== 'undefined'
      //   ) {
      //     let totalCost = $(miniShop2.Cart.totalCost).text().replace(/ /g, "") * 1;
      //   }
      // });
    }

    //   $("#check_phone").mask("+7(999)999-99-99",{ placeholder:'_'});
  })()
  </script>
  {/set}
  {$script | jsToBottom : true}
{/block}