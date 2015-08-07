<?php

namespace WebinoAppLib\Contract;

/**
 * Interface DebuggerInterface
 */
interface DebuggerInterface
{
    /**
     * Return a debugger service
     *
     * @return object|DebuggerInterface
     */
    public function getDebugger();

    /**
     * Debug a variable
     *
     * @param string|null $var Variable.
     * @return \WebinoAppLib\Debugger\DebuggingInterface
     */
    public function debug($var = null);
}
