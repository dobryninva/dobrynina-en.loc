<?php
include_once 'setting.inc.php';

$_lang['eshoplogistic3'] = 'Расчёт стоимости и срока доставок';
$_lang['eshoplogistic3_menu_desc'] = 'Через сервис eShopLogistic';

$_lang['eshoplogistic3_info'] = 'Информация';
$_lang['eshoplogistic3_statistics'] = 'Статистика';
$_lang['eshoplogistic3_statistics_intro'] = 'Средние суточные значения за последние 30 дней';
$_lang['eshoplogistic3_info_active'] = 'Ключ / клиент активен';
$_lang['eshoplogistic3_info_balance'] = 'Текущий баланс';
$_lang['eshoplogistic3_info_paid_days_text'] = 'Расчётный срок запаса средств на балансе';
$_lang['eshoplogistic3_info_free_days'] = 'Бесплатные дни';
$_lang['eshoplogistic3_info_services'] = 'Включённые службы доставки';
$_lang['eshoplogistic3_info_cache_size'] = 'Размер кэша';
$_lang['eshoplogistic3_info_cache_size_text'] = '(файлов: {files}, существует {time} ч)';

$_lang['eshoplogistic3_info_data_refresh'] = 'Обновить данные';
$_lang['eshoplogistic3_info_cache_clear'] = 'Очистить кэш';

$_lang['eshoplogistic3_order_status_update'] = 'Обновить данные заказа';
$_lang['eshoplogistic3_order_status_message_success'] = 'Успешно';
$_lang['eshoplogistic3_order_status_errors'] = 'Возникли ошибки';
$_lang['eshoplogistic3_order_status_unload_fail'] = 'Сначала нужно выгрузить заказ';
$_lang['eshoplogistic3_order_status_message_change'] = 'Статус заказа изменился: {old} -> {new}';
$_lang['eshoplogistic3_order_status_message_not_change'] = 'Статус заказа не изменился';

$_lang['eshoplogistic3_loading_message'] = '<span>Получение данных доставки...</span>';
$_lang['eshoplogistic3_warning_message'] = '<p class="text-warning">Выберите вариант доставки</p>';
$_lang['eshoplogistic3_fail_message'] = '<p class="text-warning">Стоимость доставки не рассчитана.<br>Ничего страшного: наш менеджер подберёт оптимальный вариант и согласует с Вами.</p>';
$_lang['eshoplogistic3_settlement_warning_message'] = '<p class="text-warning">Выберите город</p>';
$_lang['eshoplogistic3_need_address_message'] = 'Укажите адрес полностью: улица, дом и квартира';
$_lang['eshoplogistic3_need_pvz_message'] = 'Требуется выбрать пункт самовывоза';

$_lang['eshoplogistic3_data_fail'] = 'Ошибка получения данных';
$_lang['eshoplogistic3_err_statistics'] = 'Запрос client/requests выполнен ошибкой';
$_lang['eshoplogistic3_err_info'] = 'Запрос client/info выполнен с ошибкой. Проверьте настройки компонента.';
$_lang['eshoplogistic3_statistics_tariff'] = 'Тариф';
$_lang['eshoplogistic3_statistics_limit'] = 'Ограничения по тарифу';
$_lang['eshoplogistic3_statistics_sum'] = 'Всего запросов';
$_lang['eshoplogistic3_statistics_widget'] = 'Виджеты';
$_lang['eshoplogistic3_statistics_api'] = 'API';

$_lang['eshoplogistic3_log'] = 'Лог запросов';
$_lang['eshoplogistic3_log_intro'] = 'Включение лога в системных настройках. Лог автоматически очищается при достижении размера в 1Mb.';
$_lang['eshoplogistic3_log_clear'] = 'Очистить лог';

