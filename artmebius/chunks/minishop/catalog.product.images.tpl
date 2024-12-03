{* vars *}
{set $pagetitle = $_modx->resource.pagetitle}
{set $prdt_image_width = 'prdt_image_width' | option}
{set $prdt_image_height = 'prdt_image_height' | option}
{set $prdt_image_zc = 'prdt_image_zc' | option}
{set $watermark = 'prdt_image_wm' | option}
{set $prdt_imgs_full_params = '&w='~$prdt_image_width~'&h='~$prdt_image_height~'&zc='~$prdt_image_zc~'&far=1'}
{set $prdt_imgs_full_params_wm = $prdt_imgs_full_params~$watermark}
{set $prdt_thumb_width = 'prdt_thumb_width' | option}
{set $prdt_thumb_height = 'prdt_thumb_height' | option}
{set $prdt_thumb_zc = 'prdt_thumb_zc' | option}
{set $prdt_imgs_thumb_params = '&w='~$prdt_thumb_width~'&h='~$prdt_thumb_height~'&zc='~$prdt_thumb_zc~'&far=1'}
<div {* id="msGallery" *} class="msoptionsprice-gallery">
{* {$files|print} *}
{if $files}
  <div class="product-detail__images-full{if count($files) > 1} prdt_imgs_full_slider slider_before{/if}">{* fotorama *}
    {foreach $files as $file}
      {* {set $caption = ($file['name'] == $file['file']) ? $pagetitle : $file['name']} *}
      {set $caption = $pagetitle}
      <div class="product-detail__images-full-slide">
        <a  class="product-detail__images-full-link lightbox "{* fotorama__img *}
            href="{($watermark) ? ($file['url'] | phpthumbon : $watermark) : $file['url']}"
            title="{$pagetitle | clean : 'qq'}"
            data-rid="{$file['product_id']}" data-iid="{$file['id']}"
            data-fancybox="prod"
            data-caption="{$caption | clean : 'qq'}">
          {* <img class="product-detail__images-full-img" src="{$file['url'] | phpthumbon : $prdt_imgs_full_params_wm}" alt="{$pagetitle | clean : 'qq'}"  loading="lazy"/> *}
          <img class="product-detail__images-full-img" src="{$file['big']}" width="{$prdt_image_width}" height="{$prdt_image_height}" alt="{$pagetitle | clean : 'qq'}" loading="lazy"/>
        </a>
      </div>
    {/foreach}
  </div>
  {if count($files) > 1}
    <div class="product-detail__images-thumbs slider_before_multi">
      {foreach $files as $file}
        <div class="product-detail__images-thumbs-slide">
          <span class="product-detail__images-thumbs-img-wrap" data-rid="{$file['product_id']}" data-iid="{$file['id']}">
            {* <img class="product-detail__images-thumbs-img" itemprop="image" src="{$file['url'] | phpthumbon : $prdt_imgs_thumb_params}" alt="{$pagetitle | clean : 'qq'}" loading="lazy"> *}
            <img class="product-detail__images-thumbs-img" itemprop="image" src="{$file['small']}" alt="{$pagetitle | clean : 'qq'}" width="{$prdt_thumb_image_width}" height="{$prdt_thumb_image_height}" loading="lazy">
          </span>
        </div>
      {/foreach}
    </div>
  {/if}
{else}
  <div class="product-detail__images-full">
    <img src="{('+cfg_noimage' | placeholder) | phpthumbon : $full_img_params}" alt="{$pagetitle | clean : 'qq'}" loading="lazy"/>
  </div>
{/if}
</div>