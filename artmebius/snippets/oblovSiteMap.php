<?php
$priority = $modx->getOption('priority', $scriptProperties, 1);
$changeFreq = $modx->getOption('changeFreq', $scriptProperties, 1);
$excludeResources = $modx->getOption('excludeResources', $scriptProperties, '');
$ex = (empty($excludeResources))? '' : " AND s.id NOT IN(" . $excludeResources . ")";

$datetime = new DateTime('NOW');
$datetime->modify('-7 day');
$modified = $datetime->format("Y-m-d");

$options_c = array(
  xPDO::OPT_CACHE_KEY => 'sitemap',
);
//var_dump($_SERVER);exit;
$output = $modx->cacheManager->get('sitemap', $options_c);
$output = '';
if (empty($output)) {
    $output = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    ';
    $sql_sitemap = "
        SELECT
          GROUP_CONCAT(
                '<url>',
                CONCAT('<loc>" . MODX_URL_SCHEME . $_SERVER['HTTP_HOST'] .'/'. "',uri,'</loc>'),
                CONCAT('<lastmod>','{$modified}', '</lastmod>'),
                CONCAT('<priority>','{$priority}','</priority>'),
                CONCAT('<changefreq>','{$changeFreq}', '</changefreq>'),
                '</url>'
                SEPARATOR ''
            ) AS node
        FROM {$modx->getTableName('modResource')} AS s
        WHERE s.deleted = 0 AND s.published = 1 AND s.searchable = 1 AND context_key='web' AND s.class_key != 'modWebLink'
        {$ex}
        GROUP BY s.id
        ORDER BY s.id ASC
    ";
    $stmt_sitemap = $modx->prepare($sql_sitemap);

    if ($stmt_sitemap->execute()) {
        $rows = $stmt_sitemap->fetchAll(PDO::FETCH_COLUMN);
        foreach($rows as $row){
            if(substr_count($row,'index.html')){
                $row = str_replace('index.html','',$row);
            }
            $output .= $row;
        }
    }

    $output .= '</urlset>';

    $modx->cacheManager->set('sitemap', $output, 86400, $options_c);
}

return $output;