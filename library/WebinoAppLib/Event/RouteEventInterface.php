<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Event;

/**
 * Interface RouteEventInterface
 */
interface RouteEventInterface
{
    /**
     * Route matched
     */
    const MATCH = 'routeMatch';

    /**
     * Can't match the route
     */
    const NO_MATCH = 'routeNoMatch';
}
