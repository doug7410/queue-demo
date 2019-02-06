<?php

use App\Jobs\ImportProductsJob;

include __DIR__ . '/../../vendor/autoload.php';


$file = __DIR__.'/../../files/products.csv';

ImportProductsJob::dispatch($file);

echo "Dispatched import products job to queue \r\n";