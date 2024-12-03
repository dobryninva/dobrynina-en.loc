{if $is_answer}
  <div class="subscribe__form">
    <div class="subscribe__message fix_subscribe_message">{$message}</div>
  </div>
{else}
  <form class="subscribe__form form_defalut" action="{$_modx->resource.id|url}" method="post">
    <div class="row align-items-center">
      <div class="col-xs-12 col-md">
        <input class="subscribe__form-input form-control form-control-xl{$error ? ' error' : ''}" size="100" type="email" name="email" placeholder="Введите ваш E-mail" value="{$_modx->user.email}">
      </div>
      <div class="col-xs-12 col-md-auto">
        <button class="subscribe__form-btn btn btn-main btn-wide btn-xl" type="submit">Подписаться</button>
      </div>
    </div>
    <div class="subscribe__message fix_subscribe_message">{$message}</div>
    <input type="hidden" name="sx_action" value="subscribe">
    <input type="hidden" name="token">
    <input type="hidden" name="action">
  </form>
{/if}