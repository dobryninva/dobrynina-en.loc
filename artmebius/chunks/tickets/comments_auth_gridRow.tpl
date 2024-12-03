<div class="tiles_col col-xs-12 col-sm-6 col-md-4 col-lg-4">
  <div class="review_block item_comment" id="comment-[[+id]]" data-parent="[[+parent]]" data-newparent="[[+new_parent]]" data-id="[[+id]]">
    <div class="item_header clearfix">
      <div class="item_date">[[+date_ago]]</div>[[-{$createdon | date_format: '%d.%m.%Y'}]]
      <div class="item_auth">[[+fullname]]</div>
    </div>
[[-
    <div class="item_vote">
      <div class="stars_wrap stars_[[+properties.vote]]">
        <div class="star [[If? &subject=`1` &operator=`lte` &operand=`[[+properties.vote]]` &then=`active`]]"></div>
        <div class="star [[If? &subject=`2` &operator=`lte` &operand=`[[+properties.vote]]` &then=`active`]]"></div>
        <div class="star [[If? &subject=`3` &operator=`lte` &operand=`[[+properties.vote]]` &then=`active`]]"></div>
        <div class="star [[If? &subject=`4` &operator=`lte` &operand=`[[+properties.vote]]` &then=`active`]]"></div>
        <div class="star [[If? &subject=`5` &operator=`lte` &operand=`[[+properties.vote]]` &then=`active`]]"></div>
      </div>
    </div>
-]]
[[-
    <div class="item_photos row tiles_row">
      [[If?
        &subject=`[[+properties.photos.0]]`
        &operator=`notempty`
        &then=`
        <div class="tiles_col col-sxs-1 col-xs-6 col-sm-3">
          <a href="/uploads/[[+properties.photos.0]]" class="lightbox">
            <img src="[[phpthumbon? &input=`/uploads/[[+properties.photos.0]]` &options=`&w=320&h=240&zc=1&far=1`]]" alt="">
          </a>
        </div>
       `
      ]]
    </div>
-]]
    <div class="item_review">[[+text]]</div>
  </div>
</div>