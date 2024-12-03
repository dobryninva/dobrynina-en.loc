{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 1} *}
  {* ########### gallery ########### *}
  {set $images_html = 'ms2GalleryExt' | snippet : [
		'frontend_css' => '',
		'frontend_js'  => '',
		'tpl'          => 'gallery.grid',
		'gallery_ar'   => 'auto',
		'row_class'    => $images_row_class
	]}
	{set $empty_page = ($images_html != '') ? 0 : 1}
{/block}

{block 'widgets_after_main'}
	{if $images_html?}
		<div class="page__gallery">
			{$images_html}
		</div>
	{/if}
{/block}