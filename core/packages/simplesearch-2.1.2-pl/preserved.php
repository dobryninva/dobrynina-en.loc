<?php return array (
  '80a029f57dc8daed96ad383b1fe37822' => 
  array (
    'criteria' => 
    array (
      'name' => 'simplesearch',
    ),
    'object' => 
    array (
      'name' => 'simplesearch',
      'path' => '{core_path}components/simplesearch/',
      'assets_path' => '{assets_path}components/simplesearch/',
    ),
  ),
  'ec06bde7ce9e2ceb3222b02ef9cbf7f3' => 
  array (
    'criteria' => 
    array (
      'key' => 'simplesearch.driver_class',
    ),
    'object' => 
    array (
      'key' => 'simplesearch.driver_class',
      'value' => 'SimpleSearchDriverBasic',
      'xtype' => 'textfield',
      'namespace' => 'simplesearch',
      'area' => 'Drivers',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'cce671c5e6a128ef84657b263c52ca11' => 
  array (
    'criteria' => 
    array (
      'key' => 'simplesearch.driver_class_path',
    ),
    'object' => 
    array (
      'key' => 'simplesearch.driver_class_path',
      'value' => '',
      'xtype' => 'textfield',
      'namespace' => 'simplesearch',
      'area' => 'Drivers',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '9fe0735d2ac62949ee10ec3a568d00e4' => 
  array (
    'criteria' => 
    array (
      'key' => 'simplesearch.driver_db_specific',
    ),
    'object' => 
    array (
      'key' => 'simplesearch.driver_db_specific',
      'value' => '1',
      'xtype' => 'combo-boolean',
      'namespace' => 'simplesearch',
      'area' => 'Drivers',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  '795fc404c44dc49f4da8c5d2ef87c9c1' => 
  array (
    'criteria' => 
    array (
      'key' => 'simplesearch.autosuggest_tv',
    ),
    'object' => 
    array (
      'key' => 'simplesearch.autosuggest_tv',
      'value' => 'simpleSearchAutoSuggestions',
      'xtype' => 'textfield',
      'namespace' => 'simplesearch',
      'area' => 'Autosuggest',
      'editedon' => '0000-00-00 00:00:00',
    ),
  ),
  'ccdfeb0db27480f94aae91787e1ca55a' => 
  array (
    'criteria' => 
    array (
      'category' => 'SimpleSearch',
    ),
    'object' => 
    array (
      'id' => 6,
      'parent' => 0,
      'category' => 'SimpleSearch',
      'rank' => 0,
    ),
  ),
  'bd15e0c6180f37dd5623176fe6bb7071' => 
  array (
    'criteria' => 
    array (
      'name' => 'SearchForm',
    ),
    'object' => 
    array (
      'id' => 222,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SearchForm',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<form class="simplesearch-search-form" action="[[~[[+landing]]]]" method="[[+method]]">
    <fieldset>
        <label for="[[+searchIndex]]">[[%simplesearch.search? &namespace=`simplesearch` &topic=`default`]]</label>

        <input type="text" name="[[+searchIndex]]" id="[[+searchIndex]]" value="[[+searchValue]]" />
        <input type="hidden" name="id" value="[[+landing]]" />

        <input type="submit" value="[[%simplesearch.search? &namespace=`simplesearch` &topic=`default`]]" />
    </fieldset>
</form>
',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<form class="simplesearch-search-form" action="[[~[[+landing]]]]" method="[[+method]]">
    <fieldset>
        <label for="[[+searchIndex]]">[[%simplesearch.search? &namespace=`simplesearch` &topic=`default`]]</label>

        <input type="text" name="[[+searchIndex]]" id="[[+searchIndex]]" value="[[+searchValue]]" />
        <input type="hidden" name="id" value="[[+landing]]" />

        <input type="submit" value="[[%simplesearch.search? &namespace=`simplesearch` &topic=`default`]]" />
    </fieldset>
</form>
',
    ),
  ),
  '6dace06a63419d8d8f6ce9d137f3aa8c' => 
  array (
    'criteria' => 
    array (
      'name' => 'SearchNoResults',
    ),
    'object' => 
    array (
      'id' => 223,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SearchNoResults',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '[[%simplesearch.no_results? &query=`[[+query]]`]]',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '[[%simplesearch.no_results? &query=`[[+query]]`]]',
    ),
  ),
  '45fd9e5f94bc147cdfb1d62d28b037c9' => 
  array (
    'criteria' => 
    array (
      'name' => 'SearchResults',
    ),
    'object' => 
    array (
      'id' => 224,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SearchResults',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<p class="simplesearch-results">[[+resultInfo]]</p>

<div class="simplesearch-paging">
    <span class="simplesearch-result-pages">[[%simplesearch.result_pages? &namespace=`simplesearch` &topic=`default`]]</span>[[+paging]]
</div>

<div class="simplesearch-results-list">
    [[+results]]
</div>

<div class="simplesearch-paging">
    <span class="simplesearch-result-pages">[[%simplesearch.result_pages? &namespace=`simplesearch` &topic=`default`]]</span>
    [[+paging]]
</div>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<p class="simplesearch-results">[[+resultInfo]]</p>

<div class="simplesearch-paging">
    <span class="simplesearch-result-pages">[[%simplesearch.result_pages? &namespace=`simplesearch` &topic=`default`]]</span>[[+paging]]
</div>

<div class="simplesearch-results-list">
    [[+results]]
</div>

<div class="simplesearch-paging">
    <span class="simplesearch-result-pages">[[%simplesearch.result_pages? &namespace=`simplesearch` &topic=`default`]]</span>
    [[+paging]]
</div>',
    ),
  ),
  'd3a26a5447593a2ccc6dd05b6f96a509' => 
  array (
    'criteria' => 
    array (
      'name' => 'SearchResult',
    ),
    'object' => 
    array (
      'id' => 225,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SearchResult',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<div class="simplesearch-result">
    <h3>[[+idx]]. <a href="[[+link:is=``:then=`[[~[[+id]]]]`:else=`[[+link]]`]]" title="[[+longtitle]]">[[+pagetitle]]</a></h3>
    <div class="extract">
        <p>[[+extract]]</p>
    </div>
</div>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<div class="simplesearch-result">
    <h3>[[+idx]]. <a href="[[+link:is=``:then=`[[~[[+id]]]]`:else=`[[+link]]`]]" title="[[+longtitle]]">[[+pagetitle]]</a></h3>
    <div class="extract">
        <p>[[+extract]]</p>
    </div>
</div>',
    ),
  ),
  '828fc6b1f94f467886f97b6a3a8b4e1d' => 
  array (
    'criteria' => 
    array (
      'name' => 'PageLink',
    ),
    'object' => 
    array (
      'id' => 226,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'PageLink',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<span class="simplesearch-page">
    <a href="[[+link]]">[[+text]]</a>
</span>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<span class="simplesearch-page">
    <a href="[[+link]]">[[+text]]</a>
</span>',
    ),
  ),
  '059a536091982fab6fa24c0f0ae90c9e' => 
  array (
    'criteria' => 
    array (
      'name' => 'CurrentPageLink',
    ),
    'object' => 
    array (
      'id' => 227,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'CurrentPageLink',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<span class="simplesearch-page simplesearch-current-page">[[+text]]</span>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<span class="simplesearch-page simplesearch-current-page">[[+text]]</span>',
    ),
  ),
  '1a94d5d43d18393c15fff257947fa5a0' => 
  array (
    'criteria' => 
    array (
      'name' => 'SearchResultLi',
    ),
    'object' => 
    array (
      'id' => 228,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SearchResultLi',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '<li>
    <a href="[[~[[+id]]]]" title="[[+longtitle]]">[[+pagetitle]]</a>
</li>',
      'locked' => 0,
      'properties' => 'a:0:{}',
      'static' => 0,
      'static_file' => '',
      'content' => '<li>
    <a href="[[~[[+id]]]]" title="[[+longtitle]]">[[+pagetitle]]</a>
</li>',
    ),
  ),
  'dca659985fa6446281ae0ea934dce1e1' => 
  array (
    'criteria' => 
    array (
      'name' => 'SimpleSearch',
    ),
    'object' => 
    array (
      'id' => 39,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SimpleSearch',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '/**
 * SimpleSearch snippet
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(
        \'simplesearch.core_path\',
        null,
        $modx->getOption(\'core_path\') . \'components/simplesearch/\'
    ) . \'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx, $scriptProperties);

/* Find search index and toplaceholder setting */
$searchIndex   = $modx->getOption(\'searchIndex\', $scriptProperties, \'search\');
$toPlaceholder = $modx->getOption(\'toPlaceholder\', $scriptProperties, false);
$noResultsTpl  = $modx->getOption(\'noResultsTpl\', $scriptProperties, \'SearchNoResults\');

/* Get search string */
if (empty($_REQUEST[$searchIndex])) {
    $output = $search->getChunk($noResultsTpl, array(
        \'query\' => \'\',
    ));

    return $search->output($output, $toPlaceholder);
}
$searchString = $search->parseSearchString($_REQUEST[$searchIndex]);
if (!$searchString) {
    $output = $search->getChunk($noResultsTpl, array(
        \'query\' => $searchString,
    ));

    return $search->output($output, $toPlaceholder);
}

/* Setup default properties. */
$tpl               = $modx->getOption(\'tpl\', $scriptProperties, \'SearchResult\');
$containerTpl      = $modx->getOption(\'containerTpl\', $scriptProperties, \'SearchResults\');
$showExtract       = $modx->getOption(\'showExtract\', $scriptProperties, true);
$extractSource     = $modx->getOption(\'extractSource\', $scriptProperties, \'content\');
$extractLength     = $modx->getOption(\'extractLength\', $scriptProperties, 200);
$extractEllipsis   = $modx->getOption(\'extractEllipsis\', $scriptProperties, \'...\');
$highlightResults  = $modx->getOption(\'highlightResults\', $scriptProperties, true);
$highlightClass    = $modx->getOption(\'highlightClass\', $scriptProperties, \'simplesearch-highlight\');
$highlightTag      = $modx->getOption(\'highlightTag\', $scriptProperties, \'span\');
$perPage           = $modx->getOption(\'perPage\', $scriptProperties, 10);
$pagingSeparator   = $modx->getOption(\'pagingSeparator\', $scriptProperties, \' | \');
$placeholderPrefix = $modx->getOption(\'placeholderPrefix\', $scriptProperties, \'simplesearch.\');
$includeTVs        = $modx->getOption(\'includeTVs\', $scriptProperties, \'\');
$processTVs        = $modx->getOption(\'processTVs\', $scriptProperties, \'\');
$tvPrefix          = $modx->getOption(\'tvPrefix\', $scriptProperties, \'\');
$offsetIndex       = $modx->getOption(\'offsetIndex\', $scriptProperties, \'simplesearch_offset\');
$idx               = isset($_REQUEST[$offsetIndex]) ? (int) $_REQUEST[$offsetIndex] + 1 : 1;
$postHooks         = $modx->getOption(\'postHooks\', $scriptProperties, \'\');
$activeFacet       = $modx->getOption(\'facet\',$_REQUEST,$modx->getOption(\'activeFacet\', $scriptProperties, \'default\'));
$activeFacet       = $modx->sanitizeString($activeFacet);
$facetLimit        = $modx->getOption(\'facetLimit\', $scriptProperties, 5);
$outputSeparator   = $modx->getOption(\'outputSeparator\', $scriptProperties, "\\n");
$addSearchToLink   = (int) $modx->getOption(\'addSearchToLink\', $scriptProperties, 0);
$searchInLinkName  = $modx->getOption(\'searchInLinkName\', $scriptProperties, \'search\');

/* Get results */
$response     = $search->getSearchResults($searchString, $scriptProperties);
$placeholders = array(\'query\' => $searchString);
$resultsTpl   = array(\'default\' => array(\'results\' => array(), \'total\' => $response[\'total\']));
if (!empty($response[\'results\'])) {
    /* iterate through search results */
    foreach ($response[\'results\'] as $resourceArray) {
        $resourceArray[\'idx\'] = $idx;
        if (empty($resourceArray[\'link\'])) {
            $ctx  = !empty($resourceArray[\'context_key\']) ? $resourceArray[\'context_key\'] : $modx->context->get(\'key\');
            $args = \'\';
            if ($addSearchToLink) {
                $args = array($searchInLinkName => $searchString);
            }

            $resourceArray[\'link\'] = $modx->makeUrl($resourceArray[\'id\'], $ctx, $args);
        }

        if ($showExtract) {
            $extract = $searchString;
            if (array_key_exists($extractSource, $resourceArray)) {
                $text = $resourceArray[$extractSource];
            } else {
                $text = $modx->runSnippet($extractSource, $resourceArray);
            }

            $extract = $search->createExtract($text,$extractLength,$extract,$extractEllipsis);

            /* Cleanup extract */
            $extract = strip_tags(preg_replace("#\\<!--(.*?)--\\>#si", \'\', $extract));
            $extract = preg_replace("#\\[\\[(.*?)\\]\\]#si", \'\', $extract);
            $extract = str_replace(array(\'[[\',\']]\'), \'\', $extract);
            $resourceArray[\'extract\'] = !empty($highlightResults) ? $search->addHighlighting($extract, $highlightClass, $highlightTag) : $extract;
        }

        $resultsTpl[\'default\'][\'results\'][] = $search->getChunk($tpl, $resourceArray);

        $idx++;
    }
}

/* Load postHooks to get faceted results. */
if (!empty($postHooks)) {
    $limit = !empty($facetLimit) ? $facetLimit : $perPage;

    $search->loadHooks(\'post\');
    $search->postHooks->loadMultiple($postHooks, $response[\'results\'],
                                     array(
                                         \'hooks\'   => $postHooks,
                                         \'search\'  => $searchString,
                                         \'offset\'  => !empty($_GET[$offsetIndex]) ? (int) $_GET[$offsetIndex] : 0,
                                         \'limit\'   => $limit,
                                         \'perPage\' => $limit,
                                     )
    );

    if (!empty($search->postHooks->facets)) {
        foreach ($search->postHooks->facets as $facetKey => $facetResults) {
            if (empty($resultsTpl[$facetKey])) {
                $resultsTpl[$facetKey]            = array();
                $resultsTpl[$facetKey][\'total\']   = $facetResults[\'total\'];
                $resultsTpl[$facetKey][\'results\'] = array();
            } else {
                $resultsTpl[$facetKey][\'total\'] = $resultsTpl[$facetKey][\'total\'] = $facetResults[\'total\'];
            }

            $idx = !empty($resultsTpl[$facetKey]) ? count($resultsTpl[$facetKey][\'results\']) + 1 : 1;
            foreach ($facetResults[\'results\'] as $r) {
                $r[\'idx\']                           = $idx;
                $fTpl                               = !empty($scriptProperties[\'tpl\' . $facetKey]) ? $scriptProperties[\'tpl\' . $facetKey] : $tpl;
                $resultsTpl[$facetKey][\'results\'][] = $search->getChunk($fTpl,$r);
                $idx++;
            }
        }
    }
}

/* Set faceted results to placeholders for easy result positioning. */
$output = array();
foreach ($resultsTpl as $facetKey => $facetResults) {
    $resultSet                          = implode($outputSeparator,$facetResults[\'results\']);
    $placeholders[$facetKey.\'.results\'] = $resultSet;
    $placeholders[$facetKey.\'.total\']   = !empty($facetResults[\'total\']) ? $facetResults[\'total\'] : 0;
    $placeholders[$facetKey.\'.key\']     = $facetKey;
}

$placeholders[\'results\']   = $placeholders[$activeFacet . \'.results\']; /* Set active facet results. */
$placeholders[\'total\']     = !empty($resultsTpl[$activeFacet][\'total\']) ? $resultsTpl[$activeFacet][\'total\'] : 0;
$placeholders[\'page\']      = isset($_REQUEST[$offsetIndex]) ? ceil((int) $_REQUEST[$offsetIndex] / $perPage) + 1 : 1;
$placeholders[\'pageCount\'] = !empty($resultsTpl[$activeFacet][\'total\']) ? ceil($resultsTpl[$activeFacet][\'total\'] / $perPage) : 1;

if (!empty($response[\'results\'])) {
    /* add results found message */
    $placeholders[\'resultInfo\'] = $modx->lexicon(\'simplesearch.results_found\', array(
        \'count\' => $placeholders[\'total\'],
        \'text\'  => !empty($highlightResults) ? $search->addHighlighting($searchString, $highlightClass, $highlightTag) : $searchString,
    ));

    /* If perPage set to >0, add paging */
    if ($perPage > 0) {
        $placeholders[\'paging\'] = $search->getPagination($searchString,$perPage,$pagingSeparator,$placeholders[\'total\']);
    }
}

$placeholders[\'query\'] = $searchString;
$placeholders[\'facet\'] = $activeFacet;

/* output */
$modx->setPlaceholder($placeholderPrefix . \'query\', $searchString);
$modx->setPlaceholder($placeholderPrefix . \'count\', $response[\'total\']);
$modx->setPlaceholders($placeholders, $placeholderPrefix);

if (empty($response[\'results\'])) {
    $output = $search->getChunk($noResultsTpl, array(
        \'query\' => $searchString,
    ));
} else {
    $output = $search->getChunk($containerTpl, $placeholders);
}

return $search->output($output, $toPlaceholder);',
      'locked' => 0,
      'properties' => 'a:43:{s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:21:"simplesearch.tpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:12:"SearchResult";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:12:"containerTpl";a:7:{s:4:"name";s:12:"containerTpl";s:4:"desc";s:30:"simplesearch.containertpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:13:"SearchResults";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"useAllWords";a:7:{s:4:"name";s:11:"useAllWords";s:4:"desc";s:29:"simplesearch.useallwords_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:8:"maxWords";a:7:{s:4:"name";s:8:"maxWords";s:4:"desc";s:26:"simplesearch.maxwords_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:7;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:8:"minChars";a:7:{s:4:"name";s:8:"minChars";s:4:"desc";s:26:"simplesearch.minchars_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:3;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"searchStyle";a:7:{s:4:"name";s:11:"searchStyle";s:4:"desc";s:29:"simplesearch.searchstyle_desc";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:20:"simplesearch.partial";s:5:"value";s:7:"partial";}i:1;a:2:{s:4:"text";s:18:"simplesearch.match";s:5:"value";s:5:"match";}}s:5:"value";s:7:"partial";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:7:"perPage";a:7:{s:4:"name";s:7:"perPage";s:4:"desc";s:25:"simplesearch.perpage_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:10;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"showExtract";a:7:{s:4:"name";s:11:"showExtract";s:4:"desc";s:29:"simplesearch.showextract_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:13:"extractLength";a:7:{s:4:"name";s:13:"extractLength";s:4:"desc";s:31:"simplesearch.extractlength_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:200;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:15:"extractEllipsis";a:7:{s:4:"name";s:15:"extractEllipsis";s:4:"desc";s:33:"simplesearch.extractellipsis_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:"...";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:10:"includeTVs";a:7:{s:4:"name";s:10:"includeTVs";s:4:"desc";s:28:"simplesearch.includetvs_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:10:"processTVs";a:7:{s:4:"name";s:10:"processTVs";s:4:"desc";s:28:"simplesearch.processtvs_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:0;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:16:"highlightResults";a:7:{s:4:"name";s:16:"highlightResults";s:4:"desc";s:34:"simplesearch.highlightresults_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:14:"highlightClass";a:7:{s:4:"name";s:14:"highlightClass";s:4:"desc";s:32:"simplesearch.highlightclass_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:22:"simplesearch-highlight";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:12:"highlightTag";a:7:{s:4:"name";s:12:"highlightTag";s:4:"desc";s:30:"simplesearch.highlighttag_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:4:"span";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:9:"pageLimit";a:7:{s:4:"name";s:9:"pageLimit";s:4:"desc";s:27:"simplesearch.pagelimit_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:1:"0";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:7:"pageTpl";a:7:{s:4:"name";s:7:"pageTpl";s:4:"desc";s:25:"simplesearch.pagetpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:8:"PageLink";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:12:"pageFirstTpl";a:7:{s:4:"name";s:12:"pageFirstTpl";s:4:"desc";s:30:"simplesearch.pagefirsttpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"pageLastTpl";a:7:{s:4:"name";s:11:"pageLastTpl";s:4:"desc";s:29:"simplesearch.pagelasttpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"pagePrevTpl";a:7:{s:4:"name";s:11:"pagePrevTpl";s:4:"desc";s:29:"simplesearch.pageprevtpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"pageNextTpl";a:7:{s:4:"name";s:11:"pageNextTpl";s:4:"desc";s:29:"simplesearch.pagenexttpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:14:"currentPageTpl";a:7:{s:4:"name";s:14:"currentPageTpl";s:4:"desc";s:32:"simplesearch.currentpagetpl_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:15:"CurrentPageLink";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:15:"pagingSeparator";a:7:{s:4:"name";s:15:"pagingSeparator";s:4:"desc";s:33:"simplesearch.pagingseparator_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:3:" | ";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:3:"ids";a:7:{s:4:"name";s:3:"ids";s:4:"desc";s:21:"simplesearch.ids_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:6:"idType";a:7:{s:4:"name";s:6:"idType";s:4:"desc";s:24:"simplesearch.idtype_desc";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:20:"simplesearch.parents";s:5:"value";s:7:"parents";}i:1;a:2:{s:4:"text";s:22:"simplesearch.documents";s:5:"value";s:9:"documents";}}s:5:"value";s:7:"parents";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:7:"exclude";a:7:{s:4:"name";s:7:"exclude";s:4:"desc";s:25:"simplesearch.exclude_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:5:"depth";a:7:{s:4:"name";s:5:"depth";s:4:"desc";s:23:"simplesearch.depth_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:10;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:8:"hideMenu";a:7:{s:4:"name";s:8:"hideMenu";s:4:"desc";s:26:"simplesearch.hidemenu_desc";s:4:"type";s:9:"textfield";s:7:"options";a:3:{i:0;a:2:{s:4:"text";s:29:"simplesearch.hidemenu_visible";s:5:"value";i:0;}i:1;a:2:{s:4:"text";s:28:"simplesearch.hidemenu_hidden";s:5:"value";i:1;}i:2;a:2:{s:4:"text";s:26:"simplesearch.hidemenu_both";s:5:"value";i:2;}}s:5:"value";i:2;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:8:"contexts";a:7:{s:4:"name";s:8:"contexts";s:4:"desc";s:26:"simplesearch.contexts_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"searchIndex";a:7:{s:4:"name";s:11:"searchIndex";s:4:"desc";s:29:"simplesearch.searchindex_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"search";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"offsetIndex";a:7:{s:4:"name";s:11:"offsetIndex";s:4:"desc";s:29:"simplesearch.offsetindex_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:19:"simplesearch_offset";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:17:"placeholderPrefix";a:7:{s:4:"name";s:17:"placeholderPrefix";s:4:"desc";s:35:"simplesearch.placeholderprefix_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:13:"simplesearch.";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:13:"toPlaceholder";a:7:{s:4:"name";s:13:"toPlaceholder";s:4:"desc";s:31:"simplesearch.toplaceholder_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:8:"andTerms";a:7:{s:4:"name";s:8:"andTerms";s:4:"desc";s:26:"simplesearch.andterms_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:13:"matchWildcard";a:7:{s:4:"name";s:13:"matchWildcard";s:4:"desc";s:31:"simplesearch.matchwildcard_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";s:0:"";s:5:"value";b:1;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:9:"docFields";a:7:{s:4:"name";s:9:"docFields";s:4:"desc";s:27:"simplesearch.docfields_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:55:"pagetitle,longtitle,alias,description,introtext,content";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:12:"fieldPotency";a:7:{s:4:"name";s:12:"fieldPotency";s:4:"desc";s:30:"simplesearch.fieldpotency_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:9:"urlScheme";a:7:{s:4:"name";s:9:"urlScheme";s:4:"desc";s:27:"simplesearch.urlscheme_desc";s:4:"type";s:4:"list";s:7:"options";a:3:{i:0;a:2:{s:4:"text";s:25:"simplesearch.url_relative";s:5:"value";i:-1;}i:1;a:2:{s:4:"text";s:25:"simplesearch.url_absolute";s:5:"value";s:3:"abs";}i:2;a:2:{s:4:"text";s:21:"simplesearch.url_full";s:5:"value";s:4:"full";}}s:5:"value";i:-1;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:9:"postHooks";a:7:{s:4:"name";s:9:"postHooks";s:4:"desc";s:27:"simplesearch.posthooks_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"activeFacet";a:7:{s:4:"name";s:11:"activeFacet";s:4:"desc";s:29:"simplesearch.activefacet_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:7:"default";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:10:"facetLimit";a:7:{s:4:"name";s:10:"facetLimit";s:4:"desc";s:28:"simplesearch.facetlimit_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";i:5;s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:6:"sortBy";a:7:{s:4:"name";s:6:"sortBy";s:4:"desc";s:24:"simplesearch.sortby_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:7:"sortDir";a:7:{s:4:"name";s:7:"sortDir";s:4:"desc";s:25:"simplesearch.sortdir_desc";s:4:"type";s:4:"list";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:22:"simplesearch.ascending";s:5:"value";s:3:"ASC";}i:1;a:2:{s:4:"text";s:23:"simplesearch.descending";s:5:"value";s:4:"DESC";}}s:5:"value";s:4:"DESC";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * SimpleSearch snippet
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(
        \'simplesearch.core_path\',
        null,
        $modx->getOption(\'core_path\') . \'components/simplesearch/\'
    ) . \'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx, $scriptProperties);

/* Find search index and toplaceholder setting */
$searchIndex   = $modx->getOption(\'searchIndex\', $scriptProperties, \'search\');
$toPlaceholder = $modx->getOption(\'toPlaceholder\', $scriptProperties, false);
$noResultsTpl  = $modx->getOption(\'noResultsTpl\', $scriptProperties, \'SearchNoResults\');

/* Get search string */
if (empty($_REQUEST[$searchIndex])) {
    $output = $search->getChunk($noResultsTpl, array(
        \'query\' => \'\',
    ));

    return $search->output($output, $toPlaceholder);
}
$searchString = $search->parseSearchString($_REQUEST[$searchIndex]);
if (!$searchString) {
    $output = $search->getChunk($noResultsTpl, array(
        \'query\' => $searchString,
    ));

    return $search->output($output, $toPlaceholder);
}

/* Setup default properties. */
$tpl               = $modx->getOption(\'tpl\', $scriptProperties, \'SearchResult\');
$containerTpl      = $modx->getOption(\'containerTpl\', $scriptProperties, \'SearchResults\');
$showExtract       = $modx->getOption(\'showExtract\', $scriptProperties, true);
$extractSource     = $modx->getOption(\'extractSource\', $scriptProperties, \'content\');
$extractLength     = $modx->getOption(\'extractLength\', $scriptProperties, 200);
$extractEllipsis   = $modx->getOption(\'extractEllipsis\', $scriptProperties, \'...\');
$highlightResults  = $modx->getOption(\'highlightResults\', $scriptProperties, true);
$highlightClass    = $modx->getOption(\'highlightClass\', $scriptProperties, \'simplesearch-highlight\');
$highlightTag      = $modx->getOption(\'highlightTag\', $scriptProperties, \'span\');
$perPage           = $modx->getOption(\'perPage\', $scriptProperties, 10);
$pagingSeparator   = $modx->getOption(\'pagingSeparator\', $scriptProperties, \' | \');
$placeholderPrefix = $modx->getOption(\'placeholderPrefix\', $scriptProperties, \'simplesearch.\');
$includeTVs        = $modx->getOption(\'includeTVs\', $scriptProperties, \'\');
$processTVs        = $modx->getOption(\'processTVs\', $scriptProperties, \'\');
$tvPrefix          = $modx->getOption(\'tvPrefix\', $scriptProperties, \'\');
$offsetIndex       = $modx->getOption(\'offsetIndex\', $scriptProperties, \'simplesearch_offset\');
$idx               = isset($_REQUEST[$offsetIndex]) ? (int) $_REQUEST[$offsetIndex] + 1 : 1;
$postHooks         = $modx->getOption(\'postHooks\', $scriptProperties, \'\');
$activeFacet       = $modx->getOption(\'facet\',$_REQUEST,$modx->getOption(\'activeFacet\', $scriptProperties, \'default\'));
$activeFacet       = $modx->sanitizeString($activeFacet);
$facetLimit        = $modx->getOption(\'facetLimit\', $scriptProperties, 5);
$outputSeparator   = $modx->getOption(\'outputSeparator\', $scriptProperties, "\\n");
$addSearchToLink   = (int) $modx->getOption(\'addSearchToLink\', $scriptProperties, 0);
$searchInLinkName  = $modx->getOption(\'searchInLinkName\', $scriptProperties, \'search\');

/* Get results */
$response     = $search->getSearchResults($searchString, $scriptProperties);
$placeholders = array(\'query\' => $searchString);
$resultsTpl   = array(\'default\' => array(\'results\' => array(), \'total\' => $response[\'total\']));
if (!empty($response[\'results\'])) {
    /* iterate through search results */
    foreach ($response[\'results\'] as $resourceArray) {
        $resourceArray[\'idx\'] = $idx;
        if (empty($resourceArray[\'link\'])) {
            $ctx  = !empty($resourceArray[\'context_key\']) ? $resourceArray[\'context_key\'] : $modx->context->get(\'key\');
            $args = \'\';
            if ($addSearchToLink) {
                $args = array($searchInLinkName => $searchString);
            }

            $resourceArray[\'link\'] = $modx->makeUrl($resourceArray[\'id\'], $ctx, $args);
        }

        if ($showExtract) {
            $extract = $searchString;
            if (array_key_exists($extractSource, $resourceArray)) {
                $text = $resourceArray[$extractSource];
            } else {
                $text = $modx->runSnippet($extractSource, $resourceArray);
            }

            $extract = $search->createExtract($text,$extractLength,$extract,$extractEllipsis);

            /* Cleanup extract */
            $extract = strip_tags(preg_replace("#\\<!--(.*?)--\\>#si", \'\', $extract));
            $extract = preg_replace("#\\[\\[(.*?)\\]\\]#si", \'\', $extract);
            $extract = str_replace(array(\'[[\',\']]\'), \'\', $extract);
            $resourceArray[\'extract\'] = !empty($highlightResults) ? $search->addHighlighting($extract, $highlightClass, $highlightTag) : $extract;
        }

        $resultsTpl[\'default\'][\'results\'][] = $search->getChunk($tpl, $resourceArray);

        $idx++;
    }
}

/* Load postHooks to get faceted results. */
if (!empty($postHooks)) {
    $limit = !empty($facetLimit) ? $facetLimit : $perPage;

    $search->loadHooks(\'post\');
    $search->postHooks->loadMultiple($postHooks, $response[\'results\'],
                                     array(
                                         \'hooks\'   => $postHooks,
                                         \'search\'  => $searchString,
                                         \'offset\'  => !empty($_GET[$offsetIndex]) ? (int) $_GET[$offsetIndex] : 0,
                                         \'limit\'   => $limit,
                                         \'perPage\' => $limit,
                                     )
    );

    if (!empty($search->postHooks->facets)) {
        foreach ($search->postHooks->facets as $facetKey => $facetResults) {
            if (empty($resultsTpl[$facetKey])) {
                $resultsTpl[$facetKey]            = array();
                $resultsTpl[$facetKey][\'total\']   = $facetResults[\'total\'];
                $resultsTpl[$facetKey][\'results\'] = array();
            } else {
                $resultsTpl[$facetKey][\'total\'] = $resultsTpl[$facetKey][\'total\'] = $facetResults[\'total\'];
            }

            $idx = !empty($resultsTpl[$facetKey]) ? count($resultsTpl[$facetKey][\'results\']) + 1 : 1;
            foreach ($facetResults[\'results\'] as $r) {
                $r[\'idx\']                           = $idx;
                $fTpl                               = !empty($scriptProperties[\'tpl\' . $facetKey]) ? $scriptProperties[\'tpl\' . $facetKey] : $tpl;
                $resultsTpl[$facetKey][\'results\'][] = $search->getChunk($fTpl,$r);
                $idx++;
            }
        }
    }
}

/* Set faceted results to placeholders for easy result positioning. */
$output = array();
foreach ($resultsTpl as $facetKey => $facetResults) {
    $resultSet                          = implode($outputSeparator,$facetResults[\'results\']);
    $placeholders[$facetKey.\'.results\'] = $resultSet;
    $placeholders[$facetKey.\'.total\']   = !empty($facetResults[\'total\']) ? $facetResults[\'total\'] : 0;
    $placeholders[$facetKey.\'.key\']     = $facetKey;
}

$placeholders[\'results\']   = $placeholders[$activeFacet . \'.results\']; /* Set active facet results. */
$placeholders[\'total\']     = !empty($resultsTpl[$activeFacet][\'total\']) ? $resultsTpl[$activeFacet][\'total\'] : 0;
$placeholders[\'page\']      = isset($_REQUEST[$offsetIndex]) ? ceil((int) $_REQUEST[$offsetIndex] / $perPage) + 1 : 1;
$placeholders[\'pageCount\'] = !empty($resultsTpl[$activeFacet][\'total\']) ? ceil($resultsTpl[$activeFacet][\'total\'] / $perPage) : 1;

if (!empty($response[\'results\'])) {
    /* add results found message */
    $placeholders[\'resultInfo\'] = $modx->lexicon(\'simplesearch.results_found\', array(
        \'count\' => $placeholders[\'total\'],
        \'text\'  => !empty($highlightResults) ? $search->addHighlighting($searchString, $highlightClass, $highlightTag) : $searchString,
    ));

    /* If perPage set to >0, add paging */
    if ($perPage > 0) {
        $placeholders[\'paging\'] = $search->getPagination($searchString,$perPage,$pagingSeparator,$placeholders[\'total\']);
    }
}

$placeholders[\'query\'] = $searchString;
$placeholders[\'facet\'] = $activeFacet;

/* output */
$modx->setPlaceholder($placeholderPrefix . \'query\', $searchString);
$modx->setPlaceholder($placeholderPrefix . \'count\', $response[\'total\']);
$modx->setPlaceholders($placeholders, $placeholderPrefix);

if (empty($response[\'results\'])) {
    $output = $search->getChunk($noResultsTpl, array(
        \'query\' => $searchString,
    ));
} else {
    $output = $search->getChunk($containerTpl, $placeholders);
}

return $search->output($output, $toPlaceholder);',
    ),
  ),
  '181d70bf60cb4771b3b88222ac682ebb' => 
  array (
    'criteria' => 
    array (
      'name' => 'SimpleSearchForm',
    ),
    'object' => 
    array (
      'id' => 40,
      'source' => 0,
      'property_preprocess' => 0,
      'name' => 'SimpleSearchForm',
      'description' => '',
      'editor_type' => 0,
      'category' => 6,
      'cache_type' => 0,
      'snippet' => '/**
 * Show the search form
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(
    \'simplesearch.core_path\',
    null,
    $modx->getOption(\'core_path\') . \'components/simplesearch/\'
) . \'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx, $scriptProperties);

/* Setup default options. */
$scriptProperties = array_merge(
    array(
        \'tpl\'           => \'SearchForm\',
        \'method\'        => \'get\',
        \'searchIndex\'   => \'search\',
        \'toPlaceholder\' => false,
        \'landing\'       => $modx->resource->get(\'id\'),
), $scriptProperties);

if (empty($scriptProperties[\'landing\'])) {
  $scriptProperties[\'landing\'] = $modx->resource->get(\'id\');
}

/* If get value already exists, set it as default. */
$searchValue  = isset($_REQUEST[$scriptProperties[\'searchIndex\']]) ? $_REQUEST[$scriptProperties[\'searchIndex\']] : \'\';
$searchValues = explode(\' \', $searchValue);

array_map(array($modx, \'sanitizeString\'), $searchValues);

$searchValue  = implode(\' \', $searchValues);
$placeholders = array(
    \'method\'      => $scriptProperties[\'method\'],
    \'landing\'     => $scriptProperties[\'landing\'],
    \'searchValue\' => strip_tags(htmlspecialchars($searchValue, ENT_QUOTES, \'UTF-8\')),
    \'searchIndex\' => $scriptProperties[\'searchIndex\'],
);

$output = $search->getChunk($scriptProperties[\'tpl\'], $placeholders);

return $search->output($output, $scriptProperties[\'toPlaceholder\']);',
      'locked' => 0,
      'properties' => 'a:5:{s:3:"tpl";a:7:{s:4:"name";s:3:"tpl";s:4:"desc";s:26:"simplesearch.tpl_form_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:10:"SearchForm";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:7:"landing";a:7:{s:4:"name";s:7:"landing";s:4:"desc";s:25:"simplesearch.landing_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:11:"searchIndex";a:7:{s:4:"name";s:11:"searchIndex";s:4:"desc";s:29:"simplesearch.searchindex_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:6:"search";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:6:"method";a:7:{s:4:"name";s:6:"method";s:4:"desc";s:24:"simplesearch.method_desc";s:4:"type";s:13:"combo-boolean";s:7:"options";a:2:{i:0;a:2:{s:4:"text";s:16:"simplesearch.get";s:5:"value";s:3:"get";}i:1;a:2:{s:4:"text";s:17:"simplesearch.post";s:5:"value";s:4:"post";}}s:5:"value";s:3:"get";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}s:13:"toPlaceholder";a:7:{s:4:"name";s:13:"toPlaceholder";s:4:"desc";s:31:"simplesearch.toplaceholder_desc";s:4:"type";s:9:"textfield";s:7:"options";s:0:"";s:5:"value";s:0:"";s:7:"lexicon";s:23:"simplesearch:properties";s:4:"area";s:0:"";}}',
      'moduleguid' => '',
      'static' => 0,
      'static_file' => '',
      'content' => '/**
 * Show the search form
 *
 * @var modX $modx
 * @var array $scriptProperties
 * @package simplesearch
 */
require_once $modx->getOption(
    \'simplesearch.core_path\',
    null,
    $modx->getOption(\'core_path\') . \'components/simplesearch/\'
) . \'model/simplesearch/simplesearch.class.php\';
$search = new SimpleSearch($modx, $scriptProperties);

/* Setup default options. */
$scriptProperties = array_merge(
    array(
        \'tpl\'           => \'SearchForm\',
        \'method\'        => \'get\',
        \'searchIndex\'   => \'search\',
        \'toPlaceholder\' => false,
        \'landing\'       => $modx->resource->get(\'id\'),
), $scriptProperties);

if (empty($scriptProperties[\'landing\'])) {
  $scriptProperties[\'landing\'] = $modx->resource->get(\'id\');
}

/* If get value already exists, set it as default. */
$searchValue  = isset($_REQUEST[$scriptProperties[\'searchIndex\']]) ? $_REQUEST[$scriptProperties[\'searchIndex\']] : \'\';
$searchValues = explode(\' \', $searchValue);

array_map(array($modx, \'sanitizeString\'), $searchValues);

$searchValue  = implode(\' \', $searchValues);
$placeholders = array(
    \'method\'      => $scriptProperties[\'method\'],
    \'landing\'     => $scriptProperties[\'landing\'],
    \'searchValue\' => strip_tags(htmlspecialchars($searchValue, ENT_QUOTES, \'UTF-8\')),
    \'searchIndex\' => $scriptProperties[\'searchIndex\'],
);

$output = $search->getChunk($scriptProperties[\'tpl\'], $placeholders);

return $search->output($output, $scriptProperties[\'toPlaceholder\']);',
    ),
  ),
);