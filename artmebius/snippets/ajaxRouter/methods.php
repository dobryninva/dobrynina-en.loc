<?php

/**
 *
 * Хранение имен сниппетов с их параметрами в $methods
 *
 * @author Капустин Дмитрий Игоревич <021088z@gmail.com>
 * @version 1.0
 */

$methods = array(

  'searchTips' => array(
    'name' => 'SimpleSearch',
    'params' => array(
      'method'       => 'POST',
      'searchIndex'  => 'search',
      'containerTpl' => 'sf_tipsWrapper',
      'tpl'          => 'sf_tipsRow',
      'noResultsTpl' => 'sf_tipsEmpty',
      'showExtract'  => '0',
      'perPage'      => '10',
      // 'idType'       => 'parents', // только по каталогу
      // 'ids'          => '7', // только по каталогу
    )
  ),

  'addToFavorite' => array(
    'name' => 'favorite',
    'params' => array(
      'task' => $_POST['task'],
      'productId' => $_POST['productId'],
    )
  )

);