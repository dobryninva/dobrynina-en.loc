<?php return array (
  'manifest-version' => '1.1',
  'manifest-attributes' => 
  array (
    'changelog' => 'Changelog for msPre.

2.2.35 pl
==============
- исправлена ошибка для процессора генерации изображения

2.2.34 pl
==============
- Исправление выгрузки опций и ТВ параметров

2.2.33 pl
==============
- Исправлено окно быстрого редактирования ресурса во фрейме для http и https
- Исправлен динамический путь к папке manager
- Исправлена ошибка показ имени категории

2.2.32 pl
==============
- Фильтр "Показать товары без доп. категорий", показывать все товаров у которых отсутствуют доп категории

2.2.31 pl
==============
- Добавление недостающих лексиконов для английской версии

2.2.30 pl
==============
- Исправление орфографии

2.2.29 pl
==============
- Установка значения Да/Нет в режиме экперта

2.2.28 pl
==============
- Исправлен баг редактирование ресурсов

2.2.27 pl
==============
- Добавленна возможность автоматического вывода полей с phpType boolean для установки Да/Нет
- Поддержка Плагинов minishop2 для редактирование полей в таблице с товаром (по умолчанию выключен)

2.2.26 pl
==============
- Добавлен статус для поиск дублирующихся артикулов в товарах

2.2.25 pl
==============
- Исправлено массовое изменение цен для экспертов
- Добавлен фильтр по Группе Ресурсов
- Добавлен фильтр по купленным товарам
- Добавлена настройка mspre_status_purchased_goods для установки статусов заказов

2.2.24 pl
==============
- Исправлено сохранение столбцов в случае если был поиск в выбранных полях
- Добавлены настройки для увеленичения лимитов export_memory_limit и max_execution_time при экспорте
- Исправлен баг загрузки ресурсов

2.2.23 pl
==============
- Имправлен показ опции для сортировки
- Поля фильтрации в JSON формате выводятся автоматически в фильтре ОПЦИИ
- Исправление обновления превью фотографии
- Добавлена функция установки small фотографии в поле thumb
- Настройки полей списка и экспорта храняться персонально у пользователя (для отключения этой возмоности нужно установить Нет в системных настройках mspre_enable_save_setting_user)
- Добавление альясов для полей экспорта
- Возвращена возможность замены текста
- Переработка экспорта в файл, теперь можно эскортиров всю базу даже при наличии в базе 100000 товаров (пока что максимальное органичение в 100000 все осталное зависит от вашего сервер). PS. если больше не экспортирует займитесь оптимизацией скриптов с помощью php программистов.
- Добавлен экспорт в XLSX формате для уменьшения объема экспортируемого файла

2.2.22 pl
==============
- Удаление всех фотографий для выбранных товаров

2.2.21 pl
==============
- Получение всех опций, где нет ключа/или есть ключ в таблице modx_ms2_product_options

2.2.20 pl
==============
- Исправление вывода vendor_name

2.2.19 pl
==============
- Добавления проверка на установку связей на самого себя. Теперь если пользователь выбрал тот же товар для которого устанавливается связь, этот товар будет пропускаться

2.2.18 pl
==============
- Создание и удаление связей между товарами. Теперь возможно создавать множественные связи между товарами.
- Для полей thumb,image,content - добавлено действие открывающие редактирование странице во фрейме. Для того чтобы можно было загрузить новое изображение или отредактировать контент в визуальном редакторе (внимание, на странице информация не обновится, для обновления необходимо обновить страницу).
- Добавлена функция Избранных ресурсов
- Добавлена иконка для сброса отмеченных родителей в дереве ресурсов

2.2.17 pl
==============
- Исправлен баг полного сброса фильтров
- Фильтрация по опциям minishop2

2.2.16 pl
==============
- Исправлены дополнительные категории

2.2.15 pl
==============
- Исправлен баг со снятием старых категорий при назначении дополнительных категорий

2.2.14 pl
==============
- Добавлена поддержка значений передаваемых через @EVAL для ТВ параметров
- Исправлена ошибка для отмеченных ресурсов

2.2.13 pl
==============
- Исправлена ошибка вовремя повторной установки

2.2.12 pl
==============
- Добавлена возможно массовой обработки ресурсов пакетно, по умолчанию по 10 ресуросов за один раз
- Добавлена возможность в режиме экспер обработать все найденые ресурсы. По умолчанию режим эксперт отключена

2.2.11 pl
==============
- Исправление загрузка класса minishop2

2.2.10 pl
==============
- Исправлена граматическая ошибка

2.2.9 pl
==============
- Ускорена загрузка дерева ресурсов, убран пересчет количества ресурсов в родительской категории

2.2.8 pl
==============
- Исправлена ошибка загрузки товаров из категорий если не установлена галочка вложенные категории
- Исправлена ошибка загрузки категорий из ресурсов где первые ресурсы не явяются категориями


2.2.7 pl
==============
- исправлена ошибка с подключением extjs для тв параметров

2.2.6 pl
==============
- Исправлен фильтр статус ошибочно показывающий возможность переключение на вторую страницу
- Исправлена панель с кнопками, которая наезжала на текст.
- Исправлена баг с отображением в поле description значение из longtitle
- Добавлена возможность создание и редактирования ресурса из iframe без необходимости перехода на страницу с ресурсом в новом окне
- Исправлена ошибка генерации превью изображений для товара

2.2.5 pl
==============
- Исправлена ошибка при снятии с публикации одной записи
- Исправлена ошибка генерации URL
- Добавлена прогресивная шкала с отображением индитификатора товара
- Добавлена возможность обновления любого количество ресурсов. Время исполнения скрипта теперь влияет только на один обрабатываемый ресурс
- Добавлена действие для уничтожения выбранных ресурсов. Унижтожаются только при условии если ресурс быт помечен на удаление

2.2.4 pl
==============
- Добавлена возможность выбора шаблона сразу по нажатию на ТВ параметр если доступ к шаблону закрыт
- Исправлен баг связанный с состоянием отмеченых фильтров

2.2.3 pl
==============
- Оптимизирована работа combobox Класс и Списка категорий
- Исправлена ошибка с загрузкой поле для фильтрации из класса msProduct на контроллере resource
- Исправлена ошибка загрузки ТВ параметра есть для ресурса не установлен шаблон
- Для поля email обработчик не работает, необходимо вводить путем копирования
- Добавлена возможно показа шалонов только для выбранных ресурсов а так же показ тв параметров которые есть только у выбранного шаблона с возможностью отобразить все поля
- Исправлена загрузка опций даже тех что небыли привязаны к какой то категории
- Добавлена возможность выбора полей для таблицы по шаблону тв параметров и по картегориям опций
- Исправлена ошибка связанная с разделителями тв параметров типа tag
- Добавлены настройки для указания какие поля должны отображаться в дереве ресурсов. Это аналогичные настройки modx только персонально для дерева ресурсов msPre
- Исправлен баг связаный с неправильным отображением имени ресурса в дереве
- Добавлена возможность экспорта ресурсов с ТВ параметорами и Опциями
- Исправлена ошибка с загрузкой класса Trait
- Исправлена ошибка запроса списка категорий для дерева ресурсов
- Исправлена ошибка с повторным определеним классов modmsMultipleProcessor
- Исправлена ошибка с попыткой инициализировать процессор обновления из-за слеший с разным наклоном
- Исправлена ошибка загрузки опций товаров tags,color,size для массовых дествий
- Добавлена возможность поиска опций по старым значениям для массовых действий удаление и замена
- Исправлен combobox при массовых действиях не правильно отдавались значения
- Отключена иконка на панели если не установлен minishop2
- Исправлена ошибка с загрузкой опций когда минишоп не установлен
- Исправлена ошибка загрузки класса minishop2 во время экспорта
- Отключены редакторы таблицы для полей с датой, теперь их возможно изменить только через массовые дейстями COMBO



2.2.2 beta
==============
- Исправлены обработчики значений для опций

2.2.1 beta
==============
- Исправлена ошибка с запоминание фильтра класс
- Исправлена ошибка связана с отчисткой поля с фильтром
- Исправлена ошибка связанная проверкой связи с категорий
- Добавлен обработчик для вывода типов значений ТВ параметров с неопределенным типом


2.2.0 beta
==============
- Исправлен баг связанный с фильтрацией цены и других полей из таблиц ms2_products
- Добавлено поле поиска по имени поля в окно с настройкой таблицы,
- Добавлена настройка ширины колонки по умолчанию в системных настройках
- Исправлена ошибка связана с загрузкой контроллера
- Исправлена ошибка загрузки типо для ТВ параметров
- Исправлен баг с отменой транзаций
- Исправлен баг с подсчетом общего количества записей при сортировке по ID
- Исправлена ошибка поиска главной страницы в ресурсах
- Исправлена ошибка связаная и json данные в журнале ошибок
- Исправлена ошибка связаная с загрузкой ТВ параметров
- Исправлена ошибка поиска LIKE %% для поля фильтры
- Добавлена проверка во время массовой установки ТВ параметров на доступ поля к шаблону
- В массовое изменени ТВ параметров добавлено 2 галочки
    Пропускать отличающиеся шаблоны - Установите галочку если не хотите получать сообщения об ошибках ресурсов у которых отличается шаблон от выбранного вами. Такие ресурсы не будут обновляться
- Во время выбора шаблона и поля тв параметра для обновления происходит проверка доступа к поля к выбранному шаблону, если доступ закрыт то появляется окно для открытия доступа. После нажатия открыть доступ появится окно для установлки значения
- Добавленая функция редактирования ТВ параметров нажатием на область с полем в таблице.
Список "Тип ввода" дополнительных полей которые достуны для редактирования
    text            - Текст
    textarea        - Текстовая область
    richtext        - Текстовый редактор (редактируется как обычное поле textarea)
    autotag         - Авто-метка
    date            - Дата
    option          - Переключатели (radio)
    checkbox        - Флажки (checkbox)
    number          - Число
    email           - Электронная почта
    tag             - Тег
    image           - Изображение
    file            - Файл
    url             - URL
    resourcelist    - Список ресурсов
    listbox         - Список (одиночный выбор)
    listbox-multiple - Список (множественный выбор)
    list-multiple-legacy - Устаревший список множественного выбора
- Поддержка загрузки изображений в ТВ параметры и вывод изображения в списке с поддержкой источников файлов (файлы аналогично)
- Привязка опции к категории не уходя со страницы. После выбора опции в случае когда опция не привязана к категории, предлагается автоматически привязать опцию к категории(аналогично и с шаблонами для Тв параметров)
- Миграция пунктов меню tags,color,size из опций в меню с пунктами для товара
- Изменение установки массовых значений опций, теперь необходимо выбрать категори и затем подгрузится список опций привязанных к нему
- Включен поиск для выбора шаблона и полей для массовых действий с ТВ параметрами
- Включен поиск для выбора категорий и полей для массовых действий с Опциями
- Поддержка версии minishop 2.4.11-pl для работы с опциями


2.1.8 beta
==============
- Добавлена функция для получения настроек для исключение ошибок связаных с кэшрование настроек
- Добавлена иконка для перехода сразу в товары
- Автоматически редирект со старой ссылки ведущей на контроллер home


2.1.7 beta
==============
- При выборе ТВ параметров и Опций скорость загрузки сильно падала, теперь список опций и список тв параметров готовится в самом конце двумя запросами в базу данных
- Для опций для которых возможен выбор нескольких значений при редактировании открывается комбо с редактирование мультизначений в место окна действий
- При редактировании одной записи в таблице при выборе опции minishop2 открывает её тип данных для редактирования в место окна с действиями
- Исправлена ошибка запоминание состояния сортировки таблицы
- Проверка доступа опции к категории
- Проверка доступа тв параметра к шаблону
- исправлено множество багов
- Увеличена скорость загрузки ТВ параметров и Опций
- Исправлено отображение картинок

2.1.6 beta
==============
- исправлен баг с отмечеными категориями в дереве, так как после перезагрузки страницы они слетали
- Добавлен фильтр статус: Показывать скрытые в дереве/Не показывать скрытые в дереве
- Добавлены фильтр:
    - Показывать вложенные ресурсы: покажет все ресурсы родителя и категорий детей
    - Показывать товары из дополнительных категорий: покажет все товары у которых назначены отмеченные категории
- Для полей tv и options добавлены префиксы в заголовки чтобы было понятно что это ТВ параметры или Опции
- Увеличена скорость загрузки товаров, так как запрос на пулучение отмеченых категорий происходит на стороне php а не ожидает пока загрузится дерево с ресурсами
- Увеличена скорость загрузки дерева категорий
- Добавление в таблицу типов ТВ параметров для управления
- Добавлена возможность управление значениями полей нажатие на поле пряма в таблице. Что дает оперативный доступ к редактированию значений у тв параметров и опций
- Добавлен компонент VersionX для ведения версионности ресурсов, на случай если потребуется восстановить ресурс в исходное состояние. Все данные автоматически сохранятся в нем
- Добавлена кнопка на удаление ресурсов
- Добавлено дествие "Быстрое создать" для оперативного создание ресурсов
- Добавлена кнопка на панель, рядом с кнопкой уничтожить ресурсы
- В дерево с ресурсами добавлена кнопка уничтожить ресурсы. После нажатие дерево ресурсов и список ресурсов автоматически обновятся



2.1.5 beta
==============
- Добавлена кнопк "Быстро обновить"
- Исправлен баг загрузки компонента без minishop2
- Добавлены ТВ параметры для вывода в таблицу
- Исправлена ошибка связана с запросами для категорий

2.1.4 beta
==============
- Поиск дублирующихся ресурсов
- Подсветка ресурсов у которых невозможно сгенерировать URL
- Управление полями с опций прям со странице со списком ресурсов
- Добавлена возможность редактирование любых опций кроме: Текстовая область(textarea) и Даты(date)
- Для ресурсов выведен фильтр со статусыми

2.1.3 beta
==============
- Массовое редактирование любых ресурсов (не только товаров)
- Добавлена возможность удалять значения в ТВ параметрах
- Добавлена возможность вывод кастомных полей и опций минишоп в таблицу с товарами
- Реализован удобный интерфейс по управлению полями которые требуется выводить в таблице
    - возможность перетаскивание полей
    - выбор полей из возможных значение
    - установка ширины поля
    - удаление полей
- Добавлено окно для установки "Группы ресурсов" для ресурсов
- Управление экспортируемыми ресурсами реализовано аналогично как и при настройке таблицы, так же можно перетаскивать поля для экспорта
- Некоторые мелкие но тоже полезные функции, возможно установить:
    - Доступен для поиска/Не доступен для поиска
    - Использовать HTML-редактор/Не использовать HTML-редактор
    - Заморозить URI/Разморозить URI
    - Кэшируемый/Не кэшируемый
    - Скрыть/Показать потомков в дереве
- Для редактора ресурсов добавлен фильтр с объектами(class_key)
- Исправлена работа добавление ТВ параметров
- Добавлено контекстное меню в дереве ресурсов
- Для дерева теперь не обязательно указывать главный ресурс
- Доработана табличная часть так чтобы колонки не скокали при изменении порядка или количества выводимых колонок
- Добавлен раздел помощи (пока что описание по нескольким функциям)
- обновление превью изображений, изображения выбранных товаров будут сгенерированны заново
- В список с товарами добавлена возможность отображение кастомных полей и полей для которых отсутсвуют обработчики (возможности редактировать отключена)
Теперь size,tags,color и другие опции будет отображатся в списке с товарами (редактирование только с помощью массовых действий)
- исправлены баги связаные со сменой родителя в разных контекста
- Добавлен возможность для замены текста в полях: pagetitle,logntitle,menutitle,link_attributes,description,introtext,content,alias,uri


2.0.10 pl
==============
- Добавлены два события msPreExportGetFields и msPreExportToArrayAfter для добавления колонок и значений в массив с товаром при экспорте

2.0.9 pl
==============
- Добавлена функция по переносу цены из одного поля в другое. Так к примеру можно выделить несколько товаров и из поля price перенести цену в old_price и на поле price сделать скидку. Все изменения финксируются в транзакциях. Для добавления дополнительных полей с ценой используется настройка mspre_field_price
- Добавлена шифрация для приложения

2.0.8 pl
==============
- Исправлена сортировка по menuindex если выборано больше 1 категории

2.0.7 pl
==============
- Экспорт в XLS

2.0.6 pl
==============
- Ускорение загрузки дерева категорий в десятки раз. Теперь возможно редактировать даже очень большие каталоги

2.0.5 pl
==============
- Экпорт товаров в CSV из таблицы с товарами
- Управления экспортируемыми столбцами из таблицы

2.0.4 pl
==============
- Добавлена возможность редактирование полей для опций создаваемых через настройки minishop2

2.0.3 pl
==============
- Исправлена ошибка в контекстном меню у товара

2.0.2 pl
==============
- Исправление ошибки

2.0.1 pl
==============
- Добавление кастомных полей (параметры field_json,field_price,field_string,field_weight)
- Изменение цены товара (поля price и old_price). Можно добавить кастомизированные поля phptype:decimal с разделителем 12,2
    Параметры изменения цены
        - Установить новую цену
        - Увеличить цену в процентах (от 1 до 100)
        - Снизить цену в процентах (от 1 до 100)
        - Увеличить цену на указанное количество рублей
        - Снизить цену на указанное количество рублей
    Округлить цену
        - Не округлять
        - Округлить в меньшую сторон
        - Округлить в большую сторону
- Транзакции с изменением цен фиксируются и их можно отменить (Действует только на поля типа цена. Все остальные поля не фиксируеются)
- Изменение страны производителя (поле made_in). Можно добавить кастомизированные поля phptype:string
- Изменение веса (поле weight). Можно добавить кастомизированные поля phptype:decimal с разделителем 13,3
- Фильтрация данных по опциям color,size,tags и др. в json формате из класса msProductOption
- Изменения источника файлов
- Управление полями типа phptype:json такие как color,size,tags. Можно добавить кастомизированные поля phptype:json
    - Установить опции
    - Изменить опции
    - Удалить опции

2.0.0 pl
==============
- Редктирование цены товара minishop (поля price и old_price)
- Исправлена загрузка списков с параметрами для сортировки по полю

1.1.2 pl
==============
- Переключение таба в боковой панели на ресурсы при уходе со страницы
- Исправлено отсутствие наименования для категории если menutitle пуст

1.1.1 pl
==============
- Поддержка английского языка

1.1.0 pl
==============
- Добавлена возможность редактирование дополнительных полей привязанных к шаблону товара
- Замена значений в ТВ параметре
- Добавления значения в ТВ параметр
- Замена значений в опциях
- Добавление значений в опции

- Список управляемых тип ввода данных ТВ параметров: autotag,tag,email,date,option,listbox-multiple,listbox,resourcelist,hidden,text,textarea,list-multiple-legacy,checkbox,number
- Список управляемых опций: article,price,old_price,weight,image,thumb,size,tags,color,source


- Опции: vendor,new,popular,favorite,source вынесены в отдельные действия для управления



- Изменения source у товара с автоматической генерация превью для изображений (количество выбранных товаров ограничено)


- Ограничение по выбору максимального выбора значений за 1 раз (теперь максимум можно выбрать только 50 товаров)
- Сообщение с иформацией о том что у товаров таких то имеется установленная дата отмены публикации. Тоесть товар невозможно включить без этих параметров
- Снятие ограничений на просмотр шаблонов


1.0.9 pl
==============
- исправлено текст на кнопке добавить товар
- убран дублирующий пункт изменить производителя

1.0.8 pl
==============
- Отключена функция для сброса контекста
- Включение отключение функций
- Включение отключения массовых действий
- Блокировка действий если не выбранно не одно из значений
- Убран фокус с поля поиска
- Исправлен баг с исчезанием окна после назначений нового родителя
- Исправлен баг с отключением маски при назначении отраслей
- Добавлена блокировка при случайном нажатии на раскрывающийся список в действиях

1.0.7 pl
==============
- Исправление загрузки количества при входе в приложение

1.0.6 pl
==============
- Изменения политики безопасности для приложения modAccessManager

1.0.5 pl
==============
- Исправления возможность добавление товаров с указанием класса и контекста

1.0.4 pl
==============
- Открытие доступ к чтению контекстов для менеджеров

1.0.3 pl
==============
- Ускорение загрузки дерева категорий

1.0.1 pl
==============
- Добавлени фильтров
- Добавление массовых действий
- Добавление массового назначения категорий
- Автоматическое сохранение фильтров',
    'license' => 'GNU GENERAL PUBLIC LICENSE
   Version 2, June 1991
--------------------------

Copyright (C) 1989, 1991 Free Software Foundation, Inc.
59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

Everyone is permitted to copy and distribute verbatim copies
of this license document, but changing it is not allowed.

Preamble
--------

  The licenses for most software are designed to take away your
freedom to share and change it.  By contrast, the GNU General Public
License is intended to guarantee your freedom to share and change free
software--to make sure the software is free for all its users.  This
General Public License applies to most of the Free Software
Foundation\'s software and to any other program whose authors commit to
using it.  (Some other Free Software Foundation software is covered by
the GNU Library General Public License instead.)  You can apply it to
your programs, too.

  When we speak of free software, we are referring to freedom, not
price.  Our General Public Licenses are designed to make sure that you
have the freedom to distribute copies of free software (and charge for
this service if you wish), that you receive source code or can get it
if you want it, that you can change the software or use pieces of it
in new free programs; and that you know you can do these things.

  To protect your rights, we need to make restrictions that forbid
anyone to deny you these rights or to ask you to surrender the rights.
These restrictions translate to certain responsibilities for you if you
distribute copies of the software, or if you modify it.

  For example, if you distribute copies of such a program, whether
gratis or for a fee, you must give the recipients all the rights that
you have.  You must make sure that they, too, receive or can get the
source code.  And you must show them these terms so they know their
rights.

  We protect your rights with two steps: (1) copyright the software, and
(2) offer you this license which gives you legal permission to copy,
distribute and/or modify the software.

  Also, for each author\'s protection and ours, we want to make certain
that everyone understands that there is no warranty for this free
software.  If the software is modified by someone else and passed on, we
want its recipients to know that what they have is not the original, so
that any problems introduced by others will not reflect on the original
authors\' reputations.

  Finally, any free program is threatened constantly by software
patents.  We wish to avoid the danger that redistributors of a free
program will individually obtain patent licenses, in effect making the
program proprietary.  To prevent this, we have made it clear that any
patent must be licensed for everyone\'s free use or not licensed at all.

  The precise terms and conditions for copying, distribution and
modification follow.


GNU GENERAL PUBLIC LICENSE
TERMS AND CONDITIONS FOR COPYING, DISTRIBUTION AND MODIFICATION
---------------------------------------------------------------

  0. This License applies to any program or other work which contains
a notice placed by the copyright holder saying it may be distributed
under the terms of this General Public License.  The "Program", below,
refers to any such program or work, and a "work based on the Program"
means either the Program or any derivative work under copyright law:
that is to say, a work containing the Program or a portion of it,
either verbatim or with modifications and/or translated into another
language.  (Hereinafter, translation is included without limitation in
the term "modification".)  Each licensee is addressed as "you".

Activities other than copying, distribution and modification are not
covered by this License; they are outside its scope.  The act of
running the Program is not restricted, and the output from the Program
is covered only if its contents constitute a work based on the
Program (independent of having been made by running the Program).
Whether that is true depends on what the Program does.

  1. You may copy and distribute verbatim copies of the Program\'s
source code as you receive it, in any medium, provided that you
conspicuously and appropriately publish on each copy an appropriate
copyright notice and disclaimer of warranty; keep intact all the
notices that refer to this License and to the absence of any warranty;
and give any other recipients of the Program a copy of this License
along with the Program.

You may charge a fee for the physical act of transferring a copy, and
you may at your option offer warranty protection in exchange for a fee.

  2. You may modify your copy or copies of the Program or any portion
of it, thus forming a work based on the Program, and copy and
distribute such modifications or work under the terms of Section 1
above, provided that you also meet all of these conditions:

    a) You must cause the modified files to carry prominent notices
    stating that you changed the files and the date of any change.

    b) You must cause any work that you distribute or publish, that in
    whole or in part contains or is derived from the Program or any
    part thereof, to be licensed as a whole at no charge to all third
    parties under the terms of this License.

    c) If the modified program normally reads commands interactively
    when run, you must cause it, when started running for such
    interactive use in the most ordinary way, to print or display an
    announcement including an appropriate copyright notice and a
    notice that there is no warranty (or else, saying that you provide
    a warranty) and that users may redistribute the program under
    these conditions, and telling the user how to view a copy of this
    License.  (Exception: if the Program itself is interactive but
    does not normally print such an announcement, your work based on
    the Program is not required to print an announcement.)

