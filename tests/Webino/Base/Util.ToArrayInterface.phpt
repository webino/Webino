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
use Webino\Base\Util\ToArrayInterface;

require __DIR__ . '/../../bootstrap.php';


class TestObject implements ToArrayInterface
{
    public function toArray() : array
    {
        return [];
    }
}


$obj = new TestObject;
$array = $obj->toArray();


Assert::same([], $array);
