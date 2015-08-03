<?php

namespace WebinoAppLib\Contract;

use Zend\Cache\Storage\StorageInterface;

/**
 * Interface CacheInterface
 */
interface CacheInterface
{
    /**
     * Return cache service or cached value
     *
     * @param string|null $key
     * @return StorageInterface|mixed
     */
    public function getCache($key = null);

    /**
     * Set cached value or cache service
     *
     * @param object|StorageInterface|string $cacheOrKey
     * @param bool|mixed|null $setServiceOrValue
     */
    public function setCache($cacheOrKey, $setServiceOrValue = null);
}
