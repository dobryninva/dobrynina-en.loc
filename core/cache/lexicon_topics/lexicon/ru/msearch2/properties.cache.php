<?php  return array (
  'mse2_prop_tpl' => 'Чанк оформления для каждого результата',
  'mse2_prop_limit' => 'Лимит выборки результатов',
  'mse2_prop_offset' => 'Пропуск результатов с начала выборки',
  'mse2_prop_outputSeparator' => 'Необязательная строка для разделения результатов работы.',
  'mse2_prop_toPlaceholder' => 'Если не пусто, сниппет сохранит все данные в плейсхолдер с этим именем, вместо вывода не экран.',
  'mse2_prop_toPlaceholders' => 'Если не пусто, mFilter2 сохранит все данные в плейсхолдеры: "filters", "results" and "total" с префиксом, указанным в этом параметре. Например, если вы указжете &toPlaceholders=`my.`, то получите: [[+my.filters]], [[+my.results]] и [[+my.total]]',
  'mse2_prop_returnIds' => 'Вернуть только список id подходящих страниц, через запятую.',
  'mse2_prop_showLog' => 'Показывать дополнительную информацию о работе сниппета. Только для авторизованных в контекте "mgr".',
  'mse2_prop_fastMode' => 'Если включено - в чанк результата будут подставлены только значения из БД. Все необработанные теги MODX, такие как фильтры, вызов сниппетов и другие - будут вырезаны.',
  'mse2_prop_parents' => 'Список категорий, через запятую, для ограничения вывода результатов. По умолчанию, нет.',
  'mse2_prop_depth' => 'Глубина поиска ресурсов от каждого родителя.',
  'mse2_prop_includeTVs' => 'Список ТВ параметров для выборки, через запятую. Например: "action,time" дадут плейсхолдеры [[+action]] и [[+time]].',
  'mse2_prop_tvPrefix' => 'Префикс для ТВ плейсхолдеров, например "tv.". По умолчанию параметр пуст.',
  'mse2_prop_where' => 'Дополнительные параметры выборки, закодированные в JSON.',
  'mse2_prop_showUnpublished' => 'Показывать неопубликованные товары.',
  'mse2_prop_showDeleted' => 'Показывать удалённые ресурсы.',
  'mse2_prop_showHidden' => 'Показывать ресурсы, скрытые в меню.',
  'mse2_prop_hideContainers' => 'Скрывать ресурсы-контейнеры.',
  'mse2_prop_introCutBefore' => 'Укажите количество символов для вывода в плейсхолдере [[+intro]] перед первым совпадением в тексте. По умолчанию - "50".',
  'mse2_prop_introCutAfter' => 'Укажите количество символов для вывода в плейсхолдере [[+intro]] после первого совпадения в тексте. По умолчанию - "250".',
  'mse2_prop_htagOpen' => 'Открывающий тег для подсветки найденных результатов в [[+intro]].',
  'mse2_prop_htagClose' => 'Закрывающий тег для подсветки найденных результатов в [[+intro]].',
  'mse2_prop_minQuery' => 'Минимальная длина поискового запроса.',
  'mse2_prop_parentsVar' => 'Имя переменной для дополнительной фильтрации по родителям. По умолчанию - "parents", может быть передано через $_REQUEST.',
  'mse2_prop_queryVar' => 'Имя переменной для получения поискового запроса из $_REQUEST. По умолчанию - "query"',
  'mse2_prop_paginator' => 'Сниппет для постраничной навигации, по умолчанию "getPage".',
  'mse2_prop_element' => 'Сниппет, который будет вызываться для вывода результатов работы. По умолчанию - "mSearch2".',
  'mse2_prop_resources' => 'Список ресурсов для вывода, через запятую. Этот список может быть отфильтрован другими параметрами, такими как "parents", "showDeleted", "showHidden" и "showUnpublished".',
  'mse2_prop_showEmptyFilters' => 'Показывать фильтры всего с одним значением.',
  'mse2_prop_sort' => 'Список полей ресурса для сортировки. Указывается в формате "таблица|поле:направление". Можно указывать несколько полей через запятую, например: "resource:publisedon:desc,ms|price:asc".',
  'mse2_prop_filters' => 'Список фильтров ресурсов, через запятую. Указывается в формате "таблица|поле:метод". По умолчанию: "resource|parent:parents".',
  'mse2_prop_aliases' => 'Список псевдонимов для фильтров, которые будут использованы в URL фильтра, через запятую. Указывается в формате "таблица|поле==псевдоним". Например: "resource|parent==category".',
  'mse2_prop_suggestions' => 'Этот параметр включает предположительное количество результатов, которое показывается возле каждого фильтра. Отключите, если вы недовольны скоростью фильтрации.',
  'mse2_prop_suggestionsMaxFilters' => 'Максимальное количество фильтров, для которых работают предварительные результаты. Если фильтров будет больше - suggestions отключатся.',
  'mse2_prop_suggestionsMaxResults' => 'Максимальное количество ресурсов, для которых работают предварительные результаты. Если ресурсов будет больше - suggestions отключатся.',
  'mse2_prop_suggestionsRadio' => 'Список фильтров-радиокнопок, через запятую. Предсказания этих групп фильтров не суммируются между собой. Например: "resource|class_key,ms|new"',
  'mse2_prop_suggestionsSliders' => 'Включить работу предположительных результатов для слайдеров. Увеличивает количество фильтраций.',
  'mse2_prop_filter_delimeter' => 'Разделитель кодового имени таблицы и поля фильтра. По умолчанию - "|"',
  'mse2_prop_method_delimeter' => 'Разделитель полного имени фильтра и метода его обработки. По умолчанию - ":"',
  'mse2_prop_values_delimeter' => 'Разделитель значений фильтров в адресной строке сайта. По умолчанию - ","',
  'mse2_prop_tplOuter' => 'Чанк оформления всего блока фильтров и результатов.',
  'mse2_prop_tplFilter.outer.default' => 'Стандартный чанк оформления одной группы фильтров.',
  'mse2_prop_tplFilter.row.default' => 'Стандартный чанк оформления одного фильтра в группе. По умолчанию выводится как checkbox.',
  'mse2_prop_tpls' => 'Список чанков для оформления строк, через запятую. Вы можете переключать их указанием в $_REQUEST параметра "tpl". 0 - это чанк по умолчанию, а дальше по порядку. Например: "&tpls=`default,chunk1,chunk2`", для вывода товаров чанком "chunk1", нужно прислать в запросе "$_REQUEST[tpl] = 1".',
  'mse2_prop_tplWrapper' => 'Чанк-обёртка, для заворачивания всех результатов. Знает плейсхолдеры: [[+output]], [[+total]], [[+query]] и [[+parents]].',
  'mse2_prop_wrapIfEmpty' => 'Включает вывод чанка-обертки (tplWrapper) даже если результатов нет.',
  'mse2_prop_forceSearch' => 'Обязательный поиск для вывода результатов. Если нет поискового запроса - ничего не выводится.',
  'mse2_prop_tplForm' => 'Чанк с формой для вывода.',
  'mse2_prop_autocomplete' => 'Настройка автодополнения. Возможные варианты: "results" - поиск по сайту (для вывода результатов будет вызван сниппет, указанный в "element"), "queries" - поиск по таблице запросов, "0" - выключить автодополнение.',
  'mse2_prop_pageId' => 'Id страницы, на которую будет отправлен поисковый запрос. По умолчанию - текущая страница.',
  'mse2_prop_fields' => 'Список проиндексированных полей ресурса для поиска. Каждому полю можно указывать поисковый вес через двоеточие.',
  'mse2_prop_onlyIndex' => 'Искать только по индексу слов, без добавления бонусов за точное совпадение фразы в простом поиске через LIKE.',
  'mse2_prop_onlyAllWords' => 'Выводить только те ресурсы, в которых найдены все слова поискового запроса.',
  'mse2_prop_showSearchLog' => 'Вывести подробный лог поиска при включенной опции showLog.',
  'mse2_prop_filterOptions' => 'JSON строка с переменными для javascript фильтра. Например: {"pagination":"#mse2_pagination", "selected_values_delimeter":", "}',
  'mse2_prop_ajaxMode' => 'Режим работы ajax пагинации: "default", "button" или "scroll".',
  'mse2_prop_cacheTime' => 'Время кэширования фильтров, сгенерированных для текущих выбранных ресурсов.',
  'mse2_prop_noPreciseMSFilters' => 'Отключает выборку объектов товаров miniShop2 и вызов их методов для получения цены и веса. Ускоряет построение фильтров, но плагины для изменения цены и веса miniShop2 не работают.',
);