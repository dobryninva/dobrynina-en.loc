<div class="tiles_col col-xs-[[++grid_size_photo:div=`[[++photo_per_row_xs]]`]] col-sm-[[++grid_size_photo:div=`[[++photo_per_row_sm]]`]] col-md-[[++grid_size_photo:div=`[[++photo_per_row_md]]`]] col-lg-[[++grid_size_photo:div=`[[++photo_per_row_lg]]`]] col-xl-[[++grid_size_photo:div=`[[++photo_per_row_xl]]`]]">
  <div class="photos_block [[+cls]]">
    <a class="item_link albumbox" title="[[+name]]" href="[[+linkToImage:if=`[[+linkToImage]]`:is=`1`:then=`[[+image_absolute]]`:else=`[[~[[*id]]?
                              &[[+imageGetParam]]=`[[+id]]`
                              &[[+albumRequestVar]]=`[[+album]]`
                              &[[+tagRequestVar]]=`[[+tag]]` ]]`]]">
      <img class="item_img [[+imgCls]]" src="[[+thumbnail]]" alt="[[+name]]" />
    </a>
  </div>
</div>