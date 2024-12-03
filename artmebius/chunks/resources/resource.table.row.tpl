{set $img_dir = '/images/'}
{set $img_params = '&w='~$preview_width~'&h='~$preview_height~'&zc='~$preview_zc~'&far=1'}
{if $_pls['tv.image']}
  {if $img_dir in $_pls['tv.image']}
    {set $image = $_pls['tv.image']}
  {else}
    {set $image = $img_dir ~ $_pls['tv.image']}
  {/if}
{else}
  {* {set $image = $_pls['tv.image']} // for noimage and wm *}
  {set $image = ''}
{/if}
{set $intro = ($show_intro == 1 && $introtext != '') ? $introtext : ($content | notags)}
{set $intro_truncate = ($intro_length != '') ? $intro_length : 200}
{set $title_truncate = ($title_length != '') ? $title_length : 200}
{set $price = $_pls['tv.price']}
<tr class="article_item">
  <td>

    {if $show_date == 1}
    <div class="article_item_date"><time datetime="{$publishedon | date : 'Y-m-d'}">{$publishedon | date : 'd.m.Y'}</time></div>
    {/if}

    {if $show_title == 1}
    <div class="article_item_title">
      <a class="article_item_title_link" href="{$id | url}" {$link_attributes}>
        {* {if $show_preview == 1 && $image != ''} *}
        {if $show_preview == 1}
        <span class="article_item_title_link_image">
          <img src="{$image | phpthumbon : $img_params}" alt="{$pagetitle | clean : 'qq'}">
        </span>
        {/if}
        <span class="article_item_title_link_text">{($menutitle ?: $pagetitle) | truncate : $title_truncate : '...'}</span>
      </a>
    </div>
    {/if}

    {if $show_intro == 1 && $intro != ''}
    <div class="article_item_intro">{$intro | truncate : $intro_truncate : '...'}</div>
    {/if}

    {if $price}
    <div class="article_item_price">
      Цена: <span class="article_item_price_value">{$price | num_format}</span> <span class="article_item_price_currency">{'shk3.currency' | option}</span>
    </div>
    {/if}

    {if $show_more == 1}
    <div class="article_item_more"><a href="{$id | url}" {$link_attributes} class="article_item_more_link">Подробнее</a></div>
    {/if}

  </td>
</tr>