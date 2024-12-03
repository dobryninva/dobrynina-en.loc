{set $id = $_modx->resource.id}
{set $template = $_modx->resource.template}
{set $pagetitle = $_modx->resource.pagetitle}
{set $name = ('gl.fullname' | placeholder != '') ? ('gl.fullname' | placeholder) : ('opf.opf_name' | placeholder)}
{set $name_error = 'opf.error.opf_name' | placeholder}
{set $phone = ('gl.phone' | placeholder != '') ? ('gl.phone' | placeholder) : ('opf.opf_phone' | placeholder)}
{set $phone_error = 'opf.error.opf_phone' | placeholder}
{set $email = ('gl.email' | placeholder != '') ? ('gl.email' | placeholder) : ('opf.opf_email' | placeholder)}
{set $email_error = 'opf.error.opf_email' | placeholder}
{set $mess = 'opf.opf_mess' | placeholder}
{set $mess_error = 'opf.error.opf_mess' | placeholder}
{set $politic = 'opf.opf_politic' | placeholder}
{set $politic_error = 'opf.error.opf_politic' | placeholder}
{set $title = 'opf.opf_title' | placeholder}
{set $title_error = 'opf.error.opf_title' | placeholder}
<form name="orderProductForm" method="post" action="{$_modx->resource.id | url}" autocomplete="on">

  <div class="form-row row">
    <div class="col-sm-12 col-md-4">
      <div class="form-group{$name_error ? ' error' : ''}">
        {* <label for="opf_name">Ваше имя: <span class="req">*</span></label> *}
        <div class="input-group">
          <span class="form-icon align-content-center"><span class="fa fa-user"></span></span>
          <input class="form-control" size="100" name="opf_name" id="opf_name" value="{$name}" placeholder="Ф.И.О." maxlength="100" type="text" />
        </div>
        <div class="error error_opf_name">{$name_error}</div>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-group{$phone_error ? ' error' : ''}">
        {* <label for="opf_phone">Ваш телефон: <span class="req">*</span></label> *}
        <div class="input-group">
          <span class="form-icon align-content-center"><span class="fa fa-phone"></span></span>
          <input class="form-control" size="100" name="opf_phone" id="opf_phone" value="{$phone}" placeholder="+7(___)___-__-__" maxlength="100" type="tel" />
        </div>
        <div class="error error_opf_phone">{$phone_error}</div>
      </div>
    </div>
    <div class="col-sm-12 col-md-4">
      <div class="form-group{$email_error ? ' error' : ''}">
        {* <label for="opf_email">Ваш E-mail:</label> *}
        <div class="input-group">
          <span class="form-icon align-content-center"><span class="fa fa-envelope"></span></span>
          <input class="form-control" size="100" name="opf_email" id="opf_email" value="{$email}" placeholder="E-mail" maxlength="100" type="email" />
        </div>
        <div class="error error_opf_email">{$email_error}</div>
      </div>
    </div>
  </div>

  {switch $template}
    {case '10'}
      {* для товара *}
      <div class="form-group{$title_error ? ' error' : ''}">
        {* <label for="opf_title">Продукция: <span class="req">*</span></label> *}
        <div class="input-group">
          <span class="form-icon align-content-start"><span class="fa fa-shopping-basket"></span></span>
          {* <textarea class="form-control" size="100" name="opf_title" id="opf_title" placeholder="Наименование" maxlength="100" rows="2" readonly="readonly"/>{($title ?: $pagetitle) | clean : 'qq'}</textarea> *}
          <input class="form-control" size="100" name="opf_title" id="opf_title" value="{($title ?: $pagetitle) | clean : 'qq'}" placeholder="Наименование" maxlength="100" type="text" readonly="readonly"/>
          <input type="hidden" name="opf_rid" value="{$id}" />
          <input type="hidden" name="opf_price" value="" />
        </div>
        <div class="error error_opf_title">{$title_error}</div>
      </div>
    {case '21'}
      {* для набора *}
      <div class="form-group{$title_error ? ' error' : ''}">
        {* <label for="opf_title">Продукция: <span class="req">*</span></label> *}
        <div class="input-group">
          <textarea class="form-control" size="100" name="opf_title" id="opf_title" placeholder="Наименование" maxlength="100" rows="4" readonly="readonly"/>{($title ?: $pagetitle) | clean : 'qq'}</textarea>
          {* <input class="form-control" size="100" name="opf_title" id="opf_title" value="{($title ?: $pagetitle) | clean : 'qq'}" placeholder="Наименование" maxlength="100" type="text" readonly="readonly"/> *}
          <input type="hidden" name="opf_rid" value="{$id}" />
          <input type="hidden" name="opf_price" value="" />
        </div>
        <div class="error error_opf_title">{$title_error}</div>
      </div>
    {case default}
      {* для прочих *}
      <div class="form-group{$title_error ? ' error' : ''}">
        {* <label for="opf_title">Продукция: <span class="req">*</span></label> *}
        <div class="input-group">
          <span class="form-icon align-content-start"><span class="fa fa-shopping-basket"></span></span>
          <input class="form-control" size="100" name="opf_title" id="opf_title" value="{$title}" placeholder="Наименование" maxlength="100" type="text" readonly="readonly"/>
          <input type="hidden" name="opf_rid" value="{$id}" />
          <input type="hidden" name="opf_price" value="" />
        </div>
        <div class="error error_opf_title">{$title_error}</div>
      </div>
  {/switch}

  <div class="form-group{$mess_error ? ' error' : ''}">
    {* <label for="opf_mess">Комментарий:</label> *}
    <div class="input-group">
      <span class="form-icon align-content-start"><span class="fa fa-comment"></span></span>
      <textarea class="form-control" name="opf_mess" id="opf_mess" placeholder="Укажите дополнительную информацию или задайте свой вопрос здесь" rows="3" cols="100">{$mess}</textarea>
    </div>
    <div class="error error_opf_mess">{$mess_error}</div>
  </div>
  <div class="form-group{$politic_error ? ' error' : ''}">
    <input type="hidden" name="opf_politic[]" value="" />
    <div class="custom-control custom-checkbox">
      <input name="opf_politic[]" id="opf_politic" type="checkbox" value="1" class="custom-control-input" {* checked *} {$politic | FormItIsChecked : '1'}>
      <label for="opf_politic" class="custom-control-label"> согласен с <a href="{10 | url}" target="_blank">политикой конфиденциальности</a></label>
    </div>
    <div class="error error_opf_politic">{$politic_error}</div>
  </div>
  <div class="form-group">
    <div class="input-group">
      <button type="submit" class="btn btn-main btn-lg">Купить</button>
    </div>
  </div>
  <input type="hidden" name="token">
  <input type="hidden" name="action">
  <input type="hidden" name="orderProduct" value="1">
  <input style="display: none;" type="text" name="opf_blank_email" value="" />
  <p class="cmmnt"><span class="req">*</span> - обязательные поля</p>
</form>
{if $customSuccessMessage}
<div class="custom_success_message" style="display: none;">
  {$customSuccessMessage}
</div>
{/if}