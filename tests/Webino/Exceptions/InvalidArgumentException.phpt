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
use Webino\Exceptions\InvalidArgumentException;

require __DIR__ . '/../../bootstrap.php';


class TestException extends InvalidArgumentException
{

}


$exc = (new TestException('Expected %s not %s'))
    ->format('something', 'anything');


Assert::exception(function() use ($exc) {
    throw $exc;
}, 'TestException', 'Expected `something` not `anything`');
