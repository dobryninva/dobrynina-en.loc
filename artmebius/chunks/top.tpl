[[$head]]
<body>
<div id="wrap" class="page_inner[[+page_class]]">
  [[$header]]
  <div id="sect_wrap" class="page_sect_wrap container">
    <div class="mdl breadcrumbs breadcrumbs_top">
      [[pdoCrumbs?
        &showHome=`1`
        &outputSeparator=`<li class="breadcrumb-item"><span class="fa fa-angle-right"></span></li>`
      ]]
    </div>
    <div class="sect_row row">
      [[+sb:is=`1`:then=`
      <div id="sect_main" class="sect_main page_sect col-sm-12 col-md-8 order-md-2 col-lg-9">
      `:else=`
      <div id="sect_main" class="sect_main page_sect col-sm-12">
      `]]