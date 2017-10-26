<?php

namespace WebinoAppLib\Util;

use WebinoAppLib\Event\RouteEvent;
use WebinoBaseLib\Util\SingletonTrait;

/**
 * Class RouteEventNameResolver
 */
class RouteEventNameResolver
{
    use SingletonTrait;

    /**
     * Returns event name
     *
     * @param string $name
     * @return string
     */
    public function __invoke($name)
    {
        return $this->getUsePrefix($name) ? $name : RouteEvent::PREFIX . $name;
    }

    /**
     * Returns event name
     *
     * @param string $name
     * @return string
     */
    public static function getEventName($name)
    {
        return static::getInstance()->__invoke($name);
    }

    /**
     * Returns true when using prefix
     *
     * @param string $name
     * @return bool
     */
    protected function getUsePrefix($name)
    {
        return (RouteEvent::MATCH === $name || class_exists($name) || interface_exists($name));
    }
}
