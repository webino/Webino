<?php

namespace WebinoConfigLib;

use WebinoConfigLib\Feature\FeatureInterface;

/**
 * Class Config
 */
class Config extends AbstractConfig
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        /** @noinspection PhpUndefinedMethodInspection */
        ($this instanceof DefaultConfigInterface)
            and $this->mergeArray($this->getDefaultConfig());

        $this->addFeatures($config);
    }

    /**
     * @param FeatureInterface[] $features
     * @return $this
     */
    public function addFeatures(array $features)
    {
        foreach ($features as $key => $feature) {

            $isArray = is_array($feature);
            if (is_string($key) || $isArray) {
                $this->mergeArray($isArray ? $feature : [$key => $feature]);
                continue;
            }

            $this->addFeature($feature);
        }

        return $this;
    }

    /**
     * @param FeatureInterface|Config $feature
     */
    public function addFeature(FeatureInterface $feature)
    {
        $this->merge($feature);
    }
}
