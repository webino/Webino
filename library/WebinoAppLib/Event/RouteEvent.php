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

use WebinoAppLib\Util\RouteEventNameResolver;

/**
 * Class RouteEvent
 */
class RouteEvent extends AbstractRouteEvent
{
    /**
     * Route event prefix
     */
    const PREFIX = 'route.';

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = RouteEventNameResolver::getEventName($name);
        return $this;
    }
}
