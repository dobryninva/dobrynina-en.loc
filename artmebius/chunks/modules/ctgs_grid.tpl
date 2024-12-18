{'pdoResources' | snippet: [
  'select'           => '{"modResource":"id,pagetitle,menutitle,link_attributes,class_key"}',
  'parents'          => $id,
  'depth'            => 0,
  'hideContainers'   => 0,
  'showHidden'       => 1,
  'limit'            => 0,
  'where'            => ['template:IN' =>  [9,15]],
  'sortby'           => 'menuindex',
  'sortdir'          => 'ASC',
  'includeTVs'       => 'image',
  'useWeblinkUrl'    => 1,
  'tplWrapper'       => 'ctgsCatalog_gridWrapper',
  'tpl'              => 'ctgsCatalog_gridRow',
  'frontend_css'     => '',
  'items_per_row_xl' => 'ctgs_per_row_xl' | option,
  'items_per_row_lg' => 'ctgs_per_row_lg' | option,
  'items_per_row_md' => 'ctgs_per_row_md' | option,
  'items_per_row_sm' => 'ctgs_per_row_sm' | option,
  'items_per_row_xs' => 'ctgs_per_row_xs' | option,
  'grid_size'        => 12,
  'preview_width'    => 'ctgs_preview_width' | option,
  'preview_height'   => 'ctgs_preview_height' | option,
  'preview_zc'       => 'ctgs_preview_zc' | option,
  'ctgs_sfx'         => $ctgs_sfx
]}