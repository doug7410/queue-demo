<?php

namespace App\Queue;

trait Dispatchable
{

    /**
     * @return Dispatcher
     */
    public static function dispatch()
    {
        return new Dispatcher(new static(...func_get_args()));
    }
}