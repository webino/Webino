<?php

namespace WebinoConfigLib\Log\Writer;

/**
 * Class Mock
 */
class Mock extends AbstractWriter
{
    /**
     * Create a mock log writer
     */
    public function __construct()
    {
        $this->mergeArray(['name' => 'mock']);
    }
}
