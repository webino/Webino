<?php

namespace WebinoConfigLib\Log\Writer;

use WebinoConfigLib\AbstractConfig;

/**
 * Class Mock
 */
class Mock extends AbstractConfig
{
    /**
     * Create a mock log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'mock']);
    }
}
