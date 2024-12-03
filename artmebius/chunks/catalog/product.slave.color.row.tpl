{* image *}
{if $colors}
  {set $color_image = 'get_image_color' | snippet : ['color_search' => $colors.0]}
  {if $color_image}
    {set $color_src = '/images/' ~ $color_image}
    {set $color_image_resized = $color_src | phpthumbon : '&w=30&h=30&zc=1&far=1'}
  {/if}
{/if}
{set $link_tag = ($id == $_modx->resource.id) ? 'span' : 'a'}
{set $link_href = ($id == $_modx->resource.id) ? '' : 'href="'~($id | url)~'"'}
{set $link_class = ($id == $_modx->resource.id) ? 'active' : 'inactive'}
{* tpl *}
<div class="prds_slave">
  <div class="prds_slave_color">
    <{$link_tag} {$link_href} {$link_attributes} class="ms2_product_link prds_slave_color_link {$link_class}" title="{($colors.0 ?: $pagetitle) | clean : 'qq'}"  data-placement="top" data-trigger="manual">
      {if $color_image_resized}
      <span class="prds_slave_color_link_image">
        <img class="prds_slave_img" src="{$color_image_resized}" width="30" height="30" alt="{($colors.0 ?: $pagetitle) | clean : 'qq'}" />
      </span>
      {else}
      <span class="prds_slave_color_link_text">{$colors.0}</span>
      {/if}
    </{$link_tag}>
  </div>
</div>