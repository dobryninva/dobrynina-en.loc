{'!shkOptions' | snippet : [
  'get'            => 'delivery,payments',
  'post_name'      => 'shk_delivery,payment',
  'toPlaceholders' => '1',
  'pl_prefix'      => 'shkopt_',
  'tpl'            => 'select_option',
]}
{set $fullname = ('gl.fullname' | placeholder != '') ? ('gl.fullname' | placeholder) : ('check.fullname' | placeholder)}
{set $fullname_error = 'check.error.fullname' | placeholder}
{set $phone = ('gl.phone' | placeholder != '') ? ('gl.phone' | placeholder) : ('check.phone' | placeholder)}
{set $phone_error = 'check.error.phone' | placeholder}
{set $email = ('gl.email' | placeholder != '') ? ('gl.email' | placeholder) : ('check.email' | placeholder)}
{set $email_error = 'check.error.email' | placeholder}
{set $face = 'check.face' | placeholder}
{set $face_error = 'check.error.face' | placeholder}
{set $payment = 'check.payment' | placeholder}
{set $payment_error = 'check.error.payment' | placeholder}
{set $organization = 'check.organization' | placeholder}
{set $organization_error = 'check.error.organization' | placeholder}
{set $inn_kpp = 'check.inn_kpp' | placeholder}
{set $inn_kpp_error = 'check.error.inn_kpp' | placeholder}
{set $shk_delivery = 'check.shk_delivery' | placeholder}
{set $shk_delivery_error = 'check.error.shk_delivery' | placeholder}
{set $fulladdress = (('gl.country' | placeholder != '') ? ('gl.country' | placeholder)~', ' : '') ~ (('gl.city' | placeholder != '') ? ('gl.city' | placeholder)~', ' : '') ~ (('gl.address' | placeholder != '') ? ('gl.address' | placeholder) : '')}
{set $address = ($fulladdress != '') ? $fulladdress : ('check.address' | placeholder)}
{set $address_error = 'check.error.address' | placeholder}
{set $message = 'check.message' | placeholder}
{set $message_error = 'check.error.message' | placeholder}
{set $check_politic = 'check.check_politic' | placeholder}
{set $check_politic_error = 'check.error.check_politic' | placeholder}

