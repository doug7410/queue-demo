<?php

namespace App\Database;

use xobotyi\beansclient\BeansClient;
use xobotyi\beansclient\Connection;

class DB
{
    private $connection;
    private static $instance = null;

    /**
     * DB constructor.
     * @throws \xobotyi\beansclient\Exception\Client
     * @throws \xobotyi\beansclient\Exception\Connection
     */
    private function __construct()
    {
        $host = '192.168.10.10';
        $connection  = new Connection($host, 11301, 2, true);
        $this->connection = new BeansClient($connection);
    }

    /**
     * @return BeansClient
     * @throws \xobotyi\beansclient\Exception\Client
     * @throws \xobotyi\beansclient\Exception\Connection
     */
    public static function connection()
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }

        return self::$instance->connection;
    }

}