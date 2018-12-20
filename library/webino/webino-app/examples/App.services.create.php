<?php

//:
use Webino\App;

/**
 * Class MyService
 *
 * Example service class
 */
class MyService
{
    /**
     * Example service factory
     *
     * @param App $app
     * @return MyService
     */
    static function create(App $app): MyService
    {
        return new static($app->get(\stdClass::class));
    }

    /**
     * Example constructor
     *
     * @param \stdClass|\object $obj Some dependency
     */
    function __construct(\stdClass $obj)
    {

    }

    /**
     * Custom service method
     *
     * @return void
     */
    function myServiceMethod(): void
    {

    }
}

// Application object creation
/** @var \Webino\ServiceContainerInterface $app */
$app = App::create();

// Using custom service
/** @var MyService $myService */
$myService = $app->get(MyService::class);
$myService->myServiceMethod();
//!