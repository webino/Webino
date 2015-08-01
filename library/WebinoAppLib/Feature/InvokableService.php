<?php

namespace WebinoAppLib\Feature;

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class InvokableService
 */
class InvokableService extends AbstractFeature
{
    /**
     * Configure application invokable service
     *
     * @param string $class Service class
     * @param string $name Service name
     */
    public function __construct($class, $name = null)
    {
        $this->mergeArray([
            Config::SERVICES => [
                Config::SERVICES_INVOKABLES => [null === $name ? $class : $name => $class]
            ],
        ]);
    }
}
