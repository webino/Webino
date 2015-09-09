<?php

namespace WebinoAppLib\Util;

use WebinoAppLib\Event\RouteEvent;
use WebinoBaseLib\SingletonTrait;

/**
 * Class RouteEventNameResolver
 */
class RouteEventNameResolver
{
    use SingletonTrait;

    /**
     * @param string $name
     * @return string
     */
    public function __invoke($name)
    {
        return $this->getUsePrefix($name) ? $name : RouteEvent::PREFIX . $name;
    }

    /**
     * @param string $name
     * @return bool
     */
    protected function getUsePrefix($name)
    {
        return (RouteEvent::MATCH === $name || class_exists($name) || interface_exists($name));
    }
}
