<?php

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
        if (Console::isConsole()) {
            return $this;
        }

        $this->listen(
            call_user_func(new RouteEventNameResolver, $name),
            $callback,
            $priority
        );
        return $this;
    }
}
