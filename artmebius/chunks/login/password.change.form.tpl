{* {if ('logcp.error_message' | placeholder)}
  <div class="alert alert-error">
    {'logcp.error_message' | placeholder}
  </div>
{/if} *}
{if ('logcp.successMessage' | placeholder)}
  <div class="alert alert-success">
    {'logcp.successMessage' | placeholder}
  </div>
{else}
  <form class="form_default form_labels_side row" action="" method="post">
    <div class="col-lg-6">

      <div class="form-group cos-lg-4-{if ('logcp.error.password_old' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-key"></i></span>
          <input class="form-control" type="password" name="password_old" id="password_old" value="{'logcp.password_old' | placeholder}" placeholder="{'login.password_old' | lexicon}" maxlength="100" />
        </div>
        <span class="error">{'logcp.error.password_old' | placeholder}</span>
      </div>

      <div class="form-group cos-lg-4-{if ('logcp.error.password_new' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-unlock-alt"></i></span>
          <input class="form-control" type="password" name="password_new" id="password_new" value="{'logcp.password_new' | placeholder}" placeholder="{'login.password_new' | lexicon}" maxlength="100" />
        </div>
        <span class="error">{'logcp.error.password_new' | placeholder}</span>
      </div>

      <div class="form-group cos-lg-4-{if ('logcp.error.password_new_confirm' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-unlock-alt fa-shadow"></i></span>
          <input class="form-control" type="password" name="password_new_confirm" id="password_new_confirm" value="{'logcp.password_new_confirm' | placeholder}" placeholder="{'login.password_new_confirm' | lexicon}" maxlength="100" />
        </div>
        <span class="error">{'logcp.error.password_new_confirm' | placeholder}</span>
      </div>

      <div class="control-group">
        <button type="submit" class="btn btn-main"><i class="fa fa-check"></i> {'login.change_password' | lexicon}</button>
        <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
        <input type="hidden" name="logcp-submit" value="Изменить пароль" />
      </div>

    </div>
    <input type="hidden" name="nospam" value="" />
  </form>
{/if}