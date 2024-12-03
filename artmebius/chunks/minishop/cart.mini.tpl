<div id="msMiniCart" class="hdr__cart-mini cart-mini{$total_count > 0 ? ' cart-mini_full' : ' cart-mini_empty'}">
  <a class="cart-mini__link" href="{9 | url}">{* 8 - cart, 9 - checkout *}
    <span class="cart-mini__link-icon">
      <i class="fal fa-cart-shopping"></i>
      <span class="cart-mini__link-count ms2_total_count">{$total_count}</span>
    </span>
    <span class="cart-mini__link-info">
      <span class="cart-mini__link-title">Корзина</span>
      <span class="cart-mini__link-price ms2_total_cost">{($total_count > 0) ? $total_cost ~ ' руб.' : 'пусто'}</span>
    </span>
  </a>
</div>