<?php

namespace Webino;

/**
 * Interface EventDispatcherInterface
 */
interface EventEmitterInterface
{
    /**
     * Set event handler
     *
     * @param string|EventInterface|EventHandlerInterface $event Event name, object or event handler
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function on($event, $callback = null, int $priority = 1);

    /**
     * Remove event handler
     *
     * @param callable|EventHandlerInterface|null $callback Event handler
     * @param string|EventInterface|null $event Event name or object
     * @return void
     */
    public function off($callback = null, $event = null) : void;

    /**
     * Invoke handlers
     *
     * @param string|EventInterface $event Event name or object
     * @param callable|null $until Invoke handlers until callback return value evaluate to true
     * @return EventInterface Event object
     */
    public function emit($event, callable $until = null) : EventInterface;
}
