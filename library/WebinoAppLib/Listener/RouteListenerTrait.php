<?php

namespace WebinoAppLib\Listener;

use WebinoAppLib\Event\RouteEventNameResolver;

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
        $this->listen(
            (new RouteEventNameResolver)->__invoke($name),
            $callback,
            $priority
        );
        return $this;
    }
}
