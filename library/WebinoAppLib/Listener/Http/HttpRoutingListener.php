<?php

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
     * @return $this
     */
    protected function createRouteEvent(DispatchEvent $event)
    {
        return new RouteEvent($event);
    }
}
