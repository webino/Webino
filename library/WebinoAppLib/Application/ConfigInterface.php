<?php

namespace WebinoAppLib\Application;

/**
 * Interface ConfigInterface
 */
interface ConfigInterface
{
    /**
     * Core config node key
     */
    const CORE = 'core';

    /**
     * Services config node key
     */
    const SERVICES = 'services';

    /**
     * Invokables config node key
     */
    const INVOKABLES = 'invokables';

    /**
     * Factories config node key
     */
    const FACTORIES = 'factories';

    /**
     * Listeners config node key
     */
    const LISTENERS = 'listeners';
}
