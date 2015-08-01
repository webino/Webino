<?php

namespace WebinoAppLib\Feature;

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class Listener
 */
class Listener extends AbstractFeature
{
     /**
     * Configure an application listener
     *
     * @param string|array $listener Listener class name or an array like [ListenerAlias => ListenerClass]
     * @param string $factoryClass Listener factory class name
     */
    public function __construct($listener, $factoryClass = null)
    {
        $_listener = is_array($listener) ? $listener : [$listener => $listener];
        $key = current($_listener);
        $service = is_null($factoryClass)
            ? [Config::SERVICES_INVOKABLES => [$key => $key]]
            : [Config::SERVICES_FACTORIES => [$key => $factoryClass]];

        $this->mergeArray([
            Config::LISTENERS => $_listener,
            Config::SERVICES  => $service,
        ]);
    }
}
