<div id="reviews_side" class="mdl reviews_side[[+class_sfx]]">
  [[+title:notempty=`<div class="page-header">[[+title]]</div>`]]
  <div class="reviews_list items_list">
    [[-!getComments?
      &resources =`[[+id]]`
      &parents   =`0`
      &limit     =`[[+limit]]`
      &sortby    =`RAND()`
      &tpl       =`comments_auth_listRow`
    ]]
    [[AjaxSnippet?
      &snippet   =`getComments`
      &as_mode   =`onload`

      &resources =`[[+id]]`
      &parents   =`0`
      &limit     =`[[+limit]]`
      &sortby    =`RAND()`
      &tpl       =`comments_auth_listRow`
    ]]
    [[-getImageList?
      &docid     =`[[+id]]`
      &tvname    =`reviews`
      &limit     =`[[+limit]]`
      &randomize =`0`
      &tpl       =`reviews_row`
    ]]
  </div>
  [[+show_more:is=`1`:then=`
  <div class="show_more_wrap">
    <a class="show_more_link" href="[[~[[+id]]]]">[[+show_more_text:default=`Все отзывы`]]</a>
  </div>
  `]]
</div>