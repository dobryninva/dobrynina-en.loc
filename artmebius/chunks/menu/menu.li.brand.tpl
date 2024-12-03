{set $parent_pagetitle = ($parent | resource : 'pagetitle') | clean : 'qq'}
{set $parent_menutitle = ($parent | resource : 'menutitle') | clean : 'qq'}
<li class="{$classnames}">
  <a class="menu__link" href="{$link}" title="{$title | clean : 'qq'}" {$attributes}>
    <span class="menu__link-text">{$parent_menutitle ?: $parent_pagetitle}</span>
  </a>
  {$wrapper}
</li>