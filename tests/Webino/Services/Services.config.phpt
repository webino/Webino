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
    public function createService(ServiceContainerInterface $services)
    {
        return new TestService;
    }
}


$config = [

    // class
    TestService::class,

    'A' => TestService::class,

    // object
    'B' => new TestService,

    // factory callback
    'C' => function () {
        return new TestService;
    },

    // factory class
    'D' => TestServiceFactory::class,

    // factory object
    'E' => new TestServiceFactory,
];

$services = new ServiceContainer($config);


Assert::true($services->has(TestService::class));
Assert::true($services->has('A'));
Assert::true($services->has('B'));
Assert::true($services->has('C'));
Assert::true($services->has('D'));
Assert::true($services->has('E'));
Assert::type(TestService::class, $services->get(TestService::class));
Assert::type(TestService::class, $services->get('A'));
Assert::type(TestService::class, $services->get('B'));
Assert::type(TestService::class, $services->get('C'));
Assert::type(TestService::class, $services->get('D'));
Assert::type(TestService::class, $services->get('E'));
