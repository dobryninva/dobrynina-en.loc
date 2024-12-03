{set $stars = [1,2,3,4,5]}
{if ($text | length) > 250}
  {set $text = $text | truncate : 250}
  {set $spoiler = ' spoiler_light'}
{/if}
{set $rating_average = 100/5*$properties['vote']}
<div class="reviews-grid__col grid_col col-auto">
  <div class="reviews-grid-item reviews-grid__item{$comment_new}" id="comment-{$id}" data-parent="{$parent}" data-newparent="{$new_parent}" data-id="{$id}">
    <div class="reviews-grid-item__header">
      <div class="reviews-grid-item__rating">
        {if ($resource != $_modx->resource.id)}
        <a class="reviews-grid-item__rating-link stars-rating" href="{$url}#prdt_reviews" title="{$_pls['ticket.pagetitle']}">
        {else}
        <div class="reviews-grid-item__rating-link stars-rating">
        {/if}
          <span class="stars-rating__default"></span>
          <span class="stars-rating__active" style="width: {$rating_average}%;"></span>
        {if ($resource != $_modx->resource.id)}</a>{else}</div>{/if}
      </div>
      <div class="reviews-grid-item__auth">
        <div class="reviews-grid-item__auth-name">{$fullname}</div>
        {if $properties['city']?}
        <div class="reviews-grid-item__auth-city">{$properties['city']}</div>
        {/if}
      </div>
      <div class="reviews-grid-item__date">{$date_ago}</div> {* {$createdon | date_format: '%d.%m.%Y'} *}
    </div>
    <div class="reviews-grid-item__text{$spoiler}">{$text}</div>
    {* {if $spoiler}<div class="reviews-grid-item__more"><span class="reviews-grid-item__more-link">Читать полностью</span></div>{/if} *}
  </div>
</div>
{*
{$_pls['properties']['field']}

<div class="reviews-grid-item__link"><a href="{$url}#comment-{$id}"><i class="fal fa-expand"></i></a></div>
<a href="[[~[[+section.id]]]]" class="ticket-comment-section"><i class="glyphicon glyphicon-folder-open"></i>
  [[+section.pagetitle]]</a> &rarr;
<a href="[[~[[+ticket.id]]]]" class="ticket-comment-ticket">[[+ticket.pagetitle]]</a>
*}