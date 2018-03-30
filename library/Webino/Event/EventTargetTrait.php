<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Event;

/**
 * Trait EventTargetTrait
 */
trait EventTargetTrait
{
    /**
     * @return EventEmitterInterface
     */
    public abstract function getEventEmitter() : EventEmitterInterface;

    /**
     * Set event handler
     *
     * @param string|EventInterface $event Event name or object
     * @param callable $handler Event handler
     * @param int $priority Event handler order priority
     * @return void
     */
    public function on($event, callable $handler = null, int $priority = 1) : void
    {
        if ($event instanceof EventHandlerInterface) {
            $event->attachEventEmitter($this->getEventEmitter());
            return;
        }

        $this->getEventEmitter()->on($event, $handler, $priority);
    }

    /**
     * Remove event handler
     *
     * @param callable|EventHandlerInterface|null $handler Event handler
     * @param string|EventInterface $event Event name or object
     * @return void
     */
    public function off($handler = null, $event = null) : void
    {
        if ($handler instanceof EventHandlerInterface) {
            $handler->detachEventEmitter($this->getEventEmitter());
            return;
        }

        $this->getEventEmitter()->off($handler, $event);
    }

    /**
     * Emit an event
     *
     * @param string|EventInterface $event Event name or object
     * @param array $params Event parameters
     * @param callable|null $until Invoke handlers until callback return value evaluate to true
     * @return void
     */
    public function emit($event, array $params = [], callable $until = null) : void
    {
        $this->getEventEmitter()->emit($event, $params, $until);
    }
}
