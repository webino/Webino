<?php

use WebinoAppLib\Factory;
use WebinoAppLib\Service\DebuggerInterface;

/**
 * Class Webino
 */
class Webino
{
    /**
     * @param array|object $config
     * @param DebuggerInterface $debugger
     * @return \WebinoAppLib\Application\AbstractBaseApplication
     */
    public static function application($config = null, DebuggerInterface $debugger = null)
    {
        return (new Factory)->create($config, $debugger);
    }
}
