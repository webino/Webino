<?php

use Webino\ServiceContainer;
use Webino\ServiceContainerInterface;

/**
 * Class MyService
 *
 * Example service class
 */
class MyService
{
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
/** @var ServiceContainerInterface $services */
$services = new ServiceContainer;

//:
// Configuring service closure factory
$services->set(MyService::class, function (ServiceContainerInterface $services) {
    return new MyService($services->get(\stdClass::class));
});
//!

// Using custom service
/** @var MyService $myService */
$myService = $services->get(MyService::class);
$myService->myServiceMethod();
