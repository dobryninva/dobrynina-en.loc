<?php  return array (
  0 => 
  array (
    'text' => 'Содержимое',
    'parent' => 'topnav',
    'action' => '',
    'description' => '',
    'icon' => '',
    'menuindex' => 0,
    'params' => '',
    'handler' => '',
    'permissions' => 'menu_site',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
    'id' => 'site',
    'children' => 
    array (
      0 => 
      array (
        'text' => 'Новый ресурс',
        'parent' => 'site',
        'action' => 'resource/create',
        'description' => 'Создать новый ресурс',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'new_document',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'new_resource',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      1 => 
      array (
        'text' => 'Перейти на сайт',
        'parent' => 'site',
        'action' => '',
        'description' => 'Будет загружена главная страница сайта в новой вкладке',
        'icon' => '',
        'menuindex' => 4,
        'params' => '',
        'handler' => 'MODx.preview(); return false;',
        'permissions' => '',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'preview',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      2 => 
      array (
        'text' => 'Импорт HTML',
        'parent' => 'site',
        'action' => 'system/import/html',
        'description' => 'Пакетный импорт HTML-файлов',
        'icon' => '',
        'menuindex' => 5,
        'params' => '',
        'handler' => '',
        'permissions' => 'import_static',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'import_site',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      3 => 
      array (
        'text' => 'Импорт ресурсов',
        'parent' => 'site',
        'action' => 'system/import',
        'description' => 'Пакетный импорт статических ресурсов',
        'icon' => '',
        'menuindex' => 6,
        'params' => '',
        'handler' => '',
        'permissions' => 'import_static',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'import_resources',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      4 => 
      array (
        'text' => 'Группы ресурсов',
        'parent' => 'site',
        'action' => 'security/resourcegroup',
        'description' => 'Управление принадлежностью ресурсов к группам ресурсов',
        'icon' => '',
        'menuindex' => 7,
        'params' => '',
        'handler' => '',
        'permissions' => 'access_permissions',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'resource_groups',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      5 => 
      array (
        'text' => 'Типы содержимого',
        'parent' => 'site',
        'action' => 'system/contenttype',
        'description' => 'Вы можете добавить новые типы содержимого для ресурсов, например такие как .html, .js, и т.п.',
        'icon' => '',
        'menuindex' => 8,
        'params' => '',
        'handler' => '',
        'permissions' => 'content_types',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'content_types',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
    ),
    'controller' => '',
  ),
  1 => 
  array (
    'text' => 'Медиа',
    'parent' => 'topnav',
    'action' => '',
    'description' => 'Обновить медиа-файлы и их «источники»',
    'icon' => '',
    'menuindex' => 1,
    'params' => '',
    'handler' => '',
    'permissions' => 'file_manager',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
    'id' => 'media',
    'children' => 
    array (
      0 => 
      array (
        'text' => 'Управление медиа',
        'parent' => 'media',
        'action' => 'media/browser',
        'description' => 'Отображение, загрузка и управление медиа-файлами',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'file_manager',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'file_browser',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      1 => 
      array (
        'text' => 'Источники файлов',
        'parent' => 'media',
        'action' => 'source',
        'description' => 'Управление источниками файлов',
        'icon' => '',
        'menuindex' => 1,
        'params' => '',
        'handler' => '',
        'permissions' => 'sources',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'sources',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
    ),
    'controller' => '',
  ),
  2 => 
  array (
    'text' => 'Приложения',
    'parent' => 'topnav',
    'action' => '',
    'description' => '',
    'icon' => '',
    'menuindex' => 2,
    'params' => '',
    'handler' => '',
    'permissions' => 'components',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
    'id' => 'components',
    'children' => 
    array (
      0 => 
      array (
        'text' => 'Установщик',
        'parent' => 'components',
        'action' => 'workspaces',
        'description' => 'Управление пакетами и репозиториями',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'packages',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'installer',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      1 => 
      array (
        'text' => 'Тикеты',
        'parent' => 'components',
        'action' => 'home',
        'description' => 'Управление комментариями и не только',
        'icon' => '<i class="icon icon-large icon-comments-0"></i>',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'tickets',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'tickets',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      2 => 
      array (
        'text' => 'Файлы ресурсов',
        'parent' => 'components',
        'action' => 'list',
        'description' => 'Файлы подключенные в документах',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'fileattach.totallist',
        'namespace' => 'fileattach',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'fileattach',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      3 => 
      array (
        'text' => 'msPre',
        'parent' => 'components',
        'action' => 'resource',
        'description' => 'массовое редактирование',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'mspre',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'mspre',
        'children' => 
        array (
          0 => 
          array (
            'text' => 'Товары',
            'parent' => 'mspre',
            'action' => 'product',
            'description' => 'редактирование товаров',
            'icon' => '',
            'menuindex' => 0,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'mspre',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'mspre_product',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          1 => 
          array (
            'text' => 'Ресурсы',
            'parent' => 'mspre',
            'action' => 'resource',
            'description' => 'редактирование ресурсов',
            'icon' => '',
            'menuindex' => 1,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'mspre',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'mspre_resource',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
        ),
        'controller' => '',
      ),
      4 => 
      array (
        'text' => 'mSearch2',
        'parent' => 'components',
        'action' => 'home',
        'description' => 'Настройки поиска на вашем сайте',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'msearch2',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'msearch2',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      5 => 
      array (
        'text' => 'miniShop2',
        'parent' => 'components',
        'action' => 'mgr/orders',
        'description' => 'Продвинутый интернет-магазин',
        'icon' => '<i class="icon-shopping-cart icon icon-large"></i>',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'minishop2',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'minishop2',
        'children' => 
        array (
          0 => 
          array (
            'text' => 'Заказы',
            'parent' => 'minishop2',
            'action' => 'mgr/orders',
            'description' => 'Управление заказами',
            'icon' => '',
            'menuindex' => 0,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'minishop2',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'ms2_orders',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          1 => 
          array (
            'text' => 'Настройки',
            'parent' => 'minishop2',
            'action' => 'mgr/settings',
            'description' => 'Статусы заказов, параметры оплаты и доставки',
            'icon' => '',
            'menuindex' => 1,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'minishop2',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'ms2_settings',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          2 => 
          array (
            'text' => 'Системные настройки',
            'parent' => 'minishop2',
            'action' => 'system/settings',
            'description' => 'Системные настройки miniShop2',
            'icon' => '',
            'menuindex' => 2,
            'params' => '&ns=minishop2',
            'handler' => '',
            'permissions' => 'settings',
            'namespace' => 'core',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'ms2_system_settings',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          3 => 
          array (
            'text' => 'Помощь и поддержка',
            'parent' => 'minishop2',
            'action' => 'mgr/help',
            'description' => 'Полезные ссылки и информация',
            'icon' => '',
            'menuindex' => 3,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'minishop2',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'ms2_help',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          4 => 
          array (
            'text' => 'Утилиты',
            'parent' => 'minishop2',
            'action' => 'mgr/utilities',
            'description' => 'Инструменты разработчика',
            'icon' => '',
            'menuindex' => 4,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'minishop2',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'ms2_utilities',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
        ),
        'controller' => '',
      ),
      6 => 
      array (
        'text' => 'seoTemplates',
        'parent' => 'components',
        'action' => 'home',
        'description' => 'Управление шаблонами для SEO.',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'seotemplates',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'seotemplates',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      7 => 
      array (
        'text' => 'Конфигурация',
        'parent' => 'components',
        'action' => 'home',
        'description' => 'Установка и обновление конфигурации сайта.',
        'icon' => '<i class="icon icon-wrench"></i>',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'clientconfig',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'clientconfig',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      8 => 
      array (
        'text' => 'Sendex',
        'parent' => 'components',
        'action' => '11',
        'description' => 'Управление подписками',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'core',
        'action_controller' => 'index',
        'action_namespace' => 'sendex',
        'id' => 'sendex',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      9 => 
      array (
        'text' => 'Виды Коллекции',
        'parent' => 'components',
        'action' => 'home',
        'description' => 'Определите виды для таблицы дочерних ресурсов коллекции.',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'collections',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'collections.menu.collection_templates',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      10 => 
      array (
        'text' => 'modDevTools',
        'parent' => 'components',
        'action' => '6',
        'description' => 'Удобное управление элементами',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'view_chunk,view_template',
        'namespace' => 'core',
        'action_controller' => 'index',
        'action_namespace' => 'moddevtools',
        'id' => 'moddevtools',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      11 => 
      array (
        'text' => 'SEOroom',
        'parent' => 'components',
        'action' => '5',
        'description' => 'seoroom.menu_desc',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'core',
        'action_controller' => 'index',
        'action_namespace' => 'seoroom',
        'id' => 'seoroom',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      12 => 
      array (
        'text' => 'Console',
        'parent' => 'components',
        'action' => '4',
        'description' => 'Консоль для выполнения php-кода',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'console',
        'namespace' => 'core',
        'action_controller' => 'console',
        'action_namespace' => 'console',
        'id' => 'console',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      13 => 
      array (
        'text' => 'Gallery',
        'parent' => 'components',
        'action' => 'home',
        'description' => 'Управление альбомами.',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'gallery',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'gallery',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      14 => 
      array (
        'text' => 'FormIt',
        'parent' => 'components',
        'action' => 'home',
        'description' => 'Посмотреть все отправленные формы',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'formit',
        'namespace' => 'formit',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'formit',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      15 => 
      array (
        'text' => 'PackMan',
        'parent' => 'components',
        'action' => '10',
        'description' => 'A tool for creating simple Transport Packages.',
        'icon' => 'images/icons/plugin.gif',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'core',
        'action_controller' => 'index',
        'action_namespace' => 'packman',
        'id' => 'packman',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      16 => 
      array (
        'text' => 'MIGX',
        'parent' => 'components',
        'action' => 'index',
        'description' => '',
        'icon' => '',
        'menuindex' => 1,
        'params' => '&configs=migxconfigs||packagemanager',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'migx',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'migx',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      17 => 
      array (
        'text' => 'msImportExport',
        'parent' => 'components',
        'action' => '',
        'description' => '',
        'icon' => '',
        'menuindex' => 11,
        'params' => '',
        'handler' => '',
        'permissions' => '',
        'namespace' => 'msimportexport',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'msimportexport.cmenu.importexport',
        'children' => 
        array (
          0 => 
          array (
            'text' => 'Импорт',
            'parent' => 'msimportexport.cmenu.importexport',
            'action' => 'import',
            'description' => '',
            'icon' => '',
            'menuindex' => 0,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'msimportexport',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'msimportexport.cmenu.import',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          1 => 
          array (
            'text' => 'Экспорт',
            'parent' => 'msimportexport.cmenu.importexport',
            'action' => 'export',
            'description' => '',
            'icon' => '',
            'menuindex' => 1,
            'params' => '',
            'handler' => '',
            'permissions' => '',
            'namespace' => 'msimportexport',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'msimportexport.cmenu.export',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
        ),
        'controller' => '',
      ),
    ),
    'controller' => '',
  ),
  3 => 
  array (
    'text' => 'Управление',
    'parent' => 'topnav',
    'action' => '',
    'description' => '',
    'icon' => '',
    'menuindex' => 3,
    'params' => '',
    'handler' => '',
    'permissions' => 'menu_tools',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
    'id' => 'manage',
    'children' => 
    array (
      0 => 
      array (
        'text' => 'Пользователи',
        'parent' => 'manage',
        'action' => 'security/user',
        'description' => 'Добавление, обновление, и назначение прав пользователям',
        'icon' => '',
        'menuindex' => 0,
        'params' => '',
        'handler' => '',
        'permissions' => 'view_user',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'users',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      1 => 
      array (
        'text' => 'Очистить кэш',
        'parent' => 'manage',
        'action' => '',
        'description' => 'Очистить кэш сайта во всех контекстах',
        'icon' => '',
        'menuindex' => 1,
        'params' => '',
        'handler' => 'MODx.clearCache(); return false;',
        'permissions' => 'empty_cache',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'refresh_site',
        'children' => 
        array (
          0 => 
          array (
            'text' => 'Обновить URI-ссылки',
            'parent' => 'refresh_site',
            'action' => '',
            'description' => 'Перегенерировать URI ресурсов',
            'icon' => '',
            'menuindex' => 0,
            'params' => '',
            'handler' => 'MODx.refreshURIs(); return false;',
            'permissions' => 'empty_cache',
            'namespace' => 'core',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'refreshuris',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
        ),
        'controller' => '',
      ),
      2 => 
      array (
        'text' => 'Снять блокировки',
        'parent' => 'manage',
        'action' => '',
        'description' => 'Будут сняты все блокировки со страниц сайта. Эти блокировки являются результатом того, что другие пользователи редактируют эти страницы',
        'icon' => '',
        'menuindex' => 2,
        'params' => '',
        'handler' => 'MODx.removeLocks();return false;',
        'permissions' => 'remove_locks',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'remove_locks',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      3 => 
      array (
        'text' => 'Перезагрузить права доступа',
        'parent' => 'manage',
        'action' => '',
        'description' => 'Перезагрузить все права доступа и очистить кэш',
        'icon' => '',
        'menuindex' => 3,
        'params' => '',
        'handler' => 'MODx.msg.confirm({
    title: _(\'flush_access\')
    ,text: _(\'flush_access_confirm\')
    ,url: MODx.config.connector_url
    ,params: {
        action: \'security/access/flush\'
    }
    ,listeners: {
        \'success\': {fn:function() { location.href = \'./\'; },scope:this},
        \'failure\': {fn:function(response) { Ext.MessageBox.alert(\'failure\', response.responseText); },scope:this},
    }
});',
        'permissions' => 'access_permissions',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'flush_access',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      4 => 
      array (
        'text' => 'Завершить все сеансы',
        'parent' => 'manage',
        'action' => '',
        'description' => 'Завершить все сеансы работы пользователей и произвести принудительный выход из системы всех пользователей',
        'icon' => '',
        'menuindex' => 4,
        'params' => '',
        'handler' => 'MODx.msg.confirm({
    title: _(\'flush_sessions\')
    ,text: _(\'flush_sessions_confirm\')
    ,url: MODx.config.connector_url
    ,params: {
        action: \'security/flush\'
    }
    ,listeners: {
        \'success\': {fn:function() { location.href = \'./\'; },scope:this}
    }
});',
        'permissions' => 'flush_sessions',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'flush_sessions',
        'children' => 
        array (
        ),
        'controller' => '',
      ),
      5 => 
      array (
        'text' => 'Отчёты',
        'parent' => 'manage',
        'action' => '',
        'description' => 'Различные отчеты MODX для администратора',
        'icon' => '',
        'menuindex' => 5,
        'params' => '',
        'handler' => '',
        'permissions' => 'menu_reports',
        'namespace' => 'core',
        'action_controller' => NULL,
        'action_namespace' => NULL,
        'id' => 'reports',
        'children' => 
        array (
          0 => 
          array (
            'text' => 'Расписание сайта',
            'parent' => 'reports',
            'action' => 'resource/site_schedule',
            'description' => 'Просмотр расписания публикаций и снятия с публикации',
            'icon' => '',
            'menuindex' => 0,
            'params' => '',
            'handler' => '',
            'permissions' => 'view_document',
            'namespace' => 'core',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'site_schedule',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          1 => 
          array (
            'text' => 'Журнал системы управления',
            'parent' => 'reports',
            'action' => 'system/logs',
            'description' => 'Просмотр последних действий в системе управления',
            'icon' => '',
            'menuindex' => 1,
            'params' => '',
            'handler' => '',
            'permissions' => 'logs',
            'namespace' => 'core',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'view_logging',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          2 => 
          array (
            'text' => 'Журнал ошибок',
            'parent' => 'reports',
            'action' => 'system/event',
            'description' => 'Просмотреть журнал ошибок MODX',
            'icon' => '',
            'menuindex' => 2,
            'params' => '',
            'handler' => '',
            'permissions' => 'view_eventlog',
            'namespace' => 'core',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'eventlog_viewer',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
          3 => 
          array (
            'text' => 'Информация о системе',
            'parent' => 'reports',
            'action' => 'system/info',
            'description' => 'Просмотр информации о сервере, настройках PHP, информации о базе данных, и многое другое',
            'icon' => '',
            'menuindex' => 3,
            'params' => '',
            'handler' => '',
            'permissions' => 'view_sysinfo',
            'namespace' => 'core',
            'action_controller' => NULL,
            'action_namespace' => NULL,
            'id' => 'view_sysinfo',
            'children' => 
            array (
            ),
            'controller' => '',
          ),
        ),
        'controller' => '',
      ),
    ),
    'controller' => '',
  ),
  4 => 
  array (
    'text' => 'Конфигуратор',
    'parent' => 'topnav',
    'action' => 'home',
    'description' => 'Установка и обновление конфигурации сайта.',
    'icon' => '<i class="icon icon-wrench"></i>',
    'menuindex' => 4,
    'params' => '',
    'handler' => '',
    'permissions' => '',
    'namespace' => 'clientconfig',
    'action_controller' => NULL,
    'action_namespace' => NULL,
    'id' => 'Конфигуратор',
    'children' => 
    array (
    ),
    'controller' => '',
  ),
  5 => 
  array (
    'text' => 'Очистить кэш',
    'parent' => 'topnav',
    'action' => '',
    'description' => 'Очистить кэш сайта во всех контекстах',
    'icon' => '',
    'menuindex' => 5,
    'params' => '',
    'handler' => 'MODx.clearCache(); return false',
    'permissions' => 'empty_cache',
    'namespace' => 'core',
    'action_controller' => NULL,
    'action_namespace' => NULL,
    'id' => 'Очистить кэш',
    'children' => 
    array (
    ),
    'controller' => '',
  ),
  6 => 
  array (
    'text' => 'Памятка',
    'parent' => 'topnav',
    'action' => '',
    'description' => '',
    'icon' => '<span class="icon icon-puzzle-piece" style="font-size:19px;color:orange;"></span>',
    'menuindex' => 6,
    'params' => '',
    'handler' => 'var title = \'О заметках\';
var msg = \'Заметки можно оставлять в заметках пользователей. <br> admin -> Заметки\';
Ext.MessageBox.alert(title,msg);',
    'permissions' => '',
    'namespace' => '',
    'action_controller' => NULL,
    'action_namespace' => NULL,
    'id' => 'Памятка',
    'children' => 
    array (
    ),
    'controller' => '',
  ),
);