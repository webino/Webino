<?php

use Webino\ServiceContainer;

/**
 * Class MyService
 *
 * Example service
 */
class MyService
{
    /**
     * Example service method
     *
     * @return void
     */
    function myServiceMethod(): void
    {

    }
}

// Creating a service container
/** @var \Webino\ServiceContainerInterface $services */
$services = new ServiceContainer;

//:

// Setting custom service
$services->set(MyService::class, new MyService);
//!

// Getting custom service
/** @var MyServiceInterface $myService */
$myService = $services->get(MyService::class);
$myService->myServiceMethod();
