{set $image_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1&bg=ffffff&q=90'}
{set $noimage_params = '&w='~$preview_width~'&h='~$preview_height~'&zc=0&far=1'}
{if $_pls['tv.image']}
  {set $isSVG = ('.svg' in string $_pls['tv.image']) ? 1 : 0}
  {set $image = ($isSVG) ? $_pls['tv.image'] : ($_pls['tv.image'] | phpthumbon : $image_params)}
{else}
  {set $image = $_pls['tv.image'] | phpthumbon : $noimage_params}
{/if}
{set $intro = ($show_intro == 1 && $introtext != '') ? $introtext : ($content | notags)}
{set $intro_truncate = ($intro_length != '') ? $intro_length : 200}
{set $title_truncate = ($title_length != '') ? $title_length : 200}
{set $price = $_pls['tv.price']}
<div class="articles-grid__col grid_col col-auto">
  <article class="articles-grid-item articles-grid__item">
    {if $show_date == 1}
    <div class="articles-grid-item__date"><time datetime="{$publishedon | date : 'Y-m-d'}">{$publishedon | date : 'd.m.Y'}</time></div>
    {/if}
    {if $show_title == 1}
    <div class="articles-grid-item__title">
      <a class="articles-grid-item__link" href="{$id | url}" {$link_attributes}>
        {if $show_preview == 1}
        <span class="articles-grid-item__img-wrap">
          <img class="articles-grid-item__img" src="{$image}" width="{$preview_width}" height="{$preview_height}" alt="{$pagetitle | clean : 'qq'}" loading="lazy">
        </span>
        {/if}
        <span class="articles-grid-item__link-text">{($menutitle ?: $pagetitle) | truncate : $title_truncate : '...'}</span>
      </a>
    </div>
    {/if}
    {if $show_intro == 1 && $intro != ''}
    <div class="articles-grid-item__intro">{$intro | truncate : $intro_truncate : '...'}</div>
    {/if}
    {if $price}
    <div class="articles-grid-item__price">
      Цена: <span class="articles-grid-item__price-value">{$price | num_format}</span> <span class="articles-grid-item__price-currency">{'cfg_currency' | option}</span>
    </div>
    {/if}
    {if $show_more == 1}
    <div class="articles-grid-item__more"><a href="{$id | url}" {$link_attributes} class="articles-grid-item__more-link">Подробнее</a></div>
    {/if}
  </article>
</div>