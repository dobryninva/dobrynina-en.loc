{set $emailsender = 'emailsender' | option}
{set $site_name = 'site_name' | option}
<div class="form-header">Дизайн и пошив штор любой сложности</div>
{'!AjaxForm' | snippet : [
  'snippet'                   =>'FormIt',
  'form'                      =>'tekstil_na_zakaz_form',
  'frontend_js'               =>'/artmebius/js/ajaxForm.js',
  'frontend_css'              =>'',
  'hooks'                     =>'reCAPTCHAv3check,spam,email',
  'clearFieldsOnSuccess'      =>1
  'placeholderPrefix'         =>'tnz.',
  'submitVar'                 =>'tekstilNaZakaz',
  'spamEmailFields'           =>'tnz_email',

  'emailFrom'                 =>$emailsender,
  'emailTo'                   =>$emailsender,
  'emailSubject'              =>'Заказ обратного звонка - дизайн и пошив штор любой сложности ("'~$site_name~'")',
  'emailTpl'                  =>'tekstil_na_zakaz_email',

  'tnz_politic.vTextRequired' =>'Подтвердите, что Вы согласны с политикой конфиденциальности',
  'validationErrorMessage'    =>'В форме содержатся ошибки!',
  'customSuccessMessage'      =>'Сообщение успешно отправлено! Наш менеджер свяжется с Вами в ближайшее время.',
  'validate'=>'
    tnz_name:required,
    tnz_phone:required:phoneValidator,
    tnz_blank_email:blank,
    tnz_politic:required'
]}