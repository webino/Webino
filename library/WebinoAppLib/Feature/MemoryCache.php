<?php

namespace WebinoAppLib\Feature;

use WebinoAppLib\Application;
use WebinoConfigLib\Feature\MemoryCache as Engine;

/**
 * Class MemoryCache
 */
class MemoryCache extends AbstractCache
{
    /**
     * Configure an application cache
     */
    public function __construct()
    {
        parent::__construct();
        $this->mergeArray((new Engine)->toArray());
    }
}
