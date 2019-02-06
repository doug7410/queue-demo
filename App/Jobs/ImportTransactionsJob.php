<?php

namespace App\Jobs;

use App\Database\DB;
use App\Queue\Dispatchable;
use App\Queue\JobInterface;

class ImportTransactionsJob implements JobInterface
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
        $headerRow = array_shift($csv);

        foreach ($csv as $values) {
            $fields = implode(',',$headerRow);

            $query = DB::connection()->prepare(
                "INSERT INTO transactions ({$fields}) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)"
            );
            $query->execute($values);
        }
    }
}