<?php

namespace WebinoAppLib\Application;

/**
 * Interface AbstractApplicationInterface
 */
interface AbstractApplicationInterface
{
    /**
     * Application service name
     */
    const SERVICE = 'Application';

    /**
     * Application events service name
     */
    const EVENTS = 'Events';

    /**
     * Application debugger service name
     */
    const DEBUGGER = 'Debugger';

    /**
     * Application logger service name
     */
    const LOGGER = 'Logger';

    /**
     * Application cache service name
     */
    const CACHE = 'Cache';

    /**
     * Application core configuration service name
     */
    const CORE_CONFIG = 'CoreConfig';

    /**
     * Application configuration service name
     */
    const CONFIG = 'Config';

    /**
     * Application request service name
     */
    const REQUEST = 'Request';

    /**
     * Application response service name
     */
    const RESPONSE = 'Response';
}
