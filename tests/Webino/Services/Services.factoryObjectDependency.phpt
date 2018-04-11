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

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function createService(ServiceContainerInterface $services)
    {
        return $this->service;
    }
}


$services = new ServiceContainer;
$service = new TestService;


$services->set(TestServiceFactory::class, function (ServiceContainerInterface $services) use ($service) {
    return new TestServiceFactory($service);
});

$services->set(TestService::class, TestServiceFactory::class);


Assert::true($services->has(TestService::class));
Assert::same($service, $services->get(TestService::class));
