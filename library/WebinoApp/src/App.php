<?php

namespace Webino;

use Webino\Handler\ResponseHandler;

/**
 * Class App
 */
class App extends AbstractApp
{
    /**
     * Return an application object
     *
     * @return AppInterface
     */
    public static function create(): AppInterface
    {
        $app = new static;
        $app->on(ResponseHandler::class);
        return $app;
    }
}
