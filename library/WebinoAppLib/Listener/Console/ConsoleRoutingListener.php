<?php

namespace WebinoAppLib\Listener\Console;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Listener\AbstractRoutingListener;

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
