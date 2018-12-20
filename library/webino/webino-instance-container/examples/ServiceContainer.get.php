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
/** @var \Psr\Container\ContainerInterface $services */
$services = new ServiceContainer;

//:
// Getting custom service
/** @var MyService $myService */
$myService = $services->get(MyService::class);
//!
$myService->myServiceMethod();
