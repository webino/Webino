<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
     * Service initializers config node key
     */
    const INITIALIZERS = 'initializers';

    /**
     * Listeners config node key
     */
    const LISTENERS = 'listeners';
}