These requirements apply to the modified work as a whole.  If
identifiable sections of that work are not derived from the Program,
and can be reasonably considered independent and separate works in
themselves, then this License, and its terms, do not apply to those
sections when you distribute them as separate works.  But when you
distribute the same sections as part of a whole which is a work based
on the Program, the distribution of the whole must be on the terms of
this License, whose permissions for other licensees extend to the
entire whole, and thus to each and every part regardless of who wrote it.

Thus, it is not the intent of this section to claim rights or contest
your rights to work written entirely by you; rather, the intent is to
exercise the right to control the distribution of derivative or
collective works based on the Program.

In addition, mere aggregation of another work not based on the Program
with the Program (or with a work based on the Program) on a volume of
a storage or distribution medium does not bring the other work under
the scope of this License.

  3. You may copy and distribute the Program (or a work based on it,
under Section 2) in object code or executable form under the terms of
Sections 1 and 2 above provided that you also do one of the following:

    a) Accompany it with the complete corresponding machine-readable
    source code, which must be distributed under the terms of Sections
    1 and 2 above on a medium customarily used for software interchange; or,

    b) Accompany it with a written offer, valid for at least three
    years, to give any third party, for a charge no more than your
    cost of physically performing source distribution, a complete
    machine-readable copy of the corresponding source code, to be
    distributed under the terms of Sections 1 and 2 above on a medium
    customarily used for software interchange; or,

    c) Accompany it with the information you received as to the offer
    to distribute corresponding source code.  (This alternative is
    allowed only for noncommercial distribution and only if you
    received the program in object code or executable form with such
    an offer, in accord with Subsection b above.)

