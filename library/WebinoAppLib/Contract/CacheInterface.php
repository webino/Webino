<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

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
     * @param string|object|StorageInterface $cacheOrKey
     * @param mixed|null $value
     */
    public function setCache($cacheOrKey, $value = null);
}
