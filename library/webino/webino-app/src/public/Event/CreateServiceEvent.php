<?php

namespace Webino;

/**
 * Class CreateServiceEvent
 * @package webino-app
 */
class CreateServiceEvent extends AppEvent implements CreateInstanceEventInterface
{
    use CreateInstanceEventTrait;

    /**
     * @param AppInterface|object $app
     * @param CreateInstanceEvent $event
     */
    function __construct(AppInterface $app, CreateInstanceEvent $event)
    {
        parent::__construct(null, $app);

        $this->setContainer($event->getContainer());
        $this->setClass($event->getClass());
        $this->setParameters($event->getParameters());
    }
}
