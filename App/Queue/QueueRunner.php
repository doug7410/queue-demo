<?php

namespace App\Queue;


use App\Database\DB;

class QueueRunner
{
    private $queue;

    public function __construct($queue = null)
    {
        $this->queue = $queue ?: 'default';
    }

    /**
     * @throws \xobotyi\beansclient\Exception\Client
     * @throws \xobotyi\beansclient\Exception\Command
     * @throws \xobotyi\beansclient\Exception\Connection
     * @throws \xobotyi\beansclient\Exception\Job
     */
    public function run()
    {
        while (true) {
            $job = DB::connection()->watchTube($this->queue)->reserve();

            if ($job->id) {
                $jobObject = unserialize($job->payload)['job'];
                $jobClass = get_class($jobObject);

                try {
                    echo "[".date('Y-m-d H:i:s')."][{$job->id}] Processing Job {$jobClass} \r\n";
                    $jobObject->handle();
                    echo "[".date('Y-m-d H:i:s')."][{$job->id}] Processed Job {$jobClass} \r\n";

                } catch (\Exception $e) {
                    echo "[".date('Y-m-d H:i:s')."][{$job->id}] Job {$jobClass} failed: {$e->getMessage()} \r\n";
                }

                $job->delete();
            }
        }
    }
}