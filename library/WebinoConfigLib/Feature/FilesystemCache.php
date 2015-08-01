<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Cache\Filesystem;

/**
 * Class FilesystemCache
 */
class FilesystemCache extends AbstractCache
{
    /**
     * @param string|null $namespace
     * @param string|null $dir
     */
    public function __construct($namespace = null, $dir = null)
    {
        $cache = new Filesystem($this->resolveNamespace($namespace), $dir);
        $this->mergeArray([$this::KEY => $cache->toArray()]);
    }
}
