<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Listener;

use WebinoAppLib\Util\RouteEventNameResolver;
use Zend\Console\Console;

/**
 * Class RouteListenerTrait
 */
trait RouteListenerTrait
{
    /**
     * @param string $event
     * @param string|callable $callback
     * @param int $priority
     * @return $this
     */
    abstract protected function listen($event, $callback = null, $priority = 1);

    /**
     * Listen to a route event
     *
     * @param string $name
     * @param string|callable $callback
     * @param int $priority
     * @return $this
     */
    protected function listenRoute($name, $callback = null, $priority = 1)
    {
        if (!Console::isConsole()) {
            $this->listen(
                RouteEventNameResolver::getEventName($name),
                $callback,
                $priority
            );
        }

        return $this;
    }
}
