<?php

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
                call_user_func(new ConsoleEventNameResolver, $name),
                $callback,
                $priority
            );
        }

        return $this;
    }
}
