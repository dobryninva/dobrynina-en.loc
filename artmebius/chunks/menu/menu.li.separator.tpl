{if $level < 2}
<li class="menu__item menu__item_separator {$classnames}"></li>
{/if}
<li class="{$classnames}">
  {if $_modx->resource.id != $id}
    <a class="menu__link" href="{$link}" title="{$title | clean : 'qq'}" {$attributes}><span class="menu__link-text">{$menutitle}</span></a>
  {else}
    <span class="menu__link"><span class="menu__link-text">{$menutitle}</span></span>
  {/if}
  {$wrapper}
</li>