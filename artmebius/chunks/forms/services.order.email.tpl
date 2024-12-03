<table style="width:100%;" cellpadding="4">
  {set $service_link_title = ($rid) ? '<a href="'~($rid | url)~'" title="'~$service~'">'~$service~'</a>' : $service}
  {if $service}<tr><td style="width:130px;">Услуга:</td><td style="width:90%;">{$service_link_title}</td></tr>{/if}
  {if $price}<tr><td style="width:130px;">Стоимость:</td><td style="width:90%;">{$price} руб.</td></tr>{/if}
  <tr><td colspan="2"><strong>Контактные данные:</strong></td></tr>
  {if $name}<tr><td style="width:130px;">Имя:</td><td style="width:90%;">{$name}</td></tr>{/if}
  {if $phone}<tr><td style="width:130px;">Телефон:</td><td style="width:90%;">{$phone}</td></tr>{/if}
  {if $email}<tr><td style="width:130px;">E-mail:</td><td style="width:90%;">{$email}</td></tr>{/if}
  {if $mess}<tr><td style="width:130px;">Комментарий:</td><td style="width:90%;">{$mess}</td></tr>{/if}
</table>