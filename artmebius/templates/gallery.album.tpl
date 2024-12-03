{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
  {* Gallery *}
  {set $gallery_ar = $_modx->resource.gallery_ar ?: 'auto'}
  {set $images_html = 'ms2GalleryExt' | snippet : [
		'frontend_css' => '',
		'frontend_js'  => '',
		'tpl'          => 'gallery.grid',
		'row_class'    => $images_row_class,
		'gallery_ar'   => $gallery_ar
	]}
  {* videos *}
  {set $videos_arr = $_modx->resource.videos | fromJSON}
{/block}

{block 'page'}
<div class="page page_inner page_gallery">
{/block}

{block 'main'}
  <main class="gallery{$content_class ?: ' gallery_main'}">

    <h1 class="gallery__header page-header">{$pagetitle}</h1>

    {if $images_html?}
    	<div class="gallery__images">
    		{$images_html}
    	</div>
    {/if}

    {if $videos_arr?}
      {if $images_html?}
	    <div class="gallery__header gallery__header_video">Видео</div>
	    {/if}
	    <div class="gallery__videos">
	      <div class="row row-cols-xs-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
	        {foreach $videos_arr as $video}
	          <div class="grid_col col-auto">
	            <div class="videos-grid-item">
	              {set $video_url = 'getVID' | snippet : ['url'=>$video.url]}
	              <a class="videos-grid-item__link lightbox youtube" href="https://www.youtube.com/embed/{$video_url}?rel=0&amp;wmode=transparent" title="{$video.title | clean : 'qq'}">
	                <span class="videos-grid-item__image">
	                  <img class="videos-grid-item__img" src="https://img.youtube.com/vi/{$video_url}/mqdefault.jpg" alt="{$video.title | clean : 'qq'}">
	                  {* default (120x90), mqdefault (320x180), hqdefault (480x360), sddefault (640x480), maxresdefault (1280x720) *}
	                </span>
	                <span class="videos-grid-item__link-text">{$video.title}</span>
	              </a>
	            </div>
	          </div>
	        {/foreach}
	      </div>
	    </div>
	  {/if}

    {if $content != ''}
      <div class="page-desc">{$content | imageSlim}</div>
    {/if}

  </main>
{/block}

{block 'js'}{/block}