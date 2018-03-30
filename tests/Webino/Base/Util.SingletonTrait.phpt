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
use Webino\Base\Util\SingletonTrait;

require __DIR__ . '/../../bootstrap.php';


class TestSingleton
{
    use SingletonTrait;

    public function __invoke() : string
    {
        return 'do something...';
    }

    public static function doSomethingStatic() : string
    {
        return static::getInstance()->__invoke();
    }
}


$result = TestSingleton::doSomethingStatic();


Assert::same('do something...', $result);
