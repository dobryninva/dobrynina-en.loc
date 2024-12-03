[[+class_key:is=`modDocument`:then=`<li[[+wf.id]] class="[[+wf.classnames]]">
	<a href="[[+wf.link]]" title="[[+wf.title:replace=`"=='`]]"[[-']] [[+wf.attributes]]>
		[[+show_menu_image:is=`1`:and:if=`[[+menu_image]]`:ne=``:then=`<span class="item_image"><img src="[[+menu_image:phpthumbon=`&w=28&h=40&zc=0&far=1`]]" alt="[[+wf.linktext]]"></span>`]]
		<span class="item_title">[[+wf.linktext]]</span>
	</a>
	[[+wf.wrapper]]
</li>`]][[+class_key:is=`modWebLink`:then=`
<li[[+wf.id]] class="[[+wf.classnames]][[+wf.link:notempty=`&nbsp;menu_link`:empty=` menu_separator`]]">
	[[+wf.link:notempty=`
	<a href="[[+wf.link]]" title="[[+wf.title:replace=`"=='`]]"[[-']] [[+wf.attributes]]>
		[[+show_menu_image:is=`1`:and:if=`[[+menu_image]]`:ne=``:then=`<span class="item_image"><img src="[[+menu_image:phpthumbon=`&w=28&h=40&zc=0&far=1`]]" alt="[[+wf.linktext]]"></span>`]]
		<span class="item_title">[[+wf.linktext]]</span>
	</a>
	`:default=`
	<span class="item_separator">
		[[+show_menu_image:is=`1`:and:if=`[[+menu_image]]`:ne=``:then=`<span class="item_image"><img src="[[+menu_image:phpthumbon=`&w=28&h=40&zc=0&far=1`]]" alt="[[+wf.linktext]]"></span>`]]
		<span class="item_title">[[+wf.linktext]]</span>
	</span>
	`]]
	[[+wf.wrapper]]
</li>`]]