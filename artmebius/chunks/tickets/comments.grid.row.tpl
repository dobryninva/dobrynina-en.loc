<div class="reviews-grid__col grid_col col-auto">
  <div class="comments-grid-item reviews-grid__item" id="comment-{$id}" data-id="{$id}">
    <div class="comments-grid-item__header">
      <div class="comments-grid-item__auth">{$fullname}</div>
      <div class="comments-grid-item__date">{$date_ago}</div>
    </div>
    <div class="comments-grid-item__text">{$text | truncate : 350}</div>
  </div>
</div>
{*
{$_pls['properties']['field']}

      <div class="comments-grid-item__link"><a href="{$url}#comment-{$id}"><i class="fal fa-expand"></i></a></div>
<a href="[[~[[+section.id]]]]" class="ticket-comment-section"><i class="glyphicon glyphicon-folder-open"></i>
  [[+section.pagetitle]]</a> &rarr;
<a href="[[~[[+ticket.id]]]]" class="ticket-comment-ticket">[[+ticket.pagetitle]]</a>
*}