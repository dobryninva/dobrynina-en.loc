{* fields *}
{set $id          = $_modx->resource.id}
{set $uri         = $_modx->resource.uri}
{set $parent      = $_modx->resource.parent}
{set $template    = $_modx->resource.template}
{set $pagetitle   = $_modx->resource.pagetitle}
{set $longtitle   = $_modx->resource.longtitle}
{set $menutitle   = $_modx->resource.menutitle}
{set $introtext   = $_modx->resource.introtext}
{set $content     = $_modx->resource.content}
{set $class_key   = $_modx->resource.class_key}
{set $publishedon = $_modx->resource.publishedon}
{* seo *}
{set $metaDescription          = $_modx->resource.metaDescription}
{set $metaKeywords             = $_modx->resource.metaKeywords}
{set $metaRobots               = $_modx->resource.metaRobots}
{set $h1                       = $_modx->resource.h1}
{set $cfg_counters             = 'counters' | option}
{set $yandex_verification      = ('yandex-verification' | option) ?: ''}
{set $google_site_verification = ('google-site-verification' | option) ?: ''}
{* Настройки отображения *}
{set $empty_page = 1}
{set $show_sidebar        = 1} {* ($_modx->resource.show_sidebar != '') ? $_modx->resource.show_sidebar : 0 *}
{set $show_title          = ($_modx->resource.show_title != '') ? $_modx->resource.show_title : 1}
{set $show_date           = ($_modx->resource.show_date != '') ? $_modx->resource.show_date : 0}
{set $show_preview        = ($_modx->resource.show_preview != '') ? $_modx->resource.show_preview : 0}
{set $show_spoiler        = ($_modx->resource.show_spoiler != '') ? $_modx->resource.show_spoiler : 0}
{set $items_per_row_xl = $_modx->resource.items_per_row_xl ?: 4}
{set $items_per_row_lg = $_modx->resource.items_per_row_lg ?: 3}
{set $items_per_row_md = $_modx->resource.items_per_row_md ?: 3}
{set $items_per_row_sm = $_modx->resource.items_per_row_sm ?: 2}
{set $items_per_row_xs = $_modx->resource.items_per_row_xs ?: 1}
{* cfg *}
{set $prds_per_row_xs     = 'prds_per_row_xs' | option}
{set $prds_per_row_sm     = 'prds_per_row_sm' | option}
{set $prds_per_row_md     = 'prds_per_row_md' | option}
{set $prds_per_row_lg     = 'prds_per_row_lg' | option}
{set $prds_per_row_xl     = 'prds_per_row_xl' | option}
{set $prds_preview_width  = 'prds_preview_width' | option}
{set $prds_preview_height = 'prds_preview_height' | option}
{set $prds_preview_zc     = 'prds_preview_zc' | option}
{set $prds_watermark      = 'prds_preview_wm' | option}
{set $prds_limit          = 'prds_limit' | option}
{set $photo_per_row_xl    = 'photo_per_row_xl' | option}
{set $photo_per_row_lg    = 'photo_per_row_lg' | option}
{set $photo_per_row_md    = 'photo_per_row_md' | option}
{set $photo_per_row_sm    = 'photo_per_row_sm' | option}
{set $photo_per_row_xs    = 'photo_per_row_xs' | option}
{set $images_row_class = 'row-cols-xs-'~$photo_per_row_xs~' row-cols-sm-'~$photo_per_row_sm~' row-cols-md-'~$photo_per_row_md~' row-cols-lg-'~$photo_per_row_lg~' row-cols-xl-'~$photo_per_row_xl}
{* pagination *}
{set $pagination_params = [
  'tplPageFirst'      => '@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-double-left"></span></a></li>',
  'tplPageFirstEmpty' => '@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-double-left"></span></a></li>',
  'tplPageLast'       => '@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-double-right"></span></a></li>',
  'tplPageLastEmpty'  => '@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-double-right"></span></a></li>',
  'tplPageNext'       => '@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-right"></span></a></li>',
  'tplPageNextEmpty'  => '@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-right"></span></a></li>',
  'tplPagePrev'       => '@INLINE <li class="page-item"><a class="page-link" href="{$href}"><span class="fal fa-angle-left"></a></span></li>',
  'tplPagePrevEmpty'  => '@INLINE <li class="page-item disabled"><a class="page-link" href="#"><span class="fal fa-angle-left"></span></a></li>'
]}
{* плэйсхолдеры *}
{set $rid = (('rid' | placeholder) != '') ? ('rid' | placeholder) : $id}
{* системные *}
{set $emailsender = (('mail_use_smtp' | option) == 1) ? ('mail_smtp_user' | option) : ('emailsender' | option)}
{set $site_name   = 'site_name' | option}
{set $site_url    = 'site_url' | option}
{* Изображения *}
{set $img_dir = '/images/'}
{set $image = $_modx->resource.image}
{* svg *}
{insert 'svg'}
{* контакты *}
{set $company_logo         = 1 | resource : 'company_logo'}
{set $company_slogan       = 1 | resource : 'company_slogan'}
{set $company_email        = (1 | resource : 'company_email') ?: $emailsender}
{set $company_address_arr  = 1 | resource : 'company_address' | fromJSON}
{set $company_phones_arr   = 1 | resource : 'company_phones' | fromJSON}
{set $company_schedule_arr = 1 | resource : 'company_schedule' | fromJSON}
{set $social_links_arr     = 1 | resource : 'social_links' | fromJSON}
{if $social_links_arr?}
  {set $social_links_html}
    {foreach $social_links_arr as $row}
      {set $target = (!($row.icon in ['whatsapp','viber'])) ? 'target="_blank"' : ''}
      {if $row.link != ''}
        <div class="socials__item">
          {switch $row.icon}
            {case 'telegram'}
            {case 'telegram-plane'}
              <a class="socials__link socials__link_{$row.icon}" href="https://t.me/+{$row.link}" title="{$row.title}" {$target} rel="nofollow">
                <i class="socials__icon fab fa-{$row.icon}"></i>
                <span class="socials__text d-md-none">{$row.title}</span>
              </a>
            {case 'whatsapp'}
              <a class="socials__link socials__link_{$row.icon}" href="whatsapp://send?phone={$row.link}" title="{$row.title}" {$target} rel="nofollow">
                <i class="socials__icon fab fa-{$row.icon}"></i>
                <span class="socials__text d-md-none">{$row.title}</span>
              </a>
            {case 'viber'}
              <a class="socials__link socials__link_{$row.icon} d-block d-md-none" href="viber://add?number={$row.link|clean:'viber'}" title="{$row.title}" {$target} rel="nofollow">
                <i class="socials__icon fab fa-{$row.icon}"></i>
                <span class="socials__text d-md-none">{$row.title}</span>
              </a>
              <a class="socials__link socials__link_{$row.icon} d-none d-md-block" href="viber://chat?number={$row.link}" title="{$row.title}" {$target} rel="nofollow">
                <i class="socials__icon fab fa-{$row.icon}"></i>
                <span class="socials__text d-md-none">{$row.title}</span>
              </a>
            {case default}
              <a class="socials__link socials__link_{$row.icon}" href="{$row.link}" title="{$row.title}" {$target} rel="nofollow">
                <i class="socials__icon fab fa-{$row.icon}"></i>
                <span class="socials__text d-md-none">{$row.title}</span>
              </a>
          {/switch}
        </div>
      {/if}
    {/foreach}
  {/set}
{/if}
{* виджеты глобальные *}
{set $ftr_copyright       = 1 | resource : 'ftrCopyright'}
{set $ftr_links           = 1 | resource : 'ftrLinks'}

