<?php

$_lang['area_eshoplogistic3_main'] = 'Основные';
$_lang['area_eshoplogistic3_cart'] = 'Оформление заказа в корзине';
$_lang['area_eshoplogistic3_widgets'] = 'Виджеты на страницах';
$_lang['area_eshoplogistic3_order_unload'] = 'Выгрузка заказов (общие)';
$_lang['area_eshoplogistic3_order_automatic_unload'] = 'Выгрузка заказов (автовыгрузка)';
$_lang['area_eshoplogistic3_order_unload_sdek'] = 'Выгрузка заказов (СДЭК)';
$_lang['area_eshoplogistic3_order_unload_yandex'] = 'Выгрузка заказов (Яндекс Доставка)';
$_lang['area_eshoplogistic3_order_unload_boxberry'] = 'Выгрузка заказов (Boxberry)';
$_lang['area_eshoplogistic3_order_update_data'] = 'Обновление данных выгруженных заказов';
$_lang['area_eshoplogistic3_order_unload_delline'] = 'Выгрузка заказов (Деловые линии)';
$_lang['area_eshoplogistic3_order_unload_pecom'] = 'Выгрузка заказов (ПЭК)';
$_lang['area_eshoplogistic3_order_unload_baikal'] = 'Выгрузка заказов (Байкал)';
$_lang['area_eshoplogistic3_order_unload_kit'] = 'Выгрузка заказов (Кит)';

$_lang['setting_eshoplogistic3_order_update_data'] = 'Разрешить автоматическое обновление данных выгруженных заказов';
$_lang['setting_eshoplogistic3_order_update_data_desc'] = 'Установите «Да» и настройте cron-задачу для запуска скрипта core/componemts/eshoplogistic3/cron/run.php';

$_lang['setting_eshoplogistic3_order_update_data_statuses'] = 'Статусы заказов для обновления';
$_lang['setting_eshoplogistic3_order_update_data_statuses_desc'] = 'Укажите, какие статусы заказа, для которых следует обновлять данные. Через запятую, например: 1,2,3.';

$_lang['setting_eshoplogistic3_widgets_source'] = 'Источник загрузки виджетов';
$_lang['setting_eshoplogistic3_widgets_source_desc'] = 'URL для подключения виджетов';

$_lang['setting_eshoplogistic3_api_url'] = 'URL API eShopLogistic';
$_lang['setting_eshoplogistic3_api_url_desc'] = '';

$_lang['setting_eshoplogistic3_api_key'] = 'Ключ API eShopLogistic';
$_lang['setting_eshoplogistic3_api_key_desc'] = 'Ключ API, который вы создали в личном кабинете сервиса <a href="https://eshoplogistic.ru" target="_blank">eshoplogistic.ru</a>.';

$_lang['setting_eshoplogistic3_frontend_css'] = 'СSS-файл для фронта';
$_lang['setting_eshoplogistic3_frontend_css_desc'] = 'Можно указать тут свой файл или перенести стили в свой css-файл и очистить поле.';

$_lang['setting_eshoplogistic3_frontend_js'] = 'JS-файл для фронта';
$_lang['setting_eshoplogistic3_frontend_js_desc'] = 'Можно указать тут свой скрипт или перенести логику в свой js-файл и очистить поле.';

$_lang['setting_eshoplogistic3_allow_unloading_orders'] = 'Разрешить выгрузку заказов';
$_lang['setting_eshoplogistic3_allow_unloading_orders_desc'] = 'Включить выгрузку заказов в кабинет службы оставки.';

$_lang['setting_eshoplogistic3_chunk_info']= 'Чанк для вывода информации в корзине';
$_lang['setting_eshoplogistic3_chunk_info_desc'] = '';

$_lang['setting_eshoplogistic3_weight_unit'] = 'Единица измерения веса';
$_lang['setting_eshoplogistic3_weight_unit_desc'] = 'Выберите, в каких единицах измерения указан вес товаров';

