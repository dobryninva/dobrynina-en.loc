<div class="sr_item">
	[[*show_date:is=`1`:then=`<div class="item_date"><span>[[+publishedon:strtotime:date=`%d.%m.%Y`]]</span></div>`]]
  <div class="item_link_wrap">
  	<a href="[[+link:is=``:then=`[[~[[+id]]]]`:else=`[[+link]]`]]" class="item_link sr_item_link">
			[[*show_preview:is=`1`:and:if=`[[+image]]`:ne=``:then=`<span class="item_preview"><img src="[[+image:phpthumbon=`&w=[[*preview_width]]&h=[[*preview_height]]&zc=[[*preview_zc]]&far=1`]]" alt="[[+pagetitle:replace=`"=='`]]"[[-']]></span>`]]
  		<span class="item_title">[[+idx]]. [[+pagetitle]]</span>
  	</a>
  </div>
  [[*show_intro:is=`1`:and:if=`[[+extract]]`:ne=``:then=`<div class="item_intro sr_item_desc">[[+extract]]</div>`]]
	[[*show_more:is=`1`:then=`<div class="item_more"><a href="[[+link:is=``:then=`[[~[[+id]]]]`:else=`[[+link]]`]]" class="btn-more">подробнее</a></div>`]]
</div>