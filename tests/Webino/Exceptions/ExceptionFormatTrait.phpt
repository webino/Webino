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
use Webino\Exceptions\ExceptionFormatTrait;

require __DIR__ . '/../../bootstrap.php';


class TestException extends \Exception
{
    use ExceptionFormatTrait;
}


$excOne = (new TestException('Expected %s not %s'))
    ->format('something', 'anything');

$excTwo = (new TestException('Expected %s not %s'))
    ->format(new ArrayObject, new stdClass);

$excThree = (new TestException('Expected %s not %s'))
    ->format(['foo' => 'bar'], ['bar' => 'foo']);


Assert::exception(function() use ($excOne) {
    throw $excOne;
}, 'TestException', 'Expected `something` not `anything`');

Assert::exception(function() use ($excTwo) {
    throw $excTwo;
}, 'TestException', 'Expected `ArrayObject` not `stdClass`');

Assert::exception(function() use ($excThree) {
    throw $excThree;
}, 'TestException', 'Expected Array
(
    [foo] => bar
)
 not Array
(
    [bar] => foo
)
');
