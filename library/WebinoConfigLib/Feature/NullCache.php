<?php

namespace WebinoConfigLib\Feature;

use WebinoConfigLib\Cache\BlackHole;

/**
 * Class NullCache
 */
class NullCache extends AbstractCache
{
    /**
     * Configure the null cache
     */
    public function __construct()
    {
        $this->mergeArray([$this::KEY => (new BlackHole)->toArray()]);
    }
}
