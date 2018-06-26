<?php

use Tester\Assert;
use Webino\ServiceContainer;

require '../bootstrap.php';


class TestService
{
    public function __invoke(\stdClass $obj)
    {

    }
}


$services = new ServiceContainer;


$testService = $services->get(TestService::class);


Assert::type(TestService::class, $testService);
