<div id="reviews" class="mdl reviews_main[[+class_sfx]]">
  [[+title:notempty=`<div class="page-header">[[+title]]</div>`]]
  <div class="reviews_grid tiles_grid">
    <div class="row tiles_row clr-sxs-1 clr-xs-2 clr-sm-2 clr-md-3 clr-lg-3">
      [[getComments?
        &resources =`[[+id]]`
        &parents   =`0`
        &limit     =`[[+limit]]`
        &tpl       =`comments_auth_gridRow`
      ]]
      [[-AjaxSnippet?
        &snippet   =`getComments`
        &as_mode   =`onload`

        &resources =`[[+id]]`
        &parents   =`0`
        &limit     =`[[+limit]]`
        &sortby    =`RAND()`
        &tpl       =`comments_auth_gridRow`
      ]]
      [[-getImageList?
        &docid     =`[[+id]]`
        &tvname    =`reviews`
        &limit     =`[[+limit]]`
        &randomize =`0`
        &tpl       =`reviews_gridRow`
      ]]
    </div>
  </div>
  [[+show_more:is=`1`:then=`
  <div class="show_more_wrap">
    <a class="show_more_link" href="[[~[[+id]]]]">[[+show_more_text:default=`Все отзывы`]]</a>
  </div>
  `]]
</div>