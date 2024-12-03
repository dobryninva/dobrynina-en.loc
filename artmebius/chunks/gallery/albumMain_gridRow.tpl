<div class="tiles_col col-xs-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
  <div class="photos_block [[+cls]]">
    <a class="item_link hover_scale_ lightbox" title="[[+name]]" href="[[+linkToImage:if=`[[+linkToImage]]`:is=`1`:then=`[[+image_absolute]]`:else=`[[~[[*id]]?
                              &[[+imageGetParam]]=`[[+id]]`
                              &[[+albumRequestVar]]=`[[+album]]`
                              &[[+tagRequestVar]]=`[[+tag]]` ]]`]]">
      <span class="item_preview">
        <img class="item_img [[+imgCls]]" src="[[+thumbnail]]" alt="[[+name]]" />
      </span>
    </a>
  </div>
</div>