<?php

namespace Webino\Event;

/**
 * Trait EventEmitterAwareTrait
 */
trait EventEmitterAwareTrait
{
    /**
     * @var EventEmitterInterface
     */
    private $eventEmitter;

    /**
     * @return EventEmitterInterface
     */
    public function getEventEmitter() : EventEmitterInterface
    {
        if (!$this->eventEmitter) {
            $this->eventEmitter = new EventEmitter($this);
        }
        return $this->eventEmitter;
    }
}
