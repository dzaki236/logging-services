<?php

namespace Dzaki236\LoggingServices;

use Illuminate\Support\Facades\Facade;

class LoggingServices extends Facade
{
    /**
     * Get the binding in the IoC container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'logging-services';
    }
}