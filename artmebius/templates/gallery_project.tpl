{extends 'template:base'}

{block 'wrap'}
<div id="wrap" class="page_inner page_album{$page_class}">
{/block}

{block 'main'}
  {set $price = $_modx->resource.price}
  {set $album = $_modx->resource.album}
  {set $video_urls = $_modx->resource.video_urls | fromJSON}
  {if $video_urls}
    {set $video_gallery}
      <div class="page-header">Видео галерея</div>
      <div class="items_grid">
        <div class="row tiles_row">
        {foreach $video_urls as $video}
          <div class="tiles_col col-xs-6 col-sm-6 col-md-4 col-lg-4">
            <div class="video_block item_block">
              {set $vid = 'getVID' | snippet : ['url'=>$video.item_url]}
              <div class="item_link_wrap">
                <a href="http://www.youtube.com/embed/{$vid}?rel=0&amp;wmode=transparent" title="{$video.item_title}" class="youtube item_link">
                  <span class="item_preview">
                    <img src="http://img.youtube.com/vi/{$vid}/mqdefault.jpg" alt="{$video.item_title}">
                  </span>
                  <span class="item_title">{$video.item_title}</span>
                </a>
              </div>
            </div>
          </div>
        {/foreach}
        </div>
      </div>
    {/set}
  {/if}
  <main class="gallery {$content_class ?: ' gallery_main'}">
    <div id="gallery_album" class="content gallery_album">

      <div class="sect_pink">
        <div class="sect_abs sect_sm">
          <div class="container">
            <div class="mdl breadcrumbs breadcrumbs_top">
              {'pdoCrumbs' | snippet : [
                'showHome'=>1,
                'outputSeparator'=>'<li class="breadcrumb-item sepapator"><span class="fa fa-angle-right"></span></li>'
              ]}
            </div>
            <h1 class="page-header">{$h1 ?: $pagetitle}</h1>
          </div>
        </div>
      </div>

      <div class="container sect_sm">

        {if $price}
          <div class="project_price">Цена: <span class="price_value">{$price | num_format}</span> <span class="price_currency">руб.</span></div>
        {/if}

        {'Gallery' | snippet : [
          'useCss'        => 0,
          'album'         => $album,
          'thumbWidth'    => $preview_width,
          'thumbHeight'   => $preview_height,
          'thumbZoomCrop' => $preview_zc,
          'thumbQuality'  => 75,
          'linkToImage'   => 1,
          'containerTpl'  => 'gallery_gridWrapper',
          'thumbTpl'      => 'gallery_gridRow',
        ]}

        {$video_gallery}

        {if ($content != '')}
          <div class="page-desc">{$content | imageSlim}</div>
        {/if}
      </div>

    </div>
  </main>
{/block}

{block 'scripts_tpl'}{/block}
{*

0.jpg // 480*360
1.jpg // 120*90
2.jpg // 120*90
3.jpg // 120*90
default.jpg // 120*90
mqdefault.jpg // 320*180
hqdefault.jpg // 480*360
sddefault.jpg // 640*480
maxresdefault.jpg // 1280*720

target="_blank"
onClick="window.open(this.href, '', 'width='+screen.availWidth/2+',height='+screen.availHeight/2+',top='+screen.availHeight/4+',left='+screen.availWidth/4); return false;"

*}