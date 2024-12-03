<div class="tiles_col col-xs-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
  <div class="photos_block [[+cls]]">
    <a class="item_link albumbox" title="[[+name]]" href="[[+linkToImage:if=`[[+linkToImage]]`:is=`1`:then=`[[+image_absolute]]`:else=`[[~[[*id]]?
                              &[[+imageGetParam]]=`[[+id]]`
                              &[[+albumRequestVar]]=`[[+album]]`
                              &[[+tagRequestVar]]=`[[+tag]]` ]]`]]">
      <img class="item_img [[+imgCls]]" src="[[+thumbnail]]" alt="[[+name]]" />
    </a>
  </div>
</div>