$_lang['setting_eshoplogistic3_min_weight'] = 'Минимальный вес единицы товара, кг';
$_lang['setting_eshoplogistic3_min_weight_desc'] = 'Используется в случае отсутствия веса у товара. Указывать в кг, например 0.01 = 100гр.';

$_lang['setting_eshoplogistic3_default_delivery_id'] = 'Способ доставки по-умолчанию';
$_lang['setting_eshoplogistic3_default_delivery_id_desc'] = 'Идентификатор способа доставки MS2, если не получено ни одного результата по другим вариантам.';

$_lang['setting_eshoplogistic3_widget_key'] = 'Ключ виджета';
$_lang['setting_eshoplogistic3_widget_key_desc'] = 'Ключ виджета, который используется в корзине';

$_lang['setting_eshoplogistic3_cache_time'] = 'Время жизни кэша, часы';
$_lang['setting_eshoplogistic3_cache_time_desc'] = 'Срок кэширования ответов сервиса расчёта доставки. Снижает количество запросов и уменьшает время расчёта. 
Оптимально - 24 часа. Слишком большой срок увеличивает требуемое место на диске и снижает точность данных.';

$_lang['setting_eshoplogistic3_payment_on'] = 'Учитывать способ оплаты';
$_lang['setting_eshoplogistic3_payment_on_desc'] = 'Укажите «Да», если при расчёте стоимости доставки в корректирующих правилах у вас учитывается способ оплаты.';

$_lang['setting_eshoplogistic3_payment_card'] = 'Методы оплаты MS2, ассоциируемые с типом «Оплата картой»';
$_lang['setting_eshoplogistic3_payment_card_desc'] = 'Указать идентификаторы методов оплаты MS2, через запятую. Например: 2,3,4';

$_lang['setting_eshoplogistic3_payment_cash'] = 'Методы оплаты MS2, ассоциируемые с типом «Оплата наличными»';
$_lang['setting_eshoplogistic3_payment_cash_desc'] = 'Указать идентификаторы методов оплаты MS2, через запятую. Например: 2,3,4';

$_lang['setting_eshoplogistic3_payment_cashless'] = 'Методы оплаты MS2, ассоциируемые с типом «Безналичный расчёт»';
$_lang['setting_eshoplogistic3_payment_cashless_desc'] = 'Указать идентификаторы методов оплаты MS2, через запятую. Например: 2,3,4';

$_lang['setting_eshoplogistic3_payment_prepay'] = 'Методы оплаты MS2, ассоциируемые с типом «Предоплата»';
$_lang['setting_eshoplogistic3_payment_prepay_desc'] = 'Указать идентификаторы методов оплаты MS2, через запятую. Например: 2,3,4';

$_lang['setting_eshoplogistic3_payment_upon_receipt'] = 'Методы оплаты MS2, ассоциируемые с типом «Оплата при получении»';
$_lang['setting_eshoplogistic3_payment_upon_receipt_desc'] = 'Указать идентификаторы методов оплаты MS2, через запятую. Например: 2,3,4';

$_lang['setting_eshoplogistic3_widget_secrets'] = 'Секретные коды виджетов';
$_lang['setting_eshoplogistic3_widget_secrets_desc'] = 'Указать секретные коды виджетов, которые используются для отправки заказа, через запятую.';

$_lang['setting_eshoplogistic3_order_prefix'] = 'Префикс номера заказа';
$_lang['setting_eshoplogistic3_order_prefix_desc'] = 'Для того, чтобы выделить заказы, полученные из виджетов, можно указать какой-нибудь префикс, например «ESL-»';

$_lang['setting_eshoplogistic3_message_order_success'] = 'Сообщение при успешном создании заказа';
$_lang['setting_eshoplogistic3_message_order_success_desc'] = 'Выводится в виджете в случае успешного создания заказа.';

