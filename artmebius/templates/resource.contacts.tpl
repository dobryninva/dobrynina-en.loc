{extends 'template:base'}

{block 'vars'}
  {parent}
  {* {set $show_sidebar = 1} *}
{/block}

{block 'page'}
<div class="page page_inner page_contacts">
{/block}

{block 'main'}
  <main class="article article_contacts">
	  <h1 class="article__header page-header">{$h1 ?: $pagetitle}</h1>

	  <div class="contacts">
	  	{* .contacts__El>.contacts__title+.contacts__items.contacts__items_El *}

	    {if $company_address_arr?}
	    <div class="contacts__row contacts__address address">
	    	<div class="contacts__title">Адрес:</div>
	    	<div class="contacts__items contacts__items_address">
		      {foreach $company_address_arr as $row}
		        <div class="address__row">{$row | clean : ['case'=>'include', 'keys'=>['zip','city','address']] | join : ', '}</div>
		      {/foreach}
	    	</div>
	    </div>
	    {/if}

      {if $company_schedule_arr?}
      <div class="contacts__row contacts__schedule schedule">
        <div class="contacts__title">Режим работы:</div>
	    	<div class="contacts__items contacts__items_schedule">
	        {foreach $company_schedule_arr as $row}
	          <div class="schedule__row">{$row.schedule}</div>
	        {/foreach}
	      </div>
      </div>
      {/if}

      {if $company_phones_arr?}
      <div class="contacts__row contacts__phones">
      	<div class="contacts__title"></div>
      	<div class="contacts__items contacts__items_phones phones">
	        {foreach $company_phones_arr as $row}
	          <div class="phones__row">
	            <a class="phones__link contacts__link" href="tel:{$row.phone | clean : 'tel'}">{$row.phone}</a>
	          </div>
	        {/foreach}
      	</div>
      </div>
      {/if}

      {if $company_email?}
      <div class="contacts__row contacts__email">
      	<div class="contacts__title">Электронная почта:</div>
      	<div class="contacts__items contacts__items_email">
	        <a class="contacts__link contacts__link_email" href="mailto:{$company_email}">{$company_email}</a>
      	</div>
      </div>
      {/if}

      {if $social_links_html?}
      <div class="contacts__row contacts__socials">
      	<div class="contacts__title">Мы в сетях:</div>
      	<div class="contacts__items contacts__items_socials socials">
          {$social_links_html}
      	</div>
      </div>
      {/if}
	  </div>

		{if $content?}
    <div class="article__content page-desc">{$content | imageSlimExt : "phpthumbon=q=90"}</div>
    {/if}
  </main>
{/block}


{block 'js'}{/block}