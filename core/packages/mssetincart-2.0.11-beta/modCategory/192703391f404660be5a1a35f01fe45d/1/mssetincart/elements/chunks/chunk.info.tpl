{filter|strip|replace:["\t"]:""}
{foreach $option as $row}
	{$row.pagetitle} - {$row.count} {'ms2_frontend_count_unit' | lexicon} {$row.cost} {'ms2_frontend_currency' | lexicon}
	{$.const.PHP_EOL}
{/foreach}
{/filter}


