<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Contract;

/**
 * Interface DebuggerInterface
 */
interface DebuggerInterface
{
    /**
     * Return a debugger service
     *
     * @return DebuggerInterface|object
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
