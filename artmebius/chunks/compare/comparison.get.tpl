<div class="hdr__compare comparison comparison-{$list}{$added == 1 ? ' added' : ''}{$can_compare == 1 ? ' can_compare' : ''}">
  {set $compare_count_display = ($count_current > 0) ? 'block' : 'none'}
  <a class="hdr__compare-link comparison-go" href="{$link}" title="Сравнить">
    <span class="hdr__compare-icon compare_icon fal fa-clone"></span>
    <span class="hdr__compare-count comparison-total">{$count}</span>
  </a>
</div>
<!--comparison_can_compare  can_compare-->
<!--comparison_added  added-->