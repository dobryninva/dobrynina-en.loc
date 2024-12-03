{* </div><!-- .page-top --> *}
<footer class="ftr">
  <div class="ftr__top">
    <div class="container">
      <div class="row">
        <div class="ftr__col ftr__col_company d-none d-md-block col-xl-3">
          <div class="ftr__logo logo">
            {$id != 1 ? '<a href="/" ' : '<span '}class="logo__link" title="{$site_name | clean : 'qq'}">
              <img class="logo__img" src="{$company_logo}" {$company_logo | img_size : "attr_width, attr_height"} alt="{$site_name | clean : 'qq'}">
            {$id != 1 ? '</a>' : '</span>'}
          </div>
          <div class="ftr__subscribe subscribe">
            {set $sendex_params = [
              'id'                => 1,
              'tplSubscribeGuest' => 'subscribe.guest',
              'tplSubscribeAuth'  => 'subscribe.auth',
              'tplUnsubscribe'    => 'subscribe.unsubscribe',
              'tplActivate'       => 'subscribe.email.activate',
              'resource_id'       => $rid
            ]}
            {'!SendexExt' | snippet : $sendex_params}
            <script>
              const subscribe_params = {$sendex_params|toJSON|ignore}
            </script>
          </div>
        </div>
        <div class="ftr__col ftr__col_info col-12 col-xl-2">
          <div class="ftr__menu ftr__menu_info">
            <div class="ftr__header" data-toggle="on" data-toggle-activate="1" data-toggle-target=".ftr__menu_info .ftr__menu-wrap" data-toggle-effect="slide">Информация <span class="toogle-icon d-md-none"></span></div>
            <div class="ftr__menu-wrap">
              {set $info_resources = '1,7,25,23,20'}
              {'pdoMenu' | snippet:[
                'select'      => '{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key"}',
                'resources'   => $info_resources,
                'parents'     => 0,
                'level'       => 0,
                'showHidden'  => 1,
                'sortby'      => 'FIELD(modResource.id, '~$info_resources~')',
                'sortdir'     => 'ASC',
                'tplOuter'    => 'menu.ul',
                'tpl'         => 'menu.li',
                'outerClass'  => 'menu menu_vert',
                'innerClass'  => 'menu__sub',
                'rowClass'    => 'menu__item',
                'selfClass'   => 'menu__item_current current',
                'parentClass' => 'menu__item_parent parent'
              ]}
            </div>
          </div>
        </div>
        <div class="ftr__col ftr__col_catalog col col-12 col-xl">
          <div class="ftr__menu ftr__menu_catalog">
            <div class="ftr__header" data-toggle="on" data-toggle-activate="1" data-toggle-target=".ftr__menu_catalog .ftr__menu-wrap" data-toggle-effect="slide">Каталог <span class="toogle-icon d-md-none"></span></div>
            <div class="ftr__menu-wrap">
              {'pdoMenu' | snippet:[
                'select'      => '{"modResource":"id,parent,pagetitle,menutitle,link_attributes,class_key"}',
                'parents'     => 7,
                'level'       => 1,
                'showHidden'  => 1,
                'where'       => '{"template:IN":[9]}',
                'sortby'      => 'menuindex',
                'sortdir'     => 'ASC',
                'tplOuter'    => 'menu.ul',
                'tpl'         => 'menu.li',
                'outerClass'  => 'menu menu_vert',
                'innerClass'  => 'menu__sub',
                'rowClass'    => 'menu__item',
                'selfClass'   => 'menu__item_current current',
                'parentClass' => 'menu__item_parent parent'
              ]}
            </div>
          </div>
        </div>
        <div class="ftr__col ftr__col_contacts col col-12 col-xl">
          <div class="ftr__contacts">
            <div class="ftr__header" data-toggle="on" data-toggle-activate="1" data-toggle-target=".ftr__contacts .ftr__contacts-wrap" data-toggle-effect="slide">Контакты <span class="toogle-icon d-md-none"></span></div>
            <div class="ftr__contacts-wrap">
              {if $company_phones_arr?}
              <div class="ftr__phones phones">
                {foreach $company_phones_arr as $row}
                  {if $row.in_ftr}
                  <div class="phones__row">
                    <a class="phones__link" href="tel:{$row.phone | clean : 'tel'}">{$row.phone}</a>
                  </div>
                  {/if}
                {/foreach}
              </div>
              {/if}
              {if $company_schedule_arr?}
              <div class="ftr__schedule schedule">
                <div class="schedule__header ftr__subtitle">Режим работы:</div>
                {foreach $company_schedule_arr as $row}
                  <div class="schedule__row">{$row.schedule}</div>
                {/foreach}
              </div>
              {/if}
              {if $company_address_arr?}
              <div class="ftr__address address">
                {foreach $company_address_arr as $row}
                  <div class="address__row">{$row | clean : ['case'=>'include', 'keys'=>['zip','city','address']] | join : ', '}</div>
                {/foreach}
              </div>
              {/if}
              {if $company_email?}
              <div class="ftr__email">
                <div class="ftr__email-header ftr__subtitle">Email:</div>
                <a class="ftr__email-link" href="mailto:{$company_email}">{$company_email}</a>
              </div>
              {/if}
              {if $social_links_html?}
              <div class="ftr__socials socials d-flex align-items-center">{$social_links_html}</div>
              {/if}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="ftr__btm">
    <div class="container">
      <div class="row">
        <div class="ftr__col col-sm-12 col-md-9 col-lg-9 col-xl-9">
          <div class="ftr__cprt">
            <p>&copy; {'' | date : 'Y'} Все права защищены. <a href="{10 | url}">Политика конфиденциальности</a></p>
          </div>
        </div>
        <div class="ftr__col col-sm-12 col-md-3 col-lg-3 col-xl-3">
          <div class="ftr__devby atrmebius"><p>{$ftr_links}</p></div>
        </div>
      </div>
    </div>
  </div>
</footer>