The source code for a work means the preferred form of the work for
making modifications to it.  For an executable work, complete source
code means all the source code for all modules it contains, plus any
associated interface definition files, plus the scripts used to
control compilation and installation of the executable.  However, as a
special exception, the source code distributed need not include
anything that is normally distributed (in either source or binary
form) with the major components (compiler, kernel, and so on) of the
operating system on which the executable runs, unless that component
itself accompanies the executable.

If distribution of executable or object code is made by offering
access to copy from a designated place, then offering equivalent
access to copy the source code from the same place counts as
distribution of the source code, even though third parties are not
compelled to copy the source along with the object code.

  4. You may not copy, modify, sublicense, or distribute the Program
except as expressly provided under this License.  Any attempt
otherwise to copy, modify, sublicense or distribute the Program is
void, and will automatically terminate your rights under this License.
However, parties who have received copies, or rights, from you under
this License will not have their licenses terminated so long as such
parties remain in full compliance.

  5. You are not required to accept this License, since you have not
signed it.  However, nothing else grants you permission to modify or
distribute the Program or its derivative works.  These actions are
prohibited by law if you do not accept this License.  Therefore, by
modifying or distributing the Program (or any work based on the
Program), you indicate your acceptance of this License to do so, and
all its terms and conditions for copying, distributing or modifying
the Program or works based on it.

  6. Each time you redistribute the Program (or any work based on the
Program), the recipient automatically receives a license from the
original licensor to copy, distribute or modify the Program subject to
these terms and conditions.  You may not impose any further
restrictions on the recipients\' exercise of the rights granted herein.
You are not responsible for enforcing compliance by third parties to
this License.

  7. If, as a consequence of a court judgment or allegation of patent
