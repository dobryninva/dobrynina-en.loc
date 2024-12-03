<div class="mdl[[+class_sfx]]">
  [[+title:notempty=`<div class="page-header">[[+title]]</div>`]]
  <div class="[[+class_wrap]]">
    [[getImageList?
      &docid      =`[[+id]]`
      &tvname     =`[[+tvname]]`
      &limit      =`[[+limit]]`
      &randomize  =`[[+randomize]]`
      &tpl        =`[[+tpl]]`
    ]]
  </div>
  [[+show_more:is=`1`:then=`
  <div class="show_more_wrap">
    <a class="show_more_link" href="[[~[[+id]]]]">[[+show_more_text:default=`Смотреть все`]]</a>
  </div>
  `]]
</div>