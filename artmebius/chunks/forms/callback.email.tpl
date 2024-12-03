<table style="width:100%;" cellpadding="4">
  <tr><td colspan="2"><strong>Контактные данные:</strong></td></tr>
  {if $name}<tr><td style="width:130px;">Имя:</td><td style="width:90%;">{$name}</td></tr>{/if}
  {if $phone}<tr><td style="width:130px;">Телефон:</td><td style="width:90%;">{$phone}</td></tr>{/if}
  {if $time}<tr><td style="width:130px;">Удобное время для звонка:</td><td style="width:90%;">{$time}</td></tr>{/if}
  <tr><td colspan="2"><hr /></td></tr>
  {if $mess}<tr><td style="width:130px;">Сообщение:</td><td style="width:90%;">{$mess}</td></tr>{/if}
</table>