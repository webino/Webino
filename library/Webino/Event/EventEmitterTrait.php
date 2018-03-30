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
     * @param array $params Event parameters
     * @param callable|null $until Invoke handlers until callback return value evaluate to true
     * @return array Handlers invocation results array
     * @throws Exception\RuntimeException Event missing name
     */
    public function emit($event, array $params = [], callable $until = null) : array
    {
        $event = $this->normalizeEvent($event);
        $name = $event->getName();

        if (empty($name)) {
            throw new Exception\RuntimeException('Event is missing a name; cannot emit!');
        }

        // get handlers by priority in reverse order
        $handlers = $this->getHandlers($name);

        // initial value of stop propagation flag should be false
        $event->stopPropagation(false);

        // invoke handlers
        $responses = [];
        foreach ($handlers as $eventHandlers) {
            foreach ($eventHandlers as $subHandlers) {
                foreach ($subHandlers as $handler) {
                    $response = $handler($event, ...$params);
                    array_unshift($responses, $response);

                    // stop propagation if the event was asked to
                    if ($event->isPropagationStopped()) {
                        return $responses;
                    }

                    // stop propagation if the result causes our validation callback to return true
                    if ($until && $until($response)) {
                        return $responses;
                    }
                }
            }
        }

        return $responses;
    }

    /**
     * Set event handler
     *
     * @param string|EventInterface $event Event name or object
     * @param callable $handler Event handler
     * @param int $priority Handler invocation priority
     * @return void
     */
    public function on($event, callable $handler, $priority = 1) : void
    {
        $event = $this->normalizeEvent($event);
        $name = $event->getName();
        $this->events[$name][(int) $priority][0][] = $handler;
    }

    /**
     * Remove event handler
     *
     * @param callable $handler Event handler
     * @param string|EventInterface|null $event Event name or object
     * @return void
     */
    public function off(callable $handler = null, $event = null) : void
    {
        if (!$event) {
            // remove listeners from all events
            foreach (array_keys($this->events) as $name) {
                $this->off($handler, $name);
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
                if ($subHandler !== $handler) {
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
     * @param string $name Event name
     * @return array Sorted listeners
     */
    protected function getHandlers(string $name) : array
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
     * @return EventInterface|null
     */
    protected function normalizeEvent($event) : ?EventInterface
    {
        if (!$event) {
            return null;
        }

        if (is_string($event)) {
            $eventClone = clone $this->eventPrototype;
            $eventClone->setName($event);
            return $eventClone;
        }

        if ($event instanceof EventInterface) {
            return $event;
        }

        throw (new Exception\InvalidArgumentException('Expected event as %s but got %s'))
            ->format('string|EventInterface|null', $event);
    }
}
