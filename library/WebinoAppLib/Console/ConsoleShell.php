<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Console;

use Psy\Shell;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\ConsoleRoute;

/**
 * Class ConsoleRuntime
 */
class ConsoleShell extends AbstractConsoleCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure(ConsoleRoute $route)
    {
        $route
            ->setPath('shell')
            ->setTitle('Run interactive PHP console');
    }

    /**
     * @param ConsoleEvent $event
     */
    public function handle(ConsoleEvent $event)
    {
        $sh = new Shell;
        $sh->setScopeVariables([
            'app' => $event->getApp(),
            'cli' => $event->getCli(),
        ]);

        $sh->setBoundObject($event->getCli());
        $sh->run();

        extract($sh->getScopeVariables(false));
    }
}
