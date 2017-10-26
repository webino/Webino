<?php

namespace WebinoEventLib;

use Zend\EventManager\EventManagerInterface;

/**
 * Class ListenerAggregateTrait
 */
trait ListenerAggregateTrait
{
    /**
     * @var EventManagerInterface
     */
    private $events;

    /**
     * @var \Zend\Stdlib\CallbackHandler[]
     */
    protected $listeners = [];

    /**
     * Listen to an event
     *
     * @param string $event
     * @param string|callable $callback
     * @param int $priority
     * @return $this
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
     * {@inheritDoc}
     */
    public function detach(EventManagerInterface $events)
    {
        foreach ($this->listeners as $index => $callback) {
            if ($events->detach($callback)) {
                unset($this->listeners[$index]);
            }
        }
    }

    /**
     * Initialize listener
     */
    abstract protected function init();
}
