<?php

use Tester\Assert;
use Webino\ServiceContainer;

class TestService
{
    function __invoke(\stdClass $obj)
    {
    }
}


$services = new ServiceContainer;


$testService = $services->get(TestService::class);


Assert::type(TestService::class, $testService);
