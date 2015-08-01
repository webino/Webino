<?php

namespace WebinoAppLib\Feature;

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class ServiceFactory
 */
class ServiceFactory extends AbstractFeature
{
    /**
     * Configure application service with factory
     *
     * @param string $name Service name
     * @param string $factoryClass Service factory class
     */
    public function __construct($name, $factoryClass)
    {
        $this->mergeArray([
            Config::SERVICES => [
                Config::SERVICES_FACTORIES => [$name => $factoryClass],
            ],
        ]);
    }
}
