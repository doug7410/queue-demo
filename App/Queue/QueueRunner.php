<?php

namespace App\Queue;

use App\Database\DB;

class QueueRunner
{
    public function run()
    {
        $db = new DB();

        while (true) {
            $job = $db->connection->query(
                "SELECT * FROM jobs WHERE running = 0 ORDER BY created_at LIMIT 1"
            )->fetchObject();

            if(!$job){
                sleep(1);
                continue;
            }

            $db->connection->query("UPDATE jobs SET running = 1 WHERE id = '{$job->id}'");
            $jobObject = unserialize($job->payload)['job'];
            $jobClass = get_class($jobObject);

            try {
                echo "[".date('Y-m-d H:i:s')."][{$job->id}] Processing Job {$jobClass} \r\n";
                $jobObject->handle();
                echo "[".date('Y-m-d H:i:s')."][{$job->id}] Processed Job {$jobClass} \r\n";

            } catch (\Exception $e) {
                echo "[".date('Y-m-d H:i:s')."][{$job->id}] Job {$jobClass} failed: {$e->getMessage()} \r\n";
            }

            $db->connection->query("DELETE FROM jobs WHERE id = {$job->id}");
        }

    }
}