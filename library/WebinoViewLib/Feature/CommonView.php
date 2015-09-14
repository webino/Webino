<?php

namespace WebinoViewLib\Feature;

use WebinoConfigLib\Config;
use WebinoConfigLib\Feature\FeatureInterface;
use WebinoDomLib\Dom\Config\AbstractSpecConfig;
use WebinoDomLib\Dom\Config\SpecConfigAggregateInterface;

/**
 * Class CommonView
 */
class CommonView extends Config implements
    FeatureInterface,
    ViewConfigInterface
{
    /**
     * Config key
     */
    const COMMON = 'common';

    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $spec = $this->createSpec($config);
        parent::__construct([[$this::VIEW => [$this::COMMON => $spec]]]);
    }

    private function createSpec(array $config, &$spec= [])
    {
        foreach ($config as $feature) {

            // TODO refactoring dependencies
            // if interface
            if (method_exists($feature, 'getDependencies')) {
                $spec = array_replace($spec, $this->createSpec($feature->getDependencies(), $spec));
            }

            if ($feature instanceof SpecConfigAggregateInterface) {
                $this->addFeature($feature);
                $feature = $feature->getSpecConfig();
            }

            if ($feature instanceof AbstractSpecConfig) {
                $spec[$feature->getName()] = $feature->toArray();
            }
        }

        return $spec;
    }
}
