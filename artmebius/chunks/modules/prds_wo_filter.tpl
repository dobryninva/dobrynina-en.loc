<div id="products">
  <div class="ajax_rows">
    [[!pdoPage?
      &select             =`{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key,content"}`
      &parents            =`[[*id]]`
      &depth              =`0`
      &hideContainers     =`1`
      &showHidden         =`1`
      &where              =`[{"template:IN": [10]}]`
      &limit              =`[[++prds_limit]]`
      &sortby             =`[[++prds_sortby]]`
      &sortdir            =`[[++prds_sortdir]]`
      &includeTVs         =`[[++prds_include_tvs]]`
      &processTVs         =`0`
      &useWeblinkUrl      =`1`
      &tplWrapper         =`prdsShop_gridWrapper`
      &tpl                =`prdsCatalog_gridRow`
      &frontend_css       =``

      &tplPageWrapper     =`@INLINE <nav class="pagination_bottom"><ul class="pagination">[[+first]][[+prev]][[+pages]][[+next]][[+last]]</ul></nav>`

      &ajaxMode           =`default`
      &ajaxElemWrapper    =`#products`
      &ajaxElemRows       =`#products .ajax_rows`
      &ajaxElemPagination =`#products #pages`
      &ajaxElemLink       =`#products #pages a`

      &items_per_row_xl   =`[[++prds_per_row_xl]]`
      &items_per_row_lg   =`[[++prds_per_row_lg]]`
      &items_per_row_md   =`[[++prds_per_row_md]]`
      &items_per_row_sm   =`[[++prds_per_row_sm]]`
      &items_per_row_xs   =`[[++prds_per_row_xs]]`
      &grid_size          =`12`

      &preview_width      =`[[++prds_preview_width]]`
      &preview_height     =`[[++prds_preview_height]]`
      &preview_zc         =`[[++prds_preview_zc]]`
    ]]
  </div>
  <div id="pages">
    [[!+page.nav]]
  </div>
</div>