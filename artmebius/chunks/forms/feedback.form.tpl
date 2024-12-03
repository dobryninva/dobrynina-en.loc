{set $name = ($_modx->user.fullname != '') ? $_modx->user.fullname : 'mcb.name' | placeholder}
{set $name_error = 'mcb.error.name' | placeholder}
{set $phone = ($_modx->user.phone != '') ? $_modx->user.phone : 'mcb.phone' | placeholder}
{set $phone_error = 'mcb.error.phone' | placeholder}
{set $email = ($_modx->user.email != '')  ? $_modx->user.email : 'mcb.email' | placeholder}
{set $email_error = 'mcb.error.email' | placeholder}
{set $mess = 'mcb.mess' | placeholder}
{set $mess_error = 'mcb.error.mess' | placeholder}
{set $politic = 'mcb.politic' | placeholder}
{set $politic_error = 'mcb.error.politic' | placeholder}
<form id="feedbackForm" name="feedbackForm" class="form-modal form-vertical" method="post" action="{$_modx->resource.id | url}" autocomplete="on">

  <div class="form-group{$name_error ? ' error' : ''}">
    {* <label class="form-label" for="mcb_name">Ваше имя: <span class="req">*</span></label> *}
    <div class="input-group">
      <span class="form-icon align-content-center"><span class="fal fa-user"></span></span>
      <input class="form-control" id="mcb_name" name="name" type="text" value="{$name}" placeholder="Имя" maxlength="100" size="100" />
    </div>
    <div class="error error_mcb_name">{$name_error}</div>
  </div>

  <div class="form-group{$phone_error ? ' error' : ''}">
    {* <label class="form-label" for="mcb_phone">Ваш телефон: <span class="req">*</span></label> *}
    <div class="input-group">
      <span class="form-icon align-content-center"><span class="fal fa-phone"></span></span>
      <input class="form-control" id="mcb_phone" name="phone" type="tel" value="{$phone}" placeholder="+7(___)___-__-__" maxlength="100" size="100" />
    </div>
    <div class="error error_mcb_phone">{$phone_error}</div>
  </div>

  <div class="form-group{$email_error ? ' error' : ''}">
    {* <label class="form-label" for="mcb_email">Ваш E-mail: <span class="req">*</span></label> *}
    <div class="input-group">
      <span class="form-icon align-content-center"><span class="fal fa-envelope"></span></span>
      <input class="form-control" id="mcb_email" name="email" type="email" value="{$email}" placeholder="E-mail" maxlength="100" size="100" />
    </div>
    <div class="error error_mcb_email">{$email_error}</div>
  </div>

  <div class="form-group{$mess_error ? ' error' : ''}">
    {* <label class="form-label d-xs-block d-md-none" for="mcb_mess">Сообщение: <span class="req">*</span></label> *}
    <div class="input-group">
      <span class="form-icon align-content-start"><span class="fal fa-comment"></span></span>
      <textarea class="form-control" name="mess" id="mcb_mess" placeholder="Оставьте здесь ваше сообщение или задайте вопрос *" rows="3" cols="100">{$mess}</textarea>
    </div>
    <div class="error error_mcb_mess">{$mess_error}</div>
  </div>

  <div class="form-group{$politic_error ? ' error' : ''}">
    <input type="hidden" name="politic[]" value="" />
    <div class="custom-control custom-checkbox">
      <input class="custom-control-input" id="mcb_politic" name="politic[]" type="checkbox" value="1" checked {$politic | FormItIsChecked : '1'}>
      <label class="custom-control-label" for="mcb_politic"> согласен с <a href="{10 | url}" target="_blank">политикой конфиденциальности</a></label>
    </div>
    <div class="error error_mcb_politic">{$politic_error}</div>
  </div>

  <div class="form-group control-group">
    <button type="submit" class="btn btn-main"><i class="fa fa-paper-plane"></i> Отправить</button> <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
  </div>

  <input type="hidden" name="token">
  <input type="hidden" name="action">
  <input type="hidden" name="feedback" value="1">
  <input style="display: none;" type="text" name="blank_email" value="" />
</form>
{if $customSuccessMessage}
<div class="custom_success_message" style="display: none;">
  {$customSuccessMessage}
</div>
{/if}