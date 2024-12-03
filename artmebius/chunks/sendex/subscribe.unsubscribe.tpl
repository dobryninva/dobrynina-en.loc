<form class="subscribe__form form_defalut" action="{$_modx->resource.id|url}" method="post">
  <p class="subscribe__text">Вы подписаны на рассылку</p>
  <button type="submit" class="subscribe__form-btn btn">Отписаться от рассылки</button>
  <div class="subscribe__message fix_subscribe_message">{$message}</div>
  <input type="hidden" name="code" value="{$code}">
  <input type="hidden" name="sx_action" value="unsubscribe">
  <input type="hidden" name="token">
  <input type="hidden" name="action">
</form>