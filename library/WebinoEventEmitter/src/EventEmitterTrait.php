<?php

namespace Webino;

/**
 * Trait EventEmitterTrait
 */
trait EventEmitterTrait
{
    /**
     * Subscribed events and their handlers
     *
     * STRUCTURE:
     * [
     *     <string name> => [
     *         <int priority> => [
     *             0 => [<callable handler>, ...]
     *         ],
     *         ...
     *     ],
     *     ...
     * ]
     *
     * NOTE:
     * This structure helps us to reuse the list of handlers
     * instead of first iterating over it and generating a new one
     * -> In result it improves performance by up to 25% even if it looks a bit strange
     *
     * @var array[]
     */
    protected $events = [];

    /**
     * @var EventInterface
     */
    protected $eventPrototype;

    /**
     * Invoke handlers
     *
     * @param string|EventInterface $event Event name or object
     * @param callable|null $until Invoke handlers until callback return value evaluate to true
     * @return EventInterface Event object
     * @throws Exception\InvalidEventException Invalid event
     */
    public function emit($event, callable $until = null): EventInterface
    {
        $event = $this->normalizeEvent($event);
        $name = $event->getName();
        if (empty($name)) {
            throw (new Exception\InvalidEventException('Cannot emit event %s missing a name'))
                ->format($event);
        }
        // get handlers by priority in reverse order
        $handlers = $this->getHandlers($name);
        // set event initial values
        $event->setResults([]);
        $event->setTarget($this);
        $event->stopPropagation(false);
        // invoke handlers
        foreach ($handlers as $eventHandlers) {
            foreach ($eventHandlers as $subHandlers) {
                foreach ($subHandlers as $callback) {
                    $response = $callback($event);
                    $event->setResult($response);
                    // stop propagation if the event was asked to
                    if ($event->isPropagationStopped()) {
                        return $event;
                    }
                    // stop propagation if the result causes our validation callback to return true
                    if ($until && $until($response)) {
                        return $event;
                    }
                }
            }
        }
        return $event;
    }

    /**
     * Set event handler
     *
     * @param string|EventInterface|EventHandlerInterface $event Event name, object or event handler
     * @param callable|null $callback Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function on($event, $callback = null, int $priority = 1)
    {
        if ($event instanceof EventHandlerInterface && $this instanceof EventEmitterInterface) {
            $event->attachEventEmitter($this);
            return;
        }

        $event = $this->normalizeEvent($event);
        $name = $event->getName();
        $this->events[$name][(int) $priority][0][] = $callback;
    }

    /**
     * Remove event handler
     *
     * @param callable|EventHandlerInterface|null $callback Event handler
     * @param string|EventInterface|null $event Event name or object
     * @return void
     */
    public function off($callback = null, $event = null): void
    {
        if ($callback instanceof EventHandlerInterface && $this instanceof EventEmitterInterface) {
            $callback->detachEventEmitter($this);
            return;
        }
        if (!$event) {
            // remove listeners from all events
            foreach (array_keys($this->events) as $name) {
                $this->off($callback, $name);
            }
            return;
        }
        $event = $this->normalizeEvent($event);
        $name = $event->getName();
        if (!isset($this->events[$name])) {
            return;
        }
        foreach ($this->events[$name] as $priority => $handlers) {
            foreach ($handlers[0] as $index => $subHandler) {
                if ($callback && $subHandler !== $callback) {
                    continue;
                }
                // remove founded listener
                unset($this->events[$name][$priority][0][$index]);
                // remove event if the queue for given priority is empty
                if (empty($this->events[$name][$priority][0])) {
                    unset($this->events[$name][$priority]);
                    break;
                }
            }
        }
        // remove event if the queue given is empty
        if (empty($this->events[$name])) {
            unset($this->events[$name]);
        }
    }

    /**
     * Return listeners sort by priority in reverse order
     *
     * @param string|null $name Event name
     * @return array Sorted listeners
     */
    protected function getHandlers(string $name = null): array
    {
        if (isset($this->events[$name])) {
            $handlers = $this->events[$name];
            if (isset($this->events['*'])) {
                foreach ($this->events['*'] as $priority => $handlers) {
                    $handlers[$priority][] = $handlers[0];
                }
            }
        } elseif (isset($this->events['*'])) {
            $handlers = $this->events['*'];
        } else {
            $handlers = [];
        }
        krsort($handlers);
        return $handlers;
    }

    /**
     * Return event as object, if any
     *
     * @param string|EventInterface $event Event name or object
     * @return EventInterface Event object
     * @throws Exception\InvalidArgumentException Invalid event
     */
    protected function normalizeEvent($event): EventInterface
    {
        if (is_string($event)) {
            $eventClone = clone $this->getEventPrototype();
            $eventClone->setName($event);
            return $eventClone;
        }

        if ($event instanceof EventInterface) {
            return $event;
        }

        throw (new Exception\InvalidArgumentException('Expected event as %s but got %s'))
            ->format('string|EventInterface|null', $event);
    }

    /**
     * @return Event
     */
    protected function getEventPrototype(): Event
    {
        if (!$this->eventPrototype) {
            $this->eventPrototype = new Event(null, $this);
        }
        return $this->eventPrototype;
    }
}
