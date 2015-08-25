<?php

namespace WebinoAppLib\Application;

use WebinoAppLib\Feature\Config as FeatureConfig;
use Zend\Config\Config as BaseConfig;

/**
 * Class Config
 */
class Config extends BaseConfig
{
    /**
     * @param array $config
     */
    public function mergeConfig(array $config)
    {
        $this->merge(new BaseConfig((new FeatureConfig($config))->toArray()));
    }
}
