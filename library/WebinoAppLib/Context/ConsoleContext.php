<?php

namespace WebinoAppLib\Context;

use WebinoAppLib\Event\AppEvent;

/**
 * Class ConsoleContext
 */
class ConsoleContext extends AbstractContext
{
    /**
     * Context key
     */
    const KEY = 'console';

    /**
     * @return string
     */
    protected function getKey()
    {
        return $this::KEY;
    }

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
