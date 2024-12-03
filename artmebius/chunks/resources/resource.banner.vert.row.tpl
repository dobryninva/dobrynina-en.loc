{set $img_dir = '/images/'}
{set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
{if $image}
  {if $img_dir | in : $_pls['tv.banner_vert']}{* tt *}
    {set $image = $_pls['tv.banner_vert']}
  {else}
    {set $image = $img_dir ~ $_pls['tv.banner_vert']}
  {/if}
{else}
  {set $image = $_pls['tv.banner_vert']}
{/if}
<div class="article_block article_slide">
  <div class="slide_bg bg-cv bg-cc bg-nr" style="background-image: url('{$image | phpthumbon : $img_params}');">
    <div class="item_title_wrap"><span class="item_title">{$pagetitle}</span></div>
    <div class="item_more_wrap"><a href="{$id | url}" {$link_attributes} class="item_more_link btn btn-green btn-h-red c-white">Подробнее</a></div>
  </div>
</div>
{* <div class="slide_bg" data-bglazy="{$image | phpthumbon : $img_params}"> *}