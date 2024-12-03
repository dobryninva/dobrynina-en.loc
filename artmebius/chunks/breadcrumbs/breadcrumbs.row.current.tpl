{* Для истории заказов *}
{if $id == 17}
	{if $.get.view == 'detail'}
		<li class="breadcrumbs__item"><a href="{$link}">{$menutitle}</a></li><li class="breadcrumbs__item breadcrumbs__item_separator">-</li><li class="breadcrumbs__item">Заказ №{$.get.order_id}</li>
    {else}
		<li class="breadcrumbs__item">{$menutitle}</li>
	{/if}
{else}
	<li class="breadcrumbs__item" itemscope itemprop="itemListElement" itemtype="http://schema.org/ListItem">
    <meta itemprop="position" content="{$idx}" />
    <span class="breadcrumbs__current" itemprop="name">{$menutitle}</span>
	</li>
{/if}