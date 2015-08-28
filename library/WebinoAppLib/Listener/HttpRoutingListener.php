<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Event\RouteEvent;

/**
 * Class HttpRoutingListener
 */
final class HttpRoutingListener extends AbstractRoutingListener
{
    /**
     * @param DispatchEvent $event
     * @return self
     */
    protected function createRouteEvent(DispatchEvent $event)
    {
        return new RouteEvent($event);
    }
}
