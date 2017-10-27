<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Router\Route\Regex;

use WebinoConfigLib\Router\RouteConstructorInterface as BaseRouteConstructorInterface;

/**
 * Interface RouteConstructorInterface
 */
interface RouteConstructorInterface extends BaseRouteConstructorInterface
{
    /**
     * {@inheritdoc}
     * @param string|null $spec Regex route spec.
     */
    public function __construct($route, $spec = null);
}
