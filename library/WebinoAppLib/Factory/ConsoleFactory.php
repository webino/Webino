<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Service\Console;
use WebinoAppLib\Service\Modules;
use Zend\Console\Console as ZendConsole;

/**
 * Class ConsoleFactory
 */
class ConsoleFactory extends AbstractFactory
{
    /**
     * @return Modules
     */
    public function create()
    {
        if (ZendConsole::isConsole()) {
            return new Console;
        }
        return false;
    }
}
