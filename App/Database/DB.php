<?php

namespace App\Database;

use PDO;
use PDOException;

class DB
{
    private $connection;
    private static $instance = null;

    private function __construct()
    {
        $host = '192.168.10.10';
        $database = 'super-queue';
        $user = 'homestead';
        $password = 'secret';

        try {
            $this->connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function connection()
    {
        if (self::$instance === null) {
            self::$instance = new DB();
        }

        return self::$instance->connection;
    }

}