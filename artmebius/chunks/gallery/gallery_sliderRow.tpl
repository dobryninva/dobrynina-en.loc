<div class="col-sm-4">
  <div class="photos_block [[+cls]]">
    <a class="item_link lightbox" title="[[+name]]" href="[[+linkToImage:if=`[[+linkToImage]]`:is=`1`:then=`[[+image_absolute]]`:else=`[[~[[*id]]?
                              &[[+imageGetParam]]=`[[+id]]`
                              &[[+albumRequestVar]]=`[[+album]]`
                              &[[+tagRequestVar]]=`[[+tag]]` ]]`]]">
      <img class="item_img [[+imgCls]]" src="[[+thumbnail]]" alt="[[+name]]" />
    </a>
  </div>
</div>