{if ('error.message' | placeholder)}
  <div class="registerMessage">{'error.message' | placeholder}</div>
{else}

  <form class="form form_default form_mobile form_labels row" action="{$_modx->resource.id | url}" method="post">
    <div class="col-lg-6">

      <div class="form-group{if ('error.fullname' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-user"></i></span>
          <input class="form-control" type="text" name="fullname" id="fullname" value="{'fullname' | placeholder}" placeholder="{'register.fullname' | lexicon} *" maxlength="100" />
        </div>
        <span class="error">{'error.fullname' | placeholder}</span>
      </div>

      <div class="form-group {if ('error.email' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-envelope"></i></span>
          <input class="form-control" type="email" name="email" id="email" value="{'email' | placeholder}" placeholder="{'register.email' | lexicon} *" maxlength="100" />
        </div>
        <span class="error">{'error.email' | placeholder}</span>
      </div>

      <div class="form-group {if ('error.phone' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-phone"></i></span>
          <input class="form-control" type="tel" name="phone" id="phone" value="{'phone' | placeholder}" placeholder="{'register.phone' | lexicon} *" maxlength="100" />
        </div>
        <span class="error">{'error.phone' | placeholder}</span>
      </div>

      <div class="form-group {if ('error.password' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-unlock-alt"></i></span>
          <input class="form-control" type="password" name="password" id="password" value="{'password' | placeholder}" placeholder="{'register.password' | lexicon} *" maxlength="100" />
        </div>
        <span class="error">{'error.password' | placeholder}</span>
      </div>

      <div class="form-group {if ('error.password_confirm' | placeholder) != ''} has-error{/if}">
        <div class="input-group">
          <span class="form-icon align-content-center"><i class="fal fa-unlock-alt fa-shadow"></i></span>
          <input class="form-control" type="password" name="password_confirm:password_confirm=`password`" id="password_confirm" value="{'password_confirm' | placeholder}" placeholder="{'register.password_confirm' | lexicon} *" maxlength="100" />
        </div>
        <span class="error">{'error.password_confirm' | placeholder}</span>
      </div>

      <div class="form-group control-group">
        <button type="submit" class="btn btn-main btn-h-blue btn-wide"><i class="fa fa-handshake"></i> Зарегистрироваться</button>
        <span class="cmmnt"><span class="req">*</span> - обязательные поля</span>
        <input type="hidden" name="login-register-btn" value="Регистрация">
      </div>

    </div>

    <input type="hidden" name="nospam:blank" value="" />
  </form>
{/if}