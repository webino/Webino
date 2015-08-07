<?php

namespace WebinoEventLib;

use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;

/**
 * Class AbstractListener
 */
abstract class AbstractListener implements ListenerAggregateInterface
{
    use ListenerAggregateTrait;

    /**
     * @var EventManagerInterface
     */
    private $events;

    /**
     * Listen to an event
     *
     * @param string $event
     * @param string|callable $callback
     * @param int $priority
     * @return self
     */
    protected function listen($event, $callback = null, $priority = 1)
    {
        $this->listeners[] = $this->events->attach(
            $event,
            is_string($callback) ? [$this, $callback] : $callback,
            $priority
        );
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function attach(EventManagerInterface $events)
    {
        $this->events = $events;
        $this->init();
    }

    /**
     * Initialize listener
     */
    abstract protected function init();
}
