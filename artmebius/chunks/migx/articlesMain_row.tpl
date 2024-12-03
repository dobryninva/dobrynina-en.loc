<div class="page_sect articles_on_main [[+_first:is=`1`:then=`bd-chain-gray-top`]] [[+_last:is=`1`:then=`bd-chain-gray-bottom`]]" style="background-image: url('[[+item_bg]]'); ">
  <div class="container">
    [[+_alt:is=`1`:then=`
    <div class="row">
      <div class="col-sm-7 col-sm-push-5">
        <div class="item_title page-header"><div class="gr-h-green">[[+item_title]]</div></div>
        <div class="item_desc">[[+item_desc]]</div>
        <div class="item_more"><a class="btn-main" href="[[~[[+item_link]]]]">[[+item_btn_text:default=`Подробнее`]]</a></div>
      </div>
      <div class="col-sm-5 col-sm-pull-7">
        <div class="item_image"><img src="[[+item_image]]" alt="[[+item_title]]"></div>
      </div>
    </div>
    `:else=`
    <div class="row">
      <div class="col-sm-7">
        <div class="item_title page-header"><div class="gr-h-green">[[+item_title]]</div></div>
        <div class="item_desc">[[+item_desc]]</div>
        <div class="item_more"><a class="btn-main" href="[[~[[+item_link]]]]">[[+item_btn_text:default=`Подробнее`]]</a></div>
      </div>
      <div class="col-sm-5">
        <div class="item_image"><img src="[[+item_image]]" alt="[[+item_title]]"></div>
      </div>
    </div>
    `]]
  </div>
</div>