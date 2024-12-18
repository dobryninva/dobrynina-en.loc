<?php  return array (
  'area_ms2_cart' => 'Корзина',
  'area_ms2_category' => 'Категория товаров',
  'area_ms2_frontend' => 'Сайт',
  'area_ms2_gallery' => 'Галерея',
  'area_ms2_import' => 'Импорт',
  'area_ms2_main' => 'Основные настройки',
  'area_ms2_order' => 'Заказы',
  'area_ms2_payment' => 'Платежи',
  'area_ms2_product' => 'Товар',
  'area_ms2_statuses' => 'Статусы',
  'ms2_source_imageNameType_desc' => 'Этот параметр указывает, как нужно переименовать файл при загрузке. Hash - это генерация уникального имени, в зависимости от содержимого файла. Friendly - генерация имени по алгоритму дружественных url страниц сайта (они управляются системными настройками).',
  'ms2_source_maxUploadHeight_desc' => 'Максимальная высота изображения для загрузки. Всё, что больше, будет ужато до этого значения.',
  'ms2_source_maxUploadSize_desc' => 'Максимальный размер загружаемых изображений (в байтах).',
  'ms2_source_maxUploadWidth_desc' => 'Максимальная ширина изображения для загрузки. Всё, что больше, будет ужато до этого значения.',
  'ms2_source_thumbnails_desc' => 'Закодированный в JSON массив с параметрами генерации уменьшенных копий изображений.',
  'setting_mgr_tree_icon_mscategory' => 'Иконка категории',
  'setting_mgr_tree_icon_mscategory_desc' => 'Иконка категории товаров miniShop2 в дереве ресурсов',
  'setting_mgr_tree_icon_msproduct' => 'Иконка товара',
  'setting_mgr_tree_icon_msproduct_desc' => 'Иконка товара miniShop2 в дереве ресурсов',
  'setting_ms2_cart_context' => 'Использовать единую корзину для всех контекстов?',
  'setting_ms2_cart_context_desc' => 'Если включено, то используется общая корзина для всех контекстов. Если выключено - то у каждого контекста используется своя корзина.',
  'setting_ms2_cart_handler_class' => 'Класс обработчик корзины',
  'setting_ms2_cart_handler_class_desc' => 'Имя класса, который реализует логику работы с корзиной.',
  'setting_ms2_cart_js_class_name' => 'Название JS класса управления корзиной',
  'setting_ms2_cart_js_class_name_desc' => 'класс должен быть экспортирован по умолчанию',
  'setting_ms2_cart_js_class_path' => 'Путь к JS управления корзиной',
  'setting_ms2_cart_js_class_path_desc' => 'Путь указывается относительно папки assets/components/minishop2/js/web/modules',
  'setting_ms2_cart_max_count' => 'Максимальное количество товаров в корзине',
  'setting_ms2_cart_max_count_desc' => 'По умолчанию 1000. При превышении этого значения будет выведено уведомление.',
  'setting_ms2_cart_product_key_fields' => 'Список полей для ключа товара в корзине',
  'setting_ms2_cart_product_key_fields_desc' => 'Список полей товара через запятую, на основании которых формируется ключ товара в корзине',
  'setting_ms2_category_content_default' => 'Содержимое категории по умолчанию',
  'setting_ms2_category_content_default_desc' => 'Здесь вы можете указать контент вновь создаваемой категории. По умолчанию установлен вывод дочерних товаров.',
  'setting_ms2_category_grid_fields' => 'Поля таблицы товаров',
  'setting_ms2_category_grid_fields_desc' => 'Список видимых полей таблицы с товарами категории, через запятую. Доступны: "id,menuindex,pagetitle,article,price,thumb,new,favorite,popular".',
  'setting_ms2_category_id_as_alias' => 'ID категории как псевдоним',
  'setting_ms2_category_id_as_alias_desc' => 'Если включено, псевдонимы для дружественных имён категорий не будут генерироваться. Вместо этого будут подставляться их ID.',
  'setting_ms2_category_remember_grid' => 'Запоминание таблицы категории',
  'setting_ms2_category_remember_grid_desc' => 'Если включено, состояние таблицы категории будет запоминаться и восстанавливаться при загрузке страницы, включая номер страницы и строку поиска.',
  'setting_ms2_category_remember_tabs' => 'Запоминание вкладки категории',
  'setting_ms2_category_remember_tabs_desc' => 'Если включено, активная вкладка панели категории будет запоминаться и восстанавливаться при загрузке страницы.',
  'setting_ms2_category_show_comments' => 'Показывать комментарии категории',
  'setting_ms2_category_show_comments_desc' => 'Показывать комментарии оставленные ко всем товарам категории, если установлен компонент "Tickets"',
  'setting_ms2_category_show_nested_products' => 'Показывать вложенные товары категории',
  'setting_ms2_category_show_nested_products_desc' => 'Если вы включаете эту опцию, то в категории будут показаны все вложенные товары. Они выделены другим цветом и у них есть имя родной категории под pagetitle.',
  'setting_ms2_category_show_options' => 'Показывать опции товаров категории',
  'setting_ms2_category_show_options_desc' => 'Показывать опции к товарам категории.',
  'setting_ms2_chunks_categories' => 'Категории для списка чанков',
  'setting_ms2_chunks_categories_desc' => 'Список ID категорий через запятую для списка чанков.',
  'setting_ms2_date_format' => 'Формат даты',
  'setting_ms2_date_format_desc' => 'Укажите формат дат miniShop2, используя синтаксис php функции strftime(). По умолчанию формат "%d.%m.%y %H:%M".',
  'setting_ms2_email_manager' => 'Почтовые адреса менеджеров',
  'setting_ms2_email_manager_desc' => 'Список почтовых ящиков менеджеров, через запятую, на которые отправлять уведомления об изменении статуса заказа.',
  'setting_ms2_frontend_css' => 'Стили фронтенда',
  'setting_ms2_frontend_css_desc' => 'Путь к файлу со стилями магазина. Если вы хотите использовать собственные стили - укажите путь к ним здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'setting_ms2_frontend_js' => 'Скрипты фронтенда',
  'setting_ms2_frontend_js_desc' => 'Путь к файлу со скриптами магазина. Если вы хотите использовать собственные скрипты - укажите путь к ним здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'setting_ms2_frontend_message_css' => 'Стили библиотеки уведомлений',
  'setting_ms2_frontend_message_css_desc' => 'Путь к CSS файлу вашей библиотеки уведомлений. По умолчанию к jgrowl. <br>Если вы хотите использовать собственную библиотеку - укажите путь к ее css каталогу здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'setting_ms2_frontend_message_js' => 'Скрипты библиотеки уведомлений',
  'setting_ms2_frontend_message_js_desc' => 'Путь к JS файлу вашей библиотеки уведомлений. По умолчанию к jgrowl. <br>Если вы хотите использовать собственную библиотеку - укажите путь к ее JS каталогу здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'setting_ms2_frontend_message_js_settings' => 'Настройки библиотеки уведомлений',
  'setting_ms2_frontend_message_js_settings_desc' => 'Путь к файлу с реализацией шаблона уведомлений на основе вашей библиотеки. <br>По умолчанию к настройкам jgrowl. <br>Если вы хотите использовать собственную библиотеку - укажите путь к ее настройкам здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'setting_ms2_frontend_notify_js_settings' => 'Настройки уведомлений для новой версии скриптов',
  'setting_ms2_frontend_notify_js_settings_desc' => 'Путь к файлу с настройками. Обратите внимание, файл должен быть в формате JSON',
  'setting_ms2_notify_js_class_name' => 'Название JS класса для показа уведомлений',
  'setting_ms2_notify_js_class_name_desc' => 'Класс должен быть экспортирован по умолчанию',
  'setting_ms2_notify_js_class_path' => 'Путь к JS классу для показа уведомлений',
  'setting_ms2_notify_js_class_path_desc' => 'Путь указывается относительно папки assets/components/minishop2/js/web/modules',
  'setting_ms2_order_address_fields' => 'Поля адреса доставки',
  'setting_ms2_order_address_fields_desc' => 'Список полей доставки, которые будут показаны на третьей вкладке карточки заказа. Доступны: "receiver,phone,email,index,country,region,city,metro,street,building,entrance,floor,room,comment,text_address". Если параметр пуст, вкладка будет скрыта.',
  'setting_ms2_order_format_num' => 'Формат нумерации заказа',
  'setting_ms2_order_format_num_desc' => 'Формат нумерации заказа. Доступные значения в формате PHP strftime()',
  'setting_ms2_order_format_num_separator' => 'Разделитель для нумерации заказа',
  'setting_ms2_order_format_num_separator_desc' => 'Разделитель для нумерации заказа. Доступные значения: "/", "," и "-"',
  'setting_ms2_order_format_phone' => 'Формат валидации телефона',
  'setting_ms2_order_format_phone_desc' => 'Формат валидации телефона. Используется в функции preg_replace. Пример /[^-+()0-9]/u',
  'setting_ms2_order_grid_fields' => 'Поля таблицы заказов',
  'setting_ms2_order_grid_fields_desc' => 'Список полей, которые будут показаны в таблице заказов. Доступны: "id,num,customer,status,cost,weight,delivery,payment,createdon,updatedon,comment".',
  'setting_ms2_order_handler_class' => 'Класс обработчик заказа',
  'setting_ms2_order_handler_class_desc' => 'Имя класса, который реализует логику оформления заказа.',
  'setting_ms2_order_js_class_name' => 'Название JS класса для оформления заказа',
  'setting_ms2_order_js_class_name_desc' => 'Класс должен быть экспортирован по умолчанию',
  'setting_ms2_order_js_class_path' => 'Путь к JS классу для оформления заказа',
  'setting_ms2_order_js_class_path_desc' => 'Путь указывается относительно папки assets/components/minishop2/js/web/modules',
  'setting_ms2_order_product_fields' => 'Поля таблицы покупок',
  'setting_ms2_order_product_fields_desc' => 'Список полей таблицы заказанных товаров. Доступны: "product_pagetitle,vendor_name,product_article,weight,price,count,cost". Поля товара указываются с префиксом "product_", например "product_pagetitle,product_article". Дополнительно можно указывать значения из поля options с префиксом "option_", например: "option_color,option_size".',
  'setting_ms2_order_product_options' => 'Поля опций продукта в заказе',
  'setting_ms2_order_product_options_desc' => 'Перечень редактируемых опций товара в окне заказа. По умолчанию: "color,size".',
  'setting_ms2_order_tv_list' => 'Список TV через запятую, которые попадут в письмо',
  'setting_ms2_order_tv_list_desc' => 'Введите список TV товара через запятую, для использования их в чанке писем',
  'setting_ms2_order_user_groups' => 'Группы регистрации покупателей',
  'setting_ms2_order_user_groups_desc' => 'Список групп, через запятую, в которые вы хотите добавлять новых покупателей при оформлении заказа.',
  'setting_ms2_plugins' => 'Плагины магазина',
  'setting_ms2_plugins_desc' => 'Массив с зарегистрированными плагинами расширения объектов модели магазина: товаров, профилей покупателя и т.д.',
  'setting_ms2_price_format' => 'Формат цен',
  'setting_ms2_price_format_desc' => 'Укажите, как нужно форматировать цены товаров функцией number_format(). Используется JSON строка с массивом для передачи 3х параметров: количество десятичных, разделитель десятичных и разделитель тысяч. По умолчанию формат [2,"."," "], что превращает "15336.6" в "15 336.60"',
  'setting_ms2_price_format_no_zeros' => 'Убирать лишние нули в ценах',
  'setting_ms2_price_format_no_zeros_desc' => 'По умолчанию, цены товаров выводятся с двумя десятичными: "15.20". Если эта опция включена, лишние нули в конце цены убираются и вы получите "15.2".',
  'setting_ms2_price_snippet' => 'Модификатор цены',
  'setting_ms2_price_snippet_desc' => 'Здесь вы можете указать имя сниппета для модификации цены при выводе на сайте и добавлении в корзину. Он должен принимать объект "$product" и возвращать число.',
  'setting_ms2_product_extra_fields' => 'Дополнительные поля товара',
  'setting_ms2_product_extra_fields_desc' => 'Список дополнительных полей товара, использующихся в магазине, через запятую. Доступны: "price,old_price,article,weight,color,size,vendor,made_in,tags,new,popular,favorite".',
  'setting_ms2_product_id_as_alias' => 'ID товара как псевдоним',
  'setting_ms2_product_id_as_alias_desc' => 'Если включено, псевдонимы для дружественных имён товаров не будут генерироваться. Вместо этого будут подставляться их ID.',
  'setting_ms2_product_main_fields' => 'Основные поля панели товара',
  'setting_ms2_product_main_fields_desc' => 'Список полей панели товара, через запятую. Например: "pagetitle,longtitle,content".',
  'setting_ms2_product_remember_tabs' => 'Запоминание вкладки товара',
  'setting_ms2_product_remember_tabs_desc' => 'Если включено, активная вкладка панели товара будет запоминаться и восстанавливаться при загрузке страницы.',
  'setting_ms2_product_show_comments' => 'Показывать комментарии товара',
  'setting_ms2_product_show_comments_desc' => 'Показывать комментарии оставленные к товару, если установлен компонент "Tickets"',
  'setting_ms2_product_show_in_tree_default' => 'Показывать в дереве по умолчанию',
  'setting_ms2_product_show_in_tree_default_desc' => 'Включите эту опцию, чтобы все создаваемые товары были видны в дереве ресурсов.',
  'setting_ms2_product_source_default' => 'Источник файлов по умолчанию',
  'setting_ms2_product_source_default_desc' => 'Источник файлов для галереи изображений товара по умолчанию.',
  'setting_ms2_product_tab_categories' => 'Вкладка категорий товара',
  'setting_ms2_product_tab_categories_desc' => 'Показывать вкладку категорий товара?',
  'setting_ms2_product_tab_extra' => 'Вкладка свойств товара',
  'setting_ms2_product_tab_extra_desc' => 'Показывать вкладку свойств товара?',
  'setting_ms2_product_tab_gallery' => 'Вкладка галереи товара',
  'setting_ms2_product_tab_gallery_desc' => 'Показывать вкладку галереи товара?',
  'setting_ms2_product_tab_links' => 'Вкладка связей товара',
  'setting_ms2_product_tab_links_desc' => 'Показывать вкладку связей товара?',
  'setting_ms2_product_tab_options' => 'Вкладка опций товара',
  'setting_ms2_product_tab_options_desc' => 'Показывать вкладку опций товара?',
  'setting_ms2_product_vertical_tabs' => 'Вертикальные табы на странице товара',
  'setting_ms2_product_vertical_tabs_desc' => 'Как показывать страницу товара? Отключение этой опции позволяет уместить страницу товара на экранах с небольшой горизонталью. Не рекомендуется.',
  'setting_ms2_register_frontend' => 'Добавлять js и css из комплекта ms2 файлы в DOM дерево',
  'setting_ms2_register_frontend_desc' => 'Разрешить добавление в DOM дерево ссылок на js и css файлы из комплекта ms2',
  'setting_ms2_services' => 'Службы магазина',
  'setting_ms2_services_desc' => 'Массив с зарегистрированными классами для корзины, заказа, доставки и оплаты. Используется сторонними дополнениями для загрузки своего функционала.',
  'setting_ms2_status_canceled' => 'ID статуса отмены заказа',
  'setting_ms2_status_canceled_desc' => 'Какой статус нужно устанавливать при отмене заказа',
  'setting_ms2_status_draft' => 'ID статуса заказа Черновик',
  'setting_ms2_status_draft_desc' => 'Какой статус нужно устанавливать для заказа-черновика',
  'setting_ms2_status_for_stat' => 'ID статусов для статистики',
  'setting_ms2_status_for_stat_desc' => 'Статусы через запятую, для построения статистики ВЫПОЛНЕННЫХ заказов',
  'setting_ms2_status_new' => 'ID первоначального статуса заказа',
  'setting_ms2_status_new_desc' => 'Какой статус нужно устанавливать для нового совершенного заказа',
  'setting_ms2_status_paid' => 'ID статуса оплаченного заказа',
  'setting_ms2_status_paid_desc' => 'Какой статус нужно устанавливать после оплаты заказа',
  'setting_ms2_template_category_default' => 'Шаблон по умолчанию для новых категорий',
  'setting_ms2_template_category_default_desc' => 'Выберите шаблон, который будет установлен по умолчанию при создании категории.',
  'setting_ms2_template_product_default' => 'Шаблон по умолчанию для новых товаров',
  'setting_ms2_template_product_default_desc' => 'Выберите шаблон, который будет установлен по умолчанию при создании товара.',
  'setting_ms2_tmp_storage' => 'Хранилище корзины и временных полей заказа',
  'setting_ms2_tmp_storage_desc' => 'Для хранения корзины и временных полей заказа в сессии укажите <strong>session</strong>. <br>Для хранения в базе данных укажите <strong>db</strong>',
  'setting_ms2_toggle_js_type' => 'Включить новый JavaScript?',
  'setting_ms2_toggle_js_type_desc' => 'если выбрано ДА будут подключены скрипты без зависимости от jQuery, написанные с использованием возможностей стандарта ES6',
  'setting_ms2_use_scheduler' => 'Использовать менеджер очередей',
  'setting_ms2_use_scheduler_desc' => 'Перед использованием убедитесь, что у вас установлен компонент Scheduler',
  'setting_ms2_utility_import_fields' => 'Список полей для импорта',
  'setting_ms2_utility_import_fields_delimiter' => 'Разделитель колонок в файле импорта',
  'setting_ms2_vanila_js' => 'Новые скрипты фронтенда',
  'setting_ms2_vanila_js_desc' => 'Путь к файлу инициализации новых скриптов магазина. Если хотите указать свои параметры инициализации - укажите путь к ним здесь, или очистите параметр и загрузите их вручную через шаблон сайта.',
  'setting_ms2_weight_format' => 'Формат веса',
  'setting_ms2_weight_format_desc' => 'Укажите, как нужно форматировать вес товаров функцией number_format(). Используется JSON строка с массивом для передачи 3х параметров: количество десятичных, разделитель десятичных и разделитель тысяч. По умолчанию формат [3,"."," "], что превращает "141.3" в "141.300"',
  'setting_ms2_weight_format_no_zeros' => 'Убирать лишние нули у веса',
  'setting_ms2_weight_format_no_zeros_desc' => 'По умолчанию, вес товаров выводятся с тремя десятичными: "15.250". Если эта опция включена, лишние нули в конце веса убираются и вы получите "15.25".',
  'setting_ms2_weight_snippet' => 'Модификатор веса',
  'setting_ms2_weight_snippet_desc' => 'Здесь вы можете указать имя сниппета для модификации веса товара при выводе на сайте и добавлении в корзину. Он должен принимать объект "$product" и возвращать число.',
  'minishop2' => 'miniShop2',
  'ms2_actions' => 'Действия',
  'ms2_all' => 'Все',
  'ms2_btn_addoption' => 'Добавить',
  'ms2_btn_assign' => 'Назначить',
  'ms2_btn_back' => 'Назад (alt + &uarr;)',
  'ms2_btn_cancel' => 'Отмена',
  'ms2_btn_copy' => 'Скопировать',
  'ms2_btn_create' => 'Создать',
  'ms2_btn_delete' => 'Удалить',
  'ms2_btn_duplicate' => 'Сделать копию товара',
  'ms2_btn_edit' => 'Изменить',
  'ms2_btn_help' => 'Помощь',
  'ms2_btn_next' => 'Следующий товар (alt + &rarr;)',
  'ms2_btn_prev' => 'Предыдущий товар (alt + &larr;)',
  'ms2_btn_publish' => 'Включить',
  'ms2_btn_save' => 'Сохранить',
  'ms2_btn_undelete' => 'Восстановить',
  'ms2_btn_unpublish' => 'Отключить',
  'ms2_btn_view' => 'Просмотр',
  'ms2_category' => 'Категория товаров',
  'ms2_category_create' => 'Добавить категорию',
  'ms2_category_create_here' => 'Категорию с товарами',
  'ms2_category_delete' => 'Удалить категорию',
  'ms2_category_duplicate' => 'Копировать категорию',
  'ms2_category_err_ns' => 'Категория не выбрана',
  'ms2_category_manage' => 'Управление товарами',
  'ms2_category_new' => 'Новая категория',
  'ms2_category_option_add' => 'Добавить характеристику',
  'ms2_category_option_rank' => 'Порядок сортировки',
  'ms2_category_publish' => 'Опубликовать категорию',
  'ms2_category_show_nested' => 'Показывать вложенные товары',
  'ms2_category_tree' => 'Дерево категорий',
  'ms2_category_type' => 'Категория товаров',
  'ms2_category_undelete' => 'Восстановить категорию',
  'ms2_category_unpublish' => 'Убрать с публикации',
  'ms2_category_view' => 'Просмотреть на сайте',
  'ms2_customer' => 'Покупатель',
  'ms2_default_value' => 'Значение по умолчанию',
  'ms2_deliveries' => 'Варианты доставки',
  'ms2_deliveries_intro' => 'Возможные варианты доставки. Логика рассчёта стоимости доставки в зависимости от расстояния и веса реализуется классом, который вы укажете в настройках. <br>Если вы не укажете свой класс, рассчеты будут производиться алгоритмом по умолчанию.',
  'ms2_delivery' => 'Доставка',
  'ms2_email_link_to_order' => 'Заказ в панели управления →',
  'ms2_email_subject_cancelled_user' => 'Ваш заказ #[[+num]] был отменён',
  'ms2_email_subject_new_manager' => 'У вас новый заказ #[[+num]]',
  'ms2_email_subject_new_user' => 'Вы сделали заказ #[[+num]] на сайте [[++site_name]]',
  'ms2_email_subject_paid_manager' => 'Заказ #[[+num]] был оплачен',
  'ms2_email_subject_paid_user' => 'Вы оплатили заказ #[[+num]]',
  'ms2_email_subject_sent_user' => 'Ваш заказ #[[+num]] был отправлен',
  'ms2_err_ae' => 'Это поле должно быть уникально',
  'ms2_err_delivery_nf' => 'Способ доставки с таким идентификатором не найден.',
  'ms2_err_gallery_exists' => 'Такое изображение уже есть в галерее товара.',
  'ms2_err_gallery_ext' => 'Неверное расширение файла',
  'ms2_err_gallery_ns' => 'Передан пустой файл',
  'ms2_err_gallery_save' => 'Файл не был сохранён (см. системный журнал).',
  'ms2_err_gallery_thumb' => 'Не получилось сгенерировать превьюшки. Смотрите системный лог.',
  'ms2_err_json' => 'Это поле требует JSON строку',
  'ms2_err_link_equal' => 'Вы пытаетесь добавить товару ссылку на самого себя',
  'ms2_err_ns' => 'Это поле обязательно',
  'ms2_err_order_nf' => 'Заказ с таким идентификатором не найден.',
  'ms2_err_payment_nf' => 'Способ оплаты с таким идентификатором не найден.',
  'ms2_err_register_globals' => 'Ошибка: php параметр <b>register_globals</b> должен быть выключен.',
  'ms2_err_status_final' => 'Установлен финальный статус. Его нельзя менять.',
  'ms2_err_status_fixed' => 'Установлен фиксирующий статус. Вы не можете сменить его на более ранний.',
  'ms2_err_status_nf' => 'Статус с таким идентификатором не найден.',
  'ms2_err_status_same' => 'Этот статус уже установлен.',
  'ms2_err_status_wrong' => 'Неверный статус заказа.',
  'ms2_err_unknown' => 'Неизвестная ошибка',
  'ms2_err_user_nf' => 'Пользователь не найден.',
  'ms2_err_value_duplicate' => 'Вы не ввели значение или ввели повтор.',
  'ms2_err_wrong_image' => 'Файл не является корректным изображением.',
  'ms2_frontend_add_to_cart' => 'Добавить в корзину',
  'ms2_frontend_address' => 'Адрес доставки',
  'ms2_frontend_building' => 'Дом',
  'ms2_frontend_city' => 'Город',
  'ms2_frontend_color' => 'Цвет',
  'ms2_frontend_colors' => 'Цвета',
  'ms2_frontend_comment' => 'Комментарий',
  'ms2_frontend_count_unit' => 'шт.',
  'ms2_frontend_country' => 'Страна',
  'ms2_frontend_credentials' => 'Данные получателя',
  'ms2_frontend_currency' => 'руб.',
  'ms2_frontend_deliveries' => 'Варианты доставки',
  'ms2_frontend_delivery' => 'Доставка',
  'ms2_frontend_delivery_select' => 'Выберите доставку',
  'ms2_frontend_email' => 'Email',
  'ms2_frontend_entrance' => 'Подъезд',
  'ms2_frontend_favorite' => 'Рекомендуем',
  'ms2_frontend_floor' => 'Этаж',
  'ms2_frontend_index' => 'Почтовый индекс',
  'ms2_frontend_metro' => 'Метро',
  'ms2_frontend_new' => 'Новинка',
  'ms2_frontend_order_cancel' => 'Очистить форму',
  'ms2_frontend_order_cost' => 'Итого, с доставкой',
  'ms2_frontend_order_submit' => 'Сделать заказ!',
  'ms2_frontend_order_success' => 'Спасибо за оформление заказа <b>#[[+num]]</b> на нашем сайте <b>[[++site_name]]</b>!',
  'ms2_frontend_payment' => 'Оплата',
  'ms2_frontend_payment_select' => 'Выберите оплату',
  'ms2_frontend_payments' => 'Способы оплаты',
  'ms2_frontend_phone' => 'Телефон',
  'ms2_frontend_popular' => 'Популярный товар',
  'ms2_frontend_receiver' => 'Получатель',
  'ms2_frontend_region' => 'Область',
  'ms2_frontend_room' => 'Кв.',
  'ms2_frontend_size' => 'Размер',
  'ms2_frontend_sizes' => 'Размеры',
  'ms2_frontend_street' => 'Улица',
  'ms2_frontend_tags' => 'Теги',
  'ms2_frontend_text_address' => 'Адрес одной строкой',
  'ms2_frontend_weight_unit' => 'кг.',
  'ms2_help' => 'Помощь и поддержка',
  'ms2_help_desc' => 'Полезные ссылки и информация',
  'ms2_link' => 'Связь товаров',
  'ms2_links' => 'Связи товаров',
  'ms2_links_intro' => 'Список возможных связей товаров друг с другом. Тип связи характеризует, как именно она будет работать, его нельзя создавать, можно только выбрать из списка.',
  'ms2_menu_desc' => 'Продвинутый интернет-магазин',
  'ms2_message_close_all' => 'закрыть все',
  'ms2_option' => 'Свойство товаров',
  'ms2_option_err_ae' => 'Свойство уже существует',
  'ms2_option_err_invalid_key' => 'Неправильный ключ для свойства',
  'ms2_option_err_nf' => 'Свойство не найдено',
  'ms2_option_err_ns' => 'Свойство не выбрано',
  'ms2_option_err_reserved_key' => 'Такой ключ опции использовать нельзя',
  'ms2_option_err_save' => 'Ошибка сохранения свойства',
  'ms2_option_type' => 'Тип свойства',
  'ms2_options' => 'Свойства товаров',
  'ms2_options_category_intro' => 'Список возможных свойств товаров в данной категории.',
  'ms2_options_intro' => 'Список возможных свойств товаров. Дерево категорий используется для фильтрации свойств выбранных категорий. <br>Чтобы назначить категориям сразу несколько опций, выберите их через Ctrl(Cmd) или Shift.',
  'ms2_order' => 'Заказ',
  'ms2_orders' => 'Заказы',
  'ms2_orders_desc' => 'Управление заказами',
  'ms2_orders_intro' => 'Панель управления заказами. Вы можете выбирать сразу несколько заказов через Shift или Ctrl(Cmd).',
  'ms2_payment' => 'Оплата',
  'ms2_payment_link' => 'Если вы случайно прервали процедуру оплаты, вы всегда можете <a href="[[+link]]" style="color:#348eda;">продолжить её по этой ссылке</a>.',
  'ms2_payments' => 'Способы оплаты',
  'ms2_payments_intro' => 'Вы можете создавать любые способы оплаты заказов. Логика оплаты (отправка покупателя на удалённый сервис, приём оплаты и т.п.) реализуется в классе, который вы укажете. <br>Для методов оплаты параметр "класс" обязателен.',
  'ms2_product' => 'Товар магазина',
  'ms2_product_create' => 'Добавить товар',
  'ms2_product_create_here' => 'Товар магазина',
  'ms2_product_type' => 'Товар магазина',
  'ms2_search' => 'Поиск',
  'ms2_search_clear' => 'Очистить',
  'ms2_settings' => 'Настройки',
  'ms2_settings_desc' => 'Статусы заказов, параметры оплаты и доставки',
  'ms2_settings_intro' => 'Панель управления настройками магазина. Здесь вы можете указать способы оплаты, доставки и статусы заказов.',
  'ms2_statuses' => 'Статусы заказа',
  'ms2_statuses_intro' => 'Существует несколько обязательных статусов заказа: "новый", "оплачен", "отправлен" и "отменён". Их можно настраивать, но нельзя удалять, так как они необходимы для работы магазина. Вы можете указать свои статусы для расширенной логики работы с заказами. <br>Статус может быть окончательным, это значит, что его нельзя переключить на другой, например "отправлен" и "отменён". Статус может быть зафиксирован, то есть, с него нельзя переключаться на более ранние статусы, например "оплачен" нельзя переключить на "новый".',
  'ms2_system_settings' => 'Системные настройки',
  'ms2_system_settings_desc' => 'Системные настройки miniShop2',
  'ms2_type' => 'Тип',
  'ms2_utilities' => 'Утилиты',
  'ms2_utilities_desc' => 'Инструменты разработчика',
  'ms2_vendors' => 'Производители товаров',
  'ms2_vendors_intro' => 'Список возможных производителей товаров. То, что вы сюда добавите, можно выбрать в поле "vendor" товара.',
);