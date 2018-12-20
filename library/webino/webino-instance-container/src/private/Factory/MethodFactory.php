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
 * Class MethodFactory
 * @package webino-instance-container
 */
class MethodFactory extends AbstractServiceFactory
{
    /**
     * Create new instance
     *
     * @param CreateInstanceEventInterface $event
     * @return mixed
     */
    function createInstance(CreateInstanceEventInterface $event)
    {
        $class = $event->getClass();

        if (method_exists($class, 'create')
            && empty(class_implements($class)[InstanceFactoryInterface::class])
        ) {
            return call_user_func("$class::create", $event);
        }

        $parameters = $event->getParameters();
        return new $class(...$parameters);
    }
}
