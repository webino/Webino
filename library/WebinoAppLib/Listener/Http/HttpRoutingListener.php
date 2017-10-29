<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Listener\Http;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;
use WebinoAppLib\Listener\AbstractRoutingListener;

/**
 * Class HttpRoutingListener
 */
final class HttpRoutingListener extends AbstractRoutingListener
{
    /**
     * @param DispatchEvent $event
     * @return RouteEvent
     */
    protected function createRouteEvent(DispatchEvent $event)
    {
        return new RouteEvent($event);
    }
}
