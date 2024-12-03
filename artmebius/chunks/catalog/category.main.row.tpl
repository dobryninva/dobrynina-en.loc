{set $image_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1&bg=ffffff&q=90'}
{set $noimage_params = '&w='~$preview_width~'&h='~$preview_height~'&zc=0&far=1'}
{if $_pls['tv.image_category']}
  {set $isSVG = ('.svg' in string $_pls['tv.image_category']) ? 1 : 0}
  {set $image = ($isSVG) ? $_pls['tv.image_category'] : ($_pls['tv.image_category'] | phpthumbon : $image_params)}
{else}
  {set $image = $_pls['tv.image_category'] | phpthumbon : $noimage_params}
{/if}
<div class="categories-grid__col grid_col col-auto">
  <div class="categories-grid-item categories-grid__item">
    <a class="categories-grid-item__link" href="{$link}" title="{$pagetitle | clean : 'qq'}" {$link_attributes}>
      <span class="categories-grid-item__img-wrap">
        <img class="categories-grid-item__img" src="{$image}" width="{$preview_width}" height="{$preview_height}" alt="{$pagetitle | clean : 'qq'}" loading="lazy">
      </span>
      <span class="categories-grid-item__link-text">{$menutitle ?: $pagetitle}</span>
    </a>
  </div>
</div>