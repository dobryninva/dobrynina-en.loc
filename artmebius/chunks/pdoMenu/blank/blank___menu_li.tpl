[[+class_key:is=`modDocument`:then=`<li[[+wf.id]] class="[[+wf.classnames]]">
	<a href="[[+wf.link]]" title="[[+wf.title:replace=`"=='`]]"[[-']] [[+wf.attributes]]>
		<span class="item_title">[[+wf.linktext]]</span>
	</a>
	[[+wf.wrapper]]
</li>`]][[+class_key:is=`modWebLink`:then=`
<li[[+wf.id]] class="[[+wf.classnames]][[+wf.link:empty=` menu_separator`:notempty=``]]">
	[[+wf.link:notempty=`
	<a href="[[+wf.link]]" title="[[+wf.title:replace=`"=='`]]"[[-']] [[+wf.attributes]]>
		<span class="item_title">[[+wf.linktext]]</span>
	</a>
	`:default=`
	<span class="item_separator">
		<span class="item_title">[[+wf.linktext]]</span>
	</span>
	`]]
	[[+wf.wrapper]]
</li>`]]