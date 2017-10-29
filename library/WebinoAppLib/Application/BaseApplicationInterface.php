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
 * Interface BaseApplicationInterface
 */
interface BaseApplicationInterface
{
    /**
     * Bootstrap the application
     *
     * Returns configured application ready to dispatch.
     *
     * @return AbstractConfiguredApplication
     */
    public function bootstrap();
}
