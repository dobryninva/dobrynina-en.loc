<?php

$_lang['area_eshoplogistic3_main'] = 'Main';
$_lang['area_eshoplogistic3_cart'] = 'Checkout in the shopping cart';
$_lang['area_eshoplogistic3_widgets'] = 'Widgets on pages';
$_lang['area_eshoplogistic3_order_unload'] = 'Unloading orders (common)';
$_lang['area_eshoplogistic3_order_unload_sdek'] = 'Unloading orders (СДЭК)';
$_lang['area_eshoplogistic3_order_unload_yandex'] = 'Unloading orders (Яндекс)';
$_lang['area_eshoplogistic3_order_unload_boxberry'] = 'Unloading orders (Boxberry)';
$_lang['area_eshoplogistic3_order_update_data'] = 'Updating data of uploaded orders';

$_lang['setting_eshoplogistic3_order_update_data'] = 'Allow update of uploaded order data';
$_lang['setting_eshoplogistic3_order_update_data_desc'] = 'Set to "Yes" and set up a cron task to run the script core/componemts/eshoplogistic3/cron/run.php';

$_lang['setting_eshoplogistic3_order_update_data_statuses'] = 'Order statuses to update';
$_lang['setting_eshoplogistic3_order_update_data_statuses_desc'] = 'Specify which order statuses for which data should be updated. Comma separated.';

$_lang['setting_eshoplogistic3_widgets_source'] = 'URL for connecting widgets';
$_lang['setting_eshoplogistic3_widgets_source_desc'] = '';

$_lang['setting_eshoplogistic3_api_url'] = 'URL API eShopLogistic';
$_lang['setting_eshoplogistic3_api_url_desc'] = '';

$_lang['setting_eshoplogistic3_api_key'] = 'Key API eShopLogistic';
$_lang['setting_eshoplogistic3_api_key_desc'] = 'The API key that you created in your personal account of the service <a href="https://eshoplogistic.ru" target="_blank">eshoplogistic.ru</a>.';

$_lang['setting_eshoplogistic3_frontend_css'] = 'СSS-file for front';
$_lang['setting_eshoplogistic3_frontend_css_desc'] = 'You can specify your file here or transfer the styles to your css file and clear the field.';

$_lang['setting_eshoplogistic3_frontend_js'] = 'JS-file for front';
$_lang['setting_eshoplogistic3_frontend_js_desc'] = 'You can specify your file here or transfer the styles to your js file and clear the field.';

$_lang['setting_eshoplogistic3_chunk_info']= 'Chunk for displaying information in the cart';
$_lang['setting_eshoplogistic3_chunk_info_desc'] = '';

$_lang['setting_eshoplogistic3_weight_unit'] = 'Weight unit';
$_lang['setting_eshoplogistic3_weight_unit_desc'] = 'Choose the units of measurement for the weight of the goods';

$_lang['setting_eshoplogistic3_min_weight'] = 'Minimum unit weight, kg';
$_lang['setting_eshoplogistic3_min_weight_desc'] = 'Used when the item has no weight. Indicate in kg, for example 0.01 = 100g.';

$_lang['setting_eshoplogistic3_allow_unloading_orders'] = 'Allow unloading orders';
$_lang['setting_eshoplogistic3_allow_unloading_orders_desc'] = 'Enable unloading orders in the delivery service account.';

$_lang['setting_eshoplogistic3_default_delivery_id'] = 'Default shipping method';
$_lang['setting_eshoplogistic3_default_delivery_id_desc'] = 'Delivery method ID MS2 if no results were received for other options.';

$_lang['setting_eshoplogistic3_widget_key'] = 'Widget Key';
$_lang['setting_eshoplogistic3_widget_key_desc'] = 'The widget key that is used in the cart';

$_lang['setting_eshoplogistic3_cache_time'] = 'Cache lifetime';
$_lang['setting_eshoplogistic3_cache_time_desc'] = 'Caching time for delivery calculation service responses. Reduces the number of requests and reduces the calculation time.
Optimal - 24 hours. Too long increases the required disk space and reduces the accuracy of the data.';

$_lang['setting_eshoplogistic3_payment_on'] = 'Consider payment method';
$_lang['setting_eshoplogistic3_payment_on_desc'] = 'Specify "Yes" if your payment method is taken into account when calculating the shipping cost in the corrective rules.';

