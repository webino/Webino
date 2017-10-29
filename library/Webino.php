<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

use Webino\Version;
use WebinoAppLib\Application\CoreConfig;
use WebinoAppLib\Factory;
use WebinoAppLib\Options\DebuggerOptions;
use WebinoAppLib\Service\Debugger;
use WebinoAppLib\Service\DebuggerInterface;

/**
 * Class Webino
 */
class Webino
{
    /**
     * Webino™ version
     */
    const VERSION = Version::VERSION;

    /**
     * Create application core config
     *
     * @param array $config
     * @return CoreConfig
     */
    public static function config(array $config)
    {
        return new CoreConfig($config);
    }

    /**
     * Create Webino application
     *
     * @param array|object $config
     * @param DebuggerInterface $debugger
     * @return \WebinoAppLib\Application\AbstractBaseApplication
     */
    public static function application($config = null, DebuggerInterface $debugger = null)
    {
        return (new Factory)->create($config, $debugger);
    }

    /**
     * Create application debugger
     *
     * @param array|DebuggerOptions $options
     * @return Debugger
     */
    public static function debugger($options = [])
    {
        return new Debugger($options);
    }

    /**
     * Create application debugger options
     *
     * @return DebuggerOptions
     */
    public static function debuggerOptions()
    {
        return new DebuggerOptions;
    }
}
