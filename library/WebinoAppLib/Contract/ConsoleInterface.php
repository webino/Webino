<?php

namespace WebinoAppLib\Contract;

/**
 * Interface ConsoleInterface
 */
interface ConsoleInterface
{
    /**
     * @return bool
     */
    public function isHttp();

    /**
     * @return bool
     */
    public function isConsole();

    /**
     * Binding listener to a console route
     *
     * @param string $name Route name
     * @param string|callable|int $callback If string $event provided, expects PHP callback;
     * @param int $priority Invocation priority
     * @return \Zend\Stdlib\CallbackHandler|mixed CallbackHandler if attaching callable;
     *          mixed if attaching aggregate
     */
    public function bindConsole($name, $callback = null, $priority = 1);
}
