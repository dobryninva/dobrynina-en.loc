<?php
$stroka = '';
switch ($modx->event->name) {


  case 'OnCommentPublish':

// Array
// (
//     [method] => publish
//     [ids] => [1]
// )

    $stroka .= "OnCommentPublish:\n\n";
    $stroka .= print_r($_REQUEST, true) . "\n\n";
    $artm_log = MODX_BASE_PATH . 'assets/temp.log';
    // file_put_contents($artm_log, $stroka, FILE_APPEND | LOCK_EX);

    break;

  case 'OnCommentUnpublish':

// Array
// (
//     [method] => unpublish
//     [ids] => [1]
// )

    $stroka .= "OnCommentUnpublish:\n\n";
    $stroka .= print_r($_REQUEST, true) . "\n\n";
    $artm_log = MODX_BASE_PATH . 'assets/temp.log';
    // file_put_contents($artm_log, $stroka, FILE_APPEND | LOCK_EX);

    break;


  // case 'OnCommentDelete':

  //   break;

  // case 'OnCommentRemove':

  //   break;

  // case 'OnCommentSave':

  //   break;

  // case 'OnCommentStar':

  //   break;

  // case 'OnCommentUndelete':

  //   break;

  // case 'OnCommentUnStar':

  //   break;

  // case 'OnCommentVote':

  //   break;
}