<?php
namespace App\Jobs;

use App\Database\DB;
use App\Queue\Dispatchable;
use App\Queue\JobInterface;

class ProcessImageJob implements JobInterface
{
    use Dispatchable;

    private $image;
    private $productId;

    public function __construct($image, $productId)
    {
        $this->image = $image;
        $this->productId = $productId;
    }

    public function handle()
    {
        // process the image
        // resize, crop, watermark, etc ...
        sleep(1); // simulate processing the image
        DB::connection()->query(
            "UPDATE products SET image_processed = 1 WHERE id = {$this->productId}"
        );
    }

}