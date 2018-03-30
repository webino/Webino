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
use Webino\Base\Util\AsString;

require __DIR__ . '/../../bootstrap.php';


class TestStringObject
{
    public function __toString()
    {
        return __CLASS__;
    }
}


$arrayString = AsString::value(['Item1', 'Item2', 'Item3']);
$objectString = AsString::value(new TestStringObject);


Assert::same('Item1Item2Item3', $arrayString);
Assert::same(TestStringObject::class, $objectString);
