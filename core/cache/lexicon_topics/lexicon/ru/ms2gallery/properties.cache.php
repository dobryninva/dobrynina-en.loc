<?php  return array (
  'ms2gallery_prop_parents' => 'Список категорий, через запятую, для поиска результатов. По умолчанию выборка ограничена текущим родителем. Если поставить 0 - выборка не ограничивается.',
  'ms2gallery_prop_resources' => 'Список ресурсов, через запятую, для вывода в результатах. Если id товара начинается с минуса, этот товар исключается из выборки.',
  'ms2gallery_prop_tpl' => 'Чанк Fenom для оформления всей галереи.',
  'ms2gallery_prop_limit' => 'Лимит выборки результатов',
  'ms2gallery_prop_offset' => 'Пропуск результатов с начала выборки',
  'ms2gallery_prop_sortby' => 'Сортировка выборки.',
  'ms2gallery_prop_sortdir' => 'Направление сортировки',
  'ms2gallery_prop_toPlaceholder' => 'Если не пусто, сниппет сохранит все данные в плейсхолдер с этим именем, вместо вывода не экран.',
  'ms2gallery_prop_showLog' => 'Показывать дополнительную информацию о работе сниппета. Только для авторизованных в контекте "mgr".',
  'ms2gallery_prop_where' => 'Строка, закодированная в JSON, с дополнительными условиями выборки. Для фильтрации по файлам нужно использовать псевдоним таблицы "File". Например &where=`{"File.name:LIKE":"%img%"}`.',
  'ms2gallery_prop_prefix' => 'Префикс для плейсхолдеров изображений, например "img". По умолчанию параметр "ms2g".',
  'ms2gallery_prop_filetype' => 'Тип файлов для выборки. Можно использовать "image" для указания картинок и расширения для остальных файлов. Например: "image,pdf,xls,doc".',
  'ms2gallery_prop_showInactive' => 'Показывать неактивные файлы.',
  'ms2gallery_prop_frontend_css' => 'Если вы хотите использовать собственные стили - укажите путь к ним здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'ms2gallery_prop_frontend_js' => 'Если вы хотите использовать собственные скрипты - укажите путь к ним здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'ms2gallery_prop_typeOfJoin' => 'Тип присоединения картинок ресурса. Left - это Left Join, то есть, ресурсы будут выбираться, даже если у них нет картинок. И inner - это Inner Join, будут выбираться только ресурсы с картинками.',
  'ms2gallery_prop_includeThumbs' => 'Список разрешений превью через запятую. Например "small,medium".',
  'ms2gallery_prop_includeOriginal' => 'Добавление в выборку дополнительного join со ссылкой на оригинальное изображение. Будет доступно в массиве ресурса как "псевдоним.original", например "small.original".',
  'ms2gallery_prop_tags' => 'Список тегов, разделённых запятыми, для вывода файлов.',
  'ms2gallery_prop_tagsVar' => 'Если этот параметр не пуст, то сниппет будет принимать из значение "tags" в $_REQUEST[указанноеимя]. Например, если вы укажите здесь "tag", то сниппет будет выводить только файлы, подходящие в $_REQUEST["tag"].',
  'ms2gallery_prop_getTags' => 'Сделать дополнительные запросы, чтобы получить строку с тегами файла?',
  'ms2gallery_prop_tagsSeparator' => 'Если вы включили получение тегов файлов при выводе, они будут разделены через строку, указанную в этом параметре.',
  'ms2gallery_prop_getPreviewProperties' => 'При включении этой опции плейсхолдер с превью превращается в массив всех его свойств. То есть, вместо {$file.small} вы должны использовать {$file.small.url} и можете получать доступ к {$file.small.properties}.',
);