$_lang['eshoplogistic3_order_delivery_tab'] = 'Доставка';
$_lang['eshoplogistic3_order_delivery_info'] = '';
$_lang['eshoplogistic3_order_unload'] = 'Выгрузить в кабинет службы доставки';
$_lang['eshoplogistic3_order_delivery_edit'] = 'Изменить данные доставки';
$_lang['eshoplogistic3_order_delivery_info_price'] = 'Цена';
$_lang['eshoplogistic3_order_delivery_info_base_price'] = 'Базовая цена';
$_lang['eshoplogistic3_order_delivery_info_time'] = 'Срок доставки';
$_lang['eshoplogistic3_order_delivery_info_service'] = 'Служба доставки';
$_lang['eshoplogistic3_order_delivery_info_mode'] = 'Способ доставки';
$_lang['eshoplogistic3_order_delivery_info_pvz'] = 'Пункт самовывоза';
$_lang['eshoplogistic3_order_delivery_order_text'] = 'Заказ в кабинете транспортной компании';
$_lang['eshoplogistic3_order_delivery_order_id'] = 'Идентификатор заказа';
$_lang['eshoplogistic3_order_delivery_order_number'] = 'Номер заказа';
$_lang['eshoplogistic3_order_delivery_order_state'] = 'Описание статуса';
$_lang['eshoplogistic3_order_delivery_order_state_code'] = 'Код статуса';
$_lang['eshoplogistic3_delivery_order_no'] = 'Не выгружен';
$_lang['eshoplogistic3_order_unload_success'] = 'Заказ выгружен';
$_lang['eshoplogistic3_order_unload_fail'] = 'Ошибка выгрузки заказа';
$_lang['eshoplogistic3_order_unload_data'] = 'Идентификатор заказа:<br> <b>{id}</b>,<br> статус:<br> {state}';
$_lang['eshoplogistic3_log_fail'] = 'Не удалось прочитать файл лога';
$_lang['eshoplogistic3_log_download'] = 'Скачать файл лога';
$_lang['eshoplogistic3-delivery-edit'] = 'Изменить параметры доставки';
$_lang['eshoplogistic3_delivery_type'] = 'Тип доставки';
$_lang['eshoplogistic3_payment_type'] = 'Тип оплаты';
$_lang['eshoplogistic3_search'] = 'Населённый пункт';
$_lang['eshoplogistic3_deliveryservice'] = 'Служба доставки';
$_lang['eshoplogistic3_get_delivery_data'] = 'Получить данные';
$_lang['eshoplogistic3_get_delivery_price'] = 'Стоимость доставки';
$_lang['eshoplogistic3_get_delivery_time'] = 'Срок доставки';
$_lang['eshoplogistic3_get_delivery_terminal'] = 'Пункт самовывоза';
$_lang['eshoplogistic3_delivery_type_terminal'] = 'в пункт самовывоза';
$_lang['eshoplogistic3_delivery_type_door'] = 'курьер';
$_lang['eshoplogistic3_err_widget_key'] = 'Не указан ключ виджета.<br> Установите значение для параметра eshoplogistic3_manager_widget_key в системных настройках.';
$_lang['eshoplogistic3_delivery_edit_info'] = 'Для перерасчёта доставки запустите виджет и выбирите нужный вариант';
$_lang['eshoplogistic3_delivery_edit_settlement'] = 'Населённый пункт';
$_lang['eshoplogistic3_delivery_edit_service'] = 'Транспортная компания';
$_lang['eshoplogistic3_delivery_edit_type'] = 'Тип доставки';
$_lang['eshoplogistic3_delivery_edit_price'] = 'Цена';
$_lang['eshoplogistic3_delivery_edit_time'] = 'Срок';
$_lang['eshoplogistic3_delivery_edit_pvz'] = 'Пункт самовывоза';
$_lang['eshoplogistic3_delivery_edit_close'] = 'Закрыть';
$_lang['eshoplogistic3_delivery_edit_success'] = 'Успешное обновление данных доставки';
$_lang['eshoplogistic3_delivery_edit_fail'] = 'Ошибка обновления данных доставки';
$_lang['eshoplogistic3_delivery_edit_success_message'] = 'Данные заказа обновлены';
$_lang['eshoplogistic3_delivery_edit_fail_message'] = 'Произошла ошибка обновления данных заказа<br> Подробнее смотрите системный лог';
$_lang['eshoplogistic3_delivery_edit_data_error'] = 'Сначала необходимо получить данные доставки через виджет';
$_lang['eshoplogistic3_delivery_edit_field_error'] = 'Не заполнено поле «{field}»';
$_lang['eshoplogistic3_order_print'] = 'Печатная форма';
$_lang['eshoplogistic3_order_print_success'] = 'Успешно';
$_lang['eshoplogistic3_order_delivery_order_cost'] = 'Факт. стоимость';
$_lang['eshoplogistic3_order_delivery_order_tracking'] = 'Ссылка на отслеживание';

