<?php
/**
* v.1.1
*
* [[pdf_create? &content=`` &title=`` &author=`` &toPlaceholder=`place`]]
* fenom:
* {'pdf_create' | snippet : ['content'=>$content, 'css'=>$css, 'title'=>$title, 'author'=>$author, 'toPlaceholder'=>'place']}
*
* &content - основное содержание, обязательное
* &css - стили для содержимого, необязательное
* &title - заголовок файла, обязательное
* &author - автор файла, обязательное
* &toPlaceholder - необязательное
*
* возвращает ссылку на pdf файл
*/

$date = date('Y-m-d_H-i-s', time()) . '_' .rand(1, 100);

$corePath = $modx->getOption('pdfresource.core_path', null, $modx->getOption('core_path') . 'components/pdfresource/');
$pdfresource = $modx->getService('pdfresource', 'PDFResource', $corePath . 'model/pdfresource/', array(
    'core_path' => $corePath
));

$defaultFont = (!empty($modx->getOption('defaultFont', $scriptProperties, ''))) ? $modx->getOption('defaultFont', $scriptProperties, '') : $modx->getOption('defaultFont', null, '');
$defaultFontSize = (!empty($modx->getOption('defaultFontSize', $scriptProperties, ''))) ? $modx->getOption('defaultFontSize', $scriptProperties, intval(8)) : $modx->getOption('defaultFontSize', null, intval(8));
$customFontsFolder = (!empty($modx->getOption('customFontsFolder', $scriptProperties, ''))) ? $modx->getOption('customFontsFolder', $scriptProperties, '') : $modx->getOption('customFontsFolder', null, '');
$customFonts = (!empty($modx->getOption('customFonts', $scriptProperties, ''))) ? $modx->getOption('customFonts', $scriptProperties, '[]') : $modx->getOption('customFonts', null, '[]');

$content = $modx->getOption('content', $scriptProperties, '', true);
$css = $modx->getOption('css', $scriptProperties, '', true);
$title = $modx->getOption('title', $scriptProperties, '', true);
$author = $modx->getOption('author', $scriptProperties, '', true);
$footer = $modx->getOption('footer', $scriptProperties, '', true);
$sub_folder = $modx->getOption('sub_folder', $scriptProperties, '', true);
if (!empty($sub_folder)) {
  $sub_folder = trim($sub_folder, '/') . '/';
}
$file_name = $modx->getOption('file_name', $scriptProperties, $date, true);
$file_name_prefix = $modx->getOption('prefix', $scriptProperties, '', true);
$file_name_date_suffix = $modx->getOption('date_suffix', $scriptProperties, 0, true);
$attachment = $modx->getOption('attachment', $scriptProperties, 0, true);
$toPlaceholder = $modx->getOption('toPlaceholder', $scriptProperties, '', true);
$refresh = $modx->getOption('refresh', $scriptProperties, 0, true);

$site_url = $modx->getOption('site_url');
$assets = ltrim($modx->getOption('assets_url'), '/'); // assets/
$file_path = MODX_ASSETS_PATH . 'pdf/';
if (!empty($sub_folder)) {
  $file_path .= $sub_folder;
}
if (!file_exists($file_path)){
  mkdir($file_path, 0755, true);
}
$file_name = (!empty($file_name_prefix)) ? $file_name_prefix.'_'.$file_name : $file_name;
if ($file_name_date_suffix) {
  $file_name = $file_name .'_'.$date;
}
$file = $file_name . '.pdf';
$output_file = $site_url . $assets . 'pdf/' . $sub_folder . $file; // ссылка на файл

// настройки PDFResource (подробнее почитать здесь: http://jako.github.io/PDFResource/usage/)
$pdfresource->initPDF(array(
    'mode' => 'utf-8',
    'format' => 'A4',
    'mgl' => intval(10),    // margin left
    'mgr' => intval(10),    // margin right
    'mgt' => intval(7),     // margin top
    'mgb' => intval(7),     // margin bottom
    'mgh' => intval(10),    // margin header
    'mgf' => intval(10),    // margin footer
    'orientation' => 'P',   // ориентация PDF

    'defaultFont' => $defaultFont,
    'defaultFontSize' => $defaultFontSize,
    'customFontsFolder' => $customFontsFolder,
    'customFonts' => $customFonts,

));

$pdfresource->pdf->SetTitle($title);
$pdfresource->pdf->SetAuthor($author);
$pdfresource->pdf->SetCreator($modx->getOption('site_url'));

$pdfresource->pdf->WriteHTML($css, 1);
$pdfresource->pdf->WriteHTML($content, 2);
if (!empty($footer)) {
  $pdfresource->pdf->SetHTMLFooter($footer);
}

// обновляем, удаляя существующий
if ($refresh && file_exists($file_path.$file)) {
  unlink($file_path.$file);
}

// если файла нет - создаём
if (!file_exists($file_path.$file)){
  $pdfresource->pdf->Output($file_path.$file, 'F');
}

// если файл есть
if (file_exists($file_path.$file)){

  // цепляем его к письму
  if ($attachment) {
    $attachments = [];
    $attachments['name'][0] = $file;
    $attachments['tmp_name'][0] = $file_path.$file;
    $attachments['type'][0] = 'application/pdf';
    $attachments['error'][0] = 0;
    return $attachments;
  }

  // или помещаем ссылку в плейсхолдер
  if (!empty($toPlaceholder)) {
    $modx->setPlaceholder($toPlaceholder, $output_file);
    return;
  }

  // или возвращаем ссылку на файл
  return $output_file;
}
