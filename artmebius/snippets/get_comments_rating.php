<?php
/**
* get_comments_rating
*
* @version v.1.0
*
* @example
* {'get_comments_rating' | snippet : ['rid'=>7, 'toPlaceholder'=>'place']}
*
* @var string $rid - id ресурса с комментариями, обязательное, по-умолчанию текущий
* @var string $toPlaceholder - описание, необязательные
*
* @return array возвращает $output или устанавливает плейсхолдеры в $toPlaceholder
*/

$output = '';
$result = [
  'count' => 0,
  'average' => 0,
  'average_star' => 0,
];
$rid = $modx->getOption('rid', $scriptProperties, $modx->resource->id);

$q = $modx->newQuery('TicketComment');
$q->setClassAlias('comment');
$q->select('comment.properties');
$q->leftJoin('TicketThread', 'thread', 'thread.id=comment.thread');
$q->where([
  'thread.resource'   => $rid,
  'comment.published' => 1,
  'comment.deleted'   => 0
]);
$q->prepare();
if($q->stmt && $q->stmt->execute()){
  $props = $q->stmt->fetchAll(PDO::FETCH_COLUMN);
}
$q->stmt->closeCursor();

if (!empty($props)) {
  $rating_sum = 0; // сумма
  $result['count'] = count($props);
  foreach ($props as $prop) {
    $prop_arr = json_decode($prop, 1);
    $rating_sum += $prop_arr['vote'];
  }
  $result['average'] = round($rating_sum / $result['count'] * 100 / 5);
  $result['average_star'] = $rating_sum / $result['count'];
}

$output = $result;

// можно в чанк завернуть, но нет времени объяснять
// $pdoTools = $modx->getService('pdoTools');

// if (empty($tpl)) {
//   $tpl = '@INLINE ';
// }
// $output = $pdoTools->getChunk($tpl, $result);

if($toPlaceholder){
  $modx->setPlaceholder($toPlaceholder, $output);
  $output = '';
}

return $output;