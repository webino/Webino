<?php

namespace WebinoAppLib\Factory;

use WebinoAppLib\Service\Console;
use WebinoAppLib\Service\Modules;

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
        return $this->getApp()->isConsole() ? new Console : null;
    }
}
