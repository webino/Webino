<?php

namespace WebinoConfigLib\Log\Writer;

use WebinoConfigLib\AbstractConfig;

/**
 * Class Noop
 */
class Noop extends AbstractConfig
{
    /**
     * Create a black hole log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'noop']);
    }
}
