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
    public function create(ServiceContainerInterface $services)
    {
        return new TestService;
    }
}


$services = new ServiceContainer;


$services->set(TestService::class, TestServiceFactory::class);


Assert::true($services->has(TestService::class));
Assert::type(TestService::class, $services->get(TestService::class));
