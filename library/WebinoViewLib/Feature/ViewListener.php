<?php

namespace WebinoViewLib\Feature;

use WebinoAppLib\Feature\Service;
use WebinoConfigLib\Config;
use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class ViewListener
 */
class ViewListener extends Config implements
    FeatureInterface,
    ViewConfigInterface
{
    /**
     * Config key
     */
    const LISTENERS = 'listeners';

    /**
     * @param string|array $class
     * @param string|null $factory
     */
    public function __construct($class, $factory = null)
    {
        $isArray = is_array($class);
        $service = ($isArray || $factory) ? $class : [$class => $class];

        parent::__construct([
            [$this::VIEW => [$this::LISTENERS => $isArray ? $class : [$class => $class]]],
            new Service($service, $factory),
        ]);
    }
}