infringement or for any other reason (not limited to patent issues),
conditions are imposed on you (whether by court order, agreement or
otherwise) that contradict the conditions of this License, they do not
excuse you from the conditions of this License.  If you cannot
distribute so as to satisfy simultaneously your obligations under this
License and any other pertinent obligations, then as a consequence you
may not distribute the Program at all.  For example, if a patent
license would not permit royalty-free redistribution of the Program by
all those who receive copies directly or indirectly through you, then
the only way you could satisfy both it and this License would be to
refrain entirely from distribution of the Program.

If any portion of this section is held invalid or unenforceable under
any particular circumstance, the balance of the section is intended to
apply and the section as a whole is intended to apply in other
circumstances.

It is not the purpose of this section to induce you to infringe any
patents or other property right claims or to contest validity of any
such claims; this section has the sole purpose of protecting the
integrity of the free software distribution system, which is
implemented by public license practices.  Many people have made
generous contributions to the wide range of software distributed
through that system in reliance on consistent application of that
system; it is up to the author/donor to decide if he or she is willing
to distribute software through any other system and a licensee cannot
impose that choice.

This section is intended to make thoroughly clear what is believed to
be a consequence of the rest of this License.

  8. If the distribution and/or use of the Program is restricted in
certain countries either by patents or by copyrighted interfaces, the
original copyright holder who places the Program under this License
may add an explicit geographical distribution limitation excluding
those countries, so that distribution is permitted only in or among
countries not thus excluded.  In such case, this License incorporates
the limitation as if written in the body of this License.

  9. The Free Software Foundation may publish revised and/or new versions
