<?php

namespace WebinoConfigLib\Feature;

/**
 * Class Logger
 */
class Logger extends AbstractFeature
{
    /**
     * @param string $name
     * @param AbstractFeature[] $features
     */
    public function __construct($name, array $features)
    {
        foreach ($features as $feature) {
            $this->mergeArray([AbstractLog::KEY => [$name => current($feature->toArray())]]);
        }
    }
}
