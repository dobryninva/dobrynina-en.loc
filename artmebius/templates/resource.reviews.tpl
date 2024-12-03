{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 0} *}
  {set $reviews_html = '!pdoPage@reviews_ajax' | snippet}
{/block}

{block 'page'}
<div id="page" class="page-inner page-reviews{$page_class}">
{/block}

{block 'main'}
  <main class="reviews{$content_class ?: ' reviews_main'}">
    <div id="reviews" class="content reviews_detail">
      <h1 class="page-header">{$pagetitle}</h1>

      {if ('reviews' | placeholder)}
      <div id="reviews_wrapper" class="reviews_wrapper">
        <div id="reviews_list" class="reviews_list items_list">
          {'reviews' | placeholder}
        </div>
        <div id="pages">{'reviews.nav' | placeholder}</div>
      </div>
      {/if}

      {if ($content != '')}
        <div class="page-desc">{$content | imageSlim}</div>
      {/if}
    </div>
  </main>
{/block}

{block 'js'}
<script>
  $('#modal_review').on('show.bs.modal', function (e) {
    $(this).find('.modal-title').text('Оставьте свой отзыв о нашей компании');
  });
</script>
{/block}