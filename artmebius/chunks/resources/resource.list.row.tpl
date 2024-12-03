{set $image_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
{set $noimage_params = '&w='~$preview_width~'&h='~$preview_height~'&zc=0&far=1'}
{if $_pls['tv.image']}
  {set $image = $_pls['tv.image'] | phpthumbon : $image_params}
{else}
  {set $image = $_pls['tv.image'] | phpthumbon : $noimage_params}
{/if}
{set $intro = ($show_intro == 1 && $introtext != '') ? $introtext : ($content | notags)}
{set $intro_truncate = ($intro_length != '') ? $intro_length : 200}
{set $title_truncate = ($title_length != '') ? $title_length : 200}
{set $price = $_pls['tv.price']}
<article class="article-lsit-item articles-lsit__item">

  {* {if $show_preview == 1 && $image != ''} *}
  {if $show_preview == 1}
  <div class="article-lsit-item__preview">
    <a class="article-lsit-item__preview-link" href="{$id | url}" {$link_attributes}>
      <span class="article-lsit-item__preview-img-wrap">
        <img class="article-lsit-item__preview-img" src="{$image}" width="{$preview_width}" height="{$preview_height}" alt="{$pagetitle | clean : 'qq'}" loading="lazy">
      </span>
    </a>
  </div>
  {/if}

  <div class="article-lsit-item__info">

    {if $show_date == 1}
    <div class="article-lsit-item__date"><time datetime="{$publishedon | date : 'Y-m-d'}">{$publishedon | date : 'd.m.Y'}</time></div>
    {/if}

    {if $show_title == 1}
    <div class="article-lsit-item__title">
      <a class="article-lsit-item__title-link" href="{$id | url}" {$link_attributes}>
        <span class="article-lsit-item__title-link-text">{($menutitle ?: $pagetitle) | truncate : $title_truncate : '...'}</span>
      </a>
    </div>
    {/if}

    {if $show_intro == 1 && $intro != ''}
    <div class="article-lsit-item__intro">{$intro | truncate : $intro_truncate : '...'}</div>
    {/if}

    {if $price}
    <div class="article-lsit-item__price">
      Цена: <span class="article-lsit-item__price-value">{$price | num_format}</span> <span class="article-lsit-item__price-currency">{'shk3.currency' | option}</span>
    </div>
    {/if}

    {if $show_more == 1}
    <div class="article-lsit-item__more"><a href="{$id | url}" {$link_attributes} class="article-lsit-item__more-link">Подробнее</a></div>
    {/if}

  </div>

</article>