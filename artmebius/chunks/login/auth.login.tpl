<span class="login__row">
  <span class="login__link" data-target="#modalUserAuth" data-toggle="modal">
    <i class="login__link-icon d-md-none fal fa-sign-in-alt"></i>
    <span class="login__link-text c-l c-hover-lh link-dotted link-pointer">Вход</span>
  </span>
  <span class="login__divider">|</span>
  <a class="login__link" href="{12 | url}">
    <i class="login__link-icon d-md-none fal fa-user-plus"></i>
    <span class="login__link-text d-none- d-md-inline-">Регистрация</span>
  </a>
</span>
{* <span class="login__link login__link_personal xs_switcher_btn" data-target="#modalUserAuth" data-toggle="modal" title="Личный кабиет">{'svg_personal' | placeholder}</span> *}
{*modal start*}
{set $form_auth_html}
<div class="modal fade modal_auth" id="modalUserAuth" tabindex="-1" role="dialog" aria-labelledby="modalUserAuth_label" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modalUserAuth_label">Авторизация:</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        <form class="form_default form_icons" action="{$_modx->resource.id | url}" method="post">
          <div class="form-group">
            <div class="input-group">
              <span class="form-icon align-content-center"><i class="fal fa-user"></i></span>
              {* <span class="form-icon align-content-center"><i class="fal fa-envelope"></i></span> *}
              <input class="form-control" type="text" name="username" placeholder="{$_modx->lexicon('login.username')}" />
            </div>
          </div>
          <div class="form-group">
            <div class="input-group">
              <span class="form-icon align-content-center"><i class="fal fa-lock"></i></span>
              <input class="form-control" type="password" name="password" placeholder="{'login.password' | lexicon}" />
            </div>
          </div>
          <div class="form-group form-group-button mb0">
            <button class="btn btn-main w-100 btn-h-blue" type="submit" name="Login"><i class="fal fa-sign-in"></i> {'actionMsg' | placeholder}</button>
          </div>
          <input type="hidden" name="service" value="login" />
          <input type="hidden" name="returnUrl" value="{$request_uri}" />
        </form>
        <div class="loginMessage">
          {if $errors != ''}
            {$errors}
            <script>var userAuthError = true;</script>
          {/if}
        </div>
      </div>
      <div class="modal-footer">
        <ul class="auth_links list-n d-flex justify-content-between list-fa- w-100 mb0">
          <li class="check"><a href="{12 | url}">Регистрация</a></li>
          <li class="question-circle"><a href="{16 | url}">Забыли пароль</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
{/set}
{$_modx->setPlaceholder('form_auth_html', $form_auth_html)}
{*modal end*}