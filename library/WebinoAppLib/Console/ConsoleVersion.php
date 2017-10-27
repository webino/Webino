<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Console;

use Webino;
use WebinoAppLib\Event\ConsoleEvent;
use WebinoConfigLib\Feature\Route\ConsoleRoute;

/**
 * Class ConsoleVersion
 */
class ConsoleVersion extends AbstractConsoleCommand
{
    /**
     * {@inheritdoc}
     */
    public function configure(ConsoleRoute $route)
    {
        $route
            ->setPath('version')
            ->setTitle('Show script version');
    }

    /**
     * @param ConsoleEvent $event
     */
    public function handle(ConsoleEvent $event)
    {
        $event->getCli()->clear()->out(Webino::VERSION);
    }
}
