<?php

namespace App\Queue;


use App\Database\DB;

class Dispatcher
{
    private $job;

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function __destruct()
    {
        $db = new DB();
        $payload = serialize(['job' => $this->job]);
        $query = $db->connection->prepare("INSERT INTO jobs (payload) VALUES (?)");
        $query->execute([$payload]);
    }
}