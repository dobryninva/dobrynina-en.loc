{* vars *}
{set $id = $_modx->resource.id}
{set $parent = $_modx->resource.parent}
{set $template = $_modx->resource.template}
{set $pagetitle = $_modx->resource.pagetitle}
{set $longtitle = $_modx->resource.longtitle}
{set $menutitle = $_modx->resource.menutitle}
{set $introtext = $_modx->resource.introtext}
{set $content = $_modx->resource.content}

{set $metaDescription = $_modx->resource.metaDescription}
{set $metaKeywords = $_modx->resource.metaKeywords}
{set $metaRobots = $_modx->resource.metaRobots}

{var $ts = ''|time}
{set $deadline = $_modx->resource.deadline ?: ($ts + 60*53*22) | date_format : '%Y-%m-%d %H:%M:%S'}

{set $site_name = 'site_name' | option}
{set $site_url = 'site_url' | option}
{set $company_logo = 1 | resource : 'company_logo'}
{* tpl *}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ru" class="no-js">

  <head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>Сайт {$site_url} находится в разработке</title>
    <meta name="description" content="Сайт {$site_url} находится в разработке и скоро будет доступен" />
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <meta name="keywords" content="" />
    {if $metaRobots != 'нет'}
      <meta name="robots" content="{$metaRobots}" />
    {/if}
    <link rel="shortcut icon" type="image/ico" href="favicon.ico">
    <link rel="stylesheet" href="/artmebius/css/unpage_styles.css">
  </head>

  <body>

    <div id="wrap" class="unpage">
      <header id="hdr" class="hdr">
        <div class="container">
          {if $company_logo}
          <div class="hdr_logo">
            <a href="/" class="hdr_logo_link" title="{$site_name | clean : 'qq'}">
              <img src="{$company_logo}" height="50" alt="{$site_name | clean : 'qq'}">
            </a>
          </div>
          {/if}

          <div class="hdr_title title_logo">
            <h1 class="hdr_title_h1 page-header">Сайт <span>{$site_name}</span> находится в разработке и скоро будет доступен.</h1>
          </div>

          <div class="hdr_desc page-desc">{$content ?: 'На сайте ведутся работы'}</div>

        </div>
      </header>

      <section class="sect_clock">
        <div class="container">
          <div class="mdl_clock">

            <div class="mdl-header page-header">До запуска сайта осталось:</div>
            <div class="mdl-body time clockdiv">
              <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="count_time">
                    <p class="text_time day"></p>
                  </div>
                  <div class="units">день</div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="count_time">
                    <p class="text_time hours"></p>
                  </div>
                  <div class="units">час</div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="count_time">
                    <p class="text_time minutes"></p>
                  </div>
                  <div class="units">мин</div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="count_time">
                    <p class="text_time seconds"></p>
                  </div>
                  <div class="units">сек</div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>

      <footer id="ftr" class="ftr">
        <div class="container">
          <div class="ftr_cprt mdl cprt tac"><p>© {'' | date_format : '%Y'} разработка и продвижение сайтов web-студия <a target="_blank" title="Создание и продвижение сайтов" href="https://artmebius.com">Artmebius</a>. г. Нижний Новгород</p></div>
        </div>
      </footer>
    </div>

    <script src="/artmebius/js/modernizr.min.js"></script>
    <script src="/artmebius/js/jquery.min.js"></script>
    <script src="/artmebius/js/jquery.easing.min.js"></script>
    <script src="/artmebius/js/bootstrap.pack.min.js"></script>
    <script src="/artmebius/js/jquery.maskedinput.min.js"></script>
    <script src="/artmebius/js/jquery.clock.js"></script>

    <script>
      let deadline = '{$deadline}';
      initializeClock('.clockdiv', deadline);
      // console.log(deadline);
      {ignore}

      var body = document.body,
          startX = -100,
          startY = -100,
          w = document.documentElement.offsetWidth,
          h = document.documentElement.offsetHeight;

      body.addEventListener('mousemove', function(evt){
        var posX = Math.round(evt.clientX / w * startX)
        var posY = Math.round(evt.clientY / h * startY)
        body.style.backgroundPosition = posX + 'px ' + posY + 'px'
      });
      {/ignore}
    </script>
  </body>
</html>