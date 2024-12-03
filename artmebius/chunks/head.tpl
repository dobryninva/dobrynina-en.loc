<meta charset="utf-8">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
{if $.get.page < 2}
  <title>{$longtitle ?: $st_title ?: $pagetitle}</title>
  <base href="{$site_url}">
  {if $metaDescription != '' || $st_description != ''}
    <meta name="description" content="{($metaDescription ?: $st_description) | clean : 'qq'}">
  {/if}
{else}
  <title>{$h1 ?: $pagetitle}{'!seo_pagination' | snippet}</title>
  <base href="{$site_url}">
  <meta name="description" content="{($h1 ?: $pagetitle) | clean : 'qq'}{'!seo_pagination' | snippet}">
{/if}
{$yandex_verification}
{$google_site_verification}
{if $metaKeywords != '' || $st_keywords != ''}
  <meta name="keywords" content="{($metaKeywords ?: $st_keywords) | clean : 'qq'}">
{/if}
{if $metaRobots != 'нет'}
  <meta name="robots" content="{$metaRobots}">
{/if}
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
{'!canonicalExt' | snippet}
{* ########### разметка opengraf ########### *}
{*
<meta property="og:locale" content="ru_RU">
<meta property="og:title" content="{($longtitle ?: $st_title ?: $pagetitle) | clean : 'qq'}">
{if  $metaDescription != '' || $st_description != ''}<meta property="og:description" content="{($metaDescription ?: $st_description) | clean : 'qq'}">{/if}
<meta property="og:url" content="{($id) | url : ['scheme' => 'full']}">
<meta property="og:site_name" content="{$site_name | clean : 'qq'}">
{switch $template}
  {case '10'}
  <meta property="og:type" content="product">
  {case '2'}
  <meta property="og:type" content="article">
  {case default}
  <meta property="og:type" content="website">
{/switch}
{if $og_image}
  <meta property="og:image" content="{$site_url}{$og_image | replace : '/images' : 'images'}">
{else}
  <meta property="og:image" content="{$site_url}{$company_logo}">
{/if}
*}
{* ########### создаём фавикон https://realfavicongenerator.net/ ########### *}
{*
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="manifest" href="/site.webmanifest">
<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
<meta name="msapplication-TileColor" content="#ffc40d">
<meta name="theme-color" content="#ffffff">
*}
{* ########### рекомендации для pagespeed ########### *}
{*
<link rel="preload" as="script" href="/путь/к/файлу/скрипта.js">
<link rel="preload" href="/artmebius/fonts/font.woff2" as="font" type="font/woff2" crossorigin>
*}
<link rel="preload" href="/artmebius/fonts/fa-regular-400.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/artmebius/fonts/fa-solid-900.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/artmebius/fonts/fa-brands-400.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="/artmebius/fonts/fa-light-300.woff2" as="font" type="font/woff2" crossorigin>
{* ########### скорость работы сайта для админа ########### *}
{if $_modx->user.id == 1}
  {set $info = $_modx->getInfo('', false)}
  <meta name="cache" content="{$info.source}, {$info.queryTime}, {$info.queries}, {$info.phpTime}, {$info.totalTime}">
{/if}

{* <base href="{'!baseSiteUrl' | snippet}"> + link_tag_scheme сменить на abs (для поддоменов или вообще) *}
{* {'!msOptionsPrice.initialize' | snippet} *}
{* {'!addLooked' | snippet : ['templates'=>10, 'limit'=>8]} *}