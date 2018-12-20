<?php

use Tester\Assert;
use Webino\ServiceContainer;

class TestService
{
    function __construct(\stdClass $obj)
    {
    }
}


$services = new ServiceContainer;

$services->set(TestService::class, function (ServiceContainer $services) {
    return new TestService($services->get(\stdClass::class));
});


$testService = $services->get(TestService::class);


Assert::type(TestService::class, $testService);