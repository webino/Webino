<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Factory;

use League\CLImate\CLImate;
use WebinoAppLib\Service\Console;

/**
 * Class ConsoleFactory
 */
class ConsoleFactory extends AbstractFactory
{
    /**
     * @return Console
     */
    public function create()
    {
        return $this->getApp()->isConsole() ? new Console(new CLImate) : null;
    }
}
