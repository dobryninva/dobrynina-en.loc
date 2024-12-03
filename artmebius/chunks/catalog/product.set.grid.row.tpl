{* labels *}
{set $labels_config_arr = 'getLabels' | snippet}
{set $labels_options = '!msProductOptions' | snippet : [
  'onlyOptions'=>'label',
  'product'=>$id,
  'return'=>'data',
]}
{if $labels_options.label.value is array}
  {set $labels_active_arr = $labels_options.label.value}
  {foreach $labels_config_arr as $label_key => $label_title}
    {if $label_key in $labels_active_arr}
      {set $labels_arr[$label_key] = $label_title}
    {/if}
  {/foreach}
{/if}
{if $labels_arr}
  {set $labels_html}
    {foreach $labels_arr as $label_key => $label_title}
      <span class="label_block label_{$label_key}" data-label="{$label_key}"><span>{$label_title}</span></span>
    {/foreach}
  {/set}
{/if}
{if $_pls['mssetincart_active']}
  {var $cls = 'active'}
{/if}
<div class="tiles_col col">
  <div class='prds_set ms2_product mssetincart-product {$cls}'>
    <form method="post" class="ms2_form msoptionsprice-product" autocomplete="off">
      <input type="hidden" name="id" value="{$id}">
      <input type="hidden" name="options" value="[]">

      <!-- required -->
      {foreach ['link','master','slave','mode','propkey'] as $field}
        {set $field = 'mssetincart_'~$field}
        <input type="hidden" name="{$field}" value="{$_pls[$field]}">
      {/foreach}

      {var $field = 'mssetincart_propkey'}
      <input type="hidden" name="{$field}" value="{$_pls[$field]}" form="{$_pls[$field]}">
      {var $field = 'mssetincart_active'}
      <!-- tt -->
      <input type="{$_pls['mssetincart_input']}" name="{$field}[]" value="{$id}" style="display: none;" form="{$_pls['mssetincart_propkey']}" {if $_pls[$field]?}checked="checked"{/if}>
      <!-- tt -->
      <!-- end required -->

      <div class="prds_set_preview">
        {if $labels_html}<span class="prds_set_labels labels_wrap">{$labels_html}</span>{/if}
        <a href="{$id | url}" class="prds_set_preview_link">
          <span class="prds_set_preview_link_image">
            {if $medium}
              {* <img class="prds_set_preview_link_img" src="{$image | phpthumbon : '&w=77&h=27&zc=0&far=1'}" width="77" height="27" alt="{$pagetitle | clean : 'qq'}" /> *}
              <img class="prds_set_preview_link_img" src="{$medium}" {$medium | img_size : 'attr'} alt="{$pagetitle | clean : 'qq'}" loading="lazy"/>
            {else}
            {set $noimage = ('assets_url' | option) ~ 'components/phpthumbon/noimage-512.png'}
              <img class="prds_set_preview_link_img" src="{$noimage | phpthumbon : '&w=390&h=288&zc=0&far=1&bg=ffffff'}" {$thumb | img_size : 'attr'} alt="{$pagetitle | clean : 'qq'}" loading="lazy"/>
            {/if}
          </span>
        </a>
      </div>

      {set $comments_rating = 'get_comments_rating' | snippet : ['rid'=>$id]}
      <div class="prds_set_rating">
        {if $comments_rating['count'] > 0}
        <a href="{$id|url}#prdt_reviews" class="prds_set_rating_link stars_rating_link">
        {else}
        <span class="prds_set_rating_link stars_rating_link">
        {/if}
          <span class="stars_rating" title="Средняя оценка: {$comments_rating['average_star']}">
            <span class="stars_rating_default"></span>
            <span class="stars_rating_active" style="width: {$comments_rating['average']}%;"></span>
          </span>
          <span class="stars_rating_count">({$comments_rating['count']})</span>
        {if $comments_rating['count'] > 0}</a>{else}</span>{/if}
      </div>

      <div class="prds_set_title">
        <a href="{$id | url}" class="prds_set_title_link">
          <span class="prds_set_title_link_text">{$pagetitle}</span>
        </a>
      </div>

      <input type="hidden" name="count" value="{$mssetincart_count}"/>

    </form>
  </div>
</div>