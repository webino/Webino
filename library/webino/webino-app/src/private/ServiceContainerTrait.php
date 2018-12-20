<?php

namespace Webino;

/**
 * Trait ServiceContainerTrait
 * @package webino-app
 */
trait ServiceContainerTrait
{
    /**
     * Creates instance of container event
     *
     * @param CreateInstanceEvent $event
     * @return CreateInstanceEventInterface
     */
    protected function createInstanceEvent(CreateInstanceEvent $event): CreateInstanceEventInterface
    {
        return new CreateServiceEvent($this, $event);
    }
}
