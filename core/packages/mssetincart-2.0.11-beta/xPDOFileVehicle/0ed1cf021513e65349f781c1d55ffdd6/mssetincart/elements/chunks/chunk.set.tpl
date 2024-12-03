{if $_pls['mssetincart_active']}
	{var $cls = 'active'}
{/if}

<div class='ms2_product mssetincart-product col-md-4 {$cls}'>
	<form method="post" class="ms2_form msoptionsprice-product">
		<input type="hidden" name="id" value="{$id}">
		<input type="hidden" name="options" value="[]">

		<!-- required -->
		{foreach ['link','master','slave','mode','propkey'] as $field}
			{set $field = 'mssetincart_'~$field}
			<input type="hidden" name="{$field}" value="{$_pls[$field]}">
		{/foreach}

		{var $field = 'mssetincart_propkey'}
		<input type="hidden" name="{$field}" value="{$_pls[$field]}" form="{$_pls[$field]}">
		{var $field = 'mssetincart_active'}
		<input type="{$_pls['mssetincart_input']}" name="{$field}[]" value="{$id}" style="display: none;"
			   form="{$_pls['mssetincart_propkey']}" {if $_pls[$field]?}checked="checked"{/if}>
		<!-- end required -->

		<div class="col-lg-6 first">
			<span>
				{if $thumb?}
					<img src="{$thumb}" alt="{$pagetitle}" title="{$pagetitle}"/>
				{else}
					<img src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png"
						 srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x"
						 alt="{$pagetitle}" title="{$pagetitle}"/>
				{/if}
			</span>
		</div>
		<div class="col-lg-6 second">
			<a href='{$id | url}'><h4>{$pagetitle}</h4></a>
			<div class="article">
				{'ms2_product_article' | lexicon}:
				<span class='msoptionsprice-article msoptionsprice-{$id}'>{$article}</span>
			</div>
			<div class="price">
				<span class='msoptionsprice-cost msoptionsprice-{$id}'>{$price}</span>
				{'ms2_frontend_currency' | lexicon}
			</div>
			{if $old_price?}
				<div class="old_price">
					<span class='msoptionsprice-old-cost msoptionsprice-{$id}'>{$old_price}</span>
					{'ms2_frontend_currency' | lexicon}
				</div>
			{/if}
		</div>
		<div class="col-md-12 third">

			<div class="form-group col-lg-12">
				<label class="control-label" for="option_memory">{'ms2_frontend_count_unit' | lexicon}:</label>
				<div>
					<input type="number" name="count" value="{$mssetincart_count}" min="0" max="20"
						   class="input-sm form-control">
				</div>
			</div>

			{$_modx->runSnippet('msOptions',[
			'product' => $id,
			'options' => 'color,size,memory',
			'tpl' => 'tpl.msSetInCart.options'
			])}

		</div>
		<div class="clearfix"></div>
	</form>
</div>
