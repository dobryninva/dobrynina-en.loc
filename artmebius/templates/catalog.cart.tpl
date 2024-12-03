{extends 'template:base'}

{block 'wrap'}
<div id="wrap" class="page_inner page_cart{$page_class}">
{/block}

{block 'main'}
<main class="catalog_main cart">
  <div id="shop_cart" class="content shop_cart">

    <h1 class="page-header">{$pagetitle}</h1>

    {'!Shopkeeper3@cart_full' | snippet}

    {if $content}
      <div class="page-desc">{$content | imageSlim}</div>
    {/if}

  </div>
</main>
{/block}

{block 'js'}{/block}