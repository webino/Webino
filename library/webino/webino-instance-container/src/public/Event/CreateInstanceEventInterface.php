<?php

namespace Webino;

/**
 * Interface CreateInstanceEventInterface
 * @package webino-instance-container
 */
interface CreateInstanceEventInterface
{
    /**
     * Instance container
     *
     * @return InstanceContainerInterface
     */
    function getContainer(): InstanceContainerInterface;

    /**
     * Instance class
     *
     * @return string
     */
    function getClass(): string;

    /**
     * Instance creation parameters
     *
     * @return iterable
     */
    function getParameters(): iterable;
}
