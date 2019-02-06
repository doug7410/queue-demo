<?php

include __DIR__ . '/../../vendor/autoload.php';

use App\Database\DB;

$file = __DIR__.'/../../files/products.csv';

$csv = array_map('str_getcsv', file($file));
$headerRow = array_shift($csv);

foreach ($csv as $values) {
    $fields = implode(',',$headerRow);

    $query = DB::connection()->prepare(
        "INSERT INTO products (name, price, image) VALUES (?,?,?)"
    );
    $query->execute($values);
    $productId = DB::connection()->lastInsertId();

    // process the image
    // resize, crop, watermark, etc ...
    sleep(1); // simulate processing the image

    DB::connection()->query("UPDATE products SET image_processed = 1 WHERE id = {$productId}");
}