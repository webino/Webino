<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Exception\UnknownServiceException;
// TODO WebinoLogLib\Message
use Webino\Log\Message;
use Zend\EventManager\Event;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\Stdlib\CallbackHandler;

/**
 * Class AbstractBaseApplication
 */
abstract class AbstractBaseApplication extends AbstractApplication
{
    /**
     * @var \Zend\EventManager\ListenerAggregateInterface[]
     */
    protected $listeners = [];

    /**
     * {@inheritdoc}
     */
    public function get($service)
    {
        try {
            return $this->getServices()->get($service);
        } catch (ServiceNotFoundException $exc) {
            throw (new UnknownServiceException('Unable to get an instance for %s', null, $exc))
                ->format($service);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function set($service, $factory = null)
    {
        $services = $this->getServices();

        if ($factory instanceof FactoryInterface
            || $factory instanceof \Closure
            || is_string($factory)
        ) {
            // factory
            $services->setFactory($service, $factory);
            return $this;
        }

        if (null !== $factory && is_string($service)) {
            // service object
            $services->setService($service, $factory);
            return $this;
        }

        // invokable
        is_array($service)
            and $services->setInvokableClass(key($service), current($service))
            or  $services->setInvokableClass($service, $service);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function bind($event, $callback = null, $priority = 1)
    {
        if ($event instanceof ListenerAggregateInterface) {
            $this->log(Message\AttachAggregateListener::class, $event);
            $event->attach($this->getEvents(), (int) $callback);
            return $this;
        }

        $this->log(Message\AttachListener::class, $event, $callback, $priority);

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
            $this->log(Message\DetachAggregateListener::class, $event);
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
                $this->log(Message\DetachListener::class, $event, $_callback, $priority);
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

        $this->log(Message\TriggerEvent::class, $event);
        return $this->getEvents()->trigger($event, $target, $argv, $callback);
    }

    /**
     * {@inheritdoc}
     */
    public function log($message, ...$args)
    {
        // TODO use WebinoLogLib\Service\Logger::log();
//        $this->getLogger()->log($message, ...$args);
        $this->getLogger()->debug($message);
        return $this;
    }
}
