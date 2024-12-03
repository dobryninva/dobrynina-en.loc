{set $service = 'sof.service' | placeholder}
{set $service_error = 'sof.error.service' | placeholder}
{set $name = ($_modx->user.fullname != '') ? $_modx->user.fullname : 'sof.name' | placeholder}
{set $name_error = 'sof.error.name' | placeholder}
{set $phone = ($_modx->user.phone != '') ? $_modx->user.phone : 'sof.phone' | placeholder}
{set $phone_error = 'sof.error.phone' | placeholder}
{set $email = ($_modx->user.email != '')  ? $_modx->user.email : 'sof.email' | placeholder}
{set $email_error = 'sof.error.email' | placeholder}
{* {set $politic = 'sof.politic' | placeholder} *}
{* {set $politic_error = 'sof.error.politic' | placeholder} *}
{set $mess = 'sof.mess' | placeholder}
{set $mess_error = 'sof.error.mess' | placeholder}
{* {set $file = 'sof.design' | placeholder} *}
{* {set $file_error = 'sof.error.design' | placeholder} *}
<form id="servicesOrderForm" name="servicesOrderForm" class="form-modal form-grid" method="post" action="{$_modx->resource.id | url}" autocomplete="on" enctype="multipart/form-data">

  {* <p>Заполните форму для получения расчета стоимости</p> *}

  <div class="form-row">

    <div class="col-sm-12 col-md-12">
      <div class="form-group{$service_error ? ' error' : ''}">
        <label class="form-label" for="sof_service">Название услуги:</label>
        <div class="input-group">
          {* <span class="form-icon align-content-center"><span class="fa fa-user"></span></span> *}
          <input class="form-control" id="sof_service" name="service" type="text" value="{$service}" placeholder="Название услуги" maxlength="100" size="100" readonly />
        </div>
        {* <div class="error error_sof_service">{$service_error}</div> *}
      </div>
    </div>

    <div class="col-sm-12 col-md-4">
      <div class="form-group{$name_error ? ' error' : ''}">
        <label class="form-label" for="sof_name">Ваше имя: <span class="req">*</span></label>
        <div class="input-group">
          {* <span class="form-icon align-content-center"><span class="fa fa-user"></span></span> *}
          <input class="form-control" id="sof_name" name="name" type="text" value="{$name}" placeholder="Имя" maxlength="100" size="100" />
        </div>
        {* <div class="error error_sof_name">{$name_error}</div> *}
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-group{$phone_error ? ' error' : ''}">
        <label class="form-label" for="sof_phone">Ваш телефон: <span class="req">*</span></label>
        <div class="input-group">
          {* <span class="form-icon align-content-center"><span class="fa fa-phone"></span></span> *}
          <input class="form-control" id="sof_phone" name="phone" type="tel" value="{$phone}" placeholder="Телефон" maxlength="100" size="100" />
        </div>
        {* <div class="error error_sof_phone">{$phone_error}</div> *}
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-group{$email_error ? ' error' : ''}">
        <label class="form-label" for="sof_email">Ваш e-mail:</label>
        <div class="input-group">
          {* <span class="form-icon align-content-center"><span class="fa fa-user"></span></span> *}
          <input class="form-control" id="sof_email" name="email" type="email" value="{$email}" placeholder="E-mail" maxlength="100" size="100" />
        </div>
        {* <div class="error error_sof_email">{$email_error}</div> *}
      </div>
    </div>

    <div class="col-sm-12 col-md-12">
      <div class="form-group{$mess_error ? ' error' : ''}">
        <label class="form-label" for="sof_mess">Комментарий:</label>
        <div class="input-group">
          {* <span class="form-icon align-content-start"><span class="fal fa-comment"></span></span> *}
          <textarea class="form-control" name="mess" id="sof_mess" placeholder="Задайте вопрос об интересующей услуге или оставьте свой комментарий здесь" rows="3" cols="100">{$mess}</textarea>
        </div>
        {* <div class="error error_sof_mess">{$mess_error}</div> *}
      </div>
    </div>
    {*
    <div class="col-sm-12 col-md-12">
      <div class="form-group{$file_error}">
        <span class="form-label like-label">Ваш макет:</span>
        <div class="custom-file">
          <label class="custom-file-label" for="sof_design">Есть макет? Загрузите!</label>
          <input class="custom-file-input" id="sof_design" name="design" type="file" accept=".png, .jpg, .jpeg, .svg, .psd, .cdr, .eps, .ai" value="{$file}" />
        </div>
        <div class="error error_sof_design">{$file_error}</div>
      </div>
    </div>
    *}
    {*
    <div class="col-sm-12 col-md-8 align-self-center">
      <div class="form-group mb-0{$politic_error ? ' error' : ''}">
        <input type="hidden" name="politic[]" value="" />
        <div class="custom-control custom-checkbox">
          <input class="custom-control-input" id="sof_politic" name="politic[]" type="checkbox" value="1" {$politic | FormItIsChecked : '1'}>
          <label class="custom-control-label" for="sof_politic"> согласен с <a href="{10 | url}" target="_blank">политикой конфиденциальности</a></label>
        </div>
        <div class="error error_sof_politic">{$politic_error}</div>
      </div>
    </div>
    *}

    <div class="col-sm-12 col-md-12">
      <p>Нажимая на кнопку «отправить», Вы соглашаетесь с <a href="{10 | url}">политикой конфиденциальности</a>.</p>
    </div>

    <div class="col-sm-12 col-md-4">
      <div class="form-group control-group">
        <button type="submit" class="btn btn-main btn-wide">Отправить</button>
        {* <span class="cmmnt"><span class="req">*</span> - обязательные поля</span> *}
      </div>
    </div>

  </div>{* form-row *}

  <input type="hidden" name="token">
  <input type="hidden" name="action">
  <input type="hidden" name="services_order" value="1">
  <input type="hidden" name="price" value="">
  <input type="hidden" name="rid" value="">
  <input style="display: none;" type="text" name="blank_email" value="" />
</form>
{if $customSuccessMessage}
<div class="custom_success_message" style="display: none;">
  {$customSuccessMessage}
</div>
{/if}