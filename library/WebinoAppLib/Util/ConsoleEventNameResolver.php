<?php
/**
 * Webino™ (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoAppLib\Util;

use WebinoAppLib\Event\ConsoleEvent;
use WebinoAppLib\Event\RouteEvent;

/**
 * Class ConsoleEventNameResolver
 */
class ConsoleEventNameResolver extends RouteEventNameResolver
{
    /**
     * @param string $name
     * @return string
     */
    public function __invoke($name)
    {
        return $this->getUsePrefix($name) ? $name : RouteEvent::PREFIX . ConsoleEvent::PREFIX . $name;
    }
}
