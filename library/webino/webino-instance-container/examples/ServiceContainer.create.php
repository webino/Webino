<?php

use Webino\ServiceContainer;
//:
use Webino\ServiceContainerInterface;

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
     * @param ServiceContainerInterface $services
     * @return MyService
     */
    static function create(ServiceContainerInterface $services): MyService
    {
        return new static($services->get(\stdClass::class));
    }

    /**
     * Example constructor
     *
     * @param \stdClass|\object $obj Some dependency
     */
    function __construct(\stdClass $obj)
    {

    }
    //!

    /**
     * Custom service method
     *
     * @return void
     */
    function myServiceMethod(): void
    {

    }
//:
}
//!

// Application object creation
/** @var ServiceContainerInterface $services */
$services = new ServiceContainer;

// Using custom service
/** @var MyService $myService */
$myService = $services->get(MyService::class);
$myService->myServiceMethod();