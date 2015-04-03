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
     * Services factories config node key
     */
    const SERVICES_INVOKABLES = 'invokables';

    /**
     * Services factories config node key
     */
    const SERVICES_FACTORIES = 'factories';

    /**
     * Listeners config node key
     */
    const LISTENERS = 'listeners';
}
