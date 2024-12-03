{if 'standard' | mobiledetect}
  {set $breadcrumbs_params = [
    'showHome'        => 1,
    'showCurrent'     => 1,
    'hideSingle'      => 0,
    'tpl'             => 'breadcrumbs.row',
    'tplWrapper'      => 'breadcrumbs.wrapper',
    'tplCurrent'      => 'breadcrumbs.row.current',
    'outputSeparator' => '<li class="breadcrumbs__item breadcrumbs__item_sepapator">-</li>',
  ]}
{/if}
{if 'tablet' | mobiledetect}
  {set $breadcrumbs_params = [
    'showHome'        => 1,
    'showCurrent'     => 1,
    'hideSingle'      => 0,
    'tpl'             => 'breadcrumbs.row',
    'tplWrapper'      => 'breadcrumbs.wrapper',
    'tplCurrent'      => 'breadcrumbs.row.current',
    'outputSeparator' => '<li class="breadcrumbs__item breadcrumbs__item_sepapator">-</li>',
  ]}
{/if}
{if 'mobile' | mobiledetect}
  {set $breadcrumbs_params = [
    'showHome'        => 0,
    'showCurrent'     => 1,
    'hideSingle'      => 0,
    'from'            => $parent,
    'tpl'             => 'breadcrumbs.row',
    'tplWrapper'      => 'breadcrumbs.wrapper',
    'tplCurrent'      => 'breadcrumbs.row.current',
    'outputSeparator' => '<li class="breadcrumbs__item breadcrumbs__item_sepapator">-</li>',
  ]}
{/if}
{'!pdoCrumbs' | snippet : $breadcrumbs_params}
{*
  'outputSeparator' => '<li class="breadcrumbs__item breadcrumbs__item_sepapator"><span class="fal fa-angle-right"></span></li>',
  'exclude'         => 7,
  'showCurrent'     => 0,
  'tplHome'         => 'breadcrumbs.home',
*}