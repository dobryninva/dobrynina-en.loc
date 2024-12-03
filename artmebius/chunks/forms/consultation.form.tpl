{set $name = ($_modx->user.fullname != '') ? $_modx->user.fullname : 'cns.cns_name' | placeholder}
{set $name_error = 'cns.error.cns_name' | placeholder}
{set $phone = ($_modx->user.phone != '') ? $_modx->user.phone : 'cns.cns_phone' | placeholder}
{set $phone_error = 'cns.error.cns_phone' | placeholder}
{set $politic = 'cns.cns_politic' | placeholder}
{set $politic_error = 'cns.error.cns_politic' | placeholder}
<form id="consultationForm" name="consultationForm" class="form-modal form-grid" method="post" action="{$_modx->resource.id | url}" autocomplete="on">

  <div class="row form-row">
    <div class="col-sm-12 col-md-6">
      <div class="form-group{$name_error ? ' error' : ''}">
        <label class="form-label" for="cns_name">Ваше имя: <span class="req">*</span></label>
        <div class="input-group">
          {* <span class="form-icon align-content-center"><span class="fa fa-user"></span></span> *}
          <input class="form-control" id="cns_name" name="cns_name" type="text" value="{$name}" placeholder="Имя *" maxlength="100" size="100" />
        </div>
        <div class="error error_cns_name">{$name_error}</div>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-group{$phone_error ? ' error' : ''}">
        <label class="form-label" for="cns_phone">Ваш телефон: <span class="req">*</span></label>
        <div class="input-group">
          {* <span class="form-icon align-content-center"><span class="fa fa-phone"></span></span> *}
          <input class="form-control" id="cns_phone" name="cns_phone" type="tel" value="{$phone}" placeholder="+7(___)___-__-__" maxlength="100" size="100" />
        </div>
        <div class="error error_cns_phone">{$phone_error}</div>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-group{$politic_error ? ' error' : ''}">
        <input type="hidden" name="cns_politic[]" value="" />
        <div class="custom-control custom-checkbox">
          <input class="custom-control-input" id="cns_politic" name="cns_politic[]" type="checkbox" value="1" {* checked *} {$politic | FormItIsChecked : '1'}>
          <label class="custom-control-label" for="cns_politic"> согласен с <a href="{10 | url}" target="_blank">политикой конфиденциальности</a></label>
        </div>
        <div class="error error_cns_politic">{$politic_error}</div>
      </div>
    </div>
    <div class="col-sm-12 col-md-6">
      <div class="form-group control-group">
        <button type="submit" class="btn btn-main"><i class="fa fa-phone"></i> Заказать обратный звонок</button>
        <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
      </div>
    </div>
  </div>

  <input type="hidden" name="token">
  <input type="hidden" name="action">
  <input type="hidden" name="consultation" value="1">
  <input style="display: none;" type="text" name="cns_blank_email" value="" />
</form>
{if $customSuccessMessage}
<div class="custom_success_message" style="display: none;">
  {$customSuccessMessage}
</div>
{/if}