$_lang['setting_eshoplogistic3_message_order_fail'] = 'Сообщение при ошибке создания заказа';
$_lang['setting_eshoplogistic3_message_order_fail_desc'] = 'Выводится в виджете в случае ошибки.';

$_lang['setting_eshoplogistic3_query_log'] = 'Сохранять лог запросов к eShopLogistic';
$_lang['setting_eshoplogistic3_query_log_desc'] = 'Используйте для отладки. Файл лога хранится тут: core/componemts/eshoplogistic3/log.txt';

$_lang['setting_eshoplogistic3_log_mode'] = 'Режим записи лога';
$_lang['setting_eshoplogistic3_log_mode_desc'] = 'Варианты: 0 - запись всех запросов, 1 - только запросы на расчёт стоимости доставки, 2 - запросы на расчёт стоимости, без пунктов самовывоза';

$_lang['setting_eshoplogistic3_query_log_mode'] = 'Режим записи лога';
$_lang['setting_eshoplogistic3_query_log_mode_desc'] = '0 - запись всех запросов, 1 - только запросы на расчёт стоимости доставки, 2 запросы на расчёт стоимости, без пунктов самовывоза (их может быть очень много)';

$_lang['setting_eshoplogistic3_controller'] = 'Путь к внутреннему контроллеру виджета';
$_lang['setting_eshoplogistic3_controller_desc'] = 'Укажите, если хотите пропускать запросы через кастомный контроллер (например, для ведения логов или отладки). Если пусто, запросы пойдут напрямую к api eShopLogistic.';

$_lang['setting_eshoplogistic3_manager_widget_key'] = 'Ключ виджета для редактирования в окне заказа Minishop2';
$_lang['setting_eshoplogistic3_manager_widget_key_desc'] = 'Для изменения параметров доставки при редактировании заказа, укажите ключ виджета';

$_lang['setting_eshoplogistic3_take_places_from_order'] = 'Определять места по позициям заказа';
$_lang['setting_eshoplogistic3_take_places_from_order_desc'] = 'Места для выгрузки заказа в кабинет службы доставки автоматически будут сфомированы из позиций заказа';

$_lang['setting_eshoplogistic3_place_vat_rate'] = 'Значение ставки НДС';
$_lang['setting_eshoplogistic3_place_vat_rate_desc'] = 'Возможные варианты: 0, 10, 20, -1 (без НДС)';

$_lang['setting_eshoplogistic3_sender_company'] = 'Название компании';
$_lang['setting_eshoplogistic3_sender_company_desc'] = 'Для подстановки в поля выгрузки заказа';
$_lang['setting_eshoplogistic3_sender_name'] = 'Имя контактного лица';
$_lang['setting_eshoplogistic3_sender_name_desc'] = 'Для подстановки в поля выгрузки заказа';
$_lang['setting_eshoplogistic3_sender_email'] = 'E-mail контактного лица';
$_lang['setting_eshoplogistic3_sender_email_desc'] = 'Для подстановки в поля выгрузки заказа';
$_lang['setting_eshoplogistic3_sender_phone'] = 'Телефон контактного лица';
$_lang['setting_eshoplogistic3_sender_phone_desc'] = 'Для подстановки в поля выгрузки заказа';
$_lang['setting_eshoplogistic3_sender_index'] = 'Индекс отправителя';
$_lang['setting_eshoplogistic3_sender_index_desc'] = 'Для подстановки в поля выгрузки заказа';

$_lang['setting_eshoplogistic3_sender_region'] = 'Регион';
$_lang['setting_eshoplogistic3_sender_region_desc'] = 'Для подстановки в поля выгрузки заказа в случае забора груза от отправителя';
$_lang['setting_eshoplogistic3_sender_city'] = 'Населённый пункт';
$_lang['setting_eshoplogistic3_sender_city_desc'] = 'Для подстановки в поля выгрузки заказа в случае забора груза от отправителя';
$_lang['setting_eshoplogistic3_sender_street'] = 'Улица';
$_lang['setting_eshoplogistic3_sender_street_desc'] = 'Для подстановки в поля выгрузки заказа в случае забора груза от отправителя';
$_lang['setting_eshoplogistic3_sender_house'] = 'Строение';
$_lang['setting_eshoplogistic3_sender_house_desc'] = 'Для подстановки в поля выгрузки заказа в случае забора груза от отправителя';
$_lang['setting_eshoplogistic3_sender_room'] = 'Помещение';
$_lang['setting_eshoplogistic3_sender_room_desc'] = 'Для подстановки в поля выгрузки заказа в случае забора груза от отправителя';

