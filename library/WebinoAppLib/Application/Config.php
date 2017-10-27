<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
