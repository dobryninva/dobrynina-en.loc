{'!AjaxForm' | snippet : [
  'snippet'                     => 'FormIt',
  'form'                        => 'checkout.form',
  'frontend_js'                 => '/artmebius/js/ajaxCheckout.js',
  'frontend_css'                => '',
  'hooks'                       => 'spam,shk_fihook,email,FormItAutoResponder',
  'customValidators'            => 'deliveryCheck,paymentBeznalCheck',
  'placeholderPrefix'           => 'check.',
  'submitVar'                   => 'checkoutVar',

  'emailTo'                     => $emailsender,
  'emailFrom'                   => $emailsender,
  'emailSubject'                => 'В интернет-магазине "'~$site_name~'" сделан новый заказ',
  'emailTpl'                    => 'checkout.email',

  'fiarToField'                 => 'email',
  'fiarFrom'                    => $emailsender,
  'fiarReplyTo'                 => $emailsender,
  'fiarSubject'                 => 'Вы сделали заказ в интернет-магазине "'~$site_name~'"',
  'fiarTpl'                     => 'checkout.email',

  'check_politic.vTextRequired' => 'Подтвердите, что Вы согласны с политикой конфиденциальности',
  'validationErrorMessage'      => 'В форме содержатся ошибки!',
  'customSuccessMessage'        => 'Заказ успешно оформлен! Письмо с подробностями заказа было отправлено на указанный Вами e-mail.'
  'validate'=>'
    fullname:required,
    email:required:email,
    phone:required,
    shk_delivery:required,
    payment:required,
    address:deliveryCourierCheck,
    organization:paymentBeznalCheck,
    inn_kpp:paymentBeznalCheck,
    check_politic:required',
]}
{*
'customValidators'=>'faceCheck',
'validate'=>'
  organization:faceCheck,
  inn_kpp:faceCheck,
'
*}