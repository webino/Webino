<?php

namespace WebinoAppLib\Application\Traits;

use WebinoAppLib\Service\Console;
use WebinoAppLib\Util\ConsoleEventNameResolver;
use Zend\Console\Console as Cli;

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
     * @var bool
     */
    private $isConsole;

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
     * @return bool
     */
    public function isHttp()
    {
        return (null === $this->isConsole) ? !$this->isConsole() : !$this->isConsole;
    }

    /**
     * @return bool
     */
    public function isConsole()
    {
        if (null === $this->isConsole) {
            $this->isConsole = Cli::isConsole();
        }
        return $this->isConsole;
    }

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
        return $this->isConsole()
            ? $this->bind(call_user_func(ConsoleEventNameResolver::getInstance(), $name), $callback, $priority)
            : null;
    }
}
