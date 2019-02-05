<?php

namespace App\Queue;

interface JobInterface
{
    public function handle();

    public static function dispatch();
}