$_lang['setting_eshoplogistic3_payment_card'] = 'MS2 Payment Methods Associated with Card Payment Type';
$_lang['setting_eshoplogistic3_payment_card_desc'] = 'Specify identifiers of MS2 payment methods, separated by commas. For example: 2,3,4';

$_lang['setting_eshoplogistic3_payment_cash'] = 'MS2 Payment Methods Associated with the Cash Payment Type';
$_lang['setting_eshoplogistic3_payment_cash_desc'] = 'Specify identifiers of MS2 payment methods, separated by commas. For example: 2,3,4';

$_lang['setting_eshoplogistic3_payment_cashless'] = 'MS2 Payment Methods Associated with Cashless Payment Type';
$_lang['setting_eshoplogistic3_payment_cashless_desc'] = 'Specify identifiers of MS2 payment methods, separated by commas. For example: 2,3,4';

$_lang['setting_eshoplogistic3_payment_prepay'] = 'MS2 Payment Methods Associated with Prepaid Type';
$_lang['setting_eshoplogistic3_payment_prepay_desc'] = 'Specify identifiers of MS2 payment methods, separated by commas. For example: 2,3,4';

$_lang['setting_eshoplogistic3_payment_upon_receipt'] = 'MS2 Payment Methods Associated with Pay on Delivery Type';
$_lang['setting_eshoplogistic3_payment_upon_receipt_desc'] = 'Specify identifiers of MS2 payment methods, separated by commas. For example: 2,3,4';

$_lang['setting_eshoplogistic3_widget_secrets'] = 'Widget Secret Codes';
$_lang['setting_eshoplogistic3_widget_secrets_desc'] = 'Specify the secret codes of the widgets that are used to send the order, separated by commas.';

$_lang['setting_eshoplogistic3_order_prefix'] = 'Order number prefix';
$_lang['setting_eshoplogistic3_order_prefix_desc'] = 'In order to highlight orders received from widgets, you can specify some prefix, for example «ESL-»';

$_lang['setting_eshoplogistic3_message_order_success'] = 'Message on successful order creation';
$_lang['setting_eshoplogistic3_message_order_success_desc'] = 'Displayed in the widget in case of successful order creation.';

$_lang['setting_eshoplogistic3_message_order_fail'] = 'Message when creating an order failed';
$_lang['setting_eshoplogistic3_message_order_fail_desc'] = 'Displayed in the widget in case of an error.';

$_lang['setting_eshoplogistic3_query_log'] = 'Keep a log of requests to eShopLogistic';
$_lang['setting_eshoplogistic3_query_log_desc'] = 'Use for debugging. The log file is stored here: core/componemts/eshoplogistic3/log.txt';

$_lang['setting_eshoplogistic3_query_log_mode'] = 'Log writing mode';
$_lang['setting_eshoplogistic3_query_log_mode_desc'] = '0 - record all requests, 1 - only requests for the calculation of the cost of delivery, 2 requests for the calculation of the cost,
without pickup points (there can be a lot of them)';

$_lang['setting_eshoplogistic3_controller'] = "Path to the widget's internal controller";
$_lang['setting_eshoplogistic3_controller_mode_desc'] = 'Specify if you want to pass requests through a custom controller (for example, for logging or debugging). If empty, requests will go directly to the eShopLogistic api.';

$_lang['setting_eshoplogistic3_manager_widget_key'] = 'Widget key to edit in the order window Minishop2';
$_lang['setting_eshoplogistic3_manager_widget_key_desc'] = 'To change delivery parameters when editing an order, specify the key for the embedded widget';

$_lang['setting_eshoplogistic3_take_places_from_order'] = 'Determine places by order items';
$_lang['setting_eshoplogistic3_take_places_from_order_desc'] = 'The places for unloading the order to the delivery service office will be automatically generated from the order positions';

$_lang['setting_eshoplogistic3_place_vat_rate'] = 'The value of the VAT rate';
$_lang['setting_eshoplogistic3_place_vat_rate_desc'] = 'Possible options: 0, 10, 20, -1 (without VAT)';

