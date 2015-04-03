<?php

namespace WebinoAppLib\Event;

/**
 * Interface AppEventInterface
 */
interface AppEventInterface
{
    /**
     * Bootstrapping the application
     */
    const BOOTSTRAP = 'bootstrap';

    /**
     * Configuring the application
     *
     * Event isn't triggered if cached.
     */
    const CONFIGURE = 'configure';

    /**
     * Dispatching the application
     */
    const DISPATCH = 'dispatch';
}
