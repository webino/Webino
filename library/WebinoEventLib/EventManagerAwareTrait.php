<?php

namespace WebinoEventLib;

use Zend\EventManager\EventManagerAwareTrait as BaseEventManagerAwareTrait;
use Zend\EventManager\EventManagerInterface;

/**
 * Class EventManagerAwareTrait
 */
trait EventManagerAwareTrait
{
    use BaseEventManagerAwareTrait;

    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        if (!$this->events instanceof EventManagerInterface) {
            $this->setEventManager(new EventManager);
        }
        return $this->events;
    }
}
