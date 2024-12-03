{* Modal orderProduct_modal start *}
<div class="modal fade" id="modal_order_product" tabindex="-1" role="dialog" aria-labelledby="modal_order_product_label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modal_order_product_label">Купить в 1 клик:</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        {'!AjaxForm' | snippet : [
         'snippet'                   => 'FormIt',
         'form'                      => 'one.click.order.form',
         'frontend_js'               => '/artmebius/js/ajaxForm.js',
         'frontend_css'              => '',
         'hooks'                     => 'reCAPTCHAv3check,msOneClickOrderSave,email,FormItAutoResponder',
         'clearFieldsOnSuccess'      => 1
         'placeholderPrefix'         => 'opf.',
         'submitVar'                 => 'orderProduct',
         'spamEmailFields'           => 'opf_email',

         'emailFrom'                 => $emailsender,
         'emailFromName'             => $site_name,
         'emailTo'                   => $emailsender,
         'emailSubject'              => 'Новый заказ товара в 1 клик',
         'emailTpl'                  => 'one.click.order.email',

         'fiarToField'               => 'opf_email',
         'fiarFrom'                  => $emailsender,
         'fiarFromName'              => $site_name,
         'fiarReplyTo'               => $emailsender,
         'fiarSubject'               => 'Вы сделали заказ в 1 клик в интернет-магазине',
         'fiarTpl'                   => 'one.click.order.email',

         'validationErrorMessage'    => 'В форме содержатся ошибки!',
         'customSuccessMessage'      => 'Заказ поступил в обработку. Наш менеджер свяжется с Вами в ближайшее время. Для нового заказа обновите страницу.',
         'opf_politic.vTextRequired' => 'Подтвердите, что Вы согласны с политикой конфиденциальности',
          'validate'=>'
            opf_name:required,
            opf_email:email:required,
            opf_phone:required:phoneValidator,
            opf_mess:stripTags,
            opf_blank_email:blank,
            opf_politic:required'
        ]}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-close btn-black" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
{* Modal end *}
{*
  'hooks'=>'msOneClickOrderSave' - minishop
  'hooks'=>'oneClickOrderSave' - shopkeeper
*}