<?php

namespace Webino;

/**
 * Trait CustomInstanceContainerTrait
 * @package webino-instance-container
 */
trait CustomInstanceContainerTrait
{
    /**
     * Creates instance of container event
     *
     * @param CreateInstanceEvent $event
     * @return CreateInstanceEventInterface
     */
    abstract protected function createInstanceEvent(CreateInstanceEvent $event): CreateInstanceEventInterface;
}
