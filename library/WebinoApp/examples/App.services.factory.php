<?php

//:
use Webino\App;
use Webino\ServiceFactoryInterface;
use Webino\ServiceContainerInterface;

/**
 * Class MyServiceServiceFactory
 *
 * Example service factory class
 */
class MyServiceServiceFactory implements ServiceFactoryInterface
{
    /**
     * Example service factory
     *
     * @param ServiceContainerInterface $services
     * @return MyService
     */
    public function create(ServiceContainerInterface $services): MyService
    {
        return new MyService($services->get(\stdClass::class));
    }
}

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
    public function __construct(\stdClass $obj)
    {

    }

    /**
     * Custom service method
     *
     * @return void
     */
    public function myServiceMethod(): void
    {

    }
}

// Application object creation
/** @var ServiceContainerInterface $app */
$app = App::create();

// Configuring service factory
$app->set(MyService::class, MyServiceServiceFactory::class);

// Using custom service
/** @var MyService $myService */
$myService = $app->get(MyService::class);
$myService->myServiceMethod();
//!
