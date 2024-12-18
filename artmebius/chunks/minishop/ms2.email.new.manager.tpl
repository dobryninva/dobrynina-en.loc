{extends 'tpl.msEmail'}

{block 'title'}
    {'ms2_email_subject_new_manager' | lexicon : $order}
{/block}

{block 'user'}
{* {if $user}
  <div style="width: 90%;margin: 0 auto 20px;">
    <h4>Контактные данные:</h4>
    <ul>
      {if $user.fullname}<li>ФИО: {$user.fullname}</li>{/if}
      {if $user.email}<li>E-mail: {$user.email}</li>{/if}
      {if $user.phone}<li>Телефон: {$user.phone}</li>{/if}
      {if $user.mobilephone}<li>Телефон: {$user.mobilephone}</li>{/if}
      {if $address.properties.extfld_inn}<li>ИНН: {$address.properties.extfld_inn}</li>{/if}
      {if $address.properties.extfld_ogrn}<li>ОГРНН: {$address.properties.extfld_ogrn}</li>{/if}
    </ul>
  </div>
{/if} *}
{* username, address, country, city, zip *}
{/block}

{block 'address'}
    <table class="container" style="width: 100%;background:#fff;margin-top:10px; padding-bottom: 40px;">
        <tr>
            <td>  
                <h3 style="{$style.h}{$style.h3} margin-bottom: 20px;">{'ms2_frontend_credentials' | lexicon}</h3>
                <table style="width:95%;margin:auto;">
                    {foreach ['receiver','phone','email'] as $field}
                        {if $address[$field]}
                            <tr>
                                <td>{('ms2_frontend_' ~ $field) | lexicon}: {$address[$field]} </td>
                            </tr>
                        {/if}
                    {/foreach}
                </table>
            </td>
        </tr>
        <tr>
            <td>  
                <h3 style="{$style.h}{$style.h3} margin-bottom: 20px;">{'ms2_frontend_address' | lexicon}</h3>
                <table style="width:95%;margin:auto;">
                    {foreach ['index','region','city', 'street', 'building', 'entrance','floor', 'room'] as $field}
                        {if $address[$field]}
                            <tr>
                                <td>{('ms2_frontend_' ~ $field) | lexicon}: {$address[$field]} </td>
                            </tr>
                        {/if}
                    {/foreach}
                </table>
            </td>
        </tr>

        {if $address.comment}
            <tr>
                <td>
                    <h3 style="{$style.h}{$style.h3} margin-bottom: 20px;">{'ms2_frontend_comment' | lexicon}</h3>
                    <table style="width:95%;margin:auto;">
                        <tr>
                            <td>{$address.comment}</td>
                        </tr> 
                    </table>
                </td>
            </tr>
        {/if}
    </table>
{/block}

{block 'payment'}
    <table class="container" style="width: 100%;background:#fff;margin-top:10px; padding-bottom: 40px;">
        <tr>
            <td>  
                <h3 style="{$style.h}{$style.h3} margin-bottom: 20px;">{'ms2_frontend_payment' | lexicon}</h3>
                <table style="width:95%;margin:auto;">
                    <tr>
                        <td>{$payment.name}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
{/block}

{block 'delivery'}
    <table class="container" style="width: 100%;background:#fff;margin-top:10px; padding-bottom: 40px;">
        <tr>
            <td>  
                <h3 style="{$style.h}{$style.h3} margin-bottom: 20px;">{'ms2_frontend_delivery' | lexicon}</h3>
                <table style="width:95%;margin:auto;">
                    <tr>
                        <td>{$delivery.name}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
{/block}

{block 'link'}
<table class="container" style="width: 100%;background:#fff;margin-top:10px; padding: 40px 0;">
    <tr>
        <td>  
            <table style="width:95%;margin:auto;">
                <tr>
                    <td><a href="{$site_url}{'manager_url'|option}?a=mgr/orders&namespace=minishop2&order={$order.id}" target="_blank" style="{$style.a}">{'ms2_email_link_to_order' | lexicon}</a></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
{/block}
