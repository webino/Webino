<?php

namespace WebinoAppLib\Feature;

use WebinoConfigLib\Feature\;

/**
 * Class NullLog
 */
class NullLog extends BaseCache
{
    use CacheTrait;

    /**
     * Application cache service name
     */
    const SERVICE = 'Cache';

    /**
     * {@inheritdoc}
     */
    public function __construct($namespace = null, $dir = null)
    {
        $this->registerService();
        parent::__construct($namespace, $dir);
    }
}
