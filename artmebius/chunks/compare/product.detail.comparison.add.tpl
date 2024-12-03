<div class="product-detail__compare compare-item comparison comparison-{$list}{$added == 1 ? ' added' : ''}{$can_compare == 1 ? ' can_compare' : ''}" data-id="{$id}" data-list="{$list}">
  <a href="#!" class="product-detail__compare-link comparison-link comparison-add">
    <i class="product-detail__compare-icon compare_icon fal fa-clone"></i>
    <span class="product-detail__compare-text">{'comparison_add_to_list' | lexicon}</span>
  </a>
  <a href="#!" class="product-detail__compare-link comparison-link comparison-remove">
    <i class="product-detail__compare-icon compare_icon fa fa-clone"></i>
    <span class="product-detail__compare-text">{'comparison_remove_from_list' | lexicon}</span>
  </a>
  <a href="{$link}" class="product-detail__compare-go comparison-go">({'comparison_go_to_list' | lexicon})</a>
</div>
