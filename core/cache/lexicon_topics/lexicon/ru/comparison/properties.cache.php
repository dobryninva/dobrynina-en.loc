<?php  return array (
  'comparison_prop_id' => 'Id товара для добавления в список. По умолчанию - текущий ресурс.',
  'comparison_prop_tpl' => 'Чанк добавления к списку сравнения.',
  'comparison_prop_tpl_get' => 'Чанк оформления ссылки на сравнение.',
  'comparison_prop_list_get' => 'Имя существующего списка сравнения.',
  'comparison_prop_list' => 'Произвольное имя списка сравнения. Если у вас товары разных типов - указывайте для них разные имена списков. Указанное имя обязательно должно быть в массиве "&fields" сниппета "CompareList".',
  'comparison_prop_list_id' => 'Обязательный параметр с указанием id страницы, на которой вызван сниппет "ComparisonList".',
  'comparison_prop_minItems' => 'Минимальное количество товаров для сравнения.',
  'comparison_prop_maxItems' => 'Максимальное количество товаров для сравнения.',
  'comparison_prop_fields' => 'JSON строка с именами списков сравнения и массивом сравниваемы полей. Например: {"test":["price","weight"]}. Опции товаров и поля производителя указыаются с префиксами: {"test":["vendor.name","option.color","option.test"]}.',
  'comparison_prop_tplRow' => 'Чанк с одной строкой таблицы сравнения товаров. Плейсхолдеры [[+cells]] и [[+same]].',
  'comparison_prop_tplParam' => 'Чанк с именем параметра товара. Плейсхолдеры [[+param]] и [[+row_idx]].',
  'comparison_prop_tplCell' => 'Ячейка таблицы сравнения с одним значением параметра товара. Плейсхолдеры [[+value]], [[+classes]] и [[+cell_idx]].',
  'comparison_prop_tplHead' => 'Ячейка заголовка товара в таблице сравнения. Здесь можно использовать все плейсхолдеры товара.',
  'comparison_prop_tplCorner' => 'Угловая ячейка таблицы, со ссылками на переключение параметров сравнения. Плейсхолдеров нет.',
  'comparison_prop_tplOuter' => 'Чанк-обёртка таблицы сравнения. Плейсхолдеры [[+head]] и [[+rows]].',
  'comparison_prop_formatSnippet' => 'Произвольный сниппет для оформления значения параметра товара. Получает имя поля "$field" и его значение "$value". Должен вернуть отформатированную строку "$value".',
  'comparison_prop_showLog' => 'Вывести администратору подробный лог работы сниппета.',
);