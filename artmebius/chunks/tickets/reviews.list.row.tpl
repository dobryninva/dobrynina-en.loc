<div class="reviews_item item_comment{$comment_new}" id="comment-{$id}" data-parent="{$parent}" data-newparent="{$new_parent}" data-id="{$id}">
  <div class="reviews_item_header">
    <div class="reviews_item_auth">{$fullname}</div>
    <div class="reviews_item_date">{$date_ago}</div>{* {$createdon | date_format: '%d.%m.%Y'} *}
  </div>

  <div class="reviews_item_text">{$text}</div>

  {if $_modx->user.id in [1,2]}
    <div class="reviews_item_reply comment-reply">
      <a href="#" class="reviews_item_reply_link reply">{'ticket_comment_reply' | lexicon}</a>
      {$comment_edit_link}
    </div>
  {/if}
  <div class="reviews_item_comments comments-list">{$children}</div>
</div>