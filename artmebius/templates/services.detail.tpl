{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 1} *}
{/block}

{block 'page'}
<div id="page" class="page page_inner page_service">
{/block}

{block 'main'}
  <main class="services{$content_class ?: ' services_main'}">
    <div id="service_detail" class="content service_detail">

      <h1 class="page-header">{$pagetitle}</h1>

      <div class="service_order d-lg-flex align-items-lg-center">
        <div class="service_order_price">
          <span class="service_order_price_value">{$price | num_format}</span>
          <span class="service_order_price_currency">руб.</span>
        </div>
        <div class="service_order_btn">
          <a href="{$id | url}" class="btn btn-main btn-h-red" data-toggle="modal" data-target="#modal_services_order" data-rid="{$rid}" data-pagetitle="{$pagetitle}" data-price="{$price}">Заказать</a>
        </div>
      </div>

      {if $content}
      <div class="page-content">{$content | imageSlimExt : "phpthumbon=q=90"}</div>
      {/if}

      {*
      <!--noindex-->
      <div class="d-md-none"><a href="{$id | url}#sect-consultation" data-target="#sect-consultation" class="btn btn-red-grad go-to-consultaion" rel="nofollow">Записаться на услугу<i class="fa-right-side fal fa-long-arrow-down"></i></a></div>
      <!--/noindex -->
      *}
    </div>
  </main>
{/block}
{*
{block 'sect_after_main'}
  <section id="sect-consultation" class="page-sect sect-consultation sect-light-grad sect-xs-2 sect-md-3 sect-xl-6">
    <div class="container">
      <div class="mdl consultation_form">
        {'!AjaxForm' | snippet : [
          'snippet'                => 'FormIt',
          'form'                   => 'services.form',
          'frontend_js'            => '/artmebius/js/ajaxForm.js',
          'frontend_css'           => '',

          'placeholderPrefix'      => 'srv.',
          'hooks'                  => 'reCAPTCHAv3check,email',
          'submitVar'              => 'services',
          'clearFieldsOnSuccess'   => 1,

          'emailTo'                => $emailsender,
          'emailFrom'              => $emailsender,
          'emailSubject'           => 'Новая заявка на услугу - '~$pagetitle~' ("'~$site_name~'")',
          'emailTpl'               => 'services.email',

          'validationErrorMessage' => 'В форме содержатся ошибки!',
          'customSuccessMessage'   => 'Сообщение успешно отправлено! Наш менеджер свяжется с Вами в ближайшее время.',
          'validate'               => '
            srv_service:required,
            srv_name:required,
            srv_phone:required:phoneValidator,
            srv_blank_email:blank
          '
        ]}
      </div>
    </div>
  </section>
  <section class="page-sect sect-contacts sect-xs-3 sect-md-3">
    <div class="container">
      {include 'contacts'}
    </div>
  </section>
{/block}
*}