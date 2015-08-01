<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application;
use WebinoConfigLib\Feature\AbstractFeature;
use Zend\Cache\Service\StorageCacheFactory;

/**
 * Class AbstractCache
 */
abstract class AbstractCache extends AbstractFeature
{
    /**
     * Configure an application cache
     */
    public function __construct()
    {
        $this->mergeArray([
            Config::CORE => [
                Config::SERVICES => [
                    Config::SERVICES_FACTORIES => [
                        Application::CACHE => StorageCacheFactory::class,
                    ],
                ],
            ],
        ]);
    }
}