$_lang['setting_eshoplogistic3_sdek_pick_up'] = 'Самопривоз на терминал СДЭКа';
$_lang['setting_eshoplogistic3_sdek_pick_up_desc'] = 'Выберите «Да», если привозите грузы на терминал самостоятельно';
$_lang['setting_eshoplogistic3_sdek_order_type'] = 'Тип заказа';
$_lang['setting_eshoplogistic3_sdek_order_type_desc'] = '«1» - интернет-магазин, «2» - обычная доставка';
$_lang['setting_eshoplogistic3_sdek_pick_up_terminal'] = 'Код терминала приёма грузов';
$_lang['setting_eshoplogistic3_sdek_pick_up_terminal_desc'] = 'Код терминала СДЭК, в случае доставки своими силами до терминала для дальнейшей отправки покупателю';
$_lang['setting_eshoplogistic3_sdek_order_print_format'] = 'Формат печати этикеток';
$_lang['setting_eshoplogistic3_sdek_order_print_format_desc'] = 'Доступные значения: A4, A5, A6; по умолчанию A4';

$_lang['setting_eshoplogistic3_yandex_pick_up'] = 'Самопривоз на терминал Яндекс Доставки';
$_lang['setting_eshoplogistic3_yandex_pick_up_desc'] = 'Выберите «Да», если привозите грузы на терминал самостоятельно';
$_lang['setting_eshoplogistic3_yandex_pick_up_terminal'] = 'Код терминала приёма грузов';
$_lang['setting_eshoplogistic3_yandex_pick_up_terminal_desc'] = 'Код терминала Яндекс, в случае доставки своими силами до терминала для дальнейшей отправки покупателю';

$_lang['setting_eshoplogistic3_boxberry_pick_up'] = 'Самопривоз на терминал Boxberry';
$_lang['setting_eshoplogistic3_boxberry_pick_up_desc'] = 'Выберите «Да», если привозите грузы на терминал самостоятельно';
$_lang['setting_eshoplogistic3_boxberry_pick_up_terminal'] = 'Код терминала приёма грузов';
$_lang['setting_eshoplogistic3_boxberry_pick_up_terminal_desc'] = 'Код терминала Boxberry, в случае доставки своими силами до терминала для дальнейшей отправки покупателю';
$_lang['setting_eshoplogistic3_boxberry_order_type'] = 'Тип заказа по умолчанию';
$_lang['setting_eshoplogistic3_boxberry_order_type_desc'] = '0 - Посылка, 2 - Курьер Онлайн, 3 - Посылка Онлайн, 5 - Посылка 1й класс';
$_lang['setting_eshoplogistic3_boxberry_order_packing_type'] = 'Тип упаковки';
$_lang['setting_eshoplogistic3_boxberry_order_packing_type_desc'] = '1 - упаковка магазина, 2 - упаковка Boxberry';

