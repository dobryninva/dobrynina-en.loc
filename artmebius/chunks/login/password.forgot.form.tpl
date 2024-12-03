<div class="error">{$_pls['loginfp.errors']}</div>
<form class="form_default form_mobile form_labels row" action="{$_modx->resource.id | url}" method="post">
  <div class="col-lg-6">

    <div class="form-group {if ('error.username' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><span class="fal fa-user"></span></span>
        <input class="form-control" type="text" name="username" id="username" value="{$_pls['loginfp.post.username']}" placeholder="" maxlength="100" />
      </div>
      <span class="error">{'error.username' | placeholder}</span>
    </div>

    <hr>
    <p class="mbh">{'login.or_forgot_username' | lexicon}</p>

    <div class="form-group {if ('error.email' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-envelope"></i></span>
        <input class="form-control" type="email" name="email" id="email" value="{$_pls['loginfp.post.email']}" placeholder="{'login.email' | lexicon}" maxlength="100" />
      </div>
      <span class="error">{'error.email' | placeholder}</span>
    </div>

    <div class="form-group control-group">
      <button type="submit" class="btn btn-main"><i class="fa fa-bell-o"></i> {'login.reset_password' | lexicon}</button>
      <input type="hidden" name="login_fp" value="{'login.reset_password' | lexicon}">
    </div>
  </div>

  <input type="hidden" name="returnUrl" value="{$_pls['loginfp.request_uri']}" />
  <input type="hidden" name="login_fp_service" value="forgotpassword" />
</form>