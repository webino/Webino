<?php

use WebinoAppLib\ApplicationConfig;
use WebinoAppLib\Factory;
use WebinoAppLib\Service\DebuggerInterface;

/**
 * Class WebinoAppLib
 */
class WebinoAppLib
{
    /**
     * Create Webino application config
     *
     * @param array $config
     * @return ApplicationConfig
     */
    public static function config(array $config)
    {
        return new ApplicationConfig($config);
    }

    /**
     * Create Webino application
     *
     * @param array|object|ApplicationConfig|null $config
     * @param DebuggerInterface|null $debugger
     * @return \Webino\Application\BaseApplicationInterface
     */
    public static function application($config = null, DebuggerInterface $debugger = null)
    {
        return (new Factory)->create($config, $debugger);
    }
}
