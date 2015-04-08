<?php

namespace WebinoAppLib\Application\Traits;

use Psr\Log\LoggerInterface;
use WebinoAppLib\Log;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Stdlib\CallbackHandler;

/**
 * Trait EventEmitterTrait
 */
trait EventEmitterTrait
{
    /**
     * @var \Zend\EventManager\ListenerAggregateInterface[]
     */
    protected $listeners = [];

    /**
     * @return EventManagerInterface
     */
    abstract public function getEvents();

    /**
     * @param string $service
     * @return mixed
     */
    abstract public function get($service);

    /**
     * @param mixed $service
     * @param null $factory
     * @return self
     */
    abstract public function set($service, $factory = null);

    /**
     * @param $service
     * @return bool
     */
    abstract public function has($service);

    /**
     * @param mixed|\WebinoAppLib\Log\MessageInterface $level
     * @param mixed ...$args
     * @return LoggerInterface
     */
    abstract public function log($level = null, ...$args);

    /**
     * {@inheritdoc}
     */
    public function bind($event, $callback = null, $priority = 1)
    {
        $normalized = $this->normalizeCallback($callback);

        if ($event instanceof ListenerAggregateInterface) {
            $this->log(Log\AttachAggregateListener::class, $event);
            $event->attach($this->getEvents(), (int) $normalized);
            return $this;
        }

        $this->log(Log\AttachListener::class, $event, $normalized, $priority);

        if ($event instanceof CallbackHandler) {
            $mData = $event->getMetadata();
            return $this->listeners[] = $this->getEvents()->attach(
                $mData['event'],
                $event->getCallback(),
                $mData['priority']
            );
        }

        $this->listeners[] = $this->getEvents()->attach($event, $normalized, $priority);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function unbind($event = null, $callback = null, $priority = null)
    {
        if ($event instanceof ListenerAggregateInterface) {
            $this->log(Log\DetachAggregateListener::class, $event);
            $event->detach($this->getEvents());
            return $this;
        }

        if (is_callable($event)) {
            $_callback = $event;
            $event = null;

        } elseif ($callback instanceof CallbackHandler) {
            $_callback = $callback->getCallback();

        } else {
            $_callback = $callback;
        }

        /** @var \Zend\Stdlib\CallbackHandler $listener */
        foreach ($this->listeners as $index => $listener) {
            $mData = $listener->getMetadata();

            if (($event === $mData['event'] || null === $event)
                && ($_callback === $listener->getCallback() || null === $callback)
                && ($priority === $mData['priority'] || null === $priority)
            ) {
                $this->log(Log\DetachListener::class, $event, $_callback, $priority);
                $this->getEvents()->detach($listener);
                unset($this->listeners[$index]);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function emit($event, $argv = [], $callback = null)
    {
        $target = $this;
        if (($event instanceof Event)) {
            $event->getTarget() or $event->setTarget($this) && $target = $callback;
        }
        $this->log(Log\TriggerEvent::class, $event);
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
}
