<?php

namespace WebinoEventLib;

use Traversable;
use Zend\EventManager\EventManagerInterface;

/**
 * Class EventsAwareTrait
 */
trait EventsAwareTrait
{
    /**
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * Set the event manager instance used by this context.
     *
     * For convenience, this method will also set the class name / LSB name as
     * identifiers, in addition to any string or array of strings set to the
     * $this->eventIdentifier property.
     *
     * @param EventManagerInterface $events
     * @return mixed
     */
    public function setEvents(EventManagerInterface $events)
    {
        $identifiers = [__CLASS__, get_class($this)];
        if (isset($this->eventIdentifier)) {
            if ((is_string($this->eventIdentifier))
                || (is_array($this->eventIdentifier))
                || ($this->eventIdentifier instanceof Traversable)
            ) {
                $identifiers = array_unique(array_merge($identifiers, (array) $this->eventIdentifier));
            } elseif (is_object($this->eventIdentifier)) {
                $identifiers[] = $this->eventIdentifier;
            }
            // silently ignore invalid eventIdentifier types
        }
        $events->setIdentifiers($identifiers);
        $this->events = $events;
        if (method_exists($this, 'attachDefaultListeners')) {
            $this->attachDefaultListeners();
        }
        return $this;
    }

    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEvents()
    {
        if (!$this->events instanceof EventManagerInterface) {
            $this->setEvents(new EventManager);
        }
        return $this->events;
    }
}
