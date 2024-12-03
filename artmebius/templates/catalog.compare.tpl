{extends 'template:base'}

{block 'vars'}
  {parent}
  {set $show_sidebar = 0}
  {'ms_options_get' | snippet : ['format'=>'compare', 'exclude'=>'label']}
  {set $msoptions_json = 'msoption.options' | placeholder}
  {set $fields_default = '"data.price","data.article","vendor.name"'}
  {if $msoptions_json}
    {set $fields_default = $fields_default ~ ',' ~ $msoptions_json}
  {/if}
  {set $fields_cfg = '{"default":[' ~ $fields_default ~ ']}'}
{/block}

{block 'page'}
<div id="page" class="page-inner page-compare{$page_class}">
{/block}

{block 'main'}
  <main class="catalog{$content_class ?: ' catalog_main'}">
    <div id="catalog_compare" class="content catalog_compare">

      <h1 class="page-header">{$pagetitle}</h1>

      {'!CompareListExt' | snippet : [
        'list_id'   => 19,
        'tplOuter'  => 'comparison.table.outer',
        'tplCorner' => 'comparison.table.corner',
        'tplHead'   => 'comparison.table.head',
        'tplRow'    => 'comparison.table.row',
        'tplParam'  => 'comparison.table.param',
        'tplCell'   => 'comparison.table.cell',
        'fields'    => $fields_cfg,
        'leftJoin'  => '{
          "preview": {
            "class": "msProductFile",
            "on": "`preview`.`product_id` = `msProduct`.`id` AND `preview`.`rank` = 0"
          }
        }',
        'select' => '{
          "preview" : "`preview`.`url` as `preview`"
        }'
      ]}

      {if ($content != '')}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}

    </div>
  </main>
{/block}

{block 'js'}{/block}