<?php

use Webino\ServiceContainer;

//:

/**
 * Interface MyServiceInterface
 *
 * Example service interface
 */
interface MyServiceInterface
{
//!
    /**
     * Example service interface method
     *
     * @return void
     */
    public function myServiceMethod(): void;
//:

}
//!

//:

/**
 * Class MyService
 *
 * Example service
 */
class MyService implements MyServiceInterface
{
//!
    /**
     * Example service method
     *
     * @return void
     */
    public function myServiceMethod(): void
    {

    }
//:

}
//!

// Creating a service container
/** @var \Psr\Container\ContainerInterface $services */
$services = new ServiceContainer;

//:

// Setting custom service
$services->set(MyServiceInterface::class, MyService::class);

// Getting custom service
/** @var MyServiceInterface $myService */
$myService = $services->get(MyServiceInterface::class);
//!
$myService->myServiceMethod();
