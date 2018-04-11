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
use Webino\Services\Factories\AbstractFactory;
use Webino\Services\ServiceContainer;
use Webino\Services\ServiceContainerInterface;

require __DIR__ . '/../../bootstrap.php';


class TestService
{

}

class TestServiceFactory extends AbstractFactory
{
    public $service;

    public function createService(ServiceContainerInterface $services)
    {
        return $this->service;
    }
}


$services = new ServiceContainer;
$factory = new TestServiceFactory;
$factory->service = new TestService;


$services->set(TestService::class, $factory);


Assert::true($services->has(TestService::class));
Assert::same($factory->service, $services->get(TestService::class));
