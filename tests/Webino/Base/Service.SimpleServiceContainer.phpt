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
use Webino\Base\Service\SimpleServiceContainer;

require __DIR__ . '/../../bootstrap.php';


$services = new SimpleServiceContainer;
$service = new stdClass;
$services->set(stdClass::class, $service);
$has = $services->has(stdClass::class);
$result = $services->get(stdClass::class);


Assert::true($has);
Assert::same($service, $result);
