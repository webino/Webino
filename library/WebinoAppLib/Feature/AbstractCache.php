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
        parent::__construct([
            new CoreService(Application::CACHE, StorageCacheFactory::class),
        ]);
    }
}
