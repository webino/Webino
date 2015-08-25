<?php

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
