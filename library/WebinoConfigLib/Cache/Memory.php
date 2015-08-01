<?php

namespace WebinoConfigLib\Cache;

use WebinoConfigLib\AbstractConfig;

/**
 * Class Memory
 */
class Memory extends AbstractConfig
{
    /**
     * @param string $namespace
     * @param null $limit
     */
    public function __construct($namespace, $limit = null)
    {
        $this->mergeArray([
            'adapter' => [
                'name' => 'memory',
                'options' => [
                    'namespace'   => $namespace,
                    'memoryLimit' => $limit,
                ],
            ],
        ]);
    }
}
