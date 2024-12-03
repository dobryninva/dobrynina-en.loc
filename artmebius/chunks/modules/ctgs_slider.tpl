{if $parents_id == 7}
  {set $slider_params = [
    'select'         => '{"modResource":"id,template,menuindex,pagetitle,menutitle,link_attributes,class_key"}',
    'resources'      =>'-'~$id,
    'parents'        => $parents_id,
    'depth'          => 0,
    'hideContainers' => 0,
    'showHidden'     => 1,
    'where'          => ['template:IN' => [9]],
    'sortby'         => 'menuindex',
    'sortdir'        => 'ASC',
    'includeTVs'     => 'image',
    'useWeblinkUrl'  => 1,
    'tplWrapper'     => '@INLINE <div class="catalog_sub_ctgs ctgs_slider slider_before_multi">{$output}</div>',
    'tpl'            => 'ctgsCatalog_sliderRow',
    'frontend_css'   => '',
    'preview_width'  => 160,
    'preview_height' => 160,
    'preview_zc'     => 1,
  ]}
{else}
  {set $slider_params = [
    'select'         => '{"modResource":"id,template,menuindex,pagetitle,menutitle,link_attributes,class_key"}',
    'resources'      =>'-'~$id,
    'parents'        => $parents_id,
    'depth'          => 0,
    'hideContainers' => 0,
    'showHidden'     => 1,
    'where'          => ['template:IN' => [9]],
    'sortby'         => 'menuindex',
    'sortdir'        => 'ASC',
    'includeTVs'     => 'image',
    'useWeblinkUrl'  => 1,
    'tplWrapper'     => '@INLINE <div class="catalog_sub_ctgs ctgs_slider slider_before_multi">{$output}</div>',
    'tpl'            => 'ctgsCatalog_sliderRow',
    'frontend_css'   => '',
    'preview_width'  => 100,
    'preview_height' => 75,
    'preview_zc'     => 0,
  ]}
{/if}
{'pdoResources' | snippet : $slider_params}