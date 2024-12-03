<?php
/**
 * Default Russian Lexicon Entries for ResVideoGallery
 *
 * @package resvideogallery
 * @subpackage lexicon
 */
$_lang['resvideogallery'] = 'Видео галерея';
$_lang['resvideogallery.err.nf_resource'] = 'Не найден ресурс';
$_lang['resvideogallery.err.nf_video'] = 'Не найден видео';
$_lang['resvideogallery.err.ns'] = 'Это поле должно быть заполнено';
$_lang['resvideogallery.err.scrape'] = 'Видеосервис не поддерживается, либо ссылка является неправильной';
$_lang['resvideogallery.mess.reload_thumb'] = 'Обновление превью видео';
$_lang['resvideogallery.id'] = 'Id';
$_lang['resvideogallery.url'] = 'Адрес';
$_lang['resvideogallery.rank'] = 'Позиция';
$_lang['resvideogallery.size'] = 'Размер';
$_lang['resvideogallery.duration'] = 'Время';
$_lang['resvideogallery.createdon'] = 'Дата загрузки';
$_lang['resvideogallery.createdby'] = 'ID пользователя';
$_lang['resvideogallery.username'] = 'Пользователь';
$_lang['resvideogallery.video.url'] = 'Ссылка на видеоролик';
$_lang['resvideogallery.video.image'] = 'Изображение';
$_lang['resvideogallery.video.name'] = 'Название';
$_lang['resvideogallery.video.title'] = 'Название';
$_lang['resvideogallery.video.description'] = 'Описание';
$_lang['resvideogallery.video.tags'] = 'Теги (Группы)';
$_lang['resvideogallery.video.search'] = 'Поиск...';
$_lang['resvideogallery.video.generate_thumb'] = 'Обновить превью видео';
$_lang['resvideogallery.video.new'] = 'Новое видео';
$_lang['resvideogallery.video.update'] = 'Редактировать';
$_lang['resvideogallery.video.show'] = 'Открыть в новом окне';
$_lang['resvideogallery.video.user_info'] = 'Информация о пользователе';
$_lang['resvideogallery.video.reload_thumb'] = 'Обновить превью';
$_lang['resvideogallery.video.delete'] = 'Удалить видео';
$_lang['resvideogallery.video.delete_confirm'] = 'Вы действительно хотите удалить это видео? Эта операция необратима.';
$_lang['resvideogallery.video.delete_multiple'] = 'Удалить фидео';
$_lang['resvideogallery.video.delete_multiple_confirm'] = 'Вы действительно хотите удалить эти видео? Эта операция необратима.';
$_lang['resvideogallery.video.activate'] = 'Включить видео';
$_lang['resvideogallery.video.inactivate'] = 'Отключить видео';
$_lang['resvideogallery.video.activate_multiple'] = 'Включить видео';
$_lang['resvideogallery.video.inactivate_multiple'] = 'Отключить видео';
$_lang['resvideogallery.video.edit_tags'] = 'Изменить теги';
$_lang['resvideogallery.video.edit_tags_intro'] = 'Эта операция перезапишет все теги выбранных видео файлов!';
$_lang['resvideogallery.btn.add_video'] = 'Добавить видеоролик';
$_lang['resvideogallery.btn.reload_thumb_all'] = 'Обновить превью у всех видео';
$_lang['resvideogallery.msg.empty'] = '<p style="padding: 20px 0 0 5px;color:#555;">Еще не один видео ролик не добавлен.</p>';
$_lang['resvideogallery.resource'] = 'Ресурс';
$_lang['resvideogallery.site'] = 'Сайт';
$_lang['resvideogallery.open_link'] = 'Откройте следующую ссылку в вашем браузере: <a href="[[+url]]" target="_blank">[[+url]]</a>';

$_lang['resvideogallery.more'] = 'Загрузить еще';
$_lang['resvideogallery.google_drive'] = 'Google drive';
$_lang['resvideogallery.vk'] = 'VK';
$_lang['resvideogallery.youtube'] = 'youtube';


$_lang['setting_resvideogallery.disable_for_templates'] = 'Отключить показ у шаблонов';
$_lang['setting_resvideogallery.disable_for_templates_desc'] = 'Перечислите id шаблонов через запятую, для которых не нужно выводить вкладку с видео галерей.';
$_lang['setting_resvideogallery.page_size'] = 'Файлов на странице';
$_lang['setting_resvideogallery.page_size_desc'] = 'Вы можете задать количество выводимых файлов на странице, по умолчанию 20. 0 - вывести все.';
$_lang['setting_resvideogallery.date_format'] = 'Формат даты';
$_lang['setting_resvideogallery.date_format_desc'] = 'Укажите формат дат, используя синтаксис php функции strftime(). По умолчанию формат "%d.%m.%y %H:%M".';
$_lang['setting_resvideogallery.media_source'] = 'Источник файлов по умолчанию';
$_lang['setting_resvideogallery.media_source_desc'] = 'Источник файлов для галереи видео ресурса по умолчанию.';
$_lang['setting_resvideogallery.thumb_options'] = 'Превью для видео';
$_lang['setting_resvideogallery.thumb_options_desc'] = 'Опции для генерация превью через <a hfef="http://phpthumb.sourceforge.net/demo/demo/phpThumb.demo.demo.php" target="_blank">phpThumb</a>';
$_lang['setting_resvideogallery.exact_sorting'] = 'Точная сортировка видео';
$_lang['setting_resvideogallery.exact_sorting_desc'] = 'Включает или выключает точную сортировку видео дополнительными запросами в БД. Может замедлять сортировку видео в больших галереях.';
$_lang['setting_resvideogallery.youtube_api_key'] = 'API key Youtube';
$_lang['setting_resvideogallery.youtube_api_key_desc'] = 'API key - ключ для работы с Youtube. <a hfef="https://www.youtube.com/watch?v=qXhIpThTMlk " target="_blank">Видео пример как его получить</a>';
$_lang['setting_resvideogallery.thumbs_path'] = 'Путь к превью для видео';
$_lang['setting_resvideogallery.thumbs_path_desc'] = 'Путь к корневой директории в которой хранятся превью для видео.';
$_lang['setting_resvideogallery.thumbs_url'] = 'Url к превью для видео';
$_lang['setting_resvideogallery.thumbs_url_desc'] = 'Url к корневой директории в которой хранятся превью для видео.';
$_lang['setting_resvideogallery.jquery'] = 'Включить jQuery v2.2.4';
$_lang['setting_resvideogallery.jquery_desc'] = 'Если вы используете своё подключение jQuery для страницы или используете стороние сервисы, выберите НЕТ и убедитесь.';
$_lang['setting_resvideogallery.vk_access_token'] = 'Access Token для Вконтакте';
$_lang['setting_resvideogallery.vk_access_token_desc'] = '';
$_lang['setting_resvideogallery.google_drive_auth_config'] = 'Google drive конфиг доступа';
$_lang['setting_resvideogallery.google_drive_auth_config_desc'] = '';
$_lang['setting_resvideogallery.google_drive_auth_token'] = 'Google drive токен доступа';
$_lang['setting_resvideogallery.google_drive_auth_token_desc'] = '';
$_lang['setting_resvideogallery.google_drive_auth_code'] = 'Google drive код подтверждения';
$_lang['setting_resvideogallery.google_drive_auth_code_desc'] = '';
$_lang['setting_resvideogallery.google_drive_html5_player'] = 'Использовать html5 плеер';
$_lang['setting_resvideogallery.google_drive_html5_player_desc'] = '';