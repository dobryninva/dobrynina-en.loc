{set $rid = $_modx->resource.id}
{set $link = ($linkToImage == 1) ? $image_absolute : $_modx->makeUrl($rid,'',[$imageGetParam=>$id, $albumRequestVar=>$album, $tagRequestVar=>$tag])}
{set $watermark = 'photo_image_wm' | option}
{set $full_image_params = '&w=1280&h=1280&zc=0&far=0'}
{set $full_image_params_wm = $full_image_params~$watermark}
{set $name = ($name | ematch : '/\S+(?:jpg|jpeg|png)$/i' ? '' : $name)}
{set $thumbnail_zc = $alt_zc ?: $thumbnail_zc}
{set $thumb_image_params = '&w='~$thumbnail_w~'&h='~$thumbnail_h~'&zc='~$thumbnail_zc~'&far='~$thumbnail_far~'&q='~$thumbnail_q~'&bg=ffffff'}
{set $lazy_attr = $lazy ? 'loading="lazy"' : ''}
<a class="album_item_preview_link lightbox" href="{$link | phpthumbon : $full_image_params_wm}" title="{$name | clean : 'qq'}" data-fancybox="album" data-caption="{$name | clean : 'qq'}">
  <img class="album_item_img {$imgCls}" src="{$link | phpthumbon : $thumb_image_params}" alt="{$name | clean : 'qq'}" width="{$thumbnail_w}" height="{$thumbnail_h}" {$lazy_attr} />
</a>