<?php

namespace WebinoEventLib;

/**
 * Interface EventsCapableInterface
 */
interface EventsCapableInterface
{
    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return \Zend\EventManager\EventManagerInterface
     */
    public function getEvents();
}
