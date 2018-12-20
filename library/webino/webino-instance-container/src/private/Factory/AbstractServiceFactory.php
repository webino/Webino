<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2018 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace Webino\Factory;

use Webino\CreateInstanceEventInterface;
use Webino\InstanceFactoryInterface;

/**
 * Class AbstractFactory
 * @package webino-instance-container
 */
abstract class AbstractServiceFactory implements InstanceFactoryInterface
{
    /**
     * Create new instance
     *
     * @param CreateInstanceEventInterface $event
     * @return mixed
     */
    abstract function createInstance(CreateInstanceEventInterface $event);
}
