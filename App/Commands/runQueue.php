<?php

use App\Queue\QueueRunner;

include __DIR__ . '/../../vendor/autoload.php';

$options = getopt('', ["queue::"]);
$queue = array_key_exists('queue', $options) ? $options['queue'] : null;

$queue = new QueueRunner($queue);
$queue->run();

