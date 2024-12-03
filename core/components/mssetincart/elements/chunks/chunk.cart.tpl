{$_modx->lexicon->load('minishop2:product')}

<div id="msCart">
	{if !count($products)}
		{'ms2_cart_is_empty' | lexicon}
	{else}
		<div class="table-responsive">
			<table class="table table-striped">
				<tr class="header">
					<th class="image">&nbsp;</th>
					<th class="title">{'ms2_cart_title' | lexicon}</th>
					<th class="count">{'ms2_cart_count' | lexicon}</th>
					<th class="weight">{'ms2_cart_weight' | lexicon}</th>
					<th class="price">{'ms2_cart_price' | lexicon}</th>
					<th class="remove">{'ms2_cart_remove' | lexicon}</th>
				</tr>

				{foreach $products as $product}

					{*$product|print*}
					<tr id="{$product.key}" mssetincart-master="{$product['option.mssetincart']['master_key']}">
						<td class="image">

							{* get main modification *}
							{set $modification = []}
							{if $product.options and $product.options.modification?}
								{set $modification = $_modx->runSnippet('!msOptionsPrice.modification',[
								'product' => $product.id,
								'includeThumbs' => 'small',
								'where' => json_encode([
								'msopModification.id' => $product.options.modification
								]),
								'return' => 'data'
								])}
								{set $modification = $modification[0]}
							{/if}

							{*$modification|print_r*}
							{if $modification['small']?}
								{set $product.thumb = $modification['small']}
								{set $product.old_price = $modification['old_price']}
							{/if}

							{* get all modification *}
							{if $product.options and $product.options.modifications?}
								{set $modifications = $_modx->runSnippet('!msOptionsPrice.modification',[
								'product' => $product.id,
								'type' => '1,2,3',
								'sortby'=> 'type',
								'includeThumbs' => 'small',
								'where' => json_encode([
								'msopModification.id:IN' => $product.options.modifications
								]),
								'return' => 'data'
								])}
							{/if}

							{* get product colors *}
							{if $product.options?}
								{set $colors = $_modx->runSnippet('!msOptionsColor',[
								'product' => $product.id,
								'byOptions' => json_encode($product.options),
								'return' => 'data'
								])}
							{/if}

							{if $product.thumb?}
								<img src="{$product.thumb}" alt="{$product.pagetitle}" title="{$product.pagetitle}"/>
							{else}
								<img src="{'assets_url' | option}components/minishop2/img/web/ms2_small.png"
									 srcset="{'assets_url' | option}components/minishop2/img/web/ms2_small@2x.png 2x"
									 alt="{$product.pagetitle}" title="{$product.pagetitle}"/>
							{/if}
						</td>
						<td class="title">
							{if $product.id?}
								<a href="{$product.id | url}">{$product.pagetitle}</a>
							{else}
								{$product.name}
							{/if}

							{if $product.options?}
								{foreach $product.options as $key => $option}

									{set $tmp = $key|preg_replace : '#\_.*#' : ''}
									{if $tmp in ['modification','modifications','mssetincart','msal']}{continue}{/if}
									<br>
									{set $caption = $product[$key ~ '.caption']}
									{set $caption = $caption ? $caption : ('ms2_product_' ~ $key) | lexicon}

									{if $option is array}
										{$caption} - {$option | join : '; '}
									{else}
										{$caption} - {$option}
									{/if}

								{/foreach}

								{if $product.options.mssetincart}
									<br>
									{$_modx->getChunk('tpl.msSetInCart.info', $product.options.mssetincart)}
								{/if}
							{/if}

							{if $modification}
								article: {$modification['article']}
								<br>
							{/if}

							{if $colors?}
								{foreach $colors as $row index=$index}
									{if $row.pattern?}
										<div>
											<img alt="" title="{$row.value}" class="img-rounded"
												 style="background-image:url({$row.pattern});width:25px;height:25px;">
										</div>
									{else}
										<div>
											<img alt="" title="{$row.value}" class="img-rounded"
												 style="background-color:#{$row.color};width:25px;height:25px;">
										</div>
									{/if}
									{$row.value}
								{/foreach}
							{/if}

						</td>
						<td class="count">
							<form method="post" class="ms2_form form-inline" role="form">
								<input type="hidden" name="key" value="{$product.key}"/>
								<div class="form-group">
									<input type="number" name="count" value="{$product.count}"
										   class="input-sm form-control"/>
									<span class="hidden-xs">{'ms2_frontend_count_unit' | lexicon}</span>
									<button class="btn btn-default" type="submit" name="ms2_action" value="cart/change">
										<i class="glyphicon glyphicon-refresh"></i>
									</button>
								</div>
							</form>
						</td>
						<td class="weight">
							<span>{$product.weight}</span> {'ms2_frontend_weight_unit' | lexicon}
						</td>
						<td class="price">
							<span>{$product.price}</span> {'ms2_frontend_currency' | lexicon}
							{if $product.old_price?}
							<span class="old_price">{$product.old_price} {'ms2_frontend_currency' | lexicon}
								{/if}
						</td>
						<td class="remove">
							<form method="post" class="ms2_form">
								<input type="hidden" name="key" value="{$product.key}">
								<button class="btn btn-default" type="submit" name="ms2_action" value="cart/remove">
									<i class="glyphicon glyphicon-remove"></i>
								</button>
							</form>
						</td>
					</tr>
				{/foreach}

				<tr class="footer">
					<th class="total" colspan="2">{'ms2_cart_total' | lexicon}:</th>
					<th class="total_count">
						<span class="ms2_total_count">{$total.count}</span>
						{'ms2_frontend_count_unit' | lexicon}
					</th>
					<th class="total_weight">
						<span class="ms2_total_weight">{$total.weight}</span>
						{'ms2_frontend_weight_unit' | lexicon}
					</th>
					<th class="total_cost">
						<span class="ms2_total_cost">{$total.cost}</span>
						{'ms2_frontend_currency' | lexicon}
					</th>
					<th>&nbsp;</th>
				</tr>
			</table>
		</div>
		<form method="post">
			<button class="btn btn-default" type="submit" name="ms2_action" value="cart/clean">
				<i class="glyphicon glyphicon-remove"></i> {'ms2_cart_clean' | lexicon}
			</button>
		</form>
	{/if}
</div>