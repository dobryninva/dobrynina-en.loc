{set $rid = $_modx->resource.id}
{set $link = ($linkToImage == 1) ? $image_absolute : $_modx->makeUrl($rid,'',[$imageGetParam=>$id, $albumRequestVar=>$album, $tagRequestVar=>$tag])}
{set $watermark = 'prdt_image_wm' | option}
{set $full_image_params = '&w=800&h=600&zc=0&far=0'}
{set $full_image_params_wm = $full_image_params~$watermark}
{set $thumbnail_zc = $alt_zc ?: $thumbnail_zc}
{set $thumb_image_params = '&w='~$thumbnail_w~'&h='~$thumbnail_h~'&zc='~$thumbnail_zc~'&far='~$thumbnail_far~'&q='~$thumbnail_q~'&bg=ffffff'}
{set $name = ($name | ematch : '/\S+(?:jpg|jpeg|png)$/i' ? '' : $name)}
{set $lazy_attr = $lazy ? 'loading="lazy"' : ''}
{set $lightbox_class = $ajax_album ? 'ajaxbox' : 'lightbox'}
<div class="tiles_col col-auto">
  <div class="album_item {$cls}">
    <div class="album_item_preview">
      <a class="album_item_preview_link {$lightbox_class}" href="{$link | phpthumbon : $full_image_params_wm}" title="{$name}" data-fancybox="album" data-caption="{$name}">
        <img class="album_item_img {$imgCls}" src="{$link | phpthumbon : $thumb_image_params}" alt="{$name}" width="{$thumbnail_w}" height="{$thumbnail_h}" {$lazy_attr} />
      </a>
    </div>
  </div>
</div>
{*
{$thumbnail} or {$link | phpthumbon : $thumb_image_params}
*}