$_lang['setting_eshoplogistic3_allow_automatic_unloading_orders'] = 'Разрешить автоматическую выгрузку заказов';
$_lang['setting_eshoplogistic3_allow_automatic_unloading_orders_desc'] = 'Включить автоматическую выгрузку заказов в кабинет службы оставки';
$_lang['setting_eshoplogistic3_unloading_order_start_status'] = 'Статус заказа для начала автоматической выгрузки';
$_lang['setting_eshoplogistic3_unloading_order_start_status_desc'] = 'Укажите идентификатор статуса заказа при переходе на который будет выполнена попытка выгрузки заказа в кабинет службы оставки';
$_lang['setting_eshoplogistic3_unloading_order_end_status'] = 'Статус заказа после успешной автоматической выгрузки заказа';
$_lang['setting_eshoplogistic3_unloading_order_end_status_desc'] = 'Укажите идентификатор статуса заказа при успешной выгрузке в кабинет службы оставки';
$_lang['setting_eshoplogistic3_order_default_weight'] = 'Вес товаров в заказе по умолчанию (кг)';
$_lang['setting_eshoplogistic3_order_default_weight_desc'] = 'Укажите стандартный вес товаров в заказе; если не указан, будет взято стандартное значение веса товара';
$_lang['setting_eshoplogistic3_order_default_dimensions'] = 'Габариты товаров в заказе по умолчанию (Д*Ш*В, см)';
$_lang['setting_eshoplogistic3_order_default_dimensions_desc'] = 'Укажите стандартные габариты товаров в заказе в формате «Д*Ш*В» в сантиметрах';
$_lang['setting_eshoplogistic3_order_apply_everyone'] = 'Применять дефолтные параметры к каждой единице товара';
$_lang['setting_eshoplogistic3_order_apply_everyone_desc'] = 'Если «Да», то указанные значения веса и габаритов по умолчанию учитываются для каждой единицы товара;
 иначе - для всего заказа. При этом весь заказ будет сформирован из одного товара с именем, указанным в параметре «Название товара в заказе»; параметр «Определять места по позициям заказа» - не учитывается';
$_lang['setting_eshoplogistic3_order_product_common_name'] = 'Название товара в заказе';
$_lang['setting_eshoplogistic3_order_product_common_name_desc'] = 'Если параметр «Применять дефолтные параметры к каждой единице товара» = Нет, то вместо товаров в заказе будет указан 1 шту с данным названием';
$_lang['setting_eshoplogistic3_delivery_pick_up'] = 'Забор груза от отправителя';
$_lang['setting_eshoplogistic3_delivery_pick_up_desc'] = '';
$_lang['setting_eshoplogistic3_order_payment_already_paid'] = 'Идентификатор оплаты «Заказ уже оплачен»';
$_lang['setting_eshoplogistic3_order_payment_already_paid_desc'] = 'Идентификатор статуса оплаты для варианта «Заказ уже оплачен»';
$_lang['setting_eshoplogistic3_order_payment_cash_on_receipt'] = 'Идентификатор оплаты «Наличными при получении»';
$_lang['setting_eshoplogistic3_order_payment_cash_on_receipt_desc'] = 'Идентификатор статуса оплаты для варианта «Наличными при получении»';
$_lang['setting_eshoplogistic3_order_payment_card_on_receipt'] = 'Идентификатор оплаты «Картой при получении»';
$_lang['setting_eshoplogistic3_order_payment_card_on_receipt_desc'] = 'Идентификатор статуса оплаты для варианта «Картой при получении»';

$_lang['setting_eshoplogistic3_delline_sender_requester'] = 'Заказчик перевозки';
$_lang['setting_eshoplogistic3_delline_sender_requester_desc'] = 'Значение UID контрагента из списка контрагентов в личном кабинете на сайте ДЛ';
$_lang['setting_eshoplogistic3_delline_sender_counterparty'] = 'Отправитель';
$_lang['setting_eshoplogistic3_delline_sender_counterparty_desc'] = 'Значение ID контрагента из адресной книги в личном кабинете на сайте ДЛ';
$_lang['setting_eshoplogistic3_delline_pick_up_terminal'] = 'Код терминала приёма грузов';
$_lang['setting_eshoplogistic3_delline_pick_up_terminal_desc'] = 'Код терминала Деловые Линии, в случае доставки своими силами до терминала для дальнейшей отправки покупателю';

