{if ('error.message' | placeholder)}
  <div class="alert alert-error">
    ('error.message' | placeholder)
  </div>
{/if}
{if ('login.update_success' | placeholder)}
  <div class="alert alert-success">
    {'login.profile_updated' | lexicon}
  </div>
{/if}

<form class="form_default row" action="{$_modx->resource.id | url}" method="post">
  <div class="col-lg-6">
    <div class="form-group cos-lg-4-{if ('error.fullname' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-user"></i></span>
        <input class="form-control" type="text" name="fullname" id="fullname" value="{'fullname' | placeholder}" placeholder="{'login.fullname' | lexicon} *" maxlength="100" />
      </div>
      <span class="error">{'error.fullname' | placeholder}</span>
    </div>

    <div class="form-group{if ('error.email' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-envelope"></i></span>
        <input class="form-control" type="email" name="email" id="email" value="{'email' | placeholder}" placeholder="{'login.email' | lexicon} *" maxlength="100" />
      </div>
      <span class="error">{'error.email' | placeholder}</span>
    </div>

    <div class="form-group{if ('error.phone' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-phone"></i></span>
        <input class="form-control" type="tel" name="phone" id="phone" value="{'phone' | placeholder}" placeholder="{'login.phone' | lexicon} *" maxlength="100" />
      </div>
      <span class="error">{'error.phone' | placeholder}</span>
    </div>

    <div class="form-group{if ('error.state' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-globe"></i></span>
        <input class="form-control" type="text" name="state" id="state" value="{'state' | placeholder}" placeholder="{'login.state' | lexicon}" maxlength="100" />
      </div>
      <span class="error">{'error.state' | placeholder}</span>
    </div>

    <div class="form-group{if ('error.city' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-city"></i></span>
        <input class="form-control" type="text" name="city" id="city" value="{'city' | placeholder}" placeholder="{'login.city' | lexicon}" maxlength="100" />
      </div>
      <span class="error">{'error.city' | placeholder}</span>
    </div>

    <div class="form-group{if ('error.address' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-map-marker-alt"></i></span>
        <input class="form-control" type="text" name="address" id="address" value="{'address' | placeholder}" placeholder="{'login.address' | lexicon}" maxlength="100" />
      </div>
      <span class="error">{'error.address' | placeholder}</span>
    </div>

    <div class="form-group{if ('error.zip' | placeholder) != ''} has-error{/if}">
      <div class="input-group">
        <span class="form-icon align-content-center"><i class="fal fa-mailbox"></i></span>
        <input class="form-control" type="text" name="zip" id="zip" value="{'zip' | placeholder}" placeholder="{'login.zip' | lexicon}" maxlength="100" />
      </div>
      <span class="error">{'error.zip' | placeholder}</span>
    </div>

    <div class="form-group">
      <button class="btn btn-main btn-h-blue btn-wide" type="submit" name="login-updprof-btn" value="{'login.update_profile' | lexicon}"><i class="fa fa-check"></i> {'login.update_profile' | lexicon}</button>
      {* <input class="btn btn-main btn-h-blue btn-wide" type="submit" name="login-updprof-btn" value="{'login.update_profile' | lexicon}" /> *}
    </div>
  </div>

  <input type="hidden" name="nospam" value="" />
</form>