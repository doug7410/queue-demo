<?php

namespace App\Database;

use PDO;
use PDOException;

class DB
{
    public $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host=192.168.10.10;dbname=super-queue", "homestead", "secret");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

}