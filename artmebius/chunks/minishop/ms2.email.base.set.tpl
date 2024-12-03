{var $style = [
'logo' => 'display:block;margin: auto;',
'a' => 'color:#b59349;',
'p' => 'font-family: Arial;color: #666666;font-size: 12px;',
'h' => 'font-family:Arial;color: #111111;font-weight: 200;line-height: 1.2em;margin: 40px auto;width:90%;',
'h1' => 'font-size: 36px;',
'h2' => 'font-size: 28px;',
'h3' => 'font-size: 22px;',
'th' => 'padding:3px 6px;font-family: Arial;text-align: left;color: #111111;',
'td' => 'padding:3px 6px;font-family: Arial;text-align: left;color: #111111;',
'td.bdt1' => 'border-top: 1px solid #989898;',
'td.bdt2' => 'border-top: 1px solid #eee;',
'td.bdt3' => 'border-top: 1px dashed #eee;',
'td.bdt' => 'border-top: 1px solid #989898;',
'clrD' => 'color: #989898;',
]}
{var $site_url = ('site_url' | option) | preg_replace : '#/$#' : ''}
{var $assets_url = 'assets_url' | option}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>{'site_name' | option}</title>
  <style type="text/css" media="screen"></style>
</head>
<body style="margin:0;padding:0;background:#f6f6f6;">
<div style="height:100%;padding-top:20px;background:#f6f6f6;">
  {block 'logo'}
    <a href="{$site_url}">
      <img style="{$style.logo}"
        src="{$site_url}/images/logo-full.png"
        alt="{$site_url}"
        width="265" height="70"/>
    </a>
  {/block}
  <!-- body -->
  <table class="body-wrap" style="padding:0 20px 20px 20px;width: 100%;background:#f6f6f6;margin-top:10px;">
    <tr>
      <td></td>
      <td class="container" style="border:1px solid #f0f0f0;background:#ffffff;width:800px;margin:auto;">
        <div class="content">
          <table style="width:100%;">
            <tr>
              <td>
                <h3 style="{$style.h}{$style.h3}">
                  {block 'title'}
                    miniShop2
                  {/block}
                </h3>

                {block 'user'}{/block}

                {block 'products'}
                  <table style="width:90%;margin:auto;border-collapse:collapse;">
                    <thead>
                    <tr>
                      <th>&nbsp;</th>
                      <th style="{$style.th}">{'ms2_cart_title' | lexicon}</th>
                      <th style="{$style.th}">{'ms2_cart_count' | lexicon}</th>
                      {* <th style="{$style.th}">{'ms2_cart_weight' | lexicon}</th> *}
                      <th style="{$style.th}">{'ms2_cart_cost' | lexicon}</th>
                    </tr>
                    </thead>
                    {set $prev_role = 'item'}
                    {foreach $products as $product}

                      {set $is_master = $is_slave = 0}
                      {set $not_master = $not_slave = 1}
                      {set $prod_class_sfx = ''}
                      {* get main modification *}
                      {set $modification = []}
                      {if $product.options and $product.options.modification?}
                        {set $modification = $_modx->runSnippet('!msOptionsPrice.modification',[
                          'product'       => $product.id,
                          'includeThumbs' => 'small',
                          'where'         => json_encode(['msopModification.id' => $product.options.modification]),
                          'return'        => 'data'
                        ])}
                        {set $modification = $modification[0]}
                      {/if}

                      {*$modification|print_r*}
                      {if $modification['small']?}
                        {set $product.thumb = $modification['small']}
                        {set $product.old_price = $modification['old_price']}
                      {/if}

                      {* get all modification *}
                      {if $product.options and $product.options.modifications?}
                        {set $modifications = $_modx->runSnippet('!msOptionsPrice.modification',[
                          'product'       => $product.id,
                          'type'          => '1,2,3',
                          'sortby'        => 'type',
                          'includeThumbs' => 'small',
                          'where'         => json_encode(['msopModification.id:IN' => $product.options.modifications]),
                          'return'        => 'data'
                        ])}
                      {/if}

                      {if (($product['option.mssetincart']['option_slave'] | count) > 0 || ($product['option.mssetincart']['cart_slave'] | count) > 0)}
                        {set $prod_class_sfx = ' cart_item_master'}
                        {set $is_master = 1}
                        {set $not_master = 0}
                      {/if}
                      {if $product['option.mssetincart']['master_key']}
                        {set $prod_class_sfx = ' cart_item_slave'}
                        {set $is_slave = 1}
                        {set $not_slave = 0}
                      {/if}

                      {if $is_master}
                        {set $bdtv = 'bdt1'}
                      {/if}
                      {if $is_slave}
                        {if $prev_role == 'master'}
                          {set $bdtv = 'bdt2'}
                        {elseif $prev_role == 'slave'}
                          {set $bdtv = 'bdt3'}
                        {/if}
                      {/if}
                      {if $not_master && $not_slave}
                        {set $bdtv = 'bdt1'}
                      {/if}

                      <tr>
                        <td style="{$style.th}{$style['td.'~$bdtv]}">
                          {set $image_link_tag = ($not_slave) ? 'a' : 'div'}
                          {set $image_link_href = ($not_slave) ? ' href="'~($product.id | url : ['scheme' => 'full'])~'"' : ''}
                          {set $image_params = ($not_slave) ? '&w=150&h=150&far=1&zc=0&bg=ffffff' : '&w=150&h=38&far=1&zc=0&bg=ffffff'}
                          {set $image_src = $product.image}{* $product.image||$product.thumb *}
                          <{$image_link_tag} {$image_link_href} class="cart_item_image_link">
                            <img src="{$site_url}{'phpthumbon' | snippet : ['input' => $image_src, 'options' => $image_params]}" alt="">
                          </{$image_link_tag}>
                        </td>
                        <td style="{$style.th}{$style['td.'~$bdtv]}">
                          {if $product.id?}
                            {if $not_slave}
                              <a href="{$product.id | url: ['scheme' => 'full']}" style="{$style.a}">{$product.pagetitle}</a>
                            {else}
                              {$product.pagetitle}
                            {/if}
                          {else}
                            {$product.pagetitle}
                          {/if}

                          {if $product.options}
                            <div class="cart_item_options">

                              {foreach $product.options as $key => $option}
                                {set $tmp = $key|preg_replace : '#\_.*#' : ''}
                                {if $tmp in ['modification','modifications','mssetincart','msal']}{continue}{/if}
                                {set $caption = $product[$key ~ '.caption']}
                                {set $caption = $caption ? $caption : ('ms2_product_' ~ $key) | lexicon}
                                <div class="cart_item_option">
                                  {if $option is array}
                                    <span style="{$style.clrD}" class="cart_item_option_title">{$caption}:</span> <span class="cart_item_option_value">{$option | join : '; '}</span>
                                  {else}
                                    <span style="{$style.clrD}" class="cart_item_option_title">{$caption}:</span> <span class="cart_item_option_value">{$option}</span>
                                  {/if}
                                </div>
                              {/foreach}
                              {if $product.options.mssetincart}
                                {$_modx->getChunk('tpl.msSetInCart.info', $product.options.mssetincart)}
                              {/if}
                            </div>
                          {/if}

                          {if $modification}
                            <div class="cart_item_ean"><span style="{$style.clrD}" class="cart_item_ean_title">артикул:</span> <span class="cart_item_ean_value">{$modification['article']}</span>{* article *}</div>
                          {/if}

                          {if $colors?}
                            {foreach $colors as $row index=$index}
                              {if $row.pattern?}
                                <div>
                                  <img alt="" title="{$row.value}" class="img-rounded"
                                     style="background-image:url({$row.pattern});width:25px;height:25px;">
                                </div>
                              {else}
                                <div>
                                  <img alt="" title="{$row.value}" class="img-rounded"
                                     style="background-color:#{$row.color};width:25px;height:25px;">
                                </div>
                              {/if}
                              {$row.value}
                            {/foreach}
                          {/if}
                        </td>
                        <td style="{$style.th}{$style['td.'~$bdtv]}">{$product.count} {'ms2_frontend_count_unit' | lexicon}</td>
                        {* <td style="{$style.th}{$style['td.'~$bdtv]}">{$product.weight} {'ms2_frontend_weight_unit' | lexicon}</td> *}
                        <td style="{$style.th}{$style['td.'~$bdtv]}">{$product.price} {'ms2_frontend_currency' | lexicon}</td>
                      </tr>
                      {if $is_master}
                        {set $prev_role = 'master'}
                      {elseif $is_slave}
                        {set $prev_role = 'slave'}
                      {else}
                        {set $prev_role = 'item'}
                      {/if}
                    {/foreach}
                    <tfoot>
                    <tr>
                      <th style="{$style['td.bdt']}" colspan="2"></th>
                      <th style="{$style.th}{$style['td.bdt']}">
                        {$total.cart_count} {'ms2_frontend_count_unit' | lexicon}
                      </th>
                      {* <th style="{$style.th}{$style['td.bdt']}">
                        {$total.cart_weight} {'ms2_frontend_weight_unit' | lexicon}
                      </th> *}
                      <th style="{$style.th}{$style['td.bdt']}">
                        {$total.cart_cost} {'ms2_frontend_currency' | lexicon}
                      </th>
                    </tr>
                    </tfoot>
                  </table>
                  <h3 style="{$style.h}{$style.h3}">
                    {if $total.delivery_cost}
                      {'ms2_frontend_order_cost' | lexicon}:
                      {$total.cart_cost} {'ms2_frontend_currency' | lexicon} + {$total.delivery_cost}
                      {'ms2_frontend_currency' | lexicon} =
                    {else}
                      Итого:
                    {/if}
                    <strong>{$total.cost}</strong> {'ms2_frontend_currency' | lexicon}
                  </h3>
                {/block}
              </td>
            </tr>
          </table>
        </div>
        <!-- /content -->
      </td>
      <td></td>
    </tr>
  </table>
  <!-- /body -->
  <!-- footer -->
  <table style="clear:both !important;width: 100%;">
    <tr>
      <td></td>
      <td class="container">
        <!-- content -->
        <div class="content">
          <table style="width:100%;text-align: center;">
            <tr>
              <td align="center">
                <p style="{$style.p}">
                  {block 'footer'}
                  <a href="{$site_url}" style="color: #999999;">
                    {'site_name' | option}
                  </a>
                  {/block}
                </p>
              </td>
            </tr>
          </table>
        </div>
        <!-- /content -->
      </td>
      <td></td>
    </tr>
  </table>
  <!-- /footer -->
</div>
</body>
</html>
