{block 'vars'}
  {insert 'vars'}
{/block}

{* template start *}
{block 'start'}
<!DOCTYPE html>
<html lang="ru" class="no-js">
  <head>
    {include 'head'}
    {block 'css'}
      {* сайт новый, правки вносим через SCSS *}
      {*
      {'MinifyX' | snippet : [
        'minifyCss'   => 1,
        'registerCss' => 'print',
        'cssSources'  =>'
          /artmebius/css/template_styles.css,
          /artmebius/css/template_custom.css,
          /assets/components/minishop2/css/web/lib/jquery.jgrowl.min.css,
          /assets/components/msearch2/css/web/jquery-ui/jquery-ui.min.css
        '
      ]}
      *}
      <link rel="stylesheet" href="/artmebius/css/template_styles.css">
      {* <link rel="stylesheet" href="/artmebius/css/template_custom.css"> *}
    {/block}
  </head>
<body>
{/block}
{block 'page'}
<div class="page page_inner{($page_class ?: 'page_article')|before:' '}">
{/block}
  {block 'header'}{include 'header'}{/block}
  {block 'page_sect_wrap'}
  <div id="page__sect-wrap" class="page__sect-wrap">
  {/block}
    {block 'breadcrumbs'}
    <section class="page__sect page__sect_breadcrumbs sect-md-1 container">{include 'breadcrumbs'}</section>
    {/block}
    {block 'sect_before_main'}{/block}
    {block 'top'}
    <div class="page__sect-container container">
      <div class="row">
        {if $show_sidebar == 1}
        <div class="page__sect page__sect_main sect-pb-xs-2 col-sm-12 col-md-8 order-md-2 col-lg-9">
        {else}
        <div class="page__sect page__sect_main sect-pb-xs-2 col-sm-12">
        {/if}
    {/block}
      {block 'widgets_before_main'}{/block}
      {block 'main'}
          <main class="article{($content_class ?: 'article_main')|before:' '}">
            {if $show_date == 1}
              <div class="article__date"><time datetime="{$publishedon | date : 'Y-m-d'}">{$publishedon | date : 'd.m.Y'}</time></div>
            {/if}
            {if $show_title == 1}
              <h1 class="article__header page-header">{$h1 ?: $pagetitle}</h1>
            {/if}
            {if $show_preview == 1 && $image}
              {set $article_img_params = '&w=1920&h=1080&aoe=1&bg=ffffff&f=jpg&q=90'}
              <div class="article__preview">
                <img class="article__img" src="{$image | phpthumbon : $article_img_params}" alt="{$pagetitle | clean : 'qq'}" {$image | img_size : 'attr'} fetchpriority="high" loading="eager">
              </div>
            {/if}
            <div class="article__content page-content">{($content != '' || !$empty_page) ? ($content | imageSlimExt : "phpthumbon=q=90") : 'Страница находится в разработке'}</div>
          </main>
      {/block}
      {block 'widgets_after_main'}{/block}
    {block 'bottom'}
        </div><!-- .page__sect_main -->
        {if $show_sidebar == 1}
        <aside class="page__sect page__sect_side sect-pb-xs-2 col-sm-12 col-md-4 order-md-1 col-lg-3">
          {block 'sidebar'}
            {include 'menu_side'}
          {/block}
        </aside>
        {/if}
      </div><!-- .row -->
    </div><!-- .page__sect-container -->
    {/block}
    {block 'sect_after_main'}{/block}
  {block 'page_sect_wrap_end'}
  </div><!-- .page__sect-wrap -->
  {/block}
  {block 'footer'}{include 'footer'}{/block}
{block 'page_end'}
</div><!-- .page -->
<div class="go2top"><span class="fal fa-chevron-up"></span></div>
<div id="recaptcha_badge"></div>
{/block}
{block 'popups'}
  {include 'popups'}
  {include 'orderProduct_modal'}
{/block}
{block 'js_common'}{include 'js'}{/block}
{block 'js'}{/block}
{block 'js_after'}
	<script>toggle_class_upd();</script>
  {if $cfg_counters}{$cfg_counters|ignore|lighthouse}{/if}
{/block}
{* {include 'dashboard'} *}
{block 'fin'}
</body>
</html>
{/block}