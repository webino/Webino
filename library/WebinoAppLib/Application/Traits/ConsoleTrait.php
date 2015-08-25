<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Service\Console;
use WebinoAppLib\Util\ConsoleEventNameResolver;
use Zend\Console\Console as ZendConsole;

/**
 * Trait Console
 */
trait ConsoleTrait
{
    /**
     * @var Console
     */
    private $console;

    /**
     * Attach a listener to an event
     *
     * @param string|\Zend\EventManager\ListenerAggregateInterface $event
     * @param string|callable|int $callback If string $event provided, expects PHP callback;
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed CallbackHandler if attaching callable
     *                          (to allow later unsubscribe); mixed if attaching aggregate
     */
    abstract public function bind($event, $callback = null, $priority = 1);

    /**
     * Binding listener to a console route
     *
     * @param string $name Route name
     * @param string|callable|int $callback If string $event provided, expects PHP callback;
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed CallbackHandler if attaching callable;
     *          mixed if attaching aggregate
     */
    public function bindConsole($name, $callback = null, $priority = 1)
    {
        if (!ZendConsole::isConsole()) {
            return null;
        }

        return $this->bind(call_user_func(ConsoleEventNameResolver::getInstance(), $name), $callback, $priority);
    }
}
