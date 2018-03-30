<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Router;

/**
 * Interface RouteConstructorInterface
 */
interface RouteConstructorInterface
{
    /**
     * @param string|array $route Route path
     * @throws \WebinoConfigLib\Exception\InvalidArgumentException
     */
    public function __construct($route);
}
