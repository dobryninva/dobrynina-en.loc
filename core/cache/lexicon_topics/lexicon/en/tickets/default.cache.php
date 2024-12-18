<?php  return array (
  'area_tickets.main' => 'Main',
  'area_tickets.section' => 'Tickets section',
  'area_tickets.ticket' => 'Ticket',
  'area_tickets.comment' => 'Comment',
  'area_tickets.mail' => 'Email notices',
  'setting_tickets.frontend_css' => 'Frontend styles',
  'setting_tickets.frontend_css_desc' => 'Path to file with styles of the shop. If you want to use your own styles - specify them here, or clean this parameter and load them in site template.',
  'setting_tickets.frontend_js' => 'Frontend scripts',
  'setting_tickets.frontend_js_desc' => 'Path to file with scripts of the shop. If you want to use your own sscripts - specify them here, or clean this parameter and load them in site template.',
  'setting_tickets.date_format' => 'Date format',
  'setting_tickets.date_format_desc' => 'The date output format in the design of the tickets.',
  'setting_tickets.default_template' => 'Default template for new tickets',
  'setting_tickets.default_template_desc' => 'Default template for new tickets. Using in manager and when creating tickets on frontend.',
  'setting_tickets.ticket_isfolder_force' => 'Force "isfolder"',
  'setting_tickets.ticket_isfolder_force_desc' => 'Force parameter "isfolder" for tickets.',
  'setting_tickets.ticket_hidemenu_force' => 'Force "hidemenu"',
  'setting_tickets.ticket_hidemenu_force_desc' => 'Force parameter "hidemenu" for tickets.',
  'setting_tickets.ticket_show_in_tree_default' => 'Show in the tree default',
  'setting_tickets.ticket_show_in_tree_default_desc' => 'Enable this option and all the tickets were visible in the resource tree.',
  'setting_tickets.section_content_default' => 'Default content for new tickets section',
  'setting_tickets.section_content_default_desc' => ' Here you can specify the default content of new tickets section. By default it lists children tickets.',
  'setting_tickets.enable_editor' => 'Editor "markItUp"',
  'setting_tickets.enable_editor_desc' => 'If true, enables "markItUp" on frontend, for handy work with tickets and comments.',
  'setting_tickets.editor_config.ticket' => 'Settings of tickets editor',
  'setting_tickets.editor_config.ticket_desc' => 'JSON encoded array of settings for "markItUp". See more details - http://markitup.jaysalvat.com/documentation/',
  'setting_tickets.editor_config.comment' => 'Settings of comments editor',
  'setting_tickets.editor_config.comment_desc' => 'JSON encoded array of settings for "markItUp". See more details - http://markitup.jaysalvat.com/documentation/',
  'setting_tickets.disable_jevix_default' => 'Disable Jevix by default',
  'setting_tickets.disable_jevix_default_desc' => 'If true, setting "Disable Jevix" will be disabled for all new tickets by default.',
  'setting_tickets.process_tags_default' => 'Process tags by default',
  'setting_tickets.process_tags_default_desc' => 'If true, setting "Process MODX tags" will be disabled for all new tickets by default.',
  'setting_tickets.private_ticket_page' => 'Redirect from private ticket',
  'setting_tickets.private_ticket_page_desc' => 'Id of existing MODX resource for redirect user without needed permissions for viewing private tickets to.',
  'setting_tickets.unpublished_ticket_page' => 'Forward from unpublished ticket',
  'setting_tickets.unpublished_ticket_page_desc' => 'Id of existing MODX resource for forward user if requested ticket is not published.',
  'setting_tickets.ticket_max_cut' => 'The maximum size of the text without cut',
  'setting_tickets.ticket_max_cut_desc' => 'Максимальное количество символов без тегов, которые можно сохранить без тега cut.',
  'setting_tickets.snippet_prepare_comment' => 'Snippet for comment prepare',
  'setting_tickets.snippet_prepare_comment_desc' => 'Special snippet, that will prepare all comments before returning to frontend. It will be called in class "Tickets" and will be able to use all it methods and variables.',
  'setting_tickets.comment_edit_time' => 'Time to edit',
  'setting_tickets.comment_edit_time_desc' => 'Time in seconds for editing own comment.',
  'setting_tickets.clear_cache_on_comment_save' => 'Clear cache on commenting',
  'setting_tickets.clear_cache_on_comment_save_desc' => 'If true, cache of ticket will be cleared on any action with comment: create\\update\\remove. It needed only if you call snippet "TicketComments" uncached.',
  'setting_tickets.mail_from' => 'Mailbox outgoing mail',
  'setting_tickets.mail_from_desc' => 'Address to send the notifications. If not full - will be used system setting "emailsender".',
  'setting_tickets.mail_from_name' => 'The name of the sender',
  'setting_tickets.mail_from_name_desc' => 'Name of sender of all notifications. If empty - will be used systen setting "site_name".',
  'setting_tickets.mail_queue' => 'Messages queue',
  'setting_tickets.mail_queue_desc' => 'Whether to use a message queue or send letters immediately. If you activate this option, you need to add to the cron file "/core/components/tickets/cron/mail_queue.php"',
  'setting_tickets.mail_bcc' => 'Admin notifications',
  'setting_tickets.mail_bcc_desc' => 'Specify a comma-separated list of <b>id</b> of administrators you want to send messages about new ticket and comments.',
  'setting_tickets.mail_bcc_level' => 'Level of admin notifications',
  'setting_tickets.mail_bcc_level_desc' => 'There are 3 possible levels of admin notifications: 0 - disabled, 1 - send only messages about new tickets, 2 - tickets + comments. Recommended level is 1.',
  'setting_tickets.count_guests' => 'Count views of pages by guests',
  'setting_tickets.count_guests_desc' => 'When enabled, component will count views of pages by all users, not just authorized. Keep in mind that with this approach the number of viewings is quite easy to cheat.',
  'setting_tickets.max_files_upload' => 'Limit max file uploads',
  'setting_tickets.max_files_upload_desc' => 'Max files count which allow to upload for current user. 0 - unlimited.',
  'setting_mgr_tree_icon_ticket' => 'Icon of ticket',
  'setting_mgr_tree_icon_ticket_desc' => 'Icon of ticket in the resource tree.',
  'setting_mgr_tree_icon_ticketssection' => 'Icon of tickets section',
  'setting_mgr_tree_icon_ticketssection_desc' => 'Icon of tickets section in the resource tree.',
  'setting_tickets.source_default' => 'Media source for tickets',
  'setting_tickets.source_default_desc' => 'Specify media source that will be used for uploading tickets files.',
  'tickets.source_thumbnails_desc' => 'JSON encoded array of options for generating thumbnail.',
  'tickets.source_maxUploadWidth_desc' => 'Maximum width of image for upload. All images, that exceeds this parameter, will be resized to fit..',
  'tickets.source_maxUploadHeight_desc' => 'Maximum height of image for upload. All images, that exceeds this parameter, will be resized to fit.',
  'tickets.source_maxUploadSize_desc' => 'Maximum size of file for upload (in bytes).',
  'tickets.source_imageNameType_desc' => 'This setting specifies how to rename a file after upload. Hash is the generation of a unique name depending on the contents of the file. Friendly - generation behalf of the algorithm friendly URLs of pages of the site (they are managed by system settings).',
  'tickets' => 'Tickets',
  'comments' => 'Comments',
  'threads' => 'Comments threads',
  'subscribes' => 'Subscribes',
  'authors' => 'Authors',
  'tickets_section' => 'Section with tickets',
  'ticket' => 'Ticket',
  'ticket_all' => 'All tickets',
  'ticket_menu_desc' => 'Comments management and more',
  'comments_all' => 'All comments',
  'tickets_section_create_here' => 'Section with tickets',
  'tickets_section_new' => 'New ticket',
  'tickets_section_management' => 'Tickets management',
  'tickets_section_duplicate' => 'Duplicate section',
  'tickets_section_unpublish' => 'Unpublish section',
  'tickets_section_publish' => 'Publish section',
  'tickets_section_undelete' => 'Undelete section',
  'tickets_section_delete' => 'Delete section',
  'tickets_section_view' => 'View on site',
  'tickets_section_settings' => 'Settings',
  'tickets_section_tab_main' => 'Main',
  'tickets_section_tab_tickets' => 'Children tickets',
  'tickets_section_tab_tickets_intro' => 'All settings on this page apply only to new tickets.',
  'tickets_section_settings_template' => 'The template of children',
  'tickets_section_settings_template_desc' => 'Select the template that will be assigned to all new tickets that are created in this section. If template is not specified, it will be taken from the system settings <b>tickets.default_template</b>.',
  'tickets_section_settings_uri' => 'URI scheme',
  'tickets_section_settings_uri_desc' => 'You can use <b>%y</b> - the year in two digits, <b>%m</b> is the month <b>%d</b> - the day <b>%alias</b> - alias <b>%id</b> - the identifier and <b>%ext</b> - the document extension.',
  'tickets_section_settings_show_in_tree' => 'Display in the tree',
  'tickets_section_settings_show_in_tree_desc' => 'default tickets are not shown in the document tree, to reduce the load on the admin panel, but you can enable it for new documents.',
  'tickets_section_settings_hidemenu' => 'Hide in menu',
  'tickets_section_settings_hidemenu_desc' => 'You can specify configuration display the new ticket in the menu.',
  'tickets_section_settings_disable_jevix' => 'Disable Jevix',
  'tickets_section_settings_disable_jevix_desc' => 'By default, for security purposes, all tickets are processed snippet Jevix. You can disable this processing for new tickets current topic.',
  'tickets_section_settings_process_tags' => 'Process MODX tags',
  'tickets_section_settings_process_tags_desc' => 'By default, for security purposes, in the tickets are not run MODX tags. You can include progress in new tickets current topic.',
  'tickets_section_tab_ratings' => 'Ratings',
  'tickets_section_tab_ratings_intro' => 'Specify the rating points for different user actions in this section.',
  'tickets_section_rating_ticket' => 'Tickets',
  'tickets_section_rating_ticket_desc' => 'Rating for the creation of a ticket in this section.',
  'tickets_section_rating_comment' => 'Comments',
  'tickets_section_rating_comment_desc' => 'Rating for commenting tickets in this section.',
  'tickets_section_rating_view' => 'Views',
  'tickets_section_rating_view_desc' => 'Rating for the view tickets in this section.',
  'tickets_section_rating_vote_ticket' => 'Vote for the ticket',
  'tickets_section_rating_vote_ticket_desc' => 'Rating for the author of the ticket for each voting. Negative voices take up a rating.',
  'tickets_section_rating_vote_comment' => 'Vote for the comment',
  'tickets_section_rating_vote_comment_desc' => 'Rating for the author of the comment for each vote. Negative voices take up a rating.',
  'tickets_section_rating_star_ticket' => 'Ticket in the favorites',
  'tickets_section_rating_star_ticket_desc' => 'Rating for the author of the ticket for each add to favorites.',
  'tickets_section_rating_star_comment' => 'Comment in the favorites',
  'tickets_section_rating_star_comment_desc' => 'Rating for the author of the comment for each add to favorites.',
  'tickets_section_rating_min_ticket_create' => 'The rating for the ticket',
  'tickets_section_rating_min_ticket_create_desc' => 'Minimum rating needed to create a ticket in this section.',
  'tickets_section_rating_days_ticket_vote' => 'Vote for the ticket',
  'tickets_section_rating_days_ticket_vote_desc' => 'The maximum number of days after the publication of the ticket, during which users can vote for it.',
  'tickets_section_rating_min_comment_create' => 'The rating for the comment',
  'tickets_section_rating_min_comment_create_desc' => 'Minimum rating needed to create a comment in this section.',
  'tickets_section_rating_days_comment_vote' => 'Vote for comment',
  'tickets_section_rating_days_comment_vote_desc' => 'The maximum number of days after the publication of the comment, during which users can vote for it.',
  'tickets_section_notify' => 'Notify about new tickets',
  'tickets_section_subscribed' => 'You have subscribe to notifications about new tickets in this section.',
  'tickets_section_unsubscribed' => 'You will no longer receive notifications about new tickets in this section.',
  'tickets_section_email_subscription' => 'New ticket in the section "[[+section.pagetitle]]"',
  'tickets_author_notify' => 'Notify about author\'s tickets',
  'tickets_author_subscribed' => 'You have subscribe to notifications about new tickets this author.',
  'tickets_author_unsubscribed' => 'You will no longer receive notifications about new tickets this author.',
  'tickets_author_email_subscription' => 'New ticket author [[+user.fullname]]"',
  'ticket_create_here' => 'Create ticket',
  'ticket_no_comments' => 'This page has no comments. You can be a trailblazer.',
  'tickets_message_close_all' => 'close all',
  'err_no_jevix' => 'Snippet Jevix is required for proper work. You need to install it from MODX repository.',
  'tickets_err_unknown' => 'An unknown error occurred.',
  'ticket_err_id' => 'The ticket with specified id = [[+id]] not found.',
  'ticket_err_wrong_user' => 'You trying to update a ticket that is not yours.',
  'ticket_err_no_auth' => 'You need to login to create a ticket.',
  'ticket_err_wrong_parent' => 'Invalid section for this ticket was specified.',
  'ticket_err_wrong_resource' => 'Wrong ticket specified.',
  'ticket_err_wrong_thread' => 'Wrong comments thread specified.',
  'ticket_err_wrong_section' => 'Wrong tickets section specified.',
  'ticket_err_wrong_author' => 'Wrong tickets author specified.',
  'ticket_err_access_denied' => 'Access denied',
  'ticket_err_form' => 'Form contains errors. Please, fix it.',
  'ticket_err_deleted_comment' => 'You trying to edit the deleted comment.',
  'ticket_err_unpublished_comment' => 'This comment was not published.',
  'ticket_err_ticket' => 'The specified ticket does not exist.',
  'ticket_err_vote_own' => 'You cannot vote for your ticket.',
  'ticket_err_vote_already' => 'You have already voted for this ticket.',
  'ticket_err_empty' => 'You forgot to write the text of the ticket.',
  'ticket_err_publish' => 'You are not allowed to publish tickets.',
  'ticket_err_cut' => 'The length of text is [[+length]] symbols. You must specify tag &lt;cut/&gt if text longer than [[+max_cut]] symbols.',
  'ticket_err_rating_ticket' => 'To publish a topic in this section you need a rating more than [[+rating]].',
  'ticket_err_rating_comment' => 'To post a comment in this section you need a rating more than [[+rating]].',
  'ticket_err_vote_ticket_days' => 'The time for voting for this topic has expired.',
  'ticket_err_vote_comment_days' => 'The time for voting for this comment has expired.',
  'ticket_unpublished_comment' => 'Your comment will be published after moderation.',
  'permission_denied' => 'You do not have permissions for this action.',
  'field_required' => 'This field is required.',
  'ticket_clear' => 'Clear',
  'ticket_comments_intro' => 'Here are comments from the entire site.',
  'ticket_comment_deleted_text' => 'This comment was deleted.',
  'ticket_comment_remove_confirm' => 'Are you sure you want to permanently remove <b>comments thread</b>, starting with this? This operation is irreversible!',
  'ticket_comment_name' => 'Author',
  'ticket_comment_text' => 'Comment',
  'ticket_comment_createdon' => 'Created on',
  'ticket_comment_editedon' => 'Edited on',
  'ticket_comment_deletedon' => 'Deleted on',
  'ticket_comment_parent' => 'Parent',
  'ticket_comment_thread' => 'Thread',
  'ticket_comment_email' => 'Email',
  'ticket_comment_view' => 'View comment on site',
  'ticket_comment_reply' => 'reply',
  'ticket_comment_edit' => 'edit',
  'ticket_comment_create' => 'Write comment',
  'ticket_comment_update' => 'Edit comment',
  'ticket_comment_preview' => 'Preview',
  'ticket_comment_save' => 'Write',
  'ticket_comment_was_edited' => 'Comment was edited',
  'ticket_comment_guest' => 'Guest',
  'ticket_comment_deleted' => 'Deleted',
  'ticket_comment_captcha' => 'Enter the amount [[+a]] + [[+b]]',
  'ticket_comment_notify' => 'Notify about new comments',
  'ticket_comment_reply_to' => 'Reply to',
  'ticket_comment_upload_auth' => 'You need to login to uploading files.',
  'ticket_comment_err_id' => 'The comment with specified id = [[+id]] not found.',
  'ticket_comment_err_no_auth' => 'You need to login to create comments.',
  'ticket_comment_err_wrong_user' => 'You trying to update a comment that is not yours.',
  'ticket_comment_err_no_time' => 'Time for editing a comment is ended.',
  'ticket_comment_err_has_replies' => 'This comment already has replies, so you cannot change it.',
  'ticket_comment_err_parent' => 'You are trying to reply to not existing comment.',
  'ticket_comment_err_comment' => 'This comment does not exist.',
  'ticket_comment_err_vote_own' => 'You cannot vote for your own comment.',
  'ticket_comment_err_vote_already' => 'You have already voted for this comment.',
  'ticket_comment_err_wrong_guest_ip' => 'You are not authorized and your ip is not the same as the ip of the author of this comment.',
  'ticket_comment_err_empty' => 'You forgot to write a comment.',
  'ticket_comment_err_email' => 'You have specified an invalid email.',
  'ticket_comment_err_guest_edit' => 'You are not allowed to edit comments.',
  'ticket_comment_err_captcha' => 'Invalid code of protection against spam.',
  'ticket_comment_err_no_email' => 'You need to specify the email in your account settings..',
  'ticket_authors_intro' => 'This section contains profiles of authors with ratings. Settings for the calculation are specified separately in each section.<br/>You can see how many tickets, comments and views made by the author and added to favorites and voted for them by other users.',
  'ticket_authors_rebuild' => 'Update ratings',
  'ticket_authors_rebuild_confirm' => 'Are you sure you want to rebuild the rankings of all the authors of the site? This operation may take a lot of time.',
  'ticket_authors_rebuild_wait' => 'Processing profiles of authors...',
  'ticket_authors_rebuild_wait_ext' => 'Processed: [[+processed]] from [[+total]].',
  'ticket_author_createdon' => 'Created On',
  'ticket_author_visitedon' => 'Visited On',
  'ticket_author_rating' => 'Rating',
  'ticket_author_tickets' => 'Tickets',
  'ticket_author_comments' => 'Comments',
  'ticket_author_views' => 'Views',
  'ticket_author_stars' => 'Favorites',
  'ticket_author_stars_tickets' => 'Favorite tickets',
  'ticket_author_stars_comments' => 'Favorite comments',
  'ticket_author_votes_tickets' => 'Tickets rating',
  'ticket_author_votes_comments' => 'Comments rating',
  'ticket_author_votes_tickets_up' => 'Votes for tickets',
  'ticket_author_votes_tickets_down' => 'Votes against tickets',
  'ticket_author_votes_comments_up' => 'Votes for comments',
  'ticket_author_votes_comments_down' => 'Votes against comments',
  'ticket_author_rating_desc' => 'For / Against',
  'ticket_author_stars_desc' => 'Tickets / Comments',
  'ticket_tickets_intro' => 'Here you can find the tickets from the whole site.',
  'ticket_publishedon' => 'Published On',
  'ticket_pagetitle' => 'Title',
  'ticket_parent' => 'Section',
  'ticket_author' => 'Author',
  'ticket_delete' => 'Delete ticket',
  'ticket_undelete' => 'Restore ticket',
  'ticket_delete_text' => 'Are you sure you want to delete this ticket?',
  'ticket_deleted_text' => 'Deleted',
  'ticket_undelete_text' => 'Are you sure you want to restore this ticket?',
  'ticket_undeleted_text' => 'Restored.',
  'ticket_create' => 'Create ticket?',
  'ticket_disable_jevix' => 'Disable Jevix',
  'ticket_disable_jevix_help' => 'Display content of this page without Jevix sanitization. It is dangerous, any user, that creates the page can attack your site (XSS, LFI etc.).',
  'ticket_process_tags' => 'Process MODX tags',
  'ticket_process_tags_help' => 'By default tags in bracket displaying as is, without processing by parser. If you enable it - on this page can be run various snippets, chunks, etc.',
  'ticket_private' => 'Private ticket',
  'ticket_private_help' => 'If true, users will must be have permission "ticket_view_private" for reading this ticket.',
  'ticket_show_in_tree' => 'Show in the tree',
  'ticket_show_in_tree_help' => 'default they are not displayed in the resource tree MODX, so as not to burden him.',
  'ticket_createdon' => 'Created On',
  'ticket_content' => 'Content',
  'ticket_publish' => 'Publish',
  'ticket_preview' => 'Preview',
  'ticket_comments' => 'Comments',
  'ticket_actions' => 'Actions',
  'ticket_save' => 'Save',
  'ticket_draft' => 'Into drafts',
  'ticket_open' => 'Open',
  'ticket_read_more' => 'Read more',
  'ticket_saved' => 'Saved!',
  'ticket_threads_intro' => 'Threads of comments. Usually, one thread is the comments of the one page.',
  'ticket_thread' => 'Comments thread',
  'ticket_thread_name' => 'Thread name',
  'ticket_thread_createdon' => 'Created on',
  'ticket_thread_editedon' => 'Edited on',
  'ticket_thread_deletedon' => 'Deleted on',
  'ticket_thread_comments' => 'Comments',
  'ticket_thread_resource' => 'Ticket id',
  'ticket_thread_delete' => 'Disable thread',
  'ticket_thread_undelete' => 'Enable thread',
  'ticket_thread_close' => 'Close thread',
  'ticket_thread_open' => 'Open thread',
  'ticket_thread_remove' => 'Remove with comments',
  'ticket_thread_remove_confirm' => 'Are you sure you want to totally remove <b>all</b> this thread? This operation is irreversible!',
  'ticket_thread_view' => 'View on site',
  'ticket_thread_err_deleted' => 'Commenting is disabled.',
  'ticket_thread_err_closed' => 'Adding new comments is disabled.',
  'ticket_thread_manage_comments' => 'Manage comments',
  'ticket_thread_subscribed' => 'You have subscribe to notifications about new comments in this thread.',
  'ticket_thread_unsubscribed' => 'You will no longer receive notifications about new comments in this thread.',
  'ticket_date_now' => 'Just now',
  'ticket_date_today' => 'Today at',
  'ticket_date_yesterday' => 'Yesterday at',
  'ticket_date_tomorrow' => 'Tomorrow at',
  'ticket_date_minutes_back' => '["[[+minutes]] minutes ago","[[+minutes]] minutes ago","[[+minutes]] minutes ago"]',
  'ticket_date_minutes_back_less' => 'Less than a minute ago',
  'ticket_date_hours_back' => '["[[+hours]] hours ago","[[+hours]] hours ago","[[+hours]] hours ago"]',
  'ticket_date_hours_back_less' => 'Less than an hour ago',
  'ticket_date_months' => '["january","february","march","april","may","june","july","august","september","october","november","december"]',
  'ticket_like' => 'Like',
  'ticket_dislike' => 'Dislike',
  'ticket_refrain' => 'See ratings',
  'ticket_rating_total' => 'Total',
  'ticket_rating_and' => 'and',
  'ticket_file_select' => 'Select files',
  'ticket_file_delete' => 'Delete',
  'ticket_file_restore' => 'Restore',
  'ticket_file_insert' => 'Insert link',
  'ticket_err_source_initialize' => 'Could not initialize media source',
  'ticket_err_file_ns' => 'Could not process specified file',
  'ticket_err_file_ext' => 'Wrong file extension',
  'ticket_err_file_save' => 'Could not upload file',
  'ticket_err_file_owner' => 'This file not belongs to you',
  'ticket_err_file_exists' => 'File with the same name or content is already exists: "[[+file]]"',
  'ticket_err_files_limit' => 'Not able to upload more than [[+limit]] files',
  'ticket_uploaded_files' => 'Uploaded files',
  'tickets_action_view' => 'View',
  'tickets_action_edit' => 'Edit',
  'tickets_action_publish' => 'Publish',
  'tickets_action_reply' => 'Reply',
  'tickets_action_unpublish' => 'UnPublish',
  'tickets_action_unsubscribe' => 'UnSubscribe',
  'tickets_action_delete' => 'Delete',
  'tickets_action_undelete' => 'Restore',
  'tickets_action_remove' => 'Remove',
  'tickets_action_duplicate' => 'Duplicate',
  'tickets_action_open' => 'Open',
  'tickets_action_close' => 'Close',
  'ticket_comment_email_owner' => 'New comment for your ticket "[[+pagetitle]]"',
  'ticket_comment_email_reply' => 'Reply to your comment for ticket "[[+pagetitle]]"',
  'ticket_comment_email_subscription' => 'New comment for ticket "[[+pagetitle]]"',
  'ticket_comment_email_bcc' => 'New comment for ticket "[[+pagetitle]]"',
  'ticket_comment_email_unpublished_bcc' => 'Unpublished comment for ticket "[[+pagetitle]]"',
  'ticket_comment_email_unpublished_intro' => 'The user <b>[[+name]]</b> left a comment in the topic "<a href="[[~[[+resource]]?scheme=`full`]]">[[+pagetitle]]</a>".<br/>Now you need to check and approve it in the manager:',
  'ticket_comment_email_subscription_intro' => 'The user <b>[[+name]]</b> left a comment in the topic, on which you have been subscribed - "<a href="[[~[[+resource]]?scheme=`full`]]">[[+pagetitle]]</a>":',
  'ticket_comment_email_reply_intro' => 'The user <b>[[+name]]</b> replied on your comment to topic "<a href="[[~[[+resource]]?scheme=`full`]]">[[+pagetitle]]</a>":',
  'ticket_comment_email_reply_text' => 'The text of the comment:',
  'ticket_comment_email_owner_intro' => 'The user <b>[[+name]]</b> left a comment to the your topic "<a href="[[~[[+resource]]?scheme=`full`]]">[[+pagetitle]]</a>":',
  'ticket_comment_email_bcc_intro' => 'The user <b>[[+name]]</b> left a comment in the topic "<a href="[[~[[+resource]]?scheme=`full`]]">[[+pagetitle]]</a>":',
  'ticket_email_bcc' => 'New ticket to your site - "[[+pagetitle]]"',
  'ticket_email_bcc_intro' => 'The user <b>[[+fullname]]</b> ([[+email]]) was created the new topic to your site: <a href="[[~[[+id]]?scheme=`full`]]">[[+pagetitle]]</a>',
  'ticket_email_subscribed_intro' => 'The user <b>[[+fullname]]</b> published the new topic: "<a href="[[~[[+id]]?scheme=`full`]]">[[+pagetitle]]</a>" to the section "<a href="[[~[[+section]]?scheme=`full`]]">[[+section_title]]</a>", on which you have been subscribed.',
  'ticket_email_subscribed_author' => 'The user <b>[[+fullname]]</b> on which you have been subscribed published the new topic: "<a href="[[~[[+id]]?scheme=`full`]]">[[+pagetitle]]</a>" to the section "<a href="[[~[[+section]]?scheme=`full`]]">[[+section_title]]</a>".',
  'ticket_email_all_comments' => 'All comments',
  'ticket_email_view' => 'View',
  'ticket_email_reply' => 'Reply',
);