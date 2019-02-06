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
        $payload = serialize(['job' => $this->job]);
        $query = DB::connection()->prepare("INSERT INTO jobs (payload) VALUES (?)");
        $query->execute([$payload]);
    }
}