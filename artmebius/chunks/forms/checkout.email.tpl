{set $site_name   = ('site_name' | option) ?: ''}
{set $site_url  = ('site_url' | option) ?: ''}
<!DOCTYPE html>
<html>
<head>
  {ignore}
  <style type="text/css">
    body {
      background-color:#E6EFF6;padding: 20px;
    }
    table {
      width: 100%; margin:10px 0 25px; border:1px solid #d2cece; border-collapse:collapse;
    }
    table td, table th {
      padding:5px 15px; border:1px solid #d2cece;
    }
    table.noborder td {
      border:none;padding:2px 15px;
    }
    p{
      margin: 0 0 5px;
    }
    .order_items table td:last-child{
      white-space: nowrap;
    }
  </style>
  {/ignore}
</head>
<body>
   <div style="background: #fff; color: #333;padding: 15px 25px; min-width: 700px;width: 75%;margin: auto;
    box-shadow: 0 3px 10px #d2d2d2;border-radius: 10px;">
    <div style="border-bottom: 5px solid #c81b1b; padding: 10px 0; text-align: center; margin-bottom: 15px;">
      <a href="{$site_url}"><img src="{$site_url}/artmebius/img/logo.png" alt=""></a>
    </div>
    <p>Новый заказ на сайте {$site_name}</p>
    <table class="noborder">
      <thead>
        <tr><th style="background: #E6EFF6; text-align: left;">Детали заказа</th></tr>
      </thead>
      <tbody>
        <tr><td style="padding-top: 10px;"><strong>Номер заказа:</strong> {$orderID}</td></tr>
        <tr><td><strong>Дата:</strong> {$orderDate}</td></tr>
        <tr><td><strong>Способ оплаты:</strong> {$payment}</td></tr>
        <tr><td style="padding-bottom: 10px;"><strong>Способ доставки:</strong> {$shk_delivery}</td></tr>
      </tbody>
    </table>

    {$orderOutputData}

    {* re
    <p>По всем вопросам, вы можете звонить нам по телефону:
      {if $phones = json_decode(1 | resource : 'phones', true)}
        {foreach $phones as $row}
          {$row.phone}
        {/foreach}
      {/if}
    </p>
    <br> *}
    <a href="{$site_url}" target="_blank">{$site_name}</a>
  </div>
</body>
</html>