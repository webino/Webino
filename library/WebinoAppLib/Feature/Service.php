<?php

namespace WebinoAppLib\Feature;

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class Service
 */
class Service extends AbstractFeature
{
    /**
     * Configure an application service
     *
     * @param string|array $service Service name or array like [ServiceAlias => ServiceInvokableClass]
     * @param string $factoryClass Optional service factory class
     */
    public function __construct($service, $factoryClass = null)
    {
        $service = is_null($factoryClass)
            ? [Config::SERVICES_INVOKABLES => is_array($service) ? $service : [$service => $service]]
            : [Config::SERVICES_FACTORIES => [$service => $factoryClass]];

        $this->mergeArray([Config::SERVICES => $service]);
    }
}
