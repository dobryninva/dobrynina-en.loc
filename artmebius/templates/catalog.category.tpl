{extends 'template:base'}

{block 'vars'}
  {parent}
  {* Настройки отображения *}
  {set $show_sidebar = 1}
  {set $page_class = $_modx->resource.page_class}
  {set $content_class = $_modx->resource.content_class}
  {* tvs *}
  {set $tags_top_arr = $_modx->resource.tags_top | fromJSON}
  {* ########### Подкатегории ########### *}
  {set $show_categories = ($_modx->resource.show_categories != '') ? $_modx->resource.show_categories : 1}
  {set $categories_view = $_modx->resource.categories_view}
  {set $categories_params = [
		'select'           => '{"modResource":"id,parent,template,menuindex,pagetitle,menutitle,link_attributes,introtext,content"}',
		'parents'          => $id,
		'depth'            => 0,
		'hideContainers'   => 0,
		'showHidden'       => 1,
		'limit'            => 0,
		'where'            => '{"template:IN":[9]}',
		'sortby'           => 'menuindex',
		'sortdir'          => 'ASC',
		'includeTVs'       => 'image_category',
		'useWeblinkUrl'    => 1,
		'frontend_css'     => '',
		'cssWrapper'       => '',

		'items_per_row_xl' => 'ctgs_per_row_xl' | option,
		'items_per_row_lg' => 'ctgs_per_row_lg' | option,
		'items_per_row_md' => 'ctgs_per_row_md' | option,
		'items_per_row_sm' => 'ctgs_per_row_sm' | option,
		'items_per_row_xs' => 'ctgs_per_row_xs' | option,

		'preview_width'    => 'ctgs_preview_width' | option,
		'preview_height'   => 'ctgs_preview_height' | option,
		'preview_zc'       => 'ctgs_preview_zc' | option,
  ]}
  {switch $categories_view}
    {case 'grid'}
      {set $categories_view_params = ['tplWrapper'=>'category.grid.wrapper','tpl'=>'category.grid.row']}
    {case 'list'}
      {set $categories_view_params = ['tplWrapper'=>'category.list.wrapper','tpl'=>'category.list.row']}
    {case 'main'}
      {set $categories_view_params = ['tplWrapper'=>'category.main.wrapper','tpl'=>'category.main.row']}
    {case 'slider'}
      {set $categories_view_params = ['tplWrapper'=>'category.slider.wrapper','tpl'=>'category.slider.row']}
  {/switch}
  {set $categories_params = array_merge($categories_params,$categories_view_params)}
  {* ########### where для товаров ########### *}
  {if $_modx->resource.where}
    {set $where_arr = $_modx->resource.where | fromJSON}
    {set $where_json = '[{"template:IN":[10],'}
    {set $data_field_many = 0}
    {set $option_field_many = 0}
    {set $data_likeor = 1}
    {set $option_likeor = 1}
    {foreach $where_arr as $row index=$index first=$first last=$last}
      {if $first != 1}
        {if ($row.tv_data_field && $data_field_many && $row.rule!=':LIKEFULL')}{set $where_json = $where_json ~ ','}{/if}
        {if ($row.ms_option_field && $option_field_many && $row.rule!=':LIKEFULL')}{set $options_json = $options_json ~ ','}{/if}
      {/if}
      {if ($row.tv_data_field && !$data_field_many)}{set $data_field_many = 1}{/if}
      {if ($row.ms_option_field && !$option_field_many)}{set $option_field_many = 1}{/if}
      {switch $row.rule}
        {case ':LIKE'}
          {if $row.tv_data_field}{set $where_json = $where_json ~ '"' ~ $row.tv_data_field ~ $row.rule ~ '":"%' ~ $row.field_value ~ '%"'}{/if}
          {if $row.ms_option_field}{set $options_json = $options_json ~ '"' ~ $row.ms_option_field ~ $row.rule ~ '":"%' ~ $row.field_value ~ '%"'}{/if}
        {case ':LIKEFULL'}
          {if $row.tv_data_field}
            {if $data_likeor == 1}
              {set $where_json = $where_json ~ '},[{"' ~ $row.tv_data_field ~ ':LIKE":"' ~ $row.field_value ~ ' %","OR:' ~ $row.tv_data_field ~ ':LIKE":"% ' ~ $row.field_value ~ ' %","OR:' ~ $row.tv_data_field ~ ':LIKE":"% ' ~ $row.field_value ~ '","OR:' ~ $row.tv_data_field ~ ':=":"' ~ $row.field_value ~ '"'}
              {set $data_likeor = 2}
            {else}
              {set $where_json = $where_json ~ '},{"OR:' ~ $row.tv_data_field ~ ':LIKE":"' ~ $row.field_value ~ ' %","OR:' ~ $row.tv_data_field ~ ':LIKE":"% ' ~ $row.field_value ~ ' %","OR:' ~ $row.tv_data_field ~ ':LIKE":"% ' ~ $row.field_value ~ '","OR:' ~ $row.tv_data_field ~ ':=":"' ~ $row.field_value ~ '"'}
            {/if}
          {/if}
          {if $row.ms_option_field}{set $options_json = $options_json ~ '"' ~ $row.ms_option_field ~ $row.rule ~ '":"%' ~ $row.field_value ~ '%"'}{/if}
        {case ':IN'}
          {if $row.tv_data_field}{set $where_json = $where_json ~ '"' ~ $row.tv_data_field ~ $row.rule ~ '":[' ~ $row.field_value ~ ']'}{/if}
          {if $row.ms_option_field}{set $options_json = $options_json ~ '"' ~ $row.ms_option_field ~ $row.rule ~ '":[' ~ $row.field_value ~ ']'}{/if}
        {case default}
          {if $row.tv_data_field}{set $where_json = $where_json ~ '"' ~ $row.tv_data_field ~ $row.rule ~ '":"' ~ $row.field_value ~ '"'}{/if}
          {if $row.ms_option_field}{set $options_json = $options_json ~ '"' ~ $row.ms_option_field ~ $row.rule ~ '":"' ~ $row.field_value ~ '"'}{/if}
      {/switch}
    {/foreach}
    {set $last_where_bracket = ($data_likeor > 1) ? ']' : ''}
    {set $where_json = $where_json ~ '}]' ~ $last_where_bracket}
    {if $options_json}{set $options_json = '{' ~ $options_json ~ '}'}{/if}
  {/if}
  {* ########### Товары и фильтр ########### *}
  {set $show_products = ($_modx->resource.show_products != '') ? $_modx->resource.show_products : 1}
  {if $show_products == 1}
    {* порядок сортировки фильтров можно задать в ms_options_get через sortby_key *}
    {set $ms_options_params = ['format'=>'filter']}{* 'sortby_key' => 'opt3,opt1,opt2' *}
    {if $_modx->resource.ms_options_exclude}
      {set $ms_options_params['exclude'] = $_modx->resource.ms_options_exclude}
    {/if}
    {set $msoptions = 'ms_options_get' | snippet : $ms_options_params}
    {set $msoptions_filters = $msoptions.options}
    {set $msoptions_aliases = $msoptions.aliases}
    {set $filters = '
      ms|price:number,
      msvendor|name,
      msvendor|country'}
    {if $msoptions_filters}
      {set $filters = $filters ~ ',' ~ $msoptions_filters}
    {/if}
    {set $aliases = '
      ms|price==price,
      msvendor|name==brand'}
    {if $msoptions_aliases}
      {set $aliases = $aliases ~ ',' ~ $msoptions_aliases}
    {/if}
    {set $filters_params = [
			'toPlaceholders'          => 'minishop.',
			'class'                   => 'msProduct',
			'element'                 => 'msProductsExt',
			'limit'                   => $prds_limit,
			'parents'                 => $id,
			'sortby'                  => 'Data.price, id',
			'sortdir'                 => 'asc',
			'where'                   => '{"template":10}',
			'includeTVs'              => 'views',

			'tpl'                     => 'product.grid.row',
			'tplWrapper'              => 'product.ajax.wrapper',
			'wrapIfEmpty'             => 0,
			'cssWrapper'              => '',

			'suggestions'             =>1,
			'suggestionsMaxFilters'   =>200,
			'suggestionsMaxResults'   =>2000,
			'suggestionsSliders'      =>1,

			'items_per_row_xl'        => $prds_per_row_xl,
			'items_per_row_lg'        => $prds_per_row_lg,
			'items_per_row_md'        => $prds_per_row_md,
			'items_per_row_sm'        => $prds_per_row_sm,
			'items_per_row_xs'        => $prds_per_row_xs,

			'includeThumbs'           => 'medium',
			'preview_width'           => $prds_preview_width,
			'preview_height'          => $prds_preview_height,
			'preview_zc'              => $prds_preview_zc,
			'watermark'               => $prds_watermark,

			'filters'                 => $filters,
			'aliases'                 => $aliases,
			'values_delimeter'        => '-',

			'tplFilter.outer.default' => 'filter2.item.wrapper',
			'tplFilter.row.default'   => 'filter2.checkbox.row',

			'tplFilter.outer.price'   => 'filter2.slider.wrapper',
			'tplFilter.row.price'     => 'filter2.slider.number.row',

      'showLog'                 =>0
    ]}
    {* для мобильников - бесконечный скрол, для десктопа (включая планшеты) - пагинация *}
    {if 'standard' | mobiledetect}
      {set $filter_adaptive_params = [
        'pageLimit' =>5,
      ]}
    {/if}
    {if 'mobile' | mobiledetect}
      {set $filter_adaptive_params = [
        'pageLimit'          => 3,
        'ajaxMode'           => 'scroll',
        'ajaxElemWrapper'    => '#products_ajax',
        'ajaxElemRows'       => '#products_ajax .row',
        'ajaxElemPagination' => '#products_ajax #pages',
        'ajaxElemLink'       => '#products_ajax #pages a',
      ]}
    {/if}
    {if (($where_json != '') || ($options_json != ''))}
      {set $filters_params['parents'] = 7}
      {set $filters_params['depth'] = 10}
    {/if}
    {if $where_json?}
      {set $filters_params['where'] = $where_json}
    {/if}
    {if $options_json?}
      {set $filters_params['optionFilters'] = $options_json}
    {/if}
    {set $filters_params = array_merge($filters_params, $filter_adaptive_params, $pagination_params)}
    {*  если требуется, отключаем предсказания для определённых ресурсов (например, главная каталога, если не вывозит из-за большого кол-ва товаров)
    {if $id in [7]}
      {set $filters_suggestions_params = [
        'suggestions'           => 0,
      ]}
      {set $filters_params = array_merge($filters_params, $filters_suggestions_params)}
    {/if} *}
    {'!mFilter2' | snippet : $filters_params}
    {set $filters_html = 'minishop.filters' | placeholder}
    {set $products_html= 'minishop.results' | placeholder}
  {/if}
  {* ########### Тэговые страницы для текущей категории ########### *}
  {* {set $tags_html = 'pdoResources' | snippet : [
    'select'         => '{"modResource":"id,pagetitle,menutitle,link_attributes,class_key"}',
    'parents'        => $id,
    'depth'          => 0,
    'hideContainers' => 0,
    'showHidden'     => 1,
    'where'          => '{"template:IN":[15]}',
    'sortby'         => 'menuindex',
    'sortdir'        => 'ASC',
    'tplWrapper'     => '@INLINE <div class="tags tags_sub">{$output}</div>',
    'tpl'            => '@INLINE <a href="{$id | url}" class="tags__link btn btn-main">{$menutitle ?: $pagetitle}</a>',
    'frontend_css'   => '',
  ]} *}
  {* ########### Дополнительные товары ########### *}
  {set $products_additional_ids = $_modx->resource.products_additional}
  {if $products_additional_ids}
    {set $products_additional_html = '!msProductsExt' | snippet : [
			'parents'          => 0,
			'depth'            => 10,
			'limit'            => 0,
			'sortby'           => 'pagetitle',
			'sortdir'          => 'ASC',
			'resources'        => $products_additional_ids,
			'tpl'              => 'product.grid.row',
			'tplWrapper'       => 'product.grid.wrapper',
			'cssWrapper'       => 'products-grid_add',
			'wrapIfEmpty'      => 0,

			'items_per_row_xl' => $prds_per_row_xl,
			'items_per_row_lg' => $prds_per_row_lg,
			'items_per_row_md' => $prds_per_row_md,
			'items_per_row_sm' => $prds_per_row_sm,
			'items_per_row_xs' => $prds_per_row_xs,

			'includeThumbs'    => 'medium',
			'preview_width'    => $prds_preview_width,
			'preview_height'   => $prds_preview_height,
			'preview_zc'       => $prds_preview_zc,
			'watermark'        => $prds_watermark,
    ]}
  {/if}
  {* ########### Статьи - в статьях выбираем в каких категориях их отображать (связанные категории)  ########### *}
  {set $linked_articles_ids = 'linked' | snippet : ['tv_id'=>102]}
  {if $linked_articles_ids}
    {set $linked_articles_html = 'pdoResources' | snippet : [
      'select'           => '{"modResource":"id,parent,template,menuindex,pagetitle,menutitle,link_attributes,publishedon,introtext,content"}',
      'parents'          => 0,
      'depth'            => 10,
      'resources'        => $linked_articles_ids,
      'limit'            => 6,
      'hideContainers'   => 1,
      'showHidden'       => 1,
      'sortby'           => 'menuindex',
      'sortdir'          => 'ASC',
      'includeTVs'       => 'image',
      'processTVs'       => 0,
      'tplWrapper'       => 'resource.grid.wrapper',
      'tpl'              => 'resource.grid.row',
      'useWeblinkUrl'    => 1,
      'frontend_css'     => '',

      'show_title'       => 1,
      'show_date'        => 0,
      'show_preview'     => 1,
      'show_intro'       => 1,
      'intro_length'     => 150,
      'show_more'        => 0,

      'items_per_row_xl' => 3,
      'items_per_row_lg' => 3,
      'items_per_row_md' => 2,
      'items_per_row_sm' => 2,
      'items_per_row_xs' => 1,

      'preview_width'    => 348,
      'preview_height'   => 194,
      'preview_zc'       => 1
    ]}
  {/if}
  {* ########### Подкатегории как меню v1 - для ВЫБРАННЫХ категорий строим ОДНО меню ########### *}
  {set $sub_categories = $_modx->resource.sub_categories}
  {if $sub_categories?}
	  {set $sub_categories_html}
		  <div class="sub-categories">
		    {'pdoMenu' | snippet : [
					'select'             => '{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key"}',
					'resources'          => $sub_categories,
					'parents'            => 0,
					'level'              => 10,
					'showHidden'         => 1,
					'sortby'             => 'menuindex',
					'sortdir'            => 'ASC',
					'tplOuter'           => 'menu.ul',
					'tpl'                => 'menu.li',
					'tplParentRow'       => 'menu.li.parent',
					'tplParentRowActive' => 'menu.li.parent.active',
					'outerClass'         => 'menu menu_vert',
					'innerClass'         => 'menu__sub',
					'rowClass'           => 'menu__item',
					'selfClass'          => 'menu__item_current current',
					'parentClass'        => 'menu__item_parent parent'
					'hereClass'          => 'menu__item_active active'
		    ]}
		  </div>
	  {/set}
  {/if}
  {* ########### Подкатегории как меню v2 - для ВЫБРАННЫХ категорий строим ОТДЕЛЬНЫЕ меню с ИХ потомками ########### *}
  {* {set $sub_categories_arr = 'sub_categories' | snippet}
  {if $sub_categories_arr}
    {set $sub_categories_html}
      {foreach $sub_categories_arr as $category}
      	<div class="page__header page-header" data-toggle="on" data-toggle-effect="slide">{$category.title} <i class="page__header-satus fal d-md-none"></i></div>
        <div class="categories-menu">
        	{'pdoMenu' | snippet : [
        	  'select'             => '{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key"}',
        	  'resources'          => $category.ids,
        	  'parents'            => 0,
        	  'level'              => 10,
        	  'showHidden'         => 1,
        	  'sortby'             => 'menuindex',
        	  'sortdir'            => 'ASC',
        	  'tplOuter'           => 'menu.ul',
        	  'tpl'                => 'menu.li',
        	  'tplParentRow'       => 'menu.li.parent',
        	  'tplParentRowActive' => 'menu.li.parent.active',
        	  'outerClass'         => 'menu menu_vert',
						'innerClass'         => 'menu__sub',
						'rowClass'           => 'menu__item',
						'selfClass'          => 'menu__item_current current',
						'parentClass'        => 'menu__item_parent parent'
						'hereClass'          => 'menu__item_active active'
        	]}
        </div>
      {/foreach}
    {/set}
  {/if} *}
{/block}


{block 'page'}
<div class="page page_inner page_category{$page_class}">
{/block}


{block 'main'}
  <main class="category-detail{$content_class|before:' '}">

    <h1 class="category-detail__header page-header">{$h1 ?: $pagetitle}</h1>

    {* ########### Тэговые страницы для текущей категории ########### *}
    {if $tags_html?}
      <div class="page__tags-mdu">{$tags_html}</div>
    {/if}

    {* ########### Тэговые ссылки из migx (верхние) ########### *}
	  {if $tags_top_arr?}
	  	<div class="category-detail__tags-top">
				<div class="tags tags_top">
					{foreach $tags_top_arr as $row}
				  	{if $row.active}<a class="tags__link btn btn-main btn-outline btn-clr-h" href="{$row.id | url}">{$row.text}</a>{/if}
					{/foreach}
				</div>
	  	</div>
	  {/if}

    {* ########### Подкатегории ########### *}
    {if $show_categories == 1}
      <div class="category-detail__categories-grid">
        {'pdoResources' | snippet : $categories_params}
      </div>
    {/if}

    {* ########### Фильтр: перемещаем фильтр сюда в мобильной версии  ########### *}
    {* {if ($filters_html && $products_html)}<div class="page__filter-smd"></div>{/if} *}

    {if ($filters_html && $products_html)}

	    {* ########### кнопки фильтра и сортировки в мобильной версии ########### *}
	    <div class="category-detail__filter-sorting filter-sorting filter-sorting_mob">
	      <div class="category-detail__filter-sorting-btn filter-sorting__btn" data-backdrop="click" data-target=".sorting" data-side="left" data-wrapper="backdrop_sort" data-title="Cортировать" data-type="self">Сортировка</div>
	    	<div class="category-detail__filter-sorting-btn filter-sorting__btn" data-backdrop="click" data-target=".filter_side" data-side="left" data-wrapper="backdrop_filter" data-title="Фильтр" data-type="self">Фильтр</div>
	    </div>

	    {* ########### Сортировка ########### *}
	    <div id="mse2_sort" class="category-detail__sorting sorting">
	  		{set $sort = ($.get['sort'] != '') ? $.get['sort'] : ''}{* 'ms|price:asc' *}
	      <div class="sorting__header d-md-none">
	        <div class="sorting__switcher" data-toggle="on" data-toggle-effect="slide" data-toggle-target=".sorting .sorting__body">
	          Сортировка <i class="sorting__switcher-status fal"></i>
	        </div>
	      </div>
	      <div class="sorting__body">
	        <a href="#!"
	           data-sort="ms|price"
	           data-dir="{if $sort == 'ms|price:asc'}asc{/if}{if $sort == 'ms|price:desc'}desc{/if}"
	           data-default="asc"
	           class="sorting__link btn btn-main btn-outline btn-clr-h sort{('price' in string $sort) ? ' active' : ''}">
	            По цене <span class="sorting__link-dir fal"></span>
	        </a>
	        <a href="#!"
	           data-sort="tv|views"
	           data-dir="{if $sort == 'tv|views:asc'}asc{/if}{if $sort == 'tv|views:desc'}desc{/if}"
	           data-default="desc"
	           class="sorting__link btn btn-main btn-outline btn-clr-h sort{('price' in string $sort) ? ' active' : ''}">
	            По популярности <span class="sorting__link-dir fal"></span>
	        </a>
	        <a href="#"
	           data-sort="ms_product|pagetitle"
	           data-dir="{if $sort == 'ms_product|pagetitle:asc'}asc{/if}{if $sort == 'ms_product|pagetitle:desc'}desc{/if}"
	           data-default="asc"
	           class="sorting__link btn btn-main btn-outline btn-clr-h sort{('price' in string $sort) ? ' active' : ''}">
	            По алфавиту <span class="sorting__link-dir fal"></span>
	        </a>
	      </div>
	    </div>
    {/if}

    {* ########### Товары + пагинация ########### *}
    {if ($products_html && ($products_html != 'Подходящих результатов не найдено.'))}
    	{* ajax подгрузка при скролле в мобильной версии + пагинация на десктопе *}
    	<div id="products_ajax" class="category-detail__products-grid products-grid">
      	<div id="mse2_results" class="products-grid__items row row-cols-xs-{$prds_per_row_xs} row-cols-sm-{$prds_per_row_sm} row-cols-md-{$prds_per_row_md}	row-cols-lg-{$prds_per_row_lg} row-cols-xl-{$prds_per_row_xl}">
        	{$products_html}
      	</div>
      	<div id="pages" class="page__pagination mse2_pagination">
        	{'page.nav' | placeholder}
      	</div>
    	</div>
    {/if}

    {* ########### Тэговые ссылки из migx (нижние) ########### *}
	  {if $tags_top_arr?}
	  	<div class="category-detail__tags-btm">
				<div class="tags tags_btm">
					{foreach $tags_btm_arr as $row}
				  	{if $row.active}<a class="tags__link btn btn-main btn-outline btn-clr-h" href="{$row.id | url}">{$row.text}</a>{/if}
					{/foreach}
				</div>
	  	</div>
	  {/if}

    {if ($.get.page < 2 && $content != '')}
	     <div class="category-detail__content page-desc">{$content | imageSlimExt : "phpthumbon=q=90"}</div>
    {/if}
  </main>
{/block}


{block 'widgets_after_main'}

	{* ########### Дополнительные товары ########### *}
  {if $products_additional_html?}
    <div class="page__header page__header_add page-header">Дополнительные товары</div>
    {$products_additional_html}
  {/if}

  {* ########### Тэговые страницы для текущей категории перемещаем сюда в мобильной версии ########### *}
  {if $tags_html?}
  	<div class="page__tags-smd"></div>
	{/if}

  {* ########### Подкатегории (меню) перемещаем сюда в мобильной версии ########### *}
  {if $sub_categories_html?}
  	<div class="page__sub-categories-smd"></div>
	{/if}

  {* ########### Статьи (через связанные категории)  ########### *}
  {if $linked_articles_html?}
  	<div class="page__header page__header_category-articles page-header">Статьи</div>
  	{$linked_articles_html}
  {/if}
{/block}


{block 'sidebar'}
  {if ($filters_html && $products_html)}
  <div class="page__filter-mdu">
    <div id="mse2_mfilter" class="filter filter_side msearch2">
      <div class="filter__header">
        <div class="d-none d-md-block">
          <div class="filter__switcher filter__switcher_dsk" data-toggle="on" data-toggle-activate="1" data-toggle-effect="slide" data-toggle-target=".filter .mdl-body">Фильтры <i class="filter__switcher-status fal"></i></div>
        </div>
        <div class="d-md-none">
          <div class="filter__switcher filter__switcher_mob" data-backdrop="click" data-target=".filter_side" data-side="left" data-wrapper="backdrop_filter" data-title="Фильтр" data-type="self">Фильтры</div>
        </div>
      </div>
      <div class="filter__body">
        <form class="filter__form" action="{$id | url}" method="post" id="mse2_filters">
          <div class="filter__options">
            {$filters_html}
          </div>
          <div class="filter__controls form-row">
            <div class="col">
              <button class="filter__controls-btn btn btn-submit btn-main w-100" onclick="mSearch2.submit();return false;">Показать</button>
            </div>
            <div class="col">
              <button class="filter__controls-btn btn btn-reset btn-main btn-outline btn-h-red w-100" onclick="mSearch2.reset();return false;">Сбросить</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  {/if}

  {* {include 'menu_side'} *}

  {* ########### Подкатегории (меню) ########### *}
  {if $sub_categories_html?}
    <div class="page__sub-categories-mdu">
      {$sub_categories_html}
    </div>
  {/if}
{/block}


{block 'js'}
  <script>
  	spoiler_elems.init('.tags_top a', 1, 0, 1 ,'Показать все', 'Скрыть', 'tags__more');
		spoiler_elems.init('.tags_btm a', 1, 0, 1 ,'Показать все', 'Скрыть', 'tags__more');

		// фильтр и сортировка
  	// фильтр как аккордеон
    $('.filter').on('click', '.filter-option__head', function(e) {
      e.preventDefault();
      if ($(this).hasClass('active')) {
        $(this).removeClass('active');
        $(this).next('.filter-option__body').stop(true, false).slideToggle('fast'); //.next('.more_rows').hide();
      } else {
        $(this).addClass('active');
        $(this).next('.filter-option__body').stop(true, false).slideToggle('fast'); // .next('.more_rows').show();
      }
    });
    // фильтрация в бэкдропе
    $('#mse2_filters .filter__controls-btn').on('click', function(e) {
      if ($('body').find('.backdrop_content').length) {
        backdrop.close('left');
      }
    });
    // сортировка в бэкдропе
    $('.sorting__link').on('click', function(e) {
      if ($('body').find('.backdrop_content').length) {
        backdrop.close('left');
      }
    });

    // $('.filter_tag_link').on('click', function(e) {
    //   if ($('body').find('.backdrop_content').length) {
    //     backdrop.close('left');
    //   }
    // });
    // $('.btn-reset').on('click', function(e) {
    //   $('.filter_tag_link').removeClass('active');
    // });

    $(document).on('mse2_load', function(e, data) {
      // прокрутка до фильтра
      let offset_top = $('#mse2_results').offset().top; // plus|minus some height
      $('body,html').stop(true,false).animate({
        scrollTop: offset_top
      }, 300);
      // return false;

      // проставляем значения в фильтре
      // if (!Object.keys(mSearch2.getFilters()).length && Object.keys(mSearch2.Hash.get()).length > 0) {
      //   mSearch2.setFilters(mSearch2.Hash.get());
      // }
    });

    $('.filter-sorting_mob').scrollShowHide();
    let filter_sort_sticky_params = {
      mobileFirst : true,
      responsive: [
        {
          breakpoint: 767,
          settings: 'unsticky'
        }
      ]
    }
    $('.filter-sorting_mob').sticky(filter_sort_sticky_params);

    function resize_tpl(){
      $('.filter-option__head').each(function(i, el) {
        let $this = $(this);
        $this.next('.filter-option__body').is(':visible') ? $this.addClass('active') : $this.removeClass('active');
      });

      if ($(document).width() < 768){

        $('.filter-sorting_mob').sticky(filter_sort_sticky_params);

        // перемещаем фильтр
        // $('#mse2_mfilter').prependTo('.page__filter-smd');

        // перемещаем тэговые для текущей категории
        // if ($('.tags_sub').length && !$('.page__tags-smd').find('.tags_sub').length) {
        //   $('.tags_sub').prependTo('.page__tags-smd');
        // }

        // перемещаем категории
        // if ($('.sub-categories').length && !$('.page__sub-categories-smd').find('.sub-categories').length) {
        //   $('.sub-categories').prependTo('.page__sub-categories-smd');
        // }

      } else {

      	// перемещаем фильтр
        // $('#mse2_mfilter').prependTo('.page__filter-mdu');

      	// перемещаем тэговые для текущей категории
        // if ($('.tags_sub').length && !$('.page__tags-mdu').find('.tags_sub').length) {
        //   $('.tags_sub').prependTo('.page__tags-mdu');
        // }

      	// перемещаем подкатегории
        // if ($('.sub-categories').length && !$('.page__sub-categories-mdu').find('.sub-categories').length) {
        //   $('.sub-categories').prependTo('.page__sub-categories-mdu');
        // }

      }
    }

    resize_tpl();

    $(window).resize(function(e) {
      resize_tpl();
    });

  </script>
  {if $categories_view == 'slider'}
    <script src="/artmebius/js/catalog/categories_slider.min.js"></script>
  {/if}
{/block}