<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Listener\Console;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\DispatchEvent;
use WebinoAppLib\Listener\AbstractRoutingListener;

/**
 * Class ConsoleRoutingListener
 */
final class ConsoleRoutingListener extends AbstractRoutingListener
{
    /**
     * @param DispatchEvent $event
     * @return ConsoleEvent
     */
    protected function createRouteEvent(DispatchEvent $event)
    {
        return new ConsoleEvent($event);
    }
}
