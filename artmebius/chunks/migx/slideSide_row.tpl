<div class="slide_item">
	[[+item_link:ne=``:then=`
	<a href="[[$m[[+item_link:ne=``:then=`url`]]? &url=`[[+item_link]]`]]" class="slide_bg" style="background-image: url('[[+item_image:phpthumbon=`&w=294&h=142&zc=1&far=1`]]');">
	`:else=`
	<div class="slide_bg" style="background-image: url('[[+item_image:phpthumbon=`&w=294&h=142&zc=1&far=1`]]');">
	`]]
[[-
    <span class="slide_content">
      [[+item_title:ne=``:or:if=`[[+item_desc]]`:ne=``:or:if=`[[+item_link]]`:ne=``:then=`
      <span class="slide_info">
        [[+item_title:notempty=`<span class="slide_title">[[title2rows? &title=`[[+item_title]]` &bfr=`1`]]</span>`]]
        [[+item_desc:notempty=`<span class="slide_desc">[[+item_desc]]</span>`]]
      </span>
      `]]
    </span>
]]
	[[+item_link:ne=``:then=`
	</a>
	`:else=`
	</div>
	`]]
</div>