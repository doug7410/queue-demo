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

    /**
     * @throws \xobotyi\beansclient\Exception\Client
     * @throws \xobotyi\beansclient\Exception\Command
     * @throws \xobotyi\beansclient\Exception\Connection
     * @throws \xobotyi\beansclient\Exception\Job
     */
    public function __destruct()
    {
        $payload = serialize(['job' => $this->job]);
        DB::connection()->useTube($this->queue)->put($payload);
    }
}