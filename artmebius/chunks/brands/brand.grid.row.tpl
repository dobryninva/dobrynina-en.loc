{set $link_tag = $resource ? 'a' : 'div'}
{set $link_href = $resource ? 'href="'~($resource | url)~'"' : ''}
{set $logo_thumb_params = 'w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
{set $brand_class_sfx = $logo ? ' brands-grid-item_logo_y' : ' brands-grid-item_logo_n'}
<div class="brands-grid__col grid_col col-auto">
  <div class="brands-grid-item brands-grid__item{$brand_class_sfx}">
    <{$link_tag} {$link_href} class="brands-grid-item__link" title="{$name | clean : 'qq'}">
      {if $logo}
        <img class="brands-grid-item__img" src="{$logo | phpthumbon : $logo_thumb_params}" width="{$preview_width}" height="{$preview_height}" alt="{$name | clean : 'qq'}" loading="lazy">
      {else}
        <div class="brands-grid-item__title">{$name}</div>
      {/if}
    </{$link_tag}>
  </div>
</div>