<span class="login__row">
  <a class="login__link login__link_personal" href="{11 | url : ['scheme' => 'full'] : ['id' => $_modx->user.id]}" title="Личный кабиет">
    <i class="login__link-icon d-xs-none fa fa-user"></i>
    <span class="login__link-text">{$_modx->user.username}</span>
  </a>
  <span class="auth_sepr">|</span>
  <a class="login__link login__link_logout" href="{1 | url : ['scheme' => 'full'] : ['service' => 'logout']}" title="Выход">
    <i class="login__link-icon d-xs-none fa fa-times-circle"></i>
    <span class="login__link-text">Выход</span>
  </a>
</span>
{* v2 - личный кабинет в модальном окне
<span class="hdr_personal_link hdr_logout_link xs_switcher_btn" data-target="#modal_logout" data-toggle="modal" title="Личный кабиет">{'svg_personal' | placeholder}</span>
{set $modal_logout_html}
<div class="modal fade modal_logout" id="modal_logout" tabindex="-1" role="dialog" aria-labelledby="modal_logout_label" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <span class="modal-title" id="modal_logout_label">Выберете действие:</span>
        <span class="modal-close fal fa-times" data-dismiss="modal" aria-label="Close"></span>
      </div>
      <div class="modal-body">
        <ul class="user_profile_list list-n mb0">
          <li><a href="{17 | url}"><i class="fal fa-shopping-cart"></i> История заказов</a></li>
          <li><a href="{18 | url}"><i class="fal fa-star"></i> Избранное</a></li>
          <li><a href="{14 | url}"><i class="fal fa-edit"></i> Редактировать профиль</a></li>
          <li><a href="{15 | url}"><i class="fal fa-key"></i> Изменить пароль</a></li>
          <li><a href="?service=logout"><i class="fal fa-sign-out"></i> Выход</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
{/set}
{$_modx->setPlaceholder('modal_logout_html', $modal_logout_html)}

*}