$_lang['eshoplogistic3_delivery_unload'] = 'Выгрузка заказа на доставку';
$_lang['eshoplogistic3_delivery_success'] = 'Успешная выгрузка заказа на доставку';
$_lang['eshoplogistic3_delivery_fail'] = 'Ошибка выгрузки заказа на доставку';
$_lang['eshoplogistic3_delivery_unload_common'] = 'Общее';
$_lang['eshoplogistic3_delivery_unload_receiver'] = 'Отправитель / Получатель';
$_lang['eshoplogistic3_delivery_unload_places'] = 'Места';
$_lang['eshoplogistic3_delivery_unload_additional'] = 'Дополнительные услуги';
$_lang['eshoplogistic3_delivery_unload_button_text'] = 'Выгрузить';
$_lang['eshoplogistic3_delivery_unload_confirm_title'] = 'Подтвердите выгрузку';
$_lang['eshoplogistic3_delivery_unload_confirm_text'] = 'Действительно выгрузить заказ в кабинет службы доставки?';
$_lang['eshoplogistic3_upload_common_comment'] = 'Комментарий';
$_lang['eshoplogistic3_unload_place_create'] = 'Добавить место';
$_lang['eshoplogistic3_unload_place_update'] = 'Изменить место';
$_lang['eshoplogistic3_place_update'] = 'Обновить данные места';
$_lang['eshoplogistic3_place_remove'] = 'Удалить место';
$_lang['eshoplogistic3_place_remove_confirm'] = 'Действительно удалить место?';
$_lang['eshoplogistic3_places_remove_confirm'] = 'Действительно удалить места?';
$_lang['eshoplogistic3_places_remove'] = 'Удалить выбранные места';
$_lang['eshoplogistic3_unload_place_article'] = 'Артикул';
$_lang['eshoplogistic3_unload_place_name'] = 'Наименование';
$_lang['eshoplogistic3_unload_place_count'] = 'Количество';
$_lang['eshoplogistic3_unload_place_price'] = 'Цена';
$_lang['eshoplogistic3_unload_place_weight'] = 'Вес, кг';
$_lang['eshoplogistic3_unload_place_length'] = 'Длина, см';
$_lang['eshoplogistic3_unload_place_width'] = 'Ширина, см';
$_lang['eshoplogistic3_unload_place_height'] = 'Высота, см';
$_lang['eshoplogistic3_unload_place_actions'] = 'Действия';
$_lang['eshoplogistic3_place_err_ae'] = 'Требуется указать';
$_lang['eshoplogistic3_unload_price'] = 'Стоимость доставки';
$_lang['eshoplogistic3_unload_terminal_code'] = 'Код ПВЗ';
$_lang['eshoplogistic3_unload_terminal_address'] = 'Адрес ПВЗ';
$_lang['eshoplogistic3_unload_payment-type'] = 'Способ оплаты заказа';
$_lang['eshoplogistic3_payment_already_paid'] = 'Заказ уже оплачен';
$_lang['eshoplogistic3_payment_cash_on_receipt'] = 'Наличными при получении';
$_lang['eshoplogistic3_payment_card_on_receipt'] = 'Картой при получении';
$_lang['eshoplogistic3_payment_cashless'] = 'Безналичный расчет';
$_lang['eshoplogistic3_unload_tariff'] = 'Тариф доставки';
$_lang['eshoplogistic3_unload_additional_create'] = 'Добавить';
$_lang['eshoplogistic3_unload_additional_update'] = 'Обновить';
$_lang['eshoplogistic3_unload_additional_type'] = 'Тип';
$_lang['eshoplogistic3_unload_additional_code'] = 'Код';
$_lang['eshoplogistic3_unload_additional_name'] = 'Наименование';
$_lang['eshoplogistic3_unload_additional_count'] = 'Количество';
$_lang['eshoplogistic3_additionals_remove'] = 'Удалить выбранные';
$_lang['eshoplogistic3_additional_remove'] = 'Удалить';
$_lang['eshoplogistic3_additionals_remove_confirm'] = 'Действительно удалить выбранные?';
$_lang['eshoplogistic3_additional_remove_confirm'] = 'Действительно удалить?';
$_lang['eshoplogistic3_additional_type_packages'] = 'Упаковка';
$_lang['eshoplogistic3_additional_type_cargo'] = 'Доставки';
$_lang['eshoplogistic3_additional_type_recipient'] = 'Получатель';
$_lang['eshoplogistic3_additional_type_other'] = 'Другое';
$_lang['eshoplogistic3_additional_update'] = 'Изменить';

$_lang['eshoplogistic3_unload_receiver_text'] = 'Данные получателя';
$_lang['eshoplogistic3_unload_sender_text'] = 'Данные отправителя';
$_lang['eshoplogistic3_unload_receiver_address_text'] = 'Адрес получателя (при доставке курьером)';
$_lang['eshoplogistic3_unload_pick_up'] = 'Способ доставки до терминала транспортной компании';
$_lang['eshoplogistic3_unload_pick_up_yes'] = 'Груз заберёт транспортная компания';
$_lang['eshoplogistic3_unload_pick_up_no'] = 'Сами привезём на терминал транспортной компании';
$_lang['eshoplogistic3_name'] = 'Имя';
$_lang['eshoplogistic3_email'] = 'E-mail';
$_lang['eshoplogistic3_phone'] = 'Телефон';
$_lang['eshoplogistic3_region'] = 'Регион';
$_lang['eshoplogistic3_city'] = 'Населённый пункт';
$_lang['eshoplogistic3_street'] = 'Улица';
$_lang['eshoplogistic3_house'] = 'Здание';
$_lang['eshoplogistic3_index'] = 'Индекс';
$_lang['eshoplogistic3_room'] = 'Квартира / офис';
$_lang['eshoplogistic3_unload_pick_up_terminal_text'] = 'Терминал транспортной компании';
$_lang['eshoplogistic3_unload_pick_up_terminal'] = 'Код терминала';

