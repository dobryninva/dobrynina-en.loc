<div class="mdl side_menu">
  {'pdoMenu' | snippet : [
    'select'             => '{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key"}',
    'parents'            => 7,
    'level'              => 0,
    'showHidden'         => 1,
    'sortby'             => 'menuindex',
    'sortdir'            => 'ASC',
    'where'              => '{"template:IN":[9]}',
    'tplOuter'           => 'menu.ul',
    'tpl'                => 'menu.li',
    'tplParentRow'       => 'menu.li.parent',
    'tplParentRowActive' => 'menu.li.parent.active',
    'outerClass'         => 'menu menu_vert menu_accord_mobile',
    'innerClass'         => 'sub_menu',
    'rowClass'           => 'menu_item',
    'selfClass'          => 'current',
    'parentClass'        => 'parent',
    'hereClass'          => 'active'
  ]}
  {*
    'outerClass'         => 'menu menu_accord',
    'outerClass'         => 'menu menu_vert menu_accord_mobile',
    'outerClass'         => 'menu menu_vert menu_toggle',
  *}
</div>