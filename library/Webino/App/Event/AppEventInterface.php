<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
