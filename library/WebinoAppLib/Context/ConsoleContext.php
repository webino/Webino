<?php

namespace WebinoAppLib\Context;

use WebinoAppLib\Event\AppEvent;

/**
 * Class ConsoleContext
 */
class ConsoleContext extends AbstractContext
{
    /**
     * Returns true for CLI environment
     *
     * @param AppEvent $event
     * @return bool
     */
    public function contextMatch(AppEvent $event)
    {
        return $event->getApp()->isConsole();
    }
}
