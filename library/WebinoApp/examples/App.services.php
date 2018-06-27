<?php

//example
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
    public function myServiceMethod()
    {

    }
}

// Application object creation
$app = App::create();

// Using custom service
/** @var MyService $myService */
$myService = $app->get(MyService::class);
$myService->myServiceMethod();
///example
