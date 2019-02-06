<?php

include __DIR__ . '/../../vendor/autoload.php';

use App\Jobs\ImportTransactionsJob;

$file = __DIR__.'/../../files/transactions.csv';

for($i=0; $i<10; $i++) {
    ImportTransactionsJob::dispatch($file);//->onQueue('queue_2');
    echo "sent file to the queue for processing \r\n";
}
