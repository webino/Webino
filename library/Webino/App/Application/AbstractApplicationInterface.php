<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\App\Application;

/**
 * Interface AbstractApplicationInterface
 */
interface AbstractApplicationInterface
{
    /**
     * Application core configuration service name
     */
    const CORE_CONFIG = 'CoreConfig';

    /**
     * Application configuration service name
     */
    const CONFIG = 'Config';

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
     * Application filesystem service name
     */
    const FILESYSTEMS = 'Files';

    /**
     * Application router service name
     */
    const ROUTER = 'Router';

    /**
     * Application mailer service name
     */
    const MAILER = 'Mailer';
}
