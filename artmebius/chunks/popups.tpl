{'form_reviews_html' | placeholder}
{'form_auth_html' | placeholder}
{'modal_logout_html' | placeholder}
{* Modal modal_feedback start *}
<div class="modal fade" id="modal_feedback" tabindex="-1" role="dialog" aria-labelledby="modal_feedback_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modal_feedback_label">Обратная связь:</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        {'!AjaxForm' | snippet : [
          'snippet'                   => 'FormIt',
          'form'                      => 'feedback.form',
          'frontend_js'               => '/artmebius/js/ajaxForm.js',
          'frontend_css'              => '',

          'placeholderPrefix'         => 'mcb.',
          'hooks'                     => 'reCAPTCHAv3check,email',
          'submitVar'                 => 'feedback',

          'emailTo'                   => $emailsender,
          'emailFrom'                 => $emailsender,
          'emailFromName'             => $site_name,
          'emailSubject'              => 'Сообщение с формы обратной связи',
          'emailTpl'                  => 'feedback.email',

          'validationErrorMessage'    => 'В форме содержатся ошибки!',
          'customSuccessMessage'      => 'Сообщение успешно отправлено!',
          'mcb_politic.vTextRequired' => 'Подтвердите, что Вы согласны с политикой конфиденциальности',
          'validate'=>'
            name:required,
            email:email,
            phone:required:phoneValidator,
            mess:required:stripTags,
            politic:required,
            blank_email:blank'
        ]}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-black btn-sm btn-modal-close" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
{* Modal end *}
{* Modal modal_callback start *}
<div class="modal fade" id="modal_callback" tabindex="-1" role="dialog" aria-labelledby="modal_callback_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modal_callback_label">Заказать звонок:</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        {'!AjaxForm' | snippet : [
          'snippet'                   => 'FormIt',
          'form'                      => 'callback.form',
          'frontend_js'               => '/artmebius/js/ajaxForm.js',
          'frontend_css'              => '',

          'placeholderPrefix'         => 'ocb.',
          'hooks'                     => 'reCAPTCHAv3check,email',
          'submitVar'                 => 'callback',

          'emailTo'                   => $emailsender,
          'emailFrom'                 => $emailsender,
          'emailFromName'             => $site_name,
          'emailSubject'              => 'Заказ обратного звонка',
          'emailTpl'                  => 'callback.email',

          'validationErrorMessage'    => 'В форме содержатся ошибки!',
          'customSuccessMessage'      => 'Сообщение успешно отправлено!',
          'ocb_politic.vTextRequired' => 'Подтвердите, что Вы согласны с политикой конфиденциальности',
          'validate'=>'
            name:required,
            phone:required:phoneValidator,
            time:required,
            politic:required
            blank_email:blank',
        ]}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-black btn-sm btn-modal-close" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
{* Modal end *}
{* Modal modal_services_order start *}
<div class="modal fade" id="modal_services_order" tabindex="-1" role="dialog" aria-labelledby="modal_services_order_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modal_services_order_label">Заказ услуги:</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        {'!AjaxForm' | snippet : [
          'snippet'                  => 'FormIt',
          'form'                     => 'services.order.form',
          'frontend_js'              => '/artmebius/js/ajaxForm.js',
          'frontend_css'             => '',

          'placeholderPrefix'        => 'sof.',
          'hooks'                    => 'reCAPTCHAv3check,email',
          'submitVar'                => 'services_order',

          'emailTo'                  => $emailsender,
          'emailFrom'                => $emailsender,
          'emailFromName'            => $site_name,
          'emailSubject'             => 'Заказ услуги с сайта',
          'emailTpl'                 => 'services.order.email',

          'validationErrorMessage'   => 'В форме содержатся ошибки!',
          'customSuccessMessage'     => 'Сообщение успешно отправлено!',
          'validate'=>'
            name:required,
            email:email,
            phone:required:phoneValidator,
            mess:stripTags,
            blank_email:blank
          ',
        ]}
{*

          'fileValidatorExtensions'  => '.png, .jpg, .jpeg, .svg, .psd, .cdr, .eps, .ai',
          'fileValidatorMaxFileSize' => '10000000',
          'customValidators'         => 'fileValidator',
            design:fileValidator,
*}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-black btn-sm btn-modal-close" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
{* Modal end *}
{* Modal cities_choose start *}
<div class="modal fade" id="cities_choose" tabindex="-1" role="dialog" aria-labelledby="cities_choose_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-wide" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="cities_choose_label">Выберите город</span>
        <span class="btn-close fa fa-close" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        <div id="cities_modal">
          {* [exclude]{'cities' | chunk}[/exclude] *}
        </div>
      </div>
      <div class="modal-footer d-md-none">
        <button type="button" class="btn btn-black btn-sm" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
{* Modal end *}
{* Modal modal_message start *}
<div class="modal fade" id="modal_message" tabindex="-1" role="dialog" aria-labelledby="modal_message_label" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modal_message_label">Информация</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        <div id="modal_message_html"></div>
      </div>
      <div class="modal-footer d-md-none">
        <button type="button" class="btn btn-black btn-sm" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
{* Modal end *}
{* Modal modal_quick_view start *}
<div class="modal fade" id="modal_quick_view" tabindex="-1" role="dialog" aria-labelledby="modal_quick_view_label" aria-hidden="true">
  <div class="modal-dialog modal-product modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modal_quick_view_label">Быстрый просмотр</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        <div id="modal_quick_view_html"></div>
      </div>
      <div class="modal-footer d-md-none">
        <button type="button" class="btn btn-black btn-sm" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
{* Modal end *}
{* orderProduct_modal *}