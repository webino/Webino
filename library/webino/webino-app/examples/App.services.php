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
     * Custom service method
     *
     * @return void
     */
    function myServiceMethod(): void
    {

    }
}

// Application object creation
/** @var \Psr\Container\ContainerInterface $app */
$app = App::create();

// Using custom service
/** @var MyService $myService */
$myService = $app->get(MyService::class);
$myService->myServiceMethod();
//!
