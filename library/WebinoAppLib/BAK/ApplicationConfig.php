<?php

namespace WebinoAppLib;

use Webino\Application;
use Webino\Feature\Cache;
use WebinoConfigLib\DefaultConfigInterface;
use WebinoConfigLib\Feature\ConfigCacheEnabled;
use Zend\Stdlib\ArrayUtils;

/**
 * Class ApplicationConfig
 */
class ApplicationConfig extends BaseConfig implements
    DefaultConfigInterface
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $config = [])
    {
        $this->addFeatures([
            new ConfigCacheEnabled,
            new Cache,
        ]);

        parent::__construct($config);
    }
}
