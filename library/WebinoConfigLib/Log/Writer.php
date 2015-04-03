<?php

namespace WebinoConfigLib\Log;

use WebinoConfigLib\AbstractConfig;

/**
 * Class Writer
 */
class Writer extends AbstractConfig
{
    /**
     * @param array $writers
     */
    public function __construct(array $writers)
    {
        $this->mergeArray(['writers' => $writers]);
    }
}
