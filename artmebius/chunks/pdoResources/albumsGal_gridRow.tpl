<div class="tiles_col col-xs-[[+grid_size:div=`[[+items_per_row_xs]]`]] col-sm-[[+grid_size:div=`[[+items_per_row_sm]]`]] col-md-[[+grid_size:div=`[[+items_per_row_md]]`]] col-lg-[[+grid_size:div=`[[+items_per_row_lg]]`]]">
	<article class="item_block clearfix [[*id:is=`1`:then=`ani-fiu`:else=`ani-fi`]]">
	  <div class="image_link_wrap">
	  	<a href="[[+link]]" [[+link_attributes]] class="item_link">
        <span class="item_preview">
          <img class="item_img" src="[[+tv.image:phpthumbon=`&w=[[+preview_width]]&h=[[+preview_height]]&zc=[[+preview_zc]]&far=1`]]" alt="[[+pagetitle:replace=`"=='`]]"[[-']]>
        </span>
	  	</a>
		</div>
    <div class="item_info">
      [[+tv.price:ne=``:then=`<div class="item_price"><span class="cur_price">[[+tv.price:num_format]]</span> руб.</div>`]]
      <div class="item_link_wrap">
        <a href="[[+link]]" [[+link_attributes]] class="item_link"><span class="item_title">[[+menutitle:default=`[[+pagetitle]]`]]</span></a>
      </div>
    </div>
	</article>
</div>