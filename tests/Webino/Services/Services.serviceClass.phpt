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

require __DIR__ . '/../../bootstrap.php';


class TestService
{

}


$services = new ServiceContainer;


$services->set(TestService::class, TestService::class);


Assert::true($services->has(TestService::class));
Assert::type(TestService::class, $services->get(TestService::class));
