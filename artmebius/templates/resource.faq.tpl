{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
  {set $faq_arr = $_modx->resource.faq | fromJSON}
  {if $faq_arr}
    {set $faq_html}
      <div class="faq_items">
      {foreach $faq_arr as $faq index=$index}
        {set $idx = $index + 1}
        <div id="faq_{$idx}" class="faq_item">
          <div class="faq_item_quest">{$faq.question}</div>
          <div class="faq_item_answer" style="display: none;">{$faq.answer}</div>
        </div>
      {/foreach}
      </div>
    {/set}
  {/if}
{/block}

{block 'main'}
  <main class="articles{$content_class ?: ' faq_main'}">
    <div id="faq_detail" class="content article_detail faq_detail">
      {if $show_title == 1}
        <h1 class="page-header">{$pagetitle}</h1>
      {/if}

      {if faq_html}
        <div class="page-faq">
          {faq_html}
        </div>
      {/if}

      {if $content != ''}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}
    </div>
  </main>
{/block}

{block 'js'}
<script>
  $('.faq_item_quest').click(function(event) {
    $(this).next().slideToggle(300);
    $(this).parent().siblings().find('.faq_item_answer:visible').slideUp(300);
  });
</script>
{/block}