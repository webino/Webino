<?php

namespace WebinoAppLib\Factory;

/**
 * Class EventsFactory
 */
class EventsFactory extends AbstractFactory
{
    /**
     * Events engine
     */
    const ENGINE = 'ZfEvents';

    /**
     * Event object class
     */
    const EVENT_CLASS = 'WebinoAppLib\Event\AppEvent';

    /**
     * {@inheritdoc}
     */
    protected function create()
    {
        /** @var \Zend\EventManager\EventManager $events */
        $events = $this->requireService($this::ENGINE);
        $events->setEventClass($this::EVENT_CLASS);
        return $events;
    }
}
