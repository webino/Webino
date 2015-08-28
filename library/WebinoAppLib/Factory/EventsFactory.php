<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Event\AppEvent;
use WebinoEventLib\EventManager;

/**
 * Class EventsFactory
 */
final class EventsFactory extends AbstractFactory
{
    /**
     * {@inheritdoc}
     */
    protected function create()
    {
        return (new EventManager)->setEventClass(AppEvent::class);
    }
}
