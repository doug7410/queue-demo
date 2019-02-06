<?php

include __DIR__ . '/../../vendor/autoload.php';

use App\Database\DB;

$file = __DIR__.'/../../files/transactions.csv';


for($i=0; $i<5; $i++) {
    $csv = array_map('str_getcsv', file($file));
    $headerRow = array_shift($csv);

    foreach ($csv as $values) {
        $fields = implode(',',$headerRow);

        $query = DB::connection()->prepare(
            "INSERT INTO transactions ({$fields}) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"
        );
        $query->execute($values);
    }

    echo 'done inserting ' . count($csv) . " transactions \r\n";
}
