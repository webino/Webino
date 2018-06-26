<?php

use Tester\Assert;
use Webino\ServiceContainer;

require '../bootstrap.php';


class TestService
{

}


$services = new ServiceContainer;

$services->set(TestService::class, null);


$testService = $services->get(TestService::class);


Assert::null($testService);
