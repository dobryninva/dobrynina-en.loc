<?php
/**
 * Default English Lexicon Entries for ResVideoGallery
 *
 * @package resvideogallery
 * @subpackage lexicon
 */

$_lang['resvideogallery'] = 'Video gallery';
$_lang['resvideogallery.err.nf_resource'] = 'Resource not found';
$_lang['resvideogallery.err.nf_video'] = 'Video not found';
$_lang['resvideogallery.err.ns'] = 'This field is required';
$_lang['resvideogallery.err.scrape'] = 'Video service is not supported, or the link is wrong';
$_lang['resvideogallery.mess.reload_thumb'] = 'Update preview video';
$_lang['resvideogallery.id'] = 'Id';
$_lang['resvideogallery.url'] = 'Url';
$_lang['resvideogallery.rank'] = 'Position';
$_lang['resvideogallery.size'] = 'Size';
$_lang['resvideogallery.duration'] = 'Duration';
$_lang['resvideogallery.createdon'] = 'Uploaded on';
$_lang['resvideogallery.createdby'] = 'ID user';
$_lang['resvideogallery.username'] = 'Uploaded by';
$_lang['resvideogallery.video.url'] = 'Link to video';
$_lang['resvideogallery.video.image'] = 'Image';
$_lang['resvideogallery.video.name'] = 'Name';
$_lang['resvideogallery.video.title'] = 'Title';
$_lang['resvideogallery.video.description'] = 'description';
$_lang['resvideogallery.video.tags'] = 'Tags (Groups)';
$_lang['resvideogallery.video.search'] = 'Search...';
$_lang['resvideogallery.video.generate_thumb'] = 'Update video preview';
$_lang['resvideogallery.video.new'] = 'New video';
$_lang['resvideogallery.video.update'] = 'Edit';
$_lang['resvideogallery.video.show'] = 'Show in new window';
$_lang['resvideogallery.video.user_info'] = 'User information';
$_lang['resvideogallery.video.reload_thumb'] = 'Update preview';
$_lang['resvideogallery.video.delete'] = 'Delete video';
$_lang['resvideogallery.video.delete_confirm'] = 'Are you shure you wanSt to delete this video? This operation is irreversible.';
$_lang['resvideogallery.video.delete_multiple'] = 'Delete videosS';
$_lang['resvideogallery.video.delete_multiple_confirm'] = 'Are you shure you want to delete this videos? This operation is irreversible.';
$_lang['resvideogallery.video.activate'] = 'Activate video';
$_lang['resvideogallery.video.inactivate'] = 'Inactivate video';
$_lang['resvideogallery.video.activate_multiple'] = 'Activate videos';
$_lang['resvideogallery.video.inactivate_multiple'] = 'Inactivate videos';
$_lang['resvideogallery.video.edit_tags'] = 'Edit tags';
$_lang['resvideogallery.video.edit_tags_intro'] = 'This operation will overwrite all tags of the selected videos!';
$_lang['resvideogallery.btn.add_video'] = 'Add video';
$_lang['resvideogallery.btn.reload_thumb_all'] = 'Update preview all video';
$_lang['resvideogallery.msg.empty'] = '<p style="padding: 20px 0 0 5px;color:#555;">More than one video clip are not added.</p>';
$_lang['resvideogallery.resource'] = 'Resource';
$_lang['resvideogallery.site'] = 'Site';
$_lang['resvideogallery.more'] = 'Load more';
$_lang['resvideogallery.open_link'] = 'Open the following link in your browser: <a href="[[+url]]" target="_blank">[[+url]]</a>';

$_lang['resvideogallery.google_drive'] = 'Google drive';
$_lang['resvideogallery.vk'] = 'VK';
$_lang['resvideogallery.youtube'] = 'youtube';

$_lang['setting_resvideogallery.disable_for_templates'] = 'Disable for templates';
$_lang['setting_resvideogallery.disable_for_templates_desc'] = 'Specify comma-separated list of ids of a templates, for which you do not want to display the tab with video gallery.';
$_lang['setting_resvideogallery.page_size'] = 'Number of files on page';
$_lang['setting_resvideogallery.page_size_desc'] = 'You can set the number of files displayed on the page, default is 6. 0 - display all files.';
$_lang['setting_resvideogallery.date_format'] = 'Format of dates';
$_lang['setting_resvideogallery.date_format_desc'] = 'You can specify how to format dates using php strftime() syntax. By default format is "%d.%m.%y %H:%M".';
$_lang['setting_resvideogallery.thumb_options'] = 'Preview Video';
$_lang['setting_resvideogallery.thumb_options_desc'] = 'Options to generate previews through <a hfef="http://phpthumb.sourceforge.net/demo/demo/phpThumb.demo.demo.php" target="_blank">phpThumb</a>';
$_lang['setting_resvideogallery.exact_sorting'] = 'Exact sorting of video';
$_lang['setting_resvideogallery.exact_sorting_desc'] = 'Enables or disables the exact sort of videos by additional requests to the database. Can slow down the sorting of videos in large galleries.';
$_lang['setting_resvideogallery.youtube_api_key'] = 'API key Youtube';
$_lang['setting_resvideogallery.youtube_api_key_desc'] = 'API key - key is to work with Youtube. <a hfef="https://www.youtube.com/watch?v=qXhIpThTMlk " target="_blank">Video example of how to get it</a>';
$_lang['setting_resvideogallery.thumbs_path'] = 'The path to the preview video';
$_lang['setting_resvideogallery.thumbs_path_desc'] = 'The path to the root directory that stores the preview video.';
$_lang['setting_resvideogallery.thumbs_url'] = 'Url to preview video';
$_lang['setting_resvideogallery.thumbs_url_desc'] = 'Url to the root directory that stores the preview video.';
$_lang['setting_resvideogallery.jquery'] = 'Include jQuery v2.2.4';
$_lang['setting_resvideogallery.jquery_desc'] = 'If you are using your connection for jQuery page or use third-party services, select NO and confirm.';
$_lang['setting_resvideogallery.vk_access_token'] = 'Access Token для Вконтакте';
$_lang['setting_resvideogallery.vk_access_token_desc'] = '';
$_lang['setting_resvideogallery.google_drive_auth_config'] = 'Google drive auth config';
$_lang['setting_resvideogallery.google_drive_auth_config_desc'] = '';
$_lang['setting_resvideogallery.google_drive_auth_token'] = 'Google drive access token';
$_lang['setting_resvideogallery.google_drive_auth_token_desc'] = '';
$_lang['setting_resvideogallery.google_drive_auth_code'] = 'Google drive verification code';
$_lang['setting_resvideogallery.google_drive_auth_code_desc'] = '';
$_lang['setting_resvideogallery.google_drive_html5_player'] = 'Use html5 player';
$_lang['setting_resvideogallery.google_drive_html5_player_desc'] = '';