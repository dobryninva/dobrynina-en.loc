{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
  {set $partners_arr = $_modx->resource.partners | fromJSON}
  {if $partners_arr}
    {set $partners_html}
      {foreach $partners_arr as $partner}
        {set $link_tag = $partner.link ? 'a' : 'div'}
        {set $link_href = $partner.link ? 'href="'~$partner.link~'" target="_blank" rel="nofollow"' : ''}
        {set $partners_class_sfx = $partner.logo ? ' with_logo' : ' wo_logo'}
        <div class="col-auto">
          <div data-img="{$partner.logo}" class="partners_item{$partners_class_sfx}">
            <{$link_tag} {$link_href} class="partners_item_link" title="{$partner.name | clean : 'qq'}">
              {if $partner.logo}
                {set $logo = ('/images/' in $partner.logo) ? $partner.logo : '/images/'~$partner.logo}
                <img src="{$logo | phpthumbon : 'w=200&h=100&zc=0&far=1'}" alt="{$partner.name | clean : 'qq'}">
              {else}
                <span class="partners_item_link_text">{$partner.name}</span>
              {/if}
            </{$link_tag}>
          </div>
        </div>
      {/foreach}
    {/set}
  {/if}
{/block}

{block 'page'}
<div id="page" class="page-inner page-partners">
{/block}

{block 'main'}
  <main class="articles{$content_class ?: ' partners_main'}">
    <div id="partners_detail" class="content partners_detail">
      {if $show_title == 1}
        <h1 class="page-header">{$pagetitle}</h1>
      {/if}

      {if $partners_html}
      <!-- noindex -->
        <div class="partners_items row row-cols-sm-2 row-cols-md-3 row-cols-lg-4">
          {$partners_html}
        </div>
      <!-- /noindex -->
      {/if}

      {if $content != ''}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}
    </div>
  </main>
{/block}

{block 'js'}{/block}