{* Настройки отображения *}
{*
{set $resources_per_page = ($_modx->resource.resources_per_page != '') ? $_modx->resource.resources_per_page : 0}
{set $sortby = $_modx->resource.sortby}
{set $sortdir = $_modx->resource.sortdir}
{set $resources_view = $_modx->resource.resources_view}
{set $show_title = ($_modx->resource.show_title != '') ? $_modx->resource.show_title : 1}
{set $title_length = $_modx->resource.title_length ?: 200}
{set $show_date = ($_modx->resource.show_date != '') ? $_modx->resource.show_date : 0}
{set $show_intro = ($_modx->resource.show_intro != '') ? $_modx->resource.show_intro : 1}
{set $intro_length = $_modx->resource.intro_length ?: 200}
{set $show_spoiler = ($_modx->resource.show_spoiler != '') ? $_modx->resource.show_spoiler : 0}
{set $show_more = ($_modx->resource.show_more != '') ? $_modx->resource.show_more : 0}
{set $show_preview = ($_modx->resource.show_preview != '') ? $_modx->resource.show_preview : 0}
{set $preview_width = $_modx->resource.preview_width}
{set $preview_height = $_modx->resource.preview_height}
{set $preview_zc = $_modx->resource.preview_zc}
{set $includeTVs = $_modx->resource.includeTVs ? $_modx->resource.includeTVs : 'image'}
*}
{* Настройки отображения про *}
{*
{set $page_class = $_modx->resource.page_class}
{set $content_class = $_modx->resource.content_class}
{set $items_class = $_modx->resource.items_class}
{set $custom_script = $_modx->resource.custom_script}
 *}