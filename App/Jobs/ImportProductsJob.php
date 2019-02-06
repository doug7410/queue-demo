<?php
namespace App\Jobs;

use App\Database\DB;
use App\Queue\Dispatchable;
use App\Queue\JobInterface;

class ImportProductsJob implements JobInterface
{
    use Dispatchable;


    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function handle()
    {
        $csv = array_map('str_getcsv', file($this->file));
        array_shift($csv); // remove the header row

        foreach ($csv as $values) {
            $query = DB::connection()->prepare(
                "INSERT INTO products (name, price, image) VALUES (?,?,?)"
            );
            $query->execute($values);
            $productId = DB::connection()->lastInsertId();
            $image = $values[2];
            ProcessImageJob::dispatch($image, $productId); //->onQueue('products');
        }
    }

}