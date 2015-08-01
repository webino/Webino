<?php

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
        $this->mergeArray([$this::KEY => $cache->toArray()]);
    }
}
