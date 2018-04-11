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
use Webino\Services\Exceptions\ContainerException;
use Webino\Services\ServiceContainer;
use Webino\Services\ServiceContainerInterface;

require __DIR__ . '/../../bootstrap.php';


class TestService
{

}


$services = new ServiceContainer;


$services->set(TestService::class, function (ServiceContainerInterface $services) {
    throw new \RuntimeException;
});


Assert::exception(
    function () use ($services) {
        $services->get(TestService::class);
    },
    ContainerException::class,
    'Cannot get valid container entry for id `TestService`'
);