<form method="post" action="{$_modx->resource.id | url}" id="checkoutForm" autocomplete="on">
  <input type="text" name="nospam:blank" value="" style="display:none;" />

  <div class="row form-row">
    <div class="col-sm-12 col-md-4">
      <div class="form-group{$fullname_error ? ' error' : ''}">
        <label class="ldib" for="check_fullname">Ваше имя: <span class="req">*</span></label>
        <div class="input-group">
          <input size="100" name="fullname" id="check_fullname" value="{$fullname}" placeholder="Имя" maxlength="100" class="form-control" type="text" />
        </div>
        <div class="error error_fullname">{$fullname_error}</div>
      </div>
    </div>

    <div class="col-sm-12 col-md-4">
      <div class="form-group{$phone_error ? ' error' : ''}">
        <label class="ldib" for="check_phone">Ваш телефон: <span class="req">*</span></label>
        <div class="input-group">
          <input size="100" name="phone" id="check_phone" value="{$phone}" placeholder="+7(___)___-__-__" maxlength="100" class="form-control" type="tel" />
        </div>
        <div class="error error_phone">{$phone_error}</div>
      </div>
    </div>

    <div class="col-sm-12 col-md-4">
      <div class="form-group{$email_error ? ' error' : ''}">
        <label class="ldib" for="check_email">Ваш E-mail: <span class="req">*</span></label>
        <div class="input-group">
          <input size="100" name="email" id="check_email" value="{$email}" placeholder="E-mail" maxlength="100" class="form-control" type="email" />
        </div>
        <div class="error error_email">{$email_error}</div>
      </div>
    </div>

  </div>
  <div class="row form-row">
    <div class="col-sm-12 col-md-6">
{*
      <div class="form-group{$face_error ? ' error' : ''}">
        <label class="ldib" for="check_face">Заказчик: <span class="req">*</span></label>
        <div class="input-group">
          <select id="check_face" name="face" class="form-control w100">
            <option label="-" value=""></option>
            <option value="Физическое лицо">Физическое лицо</option>
            <option value="Юридическое лицо">Юридическое лицо</option>
          </select>
        </div>
        <div class="error error_face">{$face_error}</div>
      </div>
 *}
      <div class="form-group{$payment_error ? ' error' : ''}">
        <label class="ldib" for="check_payment">Способ оплаты: <span class="req">*</span></label>
        <div class="input-group">
          <select id="check_payment" name="payment" class="form-control w100">
            <option label="-" value=""></option>
            {'shkopt_payments' | placeholder}
          </select>
        </div>
        <div class="error error_payment">{$payment_error}</div>
      </div>

      <div id="check_organization_block" class="form-group{$organization_error ? ' error' : ''}" {$payment != 'Безналичный расчёт' ? 'style="display: none;"' : ''}>
        <label class="ldib" for="check_organization">Название организации: <span class="req">*</span></label>
        <div class="input-group">
          <input type="text" name="organization" id="check_organization" class="form-control" size="100">
        </div>
        <div class="error error_organization">{$organization_error}</div>
      </div>

      <div id="check_inn_kpp_block" class="form-group{$inn_kpp_error ? ' error' : ''}" {$payment != 'Безналичный расчёт' ? 'style="display: none;"' : ''}>
        <label class="ldib" for="check_inn_kpp">ИНН/КПП: <span class="req">*</span></label>
        <div class="input-group">
          <input type="text" name="inn_kpp" id="check_inn_kpp" class="form-control" placeholder="ИНН/КПП" size="100">
        </div>
        <div class="error error_inn_kpp">{$inn_kpp_error}</div>
      </div>

    </div>
    <div class="col-sm-12 col-md-6">

      <div class="form-group{$shk_delivery_error ? ' error' : ''}">
        <label class="ldib" for="check_shk_delivery">Способ доставки: <span class="req">*</span></label>
        <div class="input-group">
          <select id="check_shk_delivery" name="shk_delivery" class="form-control w100">
            <option label="-" value=""></option>
            {'shkopt_delivery' | placeholder}
          </select>
        </div>
        <div class="error error_shk_delivery">{$shk_delivery_error}</div>
      </div>

      <div id="check_address_block" class="form-group{$address_error ? ' error' : ''}" {$shk_delivery != 'Курьером' ? 'style="display: none;"' : ''}>
        <label class="ldib" for="check_address">Адрес доставки: <span class="req">*</span></label>
        <div class="input-group">
          <input type="text" name="address" id="check_address" class="form-control" value="{$address}" size="100">
        </div>
        <div class="error error_address">{$address_error}</div>
      </div>

    </div>
  </div>

  <div class="form-group{$message_error ? ' error' : ''}">
    <label class="ldib" for="check_message">Комментарий:</label>
    <div class="input-group">
      <textarea name="message" id="check_message" placeholder="Введите любую дополнительную информацию или оставьте вопрос" rows="3" cols="100" class="form-control">{$message}</textarea>
    </div>
    <div class="error error_message">{$message_error}</div>
  </div>

  <div class="form-group{$check_politic_error ? ' error' : ''}">
    <input type="hidden" name="check_politic[]" value="" />
    <div class="custom-control custom-checkbox">
      <input name="check_politic[]" id="check_politic" class="custom-control-input" type="checkbox" value="1" {* checked *} {$check_politic | FormItIsChecked : '1'}>
      <label for="check_politic" class="custom-control-label"> согласен с <a href="{10 | url}" target="_blank">политикой конфиденциальности</a></label>
    </div>
    <div class="error error_check_politic">{$check_politic_error}</div>
  </div>

  <div class="form-group">
    <div class="input-group">
      <button type="submit" class="btn btn-main">Заказать</button>
      <input type="hidden" name="checkoutVar" value="1">
    </div>
  </div>
  <hr>
  <span class="cmmnt"><span class="req">*</span> - поля, обязательные для заполнения</span>

</form>
{if $customSuccessMessage}
<div class="custom_success_message" style="display: none;">
  {$customSuccessMessage}
</div>
{/if}