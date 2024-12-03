{set $site_url = 'site_url' | option}
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
</head>
<body>
<div style="max-width: 730px;padding:14px 19px;margin: 0 auto;background-color:#f7f7f7;border-radius:2px;border:1px solid #d1d1d1;">
	<table border="1" cellspacing="0" cellpadding="4" width="730" style="border-collapse:collapse;border:1px solid #a0a0a0;margin: 0 auto;background-color: #fff;">
	  <tr><td colspan="2" style="background-color: #eaf3f5; border:1px solid #a0a0a0;"><strong>Контактные данные:</strong></td></tr>
		{if $opf_name}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">Имя:</td><td style="width:600px;border:1px solid #a0a0a0;">{$opf_name}</td></tr>
    {/if}
		{if $opf_email}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">E-mail:</td><td style="width:600px;border:1px solid #a0a0a0;">{$opf_email}</td></tr>
    {/if}
		{if $opf_phone}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">Телефон:</td><td style="width:600px;border:1px solid #a0a0a0;">{$opf_phone}</td></tr>
    {/if}
		  <tr><td colspan="2" style="border:1px solid #a0a0a0;"><hr /></td></tr>
		  <tr><td colspan="2" style="background-color: #eaf3f5; border:1px solid #a0a0a0;"><strong>Информация о товаре:</strong></td></tr>
		{if $opf_title}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">Название:</td><td style="width:600px;border:1px solid #a0a0a0;"><a href="{$opf_rid | url}">{$opf_title}</a></td></tr>
    {/if}
		{if $opf_rid}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">id:</td><td style="width:600px;border:1px solid #a0a0a0;">{$opf_rid}</td></tr>
    {/if}
    {if $opf_price}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">Стоимость:</td><td style="width:600px;border:1px solid #a0a0a0;">{$opf_price} руб.</td></tr>
    {/if}
		{if $opf_count}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">Кол-во:</td><td style="width:600px;border:1px solid #a0a0a0;">{$opf_count}</td></tr>
    {/if}
		{if $opf_rid}
      <tr><td style="width:130px;border:1px solid #a0a0a0;">Фото:</td><td style="width:600px;border:1px solid #a0a0a0;"><a href="{$opf_rid | url}"><img src="{$site_url}{$opf_rid | resource : 'image'}" alt="" style="border: none;max-width: 100px;max-height: 100px;height: auto;" /></a></td></tr>
    {/if}
		{if $opf_mess}
      <tr><td colspan="2" style="border:1px solid #a0a0a0;"><hr /></td></tr>
      <tr><td style="width:130px;border:1px solid #a0a0a0;">Комментарий:</td><td style="width:600px;border:1px solid #a0a0a0;">{$opf_mess}</td></tr>
    {/if}
	</table>
</div>
</body>
</html>