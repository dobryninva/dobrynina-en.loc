<div class="search-tip">
  <div class="search-tip__thumb">
    <a class="search-tip__thumb-link" href="{$id | url}" title="{($longtitle ?: $pagetitle) | clean : 'qq'}">
      {* <img src="{$image | phpthumbon : '&w=35&h=35&zc=0&far=1'}" alt="{($menutitle ?: $pagetitle) | clean : 'qq'}"> *}
      <img class="search-tip__thumb-img" src="{$thumb}" {$thumb | img_size : 'attr'}  alt="{($menutitle ?: $pagetitle) | clean : 'qq'}">
    </a>
  </div>
  <div class="search-tip__info">
    <a class="search-tip__link" href="{$id | url}">
      <span class="search-tip__link-text">
        {$menutitle ?: $pagetitle}
      </span>
      <span class="search-tip__prices">
        <span class="search-tip__prices-title">Цена:</span>
        <span class="search-tip__price{($old_price) ? ' search-tip__price_discount' : ''}">
          {if $price?}
          	<span class="search-tip__price-value">{$price}</span>
          	<span class="search-tip__price-currency">руб.</span>
          {else}
          	<span class="search-tip__price-value">по запросу</span>
          {/if}
        </span>
        {if $old_price?}
          <span class="search-tip__price-old">
          	<span class="search-tip__price-old-value">{$old_price}</span>
          	<span class="search-tip__price-old-currency">руб.</span>
          </span>
        {/if}
      </span>
    </a>
  </div>
</div>