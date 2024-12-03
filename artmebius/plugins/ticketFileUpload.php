<?php
$eventName = $modx->event->name;
switch($eventName) {
  case "OnBeforeCommentSave":

    if(count($_FILES)){

      $upload_error = $upload_images = $properties = array();

      // конфигурация
      $path       = $_SERVER['DOCUMENT_ROOT'] . '/images/reviews/';
      $types      = array('image/gif', 'image/png', 'image/jpeg');
      $max_size   = 2*1024*1024;
      $prefix     = date('dmY-His_');
      $input_name = 'photo';
      $max_files  = 1;

      $is_array = is_array($_FILES[$input_name]['name']) ? 1 : 0;
      $count_files = $is_array ? count($_FILES[$input_name]['name']) : 1;

      // проверяем кол-во загруженных фотографий
      if ($count_files > $max_files) {
        $upload_error[] = "Максимальное кол-во фотографий - $max_files.";
      }

      // если мультизагрузка
      if ($is_array) {

        // Проверяем тип файлов
        foreach ($_FILES[$input_name]['type'] as $img_type) {
          if (!in_array($img_type, $types)) {
            $upload_error[] = 'Ошибка. Разрешено загружать только изображения.';
          }
        }

        // Проверяем размер файла
        foreach ($_FILES[$input_name]['size'] as $img_size) {
          if ($img_size > $max_size){
            $upload_error[] = 'Ошибка. Максимальный размер файла '.$max_size / 1024 / 1024 .' мб.';
          }
        }

        if(!count($upload_error)){
          // Загрузка файлов и вывод сообщения
          foreach ($_FILES[$input_name]['tmp_name'] as $k => $img_tmp) {
            if (!copy($img_tmp, $path . $prefix.$_FILES[$input_name]['name'][$k])){
              $upload_error[] = 'Ошибка. Не удалось загрузить файл изображения.';
            } else {
              $upload_images[] = array('image' => $prefix.$_FILES[$input_name]['name'][$k]);
            }
          }

          $properties[$input_name] = json_encode($upload_images);
          $modx->event->params['TicketComment']->set('properties', array_merge($data['properties'],$properties));
        }

      } // если один файл
      else {

        // Проверяем тип файла
        if (!in_array($_FILES[$input_name]['type'], $types)) {
          $upload_error[] = 'Ошибка. Разрешено загружать только изображения.';
        }

        // Проверяем размер файла
        if ($_FILES[$input_name]['size'] > $max_size){
          $upload_error[] = 'Ошибка. Максимальный размер файла ' . $max_size / 1024 / 1024 . ' мб.';
        }

        if(!count($upload_error)){
          // Загрузка файла и вывод сообщения
          if (!copy($_FILES[$input_name]['tmp_name'], $path.$prefix.$_FILES[$input_name]['name'])){
            $upload_error[] = 'Ошибка. Не удалось загрузить файл изображения.';
          } else {
            $upload_images[] = array('image' => $prefix.$_FILES[$input_name]['name']);
          }

          $properties[$input_name] = json_encode($upload_images);
          $modx->event->params['TicketComment']->set('properties', array_merge($data['properties'],$properties));
        }

      } // $is_array

      if(count($upload_error)){
        $modx->event->output(implode(", ", $upload_error));
      }

    } // if(count($_FILES))

    break;
}