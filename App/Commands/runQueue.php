<?php

use App\Queue\QueueRunner;

include __DIR__ . '/../../vendor/autoload.php';

$queue = new QueueRunner();
$queue->run();

