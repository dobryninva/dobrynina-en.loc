<section class="page-sect sect-consultation sect-xs-3">
  <div class="container">
    <div class="mdl consultation_form">
      <div class="row align-items-lg-center">
        <div class="consultation_text col-xs-12 col-sm-12 col-md-12 col-lg-8 col-xl-9">Связаться с нами или получить бесплатную консультацию просто</div>
        <div class="consultation_phone col-xs-12 col-sm-12 col-md-12 col-lg-4 col-xl-3">{$company_phones}</div>
      </div>
      {'!AjaxForm' | snippet : [
        'snippet'                   => 'FormIt',
        'form'                      => 'consultation.form',
        'frontend_js'               => '/artmebius/js/ajaxForm.js',
        'frontend_css'              => '',

        'placeholderPrefix'         => 'cns.',
        'hooks'                     => 'reCAPTCHAv3check,email',
        'submitVar'                 => 'consultation',
        'clearFieldsOnSuccess'      => 1,

        'emailTo'                   => $emailsender,
        'emailFrom'                 => $emailsender,
        'emailFromName'             => $site_name,
        'emailSubject'              => 'Новый запрос на консультацию',
        'emailTpl'                  => 'consultation.email',

        'validationErrorMessage'    => 'В форме содержатся ошибки!',
        'customSuccessMessage'      => 'Сообщение успешно отправлено! Наш менеджер свяжется с Вами в ближайшее время.',
        'validate'=>'
          cns_name:required,
          cns_phone:required:phoneValidator,
          cns_blank_email:blank,
        '
      ]}
      {*
        'cns_politic.vTextRequired' =>'Подтвердите, что Вы согласны с политикой конфиденциальности',
        'spamEmailFields'           => 'cns_email',
          cns_politic:required
      *}
    </div>
  </div>
</section>