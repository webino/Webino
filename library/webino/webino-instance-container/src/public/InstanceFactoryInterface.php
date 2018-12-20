<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino;

/**
 * Interface InstanceFactoryInterface
 * @package webino-instance-container
 */
interface InstanceFactoryInterface
{
    /**
     * Create new instance
     *
     * @param CreateInstanceEventInterface|object $event
     * @return mixed
     */
    function createInstance(CreateInstanceEventInterface $event);
}
