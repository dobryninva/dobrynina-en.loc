{if count($files) > 1}
<div class="gallery-grid">
	<div class="gallery-grid__items row{$params.row_class|before:' '}">
	  {foreach $files as $file}
	  	{set $url = ($params.gallery_ar == 'auto') ? (($file.properties.width > $file.properties.height) ? 'landscape' : 'portrait') : $params.gallery_ar}
	  	<div class="gallery-grid__col grid_col col-auto">
	  		<a class="gallery-grid__link gallery-link lightbox ani-fiu" href="{$file.url}" data-fancybox="album" data-caption="{($file.alt ?: $_modx->resource.pagetitle)|clean : 'qq'}">
	  		  <img class="gallery-grid__img gallery-link__img" src="{$file[$url]}" width="{$file.properties.width}" height="{$file.properties.height}" loading="lazy" />
	  		</a>
	  	</div>
	  {/foreach}
	</div>
</div>
{/if}