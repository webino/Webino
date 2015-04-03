<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Cache\Filesystem;

/**
 * Class Cache
 */
class Cache extends AbstractCache
{
    /**
     * @param string|null $namespace
     * @param string|null $dir
     */
    public function __construct($namespace = null, $dir = null)
    {
        $cache = new Filesystem(is_null($namespace) ? 'application' : $namespace, $dir);
        $this->mergeArray([$this::KEY => $cache->toArray()]);
    }
}
