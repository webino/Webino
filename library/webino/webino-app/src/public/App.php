<?php

namespace Webino;

/**
 * Class App
 * @package webino-app
 */
class App extends AbstractApp
{
    /**
     * Return an application object
     *
     * @return AppInterface
     */
    static function make(): AppInterface
    {
        $app = new static;
        $app->on(ResponseHandler::class);
        return $app;
    }
}
