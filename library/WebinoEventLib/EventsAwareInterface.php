<?php

namespace WebinoEventLib;

use Zend\EventManager\EventManagerInterface;

/**
 * Interface EventsAwareInterface
 */
interface EventsAwareInterface
{
    /**
     * Inject an EventManager instance
     *
     * @param EventManagerInterface $eventManager
     * @return void
     */
    public function setEvents(EventManagerInterface $eventManager);
}
