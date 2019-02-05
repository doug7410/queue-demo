<?php

include __DIR__ . '/../../vendor/autoload.php';

use \App\Jobs\SendEmailJob;

SendEmailJob::dispatch($_POST['email_address'])->onQueue($_POST['queue']);

echo json_encode(['success']);
