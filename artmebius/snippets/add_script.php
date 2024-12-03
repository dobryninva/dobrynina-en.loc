<?php
$path = $modx->getOption('path', $scriptProperties, '');
if (!empty($path)) {
  $modx->regClientScript($path);
}