<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Event;

use WebinoAppLib\Service\Console;
use WebinoAppLib\Util\ConsoleEventNameResolver;

/**
 * Class ConsoleEvent
 */
class ConsoleEvent extends AbstractRouteEvent
{
    /**
     * Route event prefix
     */
    const PREFIX = 'console.';

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->name = ConsoleEventNameResolver::getEventName($name);
        return $this;
    }

    /**
     * @return Console
     */
    public function getCli()
    {
        return $this->getApp()->get(Console::class);
    }
}
