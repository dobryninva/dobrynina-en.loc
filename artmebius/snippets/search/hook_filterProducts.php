<?php

$ids = explode(',', $resourcesOnTplsIds);

$query = $modx->newQuery('modResource');
$query->select(
    $modx->getSelectColumns(
        'modResource',
        'modResource',
        '',
        array()
    )
);
$query->select(
    $modx->getSelectColumns(
        'modTemplateVarTemplate',
        'modTemplateVarTemplate',
        '',
        array('templateid', 'tmplvarid')
    )
);
$query->select(
    $modx->getSelectColumns(
        'modTemplateVarResource',
        'modTemplateVarResource',
        '',
        array('contentid', 'value', 'tmplvarid')
    )
);

$query->leftJoin(
    'modTemplateVarTemplate',
    'modTemplateVarTemplate',
    'modTemplateVarTemplate.templateid = modResource.template'
);
$query->leftJoin(
    'modTemplateVarResource',
    'modTemplateVarResource',
    'modTemplateVarResource.tmplvarid = modTemplateVarTemplate.tmplvarid AND modTemplateVarResource.contentid = modResource.id'
);
$query->where(array(
    'modResource.pagetitle:LIKE' => '%'.trim(str_replace(' ', '%', $_REQUEST[$searchIndex])).'%',
    'modResource.template:IN' => $ids,
    'modTemplateVarResource.id IS NOT NULL'
));
$query->sortby('modResource.id', 'ASC');
$query->groupBy('id');
$query->prepare();
$count = $modx->getCount('modResource', $query);
$offset = intval($_REQUEST["sisea_offset"]);
if ($offset > 0)
	$query->limit(20, $offset);
else
	$query->limit(20);
$query->prepare();
$resources = $modx->query($query->toSQL());
//if(is_array($resources)){
    @$hook->addFacet('products', $resources, $count);
//}

return true;

?>
