{foreach $options as $name => $values}
	<div class="form-group col-lg-6">
		<label class="control-label" for="option_{$name}">{('ms2_product_' ~ $name) | lexicon}:</label>
		<div>
			<select name="options[{$name}]" class="input-sm form-control" id="option_{$name}">
				{foreach $values as $value}
					<option value="{$value}">{$value}</option>
				{/foreach}
			</select>
		</div>
	</div>
{/foreach}