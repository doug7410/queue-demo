<?php

namespace App\Queue;


use App\Database\DB;

class Dispatcher
{
    private $job;
    private $queue = 'default';

    public function __construct($job)
    {
        $this->job = $job;
    }

    public function onQueue($queue)
    {
        $this->queue = $queue;
    }

    public function __destruct()
    {
        $db = new DB();
        $payload = serialize(['job' => $this->job]);
        $query = $db->connection->prepare("INSERT INTO jobs (queue, payload) VALUES (?, ?)");
        $query->execute([$this->queue, $payload]);
    }
}