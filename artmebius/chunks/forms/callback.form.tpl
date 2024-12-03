{set $name = ($_modx->user.fullname != '') ? $_modx->user.fullname : 'ocb.name' | placeholder}
{set $name_error = 'ocb.error.name' | placeholder}
{set $phone = ($_modx->user.phone != '') ? $_modx->user.phone : 'ocb.phone' | placeholder}
{set $phone_error = 'ocb.error.phone' | placeholder}
{set $time = 'ocb.time' | placeholder}
{set $time_error = 'ocb.error.time' | placeholder}
{set $politic = 'ocb.politic' | placeholder}
{set $politic_error = 'ocb.error.politic' | placeholder}
<form id="callbackForm" name="callbackForm" class="form-modal form-vertical" method="post" action="{$_modx->resource.id | url}" autocomplete="on">

  <div class="form-group{$name_error ? ' error' : ''}">
    {* <label class="form-label" for="ocb_name">Ваше имя: <span class="req">*</span></label> *}
    <div class="input-group">
      <span class="form-icon align-content-center"><span class="fal fa-user"></span></span>
      <input class="form-control" id="ocb_name" name="name" type="text" value="{$name}" placeholder="Имя *" maxlength="100" size="100" />
    </div>
    <div class="error error_ocb_name">{$name_error}</div>
  </div>

  <div class="form-group{$phone_error ? ' error' : ''}">
    {* <label class="form-label" for="ocb_phone">Ваш телефон: <span class="req">*</span></label> *}
    <div class="input-group">
      <span class="form-icon align-content-center"><span class="fal fa-phone"></span></span>
      <input class="form-control" id="ocb_phone" name="phone" type="tel" value="{$phone}" placeholder="+7(___)___-__-__" maxlength="100" size="100" />
    </div>
    <div class="error error_ocb_phone">{$phone_error}</div>
  </div>

  <div class="form-group{$time_error ? ' error' : ''}">
    {* <label class="form-label" for="ocb_time">Удобное время для звонка: <span class="req">*</span></label> *}
    <div class="input-group">
      <span class="form-icon align-content-center"><span class="fal fa-clock"></span></span>
      <input class="form-control" id="ocb_time" name="time" type="text" value="{$time}" placeholder="Удобное время для звонка" maxlength="100" size="100" />
    </div>
    <div class="error error_ocb_time">{$time_error}</div>
  </div>

  <div class="form-group{$politic_error ? ' error' : ''}">
    <input type="hidden" name="politic[]" value="" />
    <div class="custom-control custom-checkbox">
      <input class="custom-control-input" id="ocb_politic" name="politic[]" type="checkbox" value="1" {* checked *} {$politic | FormItIsChecked : '1'}>
      <label class="custom-control-label" for="ocb_politic"> согласен с <a href="{10 | url}" target="_blank">политикой конфиденциальности</a></label>
    </div>
    <div class="error error_ocb_politic">{$politic_error}</div>
  </div>

  <div class="form-group control-group">
    <button type="submit" class="btn btn-main"><i class="fa fa-phone"></i> Заказать обратный звонок</button>
    <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
  </div>

  <input type="hidden" name="token">
  <input type="hidden" name="action">
  <input type="hidden" name="callback" value="1">
  <input style="display: none;" type="text" name="blank_email" value="" />
</form>
{if $customSuccessMessage}
<div class="custom_success_message" style="display: none;">
  {$customSuccessMessage}
</div>
{/if}