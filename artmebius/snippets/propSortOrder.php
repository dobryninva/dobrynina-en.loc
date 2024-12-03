<?php
$props = json_decode($input);
if(count($props)){
  $sort=array_flip(array_map('trim',explode(",", $options)));

  foreach ($props as $p) {
    $sort[$p->name] = $p;
  }
  $sort = json_encode(array_values($sort),JSON_UNESCAPED_UNICODE);
  return $sort;
}