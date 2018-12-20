<?php

namespace Webino;

/**
 * Class CreateInstance
 * @package webino-instance-container
 */
trait CreateInstanceEventTrait
{
    /**
     * @var InstanceContainerInterface
     */
    private $container;

    /**
     * @var string
     */
    private $class;

    /**
     * @var iterable
     */
    private $parameters = [];

    /**
     * Instance container
     *
     * @return InstanceContainerInterface
     */
    function getContainer(): InstanceContainerInterface
    {
        return $this->container;
    }

    /**
     * @param InstanceContainerInterface $container
     */
    protected function setContainer(InstanceContainerInterface $container): void
    {
        $this->container = $container;
    }

    /**
     * Instance class
     *
     * @return string
     */
    function getClass(): string
    {
        return $this->class;
    }

    /**
     * @param string $class
     */
    protected function setClass(string $class): void
    {
        $this->class = $class;
    }

    /**
     * Instance creation parameters
     *
     * @return iterable
     */
    function getParameters(): iterable
    {
        return $this->parameters;
    }

    /**
     * @param iterable $parameters
     */
    protected function setParameters(iterable $parameters): void
    {
        $this->parameters = $parameters;
    }
}