$_lang['setting_eshoplogistic3_pecom_sender_identity_type'] = 'Документ отправителя, тип';
$_lang['setting_eshoplogistic3_pecom_sender_identity_type_desc'] = 'Варианты: 1 (ПАСПОРТ ИНОСТР.ГРАЖД.), 2 (РАЗРЕШ. НА ВРЕМ. ПРОЖИВ.), 3 (ВОД. УДОСТ.), 4 (ВИД НА ЖИТ.), 5 (ЗАГР. ПАСП.), 6 (УДОСТ. БЕЖ.)б 7 (ВРЕМ. УДОСТ. ЛИЧ. ГРАЖД. РФ), 8 (СВИД. О ПРЕД. ВРЕМ. УБЕЖ. РФ), 9 (ПАСП. МОРЯКА), 10 (ПАСП. ГРАЖД. РФ), 11 (СВИД. О РАССМ. О ПРИЗН. БЕЖ.), 12 (ВОЕН. БИЛ.)';
$_lang['setting_eshoplogistic3_pecom_sender_identity_series'] = 'Документ отправителя, серия';
$_lang['setting_eshoplogistic3_pecom_sender_identity_series_desc'] = '';
$_lang['setting_eshoplogistic3_pecom_sender_identity_number'] = 'Документ отправителя, номер';
$_lang['setting_eshoplogistic3_pecom_sender_identity_number_desc'] = '';
$_lang['setting_eshoplogistic3_pecom_sender_identity_date'] = 'Документ отправителя, дата выдачи';
$_lang['setting_eshoplogistic3_pecom_sender_identity_date_desc'] = '';
$_lang['setting_eshoplogistic3_pecom_pick_up_terminal'] = 'Код терминала приёма грузов';
$_lang['setting_eshoplogistic3_pecom_pick_up_terminal_desc'] = 'Код терминала ПЭК, в случае доставки своими силами до терминала для дальнейшей отправки покупателю';

$_lang['setting_eshoplogistic3_baikal_sender_legal'] = 'Форма контрагента';
$_lang['setting_eshoplogistic3_baikal_sender_legal_desc'] = '1 - юридическое лицо, 2 - физическое лицо';
$_lang['setting_eshoplogistic3_baikal_sender_identity_type'] = 'Тип организационно-правовой формы';
$_lang['setting_eshoplogistic3_baikal_sender_identity_type_desc'] = 'Варианты: 1 -физическое лицо, 5 - ООО, 9 - ИП, 12 - АО';
$_lang['setting_eshoplogistic3_baikal_sender_identity_series'] = 'Документ отправителя, серия';
$_lang['setting_eshoplogistic3_baikal_sender_identity_series_desc'] = 'Серия документа для физического лица';
$_lang['setting_eshoplogistic3_baikal_sender_identity_number'] = 'Документ отправителя, номер';
$_lang['setting_eshoplogistic3_baikal_sender_identity_number_desc'] = 'Номер документа для физического лица';
$_lang['setting_eshoplogistic3_baikal_sender_requisites_inn'] = 'ИНН отправителя';
$_lang['setting_eshoplogistic3_baikal_sender_requisites_inn_desc'] = 'Для юридического лица';
$_lang['setting_eshoplogistic3_baikal_sender_requisites_kpp'] = 'КПП отправителя';
$_lang['setting_eshoplogistic3_baikal_sender_requisites_kpp_desc'] = 'Для юридического лица';
$_lang['setting_eshoplogistic3_baikal_pick_up_terminal'] = 'Код терминала приёма грузов';
$_lang['setting_eshoplogistic3_baikal_pick_up_terminal_desc'] = 'Код терминала Байкал, в случае доставки своими силами до терминала для дальнейшей отправки покупателю';

$_lang['setting_eshoplogistic3_kit_sender_requester'] = 'Название профиля отправителя';
$_lang['setting_eshoplogistic3_kit_sender_requester_desc'] = 'Доступен в личном кабинете Кит, в разделе «Профили»';

