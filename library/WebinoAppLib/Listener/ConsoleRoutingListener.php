<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\DispatchEvent;

/**
 * Class ConsoleRoutingListener
 */
final class ConsoleRoutingListener extends AbstractRoutingListener
{
    /**
     * @param DispatchEvent $event
     * @return self
     */
    protected function createRouteEvent(DispatchEvent $event)
    {
        return new ConsoleEvent($event);
    }
}
