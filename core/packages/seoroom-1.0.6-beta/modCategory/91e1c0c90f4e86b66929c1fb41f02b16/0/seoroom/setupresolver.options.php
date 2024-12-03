<?php

global $modx;

$success = false;
switch (@$options[xPDOTransport::PACKAGE_ACTION]) {

    case xPDOTransport::ACTION_INSTALL:

    case xPDOTransport::ACTION_UPGRADE:

        //add menu
        if(isset($options['menu_position'])){

            $action = $object->xpdo->getObject('modAction', array(
                'namespace' => $options['namespace']
            ));
            if(!$action){
                $action = $object->xpdo->newObject('modAction');
                $action->set('namespace', $options['namespace']);
                $action->set('controller', 'index');
                $action->set('haslayout', '1');
                $action->set('lang_topics', $options['namespace'].':default,lexicon');
                if(!$action->save()){
                    $object->pdo->log(xPDO::LOG_LEVEL_ERROR, 'Не удалось добавить действие');
                    return $success;
                }
            }

            $menu = $object->xpdo->getObject('modMenu', array(
                'text' => $options['namespace']
            ));
            if(!$menu){
                $menu = $object->xpdo->newObject('modMenu');
                $menu->set('text', $options['namespace']);
                $menu->set('parent', $options['menu_position']);
                $menu->set('action', $action->get('id'));
                $menu->set('description', $options['namespace'].'.menu_desc');
                $menu->set('icon', 'images/icons/plugin.gif');
                if(!$menu->save()){
                    $object->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Не удалось добавить меню');
                    return $success;
                }
            }elseif($menu->get('action') != $action->get('id')){
                $menu->set('action', $action->get('id'));
                if(!$menu->save()){
                    $object->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Не удалось обновить меню');
                    return $success;
                }
            }

            $object->xpdo->log(xPDO::LOG_LEVEL_INFO, 'Добавлено меню для компонента');
            $success = true;

        }

        //add robots.txt and sitemap.xml
        if(isset($options['host_name'])){

            $success = false;

            //robots.txt
            $host_name = (trim($options['host_name']) != '') ? $options['host_name'] : MODX_HTTP_HOST;

            $content =  'User-agent: *'.PHP_EOL;

            $response = $modx->runProcessor('browser/directory/getlist', array());
            if($response->isError()){
                $object->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Не удалось получить список директорий, ошибка: '.$response->getMessage());
                return $success;
            }
            $dirs = json_decode($response->response, true);

            //Disallows
            for($x = 0; $x < count($dirs); $x++){

                if($dirs[$x]['id'] != 'artmebius/' && $dirs[$x]['id'] != 'images/' && $dirs[$x]['id'] != 'assets/'){
                    $content .= 'Disallow: /'.$dirs[$x]['id'].PHP_EOL;
                }

            }

            $content .= PHP_EOL.'Disallow: /search';
            $content .= PHP_EOL.'Disallow: *?*';
            $content .= PHP_EOL.'Disallow: /assets/';

            //Allows
            $find_dirs = array(
                'cache',
                'web'
            );

            function findAllows($dirs, $modx, $find_dirs, $object){
                $content = '';
                for($x = 0; $x < count($dirs); $x++){
                    if(array_search($dirs[$x]['text'], $find_dirs) !== false){
                        $content .= PHP_EOL.'Allow: /'.$dirs[$x]['id'];
                        continue;
                    }
                    if($dirs[$x]['type'] != 'dir') continue;
                    $response = $modx->runProcessor('browser/directory/getlist', array('id' => $dirs[$x]['id']));
                    $content .= findAllows(json_decode($response->response, true), $modx, $find_dirs, $object);
                }
                return $content;
            }
            $response = $modx->runProcessor('browser/directory/getlist', array('id' => 'assets/'));
            if($response->isError()){
                $object->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Не удалось получить список директорий по id assets/, ошибка: '.$response->getMessage());
                return $success;
            }
            $content .= findAllows(
                json_decode($response->response, true),
                $modx,
                $find_dirs,
                $object
            );

            $content .= PHP_EOL;
            $content .= 'Host: '.$host_name.PHP_EOL;
            $content .= 'Sitemap: '.MODX_URL_SCHEME.$host_name.'/sitemap.xml';

            $response = $modx->runProcessor('browser/file/create', array(
                'file' => $modx->getOption('base_path'),
                'name' => 'robots.txt',
                'content' => $content
            ));
            if($response->isError()){
                $object->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Не удалось создать файл robots.txt, ошибка: '.$response->getMessage());
            }
            $object->xpdo->log(xPDO::LOG_LEVEL_INFO, 'Создан и заполнен файл robots.txt');

            //sitemap.xml доделать, реализовать интерфейс в setup.option для исключений из sitemap.xml
//            @ini_set('memory_limit', '512M');

//            $resources =

//            $response = $modx->runProcessor('browser/file/create', array(
//                'file' => $modx->getOption('base_path'),
//                'name' => 'sitemap.xml',
//                'content' => ''
//            ));
//            if($response->isError()){
//                $object->xpdo->log(xPDO::LOG_LEVEL_ERROR, 'Не удалось создать файл sitemap.xml, ошибка: '.$response->getMessage());
//            }
//            $object->xpdo->log(xPDO::LOG_LEVEL_INFO, 'Создан пустой файл sitemap.xml');

            $success = true;

        }



        break;

    case xPDOTransport::ACTION_UNINSTALL:
        //удалить меню
        $success = true;
        break;
}
return $success;

?>