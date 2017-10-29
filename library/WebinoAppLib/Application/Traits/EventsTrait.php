<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Application;
use WebinoAppLib\Exception;
use WebinoAppLib\Log;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Stdlib\CallbackHandler;

/**
 * Trait EventEmitterTrait
 * @TODO redesign, remove CallbackHandler support, cause is deprecated by Zend
 */
trait EventsTrait
{
    /**
     * @var EventManagerInterface
     */
    private $events;

    /**
     * @var \Zend\EventManager\ListenerAggregateInterface[]
     */
    protected $listeners = [];

    /**
     * @param string $service
     * @return mixed
     */
    abstract public function get($service);

    /**
     * @param mixed $service
     * @param null $factory
     * @return $this
     */
    abstract public function set($service, $factory = null);

    /**
     * @param $service
     * @return bool
     */
    abstract public function has($service);

    /**
     * @param mixed|\WebinoLogLib\Message\MessageInterface $level
     * @param mixed ...$args
     * @return \Psr\Log\LoggerInterface
     */
    abstract public function log($level = null, ...$args);

    /**
     * Require service from services into application
     *
     * @param string $service Service name
     * @throws Exception\DomainException Unable to get service
     */
    abstract protected function requireService($service);

    /**
     * @return EventManagerInterface
     */
    public function getEvents()
    {
        if (null === $this->events) {
            $this->requireService(Application::EVENTS);
        }
        return $this->events;
    }

    /**
     * @param EventManagerInterface $events
     */
    protected function setEvents(EventManagerInterface $events)
    {
        $this->events = $events;
    }

    /**
     * Attach a listener to an event
     *
     * @param string|\Zend\EventManager\ListenerAggregateInterface $event
     * @param string|callable|int $callback If string $event provided, expects PHP callback;
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed CallbackHandler if attaching callable
     *                          (to allow later unsubscribe); mixed if attaching aggregate
     */
    public function bind($event, $callback = null, $priority = 1)
    {
        $aggregate = (null === $callback) ? $this->resolveListenerAggregate($event) : null;

        if ($aggregate instanceof ListenerAggregateInterface) {
            $this->log(Log\AttachAggregateListener::class, [$aggregate]);
            $aggregate->attach($this->getEvents());
            return $this;
        }

        unset($aggregate);

        if ($event instanceof CallbackHandler) {
            $callback = $event->getCallback();
            $mData = $event->getMetadata();
            $this->log(Log\AttachListener::class, [$mData['event'], $callback, $mData['priority']]);
            return $this->listeners[] = $this->getEvents()->attach(
                $mData['event'],
                $callback,
                $mData['priority']
            );
        }

        $normalized = $this->normalizeCallback($callback);
        $this->log(Log\AttachListener::class, [$event, $normalized, $priority]);
        $this->listeners[] = $this->getEvents()->attach($event, $normalized, $priority);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function unbind($event = null, $callback = null, $priority = null)
    {
        $aggregate = (null === $callback) ? $this->resolveListenerAggregate($event) : null;

        if ($aggregate instanceof ListenerAggregateInterface) {
            $this->log(Log\DetachAggregateListener::class, [$aggregate]);
            $aggregate->detach($this->getEvents());
            return $this;
        }

        unset($aggregate);

        if (is_callable($event)) {
            $_callback = $event;
            $event = null;

        } elseif ($callback instanceof CallbackHandler) {
            $_callback = $callback->getCallback();

        } else {
            $_callback = $this->normalizeCallback($callback);
        }

        if ($_callback instanceof CallbackHandler) {
            $_callback = $_callback->getCallback();
        }

        /** @var \Zend\Stdlib\CallbackHandler $listener */
        foreach ($this->listeners as $index => $listener) {
            $mData = $listener->getMetadata();

            if ($event && $event !== $mData['event']) {
                continue;
            }

            if ($_callback !== $listener->getCallback()) {
                continue;
            }

            if (null !== $priority && $priority !== $mData['priority']) {
                continue;
            }

            $this->log(Log\DetachListener::class, [$event, $_callback, $priority]);
            $this->getEvents()->detach($listener);
            unset($this->listeners[$index]);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function emit($event, $argv = [], $callback = null)
    {
        $target = $this;
        if ($event instanceof Event) {
            $event->getTarget() or $event->setTarget($this);
            $target = $callback;
        }

        $this->log(Log\TriggerEvent::class, [$event]);

        if (is_callable($argv)) {
            return $this->getEvents()->trigger($event, $target, [], $argv);
        }

        return $this->getEvents()->trigger($event, $target, $argv, $callback);
    }

    /**
     * Normalize the callback argument
     *
     * If the callback is a string, register it to the services then return it.
     *
     * @param mixed $callback
     * @return mixed
     */
    private function normalizeCallback($callback)
    {
        if (is_string($callback)) {
            $this->has($callback) || $this->set($callback);
            return $this->get($callback);
        }
        return $callback;
    }

    /**
     * @param mixed $event
     * @return mixed|string
     */
    private function resolveListenerAggregate($event)
    {
        if (is_string($event) && class_exists($event)) {
            if (empty(class_implements($event)[ListenerAggregateInterface::class])) {
                return $event;
            }
            return $this->normalizeCallback($event);
        }

        return $event;
    }
}
