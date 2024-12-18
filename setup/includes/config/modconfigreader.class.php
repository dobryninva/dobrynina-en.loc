<?php
/*
 * This file is part of MODX Revolution.
 *
 * Copyright (c) MODX, LLC. All Rights Reserved.
 *
 * For complete copyright and license information, see the COPYRIGHT and LICENSE
 * files found in the top-level directory of this distribution.
 */
/*
 * This file is part of MODX Revolution.
 *
 * Copyright (c) MODX, LLC. All Rights Reserved.
 *
 * For complete copyright and license information, see the COPYRIGHT and LICENSE
 * files found in the top-level directory of this distribution.
 */
abstract class modConfigReader {
    /** @var modInstall $install */
    public $install;
    /** @var xPDO $xpdo */
    public $xpdo;
    /** @var array $config */
    public $config = array();

    function __construct(modInstall $install,array $config = array()) {
        $this->install =& $install;
        $this->xpdo =& $install->xpdo;
        $this->config = array_merge(array(

        ),$config);
    }

    /**
     * Read an existing configuration file
     * @abstract
     * @param array $config
     */
    abstract public function read(array $config = array());

    /**
     * Load defaults for a configuration file if one does not exist; used in new installations
     * @param array $config
     * @return array
     */
    public function loadDefaults(array $config = array()) {
        $this->getHttpHost();

        $this->config = array_merge($this->config,array(
            'database_type' => isset ($_POST['databasetype']) ? $_POST['databasetype'] : 'mysql',
            'database_server' => isset ($_POST['databasehost']) ? $_POST['databasehost'] : 'localhost',
            'database_connection_charset' => 'utf8',
            'database_charset' => 'utf8',
            'dbase' => trim((isset ($_POST['database_name']) ? $_POST['database_name'] : 'modx'), '`[]'),
            'database_user' => isset ($_POST['databaseloginname']) ? $_POST['databaseloginname'] : '',
            'database_password' => isset ($_POST['databaseloginpassword']) ? $_POST['databaseloginpassword'] : '',
            'table_prefix' => isset ($_POST['tableprefix']) ? $_POST['tableprefix'] : 'modx_',
            'site_sessionname' => 'SN' . uniqid(''),
            'inplace' => isset ($_POST['inplace']) ? 1 : 0,
            'unpacked' => isset ($_POST['unpacked']) ? 1 : 0,
            'config_options' => array(),
            'driver_options' => array(),
        ),$config);
        return $this->config;
    }

    /**
     * Get the HTTP host for the server
     */
    public function getHttpHost() {
        if (php_sapi_name() != 'cli') {
            $this->config['https_port'] = isset($_POST['httpsport']) ? $_POST['httpsport'] : 443;
            $this->config['http_host'] = parse_url('http://' . $_SERVER['HTTP_HOST'], PHP_URL_HOST);
            $this->config['http_port'] = parse_url('http://' . $_SERVER['HTTP_HOST'], PHP_URL_PORT);
            $this->config['http_host'] .= in_array($this->config['http_port'], [null , 80, 443]) ? '' : ':' . $this->config['http_port'];
        } else {
            $this->config['http_host'] = 'localhost';
            $this->config['https_port'] = 443;
        }
    }
}
