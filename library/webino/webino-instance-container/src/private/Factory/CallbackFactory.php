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

/**
 * Class CallbackFactory
 * @package webino-instance-container
 */
class CallbackFactory extends AbstractServiceFactory
{
    /**
     * Callable factory
     *
     * @var callable
     */
    protected $callback;

    /**
     * @param callable $callback Callable factory
     */
    function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Create new service
     *
     * @param CreateInstanceEventInterface $event
     * @return mixed
     */
    function createInstance(CreateInstanceEventInterface $event)
    {
        $callback = $this->callback;
        return $callback($event);
    }
}
