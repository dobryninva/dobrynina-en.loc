{set $img_dir = 'images/'}
<tr class="cart_items cart_tds">
  <td class="cart_img">
    <div class="data">
      <a href="{$url}" class="item_img"><img src="{'phpthumbon' | snippet : ['input' => $img_dir~$image, 'options' => '&w=100&h=100&zc=0&far=1']}" alt="{$pagetitle}"></a>
    </div>
  </td>
  <td class="cart_title">
    <div class="data">
      <div>
      	<a href="{$url}" class="item_title">{$name}</a>
        {if $addit_data}
          <div class="item_params">{$addit_data}</div>
        {/if}
      </div>
    </div>
  </td>
  <td class="cart_price"><div class="data">{$price_total} {$currency}</div></td>
  <td class="cart_qty">
    <div class="data">
    	<div class="wrap_qty">
    		<input class="shk-count" type="text" name="count[]" maxlength="3" title="изменить количество" value="{$count}" autocomplete="off"/> <span>{$units}</span>
  	  </div>
  	</div>
  </td>
  <td class="cart_price_count"><div class="data">{$price_count_total} {$currency}</div></td>
  <td class="cart_del"><div class="data"><a href="{$url_del_item}" title="Удалить" class="shk-del">Удалить</a></div></td>
</tr>