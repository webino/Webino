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

use Webino\ServiceContainerInterface;
use Webino\ServiceFactoryInterface;

/**
 * Class AbstractFactory
 */
abstract class AbstractServiceFactory implements ServiceFactoryInterface
{
    /**
     * Callable factory
     *
     * @var callable
     */
    protected $callback;

    /**
     * Create new service
     *
     * @param ServiceContainerInterface $services Services container
     * @return mixed
     */
    abstract public function create(ServiceContainerInterface $services);
}
