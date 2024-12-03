custom test!
<hr>
[[pdoMenu?
  &parents=`0`
  &level=`0`
  &showHidden=`1`

  &sortby=`menuindex`
  &sortdir=`ASC`

  &tplOuter=`menu_ul`
  &tpl=`menu_li`

  &outerClass=`menu menu_horz`
  &innerClass  =`sub_menu`
  &rowClass=`menu_item`
  &selfClass=`current`
  &parentClass=`parent`
]]
<hr>
{$_modx->runSnippet('pdoMenu', [
    'parents' => 0,
    'level' => 0,
    'showHidden' => 1,
    'sortby' => 'menuindex',
    'sortdir' => 'ASC',
    'tplOuter' => 'menu_ul',
    'tpl' => 'menu_li',
    'outerClass' => 'menu menu_horz',
    'innerClass' => 'sub_menu',
    'rowClass' => 'menu_item',
    'selfClass' => 'current',
    'parentClass' => 'parent'
])}