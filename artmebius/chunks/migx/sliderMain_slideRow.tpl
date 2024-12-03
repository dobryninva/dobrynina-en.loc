<div class="slide_item">
  {if $item_link != ''}
  <a href="{$item_link | url}" class="slide_bg slide_resp-" style="background-image: url('{$item_image | phpthumbon : '&w=1920&h=950&zc=1&far=1'}');">
  {else}
  <div class="slide_bg slide_resp-" style="background-image: url('{$item_image | phpthumbon : '&w=1920&h=950&zc=1&far=1'}');">
  {/if}
    <span class="slide_content">
      {if ($item_title != '' || $item_desc != '')}
        <span class="slide_info">
          {$item_title !='' ? '<span class="slide_title">'~'title2rows' | snippet : ['title' => $item_title, 'bfr' => 1]~'</span>' : ''}
          {$item_desc != '' ? '<span class="slide_desc">'~$item_desc~'</span>' : ''}
        </span>
      {/if}
    </span>
  {$item_link != '' ? '</a>' : '</div>'}
</div>
{*
<div class="slide_item">
  <div class="slide_bg slide_resp-" style="background-image: url('{$item_image | phpthumbon : '&w=1920&h=950&zc=1&far=1'}');">
    <div class="slide_content">
      {$item_title !='' ? '<div class="slide_title">'~'title2rows' | snippet : ['title' => $item_title, 'bfr' => 1]~'</div>' : ''}
      {$item_desc != '' ? '<div class="slide_desc">'~$item_desc~'</div>' : ''}
      {$item_link != '' ? '<div class="slide_more"><a href="'~$item_link | url~'" class="slide_more_link">Смотреть</a></div>' : ''}
    </div>
  </div>
</div>
*}