$_lang['setting_eshoplogistic3_sender_company'] = 'Company name';
$_lang['setting_eshoplogistic3_sender_company_desc'] = 'For substitution in the order unloading fields';
$_lang['setting_eshoplogistic3_sender_name'] = 'Name of contact person';
$_lang['setting_eshoplogistic3_sender_name_desc'] = 'For substitution in the order unloading fields';
$_lang['setting_eshoplogistic3_sender_email'] = 'E-mail of contact person';
$_lang['setting_eshoplogistic3_sender_email_desc'] = 'For substitution in the order unloading fields';
$_lang['setting_eshoplogistic3_sender_phone'] = 'Phone of contact person';
$_lang['setting_eshoplogistic3_sender_phone_desc'] = 'For substitution in the order unloading fields';
$_lang['setting_eshoplogistic3_sender_index'] = 'Postcode';
$_lang['setting_eshoplogistic3_sender_index_desc'] = 'For substitution in the order unloading fields';

$_lang['setting_eshoplogistic3_sender_region'] = 'Region';
$_lang['setting_eshoplogistic3_sender_region_desc'] = 'For substitution in the order unloading fields in case of picking up the goods from the sender';
$_lang['setting_eshoplogistic3_sender_city'] = 'City';
$_lang['setting_eshoplogistic3_sender_city_desc'] = 'For substitution in the order unloading fields in case of picking up the goods from the sender';
$_lang['setting_eshoplogistic3_sender_street'] = 'Street';
$_lang['setting_eshoplogistic3_sender_street_desc'] = 'For substitution in the order unloading fields in case of picking up the goods from the sender';
$_lang['setting_eshoplogistic3_sender_house'] = 'House';
$_lang['setting_eshoplogistic3_sender_house_desc'] = 'For substitution in the order unloading fields in case of picking up the goods from the sender';
$_lang['setting_eshoplogistic3_sender_room'] = 'Room';
$_lang['setting_eshoplogistic3_sender_room_desc'] = 'For substitution in the order unloading fields in case of picking up the goods from the sender';

$_lang['setting_eshoplogistic3_sdek_pick_up'] = 'Самопривоз на терминал СДЭКа';
$_lang['setting_eshoplogistic3_sdek_pick_up_desc'] = 'Выберите «Да», если привозите грузы на терминал самостоятельно';
$_lang['setting_eshoplogistic3_sdek_order_type'] = 'Order type';
$_lang['setting_eshoplogistic3_sdek_order_type_desc'] = '«1» - online store, «2» - regular delivery';
$_lang['setting_eshoplogistic3_sdek_pick_up_terminal'] = 'Terminal code';
$_lang['setting_eshoplogistic3_sdek_pick_up_terminal_desc'] = 'Code of the CDEK terminal, in case of self-delivery to the terminal for further shipment to the buyer';
$_lang['setting_eshoplogistic3_sdek_order_print_format'] = 'Label print format';
$_lang['setting_eshoplogistic3_sdek_order_print_format_desc'] = 'Available values: A4, A5, A6; default A4';

$_lang['setting_eshoplogistic3_yandex_pick_up'] = 'Самопривоз на терминал Яндекс Доставки';
$_lang['setting_eshoplogistic3_yandex_pick_up_desc'] = 'Выберите «Да», если привозите грузы на терминал самостоятельно';
$_lang['setting_eshoplogistic3_yandex_pick_up_terminal'] = 'Terminal code';
$_lang['setting_eshoplogistic3_yandex_pick_up_terminal_desc'] = 'Code of the CDEK terminal, in case of self-delivery to the terminal for further shipment to the buyer';

$_lang['setting_eshoplogistic3_boxberry_pick_up'] = 'Самопривоз на терминал Boxberry';
$_lang['setting_eshoplogistic3_boxberry_pick_up_desc'] = 'Выберите «Да», если привозите грузы на терминал самостоятельно';
$_lang['setting_eshoplogistic3_boxberry_pick_up_terminal'] = 'Код ПВЗ';
$_lang['setting_eshoplogistic3_boxberry_pick_up_terminal_desc'] = 'Код терминала Boxberry, в случае доставки своими силами до терминала для дальнейшей отправки покупателю';
$_lang['setting_eshoplogistic3_boxberry_order_type'] = 'Тип заказа по умолчанию';
$_lang['setting_eshoplogistic3_boxberry_order_type_desc'] = '0 - Посылка, 2 - Курьер Онлайн, 3 - Посылка Онлайн, 5 - Посылка 1й класс';
$_lang['setting_eshoplogistic3_boxberry_order_packing_type'] = 'Тип упаковки';
$_lang['setting_eshoplogistic3_boxberry_order_packing_type_desc'] = '1 - упаковка магазина, 2 - упаковка Boxberry';