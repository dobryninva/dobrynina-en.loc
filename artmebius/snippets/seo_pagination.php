<?php
if($_GET['page'] && $_GET['page'] != 1){
  // $modx->setPlaceholder('s_page',$_GET['page']);
  echo " стр." . $_GET['page'];
}