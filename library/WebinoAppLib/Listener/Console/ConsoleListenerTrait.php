<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Listener\Console;

use WebinoAppLib\Util\ConsoleEventNameResolver;
use Zend\Console\Console;

/**
 * Class ConsoleListenerTrait
 */
trait ConsoleListenerTrait
{
    /**
     * @param string $event
     * @param string|callable $callback
     * @param int $priority
     * @return $this
     */
    abstract protected function listen($event, $callback = null, $priority = 1);

    /**
     * Listen to a console event
     *
     * @param string $name
     * @param string|callable $callback
     * @param int $priority
     * @return $this
     */
    protected function listenConsole($name, $callback = null, $priority = 1)
    {
        if (Console::isConsole()) {
            $this->listen(
                ConsoleEventNameResolver::getEventName($name),
                $callback,
                $priority
            );
        }

        return $this;
    }
}
