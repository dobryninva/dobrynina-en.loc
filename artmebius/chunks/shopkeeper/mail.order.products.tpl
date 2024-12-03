{set $site_name   = ('site_name' | option) ?: ''}
{set $site_url   = ('site_url' | option) ?: ''}
{set $price_summ = $price * $count}
<tr class="cart-order">
  <td>
    <a href="{$site_url}{$image | before : '/images/'}"><img src="{$site_url}{$image | before : '/images/'}" style="width: 80px;" width="80" alt=""></a>
  </td>
  <td>
    <b>{$name}</b>
    {if $ean}
    <br>Артикул: {$ean}
    {/if}
  </td>
  <td>
    {$addit_data ?: '&mdash;'}
  </td>
  <td style="text-align: center;">
    {$price | numberFormat}
  </td>
  <td style="text-align: center;">
    {$count}
  </td>
  <td style="text-align: center;">
    {$price_summ | numberFormat}
  </td>
</tr>