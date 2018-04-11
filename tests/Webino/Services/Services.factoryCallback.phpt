<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Tester\Assert;
use Webino\Services\ServiceContainer;
use Webino\Services\ServiceContainerInterface;

require __DIR__ . '/../../bootstrap.php';


class TestService
{

}


$services = new ServiceContainer;
$service = new TestService;


$services->set(TestService::class, function (ServiceContainerInterface $services) use ($service) {
    return $service;
});


Assert::true($services->has(TestService::class));
Assert::same($service, $services->get(TestService::class));
