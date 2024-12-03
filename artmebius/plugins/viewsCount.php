<?php
if ($modx->event->name == 'OnLoadWebDocument') {
  // id дополнительного поля views
  $id_tv = 97;
  // получим ресурс
  $resource = $modx->resource;
  // получим тип ресурса
  $class_key = $resource->get('class_key');

  // получим id ресурса
  $id = $resource->get('id');
  // получим tv поле
  $tv_views = $modx->getObject('modTemplateVarResource',array(
    'tmplvarid' => $id_tv,
    'contentid' => $id
  ));

  // если не существует COOKIE view_resource
  if (!isset($_COOKIE['view_resource'])) {

    // если tv поле является объектом
    if (is_object($tv_views)) {
      // получаем его значение
      $views_value = $tv_views->get('value');
      // увеличиваем количество просмотров на 1
      $views_value++;
      // сохраняем количество просмотров в таблицу
      $tv_views->set('value',$views_value);
      // сохраняем
      $tv_views->save();
    } else {
      // устанавливаем количество просмотров равным 1
      $views_value = 1;
      // создаём новый объект modTemplateVarResource
      $tv_views = $modx->newObject('modTemplateVarResource');
      // установливаем значение поля tmplvarid
      $tv_views->set('tmplvarid',$id_tv);
      // установливаем значение поля contentid
      $tv_views->set('contentid',$id);
      // устанавливаем значение поля value
      $tv_views->set('value',$views_value);
      // сохраняем
      $tv_views->save();
    }

    // отправка COOKIE view_resource
    setcookie('view_resource', '1',time() + (86400 * 365),'/'.$resource->get('uri'));

  } else {
    // если COOKIE view_resource существует

    // и если значение tv не пустое
    if (is_object($tv_views)) {
      $views_value = $tv_views->get('value');
    } else {
      // иначе создаём новую запись
      $views_value = 1;
      $tv_views = $modx->newObject('modTemplateVarResource');
      $tv_views->set('tmplvarid',$id_tv);
      $tv_views->set('contentid',$id);
      $tv_views->set('value',$views_value);
      $tv_views->save();
    }

  }

  // устанавливаем плейсхолдер views_count
  $modx->setPlaceholder('views_count', $views_value);

}