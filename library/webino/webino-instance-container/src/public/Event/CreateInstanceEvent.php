<?php

namespace Webino;

/**
 * Class CreateInstance
 * @package webino-instance-container
 */
class CreateInstanceEvent extends Event
{
    use CreateInstanceEventTrait;

    /**
     * @param InstanceContainerInterface|object $container
     * @param string $class
     * @param iterable $parameters
     */
    function __construct(InstanceContainerInterface $container, string $class, iterable $parameters)
    {
        parent::__construct(null, $container);

        $this->setContainer($container);
        $this->setClass($class);
        $this->setParameters($parameters);
    }
}
