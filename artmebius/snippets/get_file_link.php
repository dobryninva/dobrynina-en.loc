<?php
// get_file_link

/**
* v.1
*
* [[get_file_link? &file_path=`assets/pdf/` &file_name=`price_list.pdf` &toPlaceholder=`pdf_link`]]
*
* fenom:
* {'get_file_link' | snippet : ['file_path' => 'assets/pdf/', 'file_name' => 'price_list.pdf', 'toPlaceholder'=>'pdf_link']}
*
* &file_name - имя файл с расширением, обязательное
* &file_path - путь до папки с файлом от корня, необязательное
* &toPlaceholder - необязательные
*
* возвращает ссылку на файл, если он существует
*/

$output = '';

$file_name = $modx->getOption('file_name', $scriptProperties, '');
$file_path = $modx->getOption('file_path', $scriptProperties, '');
$site_url  = $modx->getOption('site_url');

if (!empty($file_name)) {
  $path = MODX_BASE_PATH . ltrim($file_path, '/') . $file_name;
  if (file_exists($path)) {
    $output = $site_url . ltrim($file_path, '/') . $file_name;
  }
}

if($toPlaceholder){
  $modx->setPlaceholder($toPlaceholder, $output);
  $output = '';
}

return $output;