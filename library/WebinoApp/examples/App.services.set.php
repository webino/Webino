<?php

//:
use Webino\App;

/**
 * Interface MyServiceInterface
 *
 * Example service interface
 */
interface MyServiceInterface
{
    public function myServiceMethod();
}

/**
 * Class MyService
 *
 * Example service class
 */
class MyService implements MyServiceInterface
{
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
/** @var \Webino\ServiceContainerInterface $app */
$app = App::create();

// Setting custom service
$app->set(MyServiceInterface::class, MyService::class);

// Using custom service
/** @var MyServiceInterface $myService */
$myService = $app->get(MyServiceInterface::class);
$myService->myServiceMethod();
//!
