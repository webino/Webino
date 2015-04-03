<?php

namespace WebinoConfigLib\Cache;

use WebinoConfigLib\AbstractConfig;

/**
 * Class BlackHole
 */
class BlackHole extends AbstractConfig
{
    /**
     * Configure black hole cache
     */
    public function __construct()
    {
        $this->mergeArray([
            'adapter' => ['name' => 'blackhole', 'options' => null],
            'plugins' => null,
        ]);
    }
}
