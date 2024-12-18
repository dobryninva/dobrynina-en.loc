<div class="articles_main">
  {'!pdoResources' | snippet : [
    'select'             => '{"modResource":"id,menuindex,pagetitle,menutitle,link_attributes,class_key,introtext,publishedon"}',
    'parents'            => 5120,
    'depth'              => 0,
    'hideContainers'     => 1,
    'showHidden'         => 1,
    'limit'              => 3,
    'sortby'             => 'RAND()',
    'sortdir'            => 'ASC',
    'includeTVs'         => 'image,price',
    'processTVs'         => 0,
    'useWeblinkUrl'      => 1,
    'tplWrapper'         => 'materials_gridWrapper',
    'tpl'                => 'materials_gridRow',
    'frontend_css'       => '',
    'show_title'         => 1,
    'show_date'          => 0,
    'show_preview'       => 1,
    'show_intro'         => 0,
    'show_more'          => 0,
    'items_per_row_xl'   => 3,
    'items_per_row_lg'   => 3,
    'items_per_row_md'   => 3,
    'items_per_row_sm'   => 2,
    'items_per_row_xs'   => 1,
    'grid_size'          => 12,
    'preview_width'      => 344,
    'preview_height'     => 258,
    'preview_zc'         => 1,
  ]}
</div>