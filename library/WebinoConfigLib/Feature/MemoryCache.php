<?php
/**
 * Webino (http://webino.sk)
 *
 * @link        https://github.com/webino for the canonical source repository
 * @copyright   Copyright (c) 2015-2017 Webino, s.r.o. (http://webino.sk)
 * @author      Peter Bačinský <peter@bacinsky.sk>
 * @license     BSD-3-Clause
 */

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Cache\Memory;

/**
 * Class MemoryCache
 */
class MemoryCache extends AbstractCache
{
    /**
     * @param string|null $namespace
     * @param int|null $limit
     */
    public function __construct($namespace = null, $limit = null)
    {
        $cache = new Memory($this->resolveNamespace($namespace), $limit);
        parent::__construct([[$this::KEY => $cache->toArray()]]);
    }
}
