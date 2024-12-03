<!-- noindex --><!--[if lte IE 9]><div id="old_browser_warning" class="old_browser_warning"><p class="text-center">Вы используете устаревший браузер. Пожалуйста <a rel="nofollow" target="_blank" href="https://windows.microsoft.com/ru-ru/internet-explorer/download-ie">обновите ваш браузер</a> или <a rel="nofollow" target="_blank" href="https://browsehappy.com/">выберите альтернативный</a></p><span class="close_obw" onclick="document.getElementById('old_browser_warning').style.display = 'none';return false;">закрыть</span></div><![endif]--><!-- /noindex -->
{* <div class="page-top"> *}
  <header class="hdr">
    <div class="hdr__top">
      <div class="container">
        <div class="hdr__top-row d-md-flex justify-content-md-between align-items-md-center">
          <div class="hdr__logo logo">
            {$id != 1 ? '<a href="/" ' : '<span '}class="logo__link" title="{$site_name | clean : 'qq'}">
              <img class="logo__img" src="{$company_logo}" {$company_logo | img_size : "attr_width, attr_height"} alt="{$site_name | clean : 'qq'}">
            {$id != 1 ? '</a>' : '</span>'}
          </div>
          <div class="hdr__slogan slogan">{$company_slogan}</div>
          {if $company_phones_arr?}
          <div class="hdr__phones phones">
            {foreach $company_phones_arr as $row}
              {if $row.in_hdr}
              <div class="phones__row">
                <a class="phones__link" href="tel:{$row.phone | clean : 'tel'}">{$row.phone}</a>
              </div>
              {/if}
            {/foreach}
          </div>
          {/if}
          <div class="hdr__login login">
            {'!Login' | snippet : [
              'tplType'   => 'modChunk',
              'loginTpl'  => 'auth.login',
              'logoutTpl' => 'auth.logout',
            ]}
          </div>
          <div class="hdr__top-group">
            {'!favorite' | snippet : ['task'=>'init']}
            {set $hdr_favorite_html}
              <div class="hdr__favorite{(('favorite.count' | placeholder) > 0) ? ' active' : ''}">
                <a class="hdr__favorite-link" href="{18 | url}" title="Избранное">
                  <span class="hdr__favorite-icon favorite_icon fal fa-heart"></span>
                  <span class="hdr__favorite-count favorite_count">{'favorite.count' | placeholder}</span>
                </a>
              </div>
            {/set}
            {$hdr_favorite_html}
            {set $hdr_compare_html = '!getComparison' | snippet : [
              'list_id'=>19,
              'tpl'=>'comparison.get'
            ]}
            {$hdr_compare_html}
            {'!msMiniCart' | snippet : [
              'tpl' => 'cart.mini'
            ]}
          </div>
          <div class="hdr__callback d-none d-md-block">
            <span class="hdr__callback-btn btn btn-main" data-target="#modal_callback" data-toggle="modal">Оставить заявку</span>
          </div>
        </div>
      </div>
    </div>
    <div class="hdr__btm">
      <div class="container">
        <div class="hdr__btm-row d-flex justify-content-sm-between align-items-sm-center">
          <nav class="hdr__menu hdr__menu_main">
            <div class="hdr__menu-switcher menu_hide_sm d-md-none">
              <a class="hdr__menu-switcher-link" href="{$_modx->resource.id | url}" rel="nofollow" data-backdrop="click" data-target=".menu_main" data-side="right">
                <span class="hdr__menu-switcher-link-title">Меню</span><span class="hdr__menu-switcher-link-icon fal fa-align-justify"></span>
              </a>
            </div>
            {'pdoMenu' | snippet : [
              'select'      => '{"modResource":"id,parent,template,menuindex,pagetitle,menutitle,link_attributes,class_key,content"}',
              'parents'     => 0,
              'level'       => 10,
              'showHidden'  => 0,
              'sortby'      => 'menuindex',
              'sortdir'     => 'ASC',
              'tplOuter'    => 'menu.ul',
              'tpl'         => 'menu.li',
              'outerClass'  => 'menu menu_main menu_flex',
              'innerClass'  => 'menu__sub',
              'rowClass'    => 'menu__item',
              'selfClass'   => 'menu__item_current current',
              'parentClass' => 'menu__item_parent parent'
            ]}
          </nav>
          <div class="hdr__search-form">
            {'!mSearchForm' | snippet : [
              'element'       => 'msProducts',
              'tplForm'       => 'msearch.form',
              'tpl'           => 'msearch.tips.row',
              'pageId'        => 6,
              'where'         => '{"Data.price:>":0}'
            ]}
          </div>
        </div>
      </div>
    </div>
    <div class="hdr__xs d-md-none">
      <div class="container d-flex align-items-center justify-content-center">
        <div class="hdr__xs-row">
          <div class="hdr__xs-switcher hdr__xs-switcher_menu">
            <span class="hdr__xs-switcher-btn" data-backdrop="click" data-target=".menu_main .menu" data-side="left">
              <span class="hdr__xs-switcher-btn-icon fal fa-bars"></span>
            </span>
          </div>
          {$hdr_favorite_html}
          {$hdr_compare_html}
          <div class="hdr__xs-switcher hdr__xs-switcher_search">
            <span class="hdr__xs-switcher-btn" data-backdrop="click" data-type="self" data-target=".hdr_search .search_form" data-side="left">
              <span class="hdr__xs-switcher-btn-icon fal fa-search"></span>
            </span>
          </div>
          <div class="hdr__xs-switcher hdr__xs-switcher_phones">
            <span class="hdr__xs-switcher-btn" data-backdrop="click" data-target=".hdr_phones,.hdr_social_links" data-side="left">
              <span class="hdr__xs-switcher-btn-icon fal fa-phone"></span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </header>