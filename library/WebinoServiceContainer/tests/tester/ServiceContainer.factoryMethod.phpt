<?php

use Tester\Assert;
use Webino\ServiceContainer;

class TestService
{
    public static function create(ServiceContainer $services)
    {
        return new static($services->get(\stdClass::class));
    }

    public function __construct(\stdClass $obj)
    {
    }
}


$services = new ServiceContainer;


$testService = $services->get(TestService::class);


Assert::type(TestService::class, $testService);
