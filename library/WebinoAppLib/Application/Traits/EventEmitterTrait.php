<?php

namespace WebinoAppLib\Application\Traits;

use Psr\Log\LoggerInterface;
use WebinoAppLib\Log;
use Zend\EventManager\Event;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Stdlib\CallbackHandler;

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
        if ($event instanceof ListenerAggregateInterface) {
            $this->log(Log\AttachAggregateListener::class, $event);
            $event->attach($this->getEvents(), (int) $callback);
            return $this;
        }

        $this->log(Log\AttachListener::class, $event, $callback, $priority);

        if ($event instanceof CallbackHandler) {
            $mData = $event->getMetadata();
            return $this->listeners[] = $this->getEvents()->attach(
                $mData['event'],
                $event->getCallback(),
                $mData['priority']
            );
        }

        $this->listeners[] = $this->getEvents()->attach($event, $callback, $priority);
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
}
