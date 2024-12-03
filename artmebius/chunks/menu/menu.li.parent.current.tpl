<li class="{$classnames} opened current">
  {if $_modx->resource.id != $id}
    <a class="menu__link" href="{$link}" title="{$title | clean : 'qq'}" {$attributes}><span class="menu__link-title">{$menutitle}</span>span class="menu__link-icon"></span></a>
  {else}
    <span class="menu__link"><span class="menu__link-title">{$menutitle}</span>span class="menu__link-icon"></span></span>
  {/if}
  {$wrapper}
</li>