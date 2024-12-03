{'pdoResources' | snippet : [
  'select'         => '{"modResource":"id,pagetitle,menutitle,link_attributes,class_key"}',
  'parents'        => $id,
  'depth'          => 0,
  'hideContainers' => 0,
  'showHidden'     => 1,
  'where'          => ["template:IN" => [9,15]],
  'sortby'         => 'menuindex',
  'sortdir'        => 'ASC',
  'useWeblinkUrl'  => 1,
  'tplWrapper'     => 'ctgsCatalog_listWrapper',
  'tpl'            => 'ctgsCatalog_listRow',
  'frontend_css'   => ''
]}