of the General Public License from time to time.  Such new versions will
be similar in spirit to the present version, but may differ in detail to
address new problems or concerns.

Each version is given a distinguishing version number.  If the Program
specifies a version number of this License which applies to it and "any
later version", you have the option of following the terms and conditions
either of that version or of any later version published by the Free
Software Foundation.  If the Program does not specify a version number of
this License, you may choose any version ever published by the Free Software
Foundation.

  10. If you wish to incorporate parts of the Program into other free
programs whose distribution conditions are different, write to the author
to ask for permission.  For software which is copyrighted by the Free
Software Foundation, write to the Free Software Foundation; we sometimes
make exceptions for this.  Our decision will be guided by the two goals
of preserving the free status of all derivatives of our free software and
of promoting the sharing and reuse of software generally.

NO WARRANTY
-----------

  11. BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY
FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW.  EXCEPT WHEN
OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES
PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED
OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE.  THE ENTIRE RISK AS
TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU.  SHOULD THE
PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING,
REPAIR OR CORRECTION.

  12. IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED TO IN WRITING
WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR
REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES,
INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING
OUT OF THE USE OR INABILITY TO USE THE PROGRAM (INCLUDING BUT NOT LIMITED
TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY
YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER
PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE
POSSIBILITY OF SUCH DAMAGES.

---------------------------
END OF TERMS AND CONDITIONS',
    'readme' => '--------------------
mspre
--------------------
Author: Andrey Stepanenko <info@bustep.ru>
--------------------

A basic Extra for MODx Revolution.',
  ),
  'manifest-vehicles' => 
  array (
    0 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOFileVehicle',
      'class' => 'xPDOFileVehicle',
      'guid' => '0d19ffab436a4f89fee6c817f502e114',
      'native_key' => '0d19ffab436a4f89fee6c817f502e114',
      'filename' => 'xPDOFileVehicle/96840e04af6c24fb376ce156157fcd0a.vehicle',
    ),
    1 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOScriptVehicle',
      'class' => 'xPDOScriptVehicle',
      'guid' => '93b06c643ef8b80df5fbf9c13effc524',
      'native_key' => '93b06c643ef8b80df5fbf9c13effc524',
      'filename' => 'xPDOScriptVehicle/9c7f4482354f979a6e3e2f24b7cdaaf6.vehicle',
    ),
    2 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modNamespace',
      'guid' => '58886df2918732a5c398816e3435d2b5',
      'native_key' => 'mspre',
      'filename' => 'modNamespace/2dc56ca8b6d9b88a0178a3168b32511d.vehicle',
      'namespace' => 'mspre',
    ),
    3 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => '5a203ef2d48cb01622569604d33ec5a4',
      'native_key' => 'msPreExportGetFields',
      'filename' => 'modEvent/63e8cd3501abea40fd19e85fbc713f85.vehicle',
      'namespace' => 'mspre',
    ),
    4 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modEvent',
      'guid' => 'a4f1d4a7a6e7d95bbe6d3dfd6716b1ee',
      'native_key' => 'msPreExportToArrayAfter',
      'filename' => 'modEvent/5b4e05fb4ec82407643d5f6e84de3df2.vehicle',
      'namespace' => 'mspre',
    ),
    5 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'b95e4296c26b5c13c65300e02d69406a',
      'native_key' => 'mspre',
      'filename' => 'modMenu/da91f7f344cf8363a5dce4155308b087.vehicle',
      'namespace' => 'mspre',
    ),
    6 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => 'de163292d32c63d4c74c3f489fb1c9b3',
      'native_key' => 'mspre_product',
      'filename' => 'modMenu/ea856d638900a934a3ef18adc8b1be83.vehicle',
      'namespace' => 'mspre',
    ),
    7 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modMenu',
      'guid' => '457120ad0aafe95186dd2de3cf87ed3f',
      'native_key' => 'mspre_resource',
      'filename' => 'modMenu/bd9469f914cab9683b5dc762911692e3.vehicle',
      'namespace' => 'mspre',
    ),
    8 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'b22d9ef1f84ef167d2ff54c5ea875662',
      'native_key' => 'mspre_default_context',
      'filename' => 'modSystemSetting/38cfe0c6ec16caf258d9692f65e91bde.vehicle',
      'namespace' => 'mspre',
    ),
    9 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '17cc388c9273f87aab831928e03b556c',
      'native_key' => 'mspre_enable_plugins_minishop2',
      'filename' => 'modSystemSetting/238efad9ac2c24f7124c6027109f4155.vehicle',
      'namespace' => 'mspre',
    ),
    10 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e411dd3521f92c78672dedf2908dd33a',
      'native_key' => 'mspre_filter_size_colump',
      'filename' => 'modSystemSetting/71f34d8d5bf7b977663011ca892a3628.vehicle',
      'namespace' => 'mspre',
    ),
    11 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '130b20af232ba6a8211b34c21269c7b5',
      'native_key' => 'mspre_root_parent',
      'filename' => 'modSystemSetting/2a95db8cdb278c4bd1c1c360706f7d0e.vehicle',
      'namespace' => 'mspre',
    ),
    12 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '9918c8002617e9f28142cabca53b4958',
      'native_key' => 'mspre_allow_output_to_toolbar',
      'filename' => 'modSystemSetting/c7b2ae917f60c9c58036f191f28a06ea.vehicle',
      'namespace' => 'mspre',
    ),
    13 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5a79e5324de0a8ce388dcb505f60059e',
      'native_key' => 'mspre_status_purchased_goods',
      'filename' => 'modSystemSetting/ed055d8d4dbc71553484c51c294afa85.vehicle',
      'namespace' => 'mspre',
    ),
    14 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '614762dc50bddda660346503147a374b',
      'native_key' => 'mspre_default_width',
      'filename' => 'modSystemSetting/982eb175929e79594f9f063d7d47fbf8.vehicle',
      'namespace' => 'mspre',
    ),
    15 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ba183ae875d3f02744a9b6af485533d2',
      'native_key' => 'mspre_max_records_processed',
      'filename' => 'modSystemSetting/7f6c89575eacbebca94cdc593be5df27.vehicle',
      'namespace' => 'mspre',
    ),
    16 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ee559c698a3de13abe19dff143e24db7',
      'native_key' => 'mspre_max_records_processed_all',
      'filename' => 'modSystemSetting/a1f4f49e2dec7acae8113dc01df58897.vehicle',
      'namespace' => 'mspre',
    ),
    17 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'a5177a8f1caeeefdafc9e98fc306d628',
      'native_key' => 'mspre_mode_expert',
      'filename' => 'modSystemSetting/306f98332aefa28c96a6bd09bddaacc8.vehicle',
      'namespace' => 'mspre',
    ),
    18 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '5a8778941aae088ff5a5aba6bb81c5ba',
      'native_key' => 'mspre_enable_save_setting_user',
      'filename' => 'modSystemSetting/c5ccf7402f96406718c7dc4a318ae910.vehicle',
      'namespace' => 'mspre',
    ),
    19 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2349119418040eeb40bdbcc17c05d3c0',
      'native_key' => 'mspre_check_string_values_htmlentities',
      'filename' => 'modSystemSetting/b3879543fb992b0e133b5d7dc5633301.vehicle',
      'namespace' => 'mspre',
    ),
    20 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'e4cf810c299037fc70ab1ccf89014943',
      'native_key' => 'mspre_field_price',
      'filename' => 'modSystemSetting/f6c7d4e51b68b70bb7c2a5b18b4e9c37.vehicle',
      'namespace' => 'mspre',
    ),
    21 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '43917810911d2f3711d01ba3c9800680',
      'native_key' => 'mspre_field_string',
      'filename' => 'modSystemSetting/75edeb6e0e96a7987503b1c92c1a4d8e.vehicle',
      'namespace' => 'mspre',
    ),
    22 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '34ac1e1eeea6f185228c79b02faa6ec4',
      'native_key' => 'mspre_field_weight',
      'filename' => 'modSystemSetting/60e129500ee5d6a68707a25445085756.vehicle',
      'namespace' => 'mspre',
    ),
    23 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '7e4849d2b9485a7ee8e215d50acea080',
      'native_key' => 'mspre_product_table_selected_fields',
      'filename' => 'modSystemSetting/9f0e395c4c13223b76023bf32e0e9e31.vehicle',
      'namespace' => 'mspre',
    ),
    24 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '61bdca8a37c1f6feebc88ddb915bae0c',
      'native_key' => 'mspre_product_export_selected_fields',
      'filename' => 'modSystemSetting/c9972962eac8fa8058a2534528b2f4d7.vehicle',
      'namespace' => 'mspre',
    ),
    25 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4dc7e71c46ae5527d1850b7e4d0c13d5',
      'native_key' => 'mspre_resource_export_selected_fields',
      'filename' => 'modSystemSetting/4752f57c454886f553c53e915974044f.vehicle',
      'namespace' => 'mspre',
    ),
    26 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '1c85a625437475d886856ba6e2ebca7d',
      'native_key' => 'mspre_resource_table_selected_fields',
      'filename' => 'modSystemSetting/45e7e5a5b1ddec61acc808cc5b53603a.vehicle',
      'namespace' => 'mspre',
    ),
    27 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'ecfcbd937624491ae9c70c0390c88897',
      'native_key' => 'mspre_alias_field_export',
      'filename' => 'modSystemSetting/755035856ecb50de72b6c2ba06a57310.vehicle',
      'namespace' => 'mspre',
    ),
    28 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '0254bd486404d53e5058311032d1fcdd',
      'native_key' => 'mspre_character_separate_options',
      'filename' => 'modSystemSetting/36c32e1ead1080a9aef5a2cfd625fc2d.vehicle',
      'namespace' => 'mspre',
    ),
    29 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '19c26fb27f25646dd77f516fb5e725a3',
      'native_key' => 'mspre_export_price_format',
      'filename' => 'modSystemSetting/7e5a9b3fcb7c65789c7dc47f9259268e.vehicle',
      'namespace' => 'mspre',
    ),
    30 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '2eceb45dafade56d94eea879dce41598',
      'native_key' => 'mspre_export_weight_format',
      'filename' => 'modSystemSetting/46aff1777697127b780b28d90be20122.vehicle',
      'namespace' => 'mspre',
    ),
    31 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'c5b44e47cf9c045ddf4ea77d9a865056',
      'native_key' => 'mspre_export_values_default_empty',
      'filename' => 'modSystemSetting/20fe6ae4c48eb525aae3b011a77239f8.vehicle',
      'namespace' => 'mspre',
    ),
    32 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '78d51578fe0b539d3896185bda9f9a32',
      'native_key' => 'mspre_export_add_url',
      'filename' => 'modSystemSetting/086c26b8575188b945955d0541c466b6.vehicle',
      'namespace' => 'mspre',
    ),
    33 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '4a382d7b0d1dc484a9be59a40e401a1f',
      'native_key' => 'mspre_export_add_default_columns',
      'filename' => 'modSystemSetting/9a9aba0c89974ffd164868f8ba8346a0.vehicle',
      'namespace' => 'mspre',
    ),
    34 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '910b538d9a3bd0f79c255111d56cadb5',
      'native_key' => 'mspre_export_date_format',
      'filename' => 'modSystemSetting/82b57d8248976070eefbe6c0b1600ad7.vehicle',
      'namespace' => 'mspre',
    ),
    35 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '02b9bf17ad2d7ef82d2d8014080e8993',
      'native_key' => 'mspre_export_memory_limit',
      'filename' => 'modSystemSetting/2391dcf25a5a727b3bb3c21d3fbd0411.vehicle',
      'namespace' => 'mspre',
    ),
    36 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'aed40865202f8546d5a9cbe9e6a6a928',
      'native_key' => 'mspre_max_execution_time',
      'filename' => 'modSystemSetting/9ca1b1b5e876c03e95a61bd85760e5ad.vehicle',
      'namespace' => 'mspre',
    ),
    37 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '184b485b9aa787bf78dd6590002172ed',
      'native_key' => 'mspre_resource_tree_node_name',
      'filename' => 'modSystemSetting/dd56b3c27e97c653a7aab2fb3623df29.vehicle',
      'namespace' => 'mspre',
    ),
    38 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '12f10572367e454a5e62eb4eda17d1e5',
      'native_key' => 'mspre_resource_tree_node_name_fallback',
      'filename' => 'modSystemSetting/10f5ac7ee8d09afb114dab12213e6fcf.vehicle',
      'namespace' => 'mspre',
    ),
    39 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => 'dfe9f56f87d69afd639578c153b2d57f',
      'native_key' => 'mspre_resource_tree_node_tooltip',
      'filename' => 'modSystemSetting/9176d14966ec23e29d192aa9800b5ed9.vehicle',
      'namespace' => 'mspre',
    ),
    40 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOObjectVehicle',
      'class' => 'modSystemSetting',
      'guid' => '09ee8f2affb6872e4482429e492992a4',
      'native_key' => 'mspre_tree_default_sort',
      'filename' => 'modSystemSetting/27c22d625c85a9c7ec2799b3be32f192.vehicle',
      'namespace' => 'mspre',
    ),
    41 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'encryptedVehicle',
      'class' => 'modCategory',
      'guid' => '3c93d43716c8d3fa65f01308f084f713',
      'native_key' => NULL,
      'filename' => 'modCategory/5afa6de87e015d72772fddeec43e1585.vehicle',
      'namespace' => 'mspre',
    ),
    42 => 
    array (
      'vehicle_package' => 'transport',
      'vehicle_class' => 'xPDOScriptVehicle',
      'class' => 'xPDOScriptVehicle',
      'guid' => '0be9abdf7c246dca9625a8cbf799db9c',
      'native_key' => '0be9abdf7c246dca9625a8cbf799db9c',
      'filename' => 'xPDOScriptVehicle/415066af46670d3601e4863ec36aa71a.vehicle',
      'namespace' => 'mspre',
    ),
  ),
);