$_lang['eshoplogistic3_unload_error_order_id'] = 'Не определён заказ';
$_lang['eshoplogistic3_unload_error_places'] = 'Не определены места';
$_lang['eshoplogistic3_unload_error_key'] = 'В системный настройках не указан ключ API eShopLogistic';
$_lang['eshoplogistic3_unload_error_service'] = 'Не определён код службы доставки';
$_lang['eshoplogistic3_unload_error_sender_company'] = 'В системный настройках не указано название компании';
$_lang['eshoplogistic3_unload_error_sender_name'] = 'В системный настройках не указано имя контакта';
$_lang['eshoplogistic3_unload_error_sender_email'] = 'В системный настройках не указан E-mail контакта';
$_lang['eshoplogistic3_unload_error_sender_phone'] = 'В системный настройках не указан телефон контакта';
$_lang['eshoplogistic3_unload_error_receiver_name'] = 'Не указано имя получателя';
$_lang['eshoplogistic3_unload_error_receiver_email'] = 'Не указан email получателя';
$_lang['eshoplogistic3_unload_error_receiver_phone'] = 'Не указан телефон получателя';
$_lang['eshoplogistic3_unload_error_place'] = 'Проверьте параметры мест: требуется указать артикул, вес и габариты';
$_lang['eshoplogistic3_unload_error_type'] = 'Не указан тип доставки';
$_lang['eshoplogistic3_unload_error_payment'] = 'Не указан тип оплаты';
$_lang['eshoplogistic3_unload_error_cost'] = 'Не указана стоимость доставки';
$_lang['eshoplogistic3_unload_errors_title'] = 'Допущены ошибки';
$_lang['eshoplogistic3_unload_disabled'] = 'Выгрузка заказов запрещена в системных настройках';

$_lang['eshoplogistic3_boxberry_order_type'] = 'Тип заказа';
$_lang['eshoplogistic3_boxberry_boxberry_packing_type'] = 'Тип упаковки';
$_lang['eshoplogistic3_boxberry_order_type_0'] = 'Посылка';
$_lang['eshoplogistic3_boxberry_order_type_2'] = 'Курьер Онлайн';
$_lang['eshoplogistic3_boxberry_order_type_3'] = 'Посылка Онлайн';
$_lang['eshoplogistic3_boxberry_order_type_5'] = 'Посылка 1й класс';
$_lang['eshoplogistic3_boxberry_packing_type_1'] = 'Упаковка магазина';
$_lang['eshoplogistic3_boxberry_packing_type_2'] = 'Упаковка Boxberry';

$_lang['eshoplogistic3_delline_produce_date'] = 'Дата отправки';
$_lang['eshoplogistic3_delline_counterparty'] = 'Заказчик перевозки';
$_lang['eshoplogistic3_delline_contact'] = 'Отправитель';

$_lang['eshoplogistic3_no_delivery_to_location'] = 'В указанный населённый пункт нет вариантов доставки';

$_lang['eshoplogistic3_receiver_kit_legal'] = 'Орг. форма контрагента получателя';
$_lang['eshoplogistic3_receiver_kit_company'] = 'Название организации получателя';
$_lang['eshoplogistic3_receiver_kit_requisites_unp'] = 'УПН получателя';
$_lang['eshoplogistic3_receiver_kit_requisites_bin'] = 'БИН получателя';
$_lang['eshoplogistic3_receiver_kit_requisites_inn'] = 'ИНН получателя';
$_lang['eshoplogistic3_receiver_kit_requisites_kpp'] = 'КПП получателя';
$_lang['eshoplogistic3_receiver_baikal_legal'] = 'Орг. форма контрагента получателя';
$_lang['eshoplogistic3_receiver_baikal_identity_type'] = 'Тип документа получателя';
$_lang['eshoplogistic3_receiver_baikal_identity_series'] = 'Серия документа получателя';
$_lang['eshoplogistic3_receiver_baikal_identity_number'] = 'Номер документа получателя';
$_lang['eshoplogistic3_receiver_baikal_requisites_inn'] = 'ИНН получателя';
$_lang['eshoplogistic3_receiver_baikal_requisites_kpp'] = 'КПП получателя';