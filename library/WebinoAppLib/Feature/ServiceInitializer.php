<?php

namespace WebinoAppLib\Feature;

use WebinoConfigLib\Feature\AbstractFeature;

/**
 * Class ServiceInitializer
 */
class ServiceInitializer extends AbstractFeature
{
    /**
     * Configure an application service initializer
     *
     * @param string $class Initializer class
     */
    public function __construct($class)
    {
        parent::__construct([Config::CORE => [Config::SERVICES => [Config::INITIALIZERS => [$class => $class]]]]);
    }
}
